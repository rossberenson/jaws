<?php
/**
 * Customize the [...] on the_excerpt();
 *
 * @param string $more The current $more string.
 *
 * @return string Read more link.
 */
add_filter( 'excerpt_more', function($more) {
	return sprintf( ' <a class="more-link" href="%1$s">%2$s</a>', get_permalink( get_the_ID() ), esc_html__( 'Read more...', 'text-domain' ) );
});
