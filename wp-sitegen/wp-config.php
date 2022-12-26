<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp-sitegen' );

/** Database username */
define( 'DB_USER', 'wp-sitegen' );

/** Database password */
define( 'DB_PASSWORD', 'z0w]emeHumA[gFG[' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'm`QNvYS:jlG4]*/3M^,5/eQNKi%+;Rm0N6i0%er{kZ<|`0 o{Si_WbWr E=M@A@V');
define('SECURE_AUTH_KEY',  '8/,eOoU0m-@sXW+4#Fi)C0|+_@8q1@>r*;ASW7t8~0A!Ir}Z+VbJVv(D,/BVLBya');
define('LOGGED_IN_KEY',    'h?*pmg1kw2*F&VGw|8{}FUsjFZ])S!vq@[d:%;71U$B}D0||FElXObMf8]|Bw5~N');
define('NONCE_KEY',        'VCU9W=tE+n1L`!91yIk8gg-&:uUcupc|=a>AC3Sh|C]Y_QG0e~)% xyYxQ7|WC,V');
define('AUTH_SALT',        '9F*&3N+x6N+)TfmI-gO9+ qd(,eoMseH8)9P}MZWA^9#$>+H{8+lm`1jO%,F@#*b');
define('SECURE_AUTH_SALT', 'pr#1lY!-C@gbltyP|s^5eC-nrlir`p-gM6`cW v>T>}()Ytgr,yczT[y2J=!Xn`e');
define('LOGGED_IN_SALT',   '(R=wwd5rQ8J1%x*a fJHH@|Ov.-5|2](urD`6p~=4(5Zy1X)i$6ugk1oFEp* m8T');
define('NONCE_SALT',       ':HYIN!k5|Sp@)?c~l[Y[]e(KaAyLM[/cPKS3>[Zf;eB:kA@|a|I$hmxp]U0CFI-A');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
