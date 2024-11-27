<?php
/**
 * Returns an array of ACF fields.
 *
 * TO DOS: If only one field, return the value directly instead of an array?
 *
 * @author Adam Bates <adam.bates@webdevstudios.com>
 *
 * @param array $fields Array of field names ie: [ 'section_title', 'section_teaser', 'bait', 'fish' ].
 * @param int   $id (optional) ID of the post or of the block ($block[id]).
 *
 * @return array|false
 */
function jaws_get_acf_fields( $fields = [], $id = false ) {

	if ( ! function_exists( 'get_field' ) ) :
		return false;
	endif;

	$id            = $id ? $id : get_the_ID();
	$return_fields = [];
	foreach ( $fields as $field ) :
		$value                   = get_field( $field, $id );
		$return_fields[ $field ] = $value;
	endforeach;

	return $return_fields;
}
