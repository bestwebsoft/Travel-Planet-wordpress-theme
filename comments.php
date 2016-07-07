<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @link       http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage Travel Planet
 * @since      Travel Planet 1.2
 */
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
if ( have_comments() || comments_open() ) : ?>
	<article class="trvlplnt-comments round shadow" id="trvlplnt-comments">
		<div class="entry">
			<div class="trvlplnt-text">
				<?php if ( have_comments() ) : ?>
					<h3>
						<?php printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(),'travel-planet' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?>
					</h3>
					<ol class="trvlplnt-comment">
						<?php wp_list_comments(); ?>
					</ol> <!-- .trvlplnt-comment -->
					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
						<nav class="comment-navigation" role="navigation">
							<div class="trvlplnt-nav-previous">
								<?php previous_comments_link( '&larr;&nbsp;' . __( 'Older comments', 'travel-planet' ) ); ?>
							</div>
							<div class="trvlplnt-nav-next">
								<?php next_comments_link( __( 'Newer comments', 'travel-planet' ) . '&nbsp;&rarr;' ); ?>
							</div>
						</nav><!-- .comment-navigation -->
					<?php endif; // Check for comment navigation
				endif;
				if ( ! comments_open() && get_comments_number() ) : ?>
					<p class="no-comments">
						<?php _e( 'Comments are closed.', 'travel-planet' ); ?>
					</p>
				<?php endif;
				comment_form(); ?>
			</div>
		</div>
	</article><!-- #trvlplnt-comments -->
<?php endif;
