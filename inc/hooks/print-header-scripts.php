<?php
/**
 * Display the theme settings header scripts.
 */
add_action(
	'wp_head',
	function() {
		// Check for header scripts.
		$scripts = jaws_get_acf_fields( [ 'header_scripts' ], 'options' );

		// None? Bail...
		if ( ! $scripts ) {
			return;
		}

		// Otherwise, echo the scripts!
		// phpcs:ignore
		echo $scripts['header_scripts'] ?? false;
	},
	999
);
