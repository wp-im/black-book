<?php
/**
 * Frameword Classic theme functions.
 *
 * @package Black_Book
 */

if ( ! defined( 'BLACK_BOOK_VERSION' ) ) {
	define( 'BLACK_BOOK_VERSION', '0.1.1' );
}

require_once get_theme_file_path( 'inc/publications.php' );
require_once get_theme_file_path( 'inc/colors.php' );

if ( ! function_exists( 'black_book_defaults' ) ) {
	/**
	 * Return default theme settings.
	 *
	 * @return array
	 */
	function black_book_defaults() {
		return array(
			'header_cta_label' => __( 'Browse books', 'black-book' ),
			'header_cta_url'   => '/books/',
			'hero_title'       => __( 'Black Book', 'black-book' ),
			'hero_text'        => __( 'An independent publishing studio. Books to live with, ideas to return to.', 'black-book' ),
			'hero_note'        => __( 'Independent publishing', 'black-book' ),
			'contact_phone'    => '',
			'contact_email'    => '',
			'footer_text'      => __( 'Black Book. Independent publishing.', 'black-book' ),
			'social_linkedin'  => '',
			'social_x'         => '',
			'social_github'    => '',
			'contact_title'    => __( 'In conversation.', 'black-book' ),
			'contact_text'     => __( 'For editorial enquiries, bookshops and collaborations.', 'black-book' ),
		);
	}
}

/**
 * Resolve homepage fragments consistently on inner pages.
 *
 * @param string $url Owner-configured action URL.
 * @return string
 */
function black_book_action_url( $url ) {
	if ( 0 === strpos( $url, '#' ) ) {
		return home_url( '/' ) . $url;
	}

	if ( 0 === strpos( $url, '/' ) && 0 !== strpos( $url, '//' ) ) {
		return home_url( $url );
	}

	return $url;
}

/**
 * Keep the homepage contact link usable in shared native menus.
 *
 * @param array   $attributes Link attributes escaped by WordPress.
 * @param WP_Post $item Menu item.
 * @param object  $args Menu arguments.
 * @return array
 */
function black_book_contact_menu_url( $attributes, $item, $args ) {
	if ( isset( $attributes['href'], $args->theme_location ) && '#contact' === $attributes['href'] && in_array( $args->theme_location, array( 'primary', 'footer' ), true ) ) {
		$attributes['href'] = home_url( '/#contact' );
	}
	return $attributes;
}
add_filter( 'nav_menu_link_attributes', 'black_book_contact_menu_url', 10, 3 );

if ( ! function_exists( 'black_book_mod' ) ) {
	/**
	 * Return a Customizer setting with a safe default.
	 *
	 * @param string $key Default key without prefix.
	 * @return string
	 */
	function black_book_mod( $key ) {
		$defaults = black_book_defaults();
		$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';

		return get_theme_mod( 'black_book_' . $key, $default );
	}
}

if ( ! function_exists( 'black_book_setup' ) ) {
	/**
	 * Set up theme defaults and WordPress feature support.
	 */
	function black_book_setup() {
		load_theme_textdomain( 'black-book', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 80,
				'width'       => 320,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		add_editor_style( 'style.css' );

		add_image_size( 'black-book-hero', 720, 720, true );
		add_image_size( 'black-book-card', 880, 495, true );
		add_image_size( 'black-book-avatar', 160, 160, true );

		register_nav_menus(
			array(
				'primary' => __( 'Primary navigation', 'black-book' ),
				'footer'  => __( 'Footer navigation', 'black-book' ),
				'social'  => __( 'Social links', 'black-book' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'black_book_setup' );

/**
 * Register widget areas.
 */
function black_book_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Publisher Statement', 'black-book' ),
			'id'            => 'publisher-statement',
			'description'   => __( 'Editable publisher text or images in the dark homepage band.', 'black-book' ),
			'before_widget' => '<section id="%1$s" class="widget fwc-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Front Page Contact', 'black-book' ),
			'id'            => 'front-page-contact',
			'description'   => __( 'Homepage contact content. Empty uses Customizer contact fields.', 'black-book' ),
			'before_widget' => '<section id="%1$s" class="widget fwc-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="fwc-section__title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Front Page After Content', 'black-book' ),
			'id'            => 'front-page-after-content',
			'description'   => __( 'Optional editable module after the front page content or fallback sections.', 'black-book' ),
			'before_widget' => '<section id="%1$s" class="widget fwc-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="fwc-section__title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Brand', 'black-book' ),
			'id'            => 'footer-brand',
			'description'   => __( 'Footer note, legal text, or brand message.', 'black-book' ),
			'before_widget' => '<section id="%1$s" class="widget fwc-footer-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="fwc-footer-widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'black_book_widgets_init' );

/**
 * Enqueue front-end assets.
 */
function black_book_scripts() {
	wp_enqueue_style(
		'black-book-style',
		get_stylesheet_uri(),
		array(),
		BLACK_BOOK_VERSION
	);
	wp_add_inline_style( 'black-book-style', black_book_palette_css() );

	wp_enqueue_script(
		'black-book-navigation',
		get_theme_file_uri( 'assets/js/navigation.js' ),
		array(),
		BLACK_BOOK_VERSION,
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'black_book_scripts' );

/**
 * Sanitize checkbox-like Customizer values.
 *
 * @param mixed $checked Raw value.
 * @return bool
 */
function black_book_sanitize_checkbox( $checked ) {
	return (bool) $checked;
}

/**
 * Register Customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function black_book_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'black_book_content',
		array(
			'title'       => __( 'Black Book', 'black-book' ),
			'description' => __( 'Publisher introduction, contact details, footer and actions. Edit publications under Books in the dashboard.', 'black-book' ),
			'priority'    => 35,
		)
	);

	$text_controls = array(
		'header_cta_label' => __( 'Header CTA label', 'black-book' ),
		'hero_title'       => __( 'Hero title', 'black-book' ),
		'hero_note'        => __( 'Hero note', 'black-book' ),
		'contact_phone'    => __( 'Contact phone', 'black-book' ),
		'footer_text'      => __( 'Footer fallback text', 'black-book' ),
		'contact_title'    => __( 'Contact heading', 'black-book' ),
		'contact_text'     => __( 'Contact introduction', 'black-book' ),
	);

	foreach ( $text_controls as $key => $label ) {
		$wp_customize->add_setting(
			'black_book_' . $key,
			array(
				'default'           => black_book_mod( $key ),
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'black_book_' . $key,
			array(
				'label'   => $label,
				'section' => 'black_book_content',
				'type'    => 'text',
			)
		);
	}

	$wp_customize->add_setting(
		'black_book_hero_text',
		array(
			'default'           => black_book_mod( 'hero_text' ),
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);
	$wp_customize->add_control(
		'black_book_hero_text',
		array(
			'label'   => __( 'Hero text', 'black-book' ),
			'section' => 'black_book_content',
			'type'    => 'textarea',
		)
	);

	$url_controls = array(
		'header_cta_url'  => __( 'Header CTA URL', 'black-book' ),
		'social_linkedin' => __( 'LinkedIn fallback URL', 'black-book' ),
		'social_x'        => __( 'X fallback URL', 'black-book' ),
		'social_github'   => __( 'GitHub fallback URL', 'black-book' ),
	);

	foreach ( $url_controls as $key => $label ) {
		$wp_customize->add_setting(
			'black_book_' . $key,
			array(
				'default'           => black_book_mod( $key ),
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			'black_book_' . $key,
			array(
				'label'   => $label,
				'section' => 'black_book_content',
				'type'    => 'url',
			)
		);
	}

	$wp_customize->add_setting(
		'black_book_contact_email',
		array(
			'default'           => black_book_mod( 'contact_email' ),
			'sanitize_callback' => 'sanitize_email',
		)
	);
	$wp_customize->add_control(
		'black_book_contact_email',
		array(
			'label'   => __( 'Contact email', 'black-book' ),
			'section' => 'black_book_content',
			'type'    => 'email',
		)
	);
}
add_action( 'customize_register', 'black_book_customize_register' );

/**
 * Return Customizer social URL fallback settings.
 *
 * @return array
 */
function black_book_social_links() {
	return array_filter(
		array(
			'LinkedIn' => black_book_mod( 'social_linkedin' ),
			'X'        => black_book_mod( 'social_x' ),
			'GitHub'   => black_book_mod( 'social_github' ),
		)
	);
}

/**
 * Get the primary category-like term for a post.
 *
 * @param int|null $post_id Post ID.
 * @return WP_Term|null
 */
function black_book_primary_category( $post_id = null ) {
	$post_id    = $post_id ? (int) $post_id : get_the_ID();
	$categories = get_the_category( $post_id );

	return ! empty( $categories ) ? $categories[0] : null;
}

/**
 * Print entry metadata.
 *
 * @param int|null $post_id Post ID.
 */
function black_book_entry_meta( $post_id = null ) {
	$post_id  = $post_id ? (int) $post_id : get_the_ID();
	$category = black_book_primary_category( $post_id );
	?>
	<span class="fwc-entry-date"><?php echo esc_html( get_the_date( '', $post_id ) ); ?></span>
	<?php if ( $category ) : ?>
		<span aria-hidden="true"> / </span>
		<a href="<?php echo esc_url( get_category_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
	<?php endif; ?>
	<?php
}

/**
 * Render an image or fallback block for a post card.
 *
 * @param int    $post_id Post ID.
 * @param string $size Image size.
 */
function black_book_post_image( $post_id, $size = 'black-book-card' ) {
	if ( has_post_thumbnail( $post_id ) ) {
		echo get_the_post_thumbnail( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			$post_id,
			$size,
			array(
				'class'   => 'fwc-card__image',
				'loading' => 'lazy',
			)
		);
		return;
	}
}


/**
 * Check whether a queried static front page has saved content.
 *
 * @return bool
 */
function black_book_front_page_has_content() {
	if ( ! is_page() ) {
		return false;
	}

	$post_id = get_queried_object_id();

	if ( ! $post_id ) {
		return false;
	}

	return '' !== trim( (string) get_post_field( 'post_content', $post_id ) );
}
