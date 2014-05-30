<?php /**
 * The sidebar containing the main widget area
 *
 * Displays on posts and pages.
 *
 * If no active widgets are in this sidebar, hide it completely.
 *
 * @subpackage Travel Planet
 * @since Travel Planet 1.2
 */ ?>
<aside id="sidebar" class="alignright" role="complementary">
	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : 
		the_widget( 'WP_Widget_Search' );
		the_widget( 'WP_Widget_Recent_Posts' );
		the_widget( 'WP_Widget_Recent_Comments' );
		the_widget( 'WP_Widget_Archives' );
		the_widget( 'WP_Widget_Categories' );
	endif; ?>
</aside>
<div class="clear">
</div>