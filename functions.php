<?php
use Ict4Today\I4T\ActionHooks;
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

require_once trailingslashit( get_theme_file_path() ) . 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable( __DIR__ );
$dotenv->safeLoad();

if ( ! defined( 'I4T_PATH' ) ) {
	define( 'I4T_PATH', trailingslashit( get_theme_file_path() ) );
}

if ( ! defined( 'I4T_PATH_URL' ) ) {
	define( 'I4T_PATH_URL', trailingslashit( get_template_directory_uri() ) );
}

if ( ! defined( 'MODE' ) ) {
	define( 'MODE', $_ENV['MODE'] ?? 'production' );
}

if ( ! defined( 'TEXT_DOMAIN' ) ) {
	define( 'TEXT_DOMAIN', 'I4T' );
}

if ( ! defined( 'VERSION' ) ) {
	define(
		'VERSION',
		MODE === 'development'
			? time()
			: ( $_ENV['VERSION'] ?? '1.0.0' )
	);
}

require_once I4T_PATH . 'includes/functions/utilities.php';

// Include & initiate classes
new ActionHooks();