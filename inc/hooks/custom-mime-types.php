<?php
/**
 * Enable custom mime types.
 *
 * @param array $mimes Current allowed mime types.
 *
 * @return array Mime types.
 */
add_filter( 'upload_mimes', function($mimes) {

	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';

	return $mimes;
});
