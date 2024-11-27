<?php
/**
 * Returns a boolean if the style is in the block classes.
 *
 * @param   string $style    Style name that  you're looking for.
 * @param   array  $classes  Array of block classes.
 *
 * @return  bool            If the style exists in the block classes
 */
function jaws_is_block_style( $style, $classes ) {
	$classes = $classes['class'] ?? $classes;

	return in_array( "is-style-$style", $classes, true );

}
