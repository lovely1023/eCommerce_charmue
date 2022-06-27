<?php

/**
 * Class description
 *
 * @package   package_name
 * @author    Cherry Team
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_Elements_Ext_Section' ) ) {

	/**
	 * Define Jet_Elements_Ext_Section class
	 */
	class Jet_Elements_Ext_Section {

		/**
		 * [$parallax_sections description]
		 * @var array
		 */
		public $parallax_sections = array();

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    object
		 */
		private static $instance = null;

		/**
		 * Init Handler
		 */
		public function init() {

			add_action( 'elementor/element/section/section_layout/after_section_end', array( $this, 'after_section_end' ), 10, 2 );

			add_action( 'elementor/frontend/element/before_render', array( $this, 'section_before_render' ) );

			add_action( 'elementor/frontend/section/before_render', array( $this, 'section_before_render' ) );

			add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'enqueue_scripts' ), 9 );
		}

		/**
		 * After section_layout callback
		 *
		 * @param  object $obj
		 * @param  array $args
		 * @return void
		 */
		public function after_section_end( $obj, $args ) {

			if ( class_exists( 'Jet_Parallax' ) ) {
				return false;
			}

			$obj->start_controls_section(
				'section_parallax',
				array(
					'label' => esc_html__( 'Parallax', 'sparklestore-pro' ),
					'tab'   => Elementor\Controls_Manager::TAB_LAYOUT,
				)
			);

			$obj->add_control(
				'jet_parallax_items_heading',
				array(
					'label'     => esc_html__( 'Layouts', 'sparklestore-pro' ),
					'type'      => Elementor\Controls_Manager::HEADING,
				)
			);

			$repeater = new Elementor\Repeater();

			$repeater->add_control(
				'jet_parallax_layout_image',
				array(
					'label'   => esc_html__( 'Image', 'sparklestore-pro' ),
					'type'    => Elementor\Controls_Manager::MEDIA,
				)
			);

			$repeater->add_control(
				'jet_parallax_layout_speed',
				array(
					'label'      => esc_html__( 'Parallax Speed(%)', 'sparklestore-pro' ),
					'type'       => Elementor\Controls_Manager::SLIDER,
					'size_units' => array( '%' ),
					'range'      => array(
						'%' => array(
							'min'  => 1,
							'max'  => 100,
						),
					),
					'default' => array(
						'size' => 50,
						'unit' => '%',
					),
				)
			);

			$repeater->add_control(
				'jet_parallax_layout_type',
				array(
					'label'   => esc_html__( 'Parallax Type', 'sparklestore-pro' ),
					'type'    => Elementor\Controls_Manager::SELECT,
					'default' => 'scroll',
					'options' => array(
						'none'   => esc_html__( 'None', 'sparklestore-pro' ),
						'scroll' => esc_html__( 'Scroll', 'sparklestore-pro' ),
						'mouse'  => esc_html__( 'Mouse Move', 'sparklestore-pro' ),
						'zoom'   => esc_html__( 'Scrolling Zoom', 'sparklestore-pro' ),
					),
				)
			);

			$repeater->add_control(
				'jet_parallax_layout_z_index',
				array(
					'label'    => esc_html__( 'z-Index', 'sparklestore-pro' ),
					'type'     => Elementor\Controls_Manager::NUMBER,
					'min'      => 0,
					'max'      => 99,
					'step'     => 1,
				)
			);

			$repeater->add_control(
				'jet_parallax_layout_bg_x',
				array(
					'label'   => esc_html__( 'Background X Position(%)', 'sparklestore-pro' ),
					'type'    => Elementor\Controls_Manager::NUMBER,
					'default' => 50,
					'min'     => -200,
					'max'     => 200,
					'step'    => 1,
				)
			);

			$repeater->add_control(
				'jet_parallax_layout_bg_y',
				array(
					'label'   => esc_html__( 'Background Y Position(%)', 'sparklestore-pro' ),
					'type'    => Elementor\Controls_Manager::NUMBER,
					'default' => 50,
					'min'     => -200,
					'max'     => 200,
					'step'    => 1,
				)
			);

			$repeater->add_control(
				'jet_parallax_layout_bg_size',
				array(
					'label'   => esc_html__( 'Background Size', 'sparklestore-pro' ),
					'type'    => Elementor\Controls_Manager::SELECT,
					'default' => 'auto',
					'options' => array(
						'auto'    => esc_html__( 'Auto', 'sparklestore-pro' ),
						'cover'   => esc_html__( 'Cover', 'sparklestore-pro' ),
						'contain' => esc_html__( 'Contain', 'sparklestore-pro' ),
					),
				)
			);

			$repeater->add_control(
				'jet_parallax_layout_animation_prop',
				array(
					'label'   => esc_html__( 'Animation Property', 'sparklestore-pro' ),
					'type'    => Elementor\Controls_Manager::SELECT,
					'default' => 'transform',
					'options' => array(
						'bgposition'  => esc_html__( 'Background Position', 'sparklestore-pro' ),
						'transform'   => esc_html__( 'Transform', 'sparklestore-pro' ),
						'transform3d' => esc_html__( 'Transform 3D', 'sparklestore-pro' ),
					),
				)
			);

			$repeater->add_control(
				'jet_parallax_layout_on',
				array(
					'label'       => __( 'Enable On Device', 'sparklestore-pro' ),
					'type'        => Elementor\Controls_Manager::SELECT2,
					'multiple'    => true,
					'label_block' => 'true',
					'default'     => array(
						'desktop',
						'tablet',
					),
					'options'     => array(
						'desktop' => __( 'Desktop', 'sparklestore-pro' ),
						'tablet'  => __( 'Tablet', 'sparklestore-pro' ),
						'mobile'  => __( 'Mobile', 'sparklestore-pro' ),
					),
				)
			);

			$obj->add_control(
				'jet_parallax_layout_list',
				array(
					'type'    => Elementor\Controls_Manager::REPEATER,
					'fields'  => array_values( $repeater->get_controls() ),
					'default' => array(
						array(
							'jet_parallax_layout_image' => array(
								'url' => '',
							),
						)
					),
				)
			);

			$obj->end_controls_section();
		}

		/**
		 * Elementor before section render callback
		 *
		 * @param  object $obj
		 * @return void
		 */
		public function section_before_render( $obj ) {
			$data     = $obj->get_data();
			$type     = isset( $data['elType'] ) ? $data['elType'] : 'section';
			$settings = $data['settings'];

			if ( 'section' === $type ) {

				if ( isset( $settings['jet_parallax_layout_list'] ) ) {
					$this->parallax_sections[ $data['id'] ] = $settings['jet_parallax_layout_list'];
				}
			}
		}

		/**
		 * [enqueue_scripts description]
		 *
		 * @return void
		 */
		public function enqueue_scripts() {
			wp_enqueue_script( 'jet-ease-pack', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/easing/EasePack.min.js', null, null, true );
			wp_enqueue_script( 'jet-tween-max', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TweenMax.min.js', null, null, true );

			if ( ! array_key_exists( 'jetParallaxSections', jet_elements_integration()->localize_data ) ) {
				jet_elements_integration()->localize_data['jetParallaxSections'] = $this->parallax_sections;
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
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

/**
 * Returns instance of Jet_Elements_Ext_Section
 *
 * @return object
 */
function jet_elements_ext_section() {
	return Jet_Elements_Ext_Section::get_instance();
}
