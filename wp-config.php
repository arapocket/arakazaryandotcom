<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'arakzqpt_wpara');

/** MySQL database username */
define('DB_USER', 'arakzqpt_wpara');

/** MySQL database password */
define('DB_PASSWORD', 'S4[py7)Ap0');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ns0ajmq4nx4lbxx5lerqomwdvuoxwllfg2qvcytt5exzqnahajw4d6ychn2whqks');
define('SECURE_AUTH_KEY',  'efl0ouy9yba2c6xeay2csea73qux5am3ld2wlpmbee0xzr3o1wltigaksypleeoi');
define('LOGGED_IN_KEY',    'gunruiyjwr6bpjtyd6w6yurvd7qg6e1w3bdho9en2vvkfbc7tiydn3ocfxq5qhqb');
define('NONCE_KEY',        'rxyevwuxwgtx6o45ly79z7ytuh2ylyczhm31tqajnejxdlmn7iwjywadphbhentn');
define('AUTH_SALT',        'vivykbodkkff82f12aacuukcseylonrzzfpu3svv2xtywl9ohmgbgzanudthzoav');
define('SECURE_AUTH_SALT', 'jwowgltkvuevyqpniqytdcfeye43swa4wiaaf3low1iaedtmtipknxcnycryvy1c');
define('LOGGED_IN_SALT',   'xkkbnm1byck5y1atdsalqxfwxsj9941wgzb68qtbewaxlqfxoiqhmyzqy0ldvh4k');
define('NONCE_SALT',       'vhn2uy1zfr5ammouxspphobhwty5myxltsxdhdwjm8ncrz2fygd4izcfwyopjvsx');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
