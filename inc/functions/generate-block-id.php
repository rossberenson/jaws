<?php
/**
 * Get ACF Block ID
 *
 * @param   array $attrs   Block Attributes.
 * @param   array $context Block Context.
 *
 * @return  string                   Block ID
 */
function jaws_generate_block_id( $attrs, $context ) {

	if ( ! function_exists( 'acf_get_block_id' ) ) :
		return;
	endif;

	$block_id = 'block_' . acf_get_block_id( $attrs, $context );

	return $block_id;

}
