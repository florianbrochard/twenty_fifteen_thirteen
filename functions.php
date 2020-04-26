<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

add_theme_support( 'align-wide' );

if ( ! function_exists( 'twentyfifteen_entry_date' ) ) :
	/**
	 * Print HTML with date information for current post.
	 *
	 * Create your own twentyfifteen_entry_date() to override in a child theme.
	 *
	 * @since Twenty Fifteen Thirteen 0.1
	 *
	 * @param boolean $echo (optional) Whether to echo the date. Default true.
	 * @return string The HTML-formatted post date.
	 */
	function twentyfifteen_entry_date( $echo = true ) {
		if ( has_post_format( array( 'chat', 'status' ) ) ) {
			/* translators: 1: Post format name, 2: Date. */
			$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentyfifteen' );
		} else {
			$format_prefix = '%2$s';
		}

		$date = sprintf(
			'<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date  published updated" datetime="%3$s">%4$s</time></a></span>',
			esc_url( get_permalink() ),
			/* translators: %s: Post title. */
			esc_attr( sprintf( __( 'Permalink to %s', 'twentyfifteen' ), the_title_attribute( 'echo=0' ) ) ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
		);

		if ( $echo ) {
			echo $date;
		}

		return $date;
	}
endif;