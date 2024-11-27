<?php
/**
 * Returns arrays of Block defaults.
 *
 * @param array  $defaults Array of defaults from the block.
 * @param array  $args Array of arguments.
 * @param object $block Object containing the block's values.
 */
function setup_block_defaults( $defaults, $args = [], $block = null ) {
	// Parse the $args.
	if ( ! empty( $args ) ) :
		$defaults = jaws_get_formatted_args( $defaults, $args );
	endif;

	// Get custom classes for the block and/or for block colors.
	$block_classes = isset( $block ) ? jaws_get_block_classes( $block ) : [];

	if ( ! empty( $block_classes ) ) :
		$defaults['class'] = array_merge( $defaults['class'], $block_classes );
	endif;

	// Set up element attributes. href added 1/19/23 Ross Berenson.
	$atts = jaws_get_attributes( $defaults );

	return [ $defaults, $atts ];
}
