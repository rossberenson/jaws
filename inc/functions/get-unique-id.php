<?php
/**
 * Get Unique ID.
 *
 * @param string $prefix Prefix for the unique ID.
 *
 * @return string Unique ID.
 */
function jaws_get_unique_id( $prefix = '' ) {
	$timestamp  = round( microtime( true ) * 1000 ); // Using Unix time.
	$random_num = wp_rand( 0, 999999 ); // generate random number.
	return $prefix . '-' . $timestamp . $random_num; // combine timestamp and random number to generate the unique ID.
}
