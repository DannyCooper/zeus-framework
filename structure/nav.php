<?php
/**
 * Outputs the primary navigation.
 *
 * @package zeus-framework
 */

if ( ! function_exists( 'zeus_nav' ) ) {
	/**
	 * Outputs primary navigation.
	 */
	function zeus_nav() {

		/**
		* Fires before the primary navigation
		*/
		do_action( 'zeus_nav_before' );

			echo apply_filters( 'zeus_nav_open', '<nav '. zeus_get_attr( 'menu', 'primary' ) .'">');

				/**
				* Navigation Hook
				*/
				do_action( 'zeus_nav' );

			echo apply_filters( 'zeus_nav_close', '</nav><!-- .menu-primary -->');

		/**
		 * Fires after the primary navigation
		 */
		 do_action( 'zeus_nav_after' );

	}
}


if ( ! function_exists( 'zeus_nav_inner' ) ) {
	/**
	 * Output the navigation.
	 */
	function zeus_nav_inner() {

		echo apply_filters( 'zeus_nav_wrapper_open', '<div class="wrap">' );

			do_action( 'zeus_nav_menu_before' );

				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'container' => false,
					)
				);

			do_action( 'zeus_nav_menu_after' );

		echo apply_filters( 'zeus_nav_wrapper_open', '</div>' );

	}
}

/**
 * Function for grabbing a WP nav menu theme location name.
 *
 * @since  2.0.0
 * @access public
 * @param  string $location
 * @return string
 */
function zeus_get_menu_location_name( $location ) {

	$locations = get_registered_nav_menus();
	return isset( $locations[ $location ] ) ? $locations[ $location ] : '';

}
