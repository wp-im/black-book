<?php
/**
 * Single post template.
 *
 * @package Black_Book
 */

get_header();
?>

<section class="fwc-single fwc-shell">
	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content-single' );
		?>
		<?php
		the_post_navigation(
			array(
				'prev_text' => '<span aria-hidden="true">&larr;</span> %title',
				'next_text' => '%title <span aria-hidden="true">&rarr;</span>',
			)
		);
		?>
		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	endwhile;
	?>
</section>

<?php
get_footer();
