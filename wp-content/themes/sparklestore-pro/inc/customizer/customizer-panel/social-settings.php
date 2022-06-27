<?php

/**
 * Sparkle Themes Theme Customizer
 *
 * @package Sparkle Themes
 */
 $wp_customize->add_section('sparklestore_pro_social_link_activate_settings', array(
    'title'    => esc_html__('Social Media Settings', 'sparklestore-pro'),
    'priority' => 32
));

    $wp_customize->add_setting('sparklestore_pro_social_heading', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_social_heading', array(
        'section' => 'sparklestore_pro_social_link_activate_settings',
        'label' => esc_html__('Social Icons', 'sparklestore-pro')
    )));

    $wp_customize->add_setting('sparklestore_pro_social_link_activate', array(
        'default' => 1,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox'  //done
    ));

    $wp_customize->add_control('sparklestore_pro_social_link_activate', array(
        'type' => 'checkbox',
        'label' => esc_html__('Check to activate social links area', 'sparklestore-pro'),
        'section' => 'sparklestore_pro_social_link_activate_settings',
        'settings' => 'sparklestore_pro_social_link_activate'
    ));


    $wp_customize->add_setting('sparklestore_pro_social_icons', array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_repeater',
        'default' => sparklestore_pro_default_social_link(),
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Repeater_Control($wp_customize, 'sparklestore_pro_social_icons', array(
        'label' => esc_html__('Add Social Link', 'sparklestore-pro'),
        'section' => 'sparklestore_pro_social_link_activate_settings',
        'box_label' => esc_html__('Social Links', 'sparklestore-pro'),
        'add_label' => esc_html__('Add New', 'sparklestore-pro'),
            ), array(
        'icon' => array(
            'type' => 'icon',
            'label' => esc_html__('Select Icon', 'sparklestore-pro'),
            'default' => 'icofont-facebook'
        ),
        'link' => array(
            'type' => 'text',
            'label' => esc_html__('Add Link', 'sparklestore-pro'),
            'default' => ''
        ),
        'new_tab' => array(
            'type' => 'checkbox',
            'label' => esc_html__('Open New Tab', 'sparklestore-pro'),
            'default' => ''
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
    )));


    /**
     * Style
     */
    $wp_customize->add_setting('sparklestore_pro_social_color_heading', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_social_color_heading', array(
        'section' => 'sparklestore_pro_social_link_activate_settings',
        'label' => esc_html__('Icons Color', 'sparklestore-pro')
    )));

    $wp_customize->add_setting(
        'sparklestore_pro_top_header_social_bg_color',array(
            'default'     => '#003772',
            'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        )
    ); 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'sparklestore_pro_top_header_social_bg_color',array(
                'label'      => esc_html__( 'Background Color', 'sparklestore-pro' ),
                'section'    => 'sparklestore_pro_social_link_activate_settings',
            )
        )
    );

    $wp_customize->add_setting(
        'sparklestore_pro_top_header_social_icon_color',array(
            'default'     => '#fff',
            'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        )
    ); 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'sparklestore_pro_top_header_social_icon_color',array(
                'label'      => esc_html__( 'Icon Color', 'sparklestore-pro' ),
                'section'    => 'sparklestore_pro_social_link_activate_settings',
            )
        )
    );

    /** hover color */
    $wp_customize->add_setting('sparklestore_pro_social_hover_color_heading', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_social_hover_color_heading', array(
        'section' => 'sparklestore_pro_social_link_activate_settings',
        'label' => esc_html__('Icons Hover Color', 'sparklestore-pro')
    )));

    $wp_customize->add_setting(
        'sparklestore_pro_top_header_social_hover_bg_color',array(
            'default'     => '#003772',
            'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        )
    ); 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'sparklestore_pro_top_header_social_hover_bg_color',array(
                'label'      => esc_html__( 'Background Color', 'sparklestore-pro' ),
                'section'    => 'sparklestore_pro_social_link_activate_settings',
            )
        )
    );

    $wp_customize->add_setting(
        'sparklestore_pro_top_header_social_hover_icon_color',array(
            'default'     => '#fff',
            'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        )
    ); 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'sparklestore_pro_top_header_social_hover_icon_color',array(
                'label'      => esc_html__( 'Icon Color', 'sparklestore-pro' ),
                'section'    => 'sparklestore_pro_social_link_activate_settings',
            )
        )
    );

    //heading
    $wp_customize->add_setting('sparklestore_pro_social_align_msg', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_social_align_msg', array(
        'section' => 'sparklestore_pro_social_link_activate_settings',
        'label' => esc_html__('Alignment', 'sparklestore-pro')
    )));

    /*Social align*/
    $wp_customize->add_setting(
        'social-align',
        array(
            'default'           => 'swp-flex-align-right',
            'sanitize_callback' => 'sparklestore_pro_sanitize_select',
            // 'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new SparkleWP_Custom_Control_Buttonset(
            $wp_customize,
            'social-align',
            array(
                'choices'  => sparklewp_flex_align(),
                'label'    => esc_html__( 'Alignment', 'sparklestore-pro' ),
                'section'  => 'sparklestore_pro_social_link_activate_settings',
                'settings' => 'social-align',
            )
        )
    );

    $wp_customize->selective_refresh->add_partial( 'sparklestore_pro_social_heading', array(
		'selector' => '.sociallink.topsociallink',
		'container_inclusive' => false
    ) );
    