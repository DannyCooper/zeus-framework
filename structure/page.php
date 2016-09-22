<?php
/**
 * Functions used to build the page-*.php templates.
 *
 * @package zeus-framework
 */

if ( ! function_exists( 'zeus_archive_header' ) ) {
	/**
	 * Output the header for archive pages.
	 */
	function zeus_archive_header() {

		if ( ! is_archive() ) {
			return;
		}

		?>

		<header <?php zeus_attr( 'archive-header' ) ?>>
			<h1 <?php zeus_attr( 'archive-title' ) ?>>
				<?php the_archive_title(); ?>
			</h1>

			<div <?php zeus_attr( 'archive-description' ) ?>>
				<?php echo get_the_archive_description(); ?>
			</div><!-- .archive-description -->
		</header><!-- .archive-header -->

		<?php

	}
}

if ( ! function_exists( 'zeus_search_header' ) ) {
	/**
	 * Output the header for search pages.
	 */
	function zeus_search_header() {

		if ( ! is_search() ) {
			return;
		} ?>

		<header <?php zeus_attr( 'archive-header' ) ?>>
			<h1 <?php zeus_attr( 'archive-title' ) ?>>
				<?php printf( esc_html__( 'Search Results for: %s', 'zeus-framework' ), '<span>' . get_search_query() . '</span>' ); ?>
			</h1>
		</header><!-- .archive-header -->

		<?php
	}
}
