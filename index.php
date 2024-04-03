<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>


	<?php
	if ( have_posts() ) :
		if ( is_home() && ! is_front_page() ) :
			?>
			<header class="entry-header">
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>

			<?php
		endif;

		/* Start the Loop */
		while ( have_posts() ) :
			the_post();

			get_template_part( 'components/content', get_post_type() );

		endwhile;

		jaws_print_numeric_pagination();

	else :
		get_template_part( 'components/content', 'none' );
	endif;
	?>

<?php get_footer(); ?>
