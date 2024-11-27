<?php
/**
 * Print Block Preview Image.
 *
 * @param   string $block_directory Directory of block location.
 * @param   string $alt              Alt text for image.
 * @param   string $filename         Filename of image if different than preview.jpg.
 */
function jaws_print_block_preview( $block_directory, $alt, $filename = 'preview.jpg' ) {
	?>
	<figure>
		<img
			src="<?php echo esc_url( get_template_directory_uri() . "/build/blocks/$block_directory/$filename" ); ?>"
			alt="<?php esc_html( $alt ); ?>"
		>
	</figure>
	<?php
}
