<?php

function zues() {

	get_header();

	echo '<div class="site-content">';
	do_action( 'zues_content_sidebar_wrapper_before' );
	do_action( 'zues_content_sidebar_wrapper' );
	do_action( 'zues_content_sidebar_wrapper_after' );
	echo '</div>';

	get_footer();

}
