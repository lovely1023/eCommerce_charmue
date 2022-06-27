<?php

namespace Elementor;

use \Elementor\ElementsKit_Widget_Trustpilot_Handler as Handler;
use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if (!defined('ABSPATH')) exit;

class ElementsKit_Widget_Trustpilot extends Widget_Base
{

    public function get_name()
    {
        return Handler::get_name();
    }

	public function get_script_depends() {
		return ['jquery-slick'];
	}

    public function get_title()
    {
        return Handler::get_title();
    }

    public function get_icon()
    {
        return Handler::get_icon();
    }

    public function get_categories()
    {
        return Handler::get_categories();
    }

    public function get_help_url() {
        return '';
    }

    private function get_rating_type( $rating ){
        return ($rating <= 1 ? 'bad' : ($rating <=3 ? 'average' : 'good'));
    }
    private function get_formatted_text($txt, $additional_flag, $max_len = 120) {
		$len = strlen($txt);
		if($additional_flag === true && $len > $max_len) {
            return
                '<span>'.substr($txt, 0, $max_len).'</span>'.
                '<span
                    class="more"
                    data-collapsed="true"
                    data-text="'.$txt.'"
                > ...More
                </span>'
            ;
		}
		return $txt;
    }

    protected function format_column( $settings, $control_name ){
		$column = $settings[$control_name];
		if(isset($settings[$control_name.'_tablet'])){
			$splitted = explode('ekit-fb-col-',$settings[$control_name.'_tablet']);
			$column .= ' ekit-fb-col-tablet-' . $splitted[1];
		}
		if(isset($settings[$control_name.'_mobile'])){
			$splitted = explode('ekit-fb-col-',$settings[$control_name.'_mobile']);
			$column .= ' ekit-fb-col-mobile-' . $splitted[1];
		}
		return $column;
	}

    protected function get_slideshow_column( $settings, $slides_to_show, $slides_to_scroll ){
		$responsive = [];
		$slides_to_show_tablet 		= $settings[$slides_to_show."_tablet"];
		$slides_to_show_mobile 		= $settings[$slides_to_show."_mobile"];

		$slides_to_scroll_tablet 	= $settings[$slides_to_scroll."_tablet"];
		$slides_to_scroll_mobile 	= $settings[$slides_to_scroll."_mobile"];

		if ( $slides_to_show_tablet || $slides_to_scroll_tablet ) {
			$settings_tablet = [];
			if ($slides_to_show_tablet) 		$settings_tablet['slidesToShow'] 		= $slides_to_show_tablet;
			if ($slides_to_scroll_tablet) 		$settings_tablet['slidesToScroll'] 		= $slides_to_scroll_tablet;
			array_push($responsive, [
				'breakpoint'	=> 1024,
				'settings'		=> $settings_tablet,
			]);
		}
		if ( $slides_to_show_mobile || $slides_to_scroll_mobile ) {
			$settings_mobile = [];
			if ($slides_to_show_mobile) 		$settings_mobile['slidesToShow'] 		= $slides_to_show_mobile;
			if ($slides_to_scroll_mobile) 		$settings_mobile['slidesToScroll'] 		= $slides_to_scroll_mobile;
			array_push($responsive, [
				'breakpoint'	=> 480,
				'settings'		=> $settings_mobile,
			]);
		}
		return $responsive;
	}

    protected function _register_controls() {

        // ==============================
        // Start Layout Section
        // ==============================

        // Section heading
        $this->start_controls_section(
           'ekit_review_layout', [
              'label' => esc_html__( 'Layout', 'elementskit' ),
           ]
        );

        // ekit_review_layout_type
        $this->add_control(
           'ekit_review_layout_type',[
                'label' =>esc_html__( 'Layout Type', 'elementskit' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'masonry',
                'options' => [
                    'grid' => esc_html__( 'Grid', 'elementskit' ),
                    'slideshow' => esc_html__( 'Slideshow', 'elementskit' ),
                    'masonry' => esc_html__( 'Masonry', 'elementskit' ),
                    'list' => esc_html__( 'List', 'elementskit' ),
                ],
           ]
        );

        // ekit_review_card_style
        $this->add_control(
           'ekit_review_card_style', [
              'label' => esc_html__('Choose Style', 'elementskit'),
              'type' => ElementsKit_Controls_Manager::IMAGECHOOSE,
              'default' => 'default',
              'options' => [
                 'default' => [
                    'title' => esc_html__( 'Default', 'elementskit' ),
                    'imagelarge' => Handler::get_url() . 'assets/images/default.png',
                    'imagesmall' => Handler::get_url() . 'assets/images/default.png',
                    'width' => '25%'
                 ],
                 'style-2' => [
                    'title' => esc_html__( 'Style 2', 'elementskit' ),
                    'imagelarge' => Handler::get_url() . 'assets/images/style-2.png',
                    'imagesmall' => Handler::get_url() . 'assets/images/style-2.png',
                    'width' => '25%'
                 ],
                 'style-3' => [
                    'title' => esc_html__( 'Style 3', 'elementskit' ),
                    'imagelarge' => Handler::get_url() . 'assets/images/style-3.png',
                    'imagesmall' => Handler::get_url() . 'assets/images/style-3.png',
                    'width' => '25%'
                 ],
                 'style-4' => [
                    'title' => esc_html__( 'Style 4', 'elementskit' ),
                    'imagelarge' => Handler::get_url() . 'assets/images/style-4.png',
                    'imagesmall' => Handler::get_url() . 'assets/images/style-4.png',
                    'width' => '25%'
                 ],
              ],
           ]
        );

        // ekit_review_show_overview
        // $this->add_control(
        //    'ekit_review_show_overview', [
        //         'label' => esc_html__( 'Show Overview', 'elementskit' ),
        //         'type' => Controls_Manager::SWITCHER,
        //         'default' => 'yes'
        //    ]
        // );

        $this->add_responsive_control(
			'ekit_review_responsive_column',
			[
				'label'     => esc_html__('Column Count', 'elementskit'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'ekit-fb-col-4',
				'tablet_default'   => 'ekit-fb-col-6',
				'mobile_default'   => 'ekit-fb-col-12',
				'options'   => [
					'ekit-fb-col-12' => esc_html__('1 Columns', 'elementskit'),
					'ekit-fb-col-6' => esc_html__('2 Columns', 'elementskit'),
					'ekit-fb-col-4' => esc_html__('3 Columns', 'elementskit'),
					'ekit-fb-col-3' => esc_html__('4 Columns', 'elementskit'),
					'ekit-fb-col-2' => esc_html__('6 Columns', 'elementskit'),
				],
				'condition' => [
					'ekit_review_layout_type' => ['grid', 'masonry'],
				],
			]
		);

        // Grid column gap
		$this->add_responsive_control( 'ekit_review_grid_column_gap', [
            'label'           => esc_html__('Gutter Size', 'elementskit'),
            'type'            => Controls_Manager::SLIDER,
            'size_units'      => ['px','em'],
            'range'           => [
                'px' => [ 'min'  => 0, 'max'  => 96, 'step' => 2 ],
                'em' => [ 'min'  => 0, 'max'  => 6, 'step' => 0.2 ]
            ],
            'devices'         => ['desktop', 'tablet', 'mobile'],
            'tablet_default'  => [ 'size' => 8, 'unit' => 'px' ],
            'mobile_default'  => [ 'size' => 1, 'unit' => 'em' ],
            'default'         => [ 'size' => 24, 'unit' => 'px' ],
            'selectors'       => [
                '{{WRAPPER}} .ekit-review-cards-trustpilot.ekit-review-cards-grid .row' =>  
                    'margin-right: calc(-{{SIZE}}{{UNIT}} / 2);margin-left: calc(-{{SIZE}}{{UNIT}} / 2);',
                '{{WRAPPER}} .ekit-review-cards-trustpilot.ekit-review-cards-grid .row > div' =>  
                    'padding-right: calc({{SIZE}}{{UNIT}} / 2);padding-left: calc({{SIZE}}{{UNIT}} / 2);padding-bottom: {{SIZE}}{{UNIT}};',
            ],
            'condition'       => [
                'ekit_review_layout_type' => 'grid'
            ],
        ]);

        // Masonry Column gap
        $this->add_responsive_control(
            'ekit_review_masonry_column_gap', [
                'label'           => esc_html__('Gutter Size', 'elementskit'),
                'type'            => Controls_Manager::SLIDER,
                'size_units'      => ['px','em'],
                'range'           => [
                    'px' => [ 'min'  => 0, 'max'  => 96, 'step' => 2 ],
                    'em' => [ 'min'  => 0, 'max'  => 6, 'step' => 0.2 ]
                ],
                'devices'         => ['desktop', 'tablet', 'mobile'],
                'tablet_default'  => [ 'size' => 8, 'unit' => 'px' ],
                'mobile_default'  => [ 'size' => 1, 'unit' => 'em' ],
                'default'         => [ 'size' => 24, 'unit' => 'px' ],
                'selectors'       => [
                    '{{WRAPPER}} .ekit-review-cards-trustpilot.ekit-review-cards-masonry .masonry' => 'column-gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ekit-review-cards-trustpilot.ekit-review-cards-masonry .masonry > div' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition'       => [
                    'ekit_review_layout_type' => 'masonry'
                ],
            ]
        );

        $this->end_controls_section();

        // ==============================
        // End Layout Section
        // ==============================


        // ==============================
        // Start Slideshow Section
        // ==============================

        // Section label
        $this->start_controls_section(
           'ekit_review_slideshow_settings', [
              'label' => esc_html__( 'Slide Show', 'elementskit' ),
              'condition' => [
                 'ekit_review_layout_type' => 'slideshow'
              ]
           ]
        );

        // Left right spacing
        $this->add_responsive_control(
            'ekit_review_slideshow_left_right_spacing', [
                'label' => esc_html__( 'Spacing Left Right', 'elementskit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ekit-review-slider-wrapper-trustpilot .slick-slide' => 'margin-right: {{SIZE}}{{UNIT}};margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Slides to show
        $this->add_responsive_control(
            'ekit_review_slideshow_slides_to_show', [
                'label' => esc_html__( 'Slides To Show', 'elementskit' ),
                'type' =>  Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 3,
            ]
        );

        // Slides to scroll
        $this->add_responsive_control(
            'ekit_review_slideshow_slides_to_scroll', [
                'label' => esc_html__( 'Slides To Scroll', 'elementskit' ),
                'type' =>  Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'default' => 1,
            ]
        );

        // Slideshow speed
        $this->add_control(
            'ekit_review_slideshow_speed', [
                'label' => esc_html__( 'Speed', 'elementskit' ),
                'type' =>  Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10000,
                'step' => 1,
                'default' => 1000,
            ]
        );

        // Slideshow autoplay
        $this->add_control(
            'ekit_review_slideshow_autoplay', [
                'label' => esc_html__( 'Autoplay', 'elementskit' ),
                'type' =>  Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'elementskit' ),
                'label_off' => esc_html__( 'No', 'elementskit' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // Show arrows
        $this->add_control(
              'ekit_review_slideshow_show_arrow', [
                  'label' => esc_html__( 'Show arrow', 'elementskit' ),
                  'type' =>   Controls_Manager::SWITCHER,
                  'label_on' => esc_html__( 'Yes', 'elementskit' ),
                  'label_off' => esc_html__( 'No', 'elementskit' ),
                  'return_value' => 'yes',
                  'default' => '',
              ]
        );

        //Show dot
        $this->add_control(
            'ekit_review_slideshow_show_dot', [
                'label' => esc_html__( 'Show dots', 'elementskit' ),
                'type' =>   Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'elementskit' ),
                'label_off' => esc_html__( 'No', 'elementskit' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        // Pause on hover
        $this->add_control(
           'ekit_review_slideshow_pause_on_hover', [
              'label' => esc_html__( 'Pause on Hover', 'elementskit' ),
              'type' => Controls_Manager::SWITCHER,
              'label_on' => esc_html__( 'Yes', 'elementskit' ),
              'label_off' => esc_html__( 'No', 'elementskit' ),
              'return_value' => 'yes',
              'default' => 'yes',
           ]
        );

		$this->add_control(
			'slideshow_left_arrows',
			[
				'label' => esc_html__( 'Left Arrow', 'elementskit' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'slideshow_left_arrow',
                'default' => [
                    'value' => 'icon icon-left-arrow2',
                    'library' => 'ekiticons',
                ],
                'condition' => [
                        'ekit_review_slideshow_show_arrow' => 'yes',
                ]
			]
        );

        $this->add_control(
			'slideshow_right_arrows',
			[
				'label' => esc_html__( 'Right Arrow', 'elementskit' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'slideshow_right_arrow',
                'default' => [
                    'value' => 'icon icon-right-arrow2',
                    'library' => 'ekiticons',
                ],
                'condition' => [
                    'ekit_review_slideshow_show_arrow' => 'yes',
                ]
			]
		);

        $this->end_controls_section();
        // ==============================
        // End Slideshow Section
        // ==============================


        // ==============================
		// Start widget basic styles
		// ==============================

		$this->start_controls_section(
			'ekit_review_widget_style',
			[
				'label' => esc_html__('Widget', 'elementskit'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// ekit_review_widget_background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'ekit_review_widget_background',
				'label'    => esc_html__('Widget Background', 'elementskit'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .ekit-review-wrapper-trustpilot',
			]
		);

        // widget padding
		$this->add_responsive_control(
			'ekit_review_widget_padding', [
				'label'      => esc_html__('Padding', 'elementskit'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default'    => [
					'top'      => '2', 'right'    => '2',
					'bottom'   => '2', 'left'     => '2',
					'unit'     => 'em', 'isLinked' => true,
                ],
                'tablet_default'  => [
                    'top' => '1.5', 'right' => '1.5',
                    'bottom' => '1.5', 'left' => '1.5',
                    'unit' => 'em', 'isLinked' => true,
                ],
                'mobile_default'  => [
                    'top' => '1', 'right' => '1',
                    'bottom' => '1', 'left' => '1',
                    'unit' => 'em', 'isLinked' => true,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ekit-review-wrapper-trustpilot' =>
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


        // ==============================
		// Start review card styles
		// ==============================
        $this->start_controls_section(
           'ekit_review_card_style_section', [
                'label' => esc_html__( 'Review Card', 'elementskit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
           ]
        );

        // Card name color
        $this->add_control(
            'ekit_review_card_name_color', [
                'label' => __( 'Name Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ekit-review-wrapper-trustpilot .ekit-review-card--name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'ekit_review_card_style!' => 'default'
                ]
            ]
        );

        // Card name typpgraphy
        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'ekit_review_card_name_typography',
                'label' => __( 'Name Typography', 'elementskit' ),
                'selector' => '{{WRAPPER}} .ekit-review-wrapper-trustpilot .ekit-review-card--name',
                'condition' => [
                    'ekit_review_card_style!' => 'default'
                ]
            ]
        );

        // ekit_review_card_background
        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'      => 'ekit_review_card_background',
                'label'     => esc_html__( 'Card Background', 'elementskit' ),
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .ekit-review-card-trustpilot'
            ]
        );

        // Card dimensions
        $this->add_control(
            'ekit_review_card_heading_dimensions', [
               'label' => esc_html__( 'Dimensions', 'elementskit' ),
               'type' => Controls_Manager::HEADING,
               'separator' => 'before'
            ]
        );

        // ekit_review_card_padding
        $this->add_responsive_control(
            'ekit_review_card_padding',
            [
                'label'      => esc_html__( 'Padding', 'elementskit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ekit-review-card-trustpilot' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ekit-review-overview-trustpilot' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'  => [
                    'top' => '2', 'right' => '2',
                    'bottom' => '2', 'left' => '2',
                    'unit' => 'em', 'isLinked' => true,
                ],
            ]
        );

        // ekit_review_card_margin
        $this->add_responsive_control(
           'ekit_review_card_margin', [
                'label' => esc_html__( 'Margin', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'       => [
                    '{{WRAPPER}} .ekit-review-card-trustpilot' =>
                        'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
           ]
        );
        // ==============================
        // End Review card basic styles
        // ==============================


        // ==========================
        // Start Review card border
        // ==========================
        $this->add_control(
           'ekit_review_card_heading_border', [
              'label' => esc_html__( 'Border', 'elementskit' ),
              'type' => Controls_Manager::HEADING,
              'separator' => 'before'
           ]
        );

        // Review card border
        $this->add_group_control(
            Group_Control_Border::get_type(), [
                'name'     => 'ekit_review_card_border_type',
                'label'    => esc_html__( 'Border Type', 'elementskit' ),
                'selector' => '{{WRAPPER}} .ekit-review-card-trustpilot, {{WRAPPER}} .ekit-review-wrapper-trustpilot .review-header-card',
            ]
        );
        // Review card border radius
        $this->add_control(
            'ekit_review_card_border_radius', [
                'label' => esc_html__( 'Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ekit-review-card-trustpilot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ekit-review-wrapper-trustpilot .review-header-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // ==========================
        // End Review card border
        // ==========================


        // ==========================
        // Start Comment section
        // ==========================
        $this->add_control(
           'ekit_review_card_comment', [
              'label' => esc_html__( 'Comment', 'elementskit' ),
              'type' => Controls_Manager::HEADING,
              'separator' => 'before'
           ]
        );

        $this->add_control(
            'ekit_review_card_comment_color', [
                'label' => __( 'Text Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ekit-review-card-trustpilot .ekit-review-card--comment' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'ekit_review_card_comment_typography',
                'label' => __( 'Typography', 'elementskit' ),
                'selector' => '{{WRAPPER}} .ekit-review-card-trustpilot .ekit-review-card--comment',
            ]
        );

        // ekit_review_card_comment_padding
        $this->add_responsive_control(
            'ekit_review_card_comment_padding', [
                'label'      => esc_html__( 'Padding', 'elementskit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ekit-review-card-trustpilot .ekit-review-card--comment' =>
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'  => [
                    'top' => 1,  'right' => 1,
                    'bottom' => 1,  'left' => 0,
                    'unit' => 'em', 'isLinked' => false,
                ],
            ]
        );

        // ekit_review_card_comment_margin
        $this->add_responsive_control(
            'ekit_review_card_comment_margin', [
                'label'      => esc_html__( 'Margin', 'elementskit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'  => [
                    'top' => '0', 'right' => '0',
                    'bottom' => '0', 'left' => '0',
                    'unit' => 'em', 'isLinked' => false,
                ],
                'tablet_default'  => [
                    'top' => '0', 'right' => '0',
                    'bottom' => '0', 'left' => '0',
                    'unit' => 'em', 'isLinked' => false,
                ],
                'mobile_default'  => [
                    'top' => '0', 'right' => '0',
                    'bottom' => '0', 'left' => '0',
                    'unit' => 'em', 'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .ekit-review-card-trustpilot .ekit-review-card--comment' =>
                        'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();
        // End Review card border

        // Start dots style section
		$this->start_controls_section(
			'dots_style_section',
			[
				'label' => esc_html__( 'Dots', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ekit_review_slideshow_show_dot' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'dots_top_spacing',
			[
				'label' => esc_html__( 'Dots Top Spacing', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => -50,
				],
				'selectors' => [
                    '{{WRAPPER}} .ekit-review-slider-wrapper-trustpilot .slick-dots' => 
                        'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dot_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 8,
				],
				'selectors' => [
                    '{{WRAPPER}} .ekit-review-slider-wrapper-trustpilot .slick-dots li button' => 
                        'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ekit-review-slider-wrapper-trustpilot .slick-dots li' => 
                        'width: auto;'
				],
			]
		);

		$this->add_responsive_control(
			'dot_height',
			[
				'label' => esc_html__( 'Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 8,
				],
				'selectors' => [
                    '{{WRAPPER}} .ekit-review-slider-wrapper-trustpilot .slick-dots li button' => 
                        'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dot_border_radius',
			[
				'label' => esc_html__( 'Border radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
                    '{{WRAPPER}} .ekit-review-slider-wrapper-trustpilot .slick-dots li button' => 
                        'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dots_spacing',
			[
				'label' => esc_html__( 'Space between dots', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 12,
				],
				'selectors' => [
                    '{{WRAPPER}} .ekit-review-slider-wrapper-trustpilot .slick-dots li:not(:last-child)' => 
                        'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'dots_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ekit-review-slider-wrapper-trustpilot .slick-dots li button',
			]
		);

		$this->add_control(
			'dot_active_heading',
			[
				'label' => esc_html__( 'Active', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'dot_active_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ekit-review-slider-wrapper-trustpilot .slick-dots li.slick-active button',
			]
		);

		$this->add_responsive_control(
			'dot_active_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 8,
				],
				'selectors' => [
                    '{{WRAPPER}} .ekit-review-slider-wrapper-trustpilot .slick-dots li.slick-active button' => 
                        'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dot_active_height',
			[
				'label' => esc_html__( 'Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 8,
				],
				'selectors' => [
                    '{{WRAPPER}} .ekit-review-slider-wrapper-trustpilot .slick-dots li.slick-active button' => 
                        'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
        // End dots style section


        // // ==============================
		// // Start review cards load more
		// // ==============================
        // $this->start_controls_section(
        //     'ekit_review_cards_load_more', [
        //         'label' => esc_html__( 'Load More', 'elementskit' ),
        //         'tab'   => Controls_Manager::TAB_STYLE,
        //     ]
        // );

        // // ekit_review_cards_load_more_padding
        // $this->add_responsive_control(
        //     'ekit_review_cards_load_more_padding', [
        //         'label'      => esc_html__( 'Padding', 'elementskit' ),
        //         'type'       => Controls_Manager::DIMENSIONS,
        //         'size_units' => [ 'px', '%', 'em' ],
        //         'selectors'  => [
        //             '{{WRAPPER}} .ekit-review-cards-trustpilot .ekit-review-cards-trustpilot--load-more' =>
        //                 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        //         ],
        //         'default'  => [
        //             'top' => '2',  'right' => '0',
        //             'bottom' => '0',  'left' => '0',
        //             'unit' => 'em', 'isLinked' => false,
        //         ],
        //     ]
        // );

        // $this->add_control(
        //     'ekit_review_cards_load_more_btn_heading', [
        //        'label' => esc_html__( 'Button', 'elementskit' ),
        //        'type' => Controls_Manager::HEADING,
        //        'separator' => 'before'
        //     ]
        // );

        // $this->start_controls_tabs( 'ekit_review_cards_load_more_btn_tabs');

        // // Start Normal Tab
        // $this->start_controls_tab(
        //     'ekit_review_cards_load_more_btn_tab_normal', [
        //         'label' => esc_html__( 'Normal', 'elementskit' ),
        //     ]
        // );

        // // ekit_review_cards_load_more_btn_txt_color_normal
        // $this->add_control(
        //     'ekit_review_cards_load_more_btn_txt_color_normal', [
        //         'label' => esc_html__( 'Text Color', 'elementskit' ),
        //         'type' => Controls_Manager::COLOR,
        //         'default' => '',
        //         'selectors' => [
        //             '{{WRAPPER}} .ekit-review-cards-trustpilot--load-more .btn' => 'color: {{VALUE}};',
        //         ],
        //     ]
        // );

        // // ekit_review_cards_load_more_btn_bg_color_normal
        // $this->add_group_control(
        //     Group_Control_Background::get_type(), [
        //         'name'      => 'ekit_review_cards_load_more_btn_bg_color_normal',
        //         'label'     => esc_html__( 'Background', 'elementskit' ),
        //         'types'     => [ 'classic', 'gradient' ],
        //         'selector'  => '{{WRAPPER}} .ekit-review-cards-trustpilot--load-more .btn'
        //     ]
        // );

        // $this->end_controls_tab();
        // // End Normal Tab

        // // Start Hover Tab
        // $this->start_controls_tab(
        //     'ekit_review_cards_load_more_btn_tab_hover', [
        //         'label' => esc_html__( 'Hover', 'elementskit' ),
        //     ]
        // );

        // // ekit_review_cards_load_more_btn_txt_color_hover
        // $this->add_control(
        //     'ekit_review_cards_load_more_btn_txt_color_hover', [
        //         'label' => esc_html__( 'Text Color', 'elementskit' ),
        //         'type' => Controls_Manager::COLOR,
        //         'default' => '',
        //         'selectors' => [
        //             '{{WRAPPER}} .ekit-review-cards-trustpilot--load-more .btn:hover' => 'color: {{VALUE}};',
        //         ],
        //     ]
        // );

        // // ekit_review_cards_load_more_btn_bg_color_hover
        // $this->add_group_control(
        //     Group_Control_Background::get_type(), [
        //         'name'      => 'ekit_review_cards_load_more_btn_bg_color_hover',
        //         'label'     => esc_html__( 'Background', 'elementskit' ),
        //         'types'     => [ 'classic', 'gradient' ],
        //         'selector'  => '{{WRAPPER}} .ekit-review-cards-trustpilot--load-more .btn:hover'
        //     ]
        // );

        // $this->end_controls_tab();
        // // End Normal Tab

        // $this->end_controls_tabs();


        // $this->end_controls_section();
        // // End review cards load more

    }

    protected function render( ) {
        echo '<div class="ekit-wid-con" >';
            $this->render_raw();
        echo '</div>';
	}

    public function render_raw() {

        $settings  = $this->get_settings_for_display();
        extract($settings);

		$show_overview  =    isset($ekit_review_overview_card)           && $ekit_review_overview_card           == 'yes';
        $badge          =    isset($ekit_review_card_thumbnail_badge)    && $ekit_review_card_thumbnail_badge    == 'yes';
        $border         =    isset($ekit_review_card_border_type_border) && $ekit_review_card_border_type_border;
        $format_comment =    $ekit_review_layout_type == 'grid' || $ekit_review_layout_type == 'slideshow';
        
        //$review_rating = 4;
        //$rating_type = ($review_rating == 1 ? 'bad' : ($review_rating <=4 ? 'average' : 'good'));
        
        // Start card classes
        $card_classes = 'ekit-review-card ekit-review-card-trustpilot';
        $card_classes .= " $ekit_review_card_style";
        // End card classes
        
        $BASE_URL =  Handler::get_url();
        $data = Handler::get_data();
        
        
        if( !empty($data) && $data->success):
            $overview = null;
            $column_count       = $this->format_column($settings, 'ekit_review_responsive_column');

            // Filtering data where review text is not empty
            $reviews = array_filter(
                $data->result,
                function($review) { 
                    return !empty($review->text);
                }
            );
        ?>

        <!-- Start Markup  -->
        <div class="ekit-review-wrapper ekit-review-wrapper-trustpilot">

            <!-- Start overview -->
            <?php if( !empty($data->overview) && $show_overview):
                require Handler::get_dir() . 'components/overview-card.php';
            endif ?>
            <!-- Start overview -->

            <div class="ekit-review-cards ekit-review-cards-trustpilot <?php echo "ekit-review-cards-" . $ekit_review_layout_type ?>">
                <?php if( $ekit_review_layout_type == 'slideshow'){

                    $arrowLeftIcon = isset($slideshow_left_arrows) ? $slideshow_left_arrows['value'] : '';
                    $arrowRightIcon = isset($slideshow_right_arrows) ? $slideshow_right_arrows['value'] : '';

                    $data_attrs   =     "data-slidestoshow='$ekit_review_slideshow_slides_to_show' ";
                    $data_attrs  .= 	"data-slidestoscroll= '$ekit_review_slideshow_slides_to_scroll' ";
                    $data_attrs  .= 	"data-speed= '$ekit_review_slideshow_speed' ";
                    $data_attrs  .= 	"data-autoplay= '$ekit_review_slideshow_autoplay' ";

                    // Arrows
                    $data_attrs .=      "data-showarrow='$ekit_review_slideshow_show_arrow'";
                    $data_attrs .=      "data-prevarrow='$arrowLeftIcon'" ;
                    $data_attrs .=      "data-nextarrow='$arrowRightIcon'" ;

                    $data_attrs  .= 	"data-showdot= '$ekit_review_slideshow_show_dot' ";
                    $data_attrs  .= 	"data-pauseonhover= '$ekit_review_slideshow_pause_on_hover' ";

                    $slideshow_responsive = $this->get_slideshow_column($settings, 
                        'ekit_review_slideshow_slides_to_show', 
                        'ekit_review_slideshow_slides_to_scroll'
                    );
                    $data_attrs .= "data-responsive='". wp_json_encode($slideshow_responsive) ."'";
        
                    ?>

                    <div
                        class="ekit-review-slider-wrapper ekit-review-slider-wrapper-trustpilot"
                            <?php echo \ElementsKit\Utils::render($data_attrs); ?>
                        ><?php foreach ( $reviews as $item ) : ?>
                        <div><?php require Handler::get_dir() . 'components/review-card.php'; ?></div>
                    <?php endforeach ?>
                    </div>

                <?php } elseif($ekit_review_layout_type == 'grid') { ?>
                    <!-- Start Grid -->
                    <div class="row ekit-fb-row ekit-layout-grid">
                        <?php foreach ( $reviews as $item ) : ?>
                            <div class='<?php echo esc_attr( $column_count ); ?>'>
                                <?php require Handler::get_dir() . 'components/review-card.php'; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- End Grid -->
                <?php } elseif($ekit_review_layout_type == 'masonry') { ?>
                    <!-- Start Masonry -->
                    <div class="masonry ekit-fb-row ekit-layout-masonary <?php echo $column_count; ?>">
                        <?php foreach ( $reviews as $item ) :
                            require Handler::get_dir() . 'components/review-card.php';
                        endforeach; ?>
                    </div>
                    <!-- End Masonry -->
                <?php } else {
                    foreach ( $reviews as $item ) :
                        require Handler::get_dir() . 'components/review-card.php';
                    endforeach;
                } ?>

                <?php /* if($ekit_review_layout_type != 'slideshow'): */ ?>
                    <!-- <div class="ekit-review-cards-trustpilot--load-more">
                        <a href="#" class="btn">Load More</a>
                    </div> -->
                <?php /* endif */ ?>
            </div>
        </div>
        <!-- End Markup  -->

        <?php else: ?>
            <div>
                <h1><?php echo esc_html__('Data fetch error', 'elementskit')?></h1>
            </div>
        <?php endif;

    }
}