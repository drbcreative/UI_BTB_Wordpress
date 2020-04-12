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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ui-btb' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '6-.xy&gL`,i^m{GCuO=+5pBKQ&b/D*/VA{uEM#-b|@,ZwPppQW64)0!sr5Y+JFn|' );
define( 'SECURE_AUTH_KEY',  '{9^^v+)7se|5@8K#Iea^8Qw]$#&B|]bVP]prw?wlx.h7c,#(A@3ziv,jHe6DQOYp' );
define( 'LOGGED_IN_KEY',    'UwV yM95`/Rq)=k_5QV^!:LCHB7KH}OQM}A-+/v*|xh}>+y;ul]`i0tHVfNvf9hX' );
define( 'NONCE_KEY',        '}@SJ*?mH+,T$n_#E1AexLM|_H$$[Kut9c#{UzQ5!GI#df$Hs-0#9Ixow~.I=ed9v' );
define( 'AUTH_SALT',        'bri@I+j4P>@>~)q{881NdX-SntwEr%|peW)7=~/fL>/ 8shZ%n<1CleB 3;gY8t)' );
define( 'SECURE_AUTH_SALT', 'jCU$4GT}/U!FaE`@[[|yQD-B^=xyG}[C&QDlXqdIQx _`1)5*63?_2%iW6~b6e7q' );
define( 'LOGGED_IN_SALT',   '31$KD?#Vc^mw6qw-b3UmK2O0F?W:Tn]j0UHAhX@*zv)z:33Z/?2q9U#{8i;,A||+' );
define( 'NONCE_SALT',       'W|0z!xs!aSq?HD9IMdOB6_1.Zbt[WbGg++jt<2}}[i me9Sdg1C!-,V,[iA%vw9 ' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'bt20';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
