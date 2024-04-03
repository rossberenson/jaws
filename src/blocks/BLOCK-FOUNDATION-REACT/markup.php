<?php
/**
 * Block markup
 *
 * @var array    $attributes         Block attributes.
 * @var string   $content            Block content.
 * @var WP_Block $block              Block instance.
 * @var array    $context            Block context.
 */

$block_attrs = [
	'class' => 'section is-full',
	'id' 	=> $attributes['anchor'] ?? '',
];
?>
<section <?php echo get_block_wrapper_attributes($block_attrs); // phpcs:ignore ?>>

</section>
