<?php
/**
 * Trim the title length.
 *
 * @param array $args Parameters include length and more.
 *
 * @return string The title.
 */
function jaws_get_trimmed_title( $args = [] ) {
	// Set defaults.
	$defaults = [
		'length' => 12,
		'more'   => '...',
	];

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Get the original title.
	$title = get_the_title( get_the_ID() );

	// Trim the title.
	return wp_kses_post( wp_trim_words( $title, $args['length'], $args['more'] ) );
}
