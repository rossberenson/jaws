<?php
/**
 * Print SVG Sptie in the footer.
 */
function jaws_include_svg_icons() {
	// Define SVG sprite file.
	$svg_icons = get_template_directory() . '/build/images/icons/sprite.svg';

	// If it exists, include it.
	if ( file_exists( $svg_icons ) ) {
		echo '<div class="svg-sprite-wrapper">';
		require_once $svg_icons;
		echo '</div>';
	}
}
add_action( 'wp_footer', 'jaws_include_svg_icons', 9999 );
add_action( 'admin_footer', 'jaws_include_svg_icons', 9999 );
