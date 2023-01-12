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
define( 'DB_NAME', 'testDB' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', 'admin' );

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
define( 'AUTH_KEY',         'GfM]h,.~n5D4eP.CHqMXGW{V =|p@RM8CY`3FbJ*?7;VUJt>UyK}vD1Ww}`ROZxX' );
define( 'SECURE_AUTH_KEY',  'nVo|E^},/b:bgEZbFN,W~]-DknKM)e[7v.),m8Dex8mT}rz(%fN)G.mJ{IoPg./[' );
define( 'LOGGED_IN_KEY',    '9r6AoU),Wk4+yl!b>4P0=5m1Skfw$iv<H]IqaG+#fNTHNDw<B)F&Ky!Kftzj!`Lk' );
define( 'NONCE_KEY',        'cRsbo=KO<eMH*=.$2D|(>NH >2W^{R[J)zCsH1X$!Nd:nZr!2F/qg:Vx&5Nh)@vi' );
define( 'AUTH_SALT',        's|lw%wQ7k/!n3M^%[0od mgsSDQ%^feIj`]$Buo#aN*jSS4f7cR&BZ.]o qK9@xb' );
define( 'SECURE_AUTH_SALT', 'OKa.q.DiSa@`T@u%Hus%3c6U`v`([gzWL:5YmzvX$oRV{|W]jL`;{P+RE Na~nRC' );
define( 'LOGGED_IN_SALT',   'ipv~1h{0SCC8>d;}B6[C0L/<8;e>q])<W0NaYvWfR>N.p%jk~Y,~BM9.p#f^T/j.' );
define( 'NONCE_SALT',       '<eU*fVn^@iFTy-B:7% m(2./Kf+X5E~#IjF#Cp`<9oJVyV7/)pm];$N;*(i}UX]I' );

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