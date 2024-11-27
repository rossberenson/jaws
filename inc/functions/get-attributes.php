<?php
/**
 * Output html tag attributes
 *
 * @param   array $attr  Array of Attributes - class, aria, id.
 */
function jaws_get_attributes( $attr = array() ) {

	$return = array();
	foreach ( $attr as $key => $value ) {

		// We don't want any of these attributes.
		if ( in_array( $key, [ 'fields', 'template', 'allowed_innerblocks' ], true ) ) {
			continue;
		}

		if ( is_array( $value ) ) {
			$value = implode( ' ', $value );
		}
		if ( ! empty( $value ) || is_numeric( $value ) ) {
			$return[] = esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
		} else {
			if ( 'alt' === $key ) {
				$return[] = esc_attr( $key ) . '=""';
			} else {
				$return[] = esc_attr( $key );
			}
		}
	}

	// phpcs:ignore
	return implode( ' ', $return );
}
