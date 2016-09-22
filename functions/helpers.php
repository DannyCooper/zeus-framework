<?php
/**
 * Zeus helper functions
 *
 * @package zeus-framework
 */

/**
 * Has the theme just been activated
 *
 * @return bool
 */
function zeus_is_theme_activated() {
	global $pagenow;

	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow === 'themes.php' ) {
		return true;
	}

	return false;
}

/**
 * Check if sidebar is active, if it is then display it.
 * @param string $id
 */
function zeus_widget_area( $id ) {

	if ( is_active_sidebar( $id ) ) {
		echo '<div class="widget-area '. $id .'">';
			     dynamic_sidebar( $id );
		echo '</div>';
	}

}
