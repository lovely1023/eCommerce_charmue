<?php
/**
 * Plugin Name: SocialRabbit
 * Plugin URI: https://socialrabbitplugin.com/
 * Description: Social Rabbit is the #1 WordPress plugin for auto-running and auto-promoting your websites in most popular social networks.
 * Version: 3.3.12
 * Text Domain: sr
 * Domain Path: /langs
 * Requires at least: WP 4.9.5
 * Author: Maxim D. & Vitaly K. & Yaroslav N. & Ilya D.
 * Author URI: https://socialrabbitplugin.com/about-us/
 * License: SHAREWARE
 */

if (!defined('SR_VERSION')) define('SR_VERSION', '3.3.12');
if (!defined('SR_GUARD')) define('SR_GUARD', 'ionCube Loader');
if (!defined('SR_PHP')) define('SR_PHP', '7.2');

if (!defined('SR_PATH')) define('SR_PATH', plugin_dir_path(__FILE__));
if (!defined('SR_SLUG')) define('SR_SLUG', basename(__DIR__));
if (!defined('SR_URL')) define('SR_URL', plugins_url(SR_SLUG));

function sr_check_warnings() {

	static $warnings;

	if ($warnings) {
		return $warnings;
	}

	$extensions = get_loaded_extensions();
	$warnings = [];

	$errorCron = sr_test_cron();
	if ($errorCron) {
		$warnings[] =  $errorCron;
	}

	if (!in_array('curl', $extensions)) {
		$warnings[] = 'You need to install cURL, see: http://curl.haxx.se/docs/install.html';
	}

	if (!in_array('gd', $extensions)) {
		$warnings[] = 'Enable PHP-GD support, see: https://libgd.github.io, http://php.net/manual/en/book.image.php';
	}

	if (!in_array('sha256', hash_algos())) {
		$warnings[] = 'Your server must support the sha256, see: http://php.net/manual/en/ref.hash.php';
	}

	return $warnings;
}

if ( ! function_exists('srlog')) {
	function srlog ( $log )  {
		if ( is_array( $log ) || is_object( $log ) ) {
			error_log( print_r( $log, true ) );
		} else {
			error_log( $log );
		}
	}
}

function sr_check_errors() {

	static $errors;

	if ($errors) {
		return $errors;
	}

	$errors = [];

	$link = sprintf('<a href="%1$s" target="_blank">%1$s</a>', 'https://socialrabbitplugin.com/codex/system-requirements/');

	if (version_compare('7.1', PHP_VERSION, '>')) {
		$errors[] = sprintf('PHP Version is not suitable. You need version 7.1+, see: %s', $link);
	}

	if (!in_array(SR_GUARD, get_loaded_extensions())) {
		$errors[] = sprintf('%s not found, see: %s', SR_GUARD, $link);
	}

	$ionArgs = [
		'5.6' => '5.6 - 7.0',
		'7.1' => '7.1',
		'7.2' => '7.2',
	];

	$php = explode('.', PHP_VERSION);
	$php = sprintf('%d.%d', $php[0], $php[1]);

	if ($php != SR_PHP && ($php == '7.1' || $php < '7.3' || SR_PHP !== '7.2')) {
		$ion = isset($ionArgs[SR_PHP]) ? $ionArgs[SR_PHP] : 'Unknown';
		$msg = 'You installed SocialRabbit plugin for PHP %1$s, but your version of PHP is %2$s. Please <a href="%3$s" target="_blank">download</a> and install SocialRabbit plugin for PHP %2$s.';
		$errors[] = sprintf($msg, $ion, $php, 'https://socialrabbitplugin.com/download/');
	}

	if ($errors) {
		update_site_option('sr-errors', $errors);
	}

	$log = get_site_option('sr-errors', []);

	if (!$errors && $log && !get_site_option('sr-settings', [])) {
		$errors[] = __('Deactivate the Social Rabbit Plugin and click the "Activate" button again', 'sr');
	}

	return $errors;
}

function sr_admin_notice() {

	// $warnings = sr_check_warnings();

	// if ($warnings) foreach ($warnings as $message) {
	// 	echo "
	// 		<div class=\"notice notice-warning\">
	// 			<p><b>Social Rabbit Plugin</b></p><p>{$message}</p>
	// 		</div>
	// 	";
	// }

	$errors = sr_check_errors();

	if ($errors) foreach ($errors as $message) {
		echo "
			<div class=\"notice notice-error\">
				<p><b>Social Rabbit Plugin</b></p><p>{$message}</p>
			</div>
		";
	}
}
add_action('admin_notices', 'sr_admin_notice');

if (is_admin()) {
	require_once __DIR__ . '/install.php';
}

if (!sr_check_errors()) {

	require_once __DIR__ . '/autoload.php';

	register_activation_hook(__FILE__, ['\SR\Utils\Init', 'activation']);
	register_deactivation_hook(__FILE__, ['\SR\Utils\Init', 'deactivation']);

	add_action('plugins_loaded', ['\SR\Utils\Init', 'init']);
}
register_activation_hook(__FILE__, 'sr_activation');

if (!function_exists('srpr')) {

	function srpr($arg, $type = 'error') {
		$className = implode(' ', ['notice', "notice-{$type}"]);
		printf('<div class="%s"><pre>%s</pre></div>', $className, print_r($arg, true));
	}
}

if (!function_exists('exif_imagetype')) {
	function exif_imagetype($filename) {
		if ((list($width, $height, $type, $attr) = getimagesize($filename)) !== false) {
			return $type;
		}
		return false;
	}
}

if (!function_exists('get_content_type')) {

	function get_content_type($filename) {
		$mimeTypes = [
			'txt' => 'text/plain',
			'htm' => 'text/html',
			'html' => 'text/html',
			'php' => 'text/html',
			'css' => 'text/css',
			'js' => 'application/javascript',
			'json' => 'application/json',
			'xml' => 'application/xml',
			'swf' => 'application/x-shockwave-flash',
			'flv' => 'video/x-flv',

			// images
			'png' => 'image/png',
			'jpe' => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'jpg' => 'image/jpeg',
			'gif' => 'image/gif',
			'bmp' => 'image/bmp',
			'ico' => 'image/vnd.microsoft.icon',
			'tiff' => 'image/tiff',
			'tif' => 'image/tiff',
			'svg' => 'image/svg+xml',
			'svgz' => 'image/svg+xml',

			// archives
			'zip' => 'application/zip',
			'rar' => 'application/x-rar-compressed',
			'exe' => 'application/x-msdownload',
			'msi' => 'application/x-msdownload',
			'cab' => 'application/vnd.ms-cab-compressed',

			// audio/video
			'mp3' => 'audio/mpeg',
			'qt' => 'video/quicktime',
			'mov' => 'video/quicktime',
			/*'mp4' => 'video/mp4',
			'mp4s' => 'application/mp4',
			'mp4a' => 'audio/mp4',*/
			'mp4' => 'video/mp4',
			'mp4s' => 'application/mp4',
			'mp4a' => 'audio/mp4',

			// adobe
			'pdf' => 'application/pdf',
			'psd' => 'image/vnd.adobe.photoshop',
			'ai' => 'application/postscript',
			'eps' => 'application/postscript',
			'ps' => 'application/postscript',

			// ms office
			'doc' => 'application/msword',
			'rtf' => 'application/rtf',
			'xls' => 'application/vnd.ms-excel',
			'ppt' => 'application/vnd.ms-powerpoint',

			// open office
			'odt' => 'application/vnd.oasis.opendocument.text',
			'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
		];

		/*if (strpos($filename, '?')) {
			$filename = explode('?', $filename);
			$filename = strtolower(array_shift($filename));
		}*/

		if (strpos($filename, '?')) {
			$filename = explode('?', $filename);
			$filename = strtolower(array_shift($filename));
		}

		$ext = explode('.', $filename);
		$ext = strtolower(array_pop($ext));

		if (array_key_exists($ext, $mimeTypes)) {
			return $mimeTypes[$ext];
		}

		if (function_exists('finfo_open')) {
			$finfo = finfo_open(FILEINFO_MIME);
			$mimetype = finfo_file($finfo, $filename);
			finfo_close($finfo);
			return $mimetype;
		}

		return 'application/octet-stream';
	}
}

if (!function_exists('mime_content_type')) {

	function mime_content_type($filename) {
		return get_content_type($filename);
	}
}

if (!function_exists('sr_mime_content_type')) {

	function sr_mime_content_type($filename) {
		return get_content_type($filename);
	}
}

function sr_test_cron($cache = true) {
	if (defined('DISABLE_WP_CRON') && DISABLE_WP_CRON) {
		$link = sprintf('<a href="%1$s" target="_blank">%1$s</a>', 'https://socialrabbitplugin.com/codex/');
		return sprintf('WP CRON should be enabled for correct work of the Plugin. Please delete or comment the next line: <code>define(\'DISABLE_WP_CRON\', true);</code> in <code>wp-config.php</code>, see: %s', $link);

	}

	if (defined( 'ALTERNATE_WP_CRON' ) && ALTERNATE_WP_CRON) {
		$link = sprintf('<a href="%1$s" target="_blank">%1$s</a>', 'https://socialrabbitplugin.com/codex/');
		return sprintf('WP CRON should be enabled for correct work of the Plugin. Please delete or comment the next line: <code>define(\'ALTERNATE_WP_CRON\', true);</code> in <code>wp-config.php</code>, see: %s', $link);
	}

	$cronStatus = get_transient('sr-cron-test');

	if ($cache && $cronStatus) {
		return false;
	}

	$doingWpCron = sprintf('%.22F', microtime(true));

	$cronRequest = apply_filters('cron_request', [
		'url'  => add_query_arg('doing_wp_cron', $doingWpCron, site_url('wp-cron.php')),
		'key'  => $doingWpCron,
		'args' => [
			'timeout'   => 10,
			'blocking'  => true,
			'sslverify' => false,
		],
	]);

	$result = wp_remote_post($cronRequest['url'], $cronRequest['args']);

	$message = __('There was a problem spawning a call to the WP-Cron system on your site. This means WP-Cron events on your site may not work. The problem was: %s', 'sr');
	if (is_wp_error($result)) {
		return sprintf($message, $result->get_error_message());
	} elseif (wp_remote_retrieve_response_code($result) >= 300) {
		$respCode = sprintf('Unexpected HTTP response code: %s', wp_remote_retrieve_response_code($result));
		return sprintf($message, $respCode);
	} else {
		set_transient('sr-cron-test', 1, 3600);
		return false;
	}

}
