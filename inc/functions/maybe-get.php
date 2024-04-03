<?php
/**
 * Get the value if the key in the array exists.
 *
 * NOTE: we don't need this function,
 * unless we want to expand it's functionality
 * coalescing operators solve the need for this
 *
 * @param   array  $array   Array.
 * @param   string $key     Key.
 * @param   string $default Default value if key doesn't exist.
 *
 * @return  mixed         Value
 */
function maybe_get( $array = array(), $key = 0, $default = null ) {
	return isset( $array[ $key ] ) ? $array[ $key ] : $default;
}
