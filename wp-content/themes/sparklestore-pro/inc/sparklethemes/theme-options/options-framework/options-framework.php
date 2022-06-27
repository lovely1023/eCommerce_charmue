<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

function optionsframework_init() {

    //  If user can't edit theme options, exit
    if (!current_user_can('edit_theme_options'))
        return;

    // Loads the required Options Framework classes.
    require dirname(__FILE__) . '/includes/class-options-framework.php';
    require dirname(__FILE__) . '/includes/class-options-framework-admin.php';
    require dirname(__FILE__) . '/includes/class-options-interface.php';
    require dirname(__FILE__) . '/includes/class-options-media-uploader.php';
    require dirname(__FILE__) . '/includes/class-options-sanitization.php';

    // Instantiate the main plugin class.
    $options_framework = new Options_Framework;
    $options_framework->init();

    // Instantiate the options page.
    $options_framework_admin = new Options_Framework_Admin;
    $options_framework_admin->init();

    // Instantiate the media uploader class
    $options_framework_media_uploader = new Options_Framework_Media_Uploader;
    $options_framework_media_uploader->init();
}

add_action('init', 'optionsframework_init', 20);

/**
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * Not in a class to support backwards compatibility in themes.
 */
if (!function_exists('of_get_option')) {

    function of_get_option($name, $default = false) {
        $option_name = optionsframework_option_name();
        $options = get_option($option_name);

        if (isset($options[$name])) {
            return $options[$name];
        }

        return $default;
    }

}

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */
function optionsframework_option_name() {
    return 'sparklestore-pro-options';
}
