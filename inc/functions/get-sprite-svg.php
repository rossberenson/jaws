<?php
/**
 * Return SVG markup.
 *
 * @param array $args The parameters needed to display the SVG from the svg sprite.
 *
 * @return string Error string or SVG markup.
 */
function jaws_get_sprite_svg( $args = [] ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return esc_attr__( 'Please define default parameters in the form of an array.', 'text-domain' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return esc_attr__( 'Please define an SVG icon filename.', 'text-domain' );
	}

	// Set defaults.
	$defaults = [
		'color'        => '',
		'icon'         => '',
		'title'        => '',
		'desc'         => '',
		'stroke-width' => '',
		'height'       => '',
		'width'        => '',
	];

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Figure out which title to use.
	$block_title = ( $args['title'] ) ? $args['title'] : $args['icon'];

	// Generate random IDs for the title and description.
	$random_number  = wp_rand( 0, 99999 );
	$block_title_id = 'title-' . sanitize_title( $block_title ) . '-' . $random_number;
	$desc_id        = 'desc-' . sanitize_title( $block_title ) . '-' . $random_number;

	// Set ARIA.
	$aria_hidden     = ' aria-hidden="true"';
	$aria_labelledby = '';

	if ( $args['title'] && $args['desc'] ) {
		$aria_labelledby = ' aria-labelledby="' . $block_title_id . ' ' . $desc_id . '"';
		$aria_hidden     = '';
	}

	// Set SVG parameters.
	$color        = ( $args['color'] ) ? ' color="' . $args['color'] . '"' : '';
	$stroke_width = ( $args['stroke-width'] ) ? ' stroke-width="' . $args['stroke-width'] . '"' : '';
	$height       = ( $args['height'] ) ? ' height="' . $args['height'] . '"' : '';
	$width        = ( $args['width'] ) ? ' width="' . $args['width'] . '"' : '';

	// Start a buffer...
	ob_start();
	?>

	<svg
	<?php
		echo esc_attr( $height ?? false );
		echo esc_attr( $width ?? false );
		echo esc_attr( $color ?? false );
		echo esc_attr( $stroke_width ?? false );
	?>
		class="icon <?php echo esc_attr( $args['icon'] ); ?>"
	<?php
		echo esc_attr( $aria_hidden ?? false );
		echo esc_attr( $aria_labelledby ?? false );
	?>
		role="img">
		<title id="<?php echo esc_attr( $block_title_id ); ?>">
			<?php echo esc_html( $block_title ); ?>
		</title>

		<?php
		// Display description if available.
		if ( $args['desc'] ) :
			?>
			<desc id="<?php echo esc_attr( $desc_id ); ?>">
				<?php echo esc_html( $args['desc'] ); ?>
			</desc>
		<?php endif; ?>

		<?php
		// Use absolute path in the Customizer so that icons show up in there.
		if ( is_admin() ) :
			?>
			<use xlink:href="<?php echo esc_url( get_parent_theme_file_uri( '/build/images/icons/sprite.svg#' . esc_html( $args['icon'] ) ) ); ?>"></use>
		<?php else : ?>
			<use xlink:href="#<?php echo esc_html( $args['icon'] ); ?>"></use>
		<?php endif; ?>

	</svg>

	<?php
	// Get the buffer and return.
	return ob_get_clean();
}
