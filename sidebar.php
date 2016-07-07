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
		the_widget( 'WP_Widget_Search' );
		the_widget( 'WP_Widget_Recent_Posts' );
		the_widget( 'WP_Widget_Recent_Comments' );
		the_widget( 'WP_Widget_Archives' );
		the_widget( 'WP_Widget_Categories' );
	} ?>
</aside>
<div class="clear"></div>
