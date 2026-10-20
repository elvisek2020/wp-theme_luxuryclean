<?php
/**
 * Výzva k poptávce (úvod a stránky): nadpis, text, telefon a odkaz na kontakt.
 */

defined( 'ABSPATH' ) || exit;

$lc_title   = (string) ekt_opt( 'site_cta_title' );
$lc_phone   = (string) ekt_opt( 'site_phone' );
if ( '' === $lc_title || is_page( 'kontakt' ) ) {
	return;
}
?>
<section class="lc-cta">
	<div class="wrap">
		<div class="lc-cta__box">
			<div>
				<h2 class="lc-cta__title"><?php echo esc_html( $lc_title ); ?></h2>
				<?php if ( ekt_opt( 'site_cta_text' ) ) : ?>
					<p class="lc-cta__text"><?php echo esc_html( (string) ekt_opt( 'site_cta_text' ) ); ?></p>
				<?php endif; ?>
			</div>
			<div class="lc-cta__actions">
				<?php if ( $lc_phone ) : ?>
					<a class="lc-cta__tel" href="<?php echo esc_url( lc_phone_href() ); ?>"><?php echo esc_html( $lc_phone ); ?></a>
				<?php endif; ?>
				<?php if ( lc_form_url() ) : ?>
					<a class="btn" href="<?php echo esc_url( lc_form_url() ); ?>">Nezávazná poptávka</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
