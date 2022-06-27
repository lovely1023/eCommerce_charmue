<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    die();
}

if (!class_exists('Sparklestore_Pro_Pro_Welcome')) {

    class Sparklestore_Pro_Pro_Welcome {

        /**
         * Theme Name
         * @var     string
         * @access  public
         * @since   1.0.0
         */
        private $theme_name;


        /**
         * Theme Config
         */

        private $theme_config;

        /**
         * Theme Version
         * @var     string
         * @access  public
         * @since   1.0.0
         */
        private $theme_version;

        /**
         * Theme Version
         * @var     string
         * @access  public
         * @since   1.0.0
         */
        public static $dir;

        /**
         * Theme Version
         * @var     string
         * @access  public
         * @since   1.0.0
         */
        public static $uri;


        public function __construct() {
            $theme = wp_get_theme('sparklestore-pro');
            $this->theme_name = $theme->Name;
            $this->theme_version = $theme->Version;
            self::$dir = get_template_directory() . '/inc/sparklethemes/';
            self::$uri = get_template_directory_uri() . '/inc/sparklethemes/';

            /* Theme Activation Notice */
            add_action('load-themes.php', array($this, 'activation_admin_notice'));

            /* Create a Welcome Page */
            add_action('admin_menu', array($this, 'register_menu'));

            /* Hide Notice */
            add_filter('wp_loaded', array($this, 'hide_admin_notice'), 10);
            add_action('after_switch_theme', array($this, 'erase_hide_notice'));

            /* Enqueue Styles & Scripts for Welcome Page */
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));

            $this->load_files();

            $this->spl();
        }

        /**
         * Initiator
         *
         * @since 1.0.0
         * @return object
         */
        public function load_files() {
            require self::$dir . 'theme-options/theme-options.php';
            require self::$dir . 'recommended-plugins/recommended-plugins.php';
            require self::$dir . 'demo-importer/demo-importer.php';
            require self::$dir . 'system-status/system-status.php';
            require self::$dir . 'updater/theme-updater.php';

            $this->theme_config = $config;
        }

        /** Welcome Message Notification on Theme Activation * */
        public function activation_admin_notice() {
            global $pagenow;

            // if (is_admin() && ('themes.php' == $pagenow) && (isset($_GET['activated']))) {
            //     add_action('admin_notices', array($this, 'admin_notice_content'));
            // }

            $hide_notice = get_option('sparklestore_pro_hide_notice');
            if (!$hide_notice) {
                add_action('admin_notices', array($this, 'admin_notice_content'));
            }
        }

        /** Welcome Message Notification */
        public function admin_notice_content() {
            $screen = get_current_screen();

            if ('appearance_page_sparkle-welcome' === $screen->id || (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id) || 'theme-install' === $screen->id) {
                return;
            }
            ?>
            <div class="updated notice sparkle-welcome-notice">
                <div class="sparkle-welcome-notice-wrap">
                    <h2><?php esc_html_e('Congratulations!', 'sparklestore-pro'); ?></h2>
                    <p><?php printf(esc_html__('%1$s is now installed and ready to use. You can start either by importing the ready made demo or get started by customizing it your self.', 'sparklestore-pro'), $this->theme_name); ?></p>

                    <div class="sparkle-welcome-info">
                        <div class="sparkle-welcome-thumb">
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/screenshot.jpg'); ?>" alt="<?php echo esc_attr__('Sparkle Demo', 'sparklestore-pro'); ?>">
                        </div>

                      
                        <div class="sparkle-welcome-import">
                            <h3><?php esc_html_e('Import Demo', 'sparklestore-pro'); ?></h3>
                            <p><?php esc_html_e('Click below to install and preview demos.', 'sparklestore-pro'); ?></p>
                            <p>
                                <a  class="button button-primary sparkle-demo-import" href="<?php echo esc_url(admin_url('admin.php?page=sparkle-theme-demo-importer')); ?>"><?php esc_html_e('Import Demo Data', 'sparklestore-pro'); ?></a></a>
                            </p>
                        </div>
                           
                        <div class="sparkle-welcome-getting-started">
                            <h3><?php esc_html_e('Get Started', 'sparklestore-pro'); ?></h3>
                            <p><?php printf(esc_html__('Here you will find all the necessary links and information on how to use %s.', 'sparklestore-pro'), $this->theme_name); ?></p>
                            <p><a href="<?php echo esc_url(admin_url('admin.php?page=sparklestore-pro')); ?>" class="button button-primary"><?php esc_html_e('Go to Setting Page', 'sparklestore-pro'); ?></a></p>
                        </div>

                        <div class="sparkle-welcome-getting-started">
                            <h3><?php esc_html_e('Header Builder', 'sparklestore-pro'); ?></h3>
                            <p><?php printf(esc_html__('Create your own header style using our header builder, %s include 14+ header elements to design beautiful header.', 'sparklestore-pro'), $this->theme_name); ?></p>
                            <p><a href="<?php echo esc_url(admin_url('/customize.php?autofocus[panel]=sparklewp_header')); ?>" class="button button-primary"><?php esc_html_e('Go to Builder', 'sparklestore-pro'); ?></a></p>
                        </div>
                    </div>

                    <a href="<?php echo wp_nonce_url(add_query_arg('sparklestore_pro_hide_notice', 1), 'sparklestore_pro_hide_notice_nonce', '_sparklestore_pro_notice_nonce'); ?>" class="notice-close"><?php esc_html_e('Dismiss', 'sparklestore-pro'); ?></a>
                </div>

            </div>
            <?php
        }


        /** Hide Admin Notice */
        public function hide_admin_notice() {
            if (isset($_GET['sparklestore_pro_hide_notice']) && isset($_GET['_sparklestore_pro_notice_nonce']) && current_user_can('manage_options')) {
                if (!wp_verify_nonce(wp_unslash($_GET['_sparklestore_pro_notice_nonce']), 'sparklestore_pro_hide_notice_nonce')) {
                    wp_die(esc_html__('Action Failed. Something is Wrong.', 'sparklestore-pro'));
                }

                update_option('sparklestore_pro_hide_notice', true);
            }
        }

        /** Enqueue Necessary Styles and Scripts for the Welcome Page * */
        public function enqueue_scripts() {
            wp_enqueue_style('welcome-screen', self::$uri . 'css/welcome.css');
        }

        /** Register Menu for Welcome Page * */
        public function register_menu() {
            add_menu_page(esc_html__('Welcome', 'sparklestore-pro'), esc_html__('Theme Panel', 'sparklestore-pro'), 'manage_options', 'sparklestore-pro', array($this, 'sparklestore_pro_welcome'), '', 2);
            add_submenu_page('sparklestore-pro', esc_html__('Welcome', 'sparklestore-pro'), esc_html__('Welcome', 'sparklestore-pro'), 'manage_options', 'sparklestore-pro', array($this, 'sparklestore_pro_welcome'));
            add_submenu_page('themes.php', esc_html__('Welcome', 'sparklestore-pro'), esc_html__('Welcome', 'sparklestore-pro'), 'manage_options', 'sparklestore-pro', array($this, 'sparklestore_pro_welcome'));
        }

        public function sparklestore_pro_welcome() {
            $theme = wp_get_theme();
            ?>
            <div class="wrap sparkle-welcome-wrap wp-clearfix">
                <h1></h1>
                <div class="sparkle-welcome-content">

                    <div class="sparkle-welcome-intro">
                        <h3><?php printf(__('Welcome to %1$s','sparklestore-pro'), esc_html( $theme->Name ) ); ?> <span class="theme-version"><?php echo esc_html( $theme->Version ); ?></span></h3>
                        <p><?php printf(__('Welcome and thank you for installing %1$s. We have worked very hard to release a great product and fully commited to making your experience perfect.','sparklestore-pro'), esc_html( $theme->Name ) ); ?></p>
                        <p><?php printf(__('If this is your first experience with %1$s, we recommend you visiting the following pages','sparklestore-pro'), esc_html( $theme->Name ) ); ?></p>
                        <ul class="sparkle-quick-links wp-clearfix">
                            <li><a href="<?php echo admin_url('/admin.php?page=sparklestore-pro-license') ?>"><?php echo esc_html('Activate License Key', 'sparklestore-pro') ?></a></li>
                            <li><a href="<?php echo admin_url('/admin.php?page=sparklestore-pro-install-plugins') ?>"><?php echo esc_html('Install Recommended Plugins', 'sparklestore-pro') ?></a></li>
                            <li><a href="<?php echo admin_url('/admin.php?page=sparkle-theme-demo-importer') ?>"><?php echo esc_html('Import Demos', 'sparklestore-pro') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php') ?>"><?php echo esc_html('Customizer Panel', 'sparklestore-pro') ?></a></li>
                            <li><a href="<?php echo admin_url('/admin.php?page=sparklestore-pro-options') ?>"><?php echo esc_html('Theme Setting Option Panel', 'sparklestore-pro') ?></a></li>
                            <li><a href="<?php echo admin_url('/admin.php?page=sparklestore-pro-system-status') ?>"><?php echo esc_html('System Status', 'sparklestore-pro') ?></a></li>
                            <li><a href="<?php echo esc_url('https://sparklewpthemes.com/support'); ?>" target="_blank"><?php echo esc_html('Support Forum', 'sparklestore-pro') ?></a></li>
                            <li><a href="<?php echo admin_url('/widgets.php') ?>"><?php echo esc_html('Widgets', 'sparklestore-pro') ?></a></li>
                        </ul>
                    </div>

                    <div class="sparkle-welcome-customizer-links">
                        <h4><?php echo esc_html('Quick Links - Customizer Settings') ?></h4>
                        <ul>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[panel]=sparklewp_header') ?>"><?php echo esc_html('Header Builder - Design header with your own hand.', 'sparklestore-pro') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=title_tagline') ?>"><?php echo esc_html('Upoad Logo - Add logo, title, tagline and favicon', 'sparklestore-pro') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=sparklestore_pro_per_loader_settings') ?>"><?php echo esc_html('Add Preloader - Show beautiful animated preloader untill your website loads', 'sparklestore-pro') ?></a></li>
                            
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[panel]=sparklestore_pro_general_settings') ?>"><?php echo esc_html('Header Settings - Set notice, top header, main header, verticle menu & breadcrumb settings', 'sparklestore-pro') ?></a></li>
                            
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=colors') ?>"><?php echo esc_html('Theme Color - Set the primary color of the theme', 'sparklestore-pro') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=sparklestore_pro_header_layouts') ?>"><?php echo esc_html('Header Layouts - Change the header layout from 6 styles', 'sparklestore-pro') ?></a></li>

                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=sparklestore_pro_slider_section') ?>"><?php echo esc_html('Home Slider - Change the slider type and settings', 'sparklestore-pro') ?></a></li>
                            
                            
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[panel]=woocommerce') ?>"><?php echo esc_html('WooCommerce Settings - Diffrent settings related to woocommerce pages', 'sparklestore-pro') ?></a></li>

                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=sparklestore_pro_footer_section') ?>"><?php echo esc_html('Footer Settings - Choose footer layout, column and colors', 'sparklestore-pro') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[panel]=sparklestore_design_settings_panel') ?>"><?php echo esc_html('Layout Settings - Choose blog, archive and search page layouts and sidebar', 'sparklestore-pro') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=sparklestore_pro_maintenance_section') ?>"><?php echo esc_html('Maintenance Screen - Display Comming Soon or Maintenace page untill your website is not ready', 'sparklestore-pro') ?></a></li>
                            <li><a href="<?php echo admin_url('/customize.php?autofocus[section]=sparklestore_pro_gdpr_section') ?>"><?php echo esc_html('GDPR Settings - Allows you to inform users that your site uses cookies and to comply with the EU cookie law GDPR regulations', 'sparklestore-pro') ?></a></li>
                        </ul>
                    </div>
                </div>

                <?php include self::$dir ."welcome-sidebar.php"; ?>
            </div><!-- .wrap -->
            <?php
        }

        function spl() {
            if( get_transient( $this->theme_config['theme_slug'] . '_spl_sacho_validation_local' ) === 'spl_valid') return;

            global $pagenow;
           
            $prevent_page = array(
                'sparkle-theme-install-plugins', 
                'sparkle-theme-demo-importer',
                'sparkle-theme-options',
                'sparkle-theme-system-status'
            );

            if( ($pagenow == 'admin.php' and  in_array($_GET['page'], $prevent_page) ) || $pagenow == 'widgets.php' || $pagenow == 'customize.php' ){
              
                $api_params = array(
                    'edd_action' => 'check_license',
                    'license' => trim(get_option($this->theme_config['theme_slug'] . '_spl_sparklestore_sacho')),
                    'item_name' => urlencode( $this->theme_config['item_name'] ),
                    'url' => home_url()
                );

                $response = wp_remote_post( $this->theme_config['remote_api_url'], array( 'body' => $api_params, 'timeout' => 15, 'sslverify' => false ) );
                if ( is_wp_error( $response ) ) {
                    return false;
                }
            
                $license_data = json_decode( wp_remote_retrieve_body( $response ) );
                if( $license_data->license != 'valid' ) {
                    set_transient($this->theme_config['theme_slug'] . '_spl_sparklestore_sacho_message', __("Invalid Licence key or Expired", 'sparklestore-pro'), ( 60 * 60 * 24));
                    wp_redirect(admin_url('admin.php?page=' . $this->theme_config['theme_slug']. '-license'));
                    exit();
                    
                }else{
                    set_transient($this->theme_config['theme_slug'] . '_spl_sacho_validation_local', 'spl_valid', (  60 * 60 * 24 ));
                }
            }
        }


        public function erase_hide_notice() {
            delete_option('sparklestore_pro_hide_notice');
        }
        
    }
}

if (!function_exists('sparklestore_pro_welcome')) {

    function sparklestore_pro_welcome() {
        return new Sparklestore_Pro_Pro_Welcome;
    }

}

sparklestore_pro_welcome();
