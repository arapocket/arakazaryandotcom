<?php
/*
Plugin Name: Pluton shortcodes
Plugin URI: http://wordpress.org/
Description: Create new postype for pluton wp theme.
Author: pluton
Author URI: http://themeforest.net/user/plutonthemes
Version: 1.0.0
Text Domain: pluton
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

define('PLUTON_SHORTCODES_VERSION', '1.0.0');
define('PLUTON_SHORTCODES_PATH', dirname(__FILE__));
require PLUTON_SHORTCODES_PATH . '/inc/extend-composer.php';
require PLUTON_SHORTCODES_PATH . '/inc/shortcode-composer.php';