<?php
/**
 * Enqueue front-end scripts and styles.
 */
add_action( 'wp_enqueue_scripts', function() {
	$asset_file_path = get_template_directory() . '/build/index.asset.php';

	if ( is_readable( $asset_file_path ) ) {
		$asset_file = include $asset_file_path;
	} else {
		$asset_file = [
			'version'      => '1.0.0',
			'dependencies' => [ 'wp-polyfill' ],
		];
	}

	// Register styles & scripts.
	wp_enqueue_style( 'jaws-styles', get_stylesheet_directory_uri() . '/build/index.css', [], $asset_file['version'] );

	wp_enqueue_script( 'jaws-scripts', get_stylesheet_directory_uri() . '/build/index.js', $asset_file['dependencies'], $asset_file['version'], true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
});

/**
 * Enqueue admin scripts and styles.
 */
add_action( 'admin_enqueue_scripts', function() {
	$asset_file_path = get_template_directory() . '/build/admin.asset.php';

	if ( is_readable( $asset_file_path ) ) {
		$asset_file = include $asset_file_path;
	} else {
		$asset_file = [
			'version'      => '1.0.0',
			'dependencies' => [ 'wp-polyfill' ],
		];
	}

	wp_enqueue_style( 'jaws-admin-styles', get_stylesheet_directory_uri() . '/build/admin.css', [], $asset_file['version'] );

	// Register styles & scripts.
	wp_enqueue_script( 'jaws-admin-scripts', get_stylesheet_directory_uri() . '/build/admin.js', $asset_file['dependencies'], $asset_file['version'], true );
});

/**
 * Dequeue WordPress core Block Library styles.
 */
add_action( 'wp_enqueue_scripts', function() {
	// This will remove the inline styles for the following core blocks.
	$block_styles_to_remove = [
		'heading',
		'paragraph',
		'table',
		'list',
	];

	foreach ( $block_styles_to_remove as $block_style ) {
		wp_deregister_style( 'wp-block-' . $block_style );
	}
} );
