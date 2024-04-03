<?php
/**
 * Disables wpautop to remove empty p tags in rendered Gutenberg blocks.
 */
add_filter(
	'init',
	function() {
		// If we have blocks in place, don't add wpautop.
		if ( has_filter( 'the_content', 'wpautop' ) && has_blocks() ) {
			remove_filter( 'the_content', 'wpautop' );
		}
	},
	9
);
