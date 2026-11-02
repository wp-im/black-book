<?php
/**
 * Template Name: Page with Header
 * Template Post Type: page
 *
 * @package Black_Book
 */

get_header();
?>

<?php
while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'fwc-page' ); ?>>
		<header class="fwc-page-header fwc-shell">
			<?php the_title( '<h1 class="fwc-page-title">', '</h1>' ); ?>
		</header>
		<div class="fwc-entry-content">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'black-book' ) . '">',
					'after'  => '</nav>',
				)
			);
			?>
		</div>
	</article>
	<?php
endwhile;
?>

<?php
get_footer();
