<?php
	/*
	 * Load redux  core framework
	*/
	if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/core/reduxframework/ReduxCore/framework.php' ) ) {
	    require_once( dirname( __FILE__ ) . '/core/reduxframework/ReduxCore/framework.php' );
	}


	/*
	 * Be sure to rename this function to something more unique
	*/
	function removeDemoModeLink() {
	    if ( class_exists('ReduxFrameworkPlugin') ) {
	        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
	    }
	    if ( class_exists('ReduxFrameworkPlugin') ) {
	        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
	    }
	}
	add_action('init', 'removeDemoModeLink');

	/*
	 * Load Required/Recommended Plugins
	*/
	require_once get_template_directory() . '/framework/plugins_load.php';

	/*
	 * Load apis
	*/
	require_once get_template_directory() . '/framework/apis/pluton_walker.php';
	require_once get_template_directory() . '/framework/apis/pluton_bootstrap_navwalker.php';
	require_once get_template_directory() . '/framework/apis/pluton_icon_font_awesome.php';

	/*
	 * Load theme options
	*/
	require_once get_template_directory() . '/framework/mee_styles_scripts.php';
	require_once get_template_directory() . '/framework/mee_register.php';
	require_once get_template_directory() . '/framework/mee_support.php';
	require_once get_template_directory() . '/framework/mee_functions.php';
	if ( file_exists( dirname( __FILE__ ) . '/mee_options.php' ) ) {
	    require_once( dirname( __FILE__ ) . '/mee_options.php' );
	}

	/*
	 * Meta boxes
	*/
	require_once get_template_directory() . '/framework/custom_post/pluton_metaboxes.php';

	/*
	 * Import demo data
	*/
	require_once get_template_directory() . '/framework/impoter/init.php';