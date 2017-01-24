<?php
/**
 * Filters used to modify theme output.
 *
 * @package zeus-framework
 */

/**
 * Make the read more link consistent across all excerpt types.
 */
function zeus_read_more_custom_excerpt( $text ) {

	if ( strpos( $text, '[&hellip;]') ) {

		$excerpt = str_replace( '[&hellip;]', '<p><a class="more-link" href="' . esc_url( get_permalink() ) . '">'.esc_html__( 'Continue Reading&hellip;','zeus-framework' ).'</a></p>', $text );

	} else {

		$excerpt = $text . '<p><a class="more-link" href="' . esc_url( get_permalink() ) . '">'.esc_html__( 'Continue Reading&hellip;','zeus-framework' ).'</a></p>';

	}
	return $excerpt;

}
add_filter( 'the_excerpt', 'zeus_read_more_custom_excerpt' );


/**
 * Remove sidebar from full width page template.
 */
function remove_sidebar_from_full_width_template() {

	// Remove sidebar from just this page-template.
	if ( is_page_template( 'page-templates/full-width.php' ) ) {

		remove_action( 'zeus_content_sidebar_wrapper', 'zeus_sidebar_primary', 20 );

	}

}
add_action( 'zeus_content_sidebar_wrapper','remove_sidebar_from_full_width_template' );
