<?php
/**
 * Lokální konfigurace pro dev/docker-compose.yml — NE produkční wp-config.php.
 */

define( 'DB_NAME', 'wordpress' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', 'root' );
define( 'DB_HOST', 'db' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

// Stejný prefix tabulek jako na produkci.
$table_prefix = 'hyvi_';

define( 'AUTH_KEY', 'local-dev' );
define( 'SECURE_AUTH_KEY', 'local-dev' );
define( 'LOGGED_IN_KEY', 'local-dev' );
define( 'NONCE_KEY', 'local-dev' );
define( 'AUTH_SALT', 'local-dev' );
define( 'SECURE_AUTH_SALT', 'local-dev' );
define( 'LOGGED_IN_SALT', 'local-dev' );
define( 'NONCE_SALT', 'local-dev' );

define( 'WP_ENVIRONMENT_TYPE', 'local' );
define( 'WP_HOME', 'http://localhost:8412' );
define( 'WP_SITEURL', 'http://localhost:8412' );
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
define( 'FS_METHOD', 'direct' );
define( 'AUTOMATIC_UPDATER_DISABLED', true );

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
require_once ABSPATH . 'wp-settings.php';
