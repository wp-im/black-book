<?php
/**
 * Main fallback template.
 *
 * @package Black_Book
 */

get_header();
?>

<section class="fwc-archive fwc-shell">
	<header class="fwc-archive-header">
		<h1 class="fwc-archive-title"><?php esc_html_e( 'Latest Posts', 'black-book' ); ?></h1>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="fwc-post-list">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content-card' );
			endwhile;
			?>
		</div>
		<div class="fwc-pagination">
			<?php the_posts_pagination(); ?>
		</div>
	<?php else : ?>
		<?php get_template_part( 'template-parts/content-none' ); ?>
	<?php endif; ?>
</section>

<?php
get_footer();
