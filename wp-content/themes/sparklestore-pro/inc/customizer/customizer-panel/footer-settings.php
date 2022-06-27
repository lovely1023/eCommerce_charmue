<?php

/**
 * Sparkle Themes Theme Customizer
 *
 * @package Sparkle Themes
 */
$wp_customize->add_section('sparklestore_pro_footer_section', array(
    'title' => esc_html__('Footer Settings', 'sparklestore-pro'),
    'priority' => 36
));

$wp_customize->add_setting('sparklestore_pro_footer_sec_nav', array(
    //'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_pro_footer_sec_nav', array(
    'type' => 'tab',
    'section' => 'sparklestore_pro_footer_section',
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_footer_layout',
                'sparklestore_pro_footer_col',
                'sparklestore_pro_copyright',
                'sparklestore_pro_footer_general_settings',
                'sparklestore_pro_main_footer',
                'sparklestore_pro_sub_footer',
                'sparklestore_pro_paymentlogo_images',
                'sparklestore_pro_sub_footer_option',
                'sparklestore_pro_top_footer_area',
                'sparklestore_pro_middle_footer_area',
                'sparklestore_pro_bottom_footer_area',
                'sparklestore_pro_sub_top_footer_area'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_top_footer_heading',

                'sparklestore_pro_top_footer_bg_type',
                'sparklestore_pro_top_footer_bg_color',
                'sparklestore_pro_top_footer_bg_gradient',
                'sparklestore_pro_top_footer_bg_image',
                'sparklestore_pro_top_footer_parallax_effect',
                'sparklestore_pro_top_footer_bg_video',
                'sparklestore_pro_top_footer_color_heading',


                'sparklestore_pro_middle_footer_bg_type',
                'sparklestore_pro_middle_footer_bg_color',
                'sparklestore_pro_middle_footer_bg_gradient',
                'sparklestore_pro_middle_footer_bg_image',
                'sparklestore_pro_middle_footer_parallax_effect',
                'sparklestore_pro_middle_footer_bg_video',
                'sparklestore_pro_middle_footer_color_heading',

                'sparklestore_pro_footer_bg',
                'sparklestore_pro_footer_bg_color',
                'sparklestore_pro_footer_text_color',
                'sparklestore_pro_footer_anchor_color',
                'sparklestore_pro_top_footer_section_bg_color',
                
                'sparklestore_pro_middle_footer_heading',
                'sparklestore_pro_middle_footer_bg',
                'sparklestore_pro_middle_footer_bg_color',
                'sparklestore_pro_middle_footer_text_color',
                'sparklestore_pro_middle_footer_anchor_color',
                'sparklestore_pro_middle_footer_sectoin_bg_color',

                'sparklestore_pro_middle2_footer_heading',
                'sparklestore_pro_middle2_footer_bg',
                'sparklestore_pro_middle2_footer_bg_color',
                'sparklestore_pro_middle2_footer_text_color',
                'sparklestore_pro_middle2_footer_anchor_color',

                'sparklestore_pro_sub_footer_heading',
                'sparklestore_pro_sub_footer_bg_color',
                'sparklestore_pro_sub_footer_top_bottom_padding',

                'sparklestore_pro_footer_heading',
                'sparklestore_pro_bottom_footer_bg_color',
                'sparklestore_pro_bottom_footer_text_color',
                'sparklestore_pro_bottom_footer_anchor_color'
            ),
        ),
    ),
)));

$wp_customize->add_setting('sparklestore_pro_footer_general_settings', array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_footer_general_settings', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('General Settings', 'sparklestore-pro')
)));

/** top footer area */
$wp_customize->add_setting( 
    'sparklestore_pro_top_footer_area', 
    array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_text',
        'default' => 'homepage'
    ) 
);
$wp_customize->add_control('sparklestore_pro_top_footer_area', 
    array(
        'section'       => 'sparklestore_pro_footer_section',
        'label'         => esc_html__( 'Top Footer Option', 'sparklestore-pro' ),
        'type' => 'select',
        'choices'  => array(
            'none'  => esc_html__( 'None', 'sparklestore-pro' ),
            'homepage' => esc_html__( 'Only Home Page', 'sparklestore-pro' ),
            'allpage' => esc_html__( 'For All Page', 'sparklestore-pro' )
        )   
    ) 
    
);

/** middle footer area */
$wp_customize->add_setting( 
    'sparklestore_pro_middle_footer_area', 
    array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_text',
        'default' => 'off'
    ) 
);
$wp_customize->add_control( new Sparklestore_Pro_Switch_Control( 
    $wp_customize, 
        'sparklestore_pro_middle_footer_area', 
        array(
            'section'       => 'sparklestore_pro_footer_section',
            'label'         => esc_html__( 'Disable Main Footer', 'sparklestore-pro' ),
            'on_off_label'  => array(
                'on'  => esc_html__( 'Yes', 'sparklestore-pro' ),
                'off' => esc_html__( 'No', 'sparklestore-pro' )
            )   
        ) 
    ) 
);

// $wp_customize->add_setting('sparklestore_pro_footer_layout', array(
//     'sanitize_callback' => 'sanitize_text_field',
//     'default' => 'footer-style1'
// ));

// $wp_customize->add_control(new Sparklestore_Pro_Image_Select($wp_customize, 'sparklestore_pro_footer_layout', array(
//     'section' => 'sparklestore_pro_footer_section',
//     'label' => esc_html__('Footer Layout', 'sparklestore-pro'),
//     'image_path' => $imagepath . '/inc/customizer/images/footer/',
//     'choices' => array(
//         'footer-style1' => esc_html__('Footer Layout 1', 'sparklestore-pro'),
//         'footer-style2' => esc_html__('Footer Layout 2', 'sparklestore-pro'),
//         'footer-style3' => esc_html__('Footer Layout 3', 'sparklestore-pro'),
//         'footer-style4' => esc_html__('Footer Layout 4', 'sparklestore-pro'),
//         'footer-style5' => esc_html__('Footer Layout 5', 'sparklestore-pro')
//     )
// )));

$wp_customize->add_setting('sparklestore_pro_footer_col', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'col-4-1-1-1-1'
));

$wp_customize->add_control(new Sparklestore_Pro_Selector($wp_customize, 'sparklestore_pro_footer_col', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Footer Column(Main Area)', 'sparklestore-pro'),
    'class' => 'cl-one-third-width',
    'options' => array(
        'col-1-1'   => $imagepath . '/inc/customizer/images/footer/col-1-1.jpg',
        'col-2-1-1' => $imagepath . '/inc/customizer/images/footer/col-2-1-1.jpg',
        'col-3-1-1-1'   => $imagepath . '/inc/customizer/images/footer/col-3-1-1-1.jpg',
        'col-4-1-1-1-1' => $imagepath . '/inc/customizer/images/footer/col-4-1-1-1-1.jpg',
        'col-3-1-2' => $imagepath . '/inc/customizer/images/footer/col-3-1-2.jpg',
        'col-3-2-1' => $imagepath . '/inc/customizer/images/footer/col-3-2-1.jpg',
        'col-4-1-1-2'   => $imagepath . '/inc/customizer/images/footer/col-4-1-1-2.jpg',
        'col-4-2-1-1'   => $imagepath . '/inc/customizer/images/footer/col-4-2-1-1.jpg',
        'col-4-1-2-1'   => $imagepath . '/inc/customizer/images/footer/col-4-1-2-1.jpg',
        'col-4-1-3'     => $imagepath . '/inc/customizer/images/footer/col-4-1-3.jpg',
        'col-4-3-1'     => $imagepath . '/inc/customizer/images/footer/col-4-3-1.jpg'
    )
)));

/** bottom footer area */

$wp_customize->add_setting( 
    'sparklestore_pro_bottom_footer_area', 
    array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_text',
        'default' => 'off'
    ) 
);

$wp_customize->add_control( new Sparklestore_Pro_Switch_Control( 
    $wp_customize, 
        'sparklestore_pro_bottom_footer_area', 
        array(
            'section'       => 'sparklestore_pro_footer_section',
            'label'         => esc_html__( 'Disable Full Width Footer', 'sparklestore-pro' ),
            'on_off_label'  => array(
                'on'  => esc_html__( 'Yes', 'sparklestore-pro' ),
                'off' => esc_html__( 'No', 'sparklestore-pro' )
            )   
        ) 
    ) 
);

/** Sub top footer area */
$wp_customize->add_setting( 
    'sparklestore_pro_sub_top_footer_area', 
    array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_text',
        'default' => 'off'
    ) 
);

$wp_customize->add_control( new Sparklestore_Pro_Switch_Control( 
    $wp_customize, 
        'sparklestore_pro_sub_top_footer_area', 
        array(
            'section'       => 'sparklestore_pro_footer_section',
            'label'         => esc_html__( 'Disable Social & Payment', 'sparklestore-pro' ),
            'on_off_label'  => array(
                'on'  => esc_html__( 'Yes', 'sparklestore-pro' ),
                'off' => esc_html__( 'No', 'sparklestore-pro' )
            )   
        ) 
    ) 
);

/**
 * Top Footer Style
 */
$wp_customize->add_setting('sparklestore_pro_top_footer_heading', array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_top_footer_heading', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Top Footer Section', 'sparklestore-pro')
)));


// background 
$wp_customize->add_setting("sparklestore_pro_top_footer_bg_type", array(
    'default' => 'none',
    'sanitize_callback' => 'sparklestore_pro_sanitize_select',
    //'transport' => 'postMessage'
));

$wp_customize->add_control("sparklestore_pro_top_footer_bg_type", array(
    'section' => 'sparklestore_pro_footer_section',
    'type' => 'select',
    'label' => esc_html__('Background Type', 'sparklestore-pro'),
    'choices' => array(
        'none'     => esc_html__('None', 'sparklestore-pro'),
        'color-bg' => esc_html__('Color Background', 'sparklestore-pro'),
        'gradient-bg' => esc_html__('Gradient Background', 'sparklestore-pro'),
        // 'image-bg' => esc_html__('Image Background', 'sparklestore-pro'),
        // 'video-bg' => esc_html__('Video Background', 'sparklestore-pro')
    ),
));

$wp_customize->add_setting("sparklestore_pro_top_footer_bg_color", array(
    'default' => '#f2f4f6',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "sparklestore_pro_top_footer_bg_color", array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Background Color', 'sparklestore-pro'),
    
)));

$wp_customize->add_setting("sparklestore_pro_top_footer_bg_gradient", array(
    'sanitize_callback' => 'sanitize_text_field',
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Gradient_Control($wp_customize, "sparklestore_pro_top_footer_bg_gradient", array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Gradient Background', 'sparklestore-pro'),
    
)));


$wp_customize->add_setting('sparklestore_pro_top_footer_color_heading', array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_top_footer_color_heading', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Color Settings', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_footer_text_color', array(
    'default' => '#232529',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_footer_text_color', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Footer Text Color', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_footer_anchor_color', array(
    'default' => '#f33c3c',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_footer_anchor_color', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Footer Anchor Color', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_top_footer_section_bg_color', array(
    'default' => '#fafafa',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_top_footer_section_bg_color', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Section Background Color', 'sparklestore-pro')
)));


/**
 * middle footer section
 */
$wp_customize->add_setting('sparklestore_pro_middle_footer_heading', array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_middle_footer_heading', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Middle Footer Section', 'sparklestore-pro')
)));


// background 
$wp_customize->add_setting("sparklestore_pro_middle_footer_bg_type", array(
    'default' => 'none',
    'sanitize_callback' => 'sparklestore_pro_sanitize_select',
    //'transport' => 'postMessage'
));

$wp_customize->add_control("sparklestore_pro_middle_footer_bg_type", array(
    'section' => 'sparklestore_pro_footer_section',
    'type' => 'select',
    'label' => esc_html__('Background Type', 'sparklestore-pro'),
    'choices' => array(
        'none'     => esc_html__('None', 'sparklestore-pro'),
        'color-bg' => esc_html__('Color Background', 'sparklestore-pro'),
        'gradient-bg' => esc_html__('Gradient Background', 'sparklestore-pro'),
        'image-bg' => esc_html__('Image Background', 'sparklestore-pro'),
        // 'video-bg' => esc_html__('Video Background', 'sparklestore-pro')
    ),
));

$wp_customize->add_setting("sparklestore_pro_middle_footer_bg_color", array(
    'default' => '#232529',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "sparklestore_pro_middle_footer_bg_color", array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Background Color', 'sparklestore-pro'),
    
)));

$wp_customize->add_setting("sparklestore_pro_middle_footer_bg_gradient", array(
    'sanitize_callback' => 'sanitize_text_field',
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Gradient_Control($wp_customize, "sparklestore_pro_middle_footer_bg_gradient", array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Gradient Background', 'sparklestore-pro'),
    
)));

// Registers example_background settings
$wp_customize->add_setting("sparklestore_pro_middle_footer_bg_image_url", array(
    'sanitize_callback' => 'esc_url_raw',
    //'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_middle_footer_bg_image_id", array(
    'sanitize_callback' => 'absint',
    //'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_middle_footer_bg_image_repeat", array(
    'default' => 'no-repeat',
    'sanitize_callback' => 'sanitize_text_field',
    //'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_middle_footer_bg_image_size", array(
    'default' => 'cover',
    'sanitize_callback' => 'sanitize_text_field',
    //'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_middle_footer_bg_position", array(
    'default' => 'center-center',
    'sanitize_callback' => 'sanitize_text_field',
    //'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_middle_footer_bg_image_attach", array(
    'default' => 'fixed',
    'sanitize_callback' => 'sanitize_text_field',
    //'transport' => 'postMessage'
));

// Registers example_background control
$wp_customize->add_control(new Sparklestore_Pro_Background_Control($wp_customize, "sparklestore_pro_middle_footer_bg_image", array(
    'label' => esc_html__('Background Image', 'sparklestore-pro'),
    'section' => 'sparklestore_pro_footer_section',
    'settings' => array(
        'image_url' => "sparklestore_pro_middle_footer_bg_image_url",
        'image_id' => "sparklestore_pro_middle_footer_bg_image_id",
        'repeat' => "sparklestore_pro_middle_footer_bg_image_repeat", // Use false to hide the field
        'size' => "sparklestore_pro_middle_footer_bg_image_size",
        'position' => "sparklestore_pro_middle_footer_bg_position",
        'attach' => "sparklestore_pro_middle_footer_bg_image_attach"
    ),
    
)));

// $wp_customize->add_setting("sparklestore_pro_middle_footer_parallax_effect", array(
//     'sanitize_callback' => 'sanitize_text_field',
//     'default' => 'none',
//     //'transport' => 'postMessage'
// ));

// $wp_customize->add_control("sparklestore_pro_middle_footer_parallax_effect", array(
//     'type' => 'radio',
//     'section' => 'sparklestore_pro_footer_section',
//     'label' => esc_html__('Background Effect', 'sparklestore-pro'),
//     'choices' => array(
//         'none' => esc_html__('None', 'sparklestore-pro'),
//         'parallax' => esc_html__('Enable Parallax', 'sparklestore-pro'),
//         'scroll' => esc_html__('Horizontal Moving', 'sparklestore-pro')
//     ),
    
// ));

$wp_customize->add_setting("sparklestore_pro_middle_footer_bg_video", array(
    'default' => '6O9Nd1RSZSY',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control("sparklestore_pro_middle_footer_bg_video", array(
    'section' => 'sparklestore_pro_footer_section',
    'type' => 'text',
    'label' => esc_html__('Youtube Video ID', 'sparklestore-pro'),
    'description' => esc_html__('https://www.youtube.com/watch?v=yNAsk4Zw2p0. Add only yNAsk4Zw2p0', 'sparklestore-pro'),
    
));



$wp_customize->add_setting('sparklestore_pro_middle_footer_text_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_middle_footer_text_color', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Footer Text Color', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_middle_footer_anchor_color', array(
    'default' => '#f33c3c',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_middle_footer_anchor_color', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Footer Anchor Color', 'sparklestore-pro')
)));


/**
 * sub footer section
 */
$wp_customize->add_setting('sparklestore_pro_sub_footer_heading', array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_sub_footer_heading', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Social & Payment Section', 'sparklestore-pro')
)));
$wp_customize->add_setting('sparklestore_pro_sub_footer_bg_color', array(
    'default' => '#232529',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    //'transport' => 'postMessage'
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_sub_footer_bg_color', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Background Color', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_sub_footer_top_bottom_padding', array(
    'default' => '10',
    'sanitize_callback' => 'absint',
    //'transport' => 'postMessage'
));
$wp_customize->add_control(new Sparklestore_Pro_Range_Control($wp_customize, 'sparklestore_pro_sub_footer_top_bottom_padding', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Padding(Top/Bottom)', 'sparklestore-pro'),
    'input_attrs' => array(
        'min' => 0,
        'max' => 100,
        'step' => 1
    )
)));

/**
 * footer section
 */
$wp_customize->add_setting('sparklestore_pro_footer_heading', array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_footer_heading', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Footer Section', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_bottom_footer_bg_color', array(
    'default' => '#1d1e21',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    //'transport' => 'postMessage'
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_bottom_footer_bg_color', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Footer Background Color', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_bottom_footer_text_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    //'transport' => 'postMessage'
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_bottom_footer_text_color', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Footer Text Color', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_bottom_footer_anchor_color', array(
    'default' => '#f33c3c',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    //'transport' => 'postMessage'
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_bottom_footer_anchor_color', array(
    'section' => 'sparklestore_pro_footer_section',
    'label' => esc_html__('Footer Anchor Color', 'sparklestore-pro')
)));

$wp_customize->add_setting( 'sparklestore_pro_paymentlogo_images', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_repeater',
    'default' => sparklestore_pro_payment_logo_image(),        
));

$wp_customize->add_control(new Sparklestore_Pro_Repeater_Control($wp_customize, 'sparklestore_pro_paymentlogo_images', array(
        'label' => esc_html__('Logos Items', 'sparklestore-pro'),
        'section' => 'sparklestore_pro_footer_section',
        'box_label' => esc_html__('Logos', 'sparklestore-pro'),
        'add_label' => esc_html__('Add', 'sparklestore-pro'),
        'limit'      => 2
    ), 
    array(
        'image' => array(
            'type'      => 'upload',
            'label'     => esc_html__( 'Select Image', 'sparklestore-pro' ),
            'default'   => ''
        ),
        'enable' => array(
            'type' => 'switch',
            'label' => esc_html__('Enable', 'sparklestore-pro'),
            'switch' => array(
                'on' => 'Yes',
                'off' => 'No'
            ),
            'default' => 'on'
        )
    )
));

$wp_customize->add_setting('sparklestore_pro_copyright', array(
    'sanitize_callback' => 'wp_kses_post',
    'default' => '',
    //'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_copyright', array(
    'section' => 'sparklestore_pro_footer_section',
    'type' => 'textarea',
    'label' => esc_html__('Copyright Text', 'sparklestore-pro')
));


$wp_customize->add_setting('sparklestore_pro_sub_footer_option', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'menu',
    //'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_sub_footer_option', array(
    'section' => 'sparklestore_pro_footer_section',
    'type' => 'select',
    'label' => esc_html__('Footer Option', 'sparklestore-pro'),
    'choices' => array(
        'none' => esc_html__("None", 'sparklestore-pro'),
        'menu' => esc_html__("Footer Menu", 'sparklestore-pro'),
        'paymentlogo' => esc_html__("Payment Logo", 'sparklestore-pro'),
        'socialicon'    => esc_html__("Social Icon", 'sparklestore-pro'),
    )
));
