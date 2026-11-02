<?php
/**
 * Generic content template part.
 *
 * @package Black_Book
 */

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
