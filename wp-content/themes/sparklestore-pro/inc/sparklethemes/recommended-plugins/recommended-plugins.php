<?php
if (!class_exists('Sparklestore_Pro_Recommended_Plugins')) {

    class Sparklestore_Pro_Recommended_Plugins {

        /**
         * Recommended Plugins Array
         * @var     array
         * @access  public
         * @since   1.0.0
         */
        public $this_uri;
        public $this_dir;

        public function __construct() {

            // This uri & dir
            $this->this_uri = get_template_directory_uri() . '/inc/sparklethemes/recommended-plugins/';
            $this->this_dir = get_template_directory() . '/inc/sparklethemes/recommended-plugins/';

            /* Resigter Recommended Plugin Menu */
            add_action('admin_menu', array($this, 'register_menu'));

            /* Enqueue Styles & Scripts for Welcome Page */
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));

            require_once $this->this_dir . 'plugin-installer.php';
        }

        public static function get_recommended_plugins() {
            $recommended_plugins = array(
                array(
                    'name' => 'WooCommerce',
                    'slug' => 'woocommerce',
                    'required' => true,

                    'path' => 'woocommerce/woocommerce.php',
                    'file' => 'woocommerce.php',

                    'description' => esc_html__('WooCommerce is a flexible, open-source eCommerce solution built on WordPress. Whether you’re launching a business, taking an existing brick and mortar store online, or designing sites for clients you can get started quickly and build exactly the store you want..', 'buzzstore-pro'),
                    'external_url' => 'https://wordpress.org/plugins/woocommerce/',
                    'author_name' => 'Automattic',
                    'author_url' => 'https://woocommerce.com/',
                    'icon' => 'https://ps.w.org/woocommerce/assets/icon-128x128.png'
                ),
                array(
                    'name' => 'YITH WooCommerce Compare',
                    'slug' => 'yith-woocommerce-compare',
                    'path' => 'yith-woocommerce-compare/init.php',
                    'file' => 'init.php',
                    'required' => false,
                    'description' => esc_html__('YITH WooCommerce Compare plugin is an extension of WooCommerce plugin that allow your users to compare some products of your shop.', 'buzzstore-pro'),
                    'external_url' => 'https://wordpress.org/plugins/yith-woocommerce-compare/',
                    'author_name'   => 'YITH',
                    'author_url'    => 'https://yithemes.com/',
                    'icon'          => 'https://ps.w.org/yith-woocommerce-compare/assets/icon-128x128.jpg'
                ),
                array(
                    'name' => 'YITH WooCommerce Quick View',
                    'slug' => 'yith-woocommerce-quick-view',
                    'path' => 'yith-woocommerce-quick-view/init.php',
                    'file' => 'init.php',
                    'required' => false,
                    'description' => esc_html__('Sometimes the halfway is better: what if you are looking to a product in a list and its image is still too small?.', 'buzzstore-pro'),
                    'external_url' => 'https://wordpress.org/plugins/yith-woocommerce-quick-view/',
                    'author_name'   => 'YITH',
                    'author_url'    => 'https://yithemes.com/',
                    'icon'          => 'https://ps.w.org/yith-woocommerce-quick-view/assets/icon-128x128.jpg'
                ),
                array(
                    'name' => 'YITH WooCommerce Wishlist',
                    'slug' => 'yith-woocommerce-wishlist',
                    'path' => 'yith-woocommerce-wishlist/init.php',
                    'file' => 'init.php',
                    'required'      => false,
                    'description'   => esc_html__('he wishlist is one of the most powerful and popular tools in an ecommerce shop.', 'buzzstore-pro'),
                    'external_url'  => 'https://wordpress.org/plugins/yith-woocommerce-wishlist/',
                    'author_name'   => 'YITH',
                    'author_url'    => 'https://yithemes.com/',
                    'icon'          => 'https://ps.w.org/yith-woocommerce-wishlist/assets/icon-128x128.jpg'
                ),

                array(
                    'name' => 'Contact Form 7',
                    'slug' => 'contact-form-7',
                    'path' => 'contact-form-7/wp-contact-form-7.php',
                    'file' => 'wp-contact-form-7.php',
                    'required' => false,
                    'description' => esc_html__('Just another contact form plugin. Simple but flexible.', 'buzzstore-pro'),
                    'external_url' => 'https://wordpress.org/plugins/contact-form-7/',
                    'author_name' => 'Takayuki Miyoshi',
                    'author_url' => 'https://ideasilo.wordpress.com/',
                    'icon' => 'https://ps.w.org/contact-form-7/assets/icon-256x256.png'
                ),
                array(
                    'name' => 'Elementor',
                    'slug' => 'elementor',
                    'required' => false,
                    'description' => esc_html__('The most advanced frontend drag & drop page builder. Create high-end, pixel perfect websites at record speeds. Any theme, any page, any design.', 'buzzstore-pro'),
                    'external_url' => 'https://wordpress.org/plugins/elementor/',
                    'author_name' => 'Elementor',
                    'author_url' => 'https://elementor.com/',
                    'icon' => 'https://ps.w.org/elementor/assets/icon.svg'
                ),
                
                array(
                    'name' => 'SiteOrigin Widgets Bundle',
                    'slug' => 'so-widgets-bundle',
                    'required' => false,
                    'description' => esc_html__('A collection of all widgets, neatly bundled into a single plugin. It\'s also a framework to code your own widgets on top of.', 'buzzstore-pro'),
                    'external_url' => 'https://wordpress.org/plugins/so-widgets-bundle/',
                    'author_name' => 'SiteOrigin',
                    'author_url' => 'https://wordpress.org/plugins/so-widgets-bundle/',
                    'icon' => 'https://ps.w.org/so-widgets-bundle/assets/icon-256x256.png'
                ),
                
                array(
                    'name' => 'Dokan',
                    'slug' => 'dokan-lite',
                    'required' => false,
                    'path' => 'dokan-lite/dokan.php',
                    'file' => 'dokan.php',

                    'description' => esc_html__('Dokan – Best WooCommerce Multivendor Marketplace Solution – Build Your Own Amazon, eBay, Etsy', 'buzzstore-pro'),
                    'external_url' => 'https://wordpress.org/plugins/dokan-lite/',
                    'author_name' => 'wedevs',
                    'author_url' => 'https://wedevs.com/',
                    'icon' => 'https://ps.w.org/dokan-lite/assets/icon-128x128.png'
                ),
                array(
                    'name' => 'Revolution Slider',
                    'slug' => 'revslider',
                    'source' => 'https://demo.sparklewpthemes.com/demo-data/revslider.zip',
                    'required' => false,
                    'description' => esc_html__('Slider Revolution - Premium responsive slider', 'buzzstore-pro'),
                    'external_url' => 'https://revolution.themepunch.com/',
                    'author_name' => 'Theme Punch',
                    'author_url' => 'https://revolution.themepunch.com/',
                    'icon' => get_template_directory_uri() . '/inc/sparklethemes/recommended-plugins/images/revolution-slider.png'
                )
            );

            return $recommended_plugins;
        }

        public function register_menu() {
            add_submenu_page('sparklestore-pro', esc_html__('Install Plugins', 'sparklestore-pro'), esc_html__('Install Plugins', 'sparklestore-pro'), 'manage_options', 'sparklestore-pro-install-plugins', array($this, 'recommended_plugin_page'));
            global $submenu;

            $submenu['sparklestore-pro'][] = array(esc_html__('Customize', 'sparklestore-pro'), 'manage_options', admin_url('customize.php'));
            $submenu['sparklestore-pro'][] = array(esc_html__('Widgets', 'sparklestore-pro'), 'manage_options', admin_url('widgets.php'));
        }

        public function recommended_plugin_page() {
            $recommended_plugins = Sparklestore_Pro_Recommended_Plugins::get_recommended_plugins();
            ?>
            <div class="wrap recommended-plugin-wrap">
                <h1><?php esc_html_e('Recommended Plugins', 'sparklestore-pro'); ?></h1>
                <p><?php esc_html_e('To utilize the theme fully, please install all the Recommended Plugins. Please install it one by one.', 'sparklestore-pro'); ?></p>

                <div class="recommended-plugins-list wp-clearfix">
                    <?php
                    foreach ($recommended_plugins as $plugin) {
                        $icon_url = $plugin['icon'];
                        $author = $plugin['author_name'];
                        $name = $plugin['name'];
                        $link = $plugin['external_url'];
                        $btn_class = Sparklestore_Pro_Plugin_Installer::generate_plugin_class($plugin);
                        $label = Sparklestore_Pro_Plugin_Installer::generate_plugin_label($plugin);
                        $status = Sparklestore_Pro_Plugin_Installer::plugin_active_status($plugin);
                        $source = isset($plugin['source']) ? $plugin['source'] : '';
                        $path = isset($plugin['path']) ? $plugin['path'] : $plugin['slug'] . '/' . $plugin['slug'] . '.php';
                        ?>
                        <div class="recommended-plugin">
                            <?php
                            if ($status == 'active') {
                                ?>
                                <div class="item-ribbon active">
                                    <i class="dashicons dashicons-yes"></i>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="plugin-img-wrap">
                                <img src="<?php echo esc_url($icon_url); ?>" />
                                <div class="version-author-info">
                                    <span class="author"><?php printf(esc_html__('By %s', 'sparklestore-pro'), $author); ?></span>
                                </div>
                            </div>
                            <div class="plugin-title-install wp-clearfix">
                                <span class="title" title="<?php echo esc_attr($name); ?>">
                                    <?php echo esc_html($name); ?>
                                </span>

                                <span class="plugin-action-btn plugin-btn-wrapper plugin-card-<?php echo esc_attr($plugin['slug']); ?>">
                                    <a
                                        class="<?php echo esc_attr($btn_class); ?>" 
                                        data-source="<?php echo esc_attr($source); ?>"
                                        data-slug="<?php echo esc_attr($plugin['slug']); ?>" 
                                        data-path="<?php echo esc_attr($path); ?>"
                                        href="javascript:void()">
                                            <?php echo esc_html($label); ?>
                                    </a>
                                </span>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
            <?php
        }

        public function enqueue_scripts($hook) {
            // exit($hook);
            if( 'theme-panel_page_sparklestore-pro-install-plugins' == $hook ){
                wp_enqueue_style('recommended-plugins', $this->this_uri . 'css/style.css');
                wp_enqueue_style('plugin-install');
                wp_enqueue_script('plugin-install');
                wp_enqueue_script('updates');
            }
        }

    }

}

new Sparklestore_Pro_Recommended_Plugins;

