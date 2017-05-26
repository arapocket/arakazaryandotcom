<?php
	/**
	 * Pluton Framework functions and definitions.
	 *
	 * @package WordPress
	 * @subpackage Pluton.Net
	 * @since Pluton Framework 1.0
	*/

	if ( ! isset( $content_width ) ) {
		$content_width = 960;
	}

	/**
	 * Sets up theme defaults and registers the various WordPress features that
	 * Pluton Framework supports.
	 *
	 * @uses load_theme_textdomain() For translation/localization support.
	 * @uses add_editor_style() To add a Visual Editor stylesheet.
	 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
	 * 	custom background, and post formats.
	 * @uses register_nav_menu() To add support for navigation menus.
	 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
	 *
	 * @since Pluton Framework 1.0
	*/

	if( !function_exists( 'pluton_setup_theme' ) ) {

		/*
		 * setup text domain and style
		*/
		function pluton_setup_theme() {
			load_theme_textdomain( 'pluton', get_template_directory() . '/languages' );
			add_editor_style();
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'post-formats', array(  'image', 'gallery','video','audio' ) );
			add_theme_support( 'woocommerce' );

			if ( isset($meetheme) ) {
				global $meetheme;
				$args = array(
					'default-image' => $meetheme['menu_background_color']['background-image'],
				);

				add_theme_support( 'custom-header', $args );
				add_theme_support( 'custom-background', $args );

			}

			//add image sizes
			if(function_exists('add_image_size')) {
				add_image_size('full-size',  9999, 9999, false);
				add_image_size('small-thumb',  90, 90, true);
			}
		}
		add_action( 'after_setup_theme', 'pluton_setup_theme' );

	}

	/*
	 * Add theme support thumbnails
	*/
	add_theme_support( 'post-thumbnails' );

	if( !function_exists( 'pluton_add_thumbnail_size' ) ) {

		/*
		 * Add thumb size image when upload
		*/
		function pluton_add_thumbnail_size($thumb_size){
			foreach ($thumb_size['imgSize'] as $sizeName => $size)
			{
				if($sizeName == 'base')
				{
					set_post_thumbnail_size($thumb_size['imgSize'][$sizeName]['width'], $thumb_size[$sizeName]['height'], true);
				} else {
					add_image_size(
						$sizeName,
						$thumb_size['imgSize'][$sizeName]['width'],
						$thumb_size['imgSize'][$sizeName]['height'],
						true
					);
				}
			}
		}

		$thumb_size['imgSize']['size-recent-post'] = array('width'=>57,  'height'=>43);
		$thumb_size['imgSize']['team-4columns'] = array('width'=>260,  'height'=>260);
		$thumb_size['imgSize']['portfolio-popup'] = array('width'=>520,  'height'=>280);
		$thumb_size['imgSize']['portfolio-4columns'] = array('width'=>319,  'height'=>319);

		pluton_add_thumbnail_size($thumb_size);

	}


	if( !function_exists( 'pluton_load_scripts_styles_default' ) ) {

		/**
		 * Enqueues scripts and styles for front-end.
		 *
		 * @since Pluton Framework 1.0
		 */
		function pluton_load_scripts_styles_default() {
			global $wp_styles;

			/*
			 * Adds JavaScript to pages with the comment form to support
			 * sites with threaded comments (when in use).
			 */
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			// IE style

			wp_enqueue_style( 'pluton-ie', get_template_directory_uri() . '/assets/css/ie.css', array( 'pluton-style' ), '30042013' );
			$wp_styles->add_data( 'pluton-ie', 'conditional', 'lt IE 9' );
		}
		add_action( 'wp_enqueue_scripts', 'pluton_load_scripts_styles_default' );

	}


	if(!( function_exists('pluton_comment') )){

	  	/*
	  	 * Function comment
	  	*/
	  	function pluton_comment($comment, $args, $depth) {
	  	$GLOBALS['comment'] = $comment;
	?>
	    <div class="comments-details" id="comment-<?php comment_ID() ?>">
	    	<div class="comments-name">
				<span class="pull-left">
					<?php echo get_avatar( $comment->comment_author_email, 80 ); ?>
				</span>
				<span class="name"><?php echo get_comment_author_link() ?></span>
				<span class="date light-gray"><?php echo get_comment_date(); ?></span>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Post Reply', 'pluton' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	            <?php edit_comment_link( __( 'Edit', 'pluton' ), '<p class="edit-link">', '</p>' ); ?>    
	            <?php if ($comment->comment_approved == '0') : ?>
	              <p><em><?php _e('Your comment is awaiting moderation.', 'pluton') ?></em></p>
	            <?php endif; ?>
			</div>
			<div class="comments-text"><?php echo wpautop( get_comment_text() ); ?></div>
		</div>
	<?php
		}

	}

	if ( ! function_exists( 'pluton_entry_meta' ) ) {

		/**
		 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
		 *
		 * Create your own pluton_entry_meta() to override in a child theme.
		 *
		 * @since Pluton Framework 1.0
		 */
		function pluton_entry_meta() {
			// Translators: used between list items, there is a space after the comma.
			$categories_list = get_the_category_list( __( ', ', 'pluton' ) );

			// Translators: used between list items, there is a space after the comma.
			$tag_list = get_the_tag_list( '', __( ', ', 'pluton' ) );

			$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);

			$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'pluton' ), get_the_author() ) ),
				get_the_author()
			);

			// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
			if ( $tag_list ) {
				$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'pluton' );
			} elseif ( $categories_list ) {
				$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'pluton' );
			} else {
				$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'pluton' );
			}

			printf(
				$utility_text,
				$categories_list,
				$tag_list,
				$date,
				$author
			);
		}

	}

	// Define constant
	$get_theme = wp_get_theme();

	define('PLUTON_THEME_NAME', $get_theme);
	define('PLUTON_THEME_VERSION', '1.0.0.0');
	define('PLUTON_THEME_SLUG', 'meetheme');
	define('PLUTON_BASE_URL', get_template_directory_uri());
	define('PLUTON_BASE', get_template_directory());
	define('PLUTON_LIBRARIES', PLUTON_BASE . '/framework');
	define('PLUTON_LOOP', PLUTON_BASE . '/loop/');
	define('PLUTON_WIDGET', PLUTON_BASE . '/framework/custom_widgets/');
	define('PLUTON_SHORTCODE', PLUTON_BASE . '/framework/shortcodes');
	define('PLUTON_FUNCTIONS', PLUTON_BASE . '/framework');
	define('PLUTON_METAS', PLUTON_BASE . '/framework/functions');
	define('PLUTON_OPTION', PLUTON_BASE . '/framework/core');
	define('PLUTON_API', PLUTON_FUNCTIONS . '/apis');
	define('PLUTON_JS', PLUTON_BASE_URL . '/assets/js');
	define('PLUTON_CSS', PLUTON_BASE_URL . '/assets/css');
	define('PLUTON_IMAGES', PLUTON_BASE_URL . '/assets/images');
	define('PLUTON_IMG', PLUTON_BASE_URL . '/assets/img');
	define('PLUTON_TEMPLATE', PLUTON_BASE_URL . '/page-templates');
	define('PLUTON_THEME_LIBS_URL', PLUTON_BASE_URL . '/framework');
	define('PLUTON_THEME_FUNCTION_URL', PLUTON_THEME_LIBS_URL . '/framework/functions');
	define('PLUTON_THEME_OPTION_URL', PLUTON_BASE_URL . '/framework/core');