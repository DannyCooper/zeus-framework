<?php
/**
 * Filters used to modify theme output.
 *
 * @package zeus-framework
 */

if ( ! function_exists( 'zeus_sidebar' ) ) {
	/**
	 * Output the primary sidebar and hooks.
	 */
	function zeus_sidebar() {

		/**
		 * Fires before the sidebar
		 */
		do_action( 'zeus_sidebar_before' );

		echo '<aside '. zeus_get_attr( 'sidebar', 'primary' ) . '">';

			/**
			 * Primary Sidebar Hook
			 *
			 * @hooked zeus_sidebar_inner
			 */
			do_action( 'zeus_sidebar' );

		echo '</aside><!-- .sidebar-primary -->';

		/**
		 * Fires after the sidebar
		 */
		do_action( 'zeus_sidebar_after' );

	}
}

if ( ! function_exists( 'zeus_sidebar_inner' ) ) {
	/**
	 * Output the primary sidebar.
	 */
	function zeus_sidebar_inner() {

		echo '<div class="sidebar-inner">';
			dynamic_sidebar( 'sidebar-primary' );
		echo '</div><!-- .sidebar-inner -->';

	}
}


/**
 * Function for grabbing a dynamic sidebar name.
 *
 * @since  2.0.0
 * @access public
 * @global array   $wp_registered_sidebars
 * @param  string $sidebar_id
 * @return string
 */
function zeus_get_sidebar_name( $sidebar_id ) {
	global $wp_registered_sidebars;
	return isset( $wp_registered_sidebars[ $sidebar_id ] ) ? $wp_registered_sidebars[ $sidebar_id ]['name'] : '';
}
