<?php
/**
 * Presentation helpers for portable BookPress Catalog records.
 *
 * @package Black_Book
 */

/**
 * Get a public featured book, never a draft or another post type.
 *
 * @param int $id Book ID.
 * @return WP_Post|null
 */
function black_book_featured_book( $id ) {
	$id = absint( $id );
	if ( ! $id ) {
		return null;
	}
	$book = get_post( $id );
	return post_type_exists( 'bp_book' ) && $book && 'bp_book' === $book->post_type && 'publish' === $book->post_status && ! post_password_required( $book ) ? $book : null;
}

/**
 * Query a small public selection without a pagination count query.
 *
 * @param int $count Book count.
 * @return WP_Query
 */
function black_book_recent_books( $count = 6 ) {
	return new WP_Query(
		array(
			'post_type'           => 'bp_book',
			'post_status'         => 'publish',
			'has_password'        => false,
			'posts_per_page'      => max( 1, min( 12, absint( $count ) ) ),
			'no_found_rows'       => true,
			'ignore_sticky_posts' => true,
		)
	);
}

/**
 * Print an uncropped core attachment or accessible missing-cover fallback.
 *
 * @param int  $id Book ID.
 * @param bool $priority Above-fold image.
 */
function black_book_cover( $id, $priority = false ) {
	$thumbnail = get_post_thumbnail_id( $id );
	if ( $thumbnail && wp_attachment_is_image( $thumbnail ) ) {
		echo wp_get_attachment_image( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			$thumbnail,
			'large',
			false,
			array(
				'class'         => 'bb-cover__image',
				'alt'           => get_the_title( $id ),
				'loading'       => $priority ? 'eager' : 'lazy',
				'fetchpriority' => $priority ? 'high' : 'auto',
				'sizes'         => '(max-width: 600px) 45vw, (max-width: 980px) 30vw, 280px',
			)
		);
	} else {
		?><span class="bb-cover--missing" role="img" aria-label="<?php esc_attr_e( 'Cover not available', 'black-book' ); ?>"><span><?php esc_html_e( 'Cover forthcoming', 'black-book' ); ?></span></span>
		<?php
	}
}

/**
 * Print linked native terms, handling unavailable taxonomy and WP_Error.
 *
 * @param int    $id Book ID.
 * @param string $taxonomy Taxonomy slug.
 */
function black_book_terms( $id, $taxonomy ) {
	$terms = get_the_terms( $id, $taxonomy );
	if ( ! $terms || is_wp_error( $terms ) ) {
		return;
	}
	foreach ( $terms as $index => $term ) {
		if ( $index ) {
			echo ', ';
		}
		$url = get_term_link( $term );
		if ( is_wp_error( $url ) ) {
			echo esc_html( $term->name );
		} else {
			?>
			<a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $term->name ); ?></a>
			<?php
		}
	}
}

/**
 * Print populated publication facts with late escaping.
 *
 * @param int $id Book ID.
 */
function black_book_publication_data( $id ) {
	$values = array();
	foreach ( array(
		'translator' => __( 'Translator', 'black-book' ),
		'date'       => __( 'Publication date', 'black-book' ),
		'format'     => __( 'Edition / binding', 'black-book' ),
		'pages'      => __( 'Pages', 'black-book' ),
		'isbn'       => 'ISBN',
	) as $key => $label ) {
		$value = get_post_meta( $id, '_bpc_' . $key, true );
		if ( is_scalar( $value ) && '' !== trim( (string) $value ) && '0' !== (string) $value ) {
			$values[] = array( $label, $value );
		}
	}
	if ( ! $values ) {
		return;
	}
	?>
	<dl class="bb-publication-data">
	<?php
	foreach ( $values as $value ) :
		?>
		<div><dt><?php echo esc_html( $value[0] ); ?></dt><dd><?php echo esc_html( $value[1] ); ?></dd></div><?php endforeach; ?></dl>
	<?php
}

/**
 * Render optional outbound book link, not an invented stock status.
 *
 * @param int $id Book ID.
 */
function black_book_action( $id ) {
	$url = get_post_meta( $id, '_bpc_amazon', true );
	$url = is_string( $url ) ? esc_url( $url, array( 'https', 'http' ) ) : '';
	if ( $url && preg_match( '#^https?://#i', $url ) ) {
		?>
		<a class="fwc-button bb-book-action" href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'Find this book', 'black-book' ); ?></a>
		<?php
	}
}

/**
 * Native book selection and homepage settings.
 *
 * @param WP_Customize_Manager $manager Customizer manager.
 */
function black_book_customize_publications( $manager ) {
	$manager->add_section(
		'black_book_publications',
		array(
			'title'    => __( 'Books On The Homepage', 'black-book' ),
			'priority' => 36,
		)
	);
	$choices = array( 0 => __( 'No featured book', 'black-book' ) );
	if ( post_type_exists( 'bp_book' ) ) {
		foreach ( get_posts(
			array(
				'post_type'    => 'bp_book',
				'post_status'  => 'publish',
				'numberposts'  => 100,
				'orderby'      => 'title',
				'order'        => 'ASC',
				'has_password' => false,
			)
		) as $book ) {
			$choices[ $book->ID ] = $book->post_title;
		}
	}
	$manager->add_setting(
		'black_book_featured_book',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		)
	);
	$manager->add_control(
		'black_book_featured_book',
		array(
			'label'   => __( 'Featured book', 'black-book' ),
			'section' => 'black_book_publications',
			'type'    => 'select',
			'choices' => $choices,
		)
	);
	foreach ( array(
		'latest_title'   => __( 'Books', 'black-book' ),
		'featured_label' => __( 'In focus', 'black-book' ),
	) as $key => $default ) {
		$manager->add_setting(
			'black_book_' . $key,
			array(
				'default'           => $default,
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$manager->add_control(
			'black_book_' . $key,
			array(
				'label'   => $default,
				'section' => 'black_book_publications',
				'type'    => 'text',
			)
		);
	}
	foreach ( array(
		'show_books'   => __( 'Show latest books', 'black-book' ),
		'show_contact' => __( 'Show contact', 'black-book' ),
	) as $key => $label ) {
		$manager->add_setting(
			'black_book_' . $key,
			array(
				'default'           => true,
				'sanitize_callback' => 'black_book_sanitize_checkbox',
			)
		);
		$manager->add_control(
			'black_book_' . $key,
			array(
				'label'   => $label,
				'section' => 'black_book_publications',
				'type'    => 'checkbox',
			)
		);
	}
}
add_action( 'customize_register', 'black_book_customize_publications' );
