<?php
/**
 * BLOCK - Block Template
 *
 * @link https://developer.wordpress.org/block-editor/
 */

$block = isset( $block ) ? $block : '';
$args  = isset( $args ) ? $args : '';

// Pull in the fields from ACF.
$block_data = jaws_get_acf_fields( [ 'ARRAY_OF_ACF_FIELD_NAMES_HERE' ], $block['id'] );


$defaults = [
	'class' => [ 'section', 'block-BLOCK-NAME' ],
	'id'    => ( isset( $block ) && ! empty( $block['anchor'] ) ) ? $block['anchor'] : '',
];

// Returns updated $defaults array with classes from Gutenberg.
// Returns formatted attributes as $atts array.
// phpcs:ignore
[ $defaults, $atts ] = jaws_setup_block_defaults( $defaults, $args, $block );

?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

	<?php jaws_print_block_preview( basename( dirname( __FILE__ ) ), __( 'Preview of the BLOCK NAME', 'text-domain' ) ); ?>

<?php else : ?>
	<section
		<?php echo $atts; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		BLOCK CONTENT HERE
	</section>
<?php endif; ?>
