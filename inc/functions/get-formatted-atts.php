<?php
/**
 * Formats a given array of attributes into a string of HTML attributes
 *
 * @param array $attr The array of attributes to format.
 *
 * @return string The formatted string of HTML attributes
 */
function jaws_get_formatted_atts( $attr ) {
	$atts_formatted = [];

	foreach ( $attr as $key => $value ) {

		if ( in_array( $key, [ 'fields', 'template', 'allowed_innerblocks' ], true ) ) {
			continue;
		}

		if ( is_array( $value ) ) {
			$value = implode( ' ', $value );
		}
		if ( ! empty( $value ) || is_numeric( $value ) ) {
			$atts_formatted[] = esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
		} else {
			if ( 'alt' === $key ) {
				$atts_formatted[] = esc_attr( $key ) . '=""';
			} else {
				$atts_formatted[] = esc_attr( $key );
			}
		}
	}

	return implode( ' ', $atts_formatted );
}
