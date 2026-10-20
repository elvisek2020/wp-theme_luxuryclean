<?php
/**
 * Hlavička: horní lišta s kontakty, logo, hlavní menu, tlačítko Nezávazná poptávka (mimo stránku Kontakt), začátek <main>.
 */

defined( 'ABSPATH' ) || exit;

$lc_phone   = (string) ekt_opt( 'site_phone' );
$lc_email   = (string) ekt_opt( 'site_email' );
$lc_address = (string) ekt_opt( 'site_address' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main">Přeskočit na obsah</a>

<?php if ( $lc_phone || $lc_email || $lc_address ) : ?>
<div class="lc-top">
	<div class="wrap lc-top__inner">
		<div class="lc-top__contacts">
			<?php if ( $lc_phone ) : ?>
				<a href="<?php echo esc_url( lc_phone_href() ); ?>"><?php echo ekt_icon( 'phone', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( $lc_phone ); ?></span></a>
			<?php endif; ?>
			<?php if ( $lc_email ) : ?>
				<a href="mailto:<?php echo esc_attr( antispambot( $lc_email ) ); ?>"><?php echo ekt_icon( 'mail', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( antispambot( $lc_email ) ); ?></span></a>
			<?php endif; ?>
		</div>
		<?php if ( $lc_address ) : ?>
			<a class="lc-top__address" href="<?php echo esc_url( lc_map_url() ); ?>" target="_blank" rel="noopener" title="Zobrazit na mapě"><?php echo ekt_icon( 'pin', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( $lc_address ); ?></a>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>

<header class="site-header">
	<div class="wrap site-header__inner">
		<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php echo lc_logo_svg( 'lc-logo' ); // phpcs:ignore WordPress.Security.EscapeOutput -- SVG z lc_logo_svg() ?>
		</a>

		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<button class="site-nav__toggle" type="button" aria-expanded="false" aria-controls="site-nav" data-lc-nav-toggle>
				<?php echo ekt_icon( 'menu', 22 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<span class="screen-reader-text">Menu</span>
			</button>
			<nav class="site-nav" id="site-nav" aria-label="Hlavní menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'site-nav__list',
						'depth'          => 2,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>
		<?php endif; ?>

		<?php if ( lc_form_url() && ! is_page( 'kontakt' ) ) : ?>
			<a class="btn site-header__cta" href="<?php echo esc_url( lc_form_url() ); ?>">Nezávazná poptávka</a>
		<?php endif; ?>
	</div>
</header>

<main id="main" class="site-main">
