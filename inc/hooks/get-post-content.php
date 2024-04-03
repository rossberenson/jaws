<?php
/**
 * Filters WYSIWYG content with the_content filter.
 *
 * @param string $content content dump from WYSIWYG.
 *
 * @return string|bool Content string if content exists, else empty.
 */
add_filter(
	'the_content',
	function() {
		return ! empty( $content ) ? $content : false;
	},
	20
);
