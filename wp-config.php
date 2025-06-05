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
define( 'DB_NAME', 'monitor_pacotes' );

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

define('FS_METHOD','direct');

define( 'UPLOADS', 'wp-content/uploads' );


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
define( 'AUTH_KEY',         'e=ea^}fi tZZ`n Y2H+:r&6AyY3x-4?B#W,odTCP4!|,4z&2vn0yd1Nz*GN~y`d2' );
define( 'SECURE_AUTH_KEY',  '_<+A3.-a/cxJiWJWuJNUL3z2AVP(J&!X NIR6U#qn?5W}Bykt-nqpxCSZd.AU)nc' );
define( 'LOGGED_IN_KEY',    '}(VrO,jO]pAX-fC@I/{6Lyn{$_iI>xc~|.0Zh~(4~j=N+vpq$xsI*+0=FfW@LKFn' );
define( 'NONCE_KEY',        'f`0l~7J/qOh~[n^+nI-bqVcfa4/i!j6.c31cn5jL(ZA]~08&!yeh5Ko3Ro[wl7w;' );
define( 'AUTH_SALT',        '<De*8/]q{3+giM;v-YN9wrm~F=;Z0reH3,eXDDsbgzF?G}kJpl$S]CGmdhB{M5sK' );
define( 'SECURE_AUTH_SALT', ')@a$0y8d#eFq73!N1HUo`T1){C:a6$#JhxoA@Z-K9?lhvuO7egA74xjxH@JFAF8t' );
define( 'LOGGED_IN_SALT',   'kZ)}-Z!183tNx3{^m NfUxeYf.l{,2*]f9JcwK[y/c>P`Q4uQ/E%DGi+xPM>lw:m' );
define( 'NONCE_SALT',       'QToe.011ccLp6JOUT-,-K8#oxBrv(@Y17B;)ri#,`jtG$#X4X,B~97-E(]+v893T' );

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
define( 'UPLOADS', 'wp-content/uploads' );
require_once ABSPATH . 'wp-settings.php';
