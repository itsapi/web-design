<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'KnashDavis');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'miranda96');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '4Ab-yXnDOA|}]joC0_D!ah-H%)>@{I1YA:]@`.HO{_-3wRoM9Qftc`.o-p+k?Oz*');
define('SECURE_AUTH_KEY',  'C|!I+Rg0Iz|0K,(([<@YfR:`})CzvsAVv370|;QTx3;#ics)g[U+}f#[RC8wE,Z$');
define('LOGGED_IN_KEY',    'irCX8F*kwkRU;,S+AN+gb&}Ph7*8Oo%=o}~ozPCNj|)n?H+Yn 3r7qwH+QVy! E1');
define('NONCE_KEY',        'AbT4qy2F]ah-tG=bB- Hz9(-3dL{ Z!n,Ev?>B.@4bCNx+S~my5!Nu|NIMk6q+y`');
define('AUTH_SALT',        'A*7_.V:((,,C]~XY^Cy0T`M;#+3/nV8kP$#<kpK=#^eM0N[)Z&zZXal+(HFWF!@d');
define('SECURE_AUTH_SALT', 'J4tK*&2m~AjbFOIr]Q@y!dW+s.2,%1wicQfkb_|[e!Yd&5P.&pmhiU9`UvH9grm^');
define('LOGGED_IN_SALT',   'D{%:-Ly~tDRp5O|60RO?+@ls&d+K~+LXYs;%R9hUq;q.*%.rDRu*0z`qX0G3Kw|8');
define('NONCE_SALT',       'xs=c8%>9>;KFebJl)8oet5t-^0uzx2X,FtmdEbs<*=i8-cZ}F#Sxi-tM`=s*H&tv');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
