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
define('DB_NAME', 'ujima');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_HOME','http://localhost/ujima/');
define('WP_SITEURL','http://localhost/ujima/');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '`d*+ +YIOV|y$W2ug&7vTYOZlhI;C~m1WNH&JY#2ekHu:8XKrv(6K-I06$P@2};H');
define('SECURE_AUTH_KEY',  '6{5+eulj16$oeKvQ$JlHIq4M+.6x.+0Jukye(d.`fA[`-}[cY[+cT.yOE`(w#NSV');
define('LOGGED_IN_KEY',    'q^l^iE]sUB<a|[sNQ,(1;K[fwI{7iAvQz}dm }=6wYdkLH:GpJdwdw=lO3W?f0QA');
define('NONCE_KEY',        ']U;+|GBOX;,b!K~])1 ^n:F@=+Lwn]4o}[}0Eas2a`5vtKg,s&<GWzixiAo[=2Xz');
define('AUTH_SALT',        'rS^h(,~9WjgARvSI*!V?J|!#fjd=ZmhkxZoEvw3A`4Q]syiE?TuQM2:P;C-LfpS1');
define('SECURE_AUTH_SALT', 'n&$H[Sai<IcX~d|jT i!I])ifv2miwcbL4RNvBdm[BZh<;+u6NmjxB-fOUg_Er j');
define('LOGGED_IN_SALT',   'E@1JCPP*DU|UoK+zLd@&/~E+/:@(nf4MnykOtZoYR>vf6I=k%yskLy?.#3A[%9=-');
define('NONCE_SALT',       'i ZX+w&}|~pY-C:Tl+i/:_`Sa6JR;e$h=xTzd`4`ejK,Wv7=sF=D;~^$^RcPK9:s');

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
