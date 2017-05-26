<?php

  if( !function_exists( 'pluton_get_breadcrumbs' ) ) {

    /*
     * breadcrumbs
    */
    function pluton_get_breadcrumbs()
    {
      $delimiter = '<i class="fa fa-angle-right"></i>';
      $home = 'Home'; // text for the 'Home' link
      $before = '<span class="active_breadcrumbs">'; // tag before the current crumb
      $after = '</span>'; // tag after the current crumb
      $return ='';
      $return .= '<div class="breadcrumbs">';

      global $post;
      $homeLink = get_home_url();
      $return .= '<a class="root" href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

      if ( is_category() ) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0) $return .=(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
        $return .= $before .  single_cat_title('', false) . $after;
      } elseif ( is_day() ) {
        $return .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        $return .= '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
        $return .= $before . get_the_time('d') . $after;
        } elseif ( is_month() ) {
        $return .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        $return .= $before . get_the_time('F') . $after;
      } elseif ( is_year() ) {
        $return .= $before . get_the_time('Y') . $after;
      } elseif ( is_single() && !is_attachment() ) {
        if ( get_post_type() != 'post' ) {
          $post_type = get_post_type_object(get_post_type());
          $slug = $post_type->rewrite;
          $return .= '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
          $return .= $before . get_the_title() . $after;
        } else {
          $cat = get_the_category(); $cat = $cat[0];
          $return .= ' ' . get_category_parents($cat, TRUE, ' ' . $delimiter . ' ') . ' ';
          $return .= $before . get_the_title() . $after;
        }
      } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
        $post_type = get_post_type_object(get_post_type());
        $return .= $before . 'search' . $after;
      } elseif ( is_attachment() ) {
        $parent_id  = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id    = $page->post_parent;
      }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb) $return .= ' ' . $crumb . ' ' . $delimiter . ' ';
        $return .= $before . get_the_title() . $after;
      } elseif ( is_page() && !$post->post_parent ) {
        $return .= $before . get_the_title() . $after;
      } elseif ( is_page() && $post->post_parent ) {
        $parent_id  = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id    = $page->post_parent;
      }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb) $return .= ' ' . $crumb . ' ' . $delimiter . ' ';
        $return .= $before . get_the_title() . $after;
      } elseif ( is_search() ) {
        $return .= $before . 'Search results for "' . get_search_query() . '"' . $after;
      } elseif ( is_tag() ) {
        $return .= $before . 'Archive by tag "' . single_tag_title('', false) . '"' . $after;
      } elseif ( is_author() ) {
        global $author;
        $userdata = get_userdata($author);
        $return .= $before . 'Articles posted by "' . $userdata->display_name . '"' . $after;
      } elseif ( is_404() ) {
        $return .= $before . 'You got it "' . 'Error 404 not Found' . '"&nbsp;' . $after;
      }
      if ( get_query_var('paged') ) {
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $return .= ' (';
          $return .= ('Page') . ' ' . get_query_var('paged');
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $return .= ')';
      }
      $return .= '</div>';

      echo $return;
    }


  }


  if( !function_exists( 'pluton_page_menu' ) ) {

    /*
     * page menu
    */
    function pluton_page_menu()
    {

      $level = 3;
      $args = array(
        'title_li' => '0',
        'sort_column' => 'menu_order',
        'depth' => $level,
      );

      echo '<nav>';
      echo '<ul class="main-menu">';
      echo  wp_list_pages($args);
      echo  '</ul>';
      echo '</nav>';
    }

  }

  if( !function_exists( 'pluton_favicon' ) ) {

    /*
     * favicon
    */
    function  pluton_favicon()
    {
      global $meetheme;
      $favicon = $meetheme['general_favicon']['url'];
      if ($favicon) {
       echo '<link rel="shortcut icon" href="'.$favicon.'" />',"\n";
      }
    }
    add_action('wp_head','pluton_favicon',2);

  }


  if( !function_exists( 'pluton_header_metas' ) ) {

    /*
     * header metas
    */
    function pluton_header_metas()
    {
      echo '<meta name="viewport" content="width=device-width">'."\n";
      echo '<link rel="apple-touch-icon-precomposed" href="apple-touch-icon.png">'."\n";
      echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-57x57.png" />'."\n";
      echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72x72.png" />'."\n";
      echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114x114.png" />'."\n";
    }
    add_action('wp_head', 'pluton_header_metas',1);

  }


  if( !function_exists( 'pluton_get_tracking_code' ) ) {

    /*
     * Get tracking code
    */
    function pluton_get_tracking_code()
    {
      global $meetheme;

      $return ='';
      if( $meetheme['general_js_code'] )
      {
        $return .= stripslashes($meetheme['general_js_code']);
      }

      if( $meetheme['general_tracking_code'] )
      {
        $return .= stripslashes($meetheme['general_tracking_code']);
      }

      echo  '<script type="text/javascript">'.$return.'</script>';
    }
    add_action('wp_head','pluton_get_tracking_code');

  }


  if( !function_exists( 'pluton_ie_js' ) ) {

    /*
     * ie script
    */
    function pluton_ie_js()
    {
      preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
      if (count($matches)>1){
        //Then we're using IE
        $version = $matches[1];

        switch(true){
          case ($version<=8):

             echo '<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em>Upgrade to a different browser or install Google Chrome Frame to experience this site.</p><![endif]-->';
            break;

          case ($version<=9):
          // Jquery html5.js
            wp_register_script( 'html5.js.min.js', PLUTON_JS. '/html5shiv.js', false, PLUTON_THEME_VERSION ,true);
            wp_enqueue_script('html5.js.min.js');
            break;
          case ($version=7):
            wp_register_script( 'icons-lte-ie7', PLUTON_JS. '/fonts/Simple-Line-Icons/icons-lte-ie7.js', false, PLUTON_THEME_VERSION ,true);
            wp_enqueue_script('icons-lte-ie7');
            break;  
          case ($version=8):
          ?>
            <!--[if lt IE 8]>
            <style>
            /* For IE < 8 (trigger haslayout) */
            .clearfix {
                zoom:1;
            }
             8="" (trigger="" haslayout)="" */="" .clearfix="" {="" zoom:1;="" }=""></ 8 (trigger haslayout) */
            .clearfix {
                zoom:1;
            }
            ></style>
            <![endif]-->

          <?php
          break;
          default:
            //You get the idea
        }
      }
    }
    add_action('wp_head', 'pluton_ie_js');

  }


   if( !function_exists( 'pluton_wp_title' ) ) {

   	/*
     * WP title
	*/
 
    function pluton_wp_title( $title, $separator )
    {
      if ( is_feed() )
        return $title;

      global $paged, $page;

      if ( is_search() ) {
        $title = sprintf( esc_html__( 'Search results for %s', 'pluton' ), '"' . get_search_query() . '"' );
        if ( $paged >= 2 )
          $title .= " $separator " . sprintf( esc_html__( 'Page %s', 'pluton' ), $paged );
          $title .= " $separator " . get_bloginfo( 'name', 'display' );
        return $title;
      }

      $title .= get_bloginfo( 'name', 'display' );

      $site_description = get_bloginfo( 'description', 'display' );
      if ( $site_description && ( is_home() || is_front_page() ) )
        $title .= " $separator " . $site_description;

      if ( $paged >= 2 || $paged >= 2 )
        $title .= " $separator " . sprintf( esc_html__( 'Page %s', 'pluton' ), max( $paged, $page ) );

      return $title;
    }
    add_filter( 'wp_title', 'pluton_wp_title', 10, 2 );

  }

  if( !function_exists( 'pluton_get_user_browser' ) ) {

    /*
     * Get User browser
    */
    function pluton_get_user_browser()
    {
      $u_agent = $_SERVER['HTTP_USER_AGENT'];
      $ub = '';
      if(preg_match('/MSIE/i',$u_agent))
      {
          $ub = "ie";
      }
      elseif(preg_match('/Firefox/i',$u_agent))
      {
          $ub = "firefox";
      }
      elseif(preg_match('/Safari/i',$u_agent))
      {
          $ub = "safari";
      }
      elseif(preg_match('/Chrome/i',$u_agent))
      {
          $ub = "chrome";
      }
      elseif(preg_match('/Flock/i',$u_agent))
      {
          $ub = "flock";
      }
      elseif(preg_match('/Opera/i',$u_agent))
      {
          $ub = "opera";
      }

      return $ub;
    }

  }


  if( !function_exists( 'pluton_search_form' ) ) {

    /*
     * Filter Search form
    */
    function pluton_search_form( $form ) {

        $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
          <input type="text" value="" placeholder="Search.." class="search" id="s" name="s">
          <button type="submit" id="submit_btn" class="search-submit"><i class="fi-magnifying-glass small"></i> </button>
        </form>';

        return $form;
    }
    add_filter( 'get_search_form', 'pluton_search_form' );

  }


  if( !function_exists( 'pluton_get_archives_link_custom' ) ) {

    /*
     * get archives link custom
    */
    function pluton_get_archives_link_custom($url) {
      $link = str_replace('<li>', '<li class="cat-item">', $url);
      return $link;
    }
    add_filter('get_archives_link','pluton_get_archives_link_custom');

  }

  if(!( function_exists('pluton_pagination') )){

    /*
     * function pahgination
    */
    function pluton_pagination($pages = '', $range = 2){
      $showitems = ($range * 2)+1;

      global $paged;
      if(empty($paged)) $paged = 1;

      if($pages == ''){
        global $wp_query;
        $pages = $wp_query->max_num_pages;
          if(!$pages) {
            $pages = 1;
          }
      }

      $output = '';

      if(1 != $pages){
        $output .= "<div class='pagination'><ul>";
        if ($paged > 1) {
          // $output .= previous_posts_link( __("prev",'pluton') );
          $output.= '<li>'.get_previous_posts_link( __("prev",'pluton') ).'</li>';
        } else {
          $output.= '<li style="display: none"><a href="#">next</a></li>';
        }
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) $output .= "<li><a href='".get_pagenum_link(1)."'>".__('prev','pluton')."</a></li> ";

        for ($i=1; $i <= $pages; $i++){
          if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
            $output .= ($paged == $i)? "<li class='pagi-active'><a href='".get_pagenum_link($i)."'>".$i."</a></li> ":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li> ";
          }
        }

        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) $output .= "<li><a href='".get_pagenum_link($pages)."'>".__('next','pluton')."</a></li> ";
        if ($paged < $pages) {
          // $output.= next_posts_link( __("next",'pluton') );
          $output.= '<li>'.get_next_posts_link( __("next",'pluton') ).'</li>';
        } else {
          $output.= '<li style="display: none"><a href="#">next</a></li>';
        }
        $output.= "</ul></div>";
      }

      return $output;
    }

  }

  // Hex 2 RGB values
  function pluton_hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);

    return implode(",", $rgb);
  }

  /* Disable WordPress Admin Bar for all users but admins. */

  function pluton_new_excerpt_more( $more ) {
    return '...';
  }
  add_filter('excerpt_more', 'pluton_new_excerpt_more');