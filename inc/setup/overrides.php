<?php
/**
 * Remove customizer defaults.
 *
 * @param object $wp_customize The default Customizer settings.
 */
add_action( 'customize_register', function($wp_customize) {
	// Remove sections.
	$wp_customize->remove_section( 'custom_css' );
	$wp_customize->remove_section( 'static_front_page' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'colors' );
}, 9999 );
