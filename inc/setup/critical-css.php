<?php
/**
 * Inline Critical CSS.
 *
 * @author Corey Collins
 */
add_action( 'wp_head', function() {
	?>
	<style>
		<?php include get_stylesheet_directory() . '/build/critical.css'; ?>
	</style>
	<?php
}, 1 );
