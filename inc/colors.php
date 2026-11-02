<?php
/**
 * Native frontend color settings and safe CSS variables.
 *
 * @package Black_Book
 */

/**
 * Describe palette roles without changing the default visual identity.
 *
 * @return array
 */
function black_book_palette() {
	return array(
		'background'        => array( '#ffffff', __( 'Page background', 'black-book' ), 'global' ),
		'text'              => array( '#191919', __( 'Headings, body and icons', 'black-book' ), 'global' ),
		'muted'             => array( '#626262', __( 'Secondary text', 'black-book' ), 'global' ),
		'soft'              => array( '#f5f5f5', __( 'Soft surfaces', 'black-book' ), 'global' ),
		'border'            => array( '#dedede', __( 'Separators', 'black-book' ), 'global' ),
		'accent'            => array( '#191919', __( 'Buttons and selected pages', 'black-book' ), 'global' ),
		'accent_text'       => array( '#ffffff', __( 'Button text', 'black-book' ), 'global' ),
		'accent_hover'      => array( '#3c3c3c', __( 'Button hover background', 'black-book' ), 'global' ),
		'accent_active'     => array( '#000000', __( 'Button pressed background', 'black-book' ), 'global' ),
		'focus'             => array( '#3569aa', __( 'Keyboard focus', 'black-book' ), 'global' ),
		'form_background'   => array( '#fafafa', __( 'Input background', 'black-book' ), 'global' ),
		'form_border'       => array( '#8a8a8a', __( 'Input border', 'black-book' ), 'global' ),
		'light_border'      => array( '#999999', __( 'Secondary button border', 'black-book' ), 'global' ),
		'header_background' => array( '#ffffff', __( 'Header and menu background', 'black-book' ), 'intro' ),
		'header_text'       => array( '#191919', __( 'Header and menu text', 'black-book' ), 'intro' ),
		'hero_background'   => array( '#f5f5f5', __( 'Introduction background', 'black-book' ), 'intro' ),
		'hero_text'         => array( '#191919', __( 'Introduction text', 'black-book' ), 'intro' ),
		'hero_note'         => array( '#414141', __( 'Introduction note', 'black-book' ), 'intro' ),
		'dark_background'   => array( '#191919', __( 'Publisher background', 'black-book' ), 'process' ),
		'dark_text'         => array( '#ffffff', __( 'Publisher headings and links', 'black-book' ), 'process' ),
		'dark_muted'        => array( '#c9c9c9', __( 'Publisher secondary text', 'black-book' ), 'process' ),
		'dark_border'       => array( '#545454', __( 'Publisher separators', 'black-book' ), 'process' ),
		'dark_focus'        => array( '#9ecbff', __( 'Publisher keyboard focus', 'black-book' ), 'process' ),
		'footer_background' => array( '#f5f5f5', __( 'Footer background', 'black-book' ), 'footer' ),
		'footer_text'       => array( '#191919', __( 'Footer headings and links', 'black-book' ), 'footer' ),
		'footer_muted'      => array( '#626262', __( 'Footer secondary text', 'black-book' ), 'footer' ),
	);
}

/**
 * Register grouped native color pickers.
 *
 * @param WP_Customize_Manager $manager Customizer manager.
 */
function black_book_customize_colors( $manager ) {
	$manager->add_panel(
		'black_book_colors',
		array(
			'title'       => __( 'Colors', 'black-book' ),
			'description' => __( 'Theme colors only. Keep text readable against its background; images and plugin-owned colors are independent.', 'black-book' ),
			'priority'    => 30,
		)
	);
	foreach ( array(
		'global'  => __( 'Page, Controls And Forms', 'black-book' ),
		'intro'   => __( 'Header And Introduction', 'black-book' ),
		'process' => __( 'Publisher Band', 'black-book' ),
		'footer'  => __( 'Footer', 'black-book' ),
	) as $key => $label ) {
		$manager->add_section(
			'black_book_colors_' . $key,
			array(
				'title' => $label,
				'panel' => 'black_book_colors',
			)
		);
	}
	foreach ( black_book_palette() as $key => $item ) {
		$id = 'black_book_color_' . $key;
		$manager->add_setting(
			$id,
			array(
				'default'           => $item[0],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$manager->add_control(
			new WP_Customize_Color_Control(
				$manager,
				$id,
				array(
					'label'   => $item[1],
					'section' => 'black_book_colors_' . $item[2],
				)
			)
		);
	}
}
add_action( 'customize_register', 'black_book_customize_colors' );

/**
 * Generate CSS from validated palette roles, never arbitrary owner CSS.
 *
 * @return string
 */
function black_book_palette_css() {
	$css = ':root{';
	foreach ( black_book_palette() as $key => $item ) {
		$color = sanitize_hex_color( get_theme_mod( 'black_book_color_' . $key, $item[0] ) );
		$color = $color ? $color : $item[0];
		$name  = str_replace( '_', '-', $key );
		$css  .= '--fwc-' . $name . ':' . $color . ';';
		if ( 'header_background' === $key ) {
			$hex = substr( $color, 1 );
			if ( 3 === strlen( $hex ) ) {
				$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
			}
			$css .= '--fwc-' . $name . '-rgb:' . hexdec( substr( $hex, 0, 2 ) ) . ',' . hexdec( substr( $hex, 2, 2 ) ) . ',' . hexdec( substr( $hex, 4, 2 ) ) . ';';
		}
	}
	return $css . '}';
}
