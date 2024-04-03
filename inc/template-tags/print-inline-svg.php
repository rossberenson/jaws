<?php
/**
 * Print a safe svg inline.
 *
 * NOTE: these allowed attr array isn't called
 * NOTE: can be simplified with array_fill_keys
 * NOTE: duplicate?
 * NOTE: "print" is confusing here based on the potential returns
 *
 * @param string $path     The path of the SVG you want to load.
 * @param bool   $get      Get the data or not.
 *
 * @return string The content of the SVG you want to load.
 */
function print_inline_svg( $path, $get = false ) {

	// Check the SVG file exists.
	if ( file_exists( $path ) ) {
		// Load and return the contents of the file.
		if ( $get ) {
			// phpcs:ignore
			return file_get_contents( $path );
		} else {
			// phpcs:ignore
			echo file_get_contents( $path );
		}
	}

	// Return a blank string if we can't find the file.
	return '';
}
