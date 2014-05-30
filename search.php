<?php /**
 * The template for displaying search result
 *
 * @subpackage Travel Planet
 * @since Travel Planet 1.2
 */
get_header(); ?>

<div id="container" class="alignleft" role="main">
	<?php if ( have_posts() ) : ?>
		<header>
			<h1 class="trvlplnt-main-header"><?php printf( __( 'Search Results for:', 'trvlplnt' ) . '&nbsp;%s', '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header>
		<?php while ( have_posts() ) : the_post(); 
			get_template_part( 'content', get_post_format() );
		endwhile;
		do_action( 'trvlplnt_set_page_nav' ); // post pagination 
	else : ?>
		<div class="trvlplnt-posts round shadow">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'trvlplnt' ); ?></h1>
			</header>
			<div class="entry-content">
				<div class="trvlplnt-text">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'trvlplnt' ); ?></p>
				</div><!-- .trvlplnt-text -->
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</div> <!-- .trvlplnt-posts -->
	<?php endif; ?>
</div> <!-- #container -->

<?php get_sidebar(); 
get_footer(); ?>