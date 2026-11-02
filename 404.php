<?php
/**
 * 404 template.
 *
 * @package Black_Book
 */

get_header();
?>

<section class="fwc-not-found">
	<p class="fwc-entry-meta">404</p>
	<h1 class="fwc-page-title"><?php esc_html_e( 'Page not found', 'black-book' ); ?></h1>
	<p><?php esc_html_e( 'This URL does not exist. Search the site or return to the main page.', 'black-book' ); ?></p>
	<?php get_search_form(); ?>
	<p><a class="fwc-button fwc-button--light" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go to the main page', 'black-book' ); ?></a></p>
</section>

<?php
get_footer();
