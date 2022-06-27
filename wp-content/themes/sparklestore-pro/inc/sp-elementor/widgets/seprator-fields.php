<?php
namespace Elementor;
//section title style.
$this->start_controls_section(
    'section_seprator',
    [
        'label' => __( 'Seprator', 'sparklestore-pro' ),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);


// // top seprator 
// $this->add_control(
// 	'top_seprator',
// 	[
// 		'label' => __( 'Top Seprator', 'sparklestore-pro' ),
// 		'type' => \Elementor\Controls_Manager::SELECT2,
// 		'label_block' => true,
// 		'multiple' => false,
// 		'options' => array_merge(array('none' => 'None'), sparklestore_pro_svg_seperator()),
// 		'default' => [ 'none' ],
// 	]
// );

// $this->add_control(
// 	'top_seprator_color',
// 	[
// 		'label' => __( 'Top Seprator Color', 'sparklestore-pro' ),
// 		'type' => Controls_Manager::COLOR,
// 		'default' => '#404040',
// 		'selectors' => [
// 			// '{{WRAPPER}} .section-title' => 'color: {{VALUE}};',
// 		],
// 	]
// );


$this->add_control(
    'bottom_seprator',
    [
        'label' => __( 'Bottom Seprator', 'sparklestore-pro' ),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'label_block' => true,
        'multiple' => false,
        'options' => array_merge(array('none' => 'None'), sparklestore_pro_svg_seperator()),
        'default' => 'none',
    ]
);

$this->add_control(
    'bottom_seprator_color',
    [
        'label' => __( 'Bottom Seprator Color', 'sparklestore-pro' ),
        'type' => Controls_Manager::COLOR,
        'default' => 'rgba(144, 140, 140, 0.32)',
        'selectors' => [
            '{{WRAPPER}} .svg-seperator svg' => 'fill: {{VALUE}};',
        ],
    ]
);


$this->add_control(
    'bottom_seprator_height',
    [
        'label' => __( 'Height', 'sparklestore-pro' ),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
            'px' => [
                'min' => 10,
                'max' => 400,
                'step' => 2,
            ],
        ],
        'default' => [
            'size' => 100,
        ],
        
        'selectors' => [
            '{{WRAPPER}} .svg-seperator svg' => 'height: {{SIZE}}{{UNIT}};',
        ],
    ]
);


$this->end_controls_section();