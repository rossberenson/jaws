<?php
/**
 * Get Parent Block
 *
 * @param   interger $post_id         Post ID.
 * @param   array    $context         Block Context.
 * @param   blockID  $child_block_id  ID of the block.
 *
 * @return  string                   Parent Block
 */
function jaws_get_block_parent( $post_id, $context, $child_block_id = '' ) {

	// If the post object doesn't even have any blocks, abort early and return false.
	if ( ! has_blocks( $post_id ) ) {
		return false;
	}

	// Get our blocks from the post content of the post we're interested in.
	$post_blocks = parse_blocks( get_the_content( '', false, $post_id ) );

	$parent_block = null;

	// Loop through all the blocks.
	foreach ( $post_blocks as $block ) {
		// Detect blocks that have inner blocks.
		$inner_blocks = $block['innerBlocks'] ?? false;

		// Continue if there are inner blocks only.
		if ( ! $inner_blocks ) {
			continue;
		}

		// Loop through the inner blocks looking for the matching ID.
		// Once found, tell us the parent block!
		foreach ( $inner_blocks as $inner_block ) {
			// Generate block ID.
			$block_id = jaws_generate_block_id( $inner_block['attrs'], $context );

			if ( $block_id === $child_block_id ) {
				$parent_block = $block['blockName'];
				break;
			}
		}
	}

	return $parent_block;
}
