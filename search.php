<?php
/**
 * Search results template.
 *
 * @package Black_Book
 */

get_header();
?>

<section class="fwc-archive fwc-shell">
	<header class="fwc-archive-header">
		<h1 class="fwc-archive-title"><?php esc_html_e( 'Search', 'black-book' ); ?></h1>
		<?php get_search_form(); ?>
		<p class="fwc-entry-meta">
			<?php
			global $wp_query;
			printf(
				/* translators: 1: result count, 2: search query. */
				esc_html( _n( '%1$s result for "%2$s"', '%1$s results for "%2$s"', $wp_query->found_posts, 'black-book' ) ),
				esc_html( number_format_i18n( $wp_query->found_posts ) ),
				esc_html( get_search_query() )
			);
			?>
		</p>
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
