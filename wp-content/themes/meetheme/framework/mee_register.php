<?php

	global $meetheme;

	/*
	* register navigation menus
	*/
	register_nav_menus(
		array(
		  'onepage_menu'  => __('Onepage Menu','pluton'),
		  'main_menu'     => __('Main Menu','pluton'),
		)
	);

    if ( !function_exists('pluton_widgets_init')){

		function pluton_widgets_init(){
			/*
			 * Register sidebar
			*/
			register_sidebar(
				array(
					'name' => str_replace("_"," ",'Primary Sidebar'),
					'id'            => 'primary',
				    'description' => esc_html__( 'This is land of page sidebar','pluton' ),
					'before_title' =>'<h3 class="sidebar-title">',
					'after_title' =>'</h3>',
					'before_widget' => '<div  id="%1$s" class="widget sidebar-block %2$s">',
					'after_widget' => '</div>',
				)
			);
			register_sidebar(
				array(
					'name' => str_replace("_"," ",'Page Sidebar'),
					'id'            => 'page',
				    'description' => esc_html__( 'This is land of page sidebar','pluton' ),
					'before_title' =>'<h3 class="sidebar-title">',
					'after_title' =>'</h3>',
					'before_widget' => '<div  id="%1$s" class="widget sidebar-block %2$s">',
					'after_widget' => '</div>',
				)
			);
		}
		add_action( 'widgets_init', 'pluton_widgets_init' );

	}