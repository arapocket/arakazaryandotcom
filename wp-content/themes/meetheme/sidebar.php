<?php
	/**
	* sidebar.php
	* The main post loop in MeeTheme
	* @author Pluton
	* @package MeeTheme
	* @since 1.0.0
	*/
?>
<?php if ( is_active_sidebar( 'primary' ) ) : ?>
    <div id="sidebar" class="col-md-3 col-sm-4">
    	<?php dynamic_sidebar( 'Primary Sidebar' ); ?>
    </div>
<?php endif;