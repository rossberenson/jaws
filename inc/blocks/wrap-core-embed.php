<?php
/**
 * Wrap core embed.
 *
 * @param string $block_content The content of the block (what will render).
 * @param string $block         The block's name.
 */
add_filter( 'render_block', function($block_content, $block) {
	if ( ! has_blocks() ) {
		return $block_content;
	}

	$blocks_to_wrap = [
		'core/embed',
	];

	foreach ( $blocks_to_wrap as $block_name ) {
		if ( $block_name === $block['blockName'] ) {

			$iframe = $block_content;

			if ( $iframe ) {
				preg_match( '/src="(.+?)"/', $iframe, $matches );
				$src = $matches[1];

				$params = array(
					'controls' => 0,
				// 'hd'        => 1,
				// 'autohide'  => 1,
				// 'autopause' => 1,
				);

				$new_src = add_query_arg( $params, $src );
				$iframe  = str_replace( $src, $new_src, $iframe );

				// Add extra attributes to iframe HTML.
				$attributes    = 'frameborder="0"';
				$block_content = str_replace( '></iframe>', ' ' . $attributes . '></iframe>', $iframe );

				$html  = '<div class="video-container wp-block-core-embed">';
				$html .= $block_content;
				$html .= '</div>';

				$block_content = $html;

			}
		}
	}

	return $block_content;
}, 10, 2 );
