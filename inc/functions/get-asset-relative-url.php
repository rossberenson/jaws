<?php
/**
 * Get Asset URL
 *
 * NOTE: explode is weird here, why not str_replace to be more clear?
 *
 * @param   array $path   Path of URL.
 *
 * @return  string  Relative URL
 */
function jaws_get_asset_relative_url( $path ) {

	$relative_url = $path;
	$relative_url = explode( site_url(), $relative_url )[1];
	$relative_url = ltrim( $relative_url, '/' );

	return $relative_url;

}
