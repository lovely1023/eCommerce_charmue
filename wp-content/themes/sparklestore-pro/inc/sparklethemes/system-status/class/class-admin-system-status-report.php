<?php

/*
 * Credit: NiceThemes<http://nicethemes.com/>
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Sparkle_PLus_System_Status_Report
 *
 * Create reports using System Status information.
 *
 */
class Sparkle_PLus_System_Status_Report {
    /** ==========================================================================
     *  Properties.
     *  ======================================================================= */

    /**
     * System Status handler for system information.
     *
     *
     * @var Sparkle_PLus_System_Status
     */
    private $system_status = null;

    /** ==========================================================================
     *  Constructing methods.
     *  ======================================================================= */

    /**
     * Setup initial data.
     *
     */
    public function __construct() {
        /**
         * Initialize system status handler.
         */
        $this->system_status = sparklestore_pro_admin_system_status();
    }

    /**
     * Obtain a Sparkle_PLus_System_Status_Report object.
     *
     * The instance is saved to a static variable, so it can be retrieved
     * later without needing to be reinitialized.
     *
     *
     * @return Sparkle_PLus_System_Status_Report
     */
    public static function obtain() {
        static $system_status_report = null;

        if (is_null($system_status_report)) {
            $system_status_report = new self();
        }

        return $system_status_report;
    }

    /** ==========================================================================
     *  Report methods.
     *  ======================================================================= */

    /**
     * Obtain full report.
     *
     *
     * @return array
     */
    public function get_report() {
        $report = array(
            'wp' => $this->get_wp_report(),
            'server' => $this->get_server_report(),
            'php' => $this->get_php_report(),
            'mysql' => $this->get_mysql_report(),
            'theme' => $this->get_theme_report(),
            'plugins' => $this->get_plugins_report(),
            'users' => $this->get_users_report(),
        );

        return $report;
    }

    /**
     * Obtain WordPress report.
     *
     *
     * @return array
     */
    protected function get_wp_report() {
        $report = array(
            'url' => array(
                'home_url' => $this->system_status->get_home_url(),
                'site_url' => $this->system_status->get_site_url(),
            ),
            'version' => $this->system_status->get_wp_version(),
            'required' => $this->system_status->get_required_wp_version(),
            'recommended' => $this->system_status->get_recommended_wp_version(),
            'multisite' => $this->system_status->is_wp_multisite(),
            'locale' => $this->system_status->get_wp_locale(),
            'post_types' => $this->system_status->get_wp_post_types(),
            'taxonomies' => $this->system_status->get_wp_taxonomies(),
            'mime_types' => array(
                'mime_types' => $this->system_status->get_wp_mime_types(),
                'file_extensions' => $this->system_status->get_wp_file_extensions(),
            ),
            'uploads' => array(
                'url' => $this->system_status->get_wp_uploads_url(),
                'path' => $this->system_status->get_wp_uploads_path(),
                'writable' => $this->system_status->is_wp_uploads_dir_writable(),
            ),
            'rewrite_rules' => $this->system_status->get_wp_rewrite_rules(),
            'memory_limit' => array(
                'value' => $this->system_status->get_wp_memory_limit(),
                'value_formatted' => $this->system_status->get_formatted_wp_memory_limit(),
                'recommended' => $this->system_status->get_recommended_wp_memory_limit(),
                'recommended_formatted' => $this->system_status->get_formatted_recommended_wp_memory_limit(),
            ),
            'max_upload_size' => array(
                'value' => $this->system_status->get_wp_max_upload_size(),
                'value_formatted' => $this->system_status->get_formatted_wp_max_upload_size(),
                'recommended' => $this->system_status->get_recommended_wp_max_upload_size(),
                'recommended_formatted' => $this->system_status->get_formatted_recommended_wp_max_upload_size(),
            ),
            'debug_mode' => $this->system_status->is_wp_debug_mode(),
            'importer' => $this->system_status->is_wp_importer(),
        );

        return $report;
    }

    /**
     * Obtain server report.
     *
     * @return array
     */
    protected function get_server_report() {
        $report = array(
            'info' => $this->system_status->get_server_info(),
            'timezone' => array(
                'value' => $this->system_status->get_server_timezone(),
                'is_utc' => $this->system_status->is_server_timezone_utc(),
            ),
            'remote' => array(
                'get' => $this->system_status->is_wp_remote_get(),
                'post' => $this->system_status->is_wp_remote_post(),
            ),
            'mod_security' => array(
                'value' => $this->system_status->mod_security_enabled(),
                'recommended' => false,
            ),
            'unzip_file' => array(
                'value' => $this->system_status->server_unzip_enable(),
                'recommended' => false,
            ),
            
        );
        return $report;
    }

    /**
     * Obtain PHP report.
     *
     *
     * @return array
     */
    protected function get_php_report() {
        $report = array(
            'version' => $this->system_status->get_php_version(),
            'recommended' => $this->system_status->get_recommended_php_version(),
            'required' => $this->system_status->get_required_php_version(),
            'phpinfo' => array(
                'output' => $this->system_status->get_phpinfo(),
            ),
            'max_input_vars' => array(
                'value' => $this->system_status->get_php_max_input_vars(),
                'recommended' => $this->system_status->get_recommended_php_max_input_vars(),
            ),
            'post_max_size' => array(
                'value' => $this->system_status->get_php_post_max_size(),
                'value_formatted' => $this->system_status->get_formatted_php_post_max_size(),
                'recommended' => $this->system_status->get_recommended_php_post_max_size(),
                'recommended_formatted' => $this->system_status->get_formatted_recommended_php_post_max_size(),
            ),
            'time_limit' => array(
                'value' => $this->system_status->get_php_time_limit(),
                'recommended' => $this->system_status->get_recommended_php_time_limit(),
            ),
            'xdebug' => array(
                'value' => $this->system_status->xdebug_enabled(),
                'recommended' => false,
            ),
        );

        return $report;
    }

    /**
     * Obtain MySQL report.
     *
     * @return array
     */
    protected function get_mysql_report() {
        $report = array(
            'version' => $this->system_status->get_mysql_version(),
            'recommended' => $this->system_status->get_recommended_mysql_version(),
            'required' => $this->system_status->get_required_mysql_version(),
        );

        return $report;
    }

    /**
     * Obtain theme report.
     *
     *
     * @return array
     */
    protected function get_theme_report() {
        $report = array(
            'slug' => $this->system_status->get_sparklestore_pro_slug(),
            'name' => $this->system_status->get_sparklestore_pro_name(),
            'version' => $this->system_status->get_sparklestore_pro_version(),
            'author' => array(
                'url' => $this->system_status->get_sparklestore_pro_author_url(),
            ),
            'url' => $this->system_status->get_sparklestore_pro_url(),
            'path' => $this->system_status->get_sparklestore_pro_path(),
            'child' => false,
        );

        if ($this->system_status->is_child_theme()) {
            $report['child'] = array(
                'slug' => $this->system_status->get_theme_slug(),
                'name' => $this->system_status->get_theme_name(),
                'version' => $this->system_status->get_theme_version(),
                'author' => array(
                    'url' => $this->system_status->get_theme_author_url(),
                ),
                'path' => $this->system_status->get_theme_path(),
            );
        }

        return $report;
    }

    /**
     * Obtain plugins report.
     *
     *
     * @return array
     */
    protected function get_plugins_report() {
        $report = array(
            'all' => $this->system_status->get_plugins(),
        );

        return $report;
    }

    /**
     * Obtain plugins report.
     *
     *
     * @return array
     */
    protected function get_users_report() {
        $report = array(
            'current' => $this->system_status->get_wp_current_user(),
            'all' => $this->system_status->get_wp_users(),
            'roles' => $this->system_status->get_wp_roles(),
            'capabilities' => $this->system_status->get_wp_capabilities(),
        );

        // Remove user emails and password hashes. We don't need them.
        unset($report['current']['data']['user_pass']);
        unset($report['current']['data']['user_email']);
        foreach ($report['all'] as &$user) {
            unset($user['data']['user_pass']);
            unset($user['data']['user_email']);
        }

        return $report;
    }

    /** ==========================================================================
     *  Export methods.
     *  ======================================================================= */

    /**
     * Export full report in JSON format.
     *
     */
    public function export_json_report() {
        $report = $this->get_report();
        $output = json_encode($report);

        header('Content-Description: File Transfer');
        header('Cache-Control: public, must-revalidate');
        header('Pragma: hack');
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="system-status-report-' . date('Y-m-d-His') . '.json"');
        header('Content-Length: ' . strlen($output));

        echo $output;
        exit;
    }

}
