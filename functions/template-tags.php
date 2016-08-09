<?php
/**
 * Zeus Core - A WordPress theme development framework.
 *
 * @package zeus
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param  array $classes Classes for the body element.
 * @return array
 */
function zeus_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'has-logo';
	}

	if ( is_page_template( 'page-templates/page-full-width.php' ) ) {
		$classes[] = 'page-full-width';
	}

	return $classes;
}
add_filter( 'body_class', 'zeus_body_classes' );

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function zeus_jetpack_setup() {
	add_theme_support(
		'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'ZUES_CORE_infinite_scroll_render',
		'footer'    => 'page',
		)
	);
} // end function ZUES_CORE_jetpack_setup
add_action( 'after_setup_theme', 'zeus_jetpack_setup' );

/**
 * Flush out the transients used in ZUES_CORE_categorized_blog.
 */
function zeus_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'zeus_categories' );
}
add_action( 'edit_category', 'zeus_category_transient_flusher' );
add_action( 'save_post',     'zeus_category_transient_flusher' );
