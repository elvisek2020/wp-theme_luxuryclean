<?php
/**
 * Stránka nenalezena.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<header class="page-hero">
	<div class="wrap">
		<h1 class="page-hero__title">Stránka nenalezena</h1>
	</div>
</header>
<div class="wrap wrap--content lc-404">
	<p>Tahle adresa na webu není. Zkuste úvodní stránku nebo nám rovnou napište.</p>
	<p class="lc-404__actions">
		<a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">Úvodní stránka</a>
		<?php $lc_contact = get_page_by_path( 'kontakt' ); ?>
		<?php if ( $lc_contact ) : ?>
			<a class="btn btn--ghost" href="<?php echo esc_url( get_permalink( $lc_contact ) ); ?>">Kontakt</a>
		<?php endif; ?>
	</p>
</div>
<?php
get_footer();
