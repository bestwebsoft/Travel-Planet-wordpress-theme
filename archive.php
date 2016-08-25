<?php
/**
 * The template for displaying Archive pages
 *
 * @link       http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage Travel Planet
 * @since      Travel Planet 1.2
 */
get_header(); ?>
	<div id="container" class="alignleft" role="main">
		<?php if ( have_posts() ) : ?>
			<header>
				<h1 class="trvlplnt-main-header">
					<?php the_archive_title(); ?>
				</h1>
			</header>
			<?php while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
				comments_template( '', true );
			endwhile;
			global $wp_query;
			if ( $wp_query->max_num_pages > 1 ) : ?>
				<nav class="trvlplnt-single-navigation" role="navigation">
					<div class="trvlplnt-nav-previous wrap"><?php previous_posts_link( '&laquo;&nbsp;' . __( 'Previous page', 'travel-planet' ) ); ?></div>
					<div class="trvlplnt-nav-next wrap"><?php next_posts_link( __( 'Next page', 'travel-planet' ) . '&nbsp;&raquo;' ); ?></div>
					<div class="clear"></div>
				</nav><!-- .trvlplnt-single-navigation -->
			<?php endif;
		else : ?>
			<div class="post">
				<h1 class="trvlplnt-main-header"><?php _e( 'Not found any Posts', 'travel-planet' ); ?></h1>
				<div class="trvlplnt-posts round shadow" role="main">
					<header>
						<h2 class="wrap"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'travel-planet' ); ?></h2>
					</header>
					<div class="entry">
						<div class="trvlplnt-text">
							<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'travel-planet' ); ?></p>
						</div>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div> <!-- .trvlplnt-posts -->
			</div> <!-- .post -->
		<?php endif; ?>
	</div><!-- #container -->
<?php get_sidebar();
get_footer();
