# Changelog

## v0.2.5 — 2026-10-20

### Šablona
- **Kontakt: formulář v samostatném panelu** s nadpisem „Nezávazná poptávka“ a větší mezerou od kontaktních údajů. Tlačítka „Nezávazná poptávka“ vedou na začátek panelu, takže je nadpis vidět.

### Luxury Clean Core
- Beze změny, jen číslo verze.

## v0.2.4 — 2026-10-20

### Šablona
- **Jedno tlačítko „Nezávazná poptávka“** v hlavičce, v úvodu i ve spodním pruhu (dřív „Napište nám“ a „Poptávkový formulář“), všechna vedou rovnou na formulář. Na stránce Kontakt se tlačítko v hlavičce nezobrazuje.
- **Hlavička na užších obrazovkách**: menu se přepne na mobilní už pod 1080 px, položky se nelámou do dvou řádků.
- **Kontakt**: pod kontaktními údaji ikony sociálních sítí (e-mail, Facebook, Instagram), stejné jako v patičce, upravují se v Přizpůsobit → Sociální sítě.

### Luxury Clean Core
- Beze změny, jen číslo verze.

## v0.2.3 — 2026-10-19

### Šablona
- **Ceník v kartách** jako „Vybrané ceny“ na titulce: každá skupina (sedačky, koberce, vozidla, okna, ozon) je samostatný box, na desktopu tři vedle sebe, na mobilu pod sebou. Ceny v jednotném zápisu (190 Kč/bm, od 1 500 Kč). Obsah stránky se nemění, karty skládá šablona z dosavadních sloupců, a funguje to i bez JavaScriptu.
- **Box „Vyžádejte si nezávaznou cenovou nabídku“** v ceníku vede celý na kontaktní formulář.
- **Kontakt**: kontaktní osoba a údaje firmy ve dvou sloupcích vedle sebe (na mobilu pod sebou), telefon jako odkaz a u adresy odkaz na mapu.

### Luxury Clean Core
- Beze změny, jen číslo verze.

## v0.2.2 — 2026-10-19

### Šablona
- **Adresa v horní liště a v patičce** vede na Mapy.cz (otevře se v novém okně). Vlastní odkaz na mapu jde nastavit v Přizpůsobit → Kontakty a úvod.
- **Ceník na mobilu**: položky a ceny jsou vedle sebe a zarovnané řádek po řádku (dřív se vypsaly nejdřív všechny položky a pak všechny ceny). Ceny jsou výraznější a bez strojového písma.
- **Popisy pro vyhledávače** se už neslepují (odrážky a řádky oddělené mezerou), např. u stránek služeb a Kontaktu.
- Text s natvrdo černou barvou z původní šablony je v tmavém režimu čitelný.

### Luxury Clean Core
- Beze změny, jen číslo verze.

## v0.2.1 — 2026-10-19

### Šablona
- **Patička**: podpis „Design & code by ElvisEK“ s odkazem na www.elvisek.cz (Přizpůsobit → Patička).
- **Patička** bez „All rights reserved“; text za copyrightem jde v případě potřeby doplnit v Přizpůsobit → Patička.

### Luxury Clean Core
- Beze změny, jen číslo verze.

## v0.2.0 — 2026-10-19

### Šablona
- **Kontaktní formulář** ve vzhledu šablony (světlý i tmavý režim), styly Forminatoru odebrané.

### Luxury Clean Core
- **Kontaktní formulář** místo Forminatoru: jméno, e-mail, telefon a zpráva, antispam bez reCAPTCHA (skryté pole, časové razítko, limit 5 zpráv za hodinu z jedné IP), e-mail na info@luxuryclean.cz s odpovědí rovnou odesílateli. Kopie odesílateli se už neposílá.
- **Zprávy z webu** v administraci: všechny zprávy na jednom místě, nepřečtené s počtem u menu a ve widgetu Zdraví webu, upozornění, když se e-mail nepodařilo odeslat.
- **Převod 82 zpráv z Forminatoru** proběhne sám po aktualizaci, převezme i příjemce. Stránky Kontakt a Objednávka se nemusí upravovat, formulář převezme jejich vložený Forminator.
- Údržba webu: pozůstatky Forminatoru se nabídnou až po převodu všech zpráv.

## v0.1.0 — 2026-10-19

### Šablona
- **Nová šablona Luxury Clean** místo Blockskit Digital Agency Firm: světlý vzhled „Svěží“ (bílá, černá, zlatá, stříbrná, tmavě modrá) a tmavý „Noc a zlato“, mobile first.
- **Logo jako SVG** podle původního: korunka, kruh s tečkovaným lemem, monogram LC a nápis „Luxury Clean“ v písmu Cinzel Decorative.
- **Úvodní stránka**: úvod s logem a tlačítky Nezávazná poptávka a Zavolat, karty služeb (skládají se z tabulky na úvodní stránce, obsah se nemění), vybrané ceny a výzva k poptávce.
- **Horní lišta** s telefonem, e-mailem a adresou, hlavní menu s podmenu Naše služby, na mobilu rozbalovací.
- **Patička**: kontakty, sloupce Služby a Web, „Copyright © 2021–2026 Luxury Clean · All rights reserved“ a přepínač **Systém / Světlý / Tmavý**.
- **Přizpůsobit → Kontakty a úvod**: telefon, e-mail, adresa, texty úvodu a výzvy, vybrané ceny.
- **SEO** (meta popis, Open Graph, JSON-LD, canonical) místo Yoast SEO; **Google Analytics 4 s cookie lištou** a Consent Mode v2 místo MonsterInsights a CookieYes (GA ID převzaté); **lightbox** obrázků a **externí odkazy do nového okna** místo dalších dvou pluginů. Moduly mlčí, dokud původní pluginy běží.
- Písma lokálně (Poppins, Inter, Cinzel Decorative), nic z Google Fonts ani CDN.

### Luxury Clean Core
- **Plugin z kanonických modulů**: limit pokusů o přihlášení s eskalací a log přihlášení (nahrazuje Limit Login Attempts Reloaded a CAPTCHA 4WP), info o serveru v patičce administrace (nahrazuje Server IP & Memory Usage), automatické aktualizace, hardening (XML-RPC, výčet uživatelů), bezpečnostní hlavičky, sitemap s přesměrováním ze `sitemap_index.xml`, Údržba webu a widget Zdraví webu, aktualizace z GitHubu.

### Nástroje
- `dev/` lokální WordPress v Dockeru ze zálohy (`dev/setup.sh`).
