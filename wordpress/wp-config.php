<?php
define('WP_CACHE', true); // WP-Optimize Cache
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
define( 'DB_NAME', 'wordpress' );
/** MySQL database username */
define( 'DB_USER', 'wordpress_user' );
/** MySQL database password */
define( 'DB_PASSWORD', 'wordpress_pss123' );
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
define( 'AUTH_KEY',         'n#KLlTo2A%mBHo_/yV:;<4Wo2;cZWGB*-W[v9SagnR>I PF{@o;Dl8-5Q>c^P}w7' );
define( 'SECURE_AUTH_KEY',  'YOQBcQs}e|[KoPw|Di2g^D3#.B*Y,dD}HSZU&nNwPp+?TK76(q>|>wy{5sI `?A#' );
define( 'LOGGED_IN_KEY',    'g O_VZG6l&Lt7;.J>aJguNMi+)D?YH?4zETSSdBTv@57_i;0QlTqE^d8jq00W:Hv' );
define( 'NONCE_KEY',        '$GQpf#e9$v6aP3lJ=/B=Opd4o>$*AB$cSm{s-Kg!H2Z[1?bM9o!>3>-qb;W1Ksmz' );
define( 'AUTH_SALT',        '| w3X$?VQg5G][k==A,,b0Q>dLcXUbhkbJ1f)/~Plv|`3#al:ej;B2_::It$=YBh' );
define( 'SECURE_AUTH_SALT', ':&!:Mof{MO(C8HM&Zwx?dx1V4|TY>8=nx#9^P9DUV-cbigWI.]<80/W]Ok(`C@W[' );
define( 'LOGGED_IN_SALT',   '4sI)drk8dL^)-j!pRQrN~61^IfZP8h,?nu.s@~H|/8i}}o)U+eB1-h_/L~2;u9VX' );
define( 'NONCE_SALT',       '1zLe2LI5uhS?OX4 u=>V>wByiPl:.(qIUQ|I`V.S#cQs!{9&lS~|namF}7{OQ99n' );
/**#@-*/
/**
 * WordPress Database Table prefix.
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
#define('WP_HOME', 'http://38102g0p78.qicp.vip');
#define('WP_SITEURL', 'http://38102g0p78.qicp.vip');
#define('WP_HOME', 'http://lvjun.klotting1314.site');
#define('WP_SITEURL', 'http://lvjun.klotting1314.site');
define('WP_MEMORY_LIMIT','256M');
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';