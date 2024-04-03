<?php
/**
 * Write log to WordPress Debug Log
 *
 * @author Ross Berenson
 *
 * @param mixed $log Data to print.
 */
if ( ! function_exists( 'write_log' ) ) {
	function write_log ( $log )  {
		if ( is_array( $log ) || is_object( $log ) ) {
			error_log( print_r( $log, true ) );
		} else {
			error_log( $log );
		}
	}
}
