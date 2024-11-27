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
