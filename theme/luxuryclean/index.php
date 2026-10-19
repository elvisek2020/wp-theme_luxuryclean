<?php
/**
 * Výpis článků (titulka, archivy, hledání) – záloha pro všechny šablony, které chybí.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="wrap">
	<?php if ( is_archive() ) : ?>
		<header class="page-header">
			<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
			<?php the_archive_description( '<div class="page-description">', '</div>' ); ?>
		</header>
	<?php elseif ( is_search() ) : ?>
		<header class="page-header">
			<h1 class="page-title">Hledání: <?php echo esc_html( get_search_query() ); ?></h1>
		</header>
	<?php endif; ?>

	<?php if ( have_posts() ) : ?>
		<div class="post-list" data-ekt-grid>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'card' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="card__image" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true"><?php the_post_thumbnail( 'medium_large', array( 'alt' => '' ) ); ?></a>
					<?php endif; ?>
					<h2 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="card__meta"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></p>
					<div class="card__excerpt"><?php the_excerpt(); ?></div>
				</article>
			<?php endwhile; ?>
		</div>

		<?php
		// Dávkové načítání (modul load-more), jinak běžné stránkování.
		if ( function_exists( 'ekt_load_more' ) ) {
			echo ekt_load_more(); // phpcs:ignore WordPress.Security.EscapeOutput -- HTML z modulu
		} else {
			the_posts_pagination(
				array(
					'prev_text' => 'Novější',
					'next_text' => 'Starší',
				)
			);
		}
		?>
	<?php else : ?>
		<p class="empty">Nic jsme nenašli.</p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</div>
<?php
get_footer();
