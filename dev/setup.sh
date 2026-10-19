#!/usr/bin/env bash
# Lokální kopie produkce ze zálohy: webroot → dev/wp, dump → DB, přepis URL.
# Použití: dev/setup.sh [_backup/RRRR-MM-DD]   (výchozí = nejnovější záloha)
set -euo pipefail
cd "$(dirname "$0")"
BK="${1:-$(ls -d ../_backup/*/ | sort | tail -1)}"
BK="${BK%/}"
SRC="$BK/www/domains/luxuryclean.cz"
[ -d "$SRC" ] || { echo "Chybí $SRC"; exit 1; }

echo "Webroot z $SRC"
mkdir -p wp db
rsync -a --delete \
  --exclude wp-config.php \
  --exclude 'wp-content/backupwordpress-*' \
  --exclude 'wp-content/upgrade*' \
  --exclude 'wp-content/plugins/luxuryclean-core' \
  --exclude 'wp-content/themes/luxuryclean' \
  --exclude 'wp-content/mu-plugins/installatron_*' \
  "$SRC/" wp/

# Lokální wp-config (vnořený mount souboru Docker Desktop neumí).
cp wp-config.php wp/wp-config.php

# .htaccess jen s blokem WordPressu (pravidla hostingu by lokál přesměrovala).
cat > wp/.htaccess <<'HT'
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
# END WordPress
HT

docker compose up -d --wait db wordpress
echo "Import dumpu"
gunzip -c "$BK/db/dump.sql.gz" | docker compose exec -T db mariadb -uroot -proot -e "DROP DATABASE IF EXISTS wordpress; CREATE DATABASE wordpress"
gunzip -c "$BK/db/dump.sql.gz" | docker compose exec -T db mariadb -uroot -proot wordpress

wpc(){ docker compose run --rm -q cli wp "$@"; }
for from in https://www.luxuryclean.cz http://www.luxuryclean.cz https://luxuryclean.cz http://luxuryclean.cz; do
  wpc search-replace "$from" 'http://localhost:8412' --all-tables --precise --quiet
done
# ManageWP na lokálu nepatří.
wpc plugin deactivate worker --quiet || true
wpc cache flush --quiet
echo "Hotovo: http://localhost:8412"
