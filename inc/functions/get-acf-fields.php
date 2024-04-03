<?php
/**
 * Returns an array of ACF fields.
 *
 * NOTE: we should make this fallback to grabbing `wp_post_meta` if the ACF plugin ever fails
 * NOTE: should this always return an array?
 *
 * @author Adam Bates <adam.bates@webdevstudios.com>
 *
 * @param array $fields Array of field names ie: [ 'layout', 'eyebrow_heading', 'content', 'heading' ].
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
