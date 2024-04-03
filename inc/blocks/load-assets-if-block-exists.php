<?php
/**
 * Load block assets only if the block exists on the page.
 *
 * @see https://developer.wordpress.org/reference/hooks/should_load_separate_core_block_assets/
 */
add_filter( 'should_load_separate_core_block_assets', '__return_true' );
