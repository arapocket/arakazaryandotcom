<?php

	if( !function_exists( 'pluton_load_js' ) ) {

		/*
		 * Load jquery
		*/
		function pluton_load_js()
		{
			if(!is_admin())
			{
				wp_enqueue_script('jquery');

				$scripts = array(
					'jquery.appear',
					'jquery.fitvids',
					'jquery.owl.carousel',
					'progressbar',
					'modernizr.custom',
					'head.min',
					'imagesloaded.min',
					'masonry.min',
					'class_helper',
					'grid_gallery',
					'carousel',
					'jquery.easypiechart',
					'text.rotator',
					'settings',
					'custom'
				);

				foreach($scripts as $script){
					wp_enqueue_script( $script, PLUTON_JS . '/'.$script.'.js', false, PLUTON_THEME_VERSION, true );
				}
			}
			wp_enqueue_script( 'isotope-js',   get_stylesheet_directory_uri() . '/assets/js/isotope.pkgd.min.js', array( 'jquery' ), false, true );
		}
		add_action('wp_enqueue_scripts','pluton_load_js');

	}


	if( !function_exists( 'pluton_load_metabox_styles_scripts' ) ) {

		/*
		 * Load metabox js,css
		*/
		function pluton_load_metabox_styles_scripts()
		{
		    if(is_admin())
		    {
		        wp_register_script('custommetabox', PLUTON_THEME_LIBS_URL . '/core/metaboxes/js/custommetabox.js', false, PLUTON_THEME_VERSION, true);
		        wp_enqueue_script('custommetabox');

		        wp_register_style('font-awesome.min', PLUTON_CSS. '/font-awesome.min.css', false, PLUTON_THEME_VERSION, 'screen');
		    	wp_enqueue_style( 'font-awesome.min' );
		    }
		}
		add_action('admin_enqueue_scripts','pluton_load_metabox_styles_scripts');

	}


	if( !function_exists( 'pluton_load_css' ) ) {

		/*
		 * Load css
		*/
		function pluton_load_css()
		{

			global $meetheme;
			$styles = array(
				'font-awesome',
				'sample-style',
				'owl.carousel',
				'skin',
				'scroll',
				'portfolio',
				'carousel',
				'responsive',
				'custom'
			);

			wp_enqueue_style( 'meetheme-style', get_stylesheet_uri() );

			wp_register_style( 'Roboto-Fonts', '//fonts.googleapis.com/css?family=Roboto:400,300italic,300,100italic,100,400italic,500,500italic,700,900,900italic,700italic%7COswald:400,300,700', false, PLUTON_THEME_VERSION, 'screen');
		    wp_enqueue_style( 'Roboto-Fonts' );
			wp_enqueue_style( 'style', PLUTON_CSS.'/style.css');

			if(isset($meetheme['switch_combine_css']) && $meetheme['switch_combine_css'] == '1'){
				wp_enqueue_style( 'meetheme-combined-css', get_template_directory_uri() . '/assets/combine/do.combine.php?styles='.implode(',', $styles));
			}else {
				foreach($styles as $style){
					wp_enqueue_style( $style, PLUTON_CSS.'/'.$style.'.css');
				}
			}

		}
		add_action("wp_enqueue_scripts",'pluton_load_css');

	}


	if(!function_exists('pluton_load_custom_style')){

		/*
		 * get css custom
		*/
		function pluton_load_custom_style()
		{

		    global $meetheme;

		    $return ='';
		    if(isset($meetheme['general_css_code'])){
		    	$custom_css = $meetheme['general_css_code'];
		    } else {
		    	$custom_css = '';
		    }
		    $return.= $custom_css;

		    wp_add_inline_style( 'meetheme-style', $return );
		}
		add_action( 'wp_enqueue_scripts', 'pluton_load_custom_style' );

	}


	if ( !function_exists('pluton_load_fancybox_styles_scripts') ) {

		function pluton_load_fancybox_styles_scripts ()
		{
		    wp_register_style( 'jquery.fancybox', PLUTON_JS.'/portfolio/source/jquery.fancybox.css', false, PLUTON_THEME_VERSION, 'screen');
		    wp_enqueue_style( 'jquery.fancybox' );

		    wp_register_script('jquery.fancybox', PLUTON_JS . '/portfolio/source/jquery.fancybox.js', false, PLUTON_THEME_VERSION, true);
			wp_enqueue_script( 'jquery.fancybox' );

		    wp_register_script('jquery.fancybox-media', PLUTON_JS . '/portfolio/source/helpers/jquery.fancybox-media.js', false, PLUTON_THEME_VERSION, true);
			wp_enqueue_script( 'jquery.fancybox-media' );
		}
		add_action("wp_enqueue_scripts",'pluton_load_fancybox_styles_scripts');

	}


	if ( !function_exists('pluton_page_scroll_scripts') ) {

		function pluton_page_scroll_scripts ()
		{
		    wp_register_script('jquery.mousewheel', PLUTON_JS . '/jquery.mousewheel.js', false, PLUTON_THEME_VERSION, true);
			wp_enqueue_script( 'jquery.mousewheel' );

			wp_register_script('mwheelIntent', PLUTON_JS . '/mwheelIntent.js', false, PLUTON_THEME_VERSION, true);
			wp_enqueue_script( 'mwheelIntent' );

			wp_register_script('jquery.jscrollpane.min', PLUTON_JS . '/jquery.jscrollpane.min.js', false, PLUTON_THEME_VERSION, true);
			wp_enqueue_script( 'jquery.jscrollpane.min' );

			wp_register_script('jquery.history', PLUTON_JS . '/jquery.history.js', false, PLUTON_THEME_VERSION, true);
			wp_enqueue_script( 'jquery.history' );

			wp_register_script('core.string', PLUTON_JS . '/core.string.js', false, PLUTON_THEME_VERSION, true);
			wp_enqueue_script( 'core.string' );

			wp_register_script('jquery.easing.1.3', PLUTON_JS . '/jquery.easing.1.3.js', false, PLUTON_THEME_VERSION, true);
			wp_enqueue_script( 'jquery.easing.1.3' );

			wp_register_script('jquery.smartresize', PLUTON_JS . '/jquery.smartresize.js', false, PLUTON_THEME_VERSION, true);
			wp_enqueue_script( 'jquery.smartresize' );
		}

	}