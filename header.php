<?php
/**
 * Site header.
 *
 * @package Black_Book
 */

$header_cta_label = black_book_mod( 'header_cta_label' );
$header_cta_url   = black_book_mod( 'header_cta_url' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'black-book' ); ?></a>

	<header class="fwc-site-header" role="banner">
		<div class="fwc-header-inner">
			<div class="fwc-brand">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a class="fwc-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<span class="fwc-brand-mark" aria-hidden="true"></span>
					<span class="fwc-brand-name"><?php bloginfo( 'name' ); ?></span>
					</a>
				<?php endif; ?>
			</div>

			<div class="fwc-header-actions">
				<nav id="site-navigation" class="fwc-nav" aria-label="<?php esc_attr_e( 'Primary navigation', 'black-book' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'fallback_cb'    => false,
							'depth'          => 2,
						)
					);
					?>
					<?php if ( $header_cta_label && $header_cta_url ) : ?>
						<a class="fwc-button fwc-mobile-cta" href="<?php echo esc_url( black_book_action_url( $header_cta_url ) ); ?>"><?php echo esc_html( $header_cta_label ); ?></a>
					<?php endif; ?>
				</nav>

				<?php if ( $header_cta_label && $header_cta_url ) : ?>
					<a class="fwc-button fwc-header-cta" href="<?php echo esc_url( black_book_action_url( $header_cta_url ) ); ?>">
						<?php echo esc_html( $header_cta_label ); ?>
					</a>
				<?php endif; ?>

				<button class="fwc-menu-toggle" type="button" aria-controls="site-navigation" aria-expanded="false">
					<span></span>
					<span></span>
					<span></span>
					<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'black-book' ); ?></span>
				</button>
			</div>
		</div>
	</header>

	<main id="primary" class="site-main">
