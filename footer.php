<?php
/**
 * The footer template
 *
 * @subpackage Travel Planet
 * @since      Travel Planet 1.3
 */ ?>
<div class="clear"></div>
</section> <!-- #page -->
<footer id="footer" role="contentinfo">
	<div class="trvlplnt-footer-box">
		<div class="trvlplnt-footer-title alignleft">
			<p>&copy; 2013-<?php echo date_i18n( 'Y ' ) . get_bloginfo( 'name' ); ?></p>
		</div>
		<div class="trvlplnt-footer-powered alignright">
			<p><?php _e( 'Powered by', 'travel-planet' ); ?>
				<a href="<?php echo esc_url( wp_get_theme()->get( 'AuthorURI' ) ); ?>" target="_blank">BestWebLayout</a>
				<?php _e( 'and', 'travel-planet' ); ?>
				<a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" target="_blank">WordPress</a>
			</p>
		</div> <!-- .trvlplnt-footer-powered -->
		<div class="clear">
		</div>
	</div> <!-- .trvlplnt-footer-box -->
</footer> <!-- #footer -->
</div> <!-- #wrapper -->
<?php wp_footer(); ?>
</body>
</html>
