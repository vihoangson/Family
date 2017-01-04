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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/var/www/vhosts/family.vihoangson.com/blog/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'blog_family');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'rbmf5uBm5eZ9');

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
define('AUTH_KEY',         '/ha`h^t1EanHRRjA?07tck8-4 (Fdmiiw;)8r(/Jc*/gK%GN3+>j- i.3{_.<wRv');
define('SECURE_AUTH_KEY',  '[=cGbPylkqPXe/U_WzSN6CLxX=1BAwz~5wS#$UbwJ}Vjj<]J/z#hQ)%*~tz/2ldJ');
define('LOGGED_IN_KEY',    'A3xz3C+[a+6g9+*F,`%uOJ5*!bSz^}.V4BFg9ZPTb}CcKB4G&k4,546rPF~*16Ze');
define('NONCE_KEY',        'W3P.C7IcQFJbgQh~*$kGU_za!sFu3L*kJ`,w8J_eDme7jp7HkRd3/3ylWm-Z*0tX');
define('AUTH_SALT',        'u2BY>JMRKi+B~EDm$(Y+pB_<4wu4 ^^x+604(RtI`Gc-@-O9LvVsr-pxpTlt=tFY');
define('SECURE_AUTH_SALT', '.z}I/*j@|-2$a6Hv>hMskpmC5vc>S7)sGo|D{+vY]CW!guY%-=pTfL3A&$}mABv3');
define('LOGGED_IN_SALT',   '{a<2+5/5##g{~*o%*!dZZ.JE2P^5.#!R2L9doCH0^qcoeF((O+b!DXMf-=[QOF9X');
define('NONCE_SALT',       'nwklwoH|1HpMGf)d(4g]})wS6``d)(?6#@A)/9yb*Q9^BQ~uWR!;(sl;*IQ{^27+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'family_';

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
