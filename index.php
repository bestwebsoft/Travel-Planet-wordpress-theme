<?php /**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 *
 * @subpackage Travel Planet
 * @since Travel Planet 1.2
 */
get_header(); ?>
<div id="container" class="alignleft" role="main">
	<?php if ( have_posts() ) :
		while( have_posts() ) : 
			the_post(); 
			get_template_part( 'content', get_post_format() );
			comments_template( '', true ); 
		endwhile; ?>
		<div class="page-navigation">
 			<?php do_action( 'trvlplnt_set_page_nav' ); ?>
		</div><!-- .navigation -->
	<?php else: ?>
		<div class="post">
			<h1 class="trvlplnt-main-header"><?php _e( 'Not found any Posts', 'trvlplnt' ); ?></h1>
			<div class="trvlplnt-posts round shadow" role="main">
				<header>
					<h2 class="wrap"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'trvlplnt' ); ?></h2>
				</header>
				<div class="entry">
					<div class="trvlplnt-text">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'trvlplnt' ); ?></p>
					</div>	
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</div> <!-- .trvlplnt-posts -->
		</div> <!-- .post -->
	<?php endif; ?>
</div> <!-- #container -->
<?php get_sidebar();
get_footer(); ?>