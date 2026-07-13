<?php
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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'digisaka_website' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'OI;*Hwzk3w$*vk)a5*TGd=YiAk(,(P_*,:]Ws-FYzpF&UHd,l9<XAF]A(:LMXhGR' );
define( 'SECURE_AUTH_KEY',  'k_X(> o4ntgc)8aY;EcSS!T/MIzA,Q^keOPT.Y$j82Il!*y(jIm5Ih6-d[PyD;d,' );
define( 'LOGGED_IN_KEY',    'mT&OFNbfc,]NCVJ!l Ao@]#95$K5I?028Q8 JsUO7`Ek-=oom)2GAB-)qfsEL}`f' );
define( 'NONCE_KEY',        '%tl(KCe3M~pS%8m,S1 {}DHeJ1os56}u%mTIDaijd_hWB X`rh4>,%>K-Vc&dIb~' );
define( 'AUTH_SALT',        'Hy|)A50H8Ahpv O4-UqO03#bYU$5V{/eJ#}>V`|n%mQ[KF[O$^ZjEvj_v6-=<[T%' );
define( 'SECURE_AUTH_SALT', 'uM/K]#G3ThAt?o#;~I+H1+,%{(XvdtgcI~R^Vh;0|[`MO%p95~n;hO:K%<cH*8iw' );
define( 'LOGGED_IN_SALT',   '0<x**xAyhqME695BBzA%|r%RMdLE})&Q1hPts4Cn=c+Dz,0!mvU+JTYe,#S,iT$|' );
define( 'NONCE_SALT',       'T$^e79!E>}6.bTBJCk48_)+RJm%F_375vsfd=RtN7y7& ?+XT&/VBj N+$8BE?bF' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'leads_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
