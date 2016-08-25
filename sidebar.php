<?php
/**
 * The sidebar containing the main widget area
 *
 * Displays on posts and pages.
 *
 * If no active widgets are in this sidebar, hide it completely.
 *
 * @subpackage Travel Planet
 * @since      Travel Planet 1.2
 */ ?>
<aside id="sidebar" class="alignright" role="complementary">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) {
		dynamic_sidebar( 'sidebar-1' );
	} else {
		$args     = array(
			'before_widget' => '<div class="widget %s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>',
		);
		$instance = array();
		the_widget( 'WP_Widget_Search', $instance, $args );
		the_widget( 'WP_Widget_Recent_Posts', $instance, $args );
		the_widget( 'WP_Widget_Recent_Comments', $instance, $args );
		the_widget( 'WP_Widget_Archives', $instance, $args );
		the_widget( 'WP_Widget_Categories', $instance, $args );
	} ?>
</aside>
<div class="clear"></div>
