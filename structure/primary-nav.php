<?php
/**
 * Outputs the primary navigation.
 *
 * @package zeus-framework
 */

if ( ! function_exists( 'zeus_nav_primary' ) ) {
	/**
	 * Outputs primary navigation.
	 */
	function zeus_nav_primary() {

		echo '<nav '. zeus_get_attr( 'menu', 'primary' ) .'">';

			/**
			* Fires before the primary navigation
			*/
			do_action( 'zeus_primary_nav_before' );

			echo '<div class="wrap">';
				wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container' => false,
					)
			);
			echo '</div>';


			/**
			 * Fires after the primary navigation
			 */
			 do_action( 'zeus_primary_nav_after' );

		echo '</nav><!-- .menu-primary -->';

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
