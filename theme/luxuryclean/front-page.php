<?php
/**
 * Úvodní stránka: úvod s logem, karty služeb (z tabulky v obsahu úvodní stránky, jinak obsah
 * stránky), vybrané ceny z Přizpůsobit a výzva k poptávce. Při výpisu článků na titulce index.php.
 */

defined( 'ABSPATH' ) || exit;

if ( 'page' !== get_option( 'show_on_front' ) ) {
	require EKT_DIR . '/index.php';
	return;
}

get_header();

$lc_front    = (int) get_option( 'page_on_front' );
$lc_services = lc_front_services( $lc_front );
$lc_prices   = lc_prices();
$lc_title    = (string) ekt_opt( 'site_hero_title' );
$lc_pricing  = get_page_by_path( 'cenik-uklidu' );
$lc_phone    = (string) ekt_opt( 'site_phone' );
?>
<section class="lc-hero">
	<div class="wrap lc-hero__inner">
		<div class="lc-hero__text">
			<?php if ( ekt_opt( 'site_hero_kicker' ) ) : ?>
				<p class="kicker"><?php echo esc_html( (string) ekt_opt( 'site_hero_kicker' ) ); ?></p>
			<?php endif; ?>
			<h1 class="lc-hero__title"><?php echo esc_html( '' !== $lc_title ? $lc_title : get_bloginfo( 'description' ) ); ?></h1>
			<?php if ( ekt_opt( 'site_hero_text' ) ) : ?>
				<p class="lc-hero__lead"><?php echo esc_html( (string) ekt_opt( 'site_hero_text' ) ); ?></p>
			<?php endif; ?>
			<p class="lc-hero__actions">
				<?php if ( lc_form_url() ) : ?>
					<a class="btn" href="<?php echo esc_url( lc_form_url() ); ?>">Nezávazná poptávka</a>
				<?php endif; ?>
				<?php if ( $lc_phone ) : ?>
					<a class="btn btn--ghost" href="<?php echo esc_url( lc_phone_href() ); ?>">Zavolat <?php echo esc_html( $lc_phone ); ?></a>
				<?php endif; ?>
			</p>
		</div>
		<div class="lc-hero__brand" aria-hidden="true">
			<?php echo lc_logo_svg( 'lc-logo lc-logo--hero' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>
	</div>
</section>

<section class="lc-section">
	<div class="wrap">
		<div class="lc-section__head">
			<div>
				<p class="kicker">Co děláme</p>
				<h2 class="lc-section__title">Naše služby</h2>
			</div>
			<?php if ( $lc_pricing ) : ?>
				<a class="btn btn--ghost" href="<?php echo esc_url( get_permalink( $lc_pricing ) ); ?>">Ceník úklidů</a>
			<?php endif; ?>
		</div>

		<?php if ( $lc_services ) : ?>
			<div class="lc-cards">
				<?php foreach ( $lc_services as $lc_item ) : ?>
					<a class="lc-card" href="<?php echo esc_url( $lc_item['url'] ); ?>">
						<?php if ( $lc_item['img'] ) : ?>
							<span class="lc-card__image"><img src="<?php echo esc_url( $lc_item['img'] ); ?>" alt="<?php echo esc_attr( $lc_item['alt'] ); ?>" loading="lazy" decoding="async"></span>
						<?php endif; ?>
						<span class="lc-card__body">
							<span class="lc-card__title"><?php echo esc_html( $lc_item['title'] ); ?></span>
							<?php if ( $lc_item['text'] ) : ?>
								<span class="lc-card__text"><?php echo esc_html( $lc_item['text'] ); ?></span>
							<?php endif; ?>
							<span class="lc-card__more">Více <?php echo ekt_icon( 'arrow', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
						</span>
					</a>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<div class="entry__content" data-ekt-content>
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php if ( $lc_prices ) : ?>
<section class="lc-section lc-section--alt">
	<div class="wrap">
		<div class="lc-section__head">
			<div>
				<p class="kicker">Ceník</p>
				<h2 class="lc-section__title">Vybrané ceny</h2>
			</div>
			<?php if ( $lc_pricing ) : ?>
				<a class="btn btn--ghost" href="<?php echo esc_url( get_permalink( $lc_pricing ) ); ?>">Celý ceník</a>
			<?php endif; ?>
		</div>
		<div class="lc-prices">
			<?php foreach ( $lc_prices as $lc_block ) : ?>
				<div class="lc-price">
					<h3 class="lc-price__title"><?php echo esc_html( $lc_block['title'] ); ?></h3>
					<dl class="lc-price__list">
						<?php foreach ( $lc_block['rows'] as $lc_row ) : ?>
							<dt><?php echo esc_html( $lc_row[0] ); ?></dt>
							<dd><?php echo esc_html( $lc_row[1] ); ?></dd>
						<?php endforeach; ?>
					</dl>
				</div>
			<?php endforeach; ?>
		</div>
		<?php if ( ekt_opt( 'site_prices_note' ) ) : ?>
			<p class="lc-prices__note"><?php echo esc_html( (string) ekt_opt( 'site_prices_note' ) ); ?></p>
		<?php endif; ?>
	</div>
</section>
<?php endif; ?>

<?php
get_template_part( 'template-parts/cta' );

get_footer();
