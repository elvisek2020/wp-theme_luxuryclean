<?php
/**
 * Patička: logo a kontakty, menu služeb a webu, copyright a přepínač Systém / Světlý / Tmavý.
 */

defined( 'ABSPATH' ) || exit;

$lc_phone   = (string) ekt_opt( 'site_phone' );
$lc_email   = (string) ekt_opt( 'site_email' );
$lc_address = (string) ekt_opt( 'site_address' );
?>
</main>

<footer class="site-footer">
	<div class="wrap">
		<div class="site-footer__cols">
			<div class="site-footer__brand">
				<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php echo lc_logo_svg( 'lc-logo lc-logo--footer' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</a>
				<p>
					<?php if ( $lc_address ) : ?>
						<?php echo esc_html( $lc_address ); ?><br>
					<?php endif; ?>
					<?php if ( $lc_phone ) : ?>
						<a href="<?php echo esc_url( lc_phone_href() ); ?>"><?php echo esc_html( $lc_phone ); ?></a>
					<?php endif; ?>
					<?php if ( $lc_phone && $lc_email ) : ?>
						·
					<?php endif; ?>
					<?php if ( $lc_email ) : ?>
						<a href="mailto:<?php echo esc_attr( antispambot( $lc_email ) ); ?>"><?php echo esc_html( antispambot( $lc_email ) ); ?></a>
					<?php endif; ?>
				</p>
				<?php
				// Ikony sociálních sítí (modul social), když jsou vyplněné v Přizpůsobit.
				if ( function_exists( 'ekt_social_links' ) ) {
					echo ekt_social_links( 'site-footer__social' ); // phpcs:ignore WordPress.Security.EscapeOutput -- HTML z modulu
				}
				?>
			</div>

			<?php
			// Sloupce Služby a Web: menu z umístění, jinak odvozené z hlavního menu (lc_footer_links()).
			foreach ( array( 'footer-services' => 'Služby', 'footer' => 'Web' ) as $lc_location => $lc_title ) :
				$lc_links = lc_footer_links( $lc_location );
				if ( ! $lc_links ) {
					continue;
				}
				?>
				<nav class="site-footer__nav" aria-label="<?php echo esc_attr( $lc_title ); ?>">
					<h2 class="site-footer__title"><?php echo esc_html( $lc_title ); ?></h2>
					<ul class="site-footer__menu">
						<?php foreach ( $lc_links as $lc_link ) : ?>
							<li><a href="<?php echo esc_url( $lc_link['url'] ); ?>"><?php echo esc_html( $lc_link['title'] ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</nav>
			<?php endforeach; ?>
		</div>

		<div class="site-footer__bottom">
			<?php
			// Copyright · All rights reserved · Nastavení cookies (modul analytics) · Administrace.
			if ( function_exists( 'ekt_site_info' ) ) {
				echo ekt_site_info( 'site-info' ); // phpcs:ignore WordPress.Security.EscapeOutput -- HTML z common
			}
			// Přepínač Systém / Světlý / Tmavý (modul color-scheme).
			if ( function_exists( 'ekt_color_scheme_switch' ) ) {
				echo ekt_color_scheme_switch(); // phpcs:ignore WordPress.Security.EscapeOutput -- HTML z modulu
			}
			?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
