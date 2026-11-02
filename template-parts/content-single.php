<?php
/**
 * Single post content template part.
 *
 * @package Black_Book
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'fwc-single-card' ); ?>>
	<header class="fwc-single-header">
		<?php the_title( '<h1 class="fwc-single-title">', '</h1>' ); ?>
		<div class="fwc-entry-meta"><?php black_book_entry_meta(); ?></div>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="fwc-single-image">
			<?php the_post_thumbnail( 'large' ); ?>
		</div>
	<?php endif; ?>

	<div class="fwc-entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Post pages', 'black-book' ) . '">',
				'after'  => '</nav>',
			)
		);
		?>
	</div>

	<?php if ( has_tag() ) : ?>
		<footer class="fwc-entry-footer">
			<?php the_tags( '<span class="fwc-tags">', ', ', '</span>' ); ?>
		</footer>
	<?php endif; ?>
</article>
