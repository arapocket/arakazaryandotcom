<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'meetheme_';


	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['post_metabox'] = array(

	  'title' => 'Post metas',
	  'pages' => array('post'),
	  'context'    => 'normal',
	  'id'         => $prefix . 'post_metas',
	  'priority'   => 'low',
	  'show_names' => true, // Show field names on the left
	  'fields' => array(
		   	array(
		       'name' => 'Image gallery',
		       'desc' => '',
		       'id' => $prefix .'image_gallery',
		       'type' => 'file_list',
		       'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
		   	),
		   	array(
		       'name' => 'Post image',
		       'desc' => 'Upload an image or enter an URL.',
		       'id' => $prefix . 'post_image',
		       'type' => 'file',
		       'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
		   	),
		   	array(
			    'name' => __( 'Video oEmbed', 'pluton' ),
			    'desc' => __( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', 'pluton' ),
			    'id'   => $prefix . 'post_video_embed',
			    'type' => 'oembed',
		   	),
		   	array(
			    'name' => __( 'Audio oEmbed', 'pluton' ),
			    'desc' => __( 'Enter a soundcloud URL.', 'pluton' ),
			    'id'   => $prefix . 'post_audio_embed',
			    'type' => 'oembed',
		   	),
	  	)

	);


	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['portfolio_metabox'] = array(
		'id'         => 'meetheme_portfolio_metabox',
		'title'      => __( 'Portfolio Metas', 'pluton' ),
		'pages'      => array( 'portfolio' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name'    => __( 'Portfolio Type', 'pluton' ),
				'desc'    => __( 'field description (optional)', 'pluton' ),
				'id'      => $prefix . 'portfolio_type',
				'type'    => 'select',
				'options' => array(
					'standard' 	=> __( 'Standard', 'pluton' ),
					'image' 	=> __( 'Image', 'pluton' ),
					'gallery'   => __( 'Slider', 'pluton' ),
					'video'     => __( 'Video', 'pluton' ),
					'audio'		=> __( 'Audio', 'pluton' )
				),
			),
			array(
				'name' => __( 'Portfolio Image', 'pluton' ),
				'desc' => __( 'Upload an image or enter a URL.', 'pluton' ),
				'id'   => $prefix . 'portfolio_image',
				'type' => 'file',
			),
			array(
				'name'         => __( 'Portfolio slider', 'pluton' ),
				'desc'         => __( 'Upload or add multiple images/attachments.', 'pluton' ),
				'id'           => $prefix . 'portfolio_gallery',
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
			),
			array(
				'name' => __( 'Portfolio Video', 'pluton' ),
				'desc' => __( 'Enter a youtube, twitter, or instagram URL.', 'pluton' ),
				'id'   => $prefix . 'portfolio_video',
				'type' => 'oembed',
			),
			array(
				'name' => __( 'Portfolio Soundcloud', 'pluton' ),
				'desc' => __( 'Enter a soundcloud URL. Supports services listed at.', 'pluton' ),
				'id'   => $prefix . 'portfolio_audio',
				'type' => 'oembed',
			),
		),
	);



	global $pluton_class_icon_font_awesome;
	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['time_line_metabox'] = array(
		'id'         => 'meetheme_time_line_metabox',
		'title'      => __( 'Time Line Metas', 'pluton' ),
		'pages'      => array( 'time_line' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Year', 'pluton' ),
				'desc' => __( 'field description (optional)', 'pluton' ),
				'id'   => $prefix . 'time_line_year',
				'type' => 'text',
			),
			array(
				'name'    => __( 'Select Icon class', 'pluton' ),
				'desc'    => __( 'field description (optional)', 'pluton' ),
				'id'      => $prefix . 'time_line_class',
				'type'    => 'select',
				'options' => $pluton_class_icon_font_awesome,
				'default'	=> '',
			),
			array(
				'name' => __( 'Link URL', 'pluton' ),
				'desc' => __( 'field description (optional)', 'pluton' ),
				'id'   => $prefix . 'time_line_url',
				'type' => 'text_url',
			),
		),
	);


	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['testimonials_metabox'] = array(
		'id'         => 'meetheme_testimonials_metabox',
		'title'      => __( 'Testimonials Metas', 'pluton' ),
		'pages'      => array( 'testimonials' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => __( 'Position', 'pluton' ),
				'desc' => __( 'field description (optional)', 'pluton' ),
				'id'   => $prefix . 'testimonials_position',
				'type' => 'text',
			),
			array(
				'name' => __( 'Avatar', 'pluton' ),
				'desc' => __( 'Upload an image or enter a URL.', 'pluton' ),
				'id'   => $prefix . 'testimonials_image',
				'type' => 'file',
			),
		),
	);


	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['page_metabox'] = array(
		'id'         => 'meetheme_testimonials_metabox',
		'title'      => __( 'Page Metas', 'pluton' ),
		'pages'      => array( 'page' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => __( 'Background', 'pluton' ),
				'desc' => __( 'Upload an image background.', 'pluton' ),
				'id'   => $prefix . 'page_image_bg',
				'type' => 'file',
			),
			array(
				'name'    => __( 'Page Color Background', 'pluton' ),
				'desc'    => __( 'field description (optional)', 'pluton' ),
				'id'      => $prefix . 'page_color',
				'type'    => 'select',
				'options' => array(
					'white-bg' 	=> __( 'White Color', 'pluton' ),
					'gray-bg' 	=> __( 'Gray Color', 'pluton' ),
				),
				'default' => 'white-bg',
			),
			array(
				'name'    => __( 'Page Width', 'pluton' ),
				'desc'    => __( 'field description (optional)', 'pluton' ),
				'id'      => $prefix . 'page_width',
				'type'    => 'select',
				'options' => array(
					'page-full' 	=> __( 'Full Width', 'pluton' ),
					'page-half' 	=> __( 'Half Width', 'pluton' ),
				),
				'default' => 'page-full',
			),
			array(
				'name'    => __( 'Inner Page Width', 'pluton' ),
				'desc'    => __( 'field description (optional)', 'pluton' ),
				'id'      => $prefix . 'inner_page_width',
				'type'    => 'checkbox',
			)
		),
	);


	/**
	 * Sample metabox to demonstrate each field type included
	 */
	global $pluton_class_icon_font_awesome;
	$meta_boxes['services_metabox'] = array(
		'id'         => 'meetheme_services_metabox',
		'title'      => __( 'Services Metas', 'pluton' ),
		'pages'      => array( 'service' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Services URL', 'pluton' ),
				'desc' => __( 'field description (optional)', 'pluton' ),
				'id'   => $prefix . 'service_url',
				'type' => 'text_url',
			),
			array(
				'name'    => __( 'Select Icon class', 'pluton' ),
				'desc'    => __( 'field description (optional)', 'pluton' ),
				'id'      => $prefix . 'service_class',
				'type'    => 'select',
				'options' => $pluton_class_icon_font_awesome,
				'default'	=> '',
			),
		),
	);



	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['member_metabox'] = array(
		'id'         => 'meetheme_member_metabox',
		'title'      => __( 'Our Team Metas', 'pluton' ),
		'pages'      => array( 'member' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __( 'Position', 'pluton' ),
				'desc' => __( 'field description (optional)', 'pluton' ),
				'id'   => $prefix . 'member_position',
				'type' => 'text',
			),
			array(
				'name' => __( 'Social Facebook', 'pluton' ),
				'desc' => __( 'field description (optional)', 'pluton' ),
				'id'   => $prefix . 'member_facebook',
				'type' => 'text',
			),
			array(
				'name' => __( 'Social Twitter', 'pluton' ),
				'desc' => __( 'field description (optional)', 'pluton' ),
				'id'   => $prefix . 'member_twitter',
				'type' => 'text',
			),
			array(
				'name' => __( 'Social Dribbble', 'pluton' ),
				'desc' => __( 'field description (optional)', 'pluton' ),
				'id'   => $prefix . 'member_dribbble',
				'type' => 'text',
			),
		),
	);


	/**
	 * Metabox for the user profile screen
	 */
	$meta_boxes['user_edit'] = array(
		'id'         => 'user_edit',
		'title'      => __( 'User Profile Metabox', 'cmb' ),
		'pages'      => array( 'user' ), // Tells CMB to use user_meta vs post_meta
		'show_names' => true,
		'cmb_styles' => false, // Show cmb bundled styles.. not needed on user profile page
		'fields'     => array(
			array(
				'name'     => __( 'Extra Info', 'cmb' ),
				'desc'     => __( 'field description (optional)', 'cmb' ),
				'id'       => $prefix . 'exta_info',
				'type'     => 'title',
				'on_front' => false,
			),
			array(
				'name'    => __( 'Avatar', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'avatar',
				'type'    => 'file',
				'save_id' => true,
			),
			array(
				'name' => __( 'Facebook URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'facebookurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Twitter URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'twitterurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Google+ URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'googleplusurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Linkedin URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'linkedinurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'User Field', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'user_text_field',
				'type' => 'text',
			),
		)
	);

	/**
	 * Metabox for an options page. Will not be added automatically, but needs to be called with
	 * the `cmb_metabox_form` helper function. See wiki for more info.
	 */
	$meta_boxes['options_page'] = array(
		'id'      => 'options_page',
		'title'   => __( 'Theme Options Metabox', 'cmb' ),
		'show_on' => array( 'key' => 'options-page', 'value' => array( $prefix . 'theme_options', ), ),
		'fields'  => array(
			array(
				'name'    => __( 'Site Background Color', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'bg_color',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
		)
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once get_template_directory() . '/framework/core/metaboxes/init.php';;

}