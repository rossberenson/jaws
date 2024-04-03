<?php
/**
 * Registers block categories with Gutenberg.
 */

add_filter(
	'block_categories_all',
	function( $categories ) {

		$categories[] = array(
			'slug'  => 'clientName-page-headers',
			'title' => 'ClientName Page Headers',
		);
		$categories[] = array(
			'slug'  => 'clientName-sections',
			'title' => 'ClientName Sections',
		);
		$categories[] = array(
			'slug'  => 'clientName-components',
			'title' => 'ClientName Components',
		);

		return $categories;
	}
);
