<?php
/**
 * Site footer.
 *
 * @package Black_Book
 */

$social_links = black_book_social_links();
?>
	</main>

	<footer class="fwc-site-footer" role="contentinfo">
		<div class="fwc-footer-inner">
			<div>
				<nav class="fwc-footer-nav" aria-label="<?php esc_attr_e( 'Footer navigation', 'black-book' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'fallback_cb'    => false,
							'depth'          => 1,
						)
					);
					?>
				</nav>

				<?php if ( is_active_sidebar( 'footer-brand' ) ) : ?>
					<div class="fwc-footer-brand">
						<?php dynamic_sidebar( 'footer-brand' ); ?>
					</div>
				<?php else : ?>
					<p class="fwc-footer-brand"><?php echo esc_html( black_book_mod( 'footer_text' ) ); ?></p>
				<?php endif; ?>
			</div>

			<div>
				<?php if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="fwc-social-menu" aria-label="<?php esc_attr_e( 'Social links', 'black-book' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'social',
								'container'      => false,
								'fallback_cb'    => false,
								'depth'          => 1,
							)
						);
						?>
					</nav>
				<?php elseif ( ! empty( $social_links ) ) : ?>
					<ul class="fwc-social-list" aria-label="<?php esc_attr_e( 'Social links', 'black-book' ); ?>">
						<?php foreach ( $social_links as $label => $url ) : ?>
							<li><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $label ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
