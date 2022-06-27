<?php
namespace Elementor;
//color section
$this->add_control(
    'title_color',
    [
        'label' => __( 'Title Color', 'sparklestore-pro' ),
        'type' => Controls_Manager::COLOR,
        'default' => '#232529',
        'selectors' => [
            '{{WRAPPER}} .section-title' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'text_color',
    [
        'label' => __( 'Sub Title Color', 'sparklestore-pro' ),
        'type' => Controls_Manager::COLOR,
        'default' => '#232529',
        'selectors' => [
            '{{WRAPPER}} .section-tagline' => 'color: {{VALUE}};',
        ]
    ]
);

$this->add_control(
    'hr',
    [
        'type' => \Elementor\Controls_Manager::DIVIDER,
    ]
);