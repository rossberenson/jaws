<?php
/**
 * Pretty Print Debug
 *
 * @author Ross Berenson
 *
 * @param mixed $data Data to print.
 */
function pp( $data ) {
	if ( $data ) {
		?>
		<pre>
			<code>
				<?php print_r( $data ); ?>
			</code>
		</pre>
		<?php
	}
}

/**
 * Die and dump some data
 *
 * @author Joshua Dorenkamp
 *
 * @param mixed $data Data to output
 */
function dd( $data, $var_dump = true ) {
	ob_start();
	echo '<pre>';
	if ($var_dump) var_dump($data);
	else print_r($data);
	echo '</pre>';

	wp_die(ob_get_clean());
}
