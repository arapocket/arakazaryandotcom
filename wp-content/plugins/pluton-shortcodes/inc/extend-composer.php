<?php
if (class_exists('Vc_Manager')) {

  $add_css_animation = array(
    "type" => "dropdown",
    "heading" => __("CSS Animation", 'pluton'),
    "param_name" => "css_animation",
    "admin_label" => true,
    "value" => array(__("No", 'pluton') => '', __("Top to bottom", 'pluton') => "top-to-bottom", __("Bottom to top", 'pluton') => "bottom-to-top", __("Left to right", 'pluton') => "left-to-right", __("Right to left", 'pluton') => "right-to-left", __("Appear from center", 'pluton') => "appear"),
    "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", 'pluton')
  );


  if(function_exists('vc_add_param')) {
     vc_add_param('vc_column_inner', $add_css_animation);
  }

  if (function_exists('vc_map')) {
    if(!function_exists('pluton_shortcode_visual_composer')){
      add_action( 'init', 'pluton_shortcode_visual_composer' );
      function pluton_shortcode_visual_composer(){

        global $pluton_bootstrap_icon_vc, $pluton_icon_font_vc;
        // Custom Map
        vc_map( array(
          "name" => __("Row", "js_composer"),
          "base" => "vc_row",
          "is_container" => true,
          "icon" => "icon-wpb-row",
          "show_settings_on_create" => true,
          "category" => __('Content', 'js_composer'),
          "description" => __('Place content elements inside the row', 'js_composer'),
          "params" => array(
            array(
              "type" => "textfield",
              "heading" => __("ID Name for Navigation", "js_composer"),
              "param_name" => "dt_id",
              "description" => __("If this row wraps the content of one of your sections, set an ID. You can then use it for navigation. Ex: work", "js_composer")
            ),
             array(
              "type" => "attach_image",
              "heading" => __("Background Image", "js_composer"),
              "param_name" => "bg_image",
              "description" => __("Select backgound color for the row.", "js_composer")
            ),
            array(
              "type" => "dropdown",
              "heading" => __('Background Repeat', 'js_composer'),
              "param_name" => "dt_bg_repeat",
              "value" => array(
                __("Repeat-Y", 'js_composer') => 'repeat-y',
                __("Repeat", 'js_composer') => 'repeat',
                __('No Repeat', 'js_composer') => 'no-repeat',
                __('Repeat-X', 'js_composer') => 'repeat-x'
              )
            ),
            array(
              "type" => "colorpicker",
              "heading" => __('Background Color', 'js_composer'),
              "param_name" => "bg_color",
              "description" => __("You can set a color over the background image. You can make it more or less opaque, by using the next setting. Default: white ", "js_composer")
            ),
            array(
              "type" => "textfield",
              "heading" => __('Background Color Opacity', 'js_composer'),
              "param_name" => "dt_color_opacity",
              "description" => __("Set an opacity value for the color(values between 0-100). 0 means no color while 100 means solid color. Default: 70 ", "js_composer")
            ),
            array(
              "type" => "dropdown",
              "heading" => __('Text Color Scheme', 'js_composer'),
              "param_name" => "dt_text_scheme",
              "description" => __("Pick a color scheme for the content text. 'Light Text' looks good on dark bg images while 'Dark Text' looks good on light images.", "js_composer"),
              "value" => array(
                __("Dark Text", 'js_composer') => 'lighter-overlay',
                __("Light Text", 'js_composer') => 'darker-overlay'
              )
            ),
            array(
              "type" => "textfield",
              "heading" => __("Padding Top", "js_composer"),
              "param_name" => "dt_padding_top",
              "description" => __("Enter a value and it will be used for padding-top(px). As an alternative, use the 'Space' element.", "js_composer")
            ),
            array(
              "type" => "textfield",
              "heading" => __("Padding Bottom", "js_composer"),
              "param_name" => "dt_padding_bottom",
              "description" => __("Enter a value and it will be used for padding-bottom(px). As an alternative, use the 'Space' element.", "js_composer")
            ),
            array(
              "type" => "dropdown",
              "heading" => __('Remove margin bottom?', 'js_composer'),
              "param_name" => "dt_no_mb",
              "description" => __("The row has a bottom margin of 20px. You can remove it.", "js_composer"),
              "value" => array(
                __("No thanks!", 'js_composer') => '',
                __("Yes Please!", 'js_composer') => 'no-margin'
              )
            ),
            array(
              "type" => "textfield",
              "heading" => __("Extra class name", "js_composer"),
              "param_name" => "dt_class",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
            ),
            array(
              "type" => "dropdown",
              "heading" => __('Type', 'js_composer'),
              "param_name" => "dt_row_type",
              "description" => __("You can specify whether the row is displayed fullwidth or in container.", "js_composer"),
              "value" => array(
                __("In Container", 'js_composer') => 'container',
                __("Fullwidth", 'js_composer')    => 'container_full',
                __("Parallax", 'js_composer')     => 'photo_divider'
              )
            ),
          ),
          "js_view" => 'VcRowView'
        ) );


        /*-----------------------------------------------------------------------------------*/
        /*  Space
        /*-----------------------------------------------------------------------------------*/
        vc_map( array(
          "name" => __("Space", 'pluton'),
          "icon" => "icon-ui-splitter-horizontal",
          "base" => "pluton-space",
          "weight" => 21,
          "description" => "Add space between elements",
          "class" => "space_extended",
          "category" => __("Mee Shortcodes", 'pluton'),
          "params" => array(
            array(
              "type" => "textfield",
              "admin_label" => true,
              "heading" => __("Height of the space(px)", 'pluton'),
              "param_name" => "height",
              "value" => 50,
              "description" => __("Set height of the space. You can add white space between elements to separate them beautifully.", 'pluton')
            )
          )
        ) );


        /*-----------------------------------------------------------------------------------*/
        /*  Line
        /*-----------------------------------------------------------------------------------*/
        vc_map( array(
          "name" => __("Line", 'pluton'),
          "icon" => "icon-ui-splitter-horizontal",
          "base" => "pluton-line",
          "description" => "Add Line between elements",
          "class" => "line_extended",
          "category" => __("Mee Shortcodes", 'pluton'),
          "params" => array(
            array(
              "type" => "textfield",
              "heading" => __("Margin top of the line(px)", 'pluton'),
              "param_name" => "line_top",
              "value" => 50,
              "description" => __("Set height of the line. You can add white line between elements to separate them beautifully.", 'pluton')
            )
          )
        ) );


        /*-----------------------------------------------------------------------------------*/
        /*  Mee Title
        /*-----------------------------------------------------------------------------------*/
        vc_map( array(
          "name"        => __("Mee Title", 'pluton'),
          "icon"        => "icon-ui-splitter-horizontal",
          "base"        => "pluton-mee-title",
          "description" => "Add text Title and Subtitle",
          "category"    => __("Mee Shortcodes", 'pluton'),
          "params"      => array(
            array(
              "type"        => "textfield",
              "heading"     => __("Text Title", 'pluton'),
              "param_name"  => "tt_title",
              "value"       => "Professional Profile",
            ),
            array(
              "type" => "textarea_html",
              "heading" => __("Description", "pluton"),
              "param_name" => "content",
              "value" => __("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare sem sed quam tempus aliquet vitae eget dolor. Proin eu ultrices libero. Curabitur vulputate vestibulum elementum. Suspendisse id neque a nibh mollis blandit.", "pluton"),
            ),
          )
        ) );


        /*-----------------------------------------------------------------------------------*/
        /*  Contact Form7
        /*-----------------------------------------------------------------------------------*/
        // Load contact form 7
        $args2 = array(
          'post_type' => 'wpcf7_contact_form',
        );
        $ctf7s = get_posts($args2);

        $pluton_ctf7 = array();
        $pluton_ctf7['Select contact form'] = '';
        foreach($ctf7s as $ctf7) {
          $pluton_ctf7[$ctf7->post_title] = $ctf7->ID;
        }
        wp_reset_postdata();
        wp_reset_query();
        vc_map( array(
          "name"        => __("Contact Form7", 'pluton'),
          "icon"        => "icon-ui-splitter-horizontal",
          "base"        => "pluton-contact-form7",
          "description" => "Contact Form7",
          "category"    => __("Mee Shortcodes", 'pluton'),
          "params"      => array(
            array(
              "type"        => "textfield",
              "heading"     => __("Contact Title", 'pluton'),
              "param_name"  => "contact_title",
              "value"       => "Drop Me a Line",
            ),
            array(
              'type' => 'dropdown',
              'heading' => __( 'Contact Form7', 'pluton' ),
              'param_name' => 'contact_form7_id',
              'std' => '',
              'value' => $pluton_ctf7,
            ),
          )
        ) );


        /*-----------------------------------------------------------------------------------*/
        /* About
        /*-----------------------------------------------------------------------------------*/
        vc_map( array(
          "name"        => __("About Info", 'pluton'),
          "icon"        => "icon-ui-splitter-horizontal",
          "base"        => "pluton-aboutinfo",
          "description" => "Add text info",
          "category"    => __("Mee Shortcodes", 'pluton'),
          "params"      => array(
            array(
              "type" => "textarea_raw_html",
              "heading" => __("About Info", "pluton"),
              "param_name" => "about_desc",
              "value" => base64_encode('<ul>
                <li>Name: Andrew Smith</li>
                <li>Email: <a href="mailto:andrew@gmail.com">andrew@gmail.com</a></li>
                <li>Phone: (123) - 456-7890</li>
                <li>Date of birth: 23 February 1986</li>
                <li>Address: PO Box 16122 Collins Street West, Victoria, USA.</li>
                <li>Nationality: United States</li>
              </ul>'),
            ),
          )
        ) );


        /*-----------------------------------------------------------------------------------*/
        /*  Skill
        /*-----------------------------------------------------------------------------------*/
        vc_map( array(
          "name"        => __("Skill", 'pluton'),
          "icon"        => "icon-ui-splitter-horizontal",
          "base"        => "pluton-skill",
          "description" => "Add text and percent",
          "category"    => __("Mee Shortcodes", 'pluton'),
          "params"      => array(
            array(
              "type"        => "textfield",
              "heading"     => __("Text Title", 'pluton'),
              "param_name"  => "sk_title",
              "value"       => "Film Editing",
            ),
            array(
              "type"        => "textfield",
              "heading"     => __("Description", "pluton"),
              "param_name"  => "sk_desc",
              "value"       => "Expert, 4 years",
            ),
            array(
              "type"        => "textfield",
              "heading"     => __("Percent", "pluton"),
              "param_name"  => "sk_percent",
              "value"       => "75",
            ),
          )
        ) );


        /*-----------------------------------------------------------------------------------*/
        /*  Process Bar
        /*-----------------------------------------------------------------------------------*/
        vc_map( array(
          "name"        => __("Process Bar", 'pluton'),
          "icon"        => "icon-ui-splitter-horizontal",
          "base"        => "pluton-process-bar",
          "description" => "Add text and percent",
          "category"    => __("Mee Shortcodes", 'pluton'),
          "params"      => array(
            array(
              "type"        => "textfield",
              "heading"     => __("Text Title", 'pluton'),
              "param_name"  => "pr_title",
              "value"       => "English Experienced",
            ),
            array(
              "type"        => "textfield",
              "heading"     => __("Percent", "pluton"),
              "param_name"  => "pr_percent",
              "value"       => "",
            ),
          )
        ) );


        /*-----------------------------------------------------------------------------------*/
        /*  Experience
        /*-----------------------------------------------------------------------------------*/
        vc_map( array(
          "name"        => __("Experience", 'pluton'),
          "icon"        => "icon-ui-splitter-horizontal",
          "base"        => "pluton-experience",
          "description" => "Add Experience Infomation",
          "category"    => __("Mee Shortcodes", 'pluton'),
          "params"      => array(
            array(
              "type"        => "textfield",
              "heading"     => __("Text Title", 'pluton'),
              "param_name"  => "ex_title",
              "value"       => "Panara Media",
            ),
            array(
              "type"        => "textfield",
              "heading"     => __("Text Sub Title", 'pluton'),
              "param_name"  => "ex_sub_title",
              "value"       => "Art Director",
            ),
            array(
              "type"        => "textfield",
              "heading"     => __("Text Year", 'pluton'),
              "param_name"  => "ex_year",
              "value"       => "2014 - 2013",
            ),
            array(
              "type" => "textarea_html",
              "heading" => __("Description", "pluton"),
              "param_name" => "content",
              "value" => __(" Phasellus nec gravida purus. Aliquam ac enim vel ipsum consectetur vulputate. Duis quis feugiat neque. Pellentesque eleifend, nisi vel mattis vestibulum, est lacus pretium quam.", "pluton"),
            ),
            array(
              'type' => 'dropdown',
              'heading' => __( 'Icon Fonts Awesome', 'pluton' ),
              'param_name' => 'ex_icon_class',
              'value' => $pluton_icon_font_vc,
              'std' => 'fa-send-o',
            ),
          )
        ) );


        /*-----------------------------------------------------------------------------------*/
        /*  Portfolio
        /*-----------------------------------------------------------------------------------*/
        // Get categories
        $cats = get_categories('taxonomy=portfolio_cats');
        $cats_choices = array();

        // Generate usable array of categories
        foreach ( $cats as $cat ) {
          $cats_choices[$cat->name] = $cat->cat_ID;
        }
        wp_reset_postdata();
        wp_reset_query();
        vc_map( array(
          "name"        => __("Portfolio", 'pluton'),
          "icon"        => "icon-ui-splitter-horizontal",
          "base"        => "pluton-portfolio",
          "description" => "Portfolio post",
          "category"    => __("Mee Shortcodes", 'pluton'),
          "params"      => array(
            array(
              "type"        => "textfield",
              "heading"     => __("Portfolio ID", 'pluton'),
              'description' => __( 'Have to be unique for each portfolio page.', 'pluton' ),
              "param_name"  => "porftolio_id",
              "value"       => "grid-gallery-1",
            ),
            array(
              "type"        => "textfield",
              "heading"     => __("Posts Per Page", 'pluton'),
              "param_name"  => "posts_per_page",
              "value"       => "5",
            ),
            array(
              'type' => 'checkbox',
              'heading' => __( 'Categories', 'pluton' ),
              'param_name' => 'portfolio_cats',
              'description' => __( 'Select from which categories to display portfolio posts.', 'pluton' ),
              'value' => $cats_choices,
            ),
            array(
              'type' => 'dropdown',
              'heading' => __( 'Order By', 'pluton' ),
              'param_name' => 'orderby',
              'std' => 'date',
              'value' => array(
                __( 'Publish Date', 'pluton' ) => 'date',
                __( 'Modified Date', 'pluton' ) => 'modified',
                __( 'Random', 'pluton' ) => 'rand',
                __( 'Alphabetic', 'pluton' ) => 'title',
                __( 'Comment Count', 'pluton' ) => 'comment_count',
              ),
            ),
            array(
              'type' => 'dropdown',
              'heading' => __( 'Order', 'pluton' ),
              'param_name' => 'order',
              'std' => 'DESC',
              'value' => array(
                __( 'Ascending', 'pluton' ) => 'ASC',
                __( 'Descending', 'pluton' ) => 'DESC',
              ),
            ),
            array(
              "type"        => "textfield",
              "heading"     => __("Offset", 'pluton'),
              "param_name"  => "offset",
              "value"       => "0",
            ),
          )
        ) );


        /*-----------------------------------------------------------------------------------*/
        /*  Contact Info
        /*-----------------------------------------------------------------------------------*/
        vc_map( array(
          "name"        => __("Contact Info", 'pluton'),
          "icon"        => "icon-ui-splitter-horizontal",
          "base"        => "pluton-contact-info",
          "description" => "Add Contact Info Infomation",
          "category"    => __("Mee Shortcodes", 'pluton'),
          "params"      => array(
            array(
              "type"        => "textfield",
              "heading"     => __("Text Title", 'pluton'),
              "param_name"  => "ct_title",
              "value"       => "Andrew Smith",
            ),
            array(
              "type" => "textarea",
              "heading" => __("Description", "pluton"),
              "param_name" => "ct_desc",
              "value" => __("PO Box 16122 Collins Street West, Victoria 8007, United States. ", "pluton"),
            ),
            array(
              'type' => 'dropdown',
              'heading' => __( 'Icon Fonts Awesome', 'pluton' ),
              'param_name' => 'ct_icon_class',
              'value' => $pluton_icon_font_vc,
              'std' => 'fa-adjust',
            ),
          )
        ) );


        /*-----------------------------------------------------------------------------------*/
        /*  Mee Social List
        /*-----------------------------------------------------------------------------------*/
        vc_map( array(
          "name"        => __("Mee Social List", 'pluton'),
          "icon"        => "icon-ui-splitter-horizontal",
          "base"        => "pluton-mee-social",
          "description" => "Add Mee Social List Infomation",
          "category"    => __("Mee Shortcodes", 'pluton'),
          "params"      => array(
            array(
              "type"        => "textfield",
              "heading"     => __("Link", 'pluton'),
              "param_name"  => "so_link1",
              "value"       => "",
              "group"       => "Social 1",
            ),
            array(
              'type'        => 'dropdown',
              'heading'     => __( 'Icon Fonts Awesome', 'pluton' ),
              'param_name'  => 'so_icon_class1',
              'value'       => $pluton_icon_font_vc,
              'std'         => 'fa-adjust',
              "group"       => "Social 1",
            ),
            array(
              "type"        => "textfield",
              "heading"     => __("Link", 'pluton'),
              "param_name"  => "so_link2",
              "value"       => "",
              "group"       => "Social 2",
            ),
            array(
              'type'        => 'dropdown',
              'heading'     => __( 'Icon Fonts Awesome', 'pluton' ),
              'param_name'  => 'so_icon_class2',
              'value'       => $pluton_icon_font_vc,
              'std'         => 'fa-adjust',
              "group"       => "Social 2",
            ),
            array(
              "type"        => "textfield",
              "heading"     => __("Link", 'pluton'),
              "param_name"  => "so_link3",
              "value"       => "",
              "group"       => "Social 3",
            ),
            array(
              'type'        => 'dropdown',
              'heading'     => __( 'Icon Fonts Awesome', 'pluton' ),
              'param_name'  => 'so_icon_class3',
              'value'       => $pluton_icon_font_vc,
              'std'         => 'fa-adjust',
              "group"       => "Social 3",
            ),
            array(
              "type"        => "textfield",
              "heading"     => __("Link", 'pluton'),
              "param_name"  => "so_link4",
              "value"       => "",
              "group"       => "Social 4",
            ),
            array(
              'type'        => 'dropdown',
              'heading'     => __( 'Icon Fonts Awesome', 'pluton' ),
              'param_name'  => 'so_icon_class4',
              'value'       => $pluton_icon_font_vc,
              'std'         => 'fa-adjust',
              "group"       => "Social 4",
            ),
            array(
              "type"        => "textfield",
              "heading"     => __("Link", 'pluton'),
              "param_name"  => "so_link5",
              "value"       => "",
              "group"       => "Social 5",
            ),
            array(
              'type'        => 'dropdown',
              'heading'     => __( 'Icon Fonts Awesome', 'pluton' ),
              'param_name'  => 'so_icon_class5',
              'value'       => $pluton_icon_font_vc,
              'std'         => 'fa-adjust',
              "group"       => "Social 5",
            ),
            array(
              "type"        => "textfield",
              "heading"     => __("Link", 'pluton'),
              "param_name"  => "so_link6",
              "value"       => "",
              "group"       => "Social 6",
            ),
            array(
              'type'        => 'dropdown',
              'heading'     => __( 'Icon Fonts Awesome', 'pluton' ),
              'param_name'  => 'so_icon_class6',
              'value'       => $pluton_icon_font_vc,
              'std'         => 'fa-adjust',
              "group"       => "Social 6",
            ),
            array(
              "type"        => "textfield",
              "heading"     => __("Link", 'pluton'),
              "param_name"  => "so_link7",
              "value"       => "",
              "group"       => "Social 7",
            ),
            array(
              'type'        => 'dropdown',
              'heading'     => __( 'Icon Fonts Awesome', 'pluton' ),
              'param_name'  => 'so_icon_class7',
              'value'       => $pluton_icon_font_vc,
              'std'         => 'fa-adjust',
              "group"       => "Social 7",
            ),
            array(
              "type"        => "textfield",
              "heading"     => __("Link", 'pluton'),
              "param_name"  => "so_link8",
              "value"       => "",
              "group"       => "Social 8",
            ),
            array(
              'type'        => 'dropdown',
              'heading'     => __( 'Icon Fonts Awesome', 'pluton' ),
              'param_name'  => 'so_icon_class8',
              'value'       => $pluton_icon_font_vc,
              'std'         => 'fa-adjust',
              "group"       => "Social 8",
            ),
            array(
              "type"        => "textfield",
              "heading"     => __("Link", 'pluton'),
              "param_name"  => "so_link9",
              "value"       => "",
              "group"       => "Social 9",
            ),
            array(
              'type'        => 'dropdown',
              'heading'     => __( 'Icon Fonts Awesome', 'pluton' ),
              'param_name'  => 'so_icon_class9',
              'value'       => $pluton_icon_font_vc,
              'std'         => 'fa-adjust',
              "group"       => "Social 9",
            ),
            array(
              "type"        => "textfield",
              "heading"     => __("Link", 'pluton'),
              "param_name"  => "so_link10",
              "value"       => "",
              "group"       => "Social 10",
            ),
            array(
              'type'        => 'dropdown',
              'heading'     => __( 'Icon Fonts Awesome', 'pluton' ),
              'param_name'  => 'so_icon_class10',
              'value'       => $pluton_icon_font_vc,
              'std'         => 'fa-adjust',
              "group"       => "Social 10",
            ),
          )
        ) );


      }
    }

  }

}