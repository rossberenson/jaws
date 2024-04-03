<?php
/**
 * Output html tag attributes
 *
 * @param   array $attr  Array of Attributes - class, aria, id.
 */
function jaws_print_attributes( $attr = array() ) {
	// phpcs:ignore
	echo jaws_get_attributes( $attr );
}
