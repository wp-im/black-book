<?php
// phpcs:ignoreFile WordPress.Files.FileName -- Native Template Hierarchy uses the registered bp_book slug.
/**
 * Book catalog and native author/series/subject archives.
 *
 * @package Black_Book
 */

get_header();
?>
<div class="fwc-shell bb-catalog">
	<header class="bb-catalog-header"><p class="bb-eyebrow"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></p><h1>
	<?php
	if ( is_tax() ) {
		single_term_title();
	} else {
		esc_html_e( 'Books', 'black-book' ); }
	?>
	</h1><?php the_archive_description( '<div class="fwc-entry-content">', '</div>' ); ?></header>
	<?php
	if ( have_posts() ) :
		?>
		<div class="bb-book-grid">
		<?php
		while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/book-card' );
endwhile;
		?>
</div>
		<?php
		the_posts_pagination(
			array(
				'mid_size' => 1,
				'class'    => 'fwc-pagination',
			)
		); else :
			?>
	<p><?php esc_html_e( 'New publications will appear here.', 'black-book' ); ?></p><?php endif; ?>
</div>
<?php get_footer(); ?>
