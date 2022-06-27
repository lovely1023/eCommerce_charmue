<?php
if (!defined('ABSPATH'))
    exit;

if (!class_exists('Sparkle_Theme_Importer')) {

    class Sparkle_Theme_Importer {

        public $this_uri;
        public $this_dir;
        public $configFile;
        public $uploads_dir;
        public $plugin_install_count;
        public $ajax_response = array();

        /*
         * Constructor
         */

        public function __construct() {

            // This uri & dir
            $this->this_uri = get_template_directory_uri() . '/inc/sparklethemes/demo-importer/';
            $this->this_dir = get_template_directory() . '/inc/sparklethemes/demo-importer/';

            $this->uploads_dir = wp_get_upload_dir();

            $this->plugin_install_count = 0;

            // Include necesarry files
            $this->configFile = include $this->this_dir . 'import_config.php';

            require_once $this->this_dir . 'classes/class-demo-importer.php';
            require_once $this->this_dir . 'classes/class-customizer-importer.php';
            require_once $this->this_dir . 'classes/class-widget-importer.php';

            // WP-Admin Menu
            add_action('admin_menu', array($this, 'sparkle_theme_pro_menu'));

            // Add necesary backend JS
            add_action('admin_enqueue_scripts', array($this, 'load_backends'));

            // Actions for the ajax call
            add_action('wp_ajax_sparkle_theme_pro_install_demo', array($this, 'sparkle_theme_pro_install_demo'));
            add_action('wp_ajax_sparkle_theme_pro_install_plugin', array($this, 'sparkle_theme_pro_install_plugin'));
            add_action('wp_ajax_sparkle_theme_pro_download_files', array($this, 'sparkle_theme_pro_download_files'));
            add_action('wp_ajax_sparkle_theme_pro_import_xml', array($this, 'sparkle_theme_pro_import_xml'));
            add_action('wp_ajax_sparkle_theme_pro_customizer_import', array($this, 'sparkle_theme_pro_customizer_import'));
            add_action('wp_ajax_sparkle_theme_pro_menu_import', array($this, 'sparkle_theme_pro_menu_import'));
            add_action('wp_ajax_sparkle_theme_pro_theme_option', array($this, 'sparkle_theme_pro_theme_option'));
            add_action('wp_ajax_sparkle_theme_pro_importing_widget', array($this, 'sparkle_theme_pro_importing_widget'));
            add_action('wp_ajax_sparkle_theme_pro_importing_revslider', array($this, 'sparkle_theme_pro_importing_revslider'));

            if ( ( defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, '3.0.0', '>=' ) ) ) {
                remove_filter( 'wp_import_post_meta', array( 'Elementor\Compatibility', 'on_wp_import_post_meta' ) );
                remove_filter( 'wxr_importer.pre_process.post_meta', array( 'Elementor\Compatibility', 'on_wxr_importer_pre_process_post_meta' ) );

                add_filter( 'wp_import_post_meta', array( $this, 'on_wp_import_post_meta' ) );
                add_filter( 'wxr_importer.pre_process.post_meta', array( $this, 'on_wxr_importer_pre_process_post_meta' ) );
            }
        }


        /**
		 * Process post meta before WP importer.
		 *
		 * Normalize Elementor post meta on import, We need the `wp_slash` in order
		 * to avoid the unslashing during the `add_post_meta`.
		 *
		 * Fired by `wp_import_post_meta` filter.
		 *
		 * @since 2.4.1
		 *
		 * @param array $post_meta Post meta.
		 *
		 * @return array Updated post meta.
		 */
		public function on_wp_import_post_meta( $post_meta ) {
			foreach ( $post_meta as &$meta ) {
				if ( '_elementor_data' === $meta['key'] ) {
					$meta['value'] = wp_slash( $meta['value'] );
					break;
				}
			}

			return $post_meta;
        }

        /**
		 * Process post meta before WXR importer.
		 *
		 * Normalize Elementor post meta on import with the new WP_importer, We need
		 * the `wp_slash` in order to avoid the unslashing during the `add_post_meta`.
		 *
		 * Fired by `wxr_importer.pre_process.post_meta` filter.
		 *
		 * @since 2.4.1
		 *
		 * @param array $post_meta Post meta.
		 *
		 * @return array Updated post meta.
		 */
		public function on_wxr_importer_pre_process_post_meta( $post_meta ) {
			if ( '_elementor_data' === $post_meta['key'] ) {
				$post_meta['value'] = wp_slash( $post_meta['value'] );
			}

			return $post_meta;
		}
        
        /*
         * WP-ADMIN Menu for importer
         */

        function sparkle_theme_pro_menu() {
            add_submenu_page('sparklestore-pro', 'Sparkle OneClick Demo Install', 'Demo Import', 'manage_options', 'sparkle-theme-demo-importer', array($this, 'sparkle_theme_pro_display_demos'));
        }

        /*
         *  Display the available demos
         */

        function sparkle_theme_pro_display_demos() {
            ?>
            <div class="wrap">
                <h2></h2>
                <div class="sparkle-theme-demo-importer-wrap">
                    <h2><?php echo esc_html__('Sparkle OneClick Demo Importer', 'sparklestore-pro'); ?></h2>

                    <?php if (is_array($this->configFile) && !is_null($this->configFile)) { ?>
                        <div class="sparkle-theme-demo-box-wrap wp-clearfix">
                            <?php
                            // Loop through Demos
                            foreach ($this->configFile as $demo_slug => $demo_pack) {
                                $tags = implode(' ', array_keys($demo_pack['tags']));
                                ?>
                                <div id="<?php echo esc_attr($demo_slug); ?>" class="sparkle-theme-demo-box <?php echo esc_attr($tags); ?>">
                                    <img src="<?php echo esc_url($demo_pack['image']); ?> ">

                                    <div class="sparkle-theme-demo-actions">
                                        <h4><?php echo esc_html($demo_pack['name']); ?></h4>

                                        <div class="sparkle-theme-demo-buttons">
                                            <a href="<?php echo esc_url($demo_pack['preview_url']); ?>" target="_blank" class="button">
                                                <?php echo esc_html__('Preview', 'sparklestore-pro'); ?>
                                            </a> 

                                            <a href="#sparkle-theme-modal-<?php echo esc_attr($demo_slug) ?>" class="sparkle-theme-modal-button button button-primary">
                                                <?php echo esc_html__('Install', 'sparklestore-pro') ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            ?>
                        </div>
                    <?php } else {
                        ?>
                        <div class="sparkle-theme-demo-wrap">
                            <?php esc_html_e("It looks like the config file for the demos is missing or conatins errors!. Demo install can\'t go futher!", 'sparklestore-pro'); ?>  
                        </div>
                    <?php }
                    ?>

                    <?php
                    /* Demo Modals */
                    if (is_array($this->configFile) && !is_null($this->configFile)) {
                        foreach ($this->configFile as $demo_slug => $demo_pack) {
                            ?>
                            <div id="sparkle-theme-modal-<?php echo esc_attr($demo_slug) ?>" class="sparkle-theme-modal" style="display: none;">

                                <div class="sparkle-theme-modal-header">
                                    <h2><?php printf(esc_html('Import %s Demo', 'sparklestore-pro'), esc_html($demo_pack['name'])); ?></h2>
                                    <div class="sparkle-theme-modal-back"><span class="dashicons dashicons-no-alt"></span></div>
                                </div>

                                <div class="sparkle-theme-modal-wrap">
                                    <p><?php echo sprintf(esc_html__('We recommend you backup your website content before attempting to import the demo so that you can recover your website if something goes wrong. You can use %s plugin for it.', 'sparklestore-pro'), '<a href="https://wordpress.org/plugins/all-in-one-wp-migration/" target="_blank">' . esc_html__('All in one migration', 'sparklestore-pro') . '</a>'); ?></p>

                                    <p><?php echo esc_html__('This process will install all the required plugins, import contents and setup customizer and theme options.', 'sparklestore-pro'); ?></p>

                                    <div class="sparkle-theme-modal-recommended-plugins">
                                        <h4><?php esc_html_e('Required Plugins', 'sparklestore-pro') ?></h4>
                                        <p><?php esc_html_e('For your website to look exactly like the demo,the import process will install and activate the following plugin if they are not installed or activated.', 'sparklestore-pro') ?></p>
                                        <?php
                                        $plugins = isset($demo_pack['plugins']) ? $demo_pack['plugins'] : '';

                                        if (is_array($plugins)) {
                                            ?>
                                            <ul>
                                                <?php
                                                foreach ($plugins as $plugin) {
                                                    $name = isset($plugin['name']) ? $plugin['name'] : '';
                                                    $status = Sparkle_Theme_Demo_Importer::plugin_active_status($plugin['file_path']);
                                                    ?>
                                                    <li>
                                                        <?php
                                                        echo esc_html($name) . ' - ' . $this->get_plugin_status($status);
                                                        ?>
                                                    </li>
                                                <?php }
                                                ?>
                                            </ul>
                                            <?php
                                        }
                                        ?>
                                    </div>

                                    <div class="sparkle-theme-reset-checkbox">
                                        <h4><?php esc_html_e('Reset Website', 'sparklestore-pro') ?></h4>
                                        <p><?php esc_html_e('Reseting the website will delete all your post, pages, custom post types, categories, taxonomies, images and all other customizer and theme option settings.', 'sparklestore-pro') ?></p>
                                        <p><?php esc_html_e('It is always recommended to reset the database for a complete demo import.', 'sparklestore-pro') ?></p>
                                        <label>
                                            <input id="checkbox-reset-<?php echo esc_attr($demo_slug); ?>" type="checkbox" value='1'/>
                                            <?php echo esc_html('Reset Website', 'sparklestore-pro'); ?>
                                        </label>
                                    </div>

                                    <a href="javascript:void(0)" data-demo-slug="<?php echo esc_attr($demo_slug) ?>" class="button button-primary sparkle-theme-import-demo"><?php esc_html_e('Import Demo', 'sparklestore-pro'); ?></a>
                                    <a href="javascript:void(0)" class="button sparkle-theme-modal-cancel"><?php esc_html_e('Cancel', 'sparklestore-pro'); ?></a>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div id="sparkle-theme-import-progress" style="display: none">
                        <h2 class="sparkle-theme-import-progress-header"><?php echo esc_html__('Demo Import Progress', 'sparklestore-pro'); ?></h2>

                        <div class="sparkle-theme-import-progress-wrap">
                            <div class="sparkle-theme-import-loader">
                                <div class="sparkle-theme-loader-content">
                                    <div class="sparkle-theme-loader-content-inside">
                                        <div class="sparkle-theme-loader-rotater"></div>
                                        <div class="sparkle-theme-loader-line-point"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="sparkle-theme-import-progress-message"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        /*
         *  Do the install on ajax call
         */

        function sparkle_theme_pro_install_demo() {
            check_ajax_referer('demo-importer-ajax', 'security');

            // Get the demo content from the right file
            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            $this->ajax_response['demo'] = $demo_slug;

            if (isset($_POST['reset']) && $_POST['reset'] == 'true') {
                $this->database_reset();
                $this->ajax_response['complete_message'] = esc_html__('Database reset complete', 'sparklestore-pro');
            }

            $this->ajax_response['next_step'] = 'sparkle_theme_pro_install_plugin';
            $this->ajax_response['next_step_message'] = esc_html__('Installing required plugins', 'sparklestore-pro');
            $this->send_ajax_response();
        }

        function sparkle_theme_pro_install_plugin() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            // Install Required Plugins
            $this->install_plugins($demo_slug);

            $plugin_install_count = $this->plugin_install_count;

            $this->ajax_response['demo'] = $demo_slug;

            if ($plugin_install_count > 0) {
                $this->ajax_response['complete_message'] = esc_html__('All the required plugins installed and activated successfully', 'sparklestore-pro');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No plugin required to install', 'sparklestore-pro');
            }
            $this->ajax_response['next_step'] = 'sparkle_theme_pro_download_files';
            $this->ajax_response['next_step_message'] = esc_html__('Downloading demo files', 'sparklestore-pro');
            $this->send_ajax_response();
        }

        function sparkle_theme_pro_download_files() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            $this->download_files($this->configFile[$demo_slug]['external_url']);

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['complete_message'] = esc_html__('All demo files downloaded', 'sparklestore-pro');
            $this->ajax_response['next_step'] = 'sparkle_theme_pro_import_xml';
            $this->ajax_response['next_step_message'] = esc_html__('Importing posts, pages and medias. It may take a bit longer time', 'sparklestore-pro');
            $this->send_ajax_response();
        }

        function sparkle_theme_pro_import_xml() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            // Import XML content
            $this->importDemoContent($demo_slug);

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['complete_message'] = esc_html__('All content imported', 'sparklestore-pro');
            $this->ajax_response['next_step'] = 'sparkle_theme_pro_customizer_import';
            $this->ajax_response['next_step_message'] = esc_html__('Importing customizer settings', 'sparklestore-pro');
            $this->send_ajax_response();
        }

        function sparkle_theme_pro_customizer_import() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            $customizer_filepath = $this->demo_upload_dir($demo_slug) . '/customizer.dat';
            if (file_exists($customizer_filepath)) {
                ob_start();
                Sparkle_Theme_Customizer_Importer::import($customizer_filepath);
                ob_end_clean();
                $this->ajax_response['complete_message'] = esc_html__('Customizer settings imported', 'sparklestore-pro');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No Customizer settings found', 'sparklestore-pro');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'sparkle_theme_pro_menu_import';
            $this->ajax_response['next_step_message'] = esc_html__('Setting primary menu', 'sparklestore-pro');
            $this->send_ajax_response();
        }

        function sparkle_theme_pro_menu_import() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            $menu_array = isset($this->configFile[$demo_slug]['menuArray']) ? $this->configFile[$demo_slug]['menuArray'] : '';
            // Set menu
            if ($menu_array) {
                $this->setMenu($menu_array);
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['complete_message'] = esc_html__('Primary menu saved', 'sparklestore-pro');
            $this->ajax_response['next_step'] = 'sparkle_theme_pro_theme_option';
            $this->ajax_response['next_step_message'] = esc_html__('Importing theme option settings', 'sparklestore-pro');
            $this->send_ajax_response();
        }

        function sparkle_theme_pro_theme_option() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            $themeoption_filepath = $this->demo_upload_dir($demo_slug) . '/themeoption.json';

            if (file_exists($themeoption_filepath)) {
                $data = file_get_contents($themeoption_filepath);

                if ($data) {
                    if (update_option('sparkle-theme-options', json_decode($data, true), '', 'yes')) {
                        $this->ajax_response['complete_message'] = esc_html__('Theme options settings imported', 'sparklestore-pro');
                    }
                }
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No theme options found', 'sparklestore-pro');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'sparkle_theme_pro_importing_widget';
            $this->ajax_response['next_step_message'] = esc_html__('Importing Widgets', 'sparklestore-pro');
            $this->send_ajax_response();
        }

        function sparkle_theme_pro_importing_widget() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            $widget_filepath = $this->demo_upload_dir($demo_slug) . '/widget.wie';

            if (file_exists($widget_filepath)) {
                ob_start();
                Sparkle_Theme_Widget_Importer::import($widget_filepath);
                ob_end_clean();
                $this->ajax_response['complete_message'] = esc_html__('Widgets Imported', 'sparklestore-pro');
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No Widgets found', 'sparklestore-pro');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = 'sparkle_theme_pro_importing_revslider';
            $this->ajax_response['next_step_message'] = esc_html__('Importing Revolution slider', 'sparklestore-pro');
            $this->send_ajax_response();
        }

        function sparkle_theme_pro_importing_revslider() {
            check_ajax_referer('demo-importer-ajax', 'security');

            $demo_slug = isset($_POST['demo']) ? $_POST['demo'] : '';

            // Get the zip file path
            $sliderFile = $this->demo_upload_dir($demo_slug) . '/revslider.zip';
            
            if (file_exists($sliderFile)) {
                if (class_exists('RevSlider')) {
                    $slider = new RevSlider();
                    $slider->importSliderFromPost(true, true, $sliderFile);
                    $this->ajax_response['complete_message'] = esc_html__('Revolution slider installed', 'sparklestore-pro');
                }else{
                    $this->ajax_response['complete_message'] = esc_html__('Revolution slider plugin not installed', 'sparklestore-pro');
                }
            } else {
                $this->ajax_response['complete_message'] = esc_html__('No Revolution slider found', 'sparklestore-pro');
            }

            $this->ajax_response['demo'] = $demo_slug;
            $this->ajax_response['next_step'] = '';
            $this->ajax_response['next_step_message'] = '';
            $this->send_ajax_response();
        }

        public function download_files($external_url) {
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

            $result = true;

            if (!($wp_filesystem->exists($this->demo_upload_dir()))) {
                $result = $wp_filesystem->mkdir($this->demo_upload_dir());
            }

            // Abort the request if the local uploads directory couldn't be created.
            if (!$result) {
                $this->add_ajax_message['message'] = esc_html__('The directory for the demo packs couldn\'t be created.', 'sparklestore-pro');
                $this->ajax_response['error'] = true;
                $this->send_ajax_response();
            }

            $demo_pack = $this->demo_upload_dir() . 'demo-pack.zip';

            $file = wp_remote_retrieve_body(wp_remote_get($external_url, array(
                'timeout' => 60,
            )));

            $wp_filesystem->put_contents($demo_pack, $file);
            unzip_file($demo_pack, $this->demo_upload_dir());
            $wp_filesystem->delete($demo_pack);
        }

        /*
         * Reset the database, if the case
         */

        function database_reset() {
            global $wpdb;
            $options = array(
                'offset' => 0,
                'orderby' => 'post_date',
                'order' => 'DESC',
                'post_type' => 'post',
                'post_status' => 'publish'
            );

            $statuses = array('publish', 'future', 'draft', 'pending', 'private', 'trash', 'inherit', 'auto-draft', 'scheduled');
            $types = array(
                'post',
                'page',
                'attachment',
                'nav_menu_item',
                'wpcf7_contact_form',
                'product',
                'portfolio',
                'custom_css'
            );

            // delete posts
            foreach ($types as $type) {
                foreach ($statuses as $status) {
                    $options['post_type'] = $type;
                    $options['post_status'] = $status;

                    $posts = get_posts($options);
                    $offset = 0;
                    while (count($posts) > 0) {
                        if ($offset == 10) {
                            break;
                        }
                        $offset++;
                        foreach ($posts as $post) {
                            wp_delete_post($post->ID, true);
                        }
                        $posts = get_posts($options);
                    }
                }
            }


            // Delete categories, tags, etc
            $taxonomies_array = array('category', 'post_tag', 'portfolio_type', 'nav_menu', 'product_cat');
            foreach ($taxonomies_array as $tax) {
                $cats = get_terms($tax, array('hide_empty' => false, 'fields' => 'ids'));
                foreach ($cats as $cat) {
                    wp_delete_term($cat, $tax);
                }
            }


            // Delete Slider Revolution Sliders
            if (class_exists('RevSlider')) {
                $sliderObj = new RevSlider();
                foreach ($sliderObj->getArrSliders() as $slider) {
                    $slider->initByID($slider->getID());
                    $slider->deleteSlider();
                }
            }

            // Delete Widgets
            global $wp_registered_widget_controls;

            $widget_controls = $wp_registered_widget_controls;

            $available_widgets = array();

            foreach ($widget_controls as $widget) {
                if (!empty($widget['id_base']) && !isset($available_widgets[$widget['id_base']])) {
                    $available_widgets[] = $widget['id_base'];
                }
            }

            update_option('sidebars_widgets', array('wp_inactive_widgets' => array()));
            foreach ($available_widgets as $widget_data) {
                update_option('widget_' . $widget_data, array());
            }

            // Delete Thememods
            $theme_slug = get_option('stylesheet');
            $mods = get_option("theme_mods_$theme_slug");
            if (false !== $mods) {
                delete_option("theme_mods_$theme_slug");
            }

            //Clear "uploads" folder
            $this->clear_uploads($this->uploads_dir['basedir']);
        }

        /**
         * Clear "uploads" folder
         * @param string $dir
         * @return bool
         */
        private function clear_uploads($dir) {
            $files = array_diff(scandir($dir), array('.', '..'));
            foreach ($files as $file) {
                ( is_dir("$dir/$file") ) ? $this->clear_uploads("$dir/$file") : unlink("$dir/$file");
            }

            return ( $dir != $this->uploads_dir['basedir'] ) ? rmdir($dir) : true;
        }

        /*
         * Set the menu on theme location
         */

        function setMenu($menuArray) {

            if (!$menuArray) {
                return;
            }

            $locations = get_theme_mod('nav_menu_locations');

            foreach ($menuArray as $menuId => $menuname) {
                $menu_exists = wp_get_nav_menu_object($menuname);

                if (!$menu_exists) {
                    $term_id_of_menu = wp_create_nav_menu($menuname);
                } else {
                    $term_id_of_menu = $menu_exists->term_id;
                }

                $locations[$menuId] = $term_id_of_menu;
            }

            set_theme_mod('nav_menu_locations', $locations);
        }

        /*
         * Import demo XML content
         */

        function importDemoContent($slug) {

            if (!defined('WP_LOAD_IMPORTERS'))
                define('WP_LOAD_IMPORTERS', true);

            if (!class_exists('WP_Import')) {
                $class_wp_importer = $this->this_dir . "wordpress-importer/wordpress-importer.php";
                if (file_exists($class_wp_importer)) {
                    require_once $class_wp_importer;
                }
            }

            // Import demo content from XML
            if (class_exists('WP_Import')) {
                $import_filepath = $this->demo_upload_dir($slug) . '/content.xml'; // Get the xml file from directory 

                if (file_exists($import_filepath)) {
                    $wp_import = new WP_Import();
                    $wp_import->fetch_attachments = true;
                    // Capture the output.
                    ob_start();
                    $wp_import->import($import_filepath);
                    // Clean the output.
                    ob_end_clean();

                    // Import DONE
                    // set homepage as front page
                    $page = get_page_by_path('home');
                    $page = $page ? $page : get_page_by_path( 'front-page');
                    if ($page) {
                        update_option('show_on_front', 'page');
                        update_option('page_on_front', $page->ID);
                    } else {
                        $page = get_page_by_title('Home');
                        if ($page) {
                            update_option('show_on_front', 'page');
                            update_option('page_on_front', $page->ID);
                        }
                    }

                    $blog = get_page_by_path('blog');
                    if ($blog) {
                        update_option('show_on_front', 'page');
                        update_option('page_for_posts', $blog->ID);
                    }
                }
            }
        }

        function demo_upload_dir($path = '') {
            $upload_dir = $this->uploads_dir['basedir'] . '/demo-pack/' . $path;
            return $upload_dir;
        }

        function install_plugins($slug) {
            $demo = $this->configFile[$slug];

            $plugins = $demo['plugins'];

            foreach ($plugins as $plugin_slug => $plugin) {
                $name = isset($plugin['name']) ? $plugin['name'] : '';
                $source = isset($plugin['source']) ? $plugin['source'] : '';
                $file_path = isset($plugin['file_path']) ? $plugin['file_path'] : '';
                $location = isset($plugin['location']) ? $plugin['location'] : '';

                if ($source == 'wordpress') {
                    $this->plugin_installer_callback($file_path, $plugin_slug);
                } else {
                    $this->plugin_offline_installer_callback($file_path, $location);
                }
            }
        }

        public function plugin_installer_callback($path, $slug) {
            $plugin_status = $this->plugin_status($path);

            if ($plugin_status == 'install') {
                // Include required libs for installation
                require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
                require_once ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php';
                require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';

                // Get Plugin Info
                $api = $this->call_plugin_api($slug);

                $skin = new WP_Ajax_Upgrader_Skin();
                $upgrader = new Plugin_Upgrader($skin);
                $upgrader->install($api->download_link);

                $this->activate_plugin($path);
                $this->plugin_install_count++;
            } else if ($plugin_status == 'inactive') {
                $this->activate_plugin($path);
                $this->plugin_install_count++;
            }
        }

        public function plugin_offline_installer_callback($path, $external_url) {

            $plugin_status = $this->plugin_status($path);

            if ($plugin_status == 'install') {
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

                $plugin = $this->demo_upload_dir() . 'plugin.zip';

                $file = wp_remote_retrieve_body(wp_remote_get($external_url, array(
                    'timeout' => 60,
                )));

                $wp_filesystem->mkdir($this->demo_upload_dir());

                $wp_filesystem->put_contents($plugin, $file);

                unzip_file($plugin, WP_PLUGIN_DIR);

                $plugin_file = WP_PLUGIN_DIR . '/' . esc_html($path);

                if (file_exists($plugin_file)) {
                    $this->activate_plugin($path);
                    $this->plugin_install_count++;
                }

                $wp_filesystem->delete($plugin);
            } else if ($plugin_status == 'inactive') {
                $this->activate_plugin($path);
                $this->plugin_install_count++;
            }
        }

        /* Plugin API */

        public function call_plugin_api($slug) {
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
                    'downloadlink' => true,
                    'icons' => false
            )));

            return $call_api;
        }

        public function activate_plugin($file_path) {
            if ($file_path) {
                $activate = activate_plugin($file_path, '', false, true);
            }
        }

        /* Check if plugin is active or not */

        public function plugin_status($file_path) {
            $status = 'install';

            $plugin_path = WP_PLUGIN_DIR . '/' . $file_path;

            if (file_exists($plugin_path)) {
                $status = is_plugin_active($file_path) ? 'active' : 'inactive';
            }
            return $status;
        }

        public function get_plugin_status($status) {
            switch ($status) {
                case 'install':
                    $plugin_status = esc_html__('Not Installed', 'sparklestore-pro');
                    break;

                case 'active':
                    $plugin_status = esc_html__('Installed and Active', 'sparklestore-pro');
                    break;

                case 'inactive':
                    $plugin_status = esc_html__('Installed but Not Active', 'sparklestore-pro');
                    break;
            }
            return $plugin_status;
        }

        public function send_ajax_response() {
            $json = wp_json_encode($this->ajax_response);
            echo $json;
            die();
        }

        /*
          Register necessary backend js
         */

        function load_backends() {
            $data = array(
                'nonce' => wp_create_nonce('demo-importer-ajax'),
                'prepare_importing' => esc_html__('Preparing to import demo', 'sparklestore-pro'),
                'reset_database' => esc_html__('Reseting database', 'sparklestore-pro'),
                'no_reset_database' => esc_html__('Database was not reset', 'sparklestore-pro'),
                'import_error' => __('<p>There was an error in importing demo. Please reload the page and try again.</p> <a class="button" href="' . esc_url(admin_url('/admin.php?page=sparkle-theme-demo-importer')) . '">Refresh</a>', 'sparklestore-pro'),
                'import_success' => '<h2>' . esc_html__('All done. Have fun!', 'sparklestore-pro') . '</h2><p>' . esc_html__('Your website has been successfully setup.', 'sparklestore-pro') . '</p><a class="button" target="_blank" href="' . esc_url(home_url('/')) . '">View your Website</a><a class="button" href="' . esc_url(admin_url('/admin.php?page=sparkle-theme-demo-importer')) . '">Go Back</a>'
            );

            wp_enqueue_script('sparkle-theme-demo-ajax', $this->this_uri . 'assets/demo-importer-ajax.js', array('jquery'), '2.0.0', true);
            wp_localize_script('sparkle-theme-demo-ajax', 'sparkle_ajax_data', $data);
            wp_enqueue_style('sparkle-theme-demo-style', $this->this_uri . 'assets/demo-importer-style.css', array(), '2.0.0');
        }

    }

}
new Sparkle_Theme_Importer;
