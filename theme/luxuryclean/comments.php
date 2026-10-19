<?php
/**
 * Komentáře článku. Antispam (modul comments-antispam) se napojuje na comment_form sám.
 */

defined( 'ABSPATH' ) || exit;

if ( post_password_required() ) {
	return;
}
?>
<section id="comments" class="comments">
	<?php if ( have_comments() ) : ?>
		<?php $ekt_count = (int) get_comments_number(); ?>
		<h2 class="comments__title"><?php echo esc_html( function_exists( 'ekt_plural' ) ? ekt_plural( $ekt_count, '%d komentář', '%d komentáře', '%d komentářů' ) : 'Komentáře (' . $ekt_count . ')' ); ?></h2>
		<ol class="comments__list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 40,
				)
			);
			?>
		</ol>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>

	<?php
	if ( comments_open() ) {
		comment_form();
	} elseif ( have_comments() ) {
		echo '<p class="comments__closed">Komentáře jsou uzavřené.</p>';
	}
	?>
</section>
