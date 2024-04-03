<?php
/**
 * Returns a boolean if the style is in the block classes.
 *
 * NOTE: I thought Gutenberg did this already?
 * NOTE: why does this return a bool? Should it be "jaws_is_block_variation?"
 *
 * @param   string $variation    Variation className that you're looking for.
 * @param   array  $classes  Array of block classes.
 *
 * @return  bool            If the style exists in the block classes
 */
function jaws_is_block_variation( $variation, $classes ) {
	$classes = $classes['class'] ?? $classes;

	return in_array( $variation, $classes, true );

}
