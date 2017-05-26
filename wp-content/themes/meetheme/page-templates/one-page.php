<?php
	/**
	* Template Name: OnePage Template
	*
	* @author Pluton
	* @package MeeTheme
	* @since 1.0.0
	*/

	get_header();
	the_post();
	global $meetheme;
?>
	<?php
		wp_nav_menu(
			array(
				'theme_location'    => 'onepage_menu',
				'container'         => false,
                'container_class'   => false,
                'menu_class'        => '',
                'items_wrap'        => '%3$s',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
	            'walker' 			=> new pluton_home_walker()
            )
        );
	?>
<?php get_footer();