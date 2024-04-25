<?php 
define('USE_FETCH_FOR_REQUESTS',true);
?><?php 
define('WP_HOME','https://diy-pwa.com/scope:0.3882774915953586');
define('WP_SITEURL','https://diy-pwa.com/scope:0.3882774915953586');
?><?php 
define('WP_DEBUG_LOG',true);
define('WP_DEBUG_DISPLAY',false);
?><?php define( 'CONCATENATE_SCRIPTS', false );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'database_name_here' );

/** Database username */
define( 'DB_USER', 'username_here' );

/** Database password */
define( 'DB_PASSWORD', 'password_here' );

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
define( 'AUTH_KEY','pi51BUn8Ero_(rOcq3?WTFLCRb#%af_NzZ-aTU7f');
define( 'SECURE_AUTH_KEY','b#b15uKGTUnGifLKYgP[Sg2W#c@8cW&g@Ohx?RJB');
define( 'LOGGED_IN_KEY','.h#i[)qa*cP9yq-I5YvviPULNz2-M_JU?2Kh=4]K');
define( 'NONCE_KEY','d(QYMS-I[zR#DmdC.+=eg$-=uYoX2j.Tcx(E)(06');
define( 'AUTH_SALT','!/6NcP6>]I4,dMqoMuK=4>3(G4fsYESP?zLd$L7F');
define( 'SECURE_AUTH_SALT','2lgO#24*_[Le$qjcjYYo)5Hf@)-)=Sh@[=5%2!C7');
define( 'LOGGED_IN_SALT','&S%h=>h8Nls>oM9zj4w&_c)>?*WDWT-V8.LY*2g[');
define( 'NONCE_SALT','z,vm4XMuWD-5weZ,3$!o?X8mPzZ=()5lD[nUilV/');

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG',true);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
