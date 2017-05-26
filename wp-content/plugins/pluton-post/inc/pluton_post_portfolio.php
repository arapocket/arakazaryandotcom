<?php
    /*
     * Register post type portfolio
    */
    function pluton_post_type_portfolio()
    {

        $labels = array(
            'name' 					=> __('Portfolio', 'post type general name', 'pluton'),
            'singular_name' 		=> __('Portfolio', 'post type singular name', 'pluton'),
            'add_new' 				=> __('Add New', 'portfolio', 'pluton'),
            'all_items' 			=> __('All Portfolio', 'pluton'),
            'add_new_item' 			=> __('Add New Portfolio', 'pluton'),
            'edit_item' 			=> __('Edit Portfolio', 'pluton'),
            'new_item' 				=> __('New Portfolio', 'pluton'),
            'view_item' 			=> __('View Portfolio', 'pluton'),
            'search_items' 			=> __('Search Portfolio', 'pluton'),
            'not_found' 			=> __('No Portfolio Found', 'pluton'),
            'not_found_in_trash' 	=> __('No Portfolio Found in Trash', 'pluton'),
            'parent_item_colon' 	=> '',
        );

        $args = array(
            'labels' 			=> $labels,
            'public' 			=> true,
            'show_ui' 			=> true,
            'capability_type' 	=> 'post',
            'taxonomies'          => array( 'portfolio_cats', 'post_tag' ),
            'hierarchical' 		=> false,
            'rewrite' 			=> array('slug' => 'portfolio-view', 'with_front' => true),
            'query_var' 		=> true,
            'show_in_nav_menus' => false,
            'menu_icon' 		=> 'dashicons-list-view',
            'supports' 			=> array('title', 'thumbnail', 'excerpt', 'editor', 'author',),
        );

        register_post_type( 'portfolio' , $args );

        register_taxonomy('portfolio_cats',
            array('portfolio'),
            array(
                'hierarchical' 		=> true,
                'label' 			=> 'Categories',
                'show_admin_column'	=>'true',
                'singular_label' 	=> 'Categories',
                'rewrite' 			=> true,
                'query_var' 		=> true,
            )
        );
    }
    add_action('init', 'pluton_post_type_portfolio');