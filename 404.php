<?php /**
 * The template for 404 page
 *
 * @subpackage Travel Planet
 * @since Travel Planet 1.2
 */
get_header(); ?>
<div id="container" class="alignleft">
	<article class="trvlplnt-posts round shadow" role="main">
		<header>
			<h2 class="wrap"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'trvlplnt' ); ?></h2>
		</header>
		<div class="entry">
			<div class="trvlplnt-text">
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'trvlplnt' ); ?></p>
			</div>	
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</article>
</div><!-- #container -->
<?php get_sidebar(); 
get_footer(); ?>