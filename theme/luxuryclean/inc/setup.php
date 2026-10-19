<?php
/**
 * Projektový modul šablony: menu, velikosti obrázků, content_width, styly a skript šablony.
 * Společnou podporu (title-tag, thumbnails, html5, editor-styles…) a úklid <head> řeší inc/ekt/common.php.
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'after_setup_theme',
	static function () {
		load_theme_textdomain( EKT_SLUG, EKT_DIR . '/languages' );
		add_theme_support( 'align-wide' );
		add_editor_style( array( 'assets/css/fonts.css', 'assets/css/main.css' ) );
		register_nav_menus(
			array(
				'primary'         => 'Hlavní menu',
				'footer-services' => 'Patička: Služby',
				'footer'          => 'Patička: Web',
			)
		);
	}
);

// Šířka obsahu pro vložená videa a obrázky.
$GLOBALS['content_width'] = 860;

// Styly a skript šablony (vzhled, mobilní menu). Funkční CSS kanonických modulů načítají moduly samy z assets/ekt/.
add_action(
	'wp_enqueue_scripts',
	static function () {
		$ver = static fn( string $rel ): string => is_file( EKT_DIR . $rel ) ? (string) filemtime( EKT_DIR . $rel ) : EKT_VERSION;
		wp_enqueue_style( EKT_SLUG . '-fonts', EKT_URI . '/assets/css/fonts.css', array(), $ver( '/assets/css/fonts.css' ) );
		wp_enqueue_style( EKT_SLUG . '-main', EKT_URI . '/assets/css/main.css', array( EKT_SLUG . '-fonts' ), $ver( '/assets/css/main.css' ) );
		wp_enqueue_script(
			EKT_SLUG . '-theme',
			EKT_URI . '/assets/js/theme.js',
			array(),
			$ver( '/assets/js/theme.js' ),
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);
	}
);
