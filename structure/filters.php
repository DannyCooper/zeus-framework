<?php
/**
 * Filters used to modify theme output.
 *
 * @package zues
 */

if ( ! function_exists( 'zues_excerpt_more' ) ) {
	/**
	 * Filter default more text.
	 *
	 * @param $string $more Default 'read more link' html.
	 */
	function zues_excerpt_more( $more ) {
		global $post;
		return '<p class="read-more-link"><a class="moretag" href="'. get_permalink( $post->ID ) . '">'.__( 'Continue Reading&hellip;', 'zues' ).'</a></p>';
	}
}
add_filter( 'excerpt_more', 'zues_excerpt_more' );
