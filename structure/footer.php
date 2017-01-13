<?php
/**
 * Filters used to modify theme output.
 *
 * @package zeus-framework
 */

if ( ! function_exists( 'zeus_footer' ) ) {

	/**
	 * Output the footer widget areas
	 */
	function zeus_footer() {

		if (   ! is_active_sidebar( 'footer-1' )
			&& ! is_active_sidebar( 'footer-2' )
			&& ! is_active_sidebar( 'footer-3' )
			&& ! is_active_sidebar( 'footer-4' ) ) {
			return;
		} ?>

		 <div class="footer-widgets">
				<?php zeus_widget_area( 'footer-1' ); ?>
				<?php zeus_widget_area( 'footer-2' ); ?>
				<?php zeus_widget_area( 'footer-3' ); ?>
				<?php zeus_widget_area( 'footer-4' ); ?>
		 </div><!-- .footer-widgets -->

		 <?php
	}
}

if ( ! function_exists( 'zeus_sub_footer' ) ) {
	/**
	 * Output the subfooter
	 */
	function zeus_sub_footer() {
		echo '<div class="sub-footer">';
			echo '<div class="wrap">';
					/**
					 * Sub Footer Hook
					 */
					do_action( 'zeus_sub_footer' );
			echo '</div><!-- .wrap -->';
		echo '</div><!-- .sub-footer -->';
	}
}

if ( ! function_exists( 'zeus_footer_attribution' ) ) {
	/**
	 * Output the footer attribution text, this can be overwritten using a filter (zeus_footer_attribution).
	 */
	function zeus_footer_attribution() {

		$footer_attribution = sprintf( __( 'Powered by the <a href="%1s">Zeus Theme</a>.', 'zeus-framework' ), 'http://olympusthemes.com' );

		/*
		 * Returns footer attribution html
		 *
		 * Usage:
		 * add_filter( 'zeus_footer_attribution', 'my_callback' );
		 * function my_callback(){
		 *     return '<a href="http://mywebsite.com">My Link</a>';
		 * }
		 */
		$filtered_footer_attribution = apply_filters( 'zeus_footer_attribution', $footer_attribution );

		echo '<span class="footer-attribution">'.wp_kses_post( $filtered_footer_attribution ).'</span>';

	}
}

if ( ! function_exists( 'zeus_footer_copyright' ) ) {
	/**
	 * Output the footer copyright text, this can be overwritten using a filter (zeus_footer_copyright).
	 */
	function zeus_footer_copyright() {

		$text = __( 'Copyright &copy; %1$s <a href="%2$s">%3$s</a> &middot; All Rights Reserved.', 'zeus-framework' );

		$date = date_i18n( __( 'Y', 'zeus-framework' ) );
		$url = esc_url( home_url() );
		$name = get_bloginfo( 'name' );

		$footer_copyright = sprintf( $text, $date, $url, $name );

		/*
		 * Returns a footer copyright html
		 *
		 * Usage:
		 * add_filter( 'zeus_footer_copyright', 'my_callback' );
		 * function my_callback(){
		 *     return 'Copyright &copy; My Website';
		 * }
		 */
		$filtered_footer_copyright = apply_filters( 'zeus_footer_copyright', $footer_copyright );

		echo '<span class="footer-copyright">'.wp_kses_post( $filtered_footer_copyright ).'</span>';

	}
}

if ( ! function_exists( 'zeus_wpfooter' ) ) {
	/**
	 * Output the wp_footer function, required for plugins.
	 */
	function zeus_wpfooter() {

		wp_footer();

	}
}
