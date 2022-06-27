<?php
/**
 * Breadcrumbs Settings
*/
$wp_customize->add_section('sparklestore_pro_woocommerce_breadcrumbs_settings', array(
    'title' => esc_html__('Breadcrumbs', 'sparklestore-pro'),
    'priority' => 20,
)); 

$wp_customize->add_setting('sparklestore_pro_breadcrumbs_settings_nav', array(
    //'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));
$wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_pro_breadcrumbs_settings_nav', array(
    'type' => 'tab',
    'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
    'buttons' => array(
        array(
            'name' => esc_html__('Settings', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_normal_page_enable_disable_section',
                'sparklestore_pro_breadcrumb_layout',
                'sparklestore_pro_breadcrumb_alignment',
                'sparklestore_pro_normal_page_breadcrumb_hide_title',
                'sparklestore_pro_normal_page_breadcrumb_hide_menu',
                'sparklestore_pro_breadcrumb_margin_heading',
                'sparklestore_pro_breadcrumb_padding',
                'sparklestore_pro_breadcrumb_margin',
                'sparklestore_pro_breadcrumb_product_heading',
                'sparklestore_pro_product_page_breadcrumb_position'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_breadcrumb_bg_heading',
                'sparklestore_pro_breadcrumbs_normal_page_bg_type',
                'sparklestore_pro_breadcrumb_color_heading',
                'sparklestore_pro_breadcrumb_title_color',
                'sparklestore_pro_breadcrumb_bg_gradient',
                'sparklestore_pro_breadcrumb_text_color',
                'sparklestore_pro_breadcrumb_anchor_color',
                'sparklestore_pro_breadcrumb_hover_color',
                'sparklestore_pro_breadcrumbs_normal_page_bg_color',
                'sparklestore_pro_breadcrumbs_normal_page_parallax_effect',
                'sparklestore_pro_breadcrumbs_normal_page_bg_image',
                'sparklestore_pro_breadcrumbs_normal_page_overlay_color',
                'sparklestore_pro_breadcrumbs_normal_page_background',
                
            ),
        )
    ),
)));

          
    // normal page section
    $wp_customize->add_setting('sparklestore_pro_normal_page_enable_disable_section', array(
        'default' => 'on',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sparklestore_pro_sanitize_text', // done
    ));
    $wp_customize->add_control( new Sparklestore_Pro_Switch_Control( 
        $wp_customize, 'sparklestore_pro_normal_page_enable_disable_section', 
            array(
                'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
                'label' => esc_html__('Enable Breadcrumbs', 'sparklestore-pro'),
                'on_off_label'  => array(
                    'on'  => esc_html__( 'Yes', 'sparklestore-pro' ),
                    'off' => esc_html__( 'No', 'sparklestore-pro' )
                )   
            ) 
        ) 
    );

    //heading
    $wp_customize->add_setting('sparklestore_pro_breadcrumb_bg_heading', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_breadcrumb_bg_heading', array(
        'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
        'label' => esc_html__('Background', 'sparklestore-pro')
    )));

    // background 
    $wp_customize->add_setting("sparklestore_pro_breadcrumbs_normal_page_bg_type", array(
        'default' => 'color-bg',
        'sanitize_callback' => 'sparklestore_pro_sanitize_select',
        //'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control("sparklestore_pro_breadcrumbs_normal_page_bg_type", array(
        'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
        'type' => 'select',
        'label' => esc_html__('Background Type', 'sparklestore-pro'),
        'choices' => array(
            'default'     => esc_html__('Default', 'sparklestore-pro'),
            'color-bg' => esc_html__('Color Background', 'sparklestore-pro'),
            'gradient-bg' => esc_html__('Gradient Background', 'sparklestore-pro'),
            'image-bg' => esc_html__('Image Background', 'sparklestore-pro'),
            // 'video-bg' => esc_html__('Video Background', 'sparklestore-pro')
        ),
    ));


    $wp_customize->add_setting("sparklestore_pro_breadcrumbs_normal_page_bg_color", array(
        'default' => '#f2f4f6',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        //'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "sparklestore_pro_breadcrumbs_normal_page_bg_color", array(
        'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
        'label' => esc_html__('Background Color', 'sparklestore-pro'),
        
    )));
    
    $wp_customize->add_setting("sparklestore_pro_breadcrumbs_normal_page_bg_gradient", array(
        'sanitize_callback' => 'sanitize_text_field',
        //'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Gradient_Control($wp_customize, "sparklestore_pro_breadcrumbs_normal_page_bg_gradient", array(
        'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
        'label' => esc_html__('Gradient Background', 'sparklestore-pro'),
        
    )));
    
    // Registers example_background settings
    $wp_customize->add_setting("sparklestore_pro_breadcrumbs_normal_page_background_image", array(
        'sanitize_callback' => 'esc_url_raw',
        //'transport' => 'postMessage'
    ));
    
    $wp_customize->add_setting("sparklestore_pro_breadcrumbs_normal_page_background_image_id", array(
        'sanitize_callback' => 'absint',
        //'transport' => 'postMessage'
    ));
    
    $wp_customize->add_setting("sparklestore_pro_breadcrumbs_normal_page_background_image_repeat", array(
        'default' => 'no-repeat',
        'sanitize_callback' => 'sanitize_text_field',
        //'transport' => 'postMessage'
    ));
    
    $wp_customize->add_setting("sparklestore_pro_breadcrumbs_normal_page_background_image_size", array(
        'default' => 'cover',
        'sanitize_callback' => 'sanitize_text_field',
        //'transport' => 'postMessage'
    ));
    
    $wp_customize->add_setting("sparklestore_pro_breadcrumbs_normal_page_background_image_position", array(
        'default' => 'center center',
        'sanitize_callback' => 'sanitize_text_field',
        //'transport' => 'postMessage'
    ));
    
    $wp_customize->add_setting("sparklestore_pro_breadcrumbs_normal_page_background_image_attach", array(
        'default' => 'fixed',
        'sanitize_callback' => 'sanitize_text_field',
        //'transport' => 'postMessage'
    ));
    
    // Registers example_background control
    $wp_customize->add_control(new Sparklestore_Pro_Background_Control($wp_customize, "sparklestore_pro_breadcrumbs_normal_page_bg_image", array(
        'label' => esc_html__('Background Image', 'sparklestore-pro'),
        'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
        'settings' => array(
            'image_url' => "sparklestore_pro_breadcrumbs_normal_page_background_image",
            'image_id' => "sparklestore_pro_breadcrumbs_normal_page_background_image_id",
            'repeat' => "sparklestore_pro_breadcrumbs_normal_page_background_image_repeat", // Use false to hide the field
            'size' => "sparklestore_pro_breadcrumbs_normal_page_background_image_size",
            'position' => "sparklestore_pro_breadcrumbs_normal_page_background_image_position",
            'attach' => "sparklestore_pro_breadcrumbs_normal_page_background_image_attach"
        ),
        
    )));

    $wp_customize->add_setting('sparklestore_pro_breadcrumbs_normal_page_overlay_color', array(
        'default' => '',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
        // 'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_breadcrumbs_normal_page_overlay_color', array(
        'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
        'label' => esc_html__('Background Overlay Color', 'sparklestore-pro')
    )));

    $wp_customize->add_setting('sparklestore_pro_breadcrumb_layout', array(
        'default' => 'boxed',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sparklestore_pro_sanitize_select'  // done
    ));
    $wp_customize->add_control('sparklestore_pro_breadcrumb_layout', array(
        'type' => 'select',
        'label' => esc_html__('Breadcrumb Layout', 'sparklestore-pro'),
        'section' => "sparklestore_pro_woocommerce_breadcrumbs_settings",
        'choices' => array(
            'fullwidth'      => esc_html__('Full Width', 'sparklestore-pro'),
            'boxed' => esc_html__('Box Width','sparklestore-pro')
        )
    ));

    $wp_customize->add_setting('sparklestore_pro_breadcrumb_alignment', array(
        'default' => 'text-left',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sparklestore_pro_sanitize_select'  // done
    ));
    $wp_customize->add_control('sparklestore_pro_breadcrumb_alignment', array(
        'type' => 'select',
        'label' => esc_html__('Breadcrumb Alignment', 'sparklestore-pro'),
        'section' => "sparklestore_pro_woocommerce_breadcrumbs_settings",
        'choices' => array(
            'text-center'   => esc_html__('Center', 'sparklestore-pro'),
            'text-left'     => esc_html__('Left','sparklestore-pro'),
            'text-right'    => esc_html__('Right','sparklestore-pro'),
        )
    ));


    $wp_customize->add_setting('sparklestore_pro_normal_page_breadcrumb_hide_title', array(
        'default' => 'off',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sparklestore_pro_sanitize_text', // done
    ));
    $wp_customize->add_control( new Sparklestore_Pro_Switch_Control( 
        $wp_customize, 'sparklestore_pro_normal_page_breadcrumb_hide_title', 
            array(
                'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
                'label' => esc_html__('Hide Title', 'sparklestore-pro'),
                'on_off_label'  => array(
                    'on'  => esc_html__( 'Yes', 'sparklestore-pro' ),
                    'off' => esc_html__( 'No', 'sparklestore-pro' )
                )   
            ) 
        ) 
    );

    $wp_customize->add_setting('sparklestore_pro_normal_page_breadcrumb_hide_menu', array(
        'default' => 'off',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sparklestore_pro_sanitize_text', // done
    ));
    $wp_customize->add_control( new Sparklestore_Pro_Switch_Control( 
        $wp_customize, 'sparklestore_pro_normal_page_breadcrumb_hide_menu', 
            array(
                'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
                'label' => esc_html__('Hide Breadcrumb Menu', 'sparklestore-pro'),
                'on_off_label'  => array(
                    'on'  => esc_html__( 'Yes', 'sparklestore-pro' ),
                    'off' => esc_html__( 'No', 'sparklestore-pro' )
                )   
            ) 
        ) 
    );

    /** 
     * title color heading 
     **/
    $wp_customize->add_setting('sparklestore_pro_breadcrumb_color_heading', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_breadcrumb_color_heading', array(
        'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
        'label' => esc_html__('Color Settings', 'sparklestore-pro')
    )));
    
    $wp_customize->add_setting('sparklestore_pro_breadcrumb_title_color', array(
        'default' => '#232529',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        // 'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_breadcrumb_title_color', array(
        'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
        'label' => esc_html__('Title Color', 'sparklestore-pro')
    )));


    $wp_customize->add_setting('sparklestore_pro_breadcrumb_text_color', array(
        'default' => '#232529',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        // 'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_breadcrumb_text_color', array(
        'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
        'label' => esc_html__('Text Color', 'sparklestore-pro')
    )));
    
    $wp_customize->add_setting('sparklestore_pro_breadcrumb_anchor_color', array(
        'default' => '#f33c3c',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        // 'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_breadcrumb_anchor_color', array(
        'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
        'label' => esc_html__('Anchor Color', 'sparklestore-pro')
    )));


    $wp_customize->add_setting('sparklestore_pro_breadcrumb_hover_color', array(
        'default' => '#232529',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        // 'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_breadcrumb_hover_color', array(
        'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
        'label' => esc_html__('Hover Color', 'sparklestore-pro')
    )));
    
    /** margin padding heading */
    $wp_customize->add_setting('sparklestore_pro_breadcrumb_margin_heading', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_breadcrumb_margin_heading', array(
        'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
        'label' => esc_html__('Margin & Padding', 'sparklestore-pro')
    )));

    /** margin control */
    $wp_customize->add_setting(
        'sparklestore_pro_breadcrumb_margin',
        array(
            'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
            // 'default'           => '',
            // 'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new SparkleWP_Custom_Control_Cssbox(
            $wp_customize,
            'sparklestore_pro_breadcrumb_margin',
            array(
                'label'    => esc_html__( 'Margin (px)', 'sparklestore-pro' ),
                'section'  => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
                'settings' => 'sparklestore_pro_breadcrumb_margin',
            ),
            array(),
            array()
        )
    );
    
    /* Padding*/
    $wp_customize->add_setting(
        'sparklestore_pro_breadcrumb_padding',
        array(
            'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
            'default'           => '',
            // 'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new SparkleWP_Custom_Control_Cssbox(
            $wp_customize,
            'sparklestore_pro_breadcrumb_padding',
            array(
                'label'    => esc_html__( 'Padding (px)', 'sparklestore-pro' ),
                'section'  => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
                'settings' => 'sparklestore_pro_breadcrumb_padding',
            ),
            array(),
            array()
        )
    );

    // product page settings
    $wp_customize->add_setting('sparklestore_pro_breadcrumb_product_heading', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_breadcrumb_product_heading', array(
        'section' => 'sparklestore_pro_woocommerce_breadcrumbs_settings',
        'label' => esc_html__('Product Details', 'sparklestore-pro')
    )));

    $wp_customize->add_setting('sparklestore_pro_product_page_breadcrumb_position', array(
        'default' => 'inside',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sparklestore_pro_sanitize_select'  // done
    ));
    $wp_customize->add_control('sparklestore_pro_product_page_breadcrumb_position', array(
        'type' => 'select',
        'label' => esc_html__('Breadcrumb Position', 'sparklestore-pro'),
        'section' => "sparklestore_pro_woocommerce_breadcrumbs_settings",
        'choices' => array(
            'inside'   => esc_html__('Inside Header', 'sparklestore-pro'),
            'outside'  => esc_html__('OutSide Header','sparklestore-pro'),
        )
    ));

    $wp_customize->selective_refresh->add_partial( 'sparklestore_pro_normal_page_enable_disable_section', array(
		'selector' => '.breadcrumbs-wrap .breadcrumb-trail.breadcrumbs',
		'container_inclusive' => false,
	) );