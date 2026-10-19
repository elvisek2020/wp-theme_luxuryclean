# Šablona Luxury Clean

Lehká klasická šablona (PHP) webu www.luxuryclean.cz: světlý režim „Svěží“ (bílá, černá, zlatá,
stříbrná, tmavě modrá) a tmavý „Noc a zlato“, logo jako SVG, písma lokálně, bez jQuery.
Logika je v kanonických modulech `inc/ekt/`, vzhled v `assets/css/main.css` a šablonových souborech.

## Struktura

| Cesta | Obsah |
|---|---|
| `style.css` | hlavička šablony (Version = verze pluginu = tag) |
| `functions.php` | identita `EKT_*` a načtení modulů |
| `header.php` | horní lišta s kontakty, logo, hlavní menu, tlačítko Napište nám |
| `footer.php` | logo a kontakty, sloupce Služby a Web, copyright, přepínač Systém / Světlý / Tmavý |
| `front-page.php` | úvod s logem, karty služeb z tabulky úvodní stránky, vybrané ceny, výzva |
| `page.php` | stránka s pruhem nadpisu a obsahem |
| `index.php`, `single.php`, `comments.php` | výpis a článek (web články nemá, záloha kostry) |
| `404.php` | stránka nenalezena |
| `template-parts/cta.php` | výzva k poptávce (telefon, odkaz na Kontakt) |
| `template-parts/offline.php` | kostra (offline stránka modulu pwa) |
| `inc/setup.php` | menu (Hlavní, Patička: Služby, Patička: Web), styly a skript šablony |
| `inc/site-luxuryclean.php` | Přizpůsobit → Kontakty a úvod, výchozí hodnoty ze starého webu (GA, rok, popis), logo `lc_logo_svg()`, karty `lc_front_services()`, ceny `lc_prices()`, odkazy patičky `lc_footer_links()` |
| `inc/ekt/` | kanonické moduly: common, seo, analytics, content-links, lightbox, embeds, social, color-scheme, updater |
| `assets/css/main.css` | tokeny (světlé i tmavé), most na `--ekt-*`, vzhled |
| `assets/css/fonts.css`, `assets/fonts/` | Poppins, Inter, Cinzel Decorative (woff2, latin + latin-ext, OFL) |
| `assets/js/theme.js` | mobilní menu a podmenu na dotyk |
| `assets/ekt/` | assets kanonických modulů |
| `screenshot.png` | náhled šablony 1200×900 |
