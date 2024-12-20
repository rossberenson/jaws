<?php
/**
 * ThemeName functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

/**
 * Get all the include files for the theme.
 */
$files = [
	'inc/functions/', // Custom functions that act independently of the theme templates.
	'inc/hooks/', // Load custom filters and hooks.
	'inc/blocks/', // Block setup.
	'inc/post-layouts/', // Load custom post types.
	'inc/setup/', // Theme setup.
	'inc/shortcodes/', // Load shortcodes.
	'inc/template-tags/', // Custom template tags for this theme.
	'/tgmpa/plugins.php', // Load TGMPA.
];

foreach ( $files as $include ) {
	$include = trailingslashit( get_template_directory() ) . $include;

	// Allows inclusion of individual files or all .php files in a directory.
	if ( is_dir( $include ) ) {
		foreach ( glob( $include . '*.php' ) as $file ) {
			require $file;
		}
	} else {
		require $include;
	}
}
