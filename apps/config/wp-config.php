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
define('DB_NAME', 'u859708408_javad');

/** MySQL database username */
define('DB_USER', 'u859708408_qeruj');

/** MySQL database password */
define('DB_PASSWORD', 'NuzuRagyVu');

/** MySQL hostname */
define('DB_HOST', 'mysql');

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
define('AUTH_KEY',         'wbc1akWKPihfQjNNn6CyErXIgXW3wPGih2s3dmiS6cuSaLYF2HHTmWtlkRwvFSso');
define('SECURE_AUTH_KEY',  'rhzYUT1OUsoV5zkAx5qRHdlIcnP80FrSyTyXJF8NGb6jRUKtEMnl5xWTdZcNiyYJ');
define('LOGGED_IN_KEY',    'gpaK26AtvNUOBdL2vsBJuEh2X56DmwkGaRa7kVwpzEjBAKIeVwIVIz89CAUzMtiV');
define('NONCE_KEY',        'tEevBrN0BFw5aFnKHipVFa5mBhVMEuXCeiKAyBLLq76ATC8hCW49fXYBQuuaX0zQ');
define('AUTH_SALT',        'i6KPcoOpXIVJLYuAMdi06a6Tt58ljum2NV3Ic3Fnpp5K5cmMdFaUn2YykWsISuPu');
define('SECURE_AUTH_SALT', 'sbiWoKbOsShrspqJQ0heefrEwgnvAyaje2EIhC2x0aDKzTtp0c1fLHOtQZidC0Pn');
define('LOGGED_IN_SALT',   'VXziAlzU3Q1gTug0SFPB34KoQaFp4irrDwrtTPFF8IMJAMjnCaTFQQhdvIcnPJm6');
define('NONCE_SALT',       '0RjRjTWUsfYP7mDd6xzYy8Cyhs1jAxifN5zDyNGKfdhTS6UyFjRu3ogpdjsrSDb5');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'uecd_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
