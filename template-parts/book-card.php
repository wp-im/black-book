<?php
/**
 * Shared uncropped publication card.
 *
 * @package Black_Book
 */

?>
<article <?php post_class( 'bb-book-card' ); ?>>
	<a class="bb-cover" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>"><?php black_book_cover( get_the_ID() ); ?></a>
	<?php if ( is_front_page() ) : ?>
		<h3 class="bb-book-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<?php else : ?>
		<h2 class="bb-book-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<?php endif; ?>
	<p class="bb-book-card__author"><?php black_book_terms( get_the_ID(), 'bp_author' ); ?></p>
</article>
