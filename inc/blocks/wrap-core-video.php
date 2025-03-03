<?php
/**
 * Wrap core embed.
 *
 * @param string $block_content The content of the block (what will render).
 * @param string $block         The block's name.
 */
add_filter( 'render_block', function( $block_content, $block ) {
	if ( ! has_blocks() ) {
		return $block_content;
	}

	$blocks_to_wrap = [
		'core/video',
	];

	foreach ( $blocks_to_wrap as $block_name ) {
		if ( $block_name === $block['blockName'] ) {
			// Find <video> tag and wrap it with <div> tag.
			$html = preg_replace( '/<video\b[^>]*>(.*?)<\/video>/s', '<div class="video-container">$0</div>', $block_content );

			$block_content = $html;
		}
	}

	return $block_content;
}, 10, 2 );
