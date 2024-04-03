<?php
/**
 * Load Blocks
 */

/**
 * Register Blocks
 *
 * @return void
 */
function register_custom_blocks() {
	$blocks = glob( get_template_directory() . '/build/blocks/*' );

	foreach ( $blocks as $block ) {
		$json_path = $block . '/block.json';
		if ( file_exists( $json_path ) ) {
			$block_json = file_get_contents( $json_path );
			$block_json = json_decode( $block_json );
			$block_name = $block_json->name;
			if ( $block_name && 'jaws/blockname' !== $block_name ) {
				register_block_type( $json_path );
			}
		}
	}
}
add_action( 'init', 'register_custom_blocks' );
