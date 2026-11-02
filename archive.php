<?php
/**
 * Archive template.
 *
 * @package Black_Book
 */

get_header();
?>

<section class="fwc-archive fwc-shell">
	<header class="fwc-archive-header">
		<?php if ( is_category() || is_tag() || is_tax() ) : ?>
			<h1 class="fwc-archive-title"><?php single_term_title(); ?></h1>
		<?php else : ?>
			<?php the_archive_title( '<h1 class="fwc-archive-title">', '</h1>' ); ?>
		<?php endif; ?>
		<?php the_archive_description( '<div class="fwc-section__text">', '</div>' ); ?>
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
