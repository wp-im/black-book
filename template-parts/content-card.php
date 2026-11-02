<?php
/**
 * Post card template part.
 *
 * @package Black_Book
 */

$entry_id = get_the_ID();
?>
<article id="post-<?php echo esc_attr( $entry_id ); ?>" <?php post_class( 'fwc-post-card' . ( 'bp_book' === get_post_type( $entry_id ) ? ' bb-search-result' : '' ) ); ?>>
	<div class="fwc-card__body">
		<h2 class="fwc-card__title">
			<a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
		</h2>
		<div class="fwc-card__meta"><?php black_book_entry_meta( $entry_id ); ?></div>
		<div class="fwc-card__excerpt"><?php the_excerpt(); ?></div>
	</div>
	<?php if ( 'bp_book' === get_post_type( $entry_id ) ) : ?>
		<a class="bb-cover bb-search-cover" href="<?php echo esc_url( get_permalink() ); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>"><?php black_book_cover( $entry_id ); ?></a>
	<?php elseif ( has_post_thumbnail( $entry_id ) ) : ?>
		<a class="fwc-card__media" href="<?php echo esc_url( get_permalink() ); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
			<?php black_book_post_image( $entry_id, 'black-book-card' ); ?>
		</a>
	<?php endif; ?>
</article>
