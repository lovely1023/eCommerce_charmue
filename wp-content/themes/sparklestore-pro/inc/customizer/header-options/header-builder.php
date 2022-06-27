<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header Builder and Customizer Options
 * @package SparkleStore Pro
 */

if ( ! class_exists( 'SparkleWP_Header_Builder' ) ) :

	class SparkleWP_Header_Builder {

		/**
		 * Panel ID, use for builder ID too
		 *
		 * @var string
		 * @access public
		 * @since 1.2.8
		 *
		 */
		public $panel = 'sparklewp_header';
		
		/**
		 * Top Header
		 */
		public $header_top = "sparklewp_header_top";
		
		/**
		 * Main Header
		 */
		public $header_main = "sparklestore_pro_main_header_general_settings";

		/**
		 * Main Header
		 */
		public $header_bottom = "sparklewp_header_bottom";

		/**
		 * Builder Sections and Controller ID
		 *
		 * @var string
		 * @access public
		 * @since 1.2.8
		 *
		 */
		public $builder_section_controller = 'sparklewp_header_builder_section_controller';

		/**
		 * Header NoticeBar Section/Setting/Control ID
		 *
		 * @var string
		 * @access public
		 * @since 1.2.8
		 *
		 */
		public $noticebar = 'sparklestore_pro_top_header_notice_bar';
		

		/**
		 * Header Socials Section/Setting/Control ID
		 *
		 * @var string
		 * @access public
		 * @since 1.2.8
		 *
		 */
		public $site_identity_logo = 'title_tagline';

		/**
		 * Primary Menu Section/Setting/Control ID
		 *
		 * @var string
		 * @access public
		 * @since 1.2.8
		 *
		 */
		public $primary_menu = 'sparklestore_pro_primary_menu';

		/**
		 * Header Menu Section/Setting/Control ID
		 *
		 * @var string
		 * @access public
		 * @since 1.2.8
		 *
		 */
		public $secondary_menu = 'secondary_menu';

		/**
		 * Menu Icon Section/Setting/Control ID
		 *
		 * @var string
		 * @access public
		 * @since 1.2.8
		 *
		 */
		public $menu_icon = 'sparkletheme_menu_toggle';

		/**
		 * Off canvas Sidebar Icon Section/Setting/Control ID
		 *
		 * @var string
		 * @access public
		 * @since 1.2.8
		 *
		 */
		public $search = 'sparklestore_pro_header_search';

		/**
		 * Header Socials Section/Setting/Control ID
		 *
		 * @var string
		 * @access public
		 * @since 1.2.8
		 *
		 */
		public $header_social = 'sparklestore_pro_social_link_activate_settings';

		
		/**
		 * Header Button Section/Setting/Control ID
		 *
		 * @var string
		 * @access public
		 * @since 1.2.8
		 *
		 */
		public $button_one = 'button_one';

		/**
		 * Quick Contact Info Section/Setting/Control ID
		 *
		 * @var string
		 * @access public
		 * @since 1.2.8
		 *
		 */
		public $quick_info = 'sparklestore_pro_header_quickinfo';

		/**
		 * HTML Section/Setting/Control ID
		 *
		 * @var string
		 * @access public
		 * @since 1.2.8
		 *
		 */
		public $html = 'sparklestore_pro_header_html';


		/**
		 * Login Register Section/Setting/Control ID
		 *
		 * @var string
		 * @access public
		 * @since 1.2.8
		 *
		 */
		public $login_register = 'sparklestore_pro_login_register';

		/**
		 * Wishlist Section/Setting/Control ID
		 *
		 * @var string
		 * @access public
		 * @since 1.2.8
		 *
		 */
		public $wishlist = 'sparklestore_pro_wishlist';
	
		
		/**
		 * Compare Section/Setting/Control ID
		 *
		 * @var string
		 * @access public
		 * @since 1.2.8
		 *
		 */
		public $cart = 'sparklestore_pro_cart';
		
		/**
		 * Vertical Menu Section/Setting/Control ID
		 *
		 * @var string
		 * @access public
		 * @since 1.2.8
		 *
		 */
		public $vertical_menu = 'sparklestore_vertical_menu_section';

		/**
		 * Main Instance
		 *
		 * Insures that only one instance of SparkleWP_Header_Builder exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @since    1.2.8
		 * @access   public
		 *
		 * @return object
		 */
		public static function instance() {

			// Store the instance locally to avoid private static replication
			static $instance = null;

			// Only run these methods if they haven't been ran previously
			if ( null === $instance ) {
				$instance = new SparkleWP_Header_Builder;
			}

			// Always return the instance
			return $instance;
		}

		/**
		 *  Run functionality with hooks
		 *
		 * @since    1.2.8
		 * @access   public
		 *
		 * @return void
		 */
		public function run() {

			
			// add_action( 'customize_register', array( $this, 'set_customizer' ), 1 );
			add_filter( 'sparklewp_default_theme_options', array( $this, 'header_defaults' ) );
			add_filter( 'sparklewp_builders', array( $this, 'header_builder' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ), 100 );
			add_action( 'sparklewp_before_main_wrap', array( $this, 'header_outside' ), 100 );
			add_action( 'sparklewp_action_header', array( $this, 'display_header' ), 100 );
			add_filter( 'sparklewp_dynamic_css', array( $this, 'dynamic_css' ), 100 );

			add_filter( 'init', array( $this, 'set_default_customizer_value' ), 100 );
		}


		/**
		 * Backward theme compatibility
		 * Fixed default header issue problem (header not set for exitings setup)
		 * @since 1.2.8
		 * @access public
		 * @return null
		 */
		function set_default_customizer_value(){
		    
			if( get_theme_mod(sparklewp_header_builder()->builder_section_controller, false) == false  || get_theme_mod(sparklewp_header_builder()->builder_section_controller, false) == ''){
				//setup default value
				$builder = sparklewp_header_builder()->header_defaults()[sparklewp_header_builder()->builder_section_controller];
				if ( is_array( $builder ) ) {
					$builder = json_encode( urldecode_deep( $builder ), true );
				}
				set_theme_mod( sparklewp_header_builder()->builder_section_controller, $builder );
			}
			//already set return null
		}

		/**
		 * Callback functions for customize_register,
		 * Fixed previous array issue
		 *
		 * @since    1.2.8
		 * @access   public
		 *
		 * @param null
		 * @return void
		 */
		public function set_customizer() {
			$builder = sparklewp_get_theme_options( sparklewp_header_builder()->builder_section_controller );
			if ( is_array( $builder ) ) {
				$builder = json_encode( urldecode_deep( $builder ), true );
			}
			set_theme_mod( sparklewp_header_builder()->builder_section_controller, $builder );
		}

		/**
		 * Get header builder
		 *
		 * @since    1.2.8
		 * @access   public
		 *
		 * @param null
		 * @return void
		 */
		public function get_builder() {
			$builder = sparklewp_get_theme_options( sparklewp_header_builder()->builder_section_controller );
			if ( ! is_array( $builder ) ) {
				$builder = json_decode( urldecode_deep( $builder ), true );
			}
			return $builder;
		}

		/**
		 * Callback functions for sparklewp_default_theme_options,
		 * Add Header Builder defaults values
		 *
		 * @since    1.2.8
		 * @access   public
		 *
		 * @param array $default_options
		 * @return array
		 */
		public function header_defaults( $default_options = array() ) {
			require get_template_directory(). '/inc/customizer/header-options/header-defaults.php';
			return $header_defaults;
		}

		/**
		 * Callback functions for sparklewp_builders,
		 * Add Header Builder elements
		 *
		 * @since    1.2.8
		 * @access   public
		 *
		 * @param array $builder builder fields
		 * @return array
		 */
		public function header_builder( $builder ) {

			$items = apply_filters(
				'sparklewp_header_builder_item',
				array(
					sparklewp_header_builder()->noticebar => array(
						'icon'    => 'dashicons dashicons-controls-volumeon',
						'name'    => esc_html__( 'Notice Bar', 'sparklestore-pro' ),
						'desc'    => esc_html__( 'Top Notice Bar', 'sparklestore-pro' ),
						'id'      => sparklewp_header_builder()->noticebar,
						'col'     => 0,
						'width'   => '12',
						'section' => sparklewp_header_builder()->noticebar,
					),

					sparklewp_header_builder()->login_register => array(
						'icon'    => 'dashicons dashicons-admin-users',
						'name'    => esc_html__( 'Account', 'sparklestore-pro' ),
						'desc'    => esc_html__( 'Login / Register', 'sparklestore-pro' ),
						'id'      => sparklewp_header_builder()->login_register,
						'col'     => 0,
						'width'   => '1',
						'section' => sparklewp_header_builder()->login_register,
					),
					

					sparklewp_header_builder()->site_identity_logo => array(
						'icon'    => 'dashicons dashicons-admin-home',
						'name'    => esc_html__( 'Site Identity and Logo', 'sparklestore-pro' ),
						'desc'    => esc_html__( 'Site Title, Tagline and Logo', 'sparklestore-pro' ),
						'id'      => sparklewp_header_builder()->site_identity_logo,
						'col'     => 0,
						'width'   => '4',
						'section' => sparklewp_header_builder()->site_identity_logo,
					),
					sparklewp_header_builder()->primary_menu => array(
						'icon'    => 'dashicons dashicons-menu',
						'name'    => esc_html__( 'Primary Menu', 'sparklestore-pro' ),
						'id'      => sparklewp_header_builder()->primary_menu,
						'col'     => 0,
						'width'   => '12',
						'section' => sparklewp_header_builder()->primary_menu,
					),
					sparklewp_header_builder()->secondary_menu => array(
						'icon'    => 'dashicons dashicons-menu',
						'name'    => esc_html__( 'Secondary Menu', 'sparklestore-pro' ),
						'id'      => sparklewp_header_builder()->secondary_menu,
						'col'     => 0,
						'width'   => '4',
						'section' => sparklewp_header_builder()->secondary_menu,
					),
					sparklewp_header_builder()->vertical_menu => array(
						'icon'    => 'dashicons dashicons-menu',
						'name'    => esc_html__( 'Vertical Menu(Category)', 'sparklestore-pro' ),
						'desc'    => esc_html__( 'Show Vertical Menu (Category)', 'sparklestore-pro' ),
						'id'      => sparklewp_header_builder()->vertical_menu,
						'col'     => 0,
						'width'   => '4',
						'section' => sparklewp_header_builder()->vertical_menu,
					),
					sparklewp_header_builder()->header_social => array(
						'icon'    => 'dashicons dashicons-networking',
						'name'    => esc_html__( 'Social Icons', 'sparklestore-pro' ),
						'id'      => sparklewp_header_builder()->header_social,
						'col'     => 0,
						'width'   => '4',
						'section' => sparklewp_header_builder()->header_social,
					),
					
					sparklewp_header_builder()->search => array(
						'icon'    => 'dashicons dashicons-search',
						'name'    => esc_html__( 'Search', 'sparklestore-pro' ),
						'id'      => sparklewp_header_builder()->search,
						'col'     => 0,
						'width'   => '4',
						'section' => sparklewp_header_builder()->search,
					),
					sparklewp_header_builder()->menu_icon  => array(
						'icon'    => 'dashicons dashicons-menu',
						'name'    => esc_html__( 'Menu Icon', 'sparklestore-pro' ),
						'id'      => sparklewp_header_builder()->menu_icon,
						'col'     => 0,
						'width'   => '4',
						'section' => sparklewp_header_builder()->menu_icon,
					),
					sparklewp_header_builder()->button_one => array(
						'icon'    => 'dashicons dashicons-plus-alt',
						'name'    => esc_html__( 'Button One', 'sparklestore-pro' ),
						'id'      => sparklewp_header_builder()->button_one,
						'col'     => 0,
						'width'   => '4',
						'section' => sparklewp_header_builder()->button_one,
					),
					sparklewp_header_builder()->quick_info => array(
						'icon'    => 'dashicons dashicons-phone',
						'name'    => esc_html__( 'Quick Contact Info', 'sparklestore-pro' ),
						'id'      => sparklewp_header_builder()->quick_info,
						'col'     => 0,
						'width'   => '4',
						'section' => sparklewp_header_builder()->quick_info,
					),
					sparklewp_header_builder()->html       => array(
						'icon'    => 'dashicons dashicons-edit',
						'name'    => esc_html__( 'HTML', 'sparklestore-pro' ),
						'id'      => sparklewp_header_builder()->html,
						'col'     => 0,
						'width'   => '4',
						'section' => sparklewp_header_builder()->html,
					),
					sparklewp_header_builder()->wishlist       => array(
						'icon'    => 'dashicons dashicons-heart',
						'name'    => esc_html__( 'Wishlist', 'sparklestore-pro' ),
						'id'      => sparklewp_header_builder()->wishlist,
						'col'     => 0,
						'width'   => '1',
						'section' => sparklewp_header_builder()->wishlist,
					),

					sparklewp_header_builder()->cart       => array(
						'icon'    => 'dashicons dashicons-cart',
						'name'    => esc_html__( 'Cart', 'sparklestore-pro' ),
						'id'      => sparklewp_header_builder()->cart,
						'col'     => 0,
						'width'   => '1',
						'section' => sparklewp_header_builder()->cart,
					)
				)
			);

			$header_builder = array(
				sparklewp_header_builder()->panel => array(
					'id'         => sparklewp_header_builder()->panel,
					'title'      => esc_html__( 'Header Builder', 'sparklestore-pro' ),
					'control_id' => sparklewp_header_builder()->builder_section_controller,
					'panel'      => sparklewp_header_builder()->panel,
					'section'    => sparklewp_header_builder()->builder_section_controller,
					'devices'    => array(
						'desktop' => esc_html__( 'Desktop', 'sparklestore-pro' ),
						'mobile'  => esc_html__( 'Mobile/Tablet', 'sparklestore-pro' ),
						'all'     => esc_html__( 'Menu Icon Sidebar', 'sparklestore-pro' ),
					),
					'items'      => $items,
					'rows'       => array(
						'top'     => esc_html__( 'Header Top', 'sparklestore-pro' ),
						'main'    => esc_html__( 'Header Main', 'sparklestore-pro' ),
						'bottom'  => esc_html__( 'Header Bottom', 'sparklestore-pro' ),
						'sidebar' => __( 'Menu Sidebar', 'sparklestore-pro' ),
					),
				),
			);
			$header_builder = apply_filters( 'sparklewp_header_builder', $header_builder );
			return array_merge( $builder, $header_builder );

		}

		/**
		 * Callback functions for customize_register,
		 * Add Panel Section control
		 *
		 * @since    1.2.8
		 * @access   public
		 *
		 * @param object $wp_customize
		 * @return void
		 */
		public function customize_register( $wp_customize ) {

			$header_defaults = sparklewp_header_builder()->header_defaults();

			/**
			 * Panel
			 */
			$wp_customize->add_panel(
				sparklewp_header_builder()->panel,
				array(
					'title'    => esc_html__( 'Header Builder/Options', 'sparklestore-pro' ),
					'priority' => 20,
				)
			);

			/**
			 * Builder Section use for builder only
			 */
			$wp_customize->add_section(
				sparklewp_header_builder()->builder_section_controller,
				array(
					'title'    => esc_html__( 'Header Builder', 'sparklestore-pro' ),
					'priority' => 8,
					'panel'    => sparklewp_header_builder()->panel,
				)
			);

			/**
			 * Builder control and setting
			 */
			$wp_customize->add_setting(
				sparklewp_header_builder()->builder_section_controller,
				array(
					'default'           => $header_defaults[ sparklewp_header_builder()->builder_section_controller ],
					'sanitize_callback' => 'sparklewp_customizer_builder_sanitize_field',
					// 'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				sparklewp_header_builder()->builder_section_controller,
				array(
					'label'    => esc_html__( 'Header Builder', 'sparklestore-pro' ),
					'section'  => sparklewp_header_builder()->builder_section_controller,
					'settings' => sparklewp_header_builder()->builder_section_controller,
					'type'     => 'text',
				)
			);

			/**
			* Header Defaults Layout
			*/
			require get_template_directory(). '/inc/customizer/header-options/header-general.php';
			require get_template_directory(). '/inc/customizer/header-options/header-top.php';
			require get_template_directory() . '/inc/customizer/customizer-panel/header-main.php';
			require get_template_directory() . '/inc/customizer/customizer-panel/header-settings.php';
			require get_template_directory(). '/inc/customizer/header-options/header-bottom.php';
			
			require get_template_directory(). '/inc/customizer/header-options/site-identity.php';
			require get_template_directory(). '/inc/customizer/header-options/primary-menu.php' ;
			require get_template_directory(). '/inc/customizer/header-options/secondary-menu.php';
			require get_template_directory(). '/inc/customizer/header-options/header-vertical-menu.php';
			
			
			require get_template_directory( ). '/inc/customizer/header-options/button-one.php';
			require get_template_directory() . '/inc/customizer/header-options/menu-icon.php';
			require get_template_directory(). '/inc/customizer/header-options/menu-icon-sidebar-setting.php';
			
			require get_template_directory(). '/inc/customizer/header-options/header-account.php' ;
			require get_template_directory(). '/inc/customizer/header-options/header-cart.php';
			require get_template_directory(). '/inc/customizer/header-options/header-wishlist.php';

		}

		/**
		 * Sort Item of Header Builder Item
		 *
		 * @since    1.2.8
		 * @access   public
		 *
		 * @param array $items
		 * @return array
		 */
		public function sort_items( $items = array() ) {
			$ordered_items = array();

			foreach ( $items as $key => $item ) {
				$ordered_items[ $key ] = $item['x'];
			}

			array_multisort( $ordered_items, SORT_ASC, $items );

			return $items;
		}

		/**
		 *Column Element
		 *
		 * @since    1.2.8
		 * @access   public
		 *
		 * @param $column_elements
		 */
		public function column_elements( $column_elements ) {
			echo '<div class="grid-container"><div class="grid-row">';
			$added_elements_ids = array();
			$max_col            = 12;
			$total_elements     = count( $column_elements );
			$i                  = 1;
			$prev_width         = 0;
			foreach ( $column_elements as $single_elements ) {

				$id                   = $single_elements['id'];
				$added_elements_ids[] = $id;
				$x                    = $single_elements['x'];
				$width                = $single_elements['width'];

				$grid = 'grid-' . $width;
				if ( $prev_width < $x ) {
					$diff      = $x - $prev_width;
					$diff_grid = 'grid-' . $diff;
					echo '<div class="' . $diff_grid . '"></div>';
				}
				echo '<div class="spwp-grid-column ' . $grid . '">';
				// echo $id. " \n";
				do_action( $id );
				echo '</div>';

				$prev_width = $x + $width;
				if ( $i == $total_elements && $prev_width < $max_col ) {
					$diff      = $max_col - $prev_width;
					$diff_grid = 'grid-' . $diff;
					echo '<div class="' . $diff_grid . '"></div>';
				}
				$i++;
			}
			echo '</div>';/*.grid-row*/
			do_action( 'sparklewp_below_row', $added_elements_ids );
			echo '</div>';/*.grid-container*/
		}

		/**
		 * Callback Function For sparklewp_action_header
		 * Display Header Content
		 *
		 * @since    1.2.8
		 * @access   public
		 *
		 * @return
		 */
		public function display_header() {
			if ( sparklewp_is_active_header() ) {
				$header_class[] = 'position-'.get_theme_mod('header-position-options', 'normal');
				$header_class[] = get_theme_mod('header-general-width', 'inherit');
				?>
				<header id="masthead" class="site-header <?php echo implode(" ",$header_class); ?>" itemscope="itemscope" itemtype="http://schema.org/WPHeader" role="banner">		
					<div class="header-container">
					<?php
					$builder = sparklewp_header_builder()->get_builder();
					if ( isset( $builder['desktop'] ) && ! empty( $builder['desktop'] ) ) {
						$desktop_builder = $builder['desktop'];
						foreach ( $desktop_builder as $key => $single_row ) {
							if ( empty( $single_row ) ) {
								unset( $desktop_builder[ $key ] );
							}
						}
						if ( ! empty( $desktop_builder ) ) {
							sparklewp_header_builder()->desktop_header( $desktop_builder );
						}
					}
					if ( isset( $builder['mobile'] ) && ! empty( $builder['mobile'] ) ) {
						$mobile_builder = $builder['mobile'];
						foreach ( $mobile_builder as $key => $single_row ) {
							if ( empty( $single_row ) ) {
								unset( $mobile_builder[ $key ] );
							}
						}
						if ( ! empty( $mobile_builder ) ) {
							sparklewp_header_builder()->mobile_header( $mobile_builder );
						}
					}
					?>
					</div>
				</header>
				<?php
			}

		}

		/**
		 * Callback Function For sparklewp_action_header
		 * Display Header Content
		 *
		 * @since    1.2.8
		 * @access   public
		 *
		 * @return void
		 */
		public function header_outside() {

			if ( sparklewp_is_active_header() ) {
				?>
				<div id="spwp-header-menu-sidebar" class="spwp-header-menu-sidebar">
					<?php
					$builder = sparklewp_header_builder()->get_builder();
					if ( isset( $builder['all']['sidebar'] ) && ! empty( $builder['all']['sidebar'] ) ) {
						$sidebar_element = $builder['all']['sidebar'];
						if ( is_array( $sidebar_element ) ) {
							foreach ( $sidebar_element as $key ) {
								if ( isset( $key['id'] ) && ! empty( $key['id'] ) ) {
									if( $key['id'] == 'sparklestore_pro_primary_menu'){
										do_action('sparklestore_pro_primary_menu_mobile');
									}else{
										do_action( $key['id'] );
									}
								}
							}
						}
					}
					?>

				</div>
				<?php
			}

		}

		/**
		 * Display Desktop Header Content
		 *
		 * @since    1.2.8
		 * @access   public
		 *
		 * @return array
		 */
		public function desktop_header( $desktop_builder ) {

			?>
			<div class="spwp-desktop-header spwp-hide-on-mobile">
				<?php
				if ( isset( $desktop_builder['top'] ) ) {

					// <!-- Start of .spwp-top-header -->
					?>
					<div class="header-top grid-row">
						<div class="container">
							<div class="top-header-inner">
								<div class="top-bar-menu">
									<?php sparklewp_header_builder()->column_elements( sparklewp_header_builder()->sort_items( $desktop_builder['top'] ) ); ?>
								</div>
							</div>
						</div>
					</div>
					<?php
					// <!-- End of .spwp-top-header -->

				}
				if ( isset( $desktop_builder['main'] ) ) {
					?>
					<div class="header-middle flex-center clearfix">
						<div class="container">
							<div class="header-middle-inner header-middle-inner-desktop">
								<?php sparklewp_header_builder()->column_elements( sparklewp_header_builder()->sort_items( $desktop_builder['main'] ) ); ?>
							</div>
						</div>
					</div>
					<?php

				}
				if ( isset( $desktop_builder['bottom'] ) ) {
					//<!-- Start of .spwp-bottom-header -->
					?>
					
					<div class="sp-bottom-header flex-center">
						<div class="container">
							<?php sparklewp_header_builder()->column_elements( sparklewp_header_builder()->sort_items( $desktop_builder['bottom'] ) ); ?>
						</div>
					</div>
					
					<?php
					// <!-- End of .spwp-bottom-header -->
				}
				?>
			</div>
			<?php

		}

		/**
		 * Display Mobile Header Content
		 *
		 * @since    1.2.8
		 * @access   public
		 *
		 * @return array
		 */
		public function mobile_header( $mobile_builder ) {
			?>
			<div class="spwp-mobile-header spwp-hide-on-desktop">
				
				<?php
				if ( isset( $mobile_builder['top'] ) ) {
					?>
					<!-- Start of .spwp-top-header -->
					<div class="header-top grid-row">
						<div class="container">
							<?php
							$top_elements = sparklewp_header_builder()->sort_items( $mobile_builder['top'] );
							sparklewp_header_builder()->column_elements( $top_elements );
							?>
						</div>
					</div>
					<!-- End of .spwp-top-header -->
					<?php

				}
				if ( isset( $mobile_builder['main'] ) ) {
					?>
					<div class="header-middle flex-center">
						<div class="container">
							<?php
							$main_elements = sparklewp_header_builder()->sort_items( $mobile_builder['main'] );
							sparklewp_header_builder()->column_elements( $main_elements );
							?>
						</div>
					</div>
					<?php

				}
				if ( isset( $mobile_builder['bottom'] ) ) {
					?>
					<!-- Start of .spwp-bottom-header -->
					<div class="sp-bottom-header">
						<div class="container">
							<?php
							$bottom_elements = sparklewp_header_builder()->sort_items( $mobile_builder['bottom'] );
							sparklewp_header_builder()->column_elements( $bottom_elements );
							?>
						</div>
					</div>
					<!-- End of .spwp-bottom-header -->
					<?php
				}
				?>
			</div>
			<?php
		}


		/**
		 * Callback functions for sparklewp_dynamic_css,
		 * Add Dynamic Css
		 *
		 * @since    1.2.8
		 * @access   public
		 *
		 * @param array $dynamic_css
		 * @return array
		 */
		public function dynamic_css( $dynamic_css ) {

			require get_template_directory().'/inc/customizer/header-options/dynamic-css.php';
			if ( is_array( $dynamic_css ) && ! empty( $dynamic_css ) ) {
				$all_css = array_merge_recursive( $dynamic_css, $local_dynamic_css );
				return $all_css;
			} else {
				return $local_dynamic_css;
			}
		}
	}

endif;

/**
 * Create Instance for SparkleWP_Header_Builder
 *
 * @since    1.2.8
 * @access   public
 *
 * @param
 * @return object
 */
if ( ! function_exists( 'sparklewp_header_builder' ) ) {

	function sparklewp_header_builder() {

		return SparkleWP_Header_Builder::instance();
	}

	sparklewp_header_builder()->run();
}