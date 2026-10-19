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
		. '<circle cx="57" cy="78" r="44" fill="none" stroke="' . $gold . '" stroke-width="2.6"/>'
		. '<circle cx="57" cy="78" r="38" fill="none" stroke="' . $gold . '" stroke-width="2.6" stroke-linecap="round" stroke-dasharray="0 5.2"/>'
		. '<text x="57" y="92" text-anchor="middle" font-family="' . esc_attr( $font ) . '" font-size="40" fill="' . $gold . '" letter-spacing="-2">LC</text>';
	$name = esc_attr( get_bloginfo( 'name' ) );
	if ( $mark ) {
		return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 114 124" role="img" aria-label="' . $name . '">' . $grad . $emb . '</svg>';
	}
	return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 536 124" role="img" aria-label="' . $name . '">' . $grad . $emb
		. '<text x="134" y="88" font-family="' . esc_attr( $font ) . '" font-size="50" letter-spacing="1"><tspan fill="var(--lc-logo-text, #0d0d0f)">Luxury</tspan> <tspan fill="' . $gold . '">Clean</tspan></text></svg>';
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
