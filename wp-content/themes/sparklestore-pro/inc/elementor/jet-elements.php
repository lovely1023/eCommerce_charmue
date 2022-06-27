<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die();
}

// If class `Jet_Elements` doesn't exists yet.
if (!class_exists('Jet_Elements')) {

    /**
     * Sets up and initializes the plugin.
     */
    class Jet_Elements {

        /**
         * A reference to an instance of this class.
         *
         * @since  1.0.0
         * @access private
         * @var    object
         */
        private static $instance = null;

        /**
         * Holder for base plugin URL
         *
         * @since  1.0.0
         * @access private
         * @var    string
         */
        private $plugin_url = null;

        /**
         * Plugin version
         *
         * @var string
         */
        private $version = '1.14.1';

        /**
         * Holder for base plugin path
         *
         * @since  1.0.0
         * @access private
         * @var    string
         */
        private $plugin_path = null;

        /**
         * Sets up needed actions/filters for the plugin to initialize.
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function __construct() {
            // Load files.
            add_action('init', array($this, 'init'), -999);
        }

        /**
         * Returns plugin version
         *
         * @return string
         */
        public function get_version() {
            return $this->version;
        }

        /**
         * Manually init required modules.
         *
         * @return void
         */
        public function init() {

            $this->load_files();

            jet_elements_assets()->init();
            jet_elements_integration()->init();
            jet_elements_svg_manager()->init();
            jet_elements_compatibility()->init();
            jet_elements_ext_section()->init();
        }

        /**
         * Check if theme has elementor
         *
         * @return boolean
         */
        public function has_elementor() {
            return defined('ELEMENTOR_VERSION');
        }

        /**
         * [elementor description]
         * @return [type] [description]
         */
        public function elementor() {
            return \Elementor\Plugin::$instance;
        }

        /**
         * Load required files.
         *
         * @return void
         */
        public function load_files() {
            require $this->plugin_path('includes/class-jet-elements-assets.php');
            require $this->plugin_path('includes/class-jet-elements-tools.php');
            require $this->plugin_path('includes/class-jet-elements-integration.php');
            require $this->plugin_path('includes/class-jet-elements-svg-manager.php');
            require $this->plugin_path('includes/lib/compatibility/class-jet-elements-compatibility.php');
            require $this->plugin_path('includes/ext/class-jet-elements-ext-section.php');
        }

        /**
         * Returns path to file or dir inside plugin folder
         *
         * @param  string $path Path inside plugin dir.
         * @return string
         */
        public function plugin_path($path = null) {

            if (!$this->plugin_path) {
                $this->plugin_path = trailingslashit( get_template_directory() . '/inc/elementor' );
            }

            return $this->plugin_path . $path;
        }

        /**
         * Returns url to file or dir inside plugin folder
         *
         * @param  string $path Path inside plugin dir.
         * @return string
         */
        public function plugin_url($path = null) {

            if (!$this->plugin_url) {
                $this->plugin_url = trailingslashit( get_template_directory_uri() . '/inc/elementor' );
            }

            return $this->plugin_url . $path;
        }

        /**
         * Get the template path.
         *
         * @return string
         */
        public function template_path() {
            return apply_filters('jet-elements/template-path', 'jet-elements/');
        }

        /**
         * Returns path to template file.
         *
         * @return string|bool
         */
        public function get_template($name = null) {

            $template = locate_template($this->template_path() . $name);

            if (!$template) {
                $template = $this->plugin_path('templates/' . $name);
            }

            if (file_exists($template)) {
                return $template;
            } else {
                return false;
            }
        }

        /**
         * Returns the instance.
         *
         * @since  1.0.0
         * @access public
         * @return object
         */
        public static function get_instance() {
            // If the single instance hasn't been set, set it now.
            if (null == self::$instance) {
                self::$instance = new self;
            }
            return self::$instance;
        }

    }

}

if (!function_exists('jet_elements')) {

    /**
     * Returns instanse of the plugin class.
     *
     * @since  1.0.0
     * @return object
     */
    function jet_elements() {
        return Jet_Elements::get_instance();
    }

}

jet_elements();
