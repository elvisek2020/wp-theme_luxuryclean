<?php
/**
 * Projektový modul webu Luxury Clean (prefix lc_): kontakty a texty úvodu v Přizpůsobit,
 * výchozí hodnoty převzaté ze starého webu, logo jako SVG a karty služeb z úvodní stránky.
 */

defined( 'ABSPATH' ) || exit;

/* -------------------------------------------------------------------------
 * Výchozí hodnoty ze starého webu (kanonické klíče)
 * ---------------------------------------------------------------------- */

add_filter(
	'ekt_defaults',
	static fn( array $d ): array => array_merge(
		$d,
		array(
			'ga_id'           => 'G-RQW37Q146K', // z MonsterInsights
			'copyright_since' => 2021,
			'credit_name'     => 'ElvisEK',
			'credit_url'      => 'https://www.elvisek.cz',
			'meta_desc'       => 'Úklidové služby Luxury Clean: úklid domácností, firem a kanceláří, čištění koberců, sedaček a vozidel, ozonová dezinfekce a výzdoby. Rohatec a okolí.',
		)
	)
);

// Úvodní stránka má v obsahu tabulku služeb, popis z ní by byl slepený: bez úryvku stránky
// platí popis z Přizpůsobit → SEO a analytika.
add_filter(
	'ekt_seo_data',
	static function ( array $data ): array {
		if ( is_front_page() && ! has_excerpt( (int) get_option( 'page_on_front' ) ) && '' !== (string) ekt_opt( 'meta_desc' ) ) {
			$data['description'] = ekt_seo_clean( (string) ekt_opt( 'meta_desc' ) );
		}
		return $data;
	}
);

// Ikony navíc pro horní lištu (telefon, adresa).
add_filter(
	'ekt_icons',
	static fn( array $icons ): array => array_merge(
		$icons,
		array(
			'phone' => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/>',
			'pin'   => '<path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/>',
		)
	)
);

// Barva lišty prohlížeče podle režimu.
add_filter(
	'ekt_color_scheme_theme_color',
	static fn(): array => array(
		'light' => '#ffffff',
		'dark'  => '#0e0f12',
	)
);

// Písma, která jsou vidět hned nahoře (nadpis úvodu, text).
add_filter(
	'ekt_preload_fonts',
	static fn(): array => array(
		'assets/fonts/poppins-normal-600-latin.woff2',
		'assets/fonts/inter-normal-400-600-latin.woff2',
	)
);

// Patička: volitelný text za copyrightem (Přizpůsobit → Patička), např. „All rights reserved“.
add_filter(
	'ekt_site_info_parts',
	static function ( array $parts ): array {
		$rights = trim( (string) ekt_opt( 'site_rights' ) );
		if ( '' !== $rights && isset( $parts['copyright'] ) ) {
			$parts = array_merge(
				array(
					'copyright' => $parts['copyright'],
					'rights'    => esc_html( $rights ),
				),
				$parts
			);
		}
		return $parts;
	}
);

/* -------------------------------------------------------------------------
 * Přizpůsobit → Kontakty a úvod
 * ---------------------------------------------------------------------- */

ekt_customizer_section( 'kontakt', 'Kontakty a úvod', 15 );

foreach (
	array(
		'site_phone'      => array( 'text', 'Telefon', '721 656 521', '' ),
		'site_email'      => array( 'email', 'E-mail', 'info@luxuryclean.cz', '' ),
		'site_address'    => array( 'text', 'Adresa', 'Budovatelská 1229/69, Rohatec', '' ),
		'site_map_url'    => array( 'url', 'Adresa: odkaz na mapu', '', 'Prázdné = hledání adresy na Mapy.cz.' ),
		'site_hero_kicker' => array( 'text', 'Úvod: nadtitulek', 'Úklidové služby · Rohatec a okolí', '' ),
		'site_hero_title' => array( 'text', 'Úvod: nadpis', 'Vyčistíme cokoliv', 'Prázdné = popis webu (Nastavení → Obecné).' ),
		'site_hero_text'  => array( 'textarea', 'Úvod: text', 'Úklid domácností, firem a kanceláří, čištění koberců, sedaček a vozidel, ozonová dezinfekce i výzdoby na klíč.', '' ),
		'site_cta_title'  => array( 'text', 'Výzva dole: nadpis', 'Vyžádejte si nezávaznou cenovou nabídku', '' ),
		'site_cta_text'   => array( 'text', 'Výzva dole: text', 'Pro pravidelný úklid domácností, firem a kanceláří ceny dohodou.', '' ),
		'site_prices'     => array( 'textarea', 'Úvod: vybrané ceny', "Sedačky a nábytek\nSedací souprava čalouněná = 190 Kč/bm\nSedací souprava kožená = 250 Kč/bm\nKřeslo = 250 Kč\nKancelářská židle = 150 Kč\n\nKoberce\nKusový nízký vlas = 90 Kč/m²\nKusový vysoký vlas = 100 Kč/m²\nCeloplošný nízký vlas = 40 Kč/m²\nCeloplošný vysoký vlas = 45 Kč/m²\n\nOzonové čištění\nByt do 50 m² = 500 Kč\nByt do 80 m² = 800 Kč\nByt nad 80 m² = od 1 000 Kč\nVozidlo = 300 Kč", 'Bloky oddělené prázdným řádkem: první řádek nadpis, další „položka = cena“. Prázdné = sekce se nezobrazí.' ),
		'site_prices_note' => array( 'text', 'Úvod: poznámka pod cenami', 'Minimální objem zakázky 600 Kč. Doprava do 5 km zdarma, nad 5 km 12 Kč/km.', '' ),
		'site_rights'     => array( 'text', 'Patička: text za copyrightem', '', 'Např. All rights reserved. Prázdné = nic.' ),
	) as $lc_key => $lc_field
) {
	ekt_setting_register(
		$lc_key,
		array(
			'type'        => $lc_field[0],
			'label'       => $lc_field[1],
			'default'     => $lc_field[2],
			'description' => $lc_field[3],
			'section'     => 'site_rights' === $lc_key ? 'footer' : 'kontakt',
		)
	);
}
unset( $lc_key, $lc_field );

/**
 * Telefon pro odkaz tel: (jen číslice a +).
 *
 * @return string
 */
function lc_phone_href(): string {
	$digits = preg_replace( '/[^0-9+]/', '', (string) ekt_opt( 'site_phone' ) );
	if ( '' === $digits ) {
		return '';
	}
	return 'tel:' . ( str_starts_with( $digits, '+' ) ? $digits : '+420' . $digits );
}

/**
 * Odkaz adresy na mapu: vlastní z Přizpůsobit, jinak hledání na Mapy.cz.
 *
 * @return string
 */
function lc_map_url(): string {
	$url = trim( (string) ekt_opt( 'site_map_url' ) );
	if ( '' !== $url ) {
		return $url;
	}
	$address = trim( (string) ekt_opt( 'site_address' ) );
	return '' !== $address ? 'https://mapy.cz/?q=' . rawurlencode( $address ) : '';
}

/**
 * Odkaz na kontaktní formulář (stránka Kontakt, kotva panelu #poptavka), nebo '' bez stránky Kontakt.
 * Všechna tlačítka „Nezávazná poptávka“ vedou sem.
 *
 * @return string
 */
function lc_form_url(): string {
	$contact = get_page_by_path( 'kontakt' );
	return $contact ? get_permalink( $contact ) . '#poptavka' : '';
}

/**
 * Vybrané ceny z Přizpůsobit.
 *
 * @return array<int,array{title:string,rows:array<int,array{0:string,1:string}>}>
 */
function lc_prices(): array {
	$blocks = array();
	foreach ( preg_split( "/\n\s*\n/", trim( (string) ekt_opt( 'site_prices' ) ) ) as $chunk ) {
		$lines = array_values( array_filter( array_map( 'trim', explode( "\n", $chunk ) ) ) );
		if ( count( $lines ) < 2 ) {
			continue;
		}
		$rows = array();
		foreach ( array_slice( $lines, 1 ) as $line ) {
			$pair   = array_map( 'trim', explode( '=', $line, 2 ) );
			$rows[] = array( $pair[0], $pair[1] ?? '' );
		}
		$blocks[] = array(
			'title' => $lines[0],
			'rows'  => $rows,
		);
	}
	return $blocks;
}

/* -------------------------------------------------------------------------
 * Logo (SVG podle původního loga: korunka, kruh s tečkovaným lemem, LC, nápis)
 * ---------------------------------------------------------------------- */

/**
 * Logo jako inline SVG. Barva „Luxury“ je z CSS proměnné --lc-logo-text.
 *
 * @param string $class Třída.
 * @param bool   $mark  Jen znak bez nápisu.
 * @return string
 */
function lc_logo_svg( string $class = 'lc-logo', bool $mark = false ): string {
	static $n = 0;
	$id   = 'lc-gold-' . ( ++$n );
	$font = "'Cinzel Decorative', Georgia, serif";
	$grad = '<defs><linearGradient id="' . $id . '" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#a67c1e"/><stop offset=".45" stop-color="#e6c25e"/><stop offset=".7" stop-color="#c99a2e"/><stop offset="1" stop-color="#a67c1e"/></linearGradient></defs>';
	$gold = 'url(#' . $id . ')';
	$emb  = '<g fill="' . $gold . '"><path d="M40 30 37 13l11 8 9-14 9 14 11-8-3 17z"/><circle cx="37" cy="11" r="3"/><circle cx="57" cy="5" r="3.2"/><circle cx="77" cy="11" r="3"/><rect x="40" y="31" width="34" height="3.2" rx="1.2"/></g>'
		. '<circle cx="57" cy="78" r="44" fill="none" stroke="' . $gold . '" stroke-width="3.4"/>'
		. '<circle cx="57" cy="78" r="38" fill="none" stroke="' . $gold . '" stroke-width="3.2" stroke-linecap="round" stroke-dasharray="0 5.6"/>'
		. '<text x="57" y="92" text-anchor="middle" font-family="' . esc_attr( $font ) . '" font-size="40" font-weight="700" fill="' . $gold . '" letter-spacing="-2">LC</text>';
	$name = esc_attr( get_bloginfo( 'name' ) );
	if ( $mark ) {
		return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 114 124" role="img" aria-label="' . $name . '">' . $grad . $emb . '</svg>';
	}
	return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 558 124" role="img" aria-label="' . $name . '">' . $grad . $emb
		. '<text x="134" y="88" font-family="' . esc_attr( $font ) . '" font-size="50" font-weight="700" letter-spacing="1"><tspan fill="var(--lc-logo-text, #0d0d0f)">Luxury</tspan> <tspan fill="' . $gold . '">Clean</tspan></text></svg>';
}

/* -------------------------------------------------------------------------
 * Karty služeb z úvodní stránky
 * ---------------------------------------------------------------------- */

/**
 * Služby z tabulky na úvodní stránce: řádek = název s odkazem, text, obrázek.
 * Obsah se nepřepisuje; když tabulka chybí, vrátí [] a šablona vypíše obsah stránky.
 *
 * @param int $post_id Stránka.
 * @return array<int,array{title:string,url:string,text:string,img:string,alt:string}>
 */
function lc_front_services( int $post_id ): array {
	$html = (string) get_post_field( 'post_content', $post_id );
	if ( false === stripos( $html, '<tr' ) || ! class_exists( 'DOMDocument' ) ) {
		return array();
	}
	$doc  = new DOMDocument();
	$prev = libxml_use_internal_errors( true );
	$doc->loadHTML( '<?xml encoding="utf-8"?><div>' . $html . '</div>' );
	libxml_clear_errors();
	libxml_use_internal_errors( $prev );

	$items = array();
	foreach ( $doc->getElementsByTagName( 'tr' ) as $tr ) {
		$cells = $tr->getElementsByTagName( 'td' );
		if ( ! $cells->length ) {
			continue;
		}
		$first = $cells->item( 0 );
		$link  = $first->getElementsByTagName( 'a' )->item( 0 );
		$title = trim( $link ? $link->textContent : '' );
		if ( '' === $title ) {
			continue;
		}
		// Zalomení řádku (<br>) = mezera, ať se věty neslepí.
		foreach ( iterator_to_array( $first->getElementsByTagName( 'br' ) ) as $br ) {
			$br->parentNode->replaceChild( $doc->createTextNode( ' ' ), $br );
		}
		$text = trim( preg_replace( '/\s+/u', ' ', str_replace( $title, '', $first->textContent ) ) );
		$img  = $tr->getElementsByTagName( 'img' )->item( 0 );
		$items[] = array(
			'title' => $title,
			'url'   => $link ? (string) $link->getAttribute( 'href' ) : '',
			'text'  => $text,
			'img'   => $img ? (string) $img->getAttribute( 'src' ) : '',
			'alt'   => $img ? (string) $img->getAttribute( 'alt' ) : '',
		);
	}
	return $items;
}

/* -------------------------------------------------------------------------
 * Odkazy v patičce
 * ---------------------------------------------------------------------- */

/**
 * Odkazy sloupce patičky. Z menu v umístění, když je přiřazené; jinak z hlavního menu:
 * footer-services = podpoložky první položky s podmenu (Naše služby), footer = ostatní
 * položky první úrovně bez úvodní stránky a bez položek s podmenu.
 *
 * @param string $location footer-services | footer.
 * @return array<int,array{title:string,url:string}>
 */
function lc_footer_links( string $location ): array {
	$map  = get_nav_menu_locations();
	$from = ! empty( $map[ $location ] ) ? $location : 'primary';
	if ( empty( $map[ $from ] ) ) {
		return array();
	}
	$items = (array) wp_get_nav_menu_items( (int) $map[ $from ] );
	if ( $from === $location ) {
		$items = array_filter( $items, static fn( $i ) => 0 === (int) $i->menu_item_parent );
	} else {
		$parents = array_unique( array_map( static fn( $i ) => (int) $i->menu_item_parent, $items ) );
		if ( 'footer-services' === $location ) {
			$first = 0;
			foreach ( $items as $i ) {
				if ( 0 === (int) $i->menu_item_parent && in_array( (int) $i->ID, $parents, true ) ) {
					$first = (int) $i->ID;
					break;
				}
			}
			$items = array_filter( $items, static fn( $i ) => $first && (int) $i->menu_item_parent === $first );
		} else {
			$home  = untrailingslashit( home_url( '/' ) );
			$items = array_filter(
				$items,
				static fn( $i ) => 0 === (int) $i->menu_item_parent
					&& ! in_array( (int) $i->ID, $parents, true )
					&& untrailingslashit( (string) $i->url ) !== $home
			);
		}
	}
	return array_values(
		array_map(
			static fn( $i ) => array(
				'title' => wp_strip_all_tags( (string) $i->title ),
				'url'   => (string) $i->url,
			),
			$items
		)
	);
}

/* -------------------------------------------------------------------------
 * Ceník jako karty (stejné jako Vybrané ceny na titulce)
 * ---------------------------------------------------------------------- */

/**
 * Sloupce „nadpis | seznam položek | seznam cen“ v obsahu stránky vykreslí jako karty
 * .lc-price a sousední karty seskupí do mřížky .lc-prices. Obsah v databázi se nemění;
 * bez tohoto vzoru se HTML vrátí beze změny. Nadpis karty je z prvního sloupce, u prázdného
 * z krátkého tučného bloku těsně před kartou (ten se pak nevypíše).
 *
 * @param string $html Vykreslený obsah.
 * @return string
 */
function lc_pricelist_cards( string $html ): string {
	if ( ! is_singular() || false === strpos( $html, 'wp-block-columns' ) || false === strpos( $html, '<code' ) || ! class_exists( 'DOMDocument' ) ) {
		return $html;
	}
	$doc  = new DOMDocument();
	$prev = libxml_use_internal_errors( true );
	$doc->loadHTML( '<?xml encoding="utf-8"?><div id="lc-root">' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
	libxml_clear_errors();
	libxml_use_internal_errors( $prev );
	$root = $doc->getElementById( 'lc-root' );
	if ( ! $root ) {
		return $html;
	}
	$xpath = new DOMXPath( $doc );
	$text  = static fn( DOMNode $n ): string => trim( (string) preg_replace( '/\s+/u', ' ', str_replace( "\xc2\xa0", ' ', $n->textContent ) ) );
	$price = static function ( string $s ): string {
		$s = (string) preg_replace( '/,-\s*/u', ' ', $s );                // 190,- Kč → 190 Kč
		$s = (string) preg_replace( '/\s*\/\s*/u', '/', $s );              // Kč / m² → Kč/m²
		$s = (string) preg_replace( '/(\d)\.(\d{3})\b/u', "$1\u{00a0}$2", $s ); // 1.500 → 1 500
		$s = (string) preg_replace( '/(\d)(\d{3})(?=\s*Kč)/u', "$1\u{00a0}$2", $s ); // 1000 Kč → 1 000 Kč
		return trim( (string) preg_replace( '/\s+(?=Kč)/u', "\u{00a0}", $s ) );
	};
	$cards = array();
	foreach ( iterator_to_array( $xpath->query( './/div[contains(concat(" ", normalize-space(@class), " "), " wp-block-columns ")]', $root ) ) as $block ) {
		$cols = array();
		foreach ( $block->childNodes as $child ) {
			if ( $child instanceof DOMElement && str_contains( ' ' . $child->getAttribute( 'class' ) . ' ', ' wp-block-column ' ) ) {
				$cols[] = $child;
			}
		}
		if ( 3 !== count( $cols ) ) {
			continue;
		}
		$labels = iterator_to_array( $xpath->query( './ul/li', $cols[1] ) );
		$values = iterator_to_array( $xpath->query( './ul/li', $cols[2] ) );
		if ( ! $labels || count( $labels ) !== count( $values ) || ! $xpath->query( './/code', $cols[2] )->length ) {
			continue;
		}
		$title = $text( $cols[0] );
		if ( '' === $title ) {
			$before = $block->previousSibling;
			while ( $before && ! $before instanceof DOMElement ) {
				$before = $before->previousSibling;
			}
			if ( $before instanceof DOMElement && $xpath->query( './/strong', $before )->length && mb_strlen( $text( $before ) ) <= 80 ) {
				$title = $text( $xpath->query( './/strong', $before )->item( 0 ) );
				$before->parentNode->removeChild( $before );
			}
		}
		$card = $doc->createElement( 'div' );
		$card->setAttribute( 'class', 'lc-price' );
		if ( '' !== $title ) {
			$h = $doc->createElement( 'h3' );
			$h->setAttribute( 'class', 'lc-price__title' );
			$h->appendChild( $doc->createTextNode( rtrim( $title, ': ' ) ) );
			$card->appendChild( $h );
		}
		$dl = $doc->createElement( 'dl' );
		$dl->setAttribute( 'class', 'lc-price__list' );
		foreach ( $labels as $i => $li ) {
			$dt = $doc->createElement( 'dt' );
			$dt->appendChild( $doc->createTextNode( rtrim( $text( $li ), ': ' ) ) );
			$dd = $doc->createElement( 'dd' );
			$dd->appendChild( $doc->createTextNode( $price( $text( $values[ $i ] ) ) ) );
			$dl->appendChild( $dt );
			$dl->appendChild( $dd );
		}
		$card->appendChild( $dl );
		$block->parentNode->replaceChild( $card, $block );
		$cards[] = $card;
	}
	if ( ! $cards ) {
		return $html;
	}
	// Sousední karty (mezi nimi jen mezery) do jedné mřížky.
	$grid = null;
	foreach ( $cards as $card ) {
		$before = $card->previousSibling;
		while ( $before && ! $before instanceof DOMElement && '' === trim( $before->textContent ) ) {
			$before = $before->previousSibling;
		}
		if ( ! $grid || $before !== $grid ) {
			$grid = $doc->createElement( 'div' );
			$grid->setAttribute( 'class', 'lc-prices lc-prices--content' );
			$card->parentNode->insertBefore( $grid, $card );
		}
		$grid->appendChild( $card );
	}
	$out = '';
	foreach ( $root->childNodes as $child ) {
		$out .= $doc->saveHTML( $child );
	}
	return $out;
}
add_filter( 'the_content', 'lc_pricelist_cards', 20 );

/* -------------------------------------------------------------------------
 * Kontakt ve dvou kartách, box s cenovou nabídkou jako odkaz na formulář
 * ---------------------------------------------------------------------- */

/**
 * Úpravy vykresleného obsahu (obsah v databázi se nemění):
 * - na stránce s kontaktním formulářem (.ekc-form) se odstavce před prvním oddělovačem
 *   vypíšou jako karty .lc-contact-card v mřížce .lc-contact-cards; telefon dostane odkaz tel:,
 *   karta s adresou odkaz na mapu,
 * - formulář s úvodním odstavcem v panelu section#poptavka.lc-form-panel s nadpisem „Nezávazná poptávka“,
 * - zvýrazněný odstavec (.has-background) s textem „cenovou nabídku“ bez odkazu vede celý
 *   na formulář na stránce Kontakt.
 *
 * @param string $html Vykreslený obsah.
 * @return string
 */
function lc_content_enhance( string $html ): string {
	$has_form = false !== strpos( $html, 'ekc-form' );
	$has_box  = false !== stripos( $html, 'has-background' ) && false !== mb_stripos( $html, 'cenovou nabídku' );
	if ( ! is_singular() || ( ! $has_form && ! $has_box ) || ! class_exists( 'DOMDocument' ) ) {
		return $html;
	}
	$doc  = new DOMDocument();
	$prev = libxml_use_internal_errors( true );
	$doc->loadHTML( '<?xml encoding="utf-8"?><div id="lc-root">' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
	libxml_clear_errors();
	libxml_use_internal_errors( $prev );
	$root = $doc->getElementById( 'lc-root' );
	if ( ! $root ) {
		return $html;
	}
	$xpath   = new DOMXPath( $doc );
	$changed = false;

	// Box s cenovou nabídkou → odkaz na formulář.
	if ( $has_box && lc_form_url() && ! is_page( 'kontakt' ) ) {
		foreach ( iterator_to_array( $xpath->query( './p[contains(concat(" ", normalize-space(@class), " "), " has-background ")]', $root ) ) as $p ) {
			if ( false === mb_stripos( $p->textContent, 'cenovou nabídku' ) || $xpath->query( './/a', $p )->length ) {
				continue;
			}
			$a = $doc->createElement( 'a' );
			$a->setAttribute( 'href', lc_form_url() );
			$a->setAttribute( 'class', 'lc-box-link' );
			while ( $p->firstChild ) {
				$a->appendChild( $p->firstChild );
			}
			$p->appendChild( $a );
			$p->setAttribute( 'class', trim( $p->getAttribute( 'class' ) . ' lc-box-linked' ) );
			$changed = true;
		}
	}

	// Kontaktní údaje nad oddělovačem → karty vedle sebe.
	if ( $has_form ) {
		$cards = array();
		foreach ( $root->childNodes as $node ) {
			if ( ! $node instanceof DOMElement ) {
				continue;
			}
			if ( 'p' !== $node->nodeName ) {
				break; // první oddělovač nebo jiný blok ukončí kontaktní údaje
			}
			$cards[] = $node;
		}
		if ( count( $cards ) >= 2 && count( $cards ) <= 3 ) {
			$grid = $doc->createElement( 'div' );
			$grid->setAttribute( 'class', 'lc-contact-cards' );
			$root->insertBefore( $grid, $cards[0] );
			foreach ( $cards as $p ) {
				$p->removeAttribute( 'style' );
				$card = $doc->createElement( 'div' );
				$card->setAttribute( 'class', 'lc-contact-card' );
				$card->appendChild( $p );
				// Telefon jako odkaz (jen v textu mimo existující odkazy).
				foreach ( iterator_to_array( $xpath->query( './/text()[not(ancestor::a)]', $p ) ) as $t ) {
					if ( ! preg_match( '/(\+?\d[\d ]{7,}\d)/u', $t->nodeValue, $m, PREG_OFFSET_CAPTURE ) || strlen( preg_replace( '/\D/', '', $m[1][0] ) ) < 9 || false !== stripos( $t->nodeValue, 'IČ' ) ) {
						continue;
					}
					$after = $t->splitText( $m[1][1] );
					$after->splitText( strlen( $m[1][0] ) );
					$a = $doc->createElement( 'a' );
					$a->setAttribute( 'href', 'tel:' . ( str_starts_with( $m[1][0], '+' ) ? '' : '+420' ) . preg_replace( '/\D/', '', $m[1][0] ) );
					$after->parentNode->replaceChild( $a, $after );
					$a->appendChild( $after );
				}
				// Karta s adresou z Přizpůsobit dostane odkaz na mapu.
				$street = trim( (string) strtok( (string) ekt_opt( 'site_address' ), ',' ) );
				if ( '' !== $street && false !== mb_stripos( $p->textContent, $street ) && lc_map_url() ) {
					$map = $doc->createElement( 'a' );
					$map->setAttribute( 'href', lc_map_url() );
					$map->setAttribute( 'target', '_blank' );
					$map->setAttribute( 'rel', 'noopener' );
					$map->setAttribute( 'class', 'lc-contact-card__map' );
					$map->appendChild( $doc->createTextNode( 'Zobrazit na mapě →' ) );
					$card->appendChild( $map );
				}
				$grid->appendChild( $card );
			}
			// Ikony sociálních sítí (modul social, stejné jako v patičce) pod první kartu.
			$social = function_exists( 'ekt_social_links' ) ? (string) ekt_social_links( 'lc-contact-card__social' ) : '';
			if ( '' !== $social ) {
				$tmp = new DOMDocument();
				$old = libxml_use_internal_errors( true );
				$tmp->loadHTML( '<?xml encoding="utf-8"?><div>' . $social . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
				libxml_clear_errors();
				libxml_use_internal_errors( $old );
				foreach ( iterator_to_array( $tmp->documentElement->childNodes ) as $node ) {
					$grid->firstChild->appendChild( $doc->importNode( $node, true ) );
				}
			}
			$changed = true;
		}
	}

	// Formulář v panelu s nadpisem: úvodní odstavec těsně před formulářem jde do panelu,
	// oddělovač před ním odpadne (mezeru dělá panel).
	if ( $has_form ) {
		$form = $xpath->query( '//*[contains(concat(" ", normalize-space(@class), " "), " ekc-form ")]', $root )->item( 0 );
		$top  = $form;
		while ( $top && $top->parentNode !== $root ) {
			$top = $top->parentNode;
		}
		if ( $top instanceof DOMElement ) {
			$prev_el = static function ( DOMNode $n ): ?DOMElement {
				$n = $n->previousSibling;
				while ( $n && ! $n instanceof DOMElement ) {
					$n = $n->previousSibling;
				}
				return $n instanceof DOMElement ? $n : null;
			};
			$move  = array( $top );
			$intro = $prev_el( $top );
			if ( $intro && 'p' === $intro->nodeName ) {
				array_unshift( $move, $intro );
				$sep = $prev_el( $intro );
			} else {
				$sep = $intro;
			}
			if ( $sep && 'hr' === $sep->nodeName ) {
				$sep->parentNode->removeChild( $sep );
			}
			$panel = $doc->createElement( 'section' );
			$panel->setAttribute( 'class', 'lc-form-panel' );
			$panel->setAttribute( 'id', 'poptavka' );
			$kicker = $doc->createElement( 'p' );
			$kicker->setAttribute( 'class', 'kicker' );
			$kicker->appendChild( $doc->createTextNode( 'Napište nám' ) );
			$title = $doc->createElement( 'h2' );
			$title->setAttribute( 'class', 'lc-form-panel__title' );
			$title->appendChild( $doc->createTextNode( 'Nezávazná poptávka' ) );
			$root->insertBefore( $panel, $move[0] );
			$panel->appendChild( $kicker );
			$panel->appendChild( $title );
			foreach ( $move as $node ) {
				$panel->appendChild( $node );
			}
			$changed = true;
		}
	}

	if ( ! $changed ) {
		return $html;
	}
	$out = '';
	foreach ( $root->childNodes as $child ) {
		$out .= $doc->saveHTML( $child );
	}
	return $out;
}
add_filter( 'the_content', 'lc_content_enhance', 21 );
