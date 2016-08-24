<?php
/**
 * Customizer Utility Functions
 *
 * @package 	Customizer_Library
 * @author		Devin Price, The Theme Foundry
 */

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function zeus_customizer_preview_js() {

	wp_enqueue_script(
		'zeus-customizer', // Give the script an ID
		get_template_directory_uri().'/assets/js/customizer.js', // Point to file
		array( 'jquery','customize-preview' ), // Define dependencies
		'', // Define a version (optional)
		true // Put script in footer?
	);

}
add_action( 'customize_preview_init', 'zeus_customizer_preview_js' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function zeus_customizer_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'zeus_customizer_register' );
