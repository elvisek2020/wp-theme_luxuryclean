<?php
/**
 * Stránka: pruh s nadpisem a obsah stránky (obal data-ekt-content pro lightbox a embedy).
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
		<header class="page-hero">
			<div class="wrap">
				<h1 class="page-hero__title"><?php the_title(); ?></h1>
			</div>
		</header>
		<div class="wrap wrap--content">
			<div class="entry__content" data-ekt-content>
				<?php the_content(); ?>
			</div>
		</div>
	</article>
	<?php
endwhile;

get_template_part( 'template-parts/cta' );

get_footer();
