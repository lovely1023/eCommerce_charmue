<?php
namespace Elementor;
//blog category.
$this->add_control(
    'title_style',
    [
        'label' => __( 'Title Style :', 'sparklestore-pro' ),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'label_block' => true,
        'multiple' => false,
        'default'     => 'none',
        'options' => sparklestore_pro_tagline_style(),
    ]
);


//Blog section title.
$this->add_control(
    'title',
    [
        'label'     => esc_html__( 'Enter Title :', 'sparklestore-pro' ),
        'type'      => Controls_Manager::TEXT,
        'label_block' => true,
    ]
);

//Blog section subtitle.
$this->add_control(
    'subtitle',
    [
        'label'     => esc_html__( 'Enter Short Description :', 'sparklestore-pro' ),
        'type'      => Controls_Manager::TEXTAREA,
        'label_block' => true,
    ]
);