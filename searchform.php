<?php /**
 * The search widget template
 *
 * @subpackage Travel Planet
 * @since Travel Planet 1.2
 */ ?>
<div class="search-box" role="search">
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ) ; ?>/">
		<input class="trvlplnt-search" type="text" value="<?php _e( 'Enter search keyword', 'trvlplnt' ); ?>" onkeydown="setClear(this);" onblur="setDefault(this);" name="s" id="s" maxlength="9999" />
		<input class="trvlplnt-search-button" type="submit" id="searchsubmit" value="" />
	</form>
</div>