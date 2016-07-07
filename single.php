<?php
/**
 * The template for displaying all single posts
 *
 * @subpackage Travel Planet
 * @since      Travel Planet 1.2
 */
get_header(); ?>
	<div id="container" class="alignleft" role="main">
		<?php if ( have_posts() ) :
			the_post();
			get_template_part( 'content', get_post_format() );
			do_action( 'trvlplnt_single_navigation' );
			comments_template( '', true );
		endif; ?>
	</div> <!-- #container -->
<?php get_sidebar();
get_footer();
