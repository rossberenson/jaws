<?php
/**
 * Get field from another page / post block.
 *
 * @param   string $field_name ACF Field Name.
 * @param   number $post_id Post ID.
 * @param   string $block_name Block Name.
 *
 * @return  mixed Value of $selector
 */
function jaws_get_field_from_block( $field_name, $post_id, $block_name ) {
	// If the post object doesn't even have any blocks, abort early and return false.
	if ( ! has_blocks( $post_id ) ) {
		return false;
	}

	// Get our blocks from the post content of the post we're interested in.
	$post_blocks = parse_blocks( get_the_content( '', false, $post_id ) );

	// Loop through all the blocks.
	foreach ( $post_blocks as $block ) {

		// Only look at the block if it matches the $block_id.
		if ( isset( $block['blockName'] ) && $block_name === $block['blockName'] ) {

			if ( isset( $block['attrs']['data'][ $field_name ] ) ) {
				return $block['attrs']['data'][ $field_name ];
			} else {
				break;  // If we found our block but didn't find the selector, abort the loop.
			}
		}
	}

	// If we got here, we either didn't find the block by ID or we didn't find the selector by name.
	return false;

}
