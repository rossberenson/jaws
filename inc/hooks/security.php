<?php
/**
 * Enable or disable certain functionality to harden WordPress.
 */

/**
 * Remove generator meta tags.
 *
 * @see https://developer.wordpress.org/reference/functions/the_generator/
 */
add_filter( 'the_generator', '__return_false' );

/**
 * Disable XML RPC.
 *
 * @see https://developer.wordpress.org/reference/hooks/xmlrpc_enabled/
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Change REST-API header from "null" to "*".
 *
 * @see https://w3c.github.io/webappsec-cors-for-developers/#avoid-returning-access-control-allow-origin-null
 */
// add_action( 'rest_api_init', function() {
// 	header( 'Access-Control-Allow-Origin: *' );
// } );
