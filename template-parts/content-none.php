<?php
/**
 * No results template part.
 *
 * @package Black_Book
 */

?>
<section class="fwc-empty">
	<h2><?php esc_html_e( 'No posts found.', 'black-book' ); ?></h2>
	<?php if ( is_search() ) : ?>
		<p><?php esc_html_e( 'Try another search term or return to the main page.', 'black-book' ); ?></p>
		<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Return home', 'black-book' ); ?></a></p>
	<?php else : ?>
		<p><?php esc_html_e( 'There are no articles here yet. Please check back soon.', 'black-book' ); ?></p>
	<?php endif; ?>
</section>
