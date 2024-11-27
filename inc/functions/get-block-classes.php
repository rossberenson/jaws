<?php
/**
 * Returns an updated array of classes.
 *
 * This is used for the ACF Block Boilerplate
 *
 * @param array $block Array of block attributes.
 *
 * @return array The updated array of classes.
 */
function jaws_get_block_classes( $block ) {
	$block_classes = [];

	if ( ! empty( $block['className'] ) ) :
		$block_classes[] = $block['className'];
	endif;

	if ( ! empty( $block['backgroundColor'] ) ) {
		$block_classes[] = 'has-background';
		$block_classes[] = 'has-' . $block['backgroundColor'] . '-background-color';
	}

	// Gradient check added 12/29/2022 - Ross Berenson.
	if ( ! empty( $block['gradient'] ) ) {
		$block_classes[] = 'has-gradient';
		$block_classes[] = 'has-' . $block['gradient'] . '-gradient-background';
	}

	if ( ! empty( $block['textColor'] ) ) {
		$block_classes[] = 'has-text-color';
		$block_classes[] = 'has-' . $block['textColor'] . '-color';
	}

	// Gradient check added 12/29/2022 - Ross Berenson.
	if ( ! empty( $block['align'] ) ) {
		$block_classes[] = 'is-' . $block['align'];
	}

	return $block_classes;
}
