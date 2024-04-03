<?php
/**
 * Wrap core embed.
 *
 * @param string $block_content The content of the block (what will render).
 * @param string $block         The block's name.
 */
add_filter( 'render_block', function() {
	$blocks_to_wrap = [
		'core/video',
	];

	foreach ( $blocks_to_wrap as $block_name ) {
		if ( $block_name === $block['blockName'] ) {
			// Find <video> tag and wrap it with <div> tag.
			$auto_play = strpos( $block_content, 'autoplay' );

			$html = preg_replace( '/<video\b[^>]*>(.*?)<\/video>/s', '<div class="video-container">$0 ' . get_video_button_controls( $auto_play ) . '</div>', $block_content );

			$block_content = $html;
		}
	}

	return $block_content;
}, 10, 2 );
