<?php
/**
 * Class: Jet_Elements_Headline
 * Name: Headline
 * Slug: jet-headline
 */

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Jet_Elements_Headline extends Jet_Elements_Base {

	public function get_name() {
		return 'jet-headline';
	}

	public function get_title() {
		return esc_html__( 'Headline', 'sparklestore-pro' );
	}

	public function get_icon() {
		return 'jetelements-icon-31';
	}

	public function get_categories() {
		return array( 'cherry' );
	}

	protected function _register_controls() {

		$css_scheme = apply_filters(
			'jet-elements/headline/css-scheme',
			array(
				'instance'    => '.jet-headline',
				'first_part'  => '.jet-headline__first',
				'second_part' => '.jet-headline__second',
				'divider'     => '.jet-headline__divider',
			)
		);

		$this->start_controls_section(
			'section_title',
			array(
				'label' => esc_html__( 'Title', 'sparklestore-pro' ),
			)
		);

		$this->add_control(
			'first_part',
			array(
				'label'       => esc_html__( 'Title first part', 'sparklestore-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title first part', 'sparklestore-pro' ),
				'default'     => esc_html__( 'Heading', 'sparklestore-pro' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'second_part',
			array(
				'label'       => esc_html__( 'Title second part', 'sparklestore-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter title second part', 'sparklestore-pro' ),
				'default'     => esc_html__( 'element', 'sparklestore-pro' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => esc_html__( 'Link', 'sparklestore-pro' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
				'default' => array(
					'url' => '',
				),
				'separator'   => 'before',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'header_size',
			array(
				'label'   => esc_html__( 'HTML Tag', 'sparklestore-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h1'   => esc_html__( 'H1', 'sparklestore-pro' ),
					'h2'   => esc_html__( 'H2', 'sparklestore-pro' ),
					'h3'   => esc_html__( 'H3', 'sparklestore-pro' ),
					'h4'   => esc_html__( 'H4', 'sparklestore-pro' ),
					'h5'   => esc_html__( 'H5', 'sparklestore-pro' ),
					'h6'   => esc_html__( 'H6', 'sparklestore-pro' ),
					'div'  => esc_html__( 'div', 'sparklestore-pro' ),
					'span' => esc_html__( 'span', 'sparklestore-pro' ),
					'p'    => esc_html__( 'p', 'sparklestore-pro' ),
				),
				'default' => 'h2',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_deco_elements',
			array(
				'label' => esc_html__( 'Decorative Elements', 'sparklestore-pro' ),
			)
		);

		$this->add_control(
			'before_deco_heading',
			array(
				'label' => esc_html__( 'Before Deco Element', 'sparklestore-pro' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'before_deco_type',
			array(
				'label'   => esc_html__( 'Before Deco Type', 'sparklestore-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => array(
					'none'  => esc_html__( 'None', 'sparklestore-pro' ),
					'icon'  => esc_html__( 'Icon', 'sparklestore-pro' ),
					'image' => esc_html__( 'Image', 'sparklestore-pro' ),
				),
			)
		);

		$this->add_control(
			'before_icon',
			array(
				'label'       => esc_html__( 'Before Icon', 'sparklestore-pro' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => true,
				'file'        => '',
				'default'     => 'fa fa-arrow-circle-right',
				'condition' => array(
					'before_deco_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'before_image',
			array(
				'label'   => esc_html__( 'Before Image', 'sparklestore-pro' ),
				'type'    => Controls_Manager::MEDIA,
				'condition' => array(
					'before_deco_type' => 'image',
				),
			)
		);

		$this->add_control(
			'after_deco_heading',
			array(
				'label'     => esc_html__( 'After Deco Element', 'sparklestore-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'after_deco_type',
			array(
				'label'   => esc_html__( 'After Deco Type', 'sparklestore-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'  => esc_html__( 'None', 'sparklestore-pro' ),
					'icon'  => esc_html__( 'Icon', 'sparklestore-pro' ),
					'image' => esc_html__( 'Image', 'sparklestore-pro' ),
				),
			)
		);

		$this->add_control(
			'after_icon',
			array(
				'label'       => esc_html__( 'After Icon', 'sparklestore-pro' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => true,
				'file'        => '',
				'default'     => 'fa fa-arrow-circle-left',
				'condition' => array(
					'after_deco_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'after_image',
			array(
				'label'   => esc_html__( 'After Image', 'sparklestore-pro' ),
				'type'    => Controls_Manager::MEDIA,
				'condition' => array(
					'after_deco_type' => 'image',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * General Style Section
		 */
		$this->start_controls_section(
			'section_general_style',
			array(
				'label'      => esc_html__( 'General', 'sparklestore-pro' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_control(
			'instance_direction',
			array(
				'label'   => esc_html__( 'Direction', 'sparklestore-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => array(
					'horizontal' => esc_html__( 'Horizontal', 'sparklestore-pro' ),
					'vertical'   => esc_html__( 'Vertical', 'sparklestore-pro' ),
				)
			)
		);

		$this->add_control(
			'use_space_between',
			array(
				'label'        => esc_html__( 'Space Between', 'sparklestore-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'sparklestore-pro' ),
				'label_off'    => esc_html__( 'No', 'sparklestore-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => array(
					'instance_direction' => 'horizontal',
				),
			)
		);

		$this->add_control(
			'instance_alignment_horizontal',
			array(
				'label'   => esc_html__( 'Alignment', 'sparklestore-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => array(
					'flex-start'    => array(
						'title' => esc_html__( 'Left', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Right', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} '. $css_scheme['instance'] => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} '. $css_scheme['instance'] . ' > .jet-headline__link' => 'justify-content: {{VALUE}};',
				),
				'condition' => array(
					'instance_direction' => 'horizontal',
				),
			)
		);

		$this->add_control(
			'instance_alignment_vertical',
			array(
				'label'   => esc_html__( 'Alignment', 'sparklestore-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => array(
					'flex-start'    => array(
						'title' => esc_html__( 'Left', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Right', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} '. $css_scheme['instance'] => 'align-items: {{VALUE}};',
					'{{WRAPPER}} '. $css_scheme['instance'] . ' > .jet-headline__link' => 'align-items: {{VALUE}};',
				),
				'condition' => array(
					'instance_direction' => 'vertical',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'instance_background',
				'selector' => '{{WRAPPER}} ' . $css_scheme['instance'],
			)
		);

		$this->add_responsive_control(
			'instance_padding',
			array(
				'label'      => esc_html__( 'Padding', 'sparklestore-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['instance'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'instance_margin',
			array(
				'label'      => __( 'Margin', 'sparklestore-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['instance'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'instance_border',
				'label'       => esc_html__( 'Border', 'sparklestore-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'  => '{{WRAPPER}} ' . $css_scheme['instance'],
			)
		);

		$this->add_responsive_control(
			'instance_border_radius',
			array(
				'label'      => __( 'Border Radius', 'sparklestore-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['instance'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * First Part Style Section
		 */
		$this->start_controls_section(
			'section_first_part_style',
			array(
				'label'      => esc_html__( 'First Part', 'sparklestore-pro' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_control(
			'first_color',
			array(
				'label'  => esc_html__( 'Text Color', 'sparklestore-pro' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['first_part']  . ' .jet-headline__label' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'first_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} ' . $css_scheme['first_part'] . ' .jet-headline__label',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'first_text_shadow',
				'selector' => '{{WRAPPER}} ' . $css_scheme['first_part'] . ' .jet-headline__label',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'first_background',
				'selector' => '{{WRAPPER}} ' . $css_scheme['first_part'],
			)
		);

		$this->add_control(
			'use_first_text_image',
			array(
				'label'        => esc_html__( 'Use Text Image', 'sparklestore-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'sparklestore-pro' ),
				'label_off'    => esc_html__( 'No', 'sparklestore-pro' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'first_text_image',
			array(
				'label'   => esc_html__( 'Text Image', 'sparklestore-pro' ),
				'type'    => Controls_Manager::MEDIA,
				'condition' => array(
					'use_first_text_image' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['first_part'] . ' .jet-headline__label' => 'background-image: url({{URL}})',
				),
			)
		);

		$this->add_control(
			'first_text_image_position',
			array(
				'label'   =>esc_html__( 'Background Position', 'sparklestore-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''              => esc_html__( 'Default', 'sparklestore-pro' ),
					'top left'      => esc_html__( 'Top Left', 'sparklestore-pro' ),
					'top center'    => esc_html__( 'Top Center', 'sparklestore-pro' ),
					'top right'     => esc_html__( 'Top Right', 'sparklestore-pro' ),
					'center left'   => esc_html__( 'Center Left', 'sparklestore-pro' ),
					'center center' => esc_html__( 'Center Center', 'sparklestore-pro' ),
					'center right'  => esc_html__( 'Center Right', 'sparklestore-pro' ),
					'bottom left'   => esc_html__( 'Bottom Left', 'sparklestore-pro' ),
					'bottom center' => esc_html__( 'Bottom Center', 'sparklestore-pro' ),
					'bottom right'  => esc_html__( 'Bottom Right', 'sparklestore-pro' ),
				),
				'condition' => array(
					'use_first_text_image' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['first_part'] . ' .jet-headline__label' => 'background-position: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'first_text_image_repeat',
			array(
				'label'   =>esc_html__( 'Background Repeat', 'sparklestore-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''          => esc_html__( 'Default', 'sparklestore-pro' ),
					'no-repeat' => esc_html__( 'No-repeat', 'sparklestore-pro' ),
					'repeat'    => esc_html__( 'Repeat', 'sparklestore-pro' ),
					'repeat-x'  => esc_html__( 'Repeat-x', 'sparklestore-pro' ),
					'repeat-y'  => esc_html__( 'Repeat-y', 'sparklestore-pro' ),
				),
				'condition' => array(
					'use_first_text_image' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['first_part'] . ' .jet-headline__label' => 'background-repeat: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'first_text_image_size',
			array(
				'label'   =>esc_html__( 'Background Size', 'sparklestore-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''        => esc_html__( 'Default', 'sparklestore-pro' ),
					'auto'    => esc_html__( 'Auto', 'sparklestore-pro' ),
					'cover'   => esc_html__( 'Cover', 'sparklestore-pro' ),
					'contain' => esc_html__( 'Contain', 'sparklestore-pro' ),
				),
				'condition' => array(
					'use_first_text_image' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['first_part'] . ' .jet-headline__label' => 'background-size: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'first_border',
				'label'       => esc_html__( 'Border', 'sparklestore-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} ' . $css_scheme['first_part'],
				'separator'   => 'before',
			)
		);

		$this->add_responsive_control(
			'first_border_radius',
			array(
				'label'      => __( 'Border Radius', 'sparklestore-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['first_part'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'first_padding',
			array(
				'label'      => __( 'Padding', 'sparklestore-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['first_part'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'first_margin',
			array(
				'label'      => __( 'Margin', 'sparklestore-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['first_part'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'first_vertical_alignment',
			array(
				'label'   => esc_html__( 'Alignment', 'sparklestore-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => array(
					'flex-start'    => array(
						'title' => esc_html__( 'Top', 'sparklestore-pro' ),
						'icon'  => 'fa fa-arrow-up',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Bottom', 'sparklestore-pro' ),
						'icon'  => 'fa fa-arrow-down',
					),
				),
				'condition' => array(
					'instance_direction' => 'horizontal',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['first_part'] => 'align-self: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'first_horizontal_alignment',
			array(
				'label'   => esc_html__( 'Alignment', 'sparklestore-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => array(
					'flex-start'    => array(
						'title' => esc_html__( 'Left', 'sparklestore-pro' ),
						'icon'  => 'fa fa-arrow-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Right', 'sparklestore-pro' ),
						'icon'  => 'fa fa-arrow-right',
					),
				),
				'condition' => array(
					'instance_direction' => 'vertical',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['first_part'] => 'align-self: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'first_text_alignment',
			array(
				'label'   => esc_html__( 'Text Alignment', 'sparklestore-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => array(
					'left'    => array(
						'title' => esc_html__( 'Left', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-center',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['first_part'] . ' .jet-headline__label' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Second Part Style Section
		 */
		$this->start_controls_section(
			'section_second_part_style',
			array(
				'label'      => esc_html__( 'Second Part', 'sparklestore-pro' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_control(
			'second_color',
			array(
				'label'  => esc_html__( 'Text Color', 'sparklestore-pro' ),
				'type'   => Controls_Manager::COLOR,
				'scheme' => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] . ' .jet-headline__label' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'second_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} ' . $css_scheme['second_part'] . ' .jet-headline__label',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'second_text_shadow',
				'selector' => '{{WRAPPER}} ' . $css_scheme['second_part'] . ' .jet-headline__label',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'second_background',
				'selector' => '{{WRAPPER}} ' . $css_scheme['second_part'],
			)
		);

		$this->add_control(
			'use_second_text_image',
			array(
				'label'        => esc_html__( 'Use Text Image', 'sparklestore-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'sparklestore-pro' ),
				'label_off'    => esc_html__( 'No', 'sparklestore-pro' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'second_text_image',
			array(
				'label'   => esc_html__( 'Text Image', 'sparklestore-pro' ),
				'type'    => Controls_Manager::MEDIA,
				'condition' => array(
					'use_second_text_image' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] . ' .jet-headline__label' => 'background-image: url({{URL}});',
				),
			)
		);

		$this->add_control(
			'second_text_image_position',
			array(
				'label'   =>esc_html__( 'Background Position', 'sparklestore-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''              => esc_html__( 'Default', 'sparklestore-pro' ),
					'top left'      => esc_html__( 'Top Left', 'sparklestore-pro' ),
					'top center'    => esc_html__( 'Top Center', 'sparklestore-pro' ),
					'top right'     => esc_html__( 'Top Right', 'sparklestore-pro' ),
					'center left'   => esc_html__( 'Center Left', 'sparklestore-pro' ),
					'center center' => esc_html__( 'Center Center', 'sparklestore-pro' ),
					'center right'  => esc_html__( 'Center Right', 'sparklestore-pro' ),
					'bottom left'   => esc_html__( 'Bottom Left', 'sparklestore-pro' ),
					'bottom center' => esc_html__( 'Bottom Center', 'sparklestore-pro' ),
					'bottom right'  => esc_html__( 'Bottom Right', 'sparklestore-pro' ),
				),
				'condition' => array(
					'use_second_text_image' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] . ' .jet-headline__label' => 'background-position: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'second_text_image_repeat',
			array(
				'label'   =>esc_html__( 'Background Repeat', 'sparklestore-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''          => esc_html__( 'Default', 'sparklestore-pro' ),
					'no-repeat' => esc_html__( 'No-repeat', 'sparklestore-pro' ),
					'repeat'    => esc_html__( 'Repeat', 'sparklestore-pro' ),
					'repeat-x'  => esc_html__( 'Repeat-x', 'sparklestore-pro' ),
					'repeat-y'  => esc_html__( 'Repeat-y', 'sparklestore-pro' ),
				),
				'condition' => array(
					'use_second_text_image' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] . ' .jet-headline__label' => 'background-repeat: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'second_text_image_size',
			array(
				'label'   =>esc_html__( 'Background Size', 'sparklestore-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''        => esc_html__( 'Default', 'sparklestore-pro' ),
					'auto'    => esc_html__( 'Auto', 'sparklestore-pro' ),
					'cover'   => esc_html__( 'Cover', 'sparklestore-pro' ),
					'contain' => esc_html__( 'Contain', 'sparklestore-pro' ),
				),
				'condition' => array(
					'use_second_text_image' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] . ' .jet-headline__label' => 'background-size: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'second_border',
				'label'       => esc_html__( 'Border', 'sparklestore-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} ' . $css_scheme['second_part'],
				'separator'   => 'before',
			)
		);

		$this->add_responsive_control(
			'second_border_radius',
			array(
				'label'      => __( 'Border Radius', 'sparklestore-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'second_padding',
			array(
				'label'      => __( 'Padding', 'sparklestore-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'second_margin',
			array(
				'label'      => __( 'Margin', 'sparklestore-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'second_vertical_alignment',
			array(
				'label'   => esc_html__( 'Alignment', 'sparklestore-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => array(
					'flex-start'    => array(
						'title' => esc_html__( 'Top', 'sparklestore-pro' ),
						'icon'  => 'fa fa-arrow-up',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Bottom', 'sparklestore-pro' ),
						'icon'  => 'fa fa-arrow-down',
					),
				),
				'condition' => array(
					'instance_direction' => 'horizontal',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] => 'align-self: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'second_horizontal_alignment',
			array(
				'label'   => esc_html__( 'Alignment', 'sparklestore-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => array(
					'flex-start'    => array(
						'title' => esc_html__( 'Left', 'sparklestore-pro' ),
						'icon'  => 'fa fa-arrow-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Right', 'sparklestore-pro' ),
						'icon'  => 'fa fa-arrow-right',
					),
				),
				'condition' => array(
					'instance_direction' => 'vertical',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] => 'align-self: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'second_text_alignment',
			array(
				'label'   => esc_html__( 'Text Alignment', 'sparklestore-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => array(
					'left'    => array(
						'title' => esc_html__( 'Left', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-center',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] . ' .jet-headline__label' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Decorative Style Section
		 */
		$this->start_controls_section(
			'section_deco_style',
			array(
				'label'      => esc_html__( 'Decorative Elements', 'sparklestore-pro' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_control(
			'before_deco',
			array(
				'label' => esc_html__( 'Before Deco Element', 'sparklestore-pro' ),
				'type'  => Controls_Manager::HEADING,
				'condition' => array(
					'before_deco_type!' => 'none',
				),
			)
		);

		$this->add_control(
			'before_icon_color',
			array(
				'label'     => esc_html__( 'Before Icon Color', 'sparklestore-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'before_deco_type' => 'icon',
				),
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['first_part'] . ' .jet-headline__deco-icon i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'before_icon_size',
			array(
				'label'      => esc_html__( 'Before Icon Size', 'sparklestore-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'px', 'em', 'rem',
				),
				'range'      => array(
					'px' => array(
						'min' => 18,
						'max' => 200,
					),
				),
				'condition' => array(
					'before_deco_type' => 'icon',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['first_part'] . ' .jet-headline__deco-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'before_image_width_size',
			array(
				'label'      => esc_html__( 'Before Image Width Size', 'sparklestore-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'px', 'em', '%',
				),
				'range'      => array(
					'px' => array(
						'min' => 18,
						'max' => 200,
					),
				),
				'condition' => array(
					'before_deco_type' => 'image',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['first_part'] . ' .jet-headline__deco-image' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'before_image_height_size',
			array(
				'label'      => esc_html__( 'Before Image Height Size', 'sparklestore-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'px', 'em', '%',
				),
				'range'      => array(
					'px' => array(
						'min' => 18,
						'max' => 200,
					),
				),
				'condition' => array(
					'before_deco_type' => 'image',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['first_part'] . ' .jet-headline__deco-image' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'before_deco_margin',
			array(
				'label'      => __( 'Margin', 'sparklestore-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['first_part'] . ' .jet-headline__deco' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array(
					'before_deco_type!' => 'none',
				),
			)
		);

		$this->add_responsive_control(
			'before_deco_alignment',
			array(
				'label'   => esc_html__( 'Alignment', 'sparklestore-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => array(
					'flex-start'    => array(
						'title' => esc_html__( 'Top', 'sparklestore-pro' ),
						'icon'  => 'fa fa-arrow-up',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Bottom', 'sparklestore-pro' ),
						'icon'  => 'fa fa-arrow-down',
					),
				),
				'condition' => array(
					'before_deco_type!' => 'none',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['first_part'] . ' .jet-headline__deco' => 'align-self: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'after_deco',
			array(
				'label'     => esc_html__( 'After Deco Element', 'sparklestore-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'after_deco_type!' => 'none',
				),
			)
		);

		$this->add_control(
			'after_icon_color',
			array(
				'label'     => esc_html__( 'After Icon Color', 'sparklestore-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'after_deco_type' => 'icon',
				),
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] . ' .jet-headline__deco-icon i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'after_icon_size',
			array(
				'label'      => esc_html__( 'After Icon Size', 'sparklestore-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'px', 'em', 'rem',
				),
				'range'      => array(
					'px' => array(
						'min' => 18,
						'max' => 200,
					),
				),
				'condition' => array(
					'after_deco_type' => 'icon',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] . ' .jet-headline__deco-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'after_image_width_size',
			array(
				'label'      => esc_html__( 'After Image Width Size', 'sparklestore-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'px', 'em', '%',
				),
				'range'      => array(
					'px' => array(
						'min' => 18,
						'max' => 200,
					),
				),
				'condition' => array(
					'after_deco_type' => 'image',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] . ' .jet-headline__deco-image' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'after_image_height_size',
			array(
				'label'      => esc_html__( 'After Image Height Size', 'sparklestore-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'px', 'em', '%',
				),
				'range'      => array(
					'px' => array(
						'min' => 18,
						'max' => 200,
					),
				),
				'condition' => array(
					'after_deco_type' => 'image',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] . ' .jet-headline__deco-image' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'after_deco_margin',
			array(
				'label'      => __( 'Margin', 'sparklestore-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] . ' .jet-headline__deco' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array(
					'after_deco_type!' => 'none',
				),
			)
		);

		$this->add_responsive_control(
			'after_deco_alignment',
			array(
				'label'   => esc_html__( 'Alignment', 'sparklestore-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => array(
					'flex-start'    => array(
						'title' => esc_html__( 'Top', 'sparklestore-pro' ),
						'icon'  => 'fa fa-arrow-up',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Bottom', 'sparklestore-pro' ),
						'icon'  => 'fa fa-arrow-down',
					),
				),
				'condition' => array(
					'after_deco_type!' => 'none',
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['second_part'] . ' .jet-headline__deco' => 'align-self: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'divider_deco',
			array(
				'label'     => esc_html__( 'Divider Deco Element', 'sparklestore-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'use_divider_deco',
			array(
				'label'        => esc_html__( 'Use Divider Mode', 'sparklestore-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'sparklestore-pro' ),
				'label_off'    => esc_html__( 'No', 'sparklestore-pro' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_control(
			'divider_deco_height',
			array(
				'label'   => esc_html__( 'Divider Size', 'sparklestore-pro' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 2,
				'min'     => 1,
				'max'     => 50,
				'step'    => 1,
				'condition' => array(
					'use_divider_deco' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} '. $css_scheme['divider'] => 'height: {{VALUE}}px;',
				),
			)
		);

		$this->add_control(
			'divider_deco_space',
			array(
				'label'   => esc_html__( 'Divider Space', 'sparklestore-pro' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 10,
				'min'     => 0,
				'max'     => 200,
				'step'    => 1,
				'condition' => array(
					'use_divider_deco'   => 'yes',
					'instance_direction' => 'horizontal',
				),
				'selectors' => array(
					'{{WRAPPER}} '. $css_scheme['divider'] . '.jet-headline__left-divider' => 'margin-right: {{VALUE}}px;',
					'{{WRAPPER}} '. $css_scheme['divider'] . '.jet-headline__right-divider' => 'margin-left: {{VALUE}}px;',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_deco_divider' );

		$this->start_controls_tab(
			'tab_deco_divider_left',
			array(
				'label' => esc_html__( 'Left', 'sparklestore-pro' ),
				'condition' => array(
					'use_divider_deco' => 'yes',
				),
			)
		);

		$this->add_control(
			'use_divider_deco_left',
			array(
				'label'        => esc_html__( 'Enable', 'sparklestore-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'sparklestore-pro' ),
				'label_off'    => esc_html__( 'No', 'sparklestore-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'use_divider_deco' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'divider_deco_left_background',
				'label'     => esc_html__( 'Background', 'sparklestore-pro' ),
				'selector'  => '{{WRAPPER}} ' . $css_scheme['divider'] . '.jet-headline__left-divider',
				'condition' => array(
					'use_divider_deco' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'divider_deco_left_border',
				'label'       => esc_html__( 'Border', 'sparklestore-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} ' . $css_scheme['divider'] . '.jet-headline__left-divider',
				'condition'   => array(
					'use_divider_deco' => 'yes',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_deco_divider_right',
			array(
				'label' => esc_html__( 'Right', 'sparklestore-pro' ),
				'condition' => array(
					'use_divider_deco' => 'yes',
				),
			)
		);

		$this->add_control(
			'use_divider_deco_right',
			array(
				'label'        => esc_html__( 'Enable', 'sparklestore-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'sparklestore-pro' ),
				'label_off'    => esc_html__( 'No', 'sparklestore-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'use_divider_deco' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'divider_deco_right_background',
				'label'     => esc_html__( 'Background', 'sparklestore-pro' ),
				'selector'  => '{{WRAPPER}} ' . $css_scheme['divider'] . '.jet-headline__right-divider',
				'condition' => array(
					'use_divider_deco' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'divider_deco_right_border',
				'label'       => esc_html__( 'Border', 'sparklestore-pro' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} ' . $css_scheme['divider'] . '.jet-headline__right-divider',
				'condition'   => array(
					'use_divider_deco' => 'yes',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	/**
	 * [render description]
	 * @return [type] [description]
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		if ( empty( $settings['first_part'] ) && empty( $settings['second_part'] ) ) {
			return;
		}

		$first_part = '';
		$second_part = '';
		$before_deco_html = '';
		$after_deco_html = '';
		$space = '';

		$heading_classes_array = array( 'jet-headline' );
		$heading_classes_array[] = 'jet-headline--direction-' . $settings['instance_direction'];

		$heading_classes = implode( ' ', $heading_classes_array );

		if ( filter_var( $settings['use_space_between'], FILTER_VALIDATE_BOOLEAN ) && 'horizontal' === $settings['instance_direction'] ) {
			$space = '<span class="jet-headline__space">&nbsp;</span>';
		}

		// Before Deco Render
		if ( 'none' !== $settings['before_deco_type'] ) {

			if ( 'icon' === $settings['before_deco_type'] && ! empty( $settings['before_icon'] ) ) {
				$before_deco_icon = sprintf( '<i class="%s"></i>', $settings['before_icon'] );
				$before_deco_html = sprintf( '<span class="jet-headline__deco jet-headline__deco-icon">%1$s</span>', $before_deco_icon );
			}

			if ( 'image' === $settings['before_deco_type'] && ! empty( $settings['before_image']['url'] ) ) {
				$before_deco_image = sprintf( '<img src="%s" alt="">', $settings['before_image']['url'] );
				$before_deco_html = sprintf( '<span class="jet-headline__deco jet-headline__deco-image">%1$s</span>', $before_deco_image );
			}
		}

		// After Deco Render
		if ( 'none' !== $settings['after_deco_type'] ) {

			if ( 'icon' === $settings['after_deco_type'] && ! empty( $settings['after_icon'] ) ) {
				$after_deco_icon = sprintf( '<i class="%s"></i>', $settings['after_icon'] );
				$after_deco_html = sprintf( '<span class="jet-headline__deco jet-headline__deco-icon">%1$s</span>', $after_deco_icon );
			}

			if ( 'image' === $settings['after_deco_type'] && ! empty( $settings['after_image']['url'] ) ) {
				$after_deco_image = sprintf( '<img src="%s" alt="">', $settings['after_image']['url'] );
				$after_deco_html = sprintf( '<span class="jet-headline__deco jet-headline__deco-image">%1$s</span>', $after_deco_image );
			}
		}

		if ( ! empty( $settings['first_part'] ) ) {

			$first_classes_array = array( 'jet-headline__part', 'jet-headline__first' );

			if ( filter_var( $settings['use_first_text_image'], FILTER_VALIDATE_BOOLEAN ) ) {
				$first_classes_array[] = 'headline__part--image-text';
			}

			$first_classes = implode( ' ', $first_classes_array );

			$first_part = sprintf( '<span class="%1$s">%2$s<span class="jet-headline__label">%3$s</span></span>%4$s', $first_classes, $before_deco_html, $settings['first_part'], $space );
		}

		if ( ! empty( $settings['second_part'] ) ) {
			$second_classes_array = array( 'jet-headline__part', 'jet-headline__second' );

			if ( filter_var( $settings['use_second_text_image'], FILTER_VALIDATE_BOOLEAN ) ) {
				$second_classes_array[] = 'headline__part--image-text';
			}

			$second_classes = implode( ' ', $second_classes_array );

			$second_part = sprintf( '<span class="%1$s"><span class="jet-headline__label">%2$s</span>%3$s</span>', $second_classes, $settings['second_part'], $after_deco_html );
		}

		$deco_devider_left = '';
		$deco_devider_right = '';

		if ( filter_var( $settings['use_divider_deco'], FILTER_VALIDATE_BOOLEAN ) ) {

			if ( filter_var( $settings['use_divider_deco_left'], FILTER_VALIDATE_BOOLEAN ) ) {
				$deco_devider_left ='<span class="jet-headline__divider jet-headline__left-divider"></span>';
			}

			if ( filter_var( $settings['use_divider_deco_right'], FILTER_VALIDATE_BOOLEAN ) ) {
				$deco_devider_right ='<span class="jet-headline__divider jet-headline__right-divider"></span>';
			}
		}

		$title = sprintf( '%1$s%2$s%3$s%4$s', $deco_devider_left, $first_part, $second_part, $deco_devider_right );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'url', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'url', 'target', '_blank' );
			}

			if ( ! empty( $settings['link']['nofollow'] ) ) {
				$this->add_render_attribute( 'url', 'rel', 'nofollow' );
			}

			$title = sprintf( '<a class="jet-headline__link" %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
		}

		$title_html = sprintf( '<%1$s class="%2$s">%3$s</%1$s>', $settings['header_size'], $heading_classes, $title );

		echo $title_html;
	}

}
