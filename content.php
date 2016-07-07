<?php
/**
 * The template for content page
 *
 * @subpackage Travel Planet
 * @since      Travel Planet 1.2
 */ ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'trvlplnt-posts round shadow' ); ?>>
	<header>
		<h2 class="wrap capitalize">
			<?php if ( is_singular() ) {
				the_title();
			} else { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title() ?></a>
			<?php } ?>
		</h2>
	</header>
	<?php if ( ! is_page() ) : ?>
		<p class="postmetadata">
			<?php _e( 'Posted by ', 'travel-planet' );
			the_author_posts_link();
			_e( ' on', 'travel-planet' );
			if ( is_singular() ) {
				$trvlplnt_date_link = get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) );
			} else {
				$trvlplnt_date_link = get_the_permalink();
			} ?>
			<a href="<?php echo esc_url( $trvlplnt_date_link ); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_date(); ?></a>
			<?php if ( has_category() ) :
				echo __( 'in', 'travel-planet' ) . '&nbsp;';
				the_category( ', ' );
			endif; ?>
		</p>
	<?php endif; ?>
	<div class="entry">
		<div class="trvlplnt-text">
			<?php if ( has_post_thumbnail() ) : /*check for thumbnail existing*/ ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'trvlplnt-image-size' ); ?></a>
				<span class="trvlplnt-caption"><?php echo get_post( get_post_thumbnail_id() )->post_excerpt; ?></span>
			<?php endif;
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'travel-planet' ),
				'after'  => '</div>',
			) );
			?>
		</div>
		<div class="clear">
		</div>
		<?php if ( ! is_page() ) : ?>
			<div class="trvlplnt-tags-box">
				<?php if ( get_the_tag_list() ) {
					echo get_the_tag_list( '<hr class="trvlplnt-tags-hr" />', '<span class="tags-coma">, </span>', '' );
				} ?>
			</div>
			<?php edit_post_link( __( 'Edit', 'travel-planet' ), '<p>', '</p>' ); // "Edit" post when login
		endif; ?>
	</div>
</article>
