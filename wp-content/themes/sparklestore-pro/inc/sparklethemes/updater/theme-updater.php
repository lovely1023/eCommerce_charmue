<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

$theme = wp_get_theme('sparklestore-pro');
// Config settings
$config = array(
	'remote_api_url' => 'https://sparklewpthemes.com', // Site where EDD is hosted
	'item_name'      => 'SparkleStore Pro', // Name of theme
	'theme_slug'     => 'sparklestore-pro', // Theme slug
	'version'        => $theme->get( 'Version' ), // The current version of this theme
	'author'         => 'sparklewpthemes', // The author of this theme
	'download_id'    => '', // Optional, used for generating a license renewal link
	'renew_url'      => '', // Optional, allows for a custom license renewal link
	'beta'           => false, // Optional, set to true to opt into beta versions
);
// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(
	// Config settings
	$config,

	// Strings
	$strings = array(
		'theme-license'             => __( 'Sparkle Themes License', 'sparklestore-pro' ),
        'description'               => sprintf(__( 'Enter your theme license key to get automatic updates of the theme. Check this <a rel="designer" target="_blank" href="%1$s">Instruction</a>', 'sparklestore-pro' ), esc_url( 'https://sparklewpthemes.com/articles/adding-license-key-and-updating-a-premium-theme/' ) ),
		'enter-key'                 => __( 'Enter your theme license key.', 'sparklestore-pro' ),
		'license-key'               => __( 'License Key', 'sparklestore-pro' ),
		'license-action'            => __( 'License Action', 'sparklestore-pro' ),
		'deactivate-license'        => __( 'Deactivate License', 'sparklestore-pro' ),
		'activate-license'          => __( 'Activate License', 'sparklestore-pro' ),
		'status-unknown'            => __( 'License status is unknown.', 'sparklestore-pro' ),
		'renew'                     => __( 'Renew?', 'sparklestore-pro' ),
		'unlimited'                 => __( 'unlimited', 'sparklestore-pro' ),
		'license-key-is-active'     => __( 'License key is active.', 'sparklestore-pro' ),
		'expires%s'                 => __( 'Expires %s.', 'sparklestore-pro' ),
		'expires-never'             => __( 'Lifetime License.', 'sparklestore-pro' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'sparklestore-pro' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'sparklestore-pro' ),
		'license-key-expired'       => __( 'License key has expired.', 'sparklestore-pro' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'sparklestore-pro' ),
		'license-is-inactive'       => __( 'License is inactive.', 'sparklestore-pro' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'sparklestore-pro' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'sparklestore-pro' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'sparklestore-pro' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'sparklestore-pro' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'sparklestore-pro' ),
	)

);
