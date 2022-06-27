<?php

/*
 * Credit: NiceThemes<http://nicethemes.com/>
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}


// Load dependencies.
if (!function_exists('get_plugins')) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

/**
 * Class Sparkle_PLus_System_Status
 *
 * Set of methods to gather system information.
 *
 */
class Sparkle_PLus_System_Status {
    /** ==========================================================================
     *  Properties.
     *  ======================================================================= */

    /**
     * Home URL.
     *
     * The URL of the site's homepage.
     *
     *
     * @var null|string
     */
    protected $home_url = null;

    /**
     * Site URL.
     *
     * The root URL of the site.
     *
     *
     * @var null|string
     */
    protected $site_url = null;

    /**
     * WordPress' version.
     *
     * The version of WordPress installed on the site.
     *
     *
     * @var null|string
     */
    protected $wp_version = null;

    /**
     * WordPress Multisite.
     *
     * Whether or not is WordPress Multisite enabled.
     *
     *
     * @var null|bool
     */
    protected $wp_multisite = null;

    /**
     * WordPress' memory limit.
     *
     * The maximum amount of memory (RAM) that the site can use at one time.
     *
     *
     * @var null|int
     */
    protected $wp_memory_limit = null;

    /**
     * WordPress' maximum upload file size.
     *
     * The largest file size that can be uploaded to this WordPress installation.
     *
     *
     * @var null|int
     */
    protected $wp_max_upload_size = null;

    /**
     * WordPress' allowed mime types for the current user.
     *
     * The mime types and file extensions the current user can upload to this WordPress installation.
     *
     *
     * @var null|array
     */
    protected $wp_mime_types = null;

    /**
     * WordPress' locale.
     *
     * The language currently used by WordPress. Default: en_US (US English).
     *
     *
     * @var null|string
     */
    protected $wp_locale = null;

    /**
     * WordPress' remote GET.
     *
     * Whether or not can the GET method be used to communicate with different APIs.
     *
     *
     * @var null|bool
     */
    protected $wp_remote_get = null;

    /**
     * WordPress' remote POST.
     *
     * Whether or not can the POST method be used to communicate with different APIs.
     *
     *
     * @var null|bool
     */
    protected $wp_remote_post = null;

    /**
     * WordPress' debug mode.
     *
     * Whether or not is WordPress in debug mode.
     *
     *
     * @var null|bool
     */
    protected $wp_debug_mode = null;

    /**
     * Check if the upload directory is writable.
     *
     *
     * @var null|bool
     */
    protected $is_wp_uploads_dir_writable = null;

    /**
     * WordPress' uploads URL.
     *
     * URL of the uploads folder for the site.
     *
     *
     * @var null|string
     */
    protected $wp_uploads_url = null;

    /**
     * WordPress' uploads path.
     *
     * Path of the uploads folder for the site.
     *
     *
     * @var null|string
     */
    protected $wp_uploads_path = null;

    /**
     * WordPress' uploads subdir.
     *
     * Uploads sub-folder for the site.
     *
     *
     * @var null|string
     */
    protected $wp_uploads_subdir = null;

    /**
     * WordPress' rewrite rules.
     *
     * List of the rewrite rules currently defined for the site.
     *
     *
     * @var null|array
     */
    protected $wp_rewrite_rules = null;

    /**
     * WordPress' Post types.
     *
     * List of post types which are currently registered in the site.
     *
     *
     * @var null|array
     */
    protected $wp_post_types = null;

    /**
     * WordPress' taxonomies.
     *
     * List of taxonomies which are currently registered in the site.
     *
     *
     * @var null|array
     */
    protected $wp_taxonomies = null;

    /**
     * WordPress' current users.
     *
     * User currently logged in and loading this page.
     *
     *
     * @var null|array
     */
    protected $wp_current_user = null;

    /**
     * WordPress' users.
     *
     * List of users which are currently registered in the site.
     *
     *
     * @var null|array
     */
    protected $wp_users = null;

    /**
     * WordPress' user roles.
     *
     * List of available user roles.
     *
     *
     * @var null|array
     */
    protected $wp_roles = null;

    /**
     * WordPress' user capabilities.
     *
     * List of available user capabilities.
     *
     *
     * @var null|array
     */
    protected $wp_capabilities = null;

    /**
     * Server information.
     *
     * Information about the web server that is currently hosting the site.
     *
     *
     * @var null|string
     */
    protected $server_info = null;

    /**
     * Server timezone.
     *
     * The default timezone for the server.
     *
     *
     * @var null|string
     */
    protected $server_timezone = null;

    /**
     * PHP version.
     *
     * The version of PHP installed on the hosting server.
     *
     *
     * @var null|string
     */
    protected $php_version = null;

    /**
     * PHP's maximum input variables.
     *
     * The maximum number of variables the server can use for a single function to avoid overloads.
     *
     *
     * @var null|int
     */
    protected $php_max_input_vars = null;

    /**
     * PHP's POST maximum size.
     *
     * The largest file size that can be contained in one POST request.
     *
     *
     * @var null|int
     */
    protected $php_post_max_size = null;

    /**
     * PHP's time limit.
     *
     * The amount of time (in seconds) that the site will spend on a single operation before timing out (to avoid server lockups).
     *
     *
     * @var null|int
     */
    protected $php_time_limit = null;

    /**
     * PHP information
     *
     * The output of the `phpinfo()` function.
     *
     *
     * @var null|string
     */
    protected $phpinfo = null;

    /**
     * MySQL version.
     *
     * The version of MySQL installed on the hosting server.
     *
     *
     * @var null|string
     */
    protected $mysql_version = null;

    /**
     * Theme name.
     *
     * The name of the currently active theme.
     *
     *
     * @var null|string
     */
    protected $theme_name = null;

    /**
     * Theme slug.
     *
     * The slug of the currently active theme.
     *
     *
     * @var null|string
     */
    protected $theme_slug = null;

    /**
     * Theme URL.
     *
     * The URL of the currently active theme.
     *
     *
     * @var null|string
     */
    protected $theme_url = null;

    /**
     * Theme path.
     *
     * The path of the currently active theme.
     *
     *
     * @var null|string
     */
    protected $theme_path = null;

    /**
     * Theme version.
     *
     * The installed version of the currently active theme.
     *
     *
     * @var null|string
     */
    protected $theme_version = null;

    /**
     * Theme author's URL.
     *
     * The currently active theme developer's URL.
     *
     *
     * @var null|string
     */
    protected $theme_author_url = null;

    /**
     * Child theme.
     *
     * Whether or not is the currently active theme a child theme.
     *
     *
     * @var null|string
     */
    protected $child_theme = null;

    /**
     * Parent theme name.
     *
     * The name of the parent theme.
     *
     *
     * @var null|string
     */
    protected $parent_theme_name = null;

    /**
     * Parent theme slug.
     *
     * The slug of the parent theme.
     *
     *
     * @var null|string
     */
    protected $parent_theme_slug = null;

    /**
     * Parent theme URL.
     *
     * The URL of the parent theme.
     *
     *
     * @var null|string
     */
    protected $parent_theme_url = null;

    /**
     * Parent theme path.
     *
     * The path of the parent theme.
     *
     *
     * @var null|string
     */
    protected $parent_theme_path = null;

    /**
     * Parent theme version.
     *
     * The installed version of the parent theme.
     *
     *
     * @var null|string
     */
    protected $parent_theme_version = null;

    /**
     * Parent theme author's URL.
     *
     * The parent theme developer's URL.
     *
     *
     * @var null|string
     */
    protected $parent_theme_author_url = null;

    /**
     * All plugin updates.
     *
     * List of plugins which have a newer version available.
     *
     *
     * @var null|array
     */
    protected $plugin_updates = null;

    /**
     * Repository plugin updates.
     *
     * List of repository plugins which have a newer version available.
     *
     *
     * @var null|array
     */
    protected $plugin_repo_updates = null;

    /**
     * All plugins.
     *
     * List of plugins which are required, recommended and/or present in the current WordPress installation.
     *
     *
     * @var null|array
     */
    protected $plugins = null;

    /**
     * Installed plugins.
     *
     * List of plugins which are present in the current WordPress installation.
     *
     *
     * @var null|array
     */
    protected $installed_plugins = null;

    /**
     * Required plugins.
     *
     * List of plugins which are required or recommended by the TGMPA class.
     *
     *
     * @var null|array
     */
    protected $required_plugins = null;

    /**
     * Active plugins.
     *
     * List of plugins which are currently active in this WordPress installation.
     *
     *
     * @var null|array
     */
    protected $active_plugins = null;

    /**
     * Inactive plugins.
     *
     * List of plugins which are currently installed, but inactive in this WordPress installation.
     *
     *
     * @var null|array
     */
    protected $inactive_plugins = null;

    /**
     * All plugins slugs.
     *
     * List of paths => slugs of all plugins.
     *
     *
     * @var null|array
     */
    protected $plugins_slugs = null;

    /**
     * Installed plugins slugs.
     *
     * List of paths => slugs of installed plugins.
     *
     *
     * @var null|array
     */
    protected $installed_plugins_slugs = null;

    /**
     * Required plugins slugs.
     *
     * List of paths => slugs of required plugins.
     *
     *
     * @var null|array
     */
    protected $required_plugins_slugs = null;

    /**
     * Active plugins slugs.
     *
     * List of paths => slugs of active plugins.
     *
     *
     * @var null|array
     */
    protected $active_plugins_slugs = null;

    /**
     * Inactive plugins slugs.
     *
     * List of paths => slugs of inactive plugins.
     *
     *
     * @var null|array
     */
    protected $inactive_plugins_slugs = null;

    /**
     * WordPress' file system handler.
     *
     *
     * @var null|WP_Filesystem_Base
     */
    protected $wp_filesystem = null; // WPCS: override ok.

    /** ==========================================================================
     *  Constructing methods.
     *  ======================================================================= */

    /**
     * Obtain a Sparkle_PLus_System_Status object.
     *
     * The instance is saved to a static variable, so it can be retrieved
     * later without needing to be reinitialized.
     *
     *
     * @return Sparkle_PLus_System_Status
     */
    public static function obtain() {
        static $system_status = null;

        if (is_null($system_status)) {
            $system_status = new self();
        }

        return $system_status;
    }

    /** ==========================================================================
     *  Getters & Setters.
     *  ======================================================================= */

    /**
     * Obtain the value of a property.
     *
     *
     * @param  string $property
     *
     * @return null|string
     */
    public function __get($property) {
        if (method_exists($this, 'get_' . $property)) {
            return call_user_func(array($this, 'get_' . $property));
        }

        if (property_exists($this, $property)) {
            return $this->$property;
        }

        return null;
    }

    /**
     * Obtain currently active theme.
     *
     * @uses wp_get_theme()
     *
     *
     * @return null|WP_Theme
     */
    public function get_theme() {
        static $theme = null;

        if (is_null($theme)) {
            $theme = wp_get_theme();
        }

        return $theme;
    }

    /**
     * Obtain parent theme.
     *
     * @uses wp_get_theme()
     *
     *
     * @return null|WP_Theme
     */
    public function get_parent_theme() {
        static $parent_theme = null;

        if (is_null($parent_theme) && $this->is_child_theme()) {
            $child_theme = $this->get_theme();
            $parent_theme = wp_get_theme($child_theme->{'Template'});
        }

        return $parent_theme;
    }

    /**
     * Obtain home URL.
     *
     *
     * @return null|string
     */
    public function get_home_url() {
        if (is_null($this->home_url)) {
            $this->set_home_url();
        }

        return $this->home_url;
    }

    /**
     * Set home URL.
     *
     * @uses home_url()
     *
     */
    protected function set_home_url() {
        $this->home_url = home_url('/');
    }

    /**
     * Obtain site URL.
     *
     *
     * @return null|string
     */
    public function get_site_url() {
        if (is_null($this->site_url)) {
            $this->set_site_url();
        }

        return $this->site_url;
    }

    /**
     * Set site URL.
     *
     * @uses site_url()
     *
     */
    protected function set_site_url() {
        $this->site_url = site_url();
    }

    /**
     * Obtain WordPress' version.
     *
     *
     * @return null|string
     */
    public function get_wp_version() {
        if (is_null($this->wp_version)) {
            $this->set_wp_version();
        }

        return $this->wp_version;
    }

    /**
     * Set WordPress' version.
     *
     * @uses get_bloginfo()
     *
     */
    protected function set_wp_version() {
        $this->wp_version = get_bloginfo('version');
    }

    /**
     * Obtain the recommended version of WordPress to run the theme. By
     * default, this should always be the latest version available.
     *
     * @note   Since this method uses a transient to avoid constant remote
     *         requests, there may be a 12 hour gap between versions.
     *
     *
     * @uses   get_transient()
     * @uses   set_transient()
     * @uses   wp_remote_get()
     *
     * @return string
     */
    public function get_recommended_wp_version() {
        $latest_version = null;

        if (!$latest_version = get_transient('sparklestore_pro_system_status_recommended_wp_version')) {
            $url = 'https://api.wordpress.org/core/version-check/1.7/';
            $response = wp_remote_get($url);

            if (!is_wp_error($response) && isset($response['body'])) {
                $json = $response['body'];
                $obj = json_decode($json);

                $upgrade = $obj->offers[0];
                $latest_version = $upgrade->version;

                set_transient('sparklestore_pro_system_status_recommended_wp_version', $latest_version, 60 * 60 * 12); // Updates every 12 hours.
            }
        }

        /**
         * @hook sparklestore_pro_system_status_recommended_wp_version
         *
         * Hook in here to modify the default recommended WP version.
         *
         */
        return apply_filters('sparklestore_pro_system_status_recommended_wp_version', $latest_version);
    }

    /**
     * Obtain the required version of WordPress to run the theme.
     *
     *
     * @return string
     */
    public function get_required_wp_version() {
        /**
         * @hook sparklestore_pro_system_status_required_wp_version
         *
         * Hook in here to modify the required WP version.
         *
         */
        return apply_filters('sparklestore_pro_system_status_required_wp_version', '4.4');
    }

    /**
     * Obtain WordPress multisite flag.
     *
     *
     * @return null|bool
     */
    public function get_wp_multisite() {
        if (is_null($this->wp_multisite)) {
            $this->set_wp_multisite();
        }

        return $this->wp_multisite;
    }

    /**
     * Set WordPress multisite flag.
     *
     * @uses is_multisite()
     *
     */
    protected function set_wp_multisite() {
        $this->wp_multisite = is_multisite();
    }

    /**
     * Obtain WordPress' memory limit.
     *
     *
     * @return null|int
     */
    public function get_wp_memory_limit() {

        if (is_null($this->wp_memory_limit)) {
            $this->set_wp_memory_limit();
        }

        return $this->wp_memory_limit;
    }

    /**
     * Set WordPress' memory limit.
     *
     */
    protected function set_wp_memory_limit() {
        $this->wp_memory_limit = $this->convert_let_to_num(WP_MEMORY_LIMIT);
        if (function_exists('memory_get_usage')) {
            $this->wp_memory_limit = max($this->wp_memory_limit, $this->convert_let_to_num(@ini_get('memory_limit')));
        }
    }

    /**
     * Obtain WordPress' maximum upload file size.
     *
     *
     * @return null|int
     */
    public function get_wp_max_upload_size() {
        if (is_null($this->wp_max_upload_size)) {
            $this->set_wp_max_upload_size();
        }

        return $this->wp_max_upload_size;
    }

    /**
     * Set WordPress' maximum upload file size.
     *
     * @uses wp_max_upload_size()
     *
     */
    protected function set_wp_max_upload_size() {
        $this->wp_max_upload_size = wp_max_upload_size();
    }

    /**
     * Obtain WordPress' allowed mime types for the current user.
     *
     *
     * @return null|array
     */
    public function get_wp_mime_types() {
        if (is_null($this->wp_mime_types)) {
            $this->set_wp_mime_types();
        }

        return $this->wp_mime_types;
    }

    /**
     * Set WordPress' allowed mime types for the current user.
     *
     * @uses get_allowed_mime_types()
     *
     */
    protected function set_wp_mime_types() {
        $this->wp_mime_types = get_allowed_mime_types();
    }

    /**
     * Obtain WordPress' locale.
     *
     *
     * @return null|string
     */
    public function get_wp_locale() {
        if (is_null($this->wp_locale)) {
            $this->set_wp_locale();
        }

        return $this->wp_locale;
    }

    /**
     * Set WordPress' locale.
     *
     * @uses get_locale()
     *
     */
    protected function set_wp_locale() {
        $this->wp_locale = get_locale();
    }

    /**
     * Obtain WordPRess' remote GET.
     *
     *
     * @return null|bool
     */
    public function get_wp_remote_get() {
        if (is_null($this->wp_remote_get)) {
            $this->set_wp_remote_get();
        }

        return $this->wp_remote_get;
    }

    /**
     * Set WordPress' remote GET.
     *
     */
    protected function set_wp_remote_get() {
        $response = wp_remote_get('https://wordpress.org');

        $this->wp_remote_get = (!is_wp_error($response) && 300 > $response['response']['code'] && 200 <= $response['response']['code'] );
    }

    /**
     * Obtain WordPress' remote POST.
     *
     *
     * @return null|bool
     */
    public function get_wp_remote_post() {
        if (is_null($this->wp_remote_post)) {
            $this->set_wp_remote_post();
        }

        return $this->wp_remote_post;
    }

    /**
     * Set WordPress' remote POST.
     *
     */
    protected function set_wp_remote_post() {
        $response = wp_remote_post('https://wordpress.org');

        $this->wp_remote_post = (!is_wp_error($response) && 300 > $response['response']['code'] && 200 <= $response['response']['code'] );
    }

    /**
     * Obtain WordPress' debug mode.
     *
     *
     * @return null|bool
     */
    public function get_wp_debug_mode() {
        if (is_null($this->wp_debug_mode)) {
            $this->set_wp_debug_mode();
        }

        return $this->wp_debug_mode;
    }

    /**
     * Set WordPress' debug mode.
     *
     */
    protected function set_wp_debug_mode() {
        $this->wp_debug_mode = ( defined('WP_DEBUG') && WP_DEBUG );
    }

    /**
     * Obtain WordPress' uploads URL.
     *
     *
     * @return null|string
     */
    public function get_wp_uploads_url() {
        if (is_null($this->wp_uploads_url)) {
            $this->set_wp_uploads_url();
        }

        return $this->wp_uploads_url;
    }

    /**
     * Set WordPress' uploads URL.
     *
     */
    protected function set_wp_uploads_url() {
        $upload_dir = wp_upload_dir();
        $this->wp_uploads_url = $upload_dir['baseurl'];
    }

    /**
     * Obtain WordPress' uploads path.
     *
     *
     * @return null|string
     */
    public function get_wp_uploads_path() {
        if (is_null($this->wp_uploads_path)) {
            $this->set_wp_uploads_path();
        }

        return $this->wp_uploads_path;
    }

    /**
     * Set WordPress' uploads path.
     *
     */
    protected function set_wp_uploads_path() {
        $upload_dir = wp_upload_dir();
        $this->wp_uploads_path = $upload_dir['basedir'];
    }

    /**
     * Obtain WordPress' uploads subdir.
     *
     *
     * @return null|string
     */
    public function get_wp_uploads_subdir() {
        if (is_null($this->wp_uploads_subdir)) {
            $this->set_wp_uploads_subdir();
        }

        return $this->wp_uploads_subdir;
    }

    /**
     * Set WordPress' uploads subdir.
     *
     */
    protected function set_wp_uploads_subdir() {
        $upload_dir = wp_upload_dir();
        $this->wp_uploads_subdir = $upload_dir['subdir'];
    }

    /**
     * Check if the upload directory is writable.
     * .4
     *
     * @return bool|null
     */
    public function is_wp_uploads_dir_writable() {
        if (is_null($this->is_wp_uploads_dir_writable)) {
            $this->is_wp_uploads_dir_writable = wp_is_writable($this->get_wp_uploads_full_path());
        }

        return $this->is_wp_uploads_dir_writable;
    }

    /**
     * Obtain WordPress' rewrite rules.
     *
     *
     * @return null|array
     */
    public function get_wp_rewrite_rules() {
        if (is_null($this->wp_rewrite_rules)) {
            $this->set_wp_rewrite_rules();
        }

        return $this->wp_rewrite_rules;
    }

    /**
     * Set WordPress' rewrite rules.
     *
     */
    protected function set_wp_rewrite_rules() {
        global $wp_rewrite;

        $this->wp_rewrite_rules = $wp_rewrite->wp_rewrite_rules();
    }

    /**
     * Obtain post types.
     *
     *
     * @return null|array
     */
    public function get_wp_post_types() {
        if (is_null($this->wp_post_types)) {
            $this->set_wp_post_types();
        }

        return $this->wp_post_types;
    }

    /**
     * Set post types.
     *
     */
    protected function set_wp_post_types() {
        $this->wp_post_types = json_decode(wp_json_encode(get_post_types(array(), 'objects')), true);
    }

    /**
     * Obtain taxonomies.
     *
     *
     * @return null|array
     */
    public function get_wp_taxonomies() {
        if (is_null($this->wp_taxonomies)) {
            $this->set_wp_taxonomies();
        }

        return $this->wp_taxonomies;
    }

    /**
     * Set taxonomies.
     *
     */
    protected function set_wp_taxonomies() {
        $this->wp_taxonomies = json_decode(wp_json_encode(get_taxonomies(array(), 'objects')), true);
    }

    /**
     * Obtain current user.
     *
     *
     * @return null|array
     */
    public function get_wp_current_user() {
        if (is_null($this->wp_current_user)) {
            $this->set_wp_current_user();
        }

        return $this->wp_current_user;
    }

    /**
     * Set current user.
     *
     */
    protected function set_wp_current_user() {
        $this->wp_current_user = is_user_logged_in() ? json_decode(wp_json_encode(wp_get_current_user()), true) : false;
    }

    /**
     * Obtain users.
     *
     *
     * @return null|array
     */
    public function get_wp_users() {
        if (is_null($this->wp_users)) {
            $this->set_wp_users();
        }

        return $this->wp_users;
    }

    /**
     * Set users.
     *
     */
    protected function set_wp_users() {
        $this->wp_users = json_decode(wp_json_encode(get_users()), true);
    }

    /**
     * Obtain roles.
     *
     *
     * @return null|array
     */
    public function get_wp_roles() {
        if (is_null($this->wp_roles)) {
            $this->set_wp_roles();
        }

        return $this->wp_roles;
    }

    /**
     * Set roles.
     *
     */
    protected function set_wp_roles() {
        $this->wp_roles = json_decode(wp_json_encode(get_editable_roles()), true);
    }

    /**
     * Obtain capabilities.
     *
     *
     * @return null|array
     */
    public function get_wp_capabilities() {
        if (is_null($this->wp_capabilities)) {
            $this->set_wp_capabilities();
        }

        return $this->wp_capabilities;
    }

    /**
     * Set capabilities.
     *
     */
    protected function set_wp_capabilities() {
        $wp_capabilities = array();

        foreach ($this->get_wp_roles() as $role_slug => $role_data) {
            foreach ($role_data['capabilities'] as $capability => $enabled) {
                if (!isset($wp_capabilities[$capability])) {
                    $wp_capabilities[$capability] = array();
                }

                $wp_capabilities[$capability][] = $role_slug;
            }
        }
        ksort($wp_capabilities);

        $this->wp_capabilities = $wp_capabilities;
    }

    /**
     * Obtain server information.
     *
     *
     * @return null|string
     */
    public function get_server_info() {
        if (is_null($this->server_info)) {
            $this->set_server_info();
        }

        return $this->server_info;
    }

    /**
     * Set server information.
     *
     */
    protected function set_server_info() {
        if (empty($_SERVER['SERVER_SOFTWARE'])) {
            return;
        }

        $this->server_info = wp_filter_nohtml_kses(wp_unslash($_SERVER['SERVER_SOFTWARE']));
    }

    /**
     * Obtain server timezone.
     *
     *
     * @return null|string
     */
    public function get_server_timezone() {
        if (is_null($this->server_timezone)) {
            $this->set_server_timezone();
        }

        return $this->server_timezone;
    }

    /**
     * Set server timezone.
     *
     */
    protected function set_server_timezone() {
        $this->server_timezone = date_default_timezone_get();
    }

    /**
     * Obtain PHP version.
     *
     *
     * @return null|string
     */
    public function get_php_version() {
        if (is_null($this->php_version)) {
            $this->set_php_version();
        }

        return $this->php_version;
    }

    /**
     * Set PHP version.
     *
     * @uses phpversion()
     *
     */
    protected function set_php_version() {
        if (function_exists('phpversion')) {
            $this->php_version = phpversion();
        }
    }

    /**
     * Obtain PHP's maximum input variables.
     *
     *
     * @return null|int
     */
    public function get_php_max_input_vars() {
        if (is_null($this->php_max_input_vars)) {
            $this->set_php_max_input_vars();
        }

        return $this->php_max_input_vars;
    }

    /**
     * Set PHP's maximum input variables.
     *
     * @uses ini_get()
     *
     */
    protected function set_php_max_input_vars() {
        if (function_exists('ini_get')) {
            $this->php_max_input_vars = ini_get('max_input_vars');
        }
    }

    /**
     * Obtain PHP's POST maximum size.
     *
     *
     * @return null|int
     */
    public function get_php_post_max_size() {
        if (is_null($this->php_post_max_size)) {
            $this->set_php_post_max_size();
        }

        return $this->php_post_max_size;
    }

    /**
     * Set PHP's POST maximum size.
     *
     * @uses ini_get()
     *
     */
    protected function set_php_post_max_size() {
        if (function_exists('ini_get')) {
            $this->php_post_max_size = $this->convert_let_to_num(ini_get('post_max_size'));
        }
    }

    /**
     * Obtain PHP's time limit.
     *
     *
     * @return null|int
     */
    public function get_php_time_limit() {
        if (is_null($this->php_time_limit)) {
            $this->set_php_time_limit();
        }

        return $this->php_time_limit;
    }

    /**
     * Set PHP's time limit.
     *
     * @uses ini_get()
     *
     */
    protected function set_php_time_limit() {
        if (function_exists('ini_get')) {
            $this->php_time_limit = ini_get('max_execution_time');
        }
    }

    /**
     * Obtain PHP information.
     *
     *
     * @return null|string
     */
    public function get_phpinfo() {
        if (is_null($this->phpinfo)) {
            $this->set_phpinfo();
        }

        return $this->phpinfo;
    }

    /**
     * Set PHP information.
     *
     * @uses phpinfo()
     *
     */
    protected function set_phpinfo() {
        ob_start();
        phpinfo();

        $this->phpinfo = ob_get_contents();
        ob_end_clean();
    }

    /**
     * Obtain MySQL version.
     *
     *
     * @return null|string
     */
    public function get_mysql_version() {
        if (is_null($this->mysql_version)) {
            $this->set_mysql_version();
        }

        return $this->mysql_version;
    }

    /**
     * Set MySQL version.
     *
     * @global wpdb $wpdb
     *
     */
    protected function set_mysql_version() {
        global $wpdb;
        $this->mysql_version = $wpdb->db_version();
    }

    /**
     * Obtain recommended MySQL version. This should always return the
     * recommended version noted in the Requirements page in wordpress.org.
     * .4
     *
     * @link   https://wordpress.org/about/requirements/
     *
     * @return string
     */
    public function get_recommended_mysql_version() {
        return apply_filters('sparklestore_pro_system_status_recommended_mysql_version', '5.6');
    }

    /**
     * Obtain the required MySQL version to run the theme. This should
     * always return the required version noted in the Requirements page in
     * wordpress.org.
     * .4
     *
     * @link   https://wordpress.org/about/requirements/
     *
     * @return string
     */
    public function get_required_mysql_version() {
        return apply_filters('sparklestore_pro_system_status_required_mysql_version', '5.0');
    }

    /**
     * Check if Xdebug is enabled.
     *
     *
     * @return bool
     */
    public function xdebug_enabled() {
        return function_exists('xdebug_get_code_coverage');
    }

    /**
     * Check if Apache's mod_security is enabled.
     *
     * @note:  This method might not be foolproof for all Apache webservers.
     *
     *
     * @return bool
     */
    public function mod_security_enabled() {
        if (function_exists('apache_get_modules') && in_array('mod_security', apache_get_modules(), true)) {
            return true;
        }

        ob_start();
        phpinfo(INFO_MODULES);
        $info = ob_get_clean();

        return ( strpos($info, 'mod_security') !== false );
    }


    public function server_unzip_enable(){
        if( class_exists('ZipArchive') ) return true;
        return false;
    }

    /**
     * Obtain theme name.
     *
     *
     * @return null|string
     */
    public function get_theme_name() {
        if (is_null($this->theme_name)) {
            $this->set_theme_name();
        }

        return $this->theme_name;
    }

    /**
     * Set theme name.
     *
     */
    protected function set_theme_name() {
        $theme = $this->get_theme();

        $this->theme_name = $theme->{'Name'};
    }

    /**
     * Obtain theme slug.
     *
     *
     * @return null|string
     */
    public function get_theme_slug() {
        if (is_null($this->theme_slug)) {
            $this->set_theme_slug();
        }

        return $this->theme_slug;
    }

    /**
     * Set theme slug.
     *
     */
    protected function set_theme_slug() {
        $theme = $this->get_theme();

        $this->theme_slug = $theme->get_stylesheet();
    }

    /**
     * Obtain theme URL.
     *
     *
     * @return null|string
     */
    public function get_theme_url() {
        if (is_null($this->theme_url)) {
            $this->set_theme_url();
        }

        return $this->theme_url;
    }

    /**
     * Set theme url.
     *
     */
    protected function set_theme_url() {
        $this->theme_url = get_stylesheet_directory_uri();
    }

    /**
     * Obtain theme path.
     *
     *
     * @return null|string
     */
    public function get_theme_path() {
        if (is_null($this->theme_path)) {
            $this->set_theme_path();
        }

        return $this->theme_path;
    }

    /**
     * Set theme path.
     *
     */
    protected function set_theme_path() {
        $this->theme_path = get_stylesheet_directory();
    }

    /**
     * Obtain theme version.
     *
     *
     * @return null|string
     */
    public function get_theme_version() {
        if (is_null($this->theme_version)) {
            $this->set_theme_version();
        }

        return $this->theme_version;
    }

    /**
     * Set theme version.
     *
     */
    protected function set_theme_version() {
        $theme = $this->get_theme();

        $this->theme_version = $theme->{'Version'};
    }

    /**
     * Obtain theme author's URL.
     *
     *
     * @return null|string
     */
    public function get_theme_author_url() {
        if (is_null($this->theme_author_url)) {
            $this->set_theme_author_url();
        }

        return $this->theme_author_url;
    }

    /**
     * Set theme author's URL.
     *
     */
    protected function set_theme_author_url() {
        $theme = $this->get_theme();

        $this->theme_author_url = $theme->{'Author URI'};
    }

    /**
     * Obtain child theme.
     *
     *
     * @return null|bool
     */
    public function get_child_theme() {
        if (is_null($this->child_theme)) {
            $this->set_child_theme();
        }

        return $this->child_theme;
    }

    /**
     * Set child theme.
     *
     * @uses is_child_theme()
     *
     */
    protected function set_child_theme() {
        $this->child_theme = is_child_theme();
    }

    /**
     * Obtain parent theme name.
     *
     *
     * @return null|string
     */
    public function get_parent_theme_name() {
        if (is_null($this->parent_theme_name)) {
            $this->set_parent_theme_name();
        }

        return $this->parent_theme_name;
    }

    /**
     * Set parent theme name.
     *
     */
    protected function set_parent_theme_name() {
        if ($this->get_child_theme()) {
            $parent_theme = $this->get_parent_theme();

            $this->parent_theme_name = $parent_theme->{'Name'};
        }
    }

    /**
     * Obtain parent theme slug.
     *
     *
     * @return null|string
     */
    public function get_parent_theme_slug() {
        if (is_null($this->parent_theme_slug)) {
            $this->set_parent_theme_slug();
        }

        return $this->parent_theme_slug;
    }

    /**
     * Set parent theme name.
     *
     */
    protected function set_parent_theme_slug() {
        if ($this->get_child_theme()) {
            $parent_theme = $this->get_parent_theme();

            $this->parent_theme_slug = $parent_theme->get_stylesheet();
        }
    }

    /**
     * Obtain parent theme URL.
     *
     *
     * @return null|string
     */
    public function get_parent_theme_url() {
        if (is_null($this->parent_theme_url)) {
            $this->set_parent_theme_url();
        }

        return $this->parent_theme_url;
    }

    /**
     * Set parent theme url.
     *
     */
    protected function set_parent_theme_url() {
        $this->parent_theme_url = get_template_directory_uri();
    }

    /**
     * Obtain parent theme path.
     *
     *
     * @return null|string
     */
    public function get_parent_theme_path() {
        if (is_null($this->parent_theme_path)) {
            $this->set_parent_theme_path();
        }

        return $this->parent_theme_path;
    }

    /**
     * Set parent theme path.
     *
     */
    protected function set_parent_theme_path() {
        $this->parent_theme_path = get_template_directory();
    }

    /**
     * Obtain parent theme version.
     *
     *
     * @return null|string
     */
    public function get_parent_theme_version() {
        if (is_null($this->parent_theme_version)) {
            $this->set_parent_theme_version();
        }

        return $this->parent_theme_version;
    }

    /**
     * Set parent theme version.
     *
     */
    protected function set_parent_theme_version() {
        if ($this->get_child_theme()) {
            $parent_theme = $this->get_parent_theme();

            $this->parent_theme_version = $parent_theme->{'Version'};
        }
    }

    /**
     * Obtain parent theme author's URL.
     *
     *
     * @return null|string
     */
    public function get_parent_theme_author_url() {
        if (is_null($this->parent_theme_author_url)) {
            $this->set_parent_theme_author_url();
        }

        return $this->parent_theme_author_url;
    }

    /**
     * Set parent theme author's URL.
     *
     */
    protected function set_parent_theme_author_url() {
        if ($this->get_child_theme()) {
            $parent_theme = $this->get_parent_theme();

            $this->parent_theme_author_url = $parent_theme->{'Author URI'};
        }
    }

    /**
     * Obtain all plugin updates.
     *
     *
     * @return array
     */
    public function get_plugin_updates() {
        if (is_null($this->plugin_updates)) {
            $this->set_plugin_updates();
        }

        return $this->plugin_updates;
    }

    /**
     * Set all plugin updates.
     *
     */
    public function set_plugin_updates() {
        $updates = $this->get_plugin_repo_updates();

        ksort($updates);

        $this->plugin_updates = $updates;
    }

    /**
     * Obtain plugin repository updates.
     *
     *
     * @return array
     */
    public function get_plugin_repo_updates() {
        if (is_null($this->plugin_repo_updates)) {
            $this->set_plugin_repo_updates();
        }

        return $this->plugin_repo_updates;
    }

    /**
     * Set plugin repository updates.
     *
     */
    public function set_plugin_repo_updates() {
        $repo_updates = array();
        $updates_data = get_site_transient('update_plugins');

        if (!empty($updates_data->response)) {
            foreach ($updates_data->response as $plugin_path => $update_data) {
                $repo_updates[$update_data->slug] = $update_data->new_version;
            }
        }

        $this->plugin_repo_updates = $repo_updates;
    }

    /**
     * Obtain all plugins.
     *
     *
     * @return null|array
     */
    public function get_plugins() {
        if (is_null($this->plugins)) {
            $this->set_plugins();
        }

        return $this->plugins;
    }

    /**
     * Set all plugins.
     *
     */
    protected function set_plugins() {
        $wp_installed_plugins = get_plugins();
        $wp_installed_mu_plugins = get_mu_plugins();
        $tgmpa_required_plugins = Sparklestore_Pro_Recommended_Plugins::get_recommended_plugins();

        $plugin_updates = $this->get_plugin_updates();

        $plugins = array();

        foreach (array_merge($wp_installed_plugins, $wp_installed_mu_plugins) as $plugin_path => $plugin_data) {
            $plugins[$plugin_path] = array(
                'name' => strip_tags($plugin_data['Name']),
                'slug' => $this->get_plugin_slug_from_path($plugin_path),
                'path' => $plugin_path,
                'description' => strip_tags($plugin_data['Description']),
                'external' => false,
                'version' => strip_tags($plugin_data['Version']),
                'new_version' => false,
                'url' => strip_tags($plugin_data['PluginURI']),
                'author_name' => strip_tags($plugin_data['AuthorName']),
                'author_url' => strip_tags($plugin_data['AuthorURI']),
                'required' => false,
                'recommended' => false,
                'installed' => true,
                'active' => is_plugin_active($plugin_path) || array_key_exists($plugin_path, $wp_installed_mu_plugins),
                'network_active' => $this->is_wp_multisite() && ( is_plugin_active_for_network($plugin_path) || array_key_exists($plugin_path, $wp_installed_mu_plugins) ),
                'must_use' => array_key_exists($plugin_path, $wp_installed_mu_plugins),
            );

            if (isset($plugin_updates[$plugins[$plugin_path]['slug']])) {
                $new_version = $plugin_updates[$plugins[$plugin_path]['slug']];

                if (version_compare($new_version, $plugins[$plugin_path]['version'], '>')) {
                    $plugins[$plugin_path]['new_version'] = $new_version;
                }
            }
        }

        $installed_plugins_slugs_to_paths = array_flip(wp_list_pluck($plugins, 'slug'));

        foreach ($tgmpa_required_plugins as $plugin_data) {
            if (empty($plugin_data['slug'])) {
                continue;
            }

            $plugin_slug = strip_tags($plugin_data['slug']);
            $plugin_path = isset($installed_plugins_slugs_to_paths[$plugin_slug]) ? $installed_plugins_slugs_to_paths[$plugin_slug] : $plugin_slug;

            if (!isset($plugins[$plugin_path])) {
                $plugins[$plugin_path] = array(
                    'name' => strip_tags($plugin_data['name']),
                    'slug' => $plugin_slug,
                    'path' => false,
                    'description' => strip_tags($plugin_data['description']),
                    'external' => false,
                    'version' => false,
                    'new_version' => false,
                    'url' => strip_tags($plugin_data['external_url']),
                    'author_name' => strip_tags($plugin_data['author_name']),
                    'author_url' => strip_tags($plugin_data['author_url']),
                    'required' => false,
                    'recommended' => false,
                    'installed' => false,
                    'active' => false,
                    'network_active' => false,
                    'must_use' => false,
                );
            }

            $plugins[$plugin_path]['external'] = (!( isset($plugin_data['source']) && ( 'repo' === $plugin_data['source'] ) ) );

            $plugins[$plugin_path]['required'] = ( isset($plugin_data['required']) && sparklestore_pro_bool($plugin_data['required']) );
            $plugins[$plugin_path]['recommended'] = (!$plugins[$plugin_path]['required'] );
        }

        uasort($plugins, 'sparklestore_pro_uasort_plugins');

        $this->plugins = $plugins;
    }

    /**
     * Obtain installed plugins.
     *
     *
     * @return null|array
     */
    public function get_installed_plugins() {
        if (is_null($this->installed_plugins)) {
            $this->set_installed_plugins();
        }

        return $this->installed_plugins;
    }

    /**
     * Set installed plugins.
     *
     */
    protected function set_installed_plugins() {
        $installed_plugins = array();

        foreach ($this->get_plugins() as $plugin_path => $plugin_data) {
            if ($plugin_data['installed']) {
                $installed_plugins[$plugin_path] = $plugin_data;
            }
        }

        $this->installed_plugins = $installed_plugins;
    }

    /**
     * Obtain required plugins.
     *
     *
     * @return null|array
     */
    public function get_required_plugins() {
        if (is_null($this->required_plugins)) {
            $this->set_required_plugins();
        }

        return $this->required_plugins;
    }

    /**
     * Set required plugins.
     *
     */
    protected function set_required_plugins() {
        $required_plugins = array();

        foreach ($this->get_plugins() as $plugin_path => $plugin_data) {
            if ($plugin_data['required'] || $plugin_data['recommended']) {
                $required_plugins[$plugin_path] = $plugin_data;
            }
        }

        $this->required_plugins = $required_plugins;
    }

    /**
     * Obtain active plugins.
     *
     *
     * @return null|array
     */
    public function get_active_plugins() {
        if (is_null($this->active_plugins)) {
            $this->set_active_plugins();
        }

        return $this->active_plugins;
    }

    /**
     * Set active plugins.
     *
     */
    protected function set_active_plugins() {
        $active_plugins = array();

        foreach ($this->get_installed_plugins() as $plugin_path => $plugin_data) {
            if ($plugin_data['active'] || $plugin_data['network_active'] || $plugin_data['must_use']) {
                $active_plugins[$plugin_path] = $plugin_data;
            }
        }

        $this->active_plugins = $active_plugins;
    }

    /**
     * Obtain inactive plugins.
     *
     *
     * @return null|array
     */
    public function get_inactive_plugins() {
        if (is_null($this->inactive_plugins)) {
            $this->set_inactive_plugins();
        }

        return $this->inactive_plugins;
    }

    /**
     * Set inactive plugins.
     *
     */
    protected function set_inactive_plugins() {
        $this->inactive_plugins = array_diff_key($this->get_installed_plugins(), $this->get_active_plugins());
    }

    /**
     * Obtain all plugins slugs.
     *
     *
     * @return array
     */
    public function get_plugins_slugs() {
        if (is_null($this->plugins_slugs)) {
            $this->set_plugins_slugs();
        }

        return $this->plugins_slugs;
    }

    /**
     * Set all plugins slugs.
     *
     */
    protected function set_plugins_slugs() {
        $this->plugins_slugs = wp_list_pluck($this->get_plugins(), 'slug');
    }

    /**
     * Obtain installed plugins slugs.
     *
     *
     * @return array
     */
    public function get_installed_plugins_slugs() {
        if (is_null($this->installed_plugins_slugs)) {
            $this->set_installed_plugins_slugs();
        }

        return $this->installed_plugins_slugs;
    }

    /**
     * Set installed plugins slugs.
     *
     */
    protected function set_installed_plugins_slugs() {
        $this->installed_plugins_slugs = wp_list_pluck($this->get_installed_plugins(), 'slug');
    }

    /**
     * Obtain required plugins slugs.
     *
     *
     * @return array
     */
    public function get_required_plugins_slugs() {
        if (is_null($this->required_plugins_slugs)) {
            $this->set_required_plugins_slugs();
        }

        return $this->required_plugins_slugs;
    }

    /**
     * Set required plugins slugs.
     *
     */
    protected function set_required_plugins_slugs() {
        $this->required_plugins_slugs = wp_list_pluck($this->get_required_plugins(), 'slug');
    }

    /**
     * Obtain active plugins slugs.
     *
     *
     * @return array
     */
    public function get_active_plugins_slugs() {
        if (is_null($this->active_plugins_slugs)) {
            $this->set_active_plugins_slugs();
        }

        return $this->active_plugins_slugs;
    }

    /**
     * Set active plugins slugs.
     *
     */
    protected function set_active_plugins_slugs() {
        $this->active_plugins_slugs = wp_list_pluck($this->get_active_plugins(), 'slug');
    }

    /**
     * Obtain inactive plugins slugs.
     *
     *
     * @return array
     */
    public function get_inactive_plugins_slugs() {
        if (is_null($this->inactive_plugins_slugs)) {
            $this->set_inactive_plugins_slugs();
        }

        return $this->inactive_plugins_slugs;
    }

    /**
     * Set inactive plugins slugs.
     *
     */
    protected function set_inactive_plugins_slugs() {
        $this->inactive_plugins_slugs = wp_list_pluck($this->get_inactive_plugins(), 'slug');
    }

    /**
     * Obtain WordPress' file system.
     *
     *
     * @return null|WP_Filesystem_Base
     */
    public function get_wp_filesystem() {
        if (is_null($this->wp_filesystem)) {
            $this->set_wp_filesystem();
        }

        return $this->wp_filesystem;
    }

    /**
     * Set WordPress' file system.
     *
     */
    protected function set_wp_filesystem() {
        // Make sure we have the dependency.
        if (!function_exists('WP_Filesystem')) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
        }

        /**
         * Initialize WordPress' file system handler.
         *
         * @var WP_Filesystem_Base $wp_filesystem
         */
        WP_Filesystem();
        global $wp_filesystem;

        $this->wp_filesystem = $wp_filesystem;
    }

    /** ==========================================================================
     *  Recommendations.
     *  ======================================================================= */

    /**
     * Obtain recommended WordPress' memory limit.
     *
     *
     * @return int
     */
    public function get_recommended_wp_memory_limit() {
        return 268435456;  // 256 MB
    }

    /**
     * Obtain required WordPress' memory limit.
     * .4
     *
     * @return int
     */
    public function get_required_wp_memory_limit() {
        return 33554432;  // 32 MB
    }

    /**
     * Obtain recommended WordPress' maximum upload file size.
     *
     *
     * @return int
     */
    public function get_recommended_wp_max_upload_size() {
        return 33554432;  // 32 MB
    }

    /**
     * Obtain required WordPress' maximum upload file size.
     * .4
     *
     * @return int
     */
    public function get_required_wp_max_upload_size() {
        return 2097152;  // 2 MB
    }

    /**
     * Obtain recommended PHP's maximum input variables.
     *
     *
     * @return int
     */
    public function get_recommended_php_max_input_vars() {
        return 3000;
    }

    /**
     * Obtain required PHP's maximum input variables.
     * .4
     *
     * @return int
     */
    public function get_required_php_max_input_vars() {
        return 1000;
    }

    /**
     * Obtain recommended PHP's POST maximum size.
     *
     *
     * @return int
     */
    public function get_recommended_php_post_max_size() {
        return 33554432;  // 32 MB
    }

    /**
     * Obtain required PHP's POST maximum size.
     *
     *
     * @return int
     */
    public function get_required_php_post_max_size() {
        return 2097152;  // 2 MB
    }

    /**
     * Obtain recommended PHP version to run this theme.
     * .4
     *
     * @return string
     */
    public function get_recommended_php_version() {
        return apply_filters('sparklestore_pro_system_status_recommended_php_version', '5.6');
    }

    /**
     * Obtain the required PHP version to run this theme.
     * .4
     *
     * @return string
     */
    public function get_required_php_version() {
        return apply_filters('sparklestore_pro_system_status_required_php_version', '5.3');
    }

    /**
     * Check if the current PHP version is fine.
     * .4
     *
     * @return mixed|bool
     */
    public function php_version_ok() {
        return version_compare($this->get_php_version(), $this->get_recommended_php_version(), '>=');
    }

    /**
     * Obtain recommended PHP's time limit.
     *
     *
     * @return int
     */
    public function get_recommended_php_time_limit() {
        return 300;
    }

    /**
     * Obtain required PHP's time limit.
     *
     * @return int
     */
    public function get_required_php_time_limit() {
        return 30;
    }

    /** ==========================================================================
     *  Wrappers.
     *  ======================================================================= */

    /**
     * Obtain WordPress' full uploads URL.
     *
     *
     * @return null|string
     */
    public function get_wp_uploads_full_url() {
        return $this->get_wp_uploads_url() . $this->get_wp_uploads_subdir();
    }

    /**
     * Obtain WordPress' full uploads path.
     *
     *
     * @return null|string
     */
    public function get_wp_uploads_full_path() {
        return $this->get_wp_uploads_path() . $this->get_wp_uploads_subdir();
    }

    /**
     * Obtain Theme name.
     *
     *
     * @return string
     */
    public function get_sparklestore_pro_name() {
        static $sparklestore_pro_name = null;

        if (is_null($sparklestore_pro_name)) {
            if ($this->is_child_theme()) {
                $sparklestore_pro_name = $this->get_parent_theme_name();
            } else {
                $sparklestore_pro_name = $this->get_theme_name();
            }
        }

        return $sparklestore_pro_name;
    }

    /**
     * Obtain Theme slug.
     *
     *
     * @return string
     */
    public function get_sparklestore_pro_slug() {
        static $sparklestore_pro_slug = null;

        if (is_null($sparklestore_pro_slug)) {
            if ($this->is_child_theme()) {
                $sparklestore_pro_slug = $this->get_parent_theme_slug();
            } else {
                $sparklestore_pro_slug = $this->get_theme_slug();
            }
        }

        return $sparklestore_pro_slug;
    }

    /**
     * Obtain Theme URL.
     *
     *
     * @return string
     */
    public function get_sparklestore_pro_url() {
        static $sparklestore_pro_url = null;

        if (is_null($sparklestore_pro_url)) {
            if ($this->is_child_theme()) {
                $sparklestore_pro_url = $this->get_parent_theme_url();
            } else {
                $sparklestore_pro_url = $this->get_theme_url();
            }
        }

        return $sparklestore_pro_url;
    }

    /**
     * Obtain Theme path.
     *
     *
     * @return string
     */
    public function get_sparklestore_pro_path() {
        static $sparklestore_pro_path = null;

        if (is_null($sparklestore_pro_path)) {
            if ($this->is_child_theme()) {
                $sparklestore_pro_path = $this->get_parent_theme_path();
            } else {
                $sparklestore_pro_path = $this->get_theme_path();
            }
        }

        return $sparklestore_pro_path;
    }

    /**
     * Obtain Theme version.
     *
     *
     * @return string
     */
    public function get_sparklestore_pro_version() {
        static $sparklestore_pro_version = null;

        if (is_null($sparklestore_pro_version)) {
            if ($this->is_child_theme()) {
                $sparklestore_pro_version = $this->get_parent_theme_version();
            } else {
                $sparklestore_pro_version = $this->get_theme_version();
            }
        }

        return $sparklestore_pro_version;
    }

    /**
     * Obtain Theme author URL.
     *
     *
     * @return string
     */
    public function get_sparklestore_pro_author_url() {
        static $sparklestore_pro_author_url = null;

        if (is_null($sparklestore_pro_author_url)) {
            if ($this->is_child_theme()) {
                $sparklestore_pro_author_url = $this->get_parent_theme_author_url();
            } else {
                $sparklestore_pro_author_url = $this->get_theme_author_url();
            }
        }

        return $sparklestore_pro_author_url;
    }

    /**
     * Obtain WordPress' allowed file extensions for the current user.
     *
     *
     * @param string $mime_type
     *
     * @return array
     */
    public function get_wp_file_extensions($mime_type = 'all') {
        static $wp_file_extensions = array();

        if (!isset($wp_file_extensions[$mime_type])) {
            $mime_type_parts = explode('/', $mime_type);
            $mime_part_type = $mime_type_parts[0];
            $mime_part_subtype = (!empty($mime_type_parts[1]) ) ? $mime_type_parts[1] : false;

            $mime_type_extensions = array();

            foreach ($this->get_wp_mime_types() as $current_extensions => $current_mime_type) {
                if ('all' !== $mime_type) {
                    $current_mime_type_parts = explode('/', $current_mime_type);
                    $current_mime_part_type = $current_mime_type_parts[0];
                    $current_mime_part_subtype = (!empty($current_mime_type_parts[1]) ) ? $current_mime_type_parts[1] : false;

                    if (( $mime_part_type !== $current_mime_part_type ) || ( ( false !== $mime_part_subtype ) && ( $mime_part_subtype !== $current_mime_part_subtype ) )) {
                        continue;
                    }
                }

                $mime_type_extensions = array_merge($mime_type_extensions, explode('|', $current_extensions));
            }

            sort($mime_type_extensions);

            $wp_file_extensions[$mime_type] = $mime_type_extensions;
        }

        return $wp_file_extensions[$mime_type];
    }

    /**
     * Obtain information of a plugin, given its slug or path.
     *
     *
     * @param  string $plugin_slug_or_path
     *
     * @return array|null
     */
    public function get_plugin($plugin_slug_or_path) {
        $plugin_slug_maybe = $this->get_plugin_slug_from_path($plugin_slug_or_path);
        $plugin_path_maybe = $this->get_plugin_path_from_slug($plugin_slug_or_path);

        $plugins = $this->get_plugins();

        if (isset($plugins[$plugin_slug_or_path])) {
            return $plugins[$plugin_slug_or_path];
        } elseif (isset($plugins[$plugin_slug_maybe])) {
            return $plugins[$plugin_slug_maybe];
        } elseif (isset($plugins[$plugin_path_maybe])) {
            return $plugins[$plugin_path_maybe];
        }

        return null;
    }

    /**
     * Obtain the version of a plugin.
     *
     *
     * @param $plugin_slug_or_path
     *
     * @return null|string
     */
    public function get_plugin_version($plugin_slug_or_path) {
        static $plugins_versions = array();

        if (array_key_exists($plugin_slug_or_path, $this->get_installed_plugins_slugs())) {
            $plugin_path = $plugin_slug_or_path;
        } else {
            $plugin_path = array_search($plugin_slug_or_path, $this->get_installed_plugins_slugs());

            if (!$plugin_path) {
                return null;
            }
        }

        if (!isset($plugins_versions[$plugin_path])) {
            $plugins = $this->get_installed_plugins();

            $plugins_versions[$plugin_path] = $plugins[$plugin_path]['version'];
        }

        return $plugins_versions[$plugin_path];
    }

    /**
     * Obtain WordPress multisite.
     *
     *
     * @return bool
     */
    public function is_wp_multisite() {
        return $this->get_wp_multisite();
    }

    /**
     * Obtain WordPress' remote GET.
     *
     *
     * @return bool
     */
    public function is_wp_remote_get() {
        return $this->get_wp_remote_get();
    }

    /**
     * Obtain WordPress' remote POST.
     *
     *
     * @return bool
     */
    public function is_wp_remote_post() {
        return $this->get_wp_remote_post();
    }

    /**
     * Obtain WordPress' debug mode.
     *
     *
     * @return bool
     */
    public function is_wp_debug_mode() {
        return $this->get_wp_debug_mode();
    }

    /**
     * Obtain whether or not the server timezone is UTC.
     *
     *
     * @return bool
     */
    public function is_server_timezone_utc() {
        return ( 'UTC' === $this->get_server_timezone() );
    }

    /**
     * Obtain child theme.
     *
     *
     * @return bool
     */
    public function is_child_theme() {
        return $this->get_child_theme();
    }

    /**
     * Obtain whether or not a plugin is installed.
     *
     *
     * @param $plugin_slug_or_path
     *
     * @return bool
     */
    public function is_plugin_installed($plugin_slug_or_path) {
        return in_array($plugin_slug_or_path, $this->get_installed_plugins_slugs(), true) || array_key_exists($plugin_slug_or_path, $this->get_installed_plugins_slugs());
    }

    /**
     * Obtain whether or not a plugin is required.
     *
     *
     * @param $plugin_slug_or_path
     *
     * @return bool
     */
    public function is_plugin_required($plugin_slug_or_path) {
        return in_array($plugin_slug_or_path, $this->get_required_plugins_slugs(), true) || array_key_exists($plugin_slug_or_path, $this->get_required_plugins_slugs());
    }

    /**
     * Obtain whether or not a plugin is active.
     *
     *
     * @param $plugin_slug_or_path
     *
     * @return bool
     */
    public function is_plugin_active($plugin_slug_or_path) {
        return in_array($plugin_slug_or_path, $this->get_active_plugins_slugs(), true) || array_key_exists($plugin_slug_or_path, $this->get_active_plugins_slugs());
    }

    /**
     * Obtain whether or not is the WordPress' importer available.
     *
     *
     * @return bool
     */
    public function is_wp_importer() {
        return defined('WP_LOAD_IMPORTERS') && true === WP_LOAD_IMPORTERS && class_exists('WP_Importer') && class_exists('WP_Import');
    }

    /** ==========================================================================
     *  Formatted data.
     *  ======================================================================= */

    /**
     * Obtain WordPress' memory limit, formatted.
     *
     *
     * @return null|string
     */
    public function get_formatted_wp_memory_limit() {
        return size_format($this->get_wp_memory_limit());
    }

    /**
     * Obtain recommended WordPress' memory limit, formatted.
     *
     *
     * @return string
     */
    public function get_formatted_recommended_wp_memory_limit() {
        return size_format($this->get_recommended_wp_memory_limit());
    }

    /**
     * Obtain required WordPress' memory limit, formatted.
     *
     *
     * @return string
     */
    public function get_formatted_required_wp_memory_limit() {
        return size_format($this->get_required_wp_memory_limit());
    }

    /**
     * Obtain maximum upload size, formatted.
     *
     *
     * @return null|string
     */
    public function get_formatted_wp_max_upload_size() {
        return size_format($this->get_wp_max_upload_size());
    }

    /**
     * Obtain recommended WordPress' maximum upload file size, formatted.
     *
     *
     * @return string
     */
    public function get_formatted_recommended_wp_max_upload_size() {
        return size_format($this->get_recommended_wp_max_upload_size());
    }

    /**
     * Obtain required WordPress' maximum upload file size, formatted.
     *
     *
     * @return string
     */
    public function get_formatted_required_wp_max_upload_size() {
        return size_format($this->get_required_wp_max_upload_size());
    }

    /**
     * Obtain PHP's maximum POST size, formatted.
     *
     *
     * @return null|string
     */
    public function get_formatted_php_post_max_size() {
        return size_format($this->get_php_post_max_size());
    }

    /**
     * Obtain recommended PHP's maximum POST size, formatted.
     *
     *
     * @return null|string
     */
    public function get_formatted_recommended_php_post_max_size() {
        return size_format($this->get_recommended_php_post_max_size());
    }

    /**
     * Obtain required PHP's maximum POST size, formatted.
     *
     *
     * @return null|string
     */
    public function get_formatted_required_php_post_max_size() {
        return size_format($this->get_required_php_post_max_size());
    }

    /** ==========================================================================
     *  Auxiliary methods.
     *  ======================================================================= */

    /**
     * Convert numbers in letter notation to an integer value.
     *
     *
     * @param string $size
     *
     * @return int
     */
    private function convert_let_to_num($size) {
        $l = substr($size, - 1);
        $ret = substr($size, 0, - 1);

        switch (strtoupper($l)) {
            case 'P':
                $ret *= 1024;

            case 'T':
                $ret *= 1024;

            case 'G':
                $ret *= 1024;

            case 'M':
                $ret *= 1024;

            case 'K':
                $ret *= 1024;
        }

        return $ret;
    }

    /**
     * Obtain a plugin slug (folder or file name) from its path.
     *
     *
     * @param string $plugin_path
     *
     * @return string
     */
    public function get_plugin_slug_from_path($plugin_path) {
        $directory = pathinfo($plugin_path, PATHINFO_DIRNAME);
        if ('.' !== $directory) {
            return $directory;
        } else {
            $file = basename($plugin_path, '.php');

            return $file;
        }
    }

    /**
     * Obtain a plugin path (folder and file name) from its slug.
     *
     * If the plugin is required but not installed, it will return the same slug.
     * If the plugin is not required nor installed, it will return false.
     *
     *
     * @param string $plugin_slug
     *
     * @return bool|string
     */
    public function get_plugin_path_from_slug($plugin_slug) {
        $plugin_slugs = array_flip($this->get_plugins_slugs());

        if (isset($plugin_slugs[$plugin_slug])) {
            return $plugin_slugs[$plugin_slug];
        }

        return false;
    }

}
