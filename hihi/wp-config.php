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
define( 'DB_NAME', 'hihi' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



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
define( 'AUTH_KEY',         'Azpm8xMgmScKzoyzmPJxjH62zSHffsoDVTPyDxiqWITS7ejxoUdydA8Wuskt8Z5z' );
define( 'SECURE_AUTH_KEY',  '3p43EHv5RrzcIhOkPiFvNEWsuIDAIr1jE6bVXoKuQ92oco8hCWVX2Vsg4hsTFS8T' );
define( 'LOGGED_IN_KEY',    'ocLffeJwu3bOUvTfxwfw91cVyLfFklfBVhpdrnrlE4UUIMgP2fWITAGb3YTFbrCe' );
define( 'NONCE_KEY',        'y1q3qSTHOHrQuqzpxjvjB8VgC1ahd3vyJzpqyJYtrOFZJA9EOs4Dj5NZy5CGAGON' );
define( 'AUTH_SALT',        'Q9r7d7rJlYhg9db6lJYAEJ13lMdcUxppbOeHfPi6f1vmpswXm4Lsn1Ec4TPRKOyR' );
define( 'SECURE_AUTH_SALT', 'uoeXnrf5stregpmC7CwWjXzdV4QuBgFeanhEigJ25962GJyzd1CvsV6jftQKrTyR' );
define( 'LOGGED_IN_SALT',   'GA05JrecwMEUgyKnYP3WBUINuNxcrDW8BG1SsCD9XH3XrMlmWf96XnVNRP2QvZv0' );
define( 'NONCE_SALT',       'JDnP6c1hlOUDoAX2B2M6buV7eRk121RmXzIxDgzDOsn49ZLxYeqjU2jwe27Z8twj' );

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
