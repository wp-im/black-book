<?php
/**
 * Publisher homepage. Custom Page body replaces the default book sections.
 *
 * @package Black_Book
 */

get_header();
$featured = black_book_featured_book( get_theme_mod( 'black_book_featured_book', 0 ) );
?>
<section class="bb-introduction" aria-labelledby="publisher-title">
	<div class="fwc-shell"><p class="bb-eyebrow"><?php echo esc_html( black_book_mod( 'hero_note' ) ); ?></p><h1 id="publisher-title"><?php echo esc_html( black_book_mod( 'hero_title' ) ); ?></h1><p class="bb-introduction__text"><?php echo esc_html( black_book_mod( 'hero_text' ) ); ?></p></div>
</section>
<?php if ( black_book_front_page_has_content() ) : ?>
	<div class="fwc-shell fwc-section fwc-entry-content">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
		wp_link_pages();
endwhile;
	?>
	</div>
<?php else : ?>
	<?php if ( $featured ) : ?>
	<section class="bb-featured fwc-shell" aria-labelledby="featured-title">
		<a class="bb-cover bb-featured__cover" href="<?php echo esc_url( get_permalink( $featured ) ); ?>" aria-label="<?php echo esc_attr( $featured->post_title ); ?>"><?php black_book_cover( $featured->ID, true ); ?></a>
		<div class="bb-featured__copy"><p class="bb-eyebrow"><?php echo esc_html( get_theme_mod( 'black_book_featured_label', __( 'In focus', 'black-book' ) ) ); ?></p><h2 id="featured-title"><a href="<?php echo esc_url( get_permalink( $featured ) ); ?>"><?php echo esc_html( $featured->post_title ); ?></a></h2><p class="bb-author"><?php black_book_terms( $featured->ID, 'bp_author' ); ?></p><p class="bb-featured__excerpt"><?php echo esc_html( get_the_excerpt( $featured ) ); ?></p><a class="bb-text-link" href="<?php echo esc_url( get_permalink( $featured ) ); ?>"><?php esc_html_e( 'Discover the book', 'black-book' ); ?><span aria-hidden="true"> &rarr;</span></a></div>
	</section>
	<?php endif; ?>
	<?php
	if ( post_type_exists( 'bp_book' ) && get_theme_mod( 'black_book_show_books', true ) ) :
		$books = black_book_recent_books();
		?>
	<section class="bb-books-section fwc-shell" aria-labelledby="books-title"><div class="bb-section-heading"><h2 id="books-title"><?php echo esc_html( get_theme_mod( 'black_book_latest_title', __( 'Books', 'black-book' ) ) ); ?></h2><a class="bb-text-link" href="<?php echo esc_url( get_post_type_archive_link( 'bp_book' ) ); ?>"><?php esc_html_e( 'All books', 'black-book' ); ?><span aria-hidden="true"> &rarr;</span></a></div>
		<?php
		if ( $books->have_posts() ) :
			?>
			<div class="bb-book-grid">
			<?php
			while ( $books->have_posts() ) :
						$books->the_post();
						get_template_part( 'template-parts/book-card' );
endwhile;
			?>
</div>
			<?php
else :
	?>
	<p><?php esc_html_e( 'New publications will appear here.', 'black-book' ); ?></p>
	<?php
endif;
wp_reset_postdata();
?>
	</section>
	<?php endif; ?>
	<?php
	if ( is_active_sidebar( 'publisher-statement' ) ) :
		?>
		<div class="bb-publisher-band"><div class="fwc-shell"><?php dynamic_sidebar( 'publisher-statement' ); ?></div></div><?php endif; ?>
	<?php if ( get_theme_mod( 'black_book_show_contact', true ) ) : ?>
	<section id="contact" class="bb-contact fwc-shell" aria-label="<?php esc_attr_e( 'Contact', 'black-book' ); ?>">
		<?php
		if ( is_active_sidebar( 'front-page-contact' ) ) :
			dynamic_sidebar( 'front-page-contact' ); else :
				?>
		<h2><?php echo esc_html( black_book_mod( 'contact_title' ) ); ?></h2><p><?php echo esc_html( black_book_mod( 'contact_text' ) ); ?></p>
						<?php
						if ( black_book_mod( 'contact_email' ) ) :
							?>
							<a class="bb-text-link" href="<?php echo esc_url( 'mailto:' . sanitize_email( black_book_mod( 'contact_email' ) ) ); ?>"><?php echo esc_html( black_book_mod( 'contact_email' ) ); ?></a><?php endif; ?>
				<?php
				if ( black_book_mod( 'contact_phone' ) ) :
					?>
					<a class="bb-text-link" href="<?php echo esc_url( 'tel:' . preg_replace( '/[^0-9+]/', '', black_book_mod( 'contact_phone' ) ) ); ?>"><?php echo esc_html( black_book_mod( 'contact_phone' ) ); ?></a><?php endif; ?>
		<?php endif; ?>
	</section>
	<?php endif; ?>
<?php endif; ?>
<?php
if ( is_active_sidebar( 'front-page-after-content' ) ) :
	?>
	<div class="fwc-section fwc-shell"><?php dynamic_sidebar( 'front-page-after-content' ); ?></div><?php endif; ?>
<?php get_footer(); ?>
