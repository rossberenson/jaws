<?php
/**
 * Specify which blocks are allowed.
 */

/**
 * Specify which blocks are allowed.
 *
 * @param array $allowed_blocks Current list of allowed blocks.
 *
 * @return array Allowed block types.
 */
function allowed_blocks( $allowed_blocks ) {

	// Defines the default set of allowed blocks.
	$allowed_blocks = [
		'core/heading',
		'core/paragraph',
		'core/buttons',
		'core/button',
		'core/group',
		'core/columns',
		'core/freeform',
		// 'core/gallery',
		'core/cover',
		'core/html',
		'core/image',
		'core/video',
		'core/list',
		'core/list-item',
		'core/separator',
		'core/spacer',
		'core/table',
		'core/embed',
		'wpforms/form-selector',
	];

	$custom_blocks = glob( get_template_directory() . '/build/blocks/*' );

	foreach ( $custom_blocks as $block ) {
		$json_path = $block . '/block.json';
		if ( file_exists( $json_path ) ) {
			$block_json = file_get_contents( $json_path );
			$block_json = json_decode( $block_json );
			$block_name = $block_json->name;
			if ( $block_name && 'jaws/blockname' !== $block_name ) {
				$allowed_blocks[] = $block_json->name;
			}
		}
	}

	return $allowed_blocks;
}

// Filter changed at WordPress 5.8.
// See https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#allowed_block_types_all.
add_filter( 'allowed_block_types_all', 'allowed_blocks', 99 );
