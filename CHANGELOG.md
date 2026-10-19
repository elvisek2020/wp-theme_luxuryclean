# Changelog

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
