<?php /**
 * The template for image attachments
 *
 * @subpackage Travel Planet
 * @since Travel Planet 1.2
 */
get_header(); ?>
<div id="container" class="alignleft" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'trvlplnt-posts round shadow' ); ?>>
			<header>
				<h2 class="wrap capitalize"><?php the_title() ?></h2>
				<p class="postmetadata">
					<?php $metadata = wp_get_attachment_metadata();
					_e( 'Posted on', 'trvlplnt' ); ?>
					<span>
						<time datetime="<?php echo get_the_date( 'j F, Y' ); ?>">
							<a href="<?php the_permalink(); ?>" title="<?php echo get_the_date( 'j F, Y' ); ?>"><?php echo get_the_date('j F, Y'); ?></a>
						</time>
					</span>
					<?php _e( 'at', 'trvlplnt' ); ?>
					<a href="<?php echo esc_url( wp_get_attachment_url() ); ?>" title="<?php _e( 'Link to full-size image', 'trvlplnt' ); ?>">
						<?php echo $metadata['width']; ?> &times; <?php echo $metadata['height']; ?>
					</a>
					<?php _e( 'in', 'trvlplnt' ); ?>
					<a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" title="<?php _e( 'Return to', 'trvlplnt' ); echo '&nbsp' . esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ); ?>" rel="gallery">
						<?php echo get_the_title( $post->post_parent ) . "."; ?>
					</a>
				</p>
			</header>
			<div class="trvlplnt-text">
				<div class="entry-attachment">
					<div class="attachment center">
						<?php /*
						 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
						 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
						 */
						$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
						foreach ( $attachments as $m => $attachment ) :
							if ( $attachment->ID == $post->ID )
								break;
						endforeach;
						$m++;
						// If there is more than 1 attachment in a gallery
						if ( count( $attachments ) > 1 ) :
							if ( isset( $attachments[ $m ] ) ) :
								// get the URL of the next image attachment
								$next_attachment_url = get_attachment_link( $attachments[ $m ]->ID );
							else :
								// or get the URL of the first image attachment
								$next_attachment_url = get_attachment_link( $attachments[0]->ID );
							endif;
						else :
							// or, if there's only 1 image, get the URL of the image
							$next_attachment_url = wp_get_attachment_url();
						endif; ?>
						<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
							<?php /**
							 * Filter the image attachment size to use.
							 *
							 * @param array $size {
							 *     @type int The attachment height in pixels.
							 *     @type int The attachment width in pixels.
							 * }
							 */
							$attachment_size = apply_filters( 'trvlplnt_attachment_size', array( 540, 400, true ) );
							echo wp_get_attachment_image( $post->ID, $attachment_size ); ?>
						</a>
						<?php if ( ! empty( $post->post_excerpt ) ) : ?>
							<div class="wp-caption-text">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>
					</div><!-- .attachment -->
				</div><!-- .entry-attachment -->
				<nav id="trvlplnt-image-navigation" class=".trvlplnt-single-navigation" role="navigation">
					<span class="trvlplnt-nav-previous wrap"><?php previous_image_link( false, '&lsaquo;&lsaquo;&nbsp;' . __( 'Previous', 'trvlplnt' ) ); ?></span>
					<span class="trvlplnt-nav-next wrap"><?php next_image_link( false, __( 'Next', 'trvlplnt' ) . '&nbsp;&rsaquo;&rsaquo;' ); ?></span>
				</nav> <!-- #trvlplnt-image-navigation -->

				<div class="entry-description">
					<?php the_content();
					edit_post_link( __( 'Edit', 'trvlplnt' ), '<p>', '</p>' ); ?>
				</div><!-- .entry-description -->
			</div><!-- .trvlplnt-text -->
		</article><!-- #post -->
		<?php comments_template();
	endwhile; // end of the loop. ?>
</div><!-- #container -->
<?php get_sidebar();
get_footer(); ?>