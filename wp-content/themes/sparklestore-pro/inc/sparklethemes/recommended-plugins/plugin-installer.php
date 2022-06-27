<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    die();
}

if (!class_exists('Sparklestore_Pro_Plugin_Installer')) {

    final class Sparklestore_Pro_Plugin_Installer {

        /**
         * A reference to an instance of this class.
         *
         * @since  1.0.0
         * @access private
         * @var    object
         */
        private static $instance = null;

        /**
         * Initiator
         *
         * @since 1.0.0
         * @return object
         */
        public static function get_instance() {
            if (!isset(self::$instance)) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function __construct() {
            /** WordPress Plugin Installation Ajax * */
            add_action('wp_ajax_plugin_installer', array($this, 'plugin_installer_callback'));

            /** Bundled & Remote Plugin Installation Ajax * */
            add_action('wp_ajax_plugin_offline_installer', array($this, 'plugin_offline_installer_callback'));

            /** Plugin Activation Ajax * */
            add_action('wp_ajax_plugin_activation', array($this, 'plugin_activation_callback'));

            /** Plugin Deactivation Ajax * */
            add_action('wp_ajax_plugin_deactivation', array($this, 'plugin_deactivation_callback'));

            /* Enqueue Styles & Scripts for Welcome Page */
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        }

        /** Enqueue Necessary Styles and Scripts for the Welcome Page * */
        public function enqueue_scripts() {
            wp_enqueue_script('plugin-installer', get_template_directory_uri() . '/inc/sparklethemes/recommended-plugins/js/plugin-installer.js', array('jquery'));

            wp_localize_script('plugin-installer', 'PluginInstallerObject', array(
                'ajaxurl' => esc_url(admin_url('admin-ajax.php')),
                'admin_nonce' => wp_create_nonce('plugin_installer_nonce'),
                'activate_nonce' => wp_create_nonce('plugin_activate_nonce'),
                'deactivate_nonce' => wp_create_nonce('plugin_deactivate_nonce'),
                'activate_btn' => esc_html__('Activate', 'sparklestore-pro'),
                'installed_btn' => esc_html__('Installed', 'sparklestore-pro'),
                'activating_btn' => esc_html__('Activating', 'sparklestore-pro'),
                'installing_btn' => esc_html__('Installing', 'sparklestore-pro'),
                'error_message' => esc_html__('Something went wrong. Plugin can not be installed.', 'sparklestore-pro'),
                'wait_message' => esc_html__('Please wait for the previous action to complete.', 'sparklestore-pro')
            ));
        }

        /** Plugin API * */
        public static function call_plugin_api($slug) {
            include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

            $call_api = plugins_api('plugin_information', array(
                'slug' => $slug,
                'fields' => array(
                    'downloaded' => false,
                    'rating' => false,
                    'description' => false,
                    'short_description' => false,
                    'donate_link' => false,
                    'tags' => false,
                    'sections' => false,
                    'homepage' => false,
                    'added' => false,
                    'last_updated' => false,
                    'compatibility' => false,
                    'tested' => false,
                    'requires' => false,
                    'downloadlink' => false,
                    'icons' => true
            )));

            return $call_api;
        }

        /** Check For Icon * */
        public static function check_for_icon($arr) {
            if (!empty($arr['svg'])) {
                $plugin_icon_url = $arr['svg'];
            } elseif (!empty($arr['2x'])) {
                $plugin_icon_url = $arr['2x'];
            } elseif (!empty($arr['1x'])) {
                $plugin_icon_url = $arr['1x'];
            } else {
                $plugin_icon_url = $arr['default'];
            }

            return $plugin_icon_url;
        }

        /** Check if Plugin is active or not * */
        public static function plugin_active_status($plugin) {
            $slug = $plugin['slug'];
            $path = isset($plugin['path']) ? $plugin['path'] : esc_attr($slug) . '/' . esc_attr($slug) . '.php';
            $status = 'install';

            $plugin_path = WP_PLUGIN_DIR . '/' . $path;
            if (file_exists($plugin_path)) {
                $status = is_plugin_active($path) ? 'active' : 'inactive';
            }
            return $status;
        }

        /** Generate Url for the Plugin Button * */
        public static function generate_plugin_url($plugin) {
            extract($plugin);
            $status = self::plugin_active_status($plugin);
            $url = 'javascript:void()';
            if ($status == 'install' && $host_type == 'remote') {
                $url = $location;
            }
            return $url;
        }

        /** Generate Class for the Plugin Button * */
        public static function generate_plugin_class($plugin) {
            $status = self::plugin_active_status($plugin);
            switch ($status) {
                case 'install' :
                    $btn_class = 'install button button-primary';
                    break;

                case 'inactive' :
                    $btn_class = 'activate button button-primary';
                    break;

                case 'active' :
                    $btn_class = 'installed button';
                    break;
            }

            return $btn_class;
        }

        /** Generate Label for the Plugin Button * */
        public static function generate_plugin_label($plugin) {
            $status = self::plugin_active_status($plugin);
            switch ($status) {
                case 'install' :
                    $btn_label = esc_html__('Install', 'sparklestore-pro');
                    break;

                case 'inactive' :
                    $btn_label = esc_html__('Activate', 'sparklestore-pro');
                    break;

                case 'active' :
                    $btn_label = esc_html__('Installed', 'sparklestore-pro');
                    break;
            }
            return $btn_label;
        }

        /** Generate Icon Url for the Plugin Button * */
        public static function generate_plugin_thumb($plugin) {
            $thumb = '';
            if (isset($plugin['source'])) {
                $thumb = $plugin['icon'];
            } else {
                $info = self::call_plugin_api($plugin['slug']);
                $thumb = self::check_for_icon($info->icons);
            }
            return $thumb;
        }

        /** Generate Version * */
        public static function generate_plugin_version($plugin) {
            $version = '';
            if (isset($plugin['source'])) {
                $version = $plugin['version'];
            } else {
                $info = self::call_plugin_api($plugin['slug']);
                $version = $info->version;
            }
            return $version;
        }

        /** Generate Version * */
        public static function generate_plugin_author($plugin) {
            $version = '';
            if (isset($plugin['source'])) {
                $author = $plugin['author'];
            } else {
                $info = self::call_plugin_api($plugin['slug']);
                $author = $info->author;
            }
            return $author;
        }

        /** Generate Version * */
        public static function generate_plugin_name($plugin) {
            $version = '';
            if (isset($plugin['source'])) {
                $name = $plugin['name'];
            } else {
                $info = self::call_plugin_api($plugin['slug']);
                $name = $info->name;
            }
            return $name;
        }

        /* ========== Plugin Installation Ajax =========== */

        public function plugin_installer_callback() {

            if (!current_user_can('install_plugins')) {
                wp_send_json(
                        array(
                            'success' => false,
                            'message' => esc_html__('Sorry, you are not allowed to install plugins on this site.', 'sparklestore-pro')
                        )
                );
                die();
            }

            $nonce = isset($_POST['nonce']) ? sanitize_text_field(wp_unslash($_POST['nonce'])) : '';
            $slug = isset($_POST['slug']) ? sanitize_text_field(wp_unslash($_POST['slug'])) : '';
            $path = isset($_POST['path']) ? sanitize_text_field(wp_unslash($_POST['path'])) : '';

            // Check our nonce, if they don't match then bounce!
            if (!wp_verify_nonce($nonce, 'plugin_installer_nonce')) {
                wp_send_json(
                        array(
                            'success' => false,
                            'message' => esc_html__('Error - unable to verify nonce, please try again.', 'sparklestore-pro')
                        )
                );
                die();
            }

            // Include required libs for installation
            require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
            require_once ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php';
            require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';

            // Get Plugin Info
            $api = self::call_plugin_api($slug);

            $skin = new WP_Ajax_Upgrader_Skin();
            $upgrader = new Plugin_Upgrader($skin);
            $upgrader->install($api->download_link);

            if ($path) {
                $activate = activate_plugin($path, '', false, true);
                wp_send_json_success();
            }

            die();
        }

        /** Plugin Offline Installation Ajax * */
        public function plugin_offline_installer_callback() {
            if (!current_user_can('install_plugins')) {
                wp_send_json(
                        array(
                            'success' => false,
                            'message' => esc_html__('Sorry, you are not allowed to install plugins on this site.', 'sparklestore-pro')
                        )
                );
                die();
            }

            $source = isset($_POST['source']) ? sanitize_text_field(wp_unslash($_POST['source'])) : '';
            $nonce = isset($_POST['nonce']) ? sanitize_text_field(wp_unslash($_POST['nonce'])) : '';
            $slug = isset($_POST['slug']) ? sanitize_text_field(wp_unslash($_POST['slug'])) : '';
            $path = isset($_POST['path']) ? sanitize_text_field(wp_unslash($_POST['path'])) : '';

            // Check our nonce, if they don't match then bounce!
            if (!wp_verify_nonce($nonce, 'plugin_installer_nonce')) {
                wp_send_json(
                        array(
                            'success' => false,
                            'message' => esc_html__('Error - unable to verify nonce, please try again.', 'sparklestore-pro')
                        )
                );
                die();
            }

            if ($source) {
                $upload_path = $this->get_local_dir_path($source, $slug);
                $plugin_file = WP_PLUGIN_DIR . '/' . esc_html($path);

                $zip = new ZipArchive();
                if ($zip->open($upload_path) === TRUE) {
                    $zip->extractTo(WP_PLUGIN_DIR);
                    $zip->close();

                    if (file_exists($plugin_file)) {
                        activate_plugin($plugin_file);
                    }

                    unlink($upload_path);

                    wp_send_json_success();
                }
            } else {
                wp_send_json(
                        array(
                            'success' => false,
                            'message' => __('Missing File Location.', 'sparklestore-pro')
                        )
                );
            }

            die();
        }

        /** Plugin Offline Activation Ajax * */
        public function plugin_activation_callback() {

            $slug = isset($_POST['slug']) ? sanitize_text_field(wp_unslash($_POST['slug'])) : '';
            $path = isset($_POST['path']) ? sanitize_text_field(wp_unslash($_POST['path'])) : '';
            $nonce = isset($_POST['nonce']) ? sanitize_text_field(wp_unslash($_POST['nonce'])) : '';
            $plugin_file = WP_PLUGIN_DIR . '/' . esc_html($path);

            // Check our nonce, if they don't match then bounce!
            if (!wp_verify_nonce($nonce, 'plugin_activate_nonce')) {
                wp_send_json(
                        array(
                            'success' => false,
                            'message' => esc_html__('Error - unable to verify nonce, please try again.', 'sparklestore-pro')
                        )
                );
                die();
            }

            if (file_exists($plugin_file)) {
                activate_plugin($plugin_file);
                wp_send_json_success();
            } else {
                wp_send_json(
                        array(
                            'success' => false,
                            'message' => __('Error!! Plugin not activated.', 'sparklestore-pro')
                        )
                );
            }

            die();
        }

        /** Plugin Offline Activation Ajax * */
        public function plugin_deactivation_callback() {

            $plugin = isset($_POST['plugin']) ? sanitize_text_field(wp_unslash($_POST['plugin'])) : '';
            $plugin_file = isset($_POST['plugin_file']) ? sanitize_text_field(wp_unslash($_POST['plugin_file'])) : '';
            $plugin_file = WP_PLUGIN_DIR . '/' . esc_html($plugin) . '/' . esc_html($plugin_file);
            $nonce = isset($_POST['nonce']) ? sanitize_text_field(wp_unslash($_POST['nonce'])) : '';

            // Check our nonce, if they don't match then bounce!
            if (!wp_verify_nonce($nonce, 'plugin_deactivate_nonce')) {
                wp_send_json(
                        array(
                            'success' => false,
                            'message' => esc_html__('Error - unable to verify nonce, please try again.', 'sparklestore-pro')
                        )
                );
                die();
            }

            if (file_exists($plugin_file)) {
                deactivate_plugins($plugin_file);
                wp_send_json_success();
            } else {
                wp_send_json(
                        array(
                            'success' => false,
                            'message' => __('Error!! Plugin not deactivated.', 'sparklestore-pro')
                        )
                );
            }

            die();
        }

        public function get_local_dir_path($file_location, $slug) {

            if (isset($file_location)) {
                $upload_dir = wp_upload_dir();

                $upload_path = $upload_dir['path'] . '/' . $slug . '.zip';

                $url = wp_nonce_url(admin_url('themes.php?page=sparklestore-pro-install-plugins'), 'remote-file-installation');
                if (false === ($creds = request_filesystem_credentials($url, '', false, false, null) )) {
                    return; // stop processing here
                }

                if (!WP_Filesystem($creds)) {
                    request_filesystem_credentials($url, '', true, false, null);
                    return;
                }

                global $wp_filesystem;
                $file = $wp_filesystem->get_contents($file_location);

                $wp_filesystem->put_contents($upload_path, $file, FS_CHMOD_FILE);

                return $upload_path;
            }
        }

    }

}

Sparklestore_Pro_Plugin_Installer::get_instance();
