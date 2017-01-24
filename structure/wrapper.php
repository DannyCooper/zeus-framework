<?php
/**
 * The wrapper used to build all front-facing pages.
 *
 * @package zeus-framework
 */

/**
 * This template calls all the hooks and filters that build the layout.
 * There shouldn't be a single element that can't be modified using either a
 * function, filter or hook.
 */
function zeus() {

	zeus_head();

	/**
	 * Fires before the <body> tag
	 */
	do_action( 'zeus_body_open_before' );

		echo apply_filters('zeus_body_open', '<body '. zeus_get_attr( 'body' ) .'>');

	 /**
	  * Fires after the <body> tag before the site header
	  */
	 do_action( 'zeus_body_open_after' );

		echo apply_filters( 'zeus_site_wrapper_open', '<div class="site-wrapper">' );

			/**
			 * Fires before the site-header
			 */
			do_action( 'zeus_header_before' );

			echo apply_filters( 'zeus_header_open', '<header '. zeus_get_attr( 'header' ) .'>');

					do_action( 'zeus_header_wrapper_before' );

						echo apply_filters( 'zeus_header_wrapper_open', '<div class="wrap">');

							/**
							 * Zeus site-header hook
							 *
							 * @hooked zeus_header- 10
							 */
							do_action( 'zeus_header' );

						echo apply_filters( 'zeus_header_wrapper_open', '</div><!-- .wrap -->');

					do_action( 'zeus_header_wrapper_after' );

				echo '</header><!-- .site-header -->';

			/**
			 * Fires after the site-header
			 *
			 * @hooked zeus_nav_primary - 10
			 */
			do_action( 'zeus_header_after' );

			do_action( 'zeus_site_content_before' );

				echo apply_filters( 'zeus_site_content_open', '<div class="site-content">');

					/**
					 * Fires before the site-content (content + sidebar)
					 */
					do_action( 'zeus_content_sidebar_wrapper_before' );

						echo apply_filters( 'zeus_content_sidebar_wrapper_open', '<div class="wrap">');

							/**
							 * Content + Sidebar Hook
							 */
							 do_action( 'zeus_content_sidebar_wrapper' );

						echo apply_filters( 'zeus_content_sidebar_wrapper_close', '</div><!-- .wrap -->');

					/**
					 * Fires after the site-content wrapper
					 */
					do_action( 'zeus_content_sidebar_wrapper_after' );

				echo apply_filters( 'zeus_site_content_close', '</div><!-- .site-content -->');

			do_action( 'zeus_site_content_after' );

			do_action( 'zeus_footer_before' );

				echo apply_filters( 'zeus_footer_open', '<footer ' . zeus_get_attr( 'footer' ) .'>');

					/**
					 * Fires before the footer wrap
					 */
					 do_action( 'zeus_footer_wrapper_before' );

						echo apply_filters( 'zeus_footer_wrapper_open', '<div class="wrap">');

							/**
							 * Zeus footer hook
							 *
							 * @hooked zeus_load_footer_template - 10
							 */
							do_action( 'zeus_footer' );

						echo apply_filters( 'zeus_footer_wrapper_close', '</div><!-- .wrap -->');

					/**
					 * Fires after the footer wrap
					 */
					do_action( 'zeus_footer_wrapper_after' );

				echo apply_filters( 'zeus_footer_close', '</footer><!-- .site-footer -->');

			do_action( 'zeus_footer_after' );

		echo apply_filters( 'zeus_site_wrapper_close', '</div><!-- .site-wrapper -->');

	/**
	 * Fires before the closing </body> tag
	 */
	do_action( 'zeus_body_close_before' );

	 	echo apply_filters('zeus_body_close', '</body>');

	/**
	  * Fires after the closing </body> tag
	  */
	 do_action( 'zeus_body_close_after' );

	 echo apply_filters( 'zeus_html_close', '</html>');

}
