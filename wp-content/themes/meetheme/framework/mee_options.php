<?php
/**
 *ReduxFramework Sample Config File
 *For full documentation, please visit: https://docs.reduxframework.com
**/

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**
         *This is a test function that will let you see when the compiler hook occurs.
         *It only runs if a field   set with compiler=>true is changed.
         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
        }

        /**
         *Custom function for filtering the sections array. Good for child themes to override or add to the sections.
         *Simply include this function in the child themes functions.php file.
         *NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
         *so you must use get_template_directory_uri() if you want to use any of the built in icons
         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'redux-framework-demo'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**
         *Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**
         *Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
             *Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'redux-framework-demo'), $this->theme->display('Name'));

            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'redux-framework-demo'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'redux-framework-demo'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'redux-framework-demo') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'redux-framework-demo'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                Redux_Functions::initWpFilesystem();

                global $wp_filesystem;

                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            /*--General Settings--*/
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => __('General Settings', 'pluton'),
                'fields' => array(
                    array(
                        'id'    => 'general_introduction',
                        'type'  => 'info',
                        'style' => 'success',
                        'title' => __('Welcome to MeeTheme Theme Option Panel', 'pluton'),
                        'icon'  => 'el-icon-info-sign',
                        'desc'  => __( 'From here you can config MeeTheme theme in the way you need.', 'pluton')
                    ),
                    array(
                        'id' => 'general_logo',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Logo Upload', 'pluton'),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('Upload your logo image', 'pluton'),
                        'subtitle' => __('Upload your custom logo image', 'pluton'),
                        'default' => array('url' => get_template_directory_uri().'/assets/images/logo.png'),
                        'hint' => array(
                            'title'     => 'Hint Title',
                            'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        )
                    ),
                    array(
                        'id' => 'general_favicon',
                        'type' => 'media',
                        'title' => __('Upload favicon', 'pluton'),
                        'desc' => __('Upload a 16px x 16px .png or .gif image that will be your favicon.', 'pluton'),
                        'subtitle' => __('Upload your custom favicon image', 'pluton'),
                        'default' => array('url' => get_template_directory_uri().'/assets/images/favicon.ico'),
                    ),
                    array(
                        'id' => 'general_css_code',
                        'type' => 'ace_editor',
                        'title' => __('Custom CSS', 'pluton'),
                        'subtitle' => __('Paste your custom CSS code here.', 'pluton'),
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'desc' => 'Custom css code.',
                        'default' => ""
                    ),
                    array(
                        'id' => 'general_js_code',
                        'type' => 'ace_editor',
                        'title' => __('Custom JS ', 'pluton'),
                        'subtitle' => __('Paste your custom JS code here.', 'pluton'),
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                        'desc' => 'Custom javascript code',
                        'default' => "jQuery(document).ready(function(){\n\n});"
                    ),
                    array(
                        'id' => 'general_tracking_code',
                        'type' => 'ace_editor',
                        'title' => __('Google Analytics', 'pluton'),
                        'subtitle' => __('Paste your google tracking code here.', 'pluton'),
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                        'desc' => 'Custom javascript code',
                        'default' => "jQuery(document).ready(function(){\n\n});"
                    ),
                    array(
                        'id'        => 'switch_combine_css',
                        'type'      => 'switch',
                        'title'     => __('Enable Combine Css File', 'pluton'),
                        'subtitle'  => __('Combine Css File', 'pluton'),
                        'default'   => false,
                    ),
                )
            );


            /*--Header Settings--*/
            $this->sections[] = array(
                'icon' => 'el-icon-magic',
                'title' => __('Left Menu Sidebar Settings', 'pluton'),
                'fields' => array(
                    array(
                        'id'       => 'header_text',
                        'type'     => 'text',
                        'title'    => __('Header Text on mobile', 'pluton'),
                        'subtitle' => __('Insert text will show on menu mobile', 'pluton'),
                        'default'  => 'Andrew Smith',
                    ),
                    array(
                        'id'        => 'header_copyright_text',
                        'type'      => 'editor',
                        'title'     => __('Header copyright Text', 'pluton'),
                        'subtitle'  => __('Copyright text', 'pluton'),
                        'default'   => __(' &copy; Andrew Smith.<br>All Rights Reserved. ', 'pluton'),
                    ),
                    array(
                        'id'        => 'header_social_icon',
                        'type'      => 'switch',
                        'title'     => __('Show Social Icon', 'pluton'),
                        'subtitle'  => __('Social icon on/off', 'pluton'),
                        "default"   => 1,
                        'on'        => 'Enabled',
                        'off'       => 'Disabled',
                    ),
                    array(
                        'id'          => 'header_social_list',
                        'type'        => 'slides',
                        'title'       => __('Header Socials List', 'pluton'),
                        'subtitle'    => __('Unlimited slides with drag and drop sortings.', 'pluton'),
                        'desc'        => __('Insert class icon font awesome.', 'pluton'),
                        'placeholder' => array(
                            'title'           => __('This is a class icon font awesome.', 'pluton'),
                            'description'     => __('Description Here', 'pluton'),
                            'url'             => __('Give us a link!', 'pluton'),
                        ),
                        'default'     => array(
                            array(
                                'title'           => __('fa-facebook', 'pluton'),
                                'description'     => __('Facebook', 'pluton'),
                                'url'             => __('http://facebook.com', 'pluton'),
                            ),
                            array(
                                'title'           => __('fa-twitter', 'pluton'),
                                'description'     => __('Twitter', 'pluton'),
                                'url'             => __('http://twitter.com', 'pluton'),
                            ),
                            array(
                                'title'           => __('fa-google-plus', 'pluton'),
                                'description'     => __('Goole plus', 'pluton'),
                                'url'             => __('http://plus.google.com', 'pluton'),
                            ),
                        ),
                    ),
                )
            );


            /*
             * Home settings
            */
            $this->sections[] = array(
                'title' => __('Home Settings', 'pluton'),
                'desc' => __('Homepage Settings', 'pluton'),
                'icon' => 'el-icon-home',
                'fields' => array(
                    /*
                     * Slider section
                    */
                    array(
                        'id'       => 'slider_title',
                        'type'     => 'textarea',
                        'title'    => __('Title', 'pluton'),
                        'default'  => "<span>HEllo, I'm</span><br>Andrew Smith",
                    ),
                    array(
                        'id'       => 'slider_sub_title',
                        'type'     => 'text',
                        'title'    => __('Sub Title', 'pluton'),
                        'default'  => 'UX Designer / Frontend Developer',
                    ),
                    array(
                        'id'       => 'slider_gallery',
                        'type'     => 'gallery',
                        'title'    => __('Add/Edit Gallery', 'pluton'),
                        'subtitle' => __('Create a new Gallery by selecting existing or uploading new images using the WordPress native uploader', 'pluton'),
                        'desc'     => __('This is the description field, again good for additional info.', 'pluton'),
                    ),
                ),
            );



            /*--Typograply Options--*/
            $this->sections[] = array(
                'icon' => 'el-icon-font',
                'title' => __('Typography Settings', 'pluton'),
                'fields' => array(
                    array(
                        'id' => 'typograply_body_font',
                        'type' => 'typography',
                        'title' => __('Body Font Setting', 'pluton'),
                        'subtitle' => __('Specify the body font properties.', 'pluton'),
                        'google' => true,
                        'output' => 'body',
                        'default' => array(
                            'font-family' => 'Roboto',
                        ),
                    ),
                    array(
                        'id' => 'typograply_menu_font',
                        'type' => 'typography',
                        'title' => __('Menu Item Font Setting', 'pluton'),
                        'subtitle' => __('Specify the menu font properties.', 'pluton'),
                        'output' => array('.menu nav a'),
                        'google' => true,
                        'default' => array(
                            'font-family' => 'Oswald',
                        ),
                    ),
                    array(
                        'id' => 'typograply_h1_font',
                        'type' => 'typography',
                        'title' => __('Heading 1(H1) Font Setting', 'pluton'),
                        'subtitle' => __('Specify the H1 tag font properties.', 'pluton'),
                        'google' => true,
                        'default' => array(
                            'font-family' => 'Oswald',
                        ),
                        'output' => 'h1',
                    ),
                    array(
                        'id' => 'typograply_h2_font',
                        'type' => 'typography',
                        'title' => __('Heading 2(H2) Font Setting', 'pluton'),
                        'subtitle' => __('Specify the H2 tag font properties.', 'pluton'),
                        'google' => true,
                        'default' => array(
                            'font-family' => 'Oswald',
                        ),
                        'output' => 'h2',
                    ),
                    array(
                        'id' => 'typograply_h3_font',
                        'type' => 'typography',
                        'title' => __('Heading 3(H3) Font Setting', 'pluton'),
                        'subtitle' => __('Specify the H3 tag font properties.', 'pluton'),
                        'google' => true,
                        'default' => array(
                            'font-family' => 'Oswald',
                        ),
                        'output' => 'h3',
                    ),
                    array(
                        'id' => 'typograply_h4_font',
                        'type' => 'typography',
                        'title' => __('Heading 4(H4) Font Setting', 'pluton'),
                        'subtitle' => __('Specify the H4 tag font properties.', 'pluton'),
                        'google' => true,
                        'default' => array(
                            'font-family' => 'Oswald',
                        ),
                        'output' => 'h4',
                    ),
                    array(
                        'id' => 'typograply_h5_font',
                        'type' => 'typography',
                        'title' => __('Heading 5(H5) Font Setting', 'pluton'),
                        'subtitle' => __('Specify the H5 tag font properties.', 'pluton'),
                        'google' => true,
                        'default' => array(
                            'font-family' => 'Oswald',
                        ),
                        'output' => 'h5',
                    ),
                    array(
                        'id' => 'typograply_h6_font',
                        'type' => 'typography',
                        'title' => __('Heading 6(H6) Font Setting', 'pluton'),
                        'subtitle' => __('Specify the H6 tag font properties.', 'pluton'),
                        'google' => true,
                        'default' => array(
                            'font-family' => 'Oswald',
                        ),
                        'output' => 'h6',
                    ),
                )
            );



            /*--Footer setting--*/
            $this->sections[] = array(
                'title' => __('Right Side Settings', 'pluton'),
                'desc' => __('Right Side Settings', 'pluton'),
                'icon' => 'el-icon-credit-card',
                'fields' => array(
                    array(
                        'id'       => 'footer_switch',
                        'type'     => 'switch',
                        'title'    => __('Switch On Footer', 'pluton'),
                        'subtitle' => __('Look, it\'s on!', 'pluton'),
                        'default'  => true,
                    ),
                    array(
                        'id'       => 'footer_background',
                        'type'     => 'background',
                        'title'    => __('Footer Background', 'pluton'),
                        'subtitle' => __('Footer background with image, color, etc.', 'pluton'),
                        'desc'     => __('This is the description field, again good for additional info.', 'pluton'),
                        'default'  => array(
                            'background-image' => get_template_directory_uri() . '/assets/images/profile-big.jpg',
                        ),
                        'output'   => array('.introduction-end'),
                        'required' => array('footer_switch', 'equals', array('1')),
                    ),
                    array(
                        'id'       => 'footer_text_title',
                        'type'     => 'text',
                        'title'    => __('Footer Text Title', 'pluton'),
                        'default'  => 'Andrew Smith',
                        'required' => array('footer_switch', 'equals', array('1')),
                    ),
                    array(
                        'id'        =>'footer_multi_text',
                        'type'      => 'multi_text',
                        'title'     => __('Footer Text Slider', 'pluton'),
                        'default'   => array('awesome.', 'invincible.', 'unbeatable.', 'indestructible.'),
                        'required' => array('footer_switch', 'equals', array('1')),
                    ),
                )
            );

            /*--Blog--*/
            $this->sections[] = array(
                'title' => __('Blog Settings', 'pluton'),
                'desc' => __('Blog Settings', 'pluton'),
                'icon' => 'el-icon-th-list',
                'fields' => array(
                    array(
                        'id'        => 'blog_style',
                        'type'      => 'image_select',
                        'compiler'  => true,
                        'title'     => __('Blog style', 'pluton'),
                        'subtitle'  => __('Select blog style(List/Grid).', 'pluton'),
                        'options'   => array(
                            'list' => array('alt' => 'List Image',       'img' =>get_template_directory_uri() . '/framework/core/reduxframework/sample/patterns/list.png'),
                            'grid' => array('alt' => 'Grid Image',       'img' =>get_template_directory_uri() . '/framework/core/reduxframework/sample/patterns/grid.png'),
                        ),
                        'default'   => 'list'
                    ),
                    array(
                        'id'            => 'blog_continue_reading',
                        'type'          => 'text',
                        'title'         => __('Continue reading', 'pluton'),
                        'subtitle'      => __('Continue reading text', 'pluton'),
                        'default'       => 'read more',
                    ),
                    array(
                        'id'            => 'blog_content',
                        'type'          => 'select',
                        'title'         => __('Blog Content', 'pluton'),
                        'options'       => array(
                            'content'   => 'Show Content',
                            'excerpt'   => 'Show Excerpt',
                        ),
                        'default'       => 'content',
                    ),
                    array(
                        'id'        => 'blog_layout',
                        'type'      => 'image_select',
                        'compiler'  => true,
                        'title'     => __('Sidebar position', 'pluton'),
                        'subtitle'  => __('Select sidebar position.', 'pluton'),
                        'desc' => __('Select sidebar on right or no', 'pluton'),
                        'options'   => array(
                            '2' => array('alt' => '2 Column Right',     'img' => get_template_directory_uri() . '/framework/core/reduxframework/sample/patterns/2cr.png'),
                            '3' => array('alt' => 'Full Width',         'img' => get_template_directory_uri() . '/framework/core/reduxframework/sample/patterns/1column.png'),
                        ),
                        'default'   => '2',
                    ),
                    array(
                        'id'       => 'blog_metas',
                        'type'     => 'select',
                        'multi'    => true,
                        'title'    => __('Blog metas', 'pluton'),
                        'options'  => array(
                            'author'    => 'Author',
                            'date'      => 'Date time',
                            'category'  => 'Category',
                            'comment'   => 'Comment',
                            'tags'      => 'Tags',
                        ),
                        'default'  => array('author','date','category','comment')
                    ),
                    array(
                        'id' => 'blog_switch_social',
                        'type' => 'switch',
                        'title' => __('Enable Blog Socials', 'pluton'),
                        'subtitle' => __('Enable Blog Socials on/off', 'pluton'),
                        "default" => 1,
                        'on' => 'Enabled',
                        'off' => 'Disabled',
                    ),
                ),
            );

            $this->sections[] = array(
                'type' => 'divide',
            );

            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'redux-framework-demo') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'redux-framework-demo') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'redux-framework-demo') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'redux-framework-demo') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            if (file_exists(dirname(__FILE__) . '/../README.md')) {
                $this->sections['theme_docs'] = array(
                    'icon'      => 'el-icon-list-alt',
                    'title'     => __('Documentation', 'redux-framework-demo'),
                    'fields'    => array(
                        array(
                            'id'        => '17',
                            'type'      => 'raw',
                            'markdown'  => true,
                            'content'   => file_get_contents(dirname(__FILE__) . '/../README.md')
                        ),
                    ),
                );
            }


            $this->sections[] = array(
                'title'     => __('Import / Export', 'redux-framework-demo'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'redux-framework-demo'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );


            $this->sections[] = array(
                'type' => 'divide',
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'redux-framework-demo'),
                'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'redux-framework-demo'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'redux-framework-demo'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'redux-framework-demo'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'redux-framework-demo'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'meetheme', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'submenu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => false, // Show the sections below the admin menu item or not
                'menu_title' => __('MeeTheme', 'pluton'),
                'page_title' => __('MeeTheme', 'pluton'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyBnxzHttO52IQDpDkbZNbT48HL3o8YNb-k', // Must be defined to add google fonts to the typography module
                //'async_typography' => true, // Use a asynchronous font on the front end or font string
                //'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => 'meetheme', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => 'meetheme_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'              => 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                //'footer_credit'       => '', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );
                'hints' => array(
                    'icon'              => 'icon-question-sign',
                    'icon_position'     => 'right',
                    'icon_color'        => 'lightgray',
                    'icon_size'         => 'normal',

                    'tip_style'         => array(
                        'color'     => 'light',
                        'shadow'    => true,
                        'rounded'   => false,
                        'style'     => '',
                    ),
                    'tip_position'      => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'mouseover',
                        ),
                        'hide' => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );

            $this->args['share_icons'][] = array(
                'url' => 'https://www.facebook.com/devwpvn',
                'title' => 'Like us on Facebook',
                'icon' => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://twitter.com/devwpvn',
                'title' => 'Follow us on Twitter',
                'icon' => 'el-icon-twitter'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace("-", "_", $this->args['opt_name']);
                }
                // $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'pluton'), $v);
            } else {
                // $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'pluton');
            }

            // Add content after the form.
            // $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'pluton');
        }

    }

    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}

/**
 *Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
 *Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;