<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.

 */
add_action( 'after_setup_theme', function() {
	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'text-domain', get_template_directory() . '/build/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'image-crop', 1920, 1080, false );

	// Register navigation menus.
	register_nav_menus(
		[
			'primary' => esc_html__( 'Primary Menu', 'text-domain' ),
			'footer'  => esc_html__( 'Footer Menu', 'text-domain' ),
		]
	);

	/**
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		[
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		]
	);

	// Gutenberg support for full-width/wide alignment of supported blocks.
	add_theme_support( 'align-wide' );

	// Gutenberg editor styles support.
	add_theme_support( 'editor-styles' );
	add_editor_style( 'build/index.css' );

	// Gutenberg responsive embed support.
	add_theme_support( 'responsive-embeds' );

	// Add opotion pages.
	// if ( function_exists( 'acf_add_options_page' ) ) {

	// 	acf_add_options_page(
	// 		array(
	// 			'page_title' => 'Theme Settings',
	// 			'menu_title' => 'Theme Settings',
	// 			'menu_slug'  => 'theme-settings',
	// 			'capability' => 'edit_posts',
	// 			'redirect'   => false,
	// 		)
	// 	);
	// }
} );
