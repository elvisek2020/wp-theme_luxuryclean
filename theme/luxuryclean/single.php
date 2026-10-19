<?php
/**
 * Detail článku. Obsah je v obalu s atributem data-ekt-content: lightbox, kopírování kódu
 * a obsah článku (TOC) hledají jen uvnitř. Výstupy modulů se volají přes function_exists(),
 * šablona tak funguje i s vypnutými moduly.
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'wrap entry' ); ?>>
		<header class="entry__header">
			<h1 class="entry__title"><?php the_title(); ?></h1>
			<p class="entry__meta">
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
				<?php
				$ekt_cat = function_exists( 'ekt_primary_category' ) ? ekt_primary_category() : null;
				if ( $ekt_cat ) {
					echo ' · <a href="' . esc_url( get_category_link( $ekt_cat ) ) . '">' . esc_html( $ekt_cat->name ) . '</a>';
				}
				// Odznak „Aktualizováno“ (modul updated).
				if ( function_exists( 'ekt_updated_badge' ) ) {
					echo ' ' . ekt_updated_badge(); // phpcs:ignore WordPress.Security.EscapeOutput -- HTML z modulu
				}
				?>
			</p>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="entry__image"><?php the_post_thumbnail( 'large' ); ?></figure>
		<?php endif; ?>

		<?php
		// Ve zkratce (modul summary) a obsah článku (modul toc).
		if ( function_exists( 'ekt_summary_box' ) ) {
			echo ekt_summary_box(); // phpcs:ignore WordPress.Security.EscapeOutput -- HTML z modulu
		}
		if ( function_exists( 'ekt_the_toc' ) ) {
			ekt_the_toc();
		}
		?>

		<div class="entry__content" data-ekt-content>
			<?php the_content(); ?>
		</div>

		<?php
		wp_link_pages();

		// Sdílení (modul share).
		if ( function_exists( 'ekt_share_links' ) ) {
			echo ekt_share_links(); // phpcs:ignore WordPress.Security.EscapeOutput -- HTML z modulu
		}
		?>
	</article>

	<?php
	if ( comments_open() || get_comments_number() ) {
		echo '<div class="wrap">';
		comments_template();
		echo '</div>';
	}
endwhile;

get_footer();
