<?php
/**
 * Output html tag attributes
 *
 * NOTE: what's the difference between this and formatted?
 * NOTE: should we always be outputting an empty alt?
 *
 * @param   array $attr  Array of Attributes - class, aria, id.
 */
function jaws_get_attributes( $attr = array() ) {

	$return = array();
	foreach ( $attr as $key => $value ) {

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
