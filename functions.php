<?php
/**
 * Travel Planet functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action
 * hook in WordPress to change core functionality.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @subpackage Travel Planet
 * @since      Travel Planet 1.4
 */

/* Travel Planet Theme Setup */
function trvlplnt_theme_setup() {
	/* Sets up the content width value based on the theme's design. */
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}
	/* Makes Travel Planet available for translation.
	   Translations can be added to the /languages/ directory. */
	load_theme_textdomain( 'travel-planet', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	/* Adds RSS feed links to <head> for posts and comments. */
	add_theme_support( 'automatic-feed-links' );
	/* Add theme support for Featured Images */
	add_theme_support( 'post-thumbnails' );
	/* Add theme support for Custom Header */
	$header_args = array(
		'default-image'       => '',
		'width'               => 1920,
		'height'              => 160,
		'flex-width'          => false,
		'flex-height'         => false,
		'random-default'      => false,
		'header-text'         => true,
		'default-text-color'  => '343640',
		'uploads'             => true,
		'admin-head-callback' => 'trvlplnt_admin_header_style',
		'wp-head-callback'    => 'trvlplnt_header_style',
	);
	add_theme_support( 'custom-header', $header_args );
	/* Add theme support for Custom Background */
	$background_args = array(
		'default-color'          => 'f9f9f9',
		'default-image'          => '',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-background', $background_args );
	/* This theme supports all available post formats by default.
	   See http://codex.wordpress.org/Post_Formats */
	add_theme_support( 'post-formats', array(
		'aside',
		'audio',
		'chat',
		'gallery',
		'image',
		'link',
		'quote',
		'status',
		'video',
	) );
	/* Styles the visual editor with editor-style.css */
	add_editor_style();
	/* Travel Planet theme uses wp_nav_menu() in one location. */
	register_nav_menu( 'primary', __( 'Navigation Menu', 'travel-planet' ) );
	/* Set post image size */
	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'trvlplnt-image-size', 540, 400, true );
	} /* Change last argument to 'false' for off crop. */
}/* trvlplnt_theme_setup */

/* Add Styles and scripts */
function trvlplnt_set_js_css() {
	/* Adds JavaScript to pages with the comment form to support sites with
	   threaded comments (when in use). */
	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
	/* Run JQuerry js */
	wp_enqueue_script( 'jquery' );
	/* Add style */
	wp_enqueue_style( 'trvlplnt-style', get_stylesheet_uri(), array(), '' );
	/* Loads the Internet Explorer specific stylesheet. */
	wp_enqueue_style( 'trvlplnt-iestyle', get_template_directory_uri() . '/styles/ie.css', false, null );
	wp_style_add_data( 'trvlplnt-iestyle', 'conditional', 'lt IE 9' );
	/* Run Travel Blog Theme scripts */
	wp_enqueue_script( 'trvlplnt-script', get_template_directory_uri() . '/js/script.js', array(
		'jquery',
		'jquery-ui-core',
		'jquery-effects-core',
		'jquery-effects-drop',
	) );
	/* Loads selectivizr JavaScript file to add support for newest css pseudoclasses. */
	wp_enqueue_script( 'trvlplnt-pseudoclasses-script', get_template_directory_uri() . '/js/selectivizr-min.js', array( 'jquery' ) );
	/* Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. */
	wp_enqueue_script( 'trvlplnt-support-script', get_template_directory_uri() . '/js/html5.js', array( 'jquery' ) );
	/* Travel Blog Js scripts localization */
	$translation_array = array(
		'choose_file'          => __( 'Choose file...', 'travel-planet' ),
		'file_is_not_selected' => __( 'File is not selected.', 'travel-planet' ),
	);
	wp_localize_script( 'trvlplnt-script', 'trvlplnt_localization', $translation_array );
}/* trvlplnt_set_js_css */

/* Run the Breadcrumbs */
function trvlplnt_breadcrumbs() {
	$divider = ' / ';
	echo '<a href= "' . home_url() . '">Home </a>';
	if ( ! is_front_page() ) :
		if ( is_archive() ) :
			if ( is_category() ) :
				$thiscat = get_category( get_query_var( 'cat' ), false );
				echo $divider . __( 'Category:', 'travel-planet' ) . '&nbsp;';
				print_r( $thiscat->name );
			elseif ( is_author() ) :
				echo $divider;
				the_author_posts_link();
			elseif ( is_tag() ) :
				echo $divider . __( 'Tag:', 'travel-planet' ) . '&nbsp;';
				single_tag_title();
			else :
				echo $divider . __( 'Archive for:', 'travel-planet' ) . '&nbsp;';
				wp_title( ' ', true, 'right' );
			endif;
		elseif ( is_single() || is_page() ) :
			$parent = get_ancestors( get_the_ID(), 'page' );
			if ( isset( $parent ) ) :
				$parent = array_reverse( $parent );
				foreach ( $parent as $page ) :
					echo $divider . "<a href='" . get_permalink( $page ) . "'> " . get_the_title( $page ) . '</a>';
				endforeach;
			endif;
			echo $divider . get_the_title();
		elseif ( is_404() ) :
			echo $divider . __( 'Page not found', 'travel-planet' );
		elseif ( is_search() ) :
			echo $divider . __( 'Search results for:', 'travel-planet' ) . '&nbsp;' . get_search_query();
		endif;
	endif;
}

/* Registers main widget area in right sidebars */
function trvlplnt_sidebars() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'travel-planet' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the right sidebar.', 'travel-planet' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	) );
}

/** Custom header
 *
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via custom-header hook in trvlplnt_theme_setup().
 *
 * @since Travel Planet 1.2
 */
function trvlplnt_admin_header_style() {
	wp_enqueue_style( 'trvlplnt-admin', get_template_directory_uri() . '/styles/admin.css', false, null );
}

/* Styles the header text displayed on the blog */
function trvlplnt_header_style() {
	$header_color = get_header_textcolor();
	$display_text = display_header_text(); ?>
	<style type="text/css">
		#header-background { /* Set custom header background */
			background: url('<?php header_image() ?>') no-repeat top center;
		}
	</style>
	<?php /* If no custom options for text are set... */
	if ( HEADER_TEXTCOLOR == $header_color ) {
		return;
	}
	/* If we get this far, we have custom styles... */ ?>
	<style type="text/css">
		<?php if ( 'blank' != $header_color) : ?>
			#site-header a,
			#site-description,
			#trvlplnt-nav-menu a,
			#trvlplnt-nav-menu a:visited,
			#trvlplnt-nav-menu a:hover,
			#trvlplnt-nav-menu a:active {
				color: <?php echo '#' . $header_color; ?> !important;
			}
		<?php endif;
		if ( ! $display_text ) : ?>
			#site-header a,
			#site-description {
				display: none;
			}
		<?php endif; ?>
	</style>
<?php }

/* Adds a slider box to the main column on the Post and Page edit screens. */
function trvlplnt_slider_add_custom_box() {
	$screens = array( 'post', 'page' );
	foreach ( $screens as $screen ) :
		add_meta_box( 'show_on_slider', __( 'Slider', 'travel-planet' ), 'trvlplnt_slider_inner_custom_box', $screen );
	endforeach;
} /* trvlplnt_slider_add_custom_box */

/* Prints the box content. */
function trvlplnt_slider_inner_custom_box( $post ) {
	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'slider_inner_custom_box', 'slider_inner_custom_box_nonce' );
	/*
 	* Use get_post_meta() to retrieve an existing value
 	* from the database and use the value for the form.
 	*/
	$caption  = get_post_meta( $post->ID, '_caption_slider', true );
	$is_check = get_post_meta( $post->ID, '_add_to_slider', true ); ?>
	<div class="check-to-display">
		<input type="checkbox" id="slider-checkbox" name="slider-checkbox"
			<?php checked( $is_check, 'on' ); ?>
					 onchange="document.getElementById( 'slider-caption' ).disabled = this.checked!=true;"
		/> <!-- script for disabling input if checkbox unchecked -->
		<label for="slider-checkbox">
			<?php _e( 'Do you wish to add this post to slider?', 'travel-planet' ); ?>
			<br /><b>
				<?php _e( 'Notice', 'travel-planet' ); ?>
			</b>:&nbsp;
			<?php _e( 'the featured picture must be 940px width to 315px height or bigger for best performance.', 'travel-planet' ); ?>
		</label>
	</div>
	<label class="slider-caption" for="slider-caption">
		<?php _e( 'Caption for post in slider:', 'travel-planet' ); ?>
	</label>
	<input type="text" id="slider-caption" name="slider-caption" value="<?php esc_attr( $caption ) ?>" maxlength="999" size="107" />
<?php } /* trvlplnt_slider_inner_custom_box */

/* When the post is saved, saves our custom data. */
function trvlplnt_slider_save_postdata( $post_id ) {
	/*
	 * We need to verify this came from the our screen and with proper authorization,
	 * because save_post can be triggered at other times.
	 */
	/* Check if our nonce is set. */
	if ( ! isset( $_POST['slider_inner_custom_box_nonce'] ) ) {
		return $post_id;
	}
	$nonce = $_POST['slider_inner_custom_box_nonce'];
	/* If this is an autosave, our form has not been submitted, so we don't want to do anything. */
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	/* OK, its safe for us to save the data now.
	   Sanitize user input. */
	$trvlplnt_data_caption = sanitize_text_field( $_POST['slider-caption'] );
	$trvlplnt_data_check   = sanitize_text_field( $_POST['slider-checkbox'] );
	/* Update the meta field in the database. */
	update_post_meta( $post_id, '_caption_slider', $trvlplnt_data_caption );
	update_post_meta( $post_id, '_add_to_slider', $trvlplnt_data_check );
}

/**
 * Slider checked post and pages
 * @return void
 */
function trvlplnt_slider() {
	$the_query = new WP_Query( array(
		'post_type'      => array( 'post', 'page' ),
		'meta_key'       => '_add_to_slider',
		'meta_value'     => 'on',
		'posts_per_page' => '100',
		'ignore_sticky_posts' => 1,
		'meta_query' => array(
			array(
				'key'     => '_thumbnail_id',
				'compare' => 'EXISTS',
			),
		),
	) );
	$slider_count = count( $the_query->posts );
	// The Loop
	if ( $the_query->have_posts() && $slider_count >= 1 ) : ?>
		<div class="trvlplnt-slider-box">
			<?php if ( $slider_count >= 2 ) : ?>
				<div class="trvlplnt-slider-to-left alignleft"></div>
					<div class="alignleft">
						<div class="trvlplnt-slider alignleft"> <!-- Float for IE. If slider arrow exist - alignleft. -->
			<?php else : ?>
				<div class="trvlplnt-slider"> <!-- Float for IE. Else float none. -->
			<?php endif;
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				if ( get_the_post_thumbnail( get_the_ID(), 'slide' ) ) : ?>
					<div style="margin: 0px auto;">
						<?php echo get_the_post_thumbnail( get_the_ID(), 'slide' ); ?>
						<div class="trvlplnt-slider-description">
							<h3 class="trvlplnt-slider-title">
								<a class="trvlplnt-slider-anch" href="<?php echo get_permalink(); ?>">
									<?php echo get_the_title(); ?>
								</a>
							</h3>
							<p class="trvlplnt-slider-text">
								<?php echo get_post_meta( get_the_ID(), '_caption_slider', true ); ?>
							</p>
						</div>
					</div>
				<?php endif;
			endwhile;
			if ( $slider_count >= 2 ) : ?>
					</div>
				</div>
				<div class="trvlplnt-slider-to-right alignleft"></div>
				<div style="clear: both;"></div>
			<?php else : ?>
				</div> <!-- Float for IE. Else float none. -->
			<?php endif; ?>
		</div>
	<?php endif;
	/* Restore original Post Data */
	wp_reset_postdata();
}

/* Pagination */
function trvlplnt_page_nav() {
	global $wp_query;
	$max = $wp_query->max_num_pages;
	if ( ! $pagecurrent = get_query_var( 'paged' ) ) {
		$pagecurrent = 1;
	}
	$n = array(
		'base'      => str_replace( 999999, '%#%', get_pagenum_link( 999999 ) ),
		'total'     => $max,
		'current'   => $pagecurrent,
		'mid_size'  => 2, /* How many pages before and after current page. */
		'end_size'  => 0, /* How many pages at start and at the end. */
		'prev_text' => '&laquo;',
		'next_text' => '&raquo;',
	);
	if ( $max > 1 ) {
		echo '<div class="page-navigation">' . paginate_links( $n ) . '</div>';
	}
}

/* Adds caption for thumbnail picture */
function trvlplnt_thumbnail_caption() {
	global $post;
	$thumb_id        = get_post_thumbnail_id( $post->ID );
	$post_args       = array(
		'post_type'   => 'attachment',
		'post_status' => null,
		'post_parent' => $post->ID,
		'include'     => $thumb_id,
	);
	$thumbnail_image = get_posts( $post_args );
	if ( $thumbnail_image && isset( $thumbnail_image[0] ) ) {
		echo '<span class="trvlplnt-caption">' . $thumbnail_image[0]->post_excerpt . '</span>';
	}
}

/* Travel Planet single navigation */
function trvlplnt_single_navigation() { ?>
	<nav class="trvlplnt-single-navigation" role="navigation">
		<span class="trvlplnt-nav-previous wrap"><?php previous_post_link( '%link', '&lsaquo;&lsaquo;&nbsp;' . '%title' ); ?></span>
		<span class="trvlplnt-nav-next wrap"><?php next_post_link( '%link', '%title' . '&nbsp;&rsaquo;&rsaquo;' ); ?></span>
	</nav><!-- .trvlplnt-single-navigation -->
<?php }/* trvlplnt_single_navigation */

/* Actions */
add_action( 'after_setup_theme', 'trvlplnt_theme_setup' );
/* Add js scripts and css styles. */
add_action( 'wp_enqueue_scripts', 'trvlplnt_set_js_css' );
/* Add breadcrumbs script. */
add_action( 'trvlplnt_set_breadcrumbs', 'trvlplnt_breadcrumbs' );
add_action( 'widgets_init', 'trvlplnt_sidebars' );
/* Add slider. */
add_action( 'add_meta_boxes', 'trvlplnt_slider_add_custom_box' );
add_action( 'save_post', 'trvlplnt_slider_save_postdata' );
add_action( 'trvlplnt_set_slider', 'trvlplnt_slider' );
/* Add page numeric navigation. */
add_action( 'trvlplnt_set_page_nav', 'trvlplnt_page_nav' );
add_action( 'trvlplnt_set_thumbnail_caption', 'trvlplnt_thumbnail_caption' );
add_action( 'trvlplnt_single_navigation', 'trvlplnt_single_navigation' );
