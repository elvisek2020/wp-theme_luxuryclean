# Lokální WordPress

Kopie www.luxuryclean.cz v Dockeru na http://localhost:8412. Plugin `luxuryclean-core`
a šablona `luxuryclean` jsou připojené z repa, změny se projeví hned.

```bash
dev/setup.sh                    # webroot + dump z nejnovější _backup/RRRR-MM-DD, přepis URL
cd dev && docker compose up -d  # další spuštění
docker compose down             # zastavení (data zůstávají v dev/wp a dev/db)
```

WP-CLI (funkce, zsh nerozdělí proměnnou na příkaz):

```bash
wpc(){ docker compose run --rm -q cli wp "$@"; }
wpc plugin list
wpc option delete ekc_lockouts  # zablokovaná IP po testu limitu přihlášení
```

Lokální administrátor: `wpc user create tester tester@example.invalid --role=administrator`,
heslo do `_docs/dev-pristupy.txt` (neverzuje se).

`dev/wp/` a `dev/db/` se neverzují.
