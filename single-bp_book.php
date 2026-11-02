<?php
// phpcs:ignoreFile WordPress.Files.FileName -- Native Template Hierarchy uses the registered bp_book slug.
/**
 * Publication detail: uncropped cover, facts and native editor introduction.
 *
 * @package Black_Book
 */

get_header();
while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'bb-detail fwc-shell' ); ?>>
		<nav class="bb-breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'black-book' ); ?>"><a href="<?php echo esc_url( get_post_type_archive_link( 'bp_book' ) ); ?>"><span aria-hidden="true">&larr; </span><?php esc_html_e( 'All books', 'black-book' ); ?></a></nav>
		<?php
		if ( post_password_required() ) :
			?>
			<h1><?php the_title(); ?></h1><?php the_content(); else : ?>
		<div class="bb-detail-top"><div class="bb-cover bb-detail__cover"><?php black_book_cover( get_the_ID(), true ); ?></div>
			<header class="bb-detail__information"><p class="bb-eyebrow"><?php black_book_terms( get_the_ID(), 'bp_series' ); ?></p><h1><?php the_title(); ?></h1><p class="bb-author"><?php black_book_terms( get_the_ID(), 'bp_author' ); ?></p>
					<?php
					if ( has_excerpt() ) :
						?>
				<p class="bb-detail__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
					<?php
					black_book_publication_data( get_the_ID() );
					black_book_action( get_the_ID() );
					?>
</header>
		</div>
		<section class="bb-detail-body" aria-labelledby="book-description-title"><h2 id="book-description-title"><?php esc_html_e( 'About this book', 'black-book' ); ?></h2><div class="fwc-entry-content">
					<?php
					the_content();
					wp_link_pages();
					?>
		</div></section>
					<?php endif; ?>
	</article>
	<?php
endwhile;
get_footer();
