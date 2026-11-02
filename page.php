<?php
/**
 * Page template.
 *
 * @package Black_Book
 */

get_header();

while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/content' );
endwhile;

get_footer();
