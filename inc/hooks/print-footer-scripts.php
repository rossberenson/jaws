<?php
/**
 * Display the theme settings footer scripts.
 *
 * @return string Footer scripts.
 */
function print_theme_settings_footer_scripts() {
}

add_action(
	'wp_footer',
	function() {
		// Check for footer scripts.
		$scripts = jaws_get_acf_fields( [ 'footer_scripts' ], 'options' );

		// None? Bail...
		if ( ! $scripts ) {
			return;
		}

		// Otherwise, echo the scripts!
		$scripts['footer_scripts'] ?? false;
	},
	999
);
