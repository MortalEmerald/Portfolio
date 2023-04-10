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
define( 'DB_NAME', 'portfolio_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'H1W:w.jPxtOb35&:}F}c3NB4cu[~C#Pyz[B^T0-RW`2=xo0b}Mdv9e|V3o/TDsKb' );
define( 'SECURE_AUTH_KEY',  'f&MmLM,GSJW^b1h<oZcF>02{Jom1NF_[x`eJ:zHCnH/?J<[7eJ@{}_vb]v7 }ON(' );
define( 'LOGGED_IN_KEY',    '+lZ*Moy6/(sEfvXM?EV.Og>sb{>sE]{HT W(8gU^~/hThm?AZe2<o.eF=#g#BF+C' );
define( 'NONCE_KEY',        'M`T](o>wK2{!fwj$+Q ?f%1Q~_!!{l}RH`/lJVyl.?Rg#w{ILBka>a>e9iI.7RQ[' );
define( 'AUTH_SALT',        'fTE#r;gUaj9}ggK|r;dUmAJ>wLIhnZW0&WxuLNy(~3g[B&r|q3rT:p*a|ElQ:N(Z' );
define( 'SECURE_AUTH_SALT', 'CVwT4NBVNrN;&Mu3F`9X&1Td}J~q(5o^bO fwm/%b)#/p(>ram]15K%.5`/y:fGT' );
define( 'LOGGED_IN_SALT',   'xF.Q;O0E@+z? R(_fip1%7G_4byl*Jr3TdV|l 2vV,TA~b%P@7D#8{yg*;: u]O(' );
define( 'NONCE_SALT',       'n^H&X$kU=nR8o4#5Ga4o7[k^Y&XVm?79{+=F>B89J7[/nhbfzD%r$i%6MDrz&a`{' );

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
