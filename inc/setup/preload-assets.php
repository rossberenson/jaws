<?php
/**
 * Preload above the fold assets.
 */
add_action( 'wp_head', function() {
	$logo = false;
	?>
	<?php if ( $logo ) : ?>
		<link rel="preload" href="<?php echo esc_url( $logo ); ?>" as="image">
	<?php endif; ?>
	<?php
}, 1 );
