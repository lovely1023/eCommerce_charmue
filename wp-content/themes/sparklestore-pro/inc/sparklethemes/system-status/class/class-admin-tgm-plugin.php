<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Sparklestore_Pro_Pro_TGM_Plugin')) {

    /**
     * Class Sparklestore_Pro_Pro_TGM_Plugin
     *
     * Helper class to handle internal data of plugins managed with TGMPA.
     *
     */
    class Sparklestore_Pro_Pro_TGM_Plugin {
        /** ==========================================================================
         *  Properties.
         *  ======================================================================= */

        /**
         * Plugin name.
         *
         *
         * @var string
         */
        protected $name = null;

        /**
         * Plugin slug.
         *
         *
         * @var string
         */
        protected $slug = null;

        /**
         * Plugin local installation path.
         *
         *
         * @var string
         */
        protected $path = null;

        /**
         * Plugin description.
         *
         *
         * @var string
         */
        protected $description = null;

        /**
         * Plugin image URL, or fallback if there is no image.
         *
         *
         * @var string
         */
        protected $image_url = null;

        /**
         * Whether or not this plugin is external to the official repository.
         *
         *
         * @var bool
         */
        protected $external = null;

        /**
         * Plugin external source URL.
         *
         *
         * @var string
         */
        protected $source_url = null;

        /**
         * Plugin installed version.
         *
         *
         * @var string
         */
        protected $version = null;

        /**
         * Plugin latest available version.
         *
         *
         * @var string
         */
        protected $new_version = null;

        /**
         * Plugin version required by the theme.
         *
         *
         * @var string
         */
        protected $theme_required_version = null;

        /**
         * Plugin URL.
         *
         *
         * @var string
         */
        protected $url = null;

        /**
         * Plugin author's name.
         *
         *
         * @var string
         */
        protected $author_name = null;

        /**
         * Plugin author's URL.
         *
         *
         * @var string
         */
        protected $author_url = null;

        /**
         * Whether or not this plugin is required by TGMPA.
         *
         *
         * @var bool
         */
        protected $required = null;

        /**
         * Whether or not this plugin is recommended (not required) by TGMPA.
         *
         *
         * @var bool
         */
        protected $recommended = null;

        /**
         * Whether or not this plugin is installed.
         *
         *
         * @var bool
         */
        protected $installed = null;

        /**
         * Whether or not this plugin is active for the current site only.
         *
         *
         * @var bool
         */
        protected $active = null;

        /**
         * Whether or not this plugin is active for the current network.
         *
         *
         * @var bool
         */
        protected $network_active = null;

        /**
         * Whether or not this plugin is a must-use.
         *
         *
         * @var bool
         */
        protected $must_use = null;

        /**
         * Plugin tags.
         *
         *
         * @var array
         */
        protected $tags = null;

        /**
         * Plugin available actions.
         *
         *
         * @var array
         */
        protected $actions = null;

        /**
         * Plugin enabled actions.
         *
         *
         * @var array
         */
        protected $enabled_actions = null;

        /**
         * Demo pack to check against (if passed).
         *
         *
         * @var sparklestore_pro_Demo_Pack
         */
        protected $demo_pack = null;

        /**
         *
         *
         * @var Sparklestore_Pro_Pro_TGM_Plugin_Activation
         */
        protected $sparklestore_pro_tgmpa = null;

        /**
         * System status handler.
         *
         *
         * @var Sparkle_PLus_System_Status
         */
        protected $system_status = null;

        /** ==========================================================================
         *  Constructing methods.
         *  ======================================================================= */

        /**
         * Main constructor.
         *
         * @param string|array         $plugin_slug Plugin TGMPA slug.
         * @param sparklestore_pro_Demo_Pack $demo_pack   Demo pack to check against.
         *
         * @throws Exception
         */
        public function __construct($plugin_slug, $demo_pack = null) {
            // Initialize System Status.
            $this->system_status = Sparkle_PLus_System_Status::obtain();

            // Obtain plugin data.
            $plugin_data = $this->system_status->get_plugin($plugin_slug);

            // Validate plugin data.
            if (empty($plugin_data)) {
                throw new Exception(esc_html__('Invalid plugin.', 'sparklestore-pro'));
            } elseif (!( isset($plugin_data['required']) && isset($plugin_data['recommended']) )) {
                throw new Exception(esc_html__('Invalid plugin data.', 'sparklestore-pro'));
            } elseif (!( $plugin_data['required'] || $plugin_data['recommended'] )) {
                throw new Exception(esc_html__('Non-TGM plugin.', 'sparklestore-pro'));
            }

            // Assign plugin data.
            $this->name = $plugin_data['name'];
            $this->slug = $plugin_data['slug'];
            $this->path = $plugin_data['path'];
            $this->description = $plugin_data['description'];
            $this->external = $plugin_data['external'];
            $this->version = $plugin_data['version'];
            $this->new_version = $plugin_data['new_version'];
            $this->url = $plugin_data['url'];
            $this->author_name = $plugin_data['author_name'];
            $this->author_url = $plugin_data['author_url'];
            $this->required = $plugin_data['required'];
            $this->recommended = $plugin_data['recommended'];
            $this->installed = $plugin_data['installed'];
            $this->active = $plugin_data['active'];
            $this->network_active = $plugin_data['network_active'];
            $this->must_use = $plugin_data['must_use'];
        }

        /**
         * Obtain a Sparklestore_Pro_Pro_TGM_Plugin object.
         *
         * New instances are saved to a static variable, so they can be retrieved
         * later without needing to be reinitialized.
         *
         *
         * @param string|array         $plugin_slug Plugin TGMPA slug.
         * @param sparklestore_pro_Demo_Pack $demo_pack   Demo pack to check against.
         *
         * @return WP_Error|Sparklestore_Pro_Pro_TGM_Plugin
         */
        public static function obtain($plugin_slug, $demo_pack = null) {
            static $tgm_plugins = array();

            try {
                $plugin = new self($plugin_slug, $demo_pack);

                $tgm_plugins[$plugin->get_slug()] = $plugin;
            } catch (Exception $e) {
                return new WP_Error('invalid_plugin', $e->getMessage());
            }

            return $tgm_plugins[$plugin->get_slug()];
        }

        /** ==========================================================================
         *  Getters & Setters.
         *  ======================================================================= */

        /**
         * Obtain name.
         *
         *
         * @return string
         */
        public function get_name() {
            return $this->name;
        }

        /**
         * Obtain slug.
         *
         *
         * @return string
         */
        public function get_slug() {
            return $this->slug;
        }

        /**
         * Obtain local installation path.
         *
         *
         * @return string
         */
        public function get_path() {
            return $this->path;
        }

        /**
         * Obtain description.
         *
         *
         * @return string
         */
        public function get_description() {
            return $this->description;
        }

        /**
         * Obtain installed version.
         *
         *
         * @return string
         */
        public function get_version() {
            return $this->version;
        }

        /**
         * Obtain latest available version.
         *
         *
         * @return string
         */
        public function get_new_version() {
            return $this->new_version;
        }

        /**
         * Obtain theme required version.
         *
         *
         * @return string
         */
        public function get_theme_required_version() {
            if (is_null($this->theme_required_version)) {
                $this->set_theme_required_version();
            }

            return $this->theme_required_version;
        }

        /**
         * Set theme required version.
         *
         */
        protected function set_theme_required_version() {
            $theme_required_version = '';

            if (isset($this->sparklestore_pro_tgmpa->plugins[$this->get_slug()]['version'])) {
                $theme_required_version = $this->sparklestore_pro_tgmpa->plugins[$this->get_slug()]['version'];
            }

            $this->theme_required_version = $theme_required_version;
        }

        /**
         * Obtain required version.
         *
         *
         * @return string
         */
        public function get_required_version() {
            if ($this->get_demo_required_version() && version_compare($this->get_theme_required_version(), $this->get_demo_required_version(), '<')) {
                return $this->get_demo_required_version();
            }

            return $this->get_theme_required_version();
        }

        /**
         * Obtain URL.
         *
         *
         * @return string
         */
        public function get_url() {
            return $this->url;
        }

        /**
         * Obtain author name.
         *
         *
         * @return string
         */
        public function get_author_name() {
            return $this->author_name;
        }

        /**
         * Obtain author URL.
         *
         *
         * @return string
         */
        public function get_author_url() {
            return $this->author_url;
        }

        /**
         * Obtain whether or not this plugin is required.
         *
         *
         * @return bool
         */
        public function get_required() {
            return $this->required;
        }

        /**
         * Obtain whether or not this plugin is recommended.
         *
         *
         * @return bool
         */
        public function get_recommended() {
            return $this->recommended;
        }

        /**
         * Obtain whether or not this plugin is installed.
         *
         *
         * @return bool
         */
        public function get_installed() {
            return $this->installed;
        }

        /**
         * Obtain whether or not this plugin is active.
         *
         *
         * @return bool
         */
        public function get_active() {
            return $this->active;
        }

        /**
         * Obtain whether or not this plugin is network active.
         *
         *
         * @return bool
         */
        public function get_network_active() {
            return $this->network_active;
        }

        /**
         * Obtain whether or not this plugin is must_use.
         *
         *
         * @return bool
         */
        public function get_must_use() {
            return $this->must_use;
        }

        /**
         * Obtain tags.
         *
         *
         * @return array
         */
        public function get_tags() {
            if (is_null($this->tags)) {
                $this->set_tags();
            }

            return $this->tags;
        }

        /**
         * Set tags.
         *
         */
        protected function set_tags() {
            $tags = array();

            if (!empty($this->sparklestore_pro_tgmpa->plugins[$this->get_slug()]['tags'])) {
                $tgmpa_tags = array_unique(array_values($this->sparklestore_pro_tgmpa->plugins[$this->get_slug()]['tags']));

                foreach ($tgmpa_tags as $tgmpa_tag) {
                    $tags[sanitize_title($tgmpa_tag)] = $tgmpa_tag;
                }
            }

            ksort($tags);

            $this->tags = $tags;
        }

        /**
         * Obtain actions.
         *
         *
         * @return array
         */
        public function get_actions() {
            if (is_null($this->actions)) {
                $this->set_actions();
            }

            return $this->actions;
        }

        /**
         * Set actions.
         *
         */
        protected function set_actions() {
            $actions = array();

            // If the plugin is not installed, all we can do is install it.
            if (!$this->is_installed()) {
                $actions[] = 'install';

                // If the plugin is installed:
            } else {
                // If the version is lower than the required, all we can do is update it.
                if (version_compare($this->get_version(), $this->get_required_version(), '<')) {
                    $actions[] = 'update';

                    // If the version is greater or equal than the required:
                } else {
                    // If there is a newer version available, we can update it.
                    if ($this->get_new_version() && version_compare($this->get_version(), $this->get_new_version(), '<')) {
                        $actions[] = 'update';
                    }

                    // If the plugin is inactive, we can activate it.
                    if (!$this->is_active()) {
                        $actions[] = 'activate';

                        // If the plugin is active, we can deactivate it.
                    } else {
                        $actions[] = 'deactivate';
                    }
                }
            }

            $this->actions = $actions;
        }

        /**
         * Obtain actions URLS.
         *
         *
         * @return array
         */
        public function get_actions_urls() {
            $actions_urls = array_flip($this->get_actions());

            foreach ($actions_urls as $action => &$action_url) {
                // Don't provide action URLs for disabled actions.
                if (!in_array($action, $this->get_enabled_actions(), true)) {
                    $action_url = false;
                    continue;
                }

                $action_query_args = array(
                    'page' => urlencode($this->sparklestore_pro_tgmpa->menu),
                    'plugin' => urlencode($this->get_slug()),
                    'tgmpa-' . $action => $action . '-plugin',
                );

                if (!empty($this->demo_pack)) {
                    $action_query_args['demo'] = $this->demo_pack->get_slug();
                }

                $action_url = esc_url(wp_nonce_url(
                                add_query_arg(
                                        $action_query_args, admin_url($this->sparklestore_pro_tgmpa->parent_slug)
                                ), 'tgmpa-' . $action, 'tgmpa-nonce'
                ));
            }

            return $actions_urls;
        }

        /**
         * Obtain improved TGMPA data.
         *
         *
         * @return array
         */
        public function get_improved_tgmpa_data() {
            $tgmpa_data = $this->sparklestore_pro_tgmpa->plugins[$this->get_slug()];

            if ($this->has_valid_source()) {
                $tgmpa_data['source'] = $this->get_source_url();
            }

            if ($this->is_installed()) {
                $tgmpa_data['file_path'] = $this->get_path();
            }

            return $tgmpa_data;
        }

        /** ==========================================================================
         *  Conditionals.
         *  ======================================================================= */

        /**
         * Obtain whether or not this plugin is external.
         *
         *
         * @return bool
         */
        public function is_external() {
            return $this->get_external();
        }

        /**
         * Obtain whether or not this plugin is required.
         *
         *
         * @return bool
         */
        public function is_theme_required() {
            return $this->get_required();
        }

        /**
         * Obtain whether or not the plugin is required by the theme (or the demo pack, if passed).
         *
         *
         * @return string
         */
        public function is_required() {
            if (!empty($this->demo_pack)) {
                return $this->is_demo_required();
            }

            return $this->is_theme_required();
        }

        /**
         * Obtain whether or not this plugin is required.
         *
         *
         * @return bool
         */
        public function is_theme_recommended() {
            return $this->get_recommended();
        }

        /**
         * Obtain whether or not the plugin has a valid source.
         *
         *
         * @return bool
         */
        public function has_valid_source() {
            $source_url = $this->get_source_url();

            return !empty($source_url);
        }

        /**
         * Obtain whether or not the plugin has an available update.
         *
         *
         * @return bool
         */
        public function has_update() {
            $new_version = $this->get_new_version();

            return !empty($new_version);
        }

        /**
         * Obtain whether or not installing this plugin is an enabled action.
         *
         *
         * @return bool
         */
        public function is_installation_enabled() {
            /**
             * For now, we allow all plugins (either external or from the
             * repository) to be installed in all cases. In the future,
             * we may require a valid license to allow external plugins.
             */
            return true;
        }

        /**
         * Obtain whether or not this plugin is installed.
         *
         *
         * @return bool
         */
        public function is_installed() {
            return $this->get_installed();
        }

        /**
         * Obtain whether or not this plugin is active.
         *
         *
         * @return bool
         */
        public function is_active() {
            return $this->get_active();
        }

        /**
         * Obtain whether or not this plugin is network_active.
         *
         *
         * @return bool
         */
        public function is_network_active() {
            return $this->get_network_active();
        }

        /**
         * Obtain whether or not this plugin is must_use.
         *
         *
         * @return bool
         */
        public function is_must_use() {
            return $this->get_must_use();
        }

        /**
         * Obtain whether or not the plugin is currently inactive.
         *
         *
         * @return bool
         */
        public function is_inactive() {
            return ( $this->is_installed() && !( $this->is_active() || $this->is_network_active() || $this->is_must_use() ) );
        }

        /**
         * Obtain whether or not the plugin can be installed.
         *
         * @return bool
         */
        public function can_install() {
            if (!$this->is_installation_enabled()) {
                return false;
            }

            return in_array('install', $this->get_actions(), true);
        }

        /**
         * Obtain whether or not the plugin can be updated.
         *
         *
         * @return bool
         */
        public function can_update() {
            if (!$this->is_installation_enabled()) {
                return false;
            }

            return in_array('update', $this->get_actions(), true);
        }

        /**
         * Obtain whether or not the plugin can be activated.
         *
         *
         * @return bool
         */
        public function can_activate() {
            return in_array('activate', $this->get_actions(), true);
        }

        /**
         * Obtain whether or not the plugin can be deactivated.
         *
         *
         * @return bool
         */
        public function can_deactivate() {
            return in_array('deactivate', $this->get_actions(), true);
        }

    }

}