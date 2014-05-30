<?php /**
 * The footer template
 *
 * @subpackage Travel Planet
 * @since Travel Planet 1.3
 */ ?>
			<div class="clear">
			</div>  
		</section> <!-- #page -->
		<footer id="footer" role="contentinfo">
			<div class="trvlplnt-footer-box">
				<div class="trvlplnt-footer-title alignleft">
					<p>&copy; 2013-<?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?></p>
				</div>
				<div class="trvlplnt-footer-powered alignright">
					<p><?php printf( __( 'Powered by', 'trvlplnt' ) ); ?>
						<a href="<?php echo esc_url( 'https://github.com/bestwebsoft' ); ?>" target="_blank">BestWebSoft</a>
						<?php printf( __( 'and', 'trvlplnt' ) ); ?>
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