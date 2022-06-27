<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Jet_Elements_Mp_Timetable extends Jet_Elements_Base {

	public function get_name() {
		return 'mp-timetable';
	}

	public function get_title() {
		return esc_html__( 'Timetable by MotoPress', 'sparklestore-pro' );
	}

	public function get_icon() {
		return 'eicon-table';
	}

	public function get_categories() {
		return array( 'cherry' );
	}

	public function __tag() {
		return 'mp-timetable';
	}

	public function get_script_depends() {

		if ( ! isset( $_GET['elementor-preview'] ) ) {
			return array();
		}

		$core = \mp_timetable\plugin_core\classes\Core::get_instance();

		wp_register_script(
			'mptt-event-object',
			\Mp_Time_Table::get_plugin_url( 'media/js/events/event' . $core->get_prefix() . '.js' ),
			array( 'jquery' ),
			$core->get_version()
		);

		wp_register_script(
			'mptt-functions',
			\Mp_Time_Table::get_plugin_url( 'media/js/mptt-functions' . $core->get_prefix() . '.js' ),
			array( 'jquery', 'underscore' ),
			$core->get_version()
		);

		wp_localize_script(
			'mptt-event-object',
			'MPTT',
			array(
				'table_class' => apply_filters( 'mptt_shortcode_static_table_class', 'mptt-shortcode-table' ),
			)
		);

		return array( 'mptt-functions', 'mptt-event-object' );
	}

	/**
	 * @param array $data_array
	 * @param string $type
	 *
	 * @return array
	 */
	public function __create_list( $data_array = array(), $type = 'post' ) {
		$list_array = array();
		switch ( $type ) {
			case "post":
				foreach ( $data_array as $item ) {
					$list_array[ $item->ID ] = $item->post_title;
				}
				break;
			case "term":
				foreach ( $data_array as $item ) {
					$list_array[ $item->term_id ] = $item->name;
				}
				break;
			default:
				break;
		}

		return $list_array;
	}

	public function __atts() {

		$columns    = $this->__create_list( \mp_timetable\classes\models\Column::get_instance()->get_all_column() );
		$events     = $this->__create_list( \mp_timetable\classes\models\Events::get_instance()->get_all_events() );
		$categories = get_terms( 'mp-event_category', 'orderby=count&hide_empty=0' );
		$categories = $this->__create_list( $categories, 'term' );

		return array(
			'col' => array(
				'type'     => Controls_Manager::SELECT2,
				'label'    => __( 'Column', 'sparklestore-pro' ),
				'multiple' => true,
				'options'  => $columns,
			),
			'events' => array(
				'type'     => Controls_Manager::SELECT2,
				'label'    => __( 'Events', 'sparklestore-pro' ),
				'multiple' => true,
				'options'  => $events,
			),
			'event_categ'       => array(
				'type'     => Controls_Manager::SELECT2,
				'label'    => __( 'Event categories', 'sparklestore-pro' ),
				'multiple' => true,
				'options'  => $categories,
			),
			'increment' => array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Hour measure', 'sparklestore-pro' ),
				'default' => '1',
				'options' => array(
					'1'    => __( 'Hour (1h)', 'sparklestore-pro' ),
					'0.5'  => __( 'Half hour (30min)', 'sparklestore-pro' ),
					'0.25' => __( 'Quarter hour (15min)', 'sparklestore-pro' ),
				),
			),
			'view' => array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Filter style', 'sparklestore-pro' ),
				'default' => 'dropdown_list',
				'options' => array(
					'dropdown_list' => __( 'Dropdown list', 'sparklestore-pro' ),
					'tabs' => __( 'Tabs', 'sparklestore-pro' ),
				),
			),
			'label' => array(
				'type'    => Controls_Manager::TEXT,
				'label'   => __( 'Filter label', 'sparklestore-pro' ),
				'default' => __( 'All Events', 'sparklestore-pro' ),
			),
			'hide_label'        => array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( "Hide 'All Events' view", 'sparklestore-pro' ),
				'default' => '0',
				'options' => array(
					'0' => __( 'No', 'sparklestore-pro' ),
					'1' => __( 'Yes', 'sparklestore-pro' ),
				),
			),
			'hide_hrs' => array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Hide first (hours) column', 'sparklestore-pro' ),
				'default' => '0',
				'options' => array(
					'0' => __( 'No', 'sparklestore-pro' ),
					'1' => __( 'Yes', 'sparklestore-pro' ),
				),
			),
			'hide_empty_rows' => array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Hide empty rows', 'sparklestore-pro' ),
				'default' => '1',
				'options' => array(
					'1' => __( 'Yes', 'sparklestore-pro' ),
					'0' => __( 'No', 'sparklestore-pro' ),
				),
				'default' => 1,
			),
			'title' => array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Title', 'sparklestore-pro' ),
				'default' => 1,
				'options' => array(
					'1' => __( 'Yes', 'sparklestore-pro' ),
					'0' => __( 'No', 'sparklestore-pro' ),
				),
			),
			'time' => array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Time', 'sparklestore-pro' ),
				'default' => 1,
				'options' => array(
					'1' => __( 'Yes', 'sparklestore-pro' ),
					'0' => __( 'No', 'sparklestore-pro' ),
				),
			),
			'sub-title' => array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Subtitle', 'sparklestore-pro' ),
				'default' => 1,
				'options' => array(
					'1' => __( 'Yes', 'sparklestore-pro' ),
					'0' => __( 'No', 'sparklestore-pro' ),
				),
			),
			'description' => array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Description', 'sparklestore-pro' ),
				'default' => 0,
				'options' => array(
					'1' => __( 'Yes', 'sparklestore-pro' ),
					'0' => __( 'No', 'sparklestore-pro' ),
				),
			),
			'user' => array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'User', 'sparklestore-pro' ),
				'default' => 0,
				'options' => array(
					'1' => __( 'Yes', 'sparklestore-pro' ),
					'0' => __( 'No', 'sparklestore-pro' ),
				),
			),
			'disable_event_url' => array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Disable event URL', 'sparklestore-pro' ),
				'default' => '0',
				'options' => array(
					'0' => __( 'No', 'sparklestore-pro' ),
					'1' => __( 'Yes', 'sparklestore-pro' ),
				),
			),
			'text_align' => array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Text align', 'sparklestore-pro' ),
				'default' => 'center',
				'options' => array(
					'center' => __( 'center', 'sparklestore-pro' ),
					'left'   => __( 'left', 'sparklestore-pro' ),
					'right'  => __( 'right', 'sparklestore-pro' ),
				),
			),
			'css_id' => array(
				'type'  => Controls_Manager::TEXT,
				'label' => __( 'Id', 'sparklestore-pro' )
			),
			'row_height' => array(
				'type'    => Controls_Manager::TEXT,
				'label'   => __( 'Row height (in px)', 'sparklestore-pro' ),
				'default' => 45
			),
			'font_size' => array(
				'type'    => Controls_Manager::TEXT,
				'label'   => __( 'Base Font Size', 'sparklestore-pro' ),
				'default' => ''
			),
			'responsive' => array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __( 'Responsive', 'sparklestore-pro' ),
				'default' => '1',
				'options' => array(
					'1' => __( 'Yes', 'sparklestore-pro' ),
					'0' => __( 'No', 'sparklestore-pro' ),
				),
				'default' => 1,
			)
		);
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_settings',
			array(
				'label' => esc_html__( 'Settings', 'sparklestore-pro' ),
			)
		);

		foreach ( $this->__atts() as $control => $data ) {
			$this->add_control( $control, $data );
		}

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings();

		$this->__context = 'render';

		$this->__open_wrap();

		$attributes = '';

		foreach ( $this->__atts() as $attr => $data ) {

			$attr_val    = $settings[ $attr ];
			$attr_val    = ! is_array( $attr_val ) ? $attr_val : implode( ',', $attr_val );

			if ( 'css_id' === $attr ) {
				$attr = 'id';
			}

			$attributes .= sprintf( ' %1$s="%2$s"', $attr, $attr_val );
		}

		$shortcode = sprintf( '[%s %s]', $this->__tag(), $attributes );
		echo do_shortcode( $shortcode );

		$this->__close_wrap();

	}

}
