<?php
/**
 * Print a safe svg inline.
 *
 * @param string $path     The path of the SVG you want to load.
 * @param bool   $get      Get the data or not.
 *
 * @return string The content of the SVG you want to load.
 */
function jaws_print_inline_svg( $path ) {

	// Check the SVG file exists.
	if ( file_exists( $path ) ) {
		// Load and return the contents of the file.

		// phpcs:ignore
		echo file_get_contents( $path );
	}

	// Return a blank string if we can't find the file.
	return '';
}
