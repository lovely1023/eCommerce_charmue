<?php
 /**
 * Plugin Name: Reviews Page
 * Plugin URI: https://alidropship.com/addons/reviews-page/
 * Description: A WordPress plugin to collect all reviews for the Products you sell at your store and organize them in a neat and attractive way in one place
 * Author: Maxim Doronin
 * Version: 1.1.6
 * Text Domain: arp
 */

if( ! defined( 'ARP_VERSION' ) ) define( 'ARP_VERSION', '1.1.6' );
if( ! defined( 'ARP_SLUG' ) )    define( 'ARP_SLUG', basename(__DIR__) );
if( ! defined( 'ARP_PATH' ) )    define( 'ARP_PATH', plugin_dir_path(__FILE__) );
if( ! defined( 'ARP_URL' ) )     define( 'ARP_URL', str_replace( [ 'https:', 'http:' ], '', plugins_url( ARP_SLUG ) ) );
if( ! defined( 'ARP_ADS' ) )     define( 'ARP_ADS', arp_ads_prefix() );

if( ! defined( 'ARP_PHP' ) )     define( 'ARP_PHP', '7.2' );
if( ! defined( 'ARP_GUARD' ) )   define( 'ARP_GUARD', 'ionCube Loader' );
if( ! defined( 'ARP_ERRORS' ) )  define( 'ARP_ERRORS', arp_check_errors() );

/**
 * Localization
 */
function arp_lang_init() {

	load_plugin_textdomain( 'arp' );
}
add_action( 'init', 'arp_lang_init' );

function arp_ads_prefix() {

	static $prefix;

	if( $prefix ) {
		return $prefix;
	}
		

	if (is_multisite()) {

		$plugins = (array) get_site_option('active_sitewide_plugins', []);

		if (array_key_exists('alids/alids.php', $plugins)) {
			$prefix = 'ads';
		}

		if (array_key_exists('alidswoo/alidswoo.php', $plugins)) {
			$prefix = 'adsw';
		}

		return $prefix;
	}

	$plugins = apply_filters( 'active_plugins', (array) get_option( 'active_plugins', [] ) );

	if( in_array( 'alids/alids.php', $plugins ) ) {

		$prefix = 'ads';

		return $prefix;
	}

	if( in_array( 'alidswoo/alidswoo.php', $plugins ) ) {

		$prefix = 'adsw';

		return $prefix;
	}

	return $prefix;
}

function arp_check_errors() {

	static $errors;

	if( $errors )
		return $errors;

	$errors = [];
	$link   = sprintf('<a href="%1$s" target="_blank">%1$s</a>', 'https://alidropship.com/codex/hosting-server-setup-php-zend-guard/');

	if( version_compare( '7.0', PHP_VERSION, '>' ) ) {
		$errors[] = sprintf( 'PHP Version is not suitable. You need version 7.1+, see: %s', $link );
	}

	if( ! in_array( ARP_GUARD, get_loaded_extensions() ) ) {
		$errors[] = sprintf( '%s not found, see: %s', ARP_GUARD, $link );
	}

	if( ! ARP_ADS ) {
		$errors[] = 'The plugin can work only with AliDropshop or AliDropshop Woo installed';
	}

	$ionArgs = [
		'7.1' => '7.1',
		'7.2' => '7.2+',
	];

	$php = explode( '.', PHP_VERSION );
	$php = sprintf( '%d.%d', $php[0], $php[1] );

	if( $php !== ARP_PHP && ( ARP_PHP === '7.2' && $php !== '7.3' && $php !== '7.4' ) ) {
    $msg = 'You installed Reviews Page plugin for PHP %1$s, but your version of PHP is %2$s. Please <a href="%3$s" target="_blank">download</a> and install Reviews Page plugin for PHP %2$s.';
    $ion = isset($ionArgs[ARP_PHP]) ? $ionArgs[ARP_PHP] : 'Unknown';
		$errors[] = sprintf($msg, $ion, $php, 'https://alidropship.com/updates-plugin/');
	}

	return $errors;
}

function arp_admin_notice() {

	if( ARP_ERRORS ) foreach ( ARP_ERRORS as $message ) {
		echo "<div class=\"notice notice-error\">
				<p><b>Reviews Page Plugin</b></p><p>{$message}</p>
			</div>";
	}
}
add_action( 'admin_notices', 'arp_admin_notice' );

if( ! ARP_ERRORS ) {

	require_once(ARP_PATH . 'core/autoload.php');

    add_action( 'plugins_loaded', ['\ARP\Utils\Init', 'init'] );

	if( is_admin() ) :

		require_once( ARP_PATH . 'core/install.php' );

		register_activation_hook( __FILE__, 'arp_activation' );

	endif;
}
