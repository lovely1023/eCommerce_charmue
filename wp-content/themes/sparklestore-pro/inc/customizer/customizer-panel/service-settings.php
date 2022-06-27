<?php
/**
 * Services Section
*/
   $wp_customize->add_section(new Sparklestore_Pro_Toggle_Section($wp_customize, 'sparklestore_pro_services_area', array(
        'title'           => esc_html__('Services Area Settings', 'sparklestore-pro'),
        'priority' => 24,
        'hiding_control' => 'sparklestore_pro_services_area_footer_settings',
    )));

   // Footer Services 
   $wp_customize->add_setting('sparklestore_pro_services_area_footer_settings', array(
        'default' => 'off',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sparklestore_pro_sanitize_text',
        'priority' => -1,
    ));

$wp_customize->add_control( new Sparklestore_Pro_Switch_Control( $wp_customize, 
   'sparklestore_pro_services_area_footer_settings', 
   array(
       'section' => 'sparklestore_pro_services_area',
       'label' => esc_html__('Disable Section', 'sparklestore-pro'),
       'on_off_label'  => array(
            'on' => esc_html__('Yes', 'sparklestore-pro'),
            'off' => esc_html__('No', 'sparklestore-pro')
       )   
   ) 
));

   $wp_customize->add_setting('sparklestore_pro_services_area_nav', array(
        //'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_pro_services_area_nav', array(
        'type' => 'tab',
        'section' => 'sparklestore_pro_services_area',
        'buttons' => array(
            array(
                'name' => esc_html__('Settings ', 'sparklestore-pro'),
                'fields' => array(
                    'sparklestore_pro_services_footer_layout',
                    'sparklestore_pro_services_footer_loop',
                    'sparklestore_pro_services_padding',
                ),
                'active' => true,
            ),
            array(
                'name' => esc_html__('Style', 'sparklestore-pro'),
                'fields' => array(
                    'sparklestore_pro_services_bg_type',
                    'sparklestore_pro_services_bg_color',
                    'sparklestore_pro_services_bg_gradient',
                    'sparklestore_pro_services_bg_image',
                    'sparklestore_pro_services_parallax_effect',
                    'sparklestore_pro_services_bg_video',
                    'sparklestore_pro_services_overlay_color',
                    'sparklestore_pro_services_icon_color',
                    'sparklestore_pro_services_title_color',
                    'sparklestore_pro_services_description_color',
                    'sparklestore_pro_services_heading',
                    'sparklestore_pro_services_section_heading',
                    'sparklestore_pro_services_box_heading',
                    'sparklestore_pro_services_box_bg_color'


                ),
            )
        ),
    )));
    
    $wp_customize->selective_refresh->add_partial('sparklestore_pro_services_layout', array(
        'selector' => '.services_wrapper.header-top .services_area',
        // 'render_callback' => 'sparklestore_pro_gdpr_notice',
        'container_inclusive' => true
    ));

        
        $wp_customize->add_setting('sparklestore_display_services_section', array(
            'default' => 'footer',
            'sanitize_callback' => 'sparklestore_pro_sanitize_select'  //done
        ));

        $wp_customize->add_control('sparklestore_display_services_section', array(
            'type' => 'radio',
            'label' => esc_html__('Display Services Location', 'sparklestore-pro'),
            'section' => 'sparklestore_pro_services_area',
            'settings' => 'sparklestore_display_services_section',
            'description' => esc_html__('Options to manage service area below the header or abote the footer area', 'sparklestore-pro'),
                'choices' => array(
                    'header' => esc_html__('Below the Header', 'sparklestore-pro'),
                    'footer' => esc_html__('Abover the Footer', 'sparklestore-pro')
                )
        ));
 
        $wp_customize->add_setting('sparklestore_pro_services_footer_layout', array(
           'default' => 'layout-two',
           'capability' => 'edit_theme_options',
           'sanitize_callback' => 'sparklestore_pro_sanitize_select',
        ));
 
        $wp_customize->add_control('sparklestore_pro_services_footer_layout', array(
           'type' => 'select',
           'label' => esc_html__('Select Services Layout', 'sparklestore-pro'),
           'section' => 'sparklestore_pro_services_area',
           'settings' => 'sparklestore_pro_services_footer_layout',
           'choices' => array( 
                 'layout-one' => esc_html__('Layout One','sparklestore-pro'),
                 'layout-two' => esc_html__('Layout Two','sparklestore-pro')
        )));
        
         $wp_customize->selective_refresh->add_partial( 'sparklestore_pro_services_footer_layout', array(
            'selector'        => '.footerservices .services_item',
        ));
 
        $wp_customize->add_setting('sparklestore_pro_services_footer_loop', array(
            'sanitize_callback' => 'sparklestore_pro_sanitize_repeater',
            'default' => json_encode(array(
                array(
                    'icon' => 'icofont-facebook',
                    'title' => '',
                    'description' => '',
                    'enable' => 'on'
                )
            ))
        ));
        
        $wp_customize->add_control(new Sparklestore_Pro_Repeater_Control($wp_customize, 'sparklestore_pro_services_footer_loop', array(
            'label' => esc_html__('Services', 'sparklestore-pro'),
            'section' => 'sparklestore_pro_services_area',
            'box_label' => esc_html__('Service', 'sparklestore-pro'),
            'repeator_label' => 'title',
            'limit' => 6,
            'add_label' => esc_html__('Add New', 'sparklestore-pro'),
                ), array(
            'icon' => array(
                'type' => 'icon',
                'label' => esc_html__('Select Icon', 'sparklestore-pro'),
                'default' => 'icofont-facebook'
            ),
            'title' => array(
                'type' => 'text',
                'label' => esc_html__('Title', 'sparklestore-pro'),
                'default' => ''
            ),
            'description' => array(
                'type' => 'textarea',
                'label' => esc_html__('Description', 'sparklestore-pro'),
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

        /** padding control */
        $wp_customize->add_setting("sparklestore_pro_services_padding", array(
            'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
            'default' => 60,
            // 'transport' => 'postMessage'
        ));

        $wp_customize->add_setting("sparklestore_pro_services_padding_tablet", array(
            'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
            // 'transport' => 'postMessage'
        ));

        $wp_customize->add_setting("sparklestore_pro_services_padding_mobile", array(
            'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
            // 'transport' => 'postMessage'
        ));

        $wp_customize->add_control(new Sparklestore_Pro_Range_Slider_Control($wp_customize, "sparklestore_pro_services_padding", array(
            'section' => "sparklestore_pro_services_area",
            'label' => esc_html__('Top/Bottom Padding (px)', 'sparklestore-pro'),
            'settings' => array(
                'desktop' => "sparklestore_pro_services_padding",
                'tablet' => "sparklestore_pro_services_padding_tablet",
                'mobile' => "sparklestore_pro_services_padding_mobile",
            ),
            'input_attrs' => array(
                'min' => 0,
                'max' => 200,
                'step' => 1,
            )
        )));

        $wp_customize->add_setting('sparklestore_pro_services_section_heading', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_services_section_heading', array(
            'section' => 'sparklestore_pro_services_area',
            'label' => esc_html__('Service Section', 'sparklestore-pro')
        )));


        // background 
        $wp_customize->add_setting("sparklestore_pro_services_bg_type", array(
            'default' => 'none',
            'sanitize_callback' => 'sparklestore_pro_sanitize_select',
            //'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control("sparklestore_pro_services_bg_type", array(
            'section' => 'sparklestore_pro_services_area',
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
        
        $wp_customize->add_setting("sparklestore_pro_services_bg_color", array(
            'default' => '#FFFFFF',
            'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
            //'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "sparklestore_pro_services_bg_color", array(
            'section' => 'sparklestore_pro_services_area',
            'label' => esc_html__('Background Color', 'sparklestore-pro'),
            
        )));
        
        $wp_customize->add_setting("sparklestore_pro_services_bg_gradient", array(
            'sanitize_callback' => 'sanitize_text_field',
            //'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control(new Sparklestore_Pro_Gradient_Control($wp_customize, "sparklestore_pro_services_bg_gradient", array(
            'section' => 'sparklestore_pro_services_area',
            'label' => esc_html__('Gradient Background', 'sparklestore-pro'),
            
        )));
        
        // Registers example_background settings
        $wp_customize->add_setting("sparklestore_pro_services_bg_image_url", array(
            'sanitize_callback' => 'esc_url_raw',
            //'transport' => 'postMessage'
        ));
        
        $wp_customize->add_setting("sparklestore_pro_services_bg_image_id", array(
            'sanitize_callback' => 'absint',
            //'transport' => 'postMessage'
        ));
        
        $wp_customize->add_setting("sparklestore_pro_services_bg_image_repeat", array(
            'default' => 'no-repeat',
            'sanitize_callback' => 'sanitize_text_field',
            //'transport' => 'postMessage'
        ));
        
        $wp_customize->add_setting("sparklestore_pro_services_bg_image_size", array(
            'default' => 'cover',
            'sanitize_callback' => 'sanitize_text_field',
            //'transport' => 'postMessage'
        ));
        
        $wp_customize->add_setting("sparklestore_pro_services_bg_position", array(
            'default' => 'center-center',
            'sanitize_callback' => 'sanitize_text_field',
            //'transport' => 'postMessage'
        ));
        
        $wp_customize->add_setting("sparklestore_pro_services_bg_image_attach", array(
            'default' => 'fixed',
            'sanitize_callback' => 'sanitize_text_field',
            //'transport' => 'postMessage'
        ));
        
        // Registers example_background control
        $wp_customize->add_control(new Sparklestore_Pro_Background_Control($wp_customize, "sparklestore_pro_services_bg_image", array(
            'label' => esc_html__('Background Image', 'sparklestore-pro'),
            'section' => 'sparklestore_pro_services_area',
            'settings' => array(
                'image_url' => "sparklestore_pro_services_bg_image_url",
                'image_id' => "sparklestore_pro_services_bg_image_id",
                'repeat' => "sparklestore_pro_services_bg_image_repeat", // Use false to hide the field
                'size' => "sparklestore_pro_services_bg_image_size",
                'position' => "sparklestore_pro_services_bg_position",
                'attach' => "sparklestore_pro_services_bg_image_attach"
            ),
            
        )));
        
        $wp_customize->add_setting("sparklestore_pro_services_parallax_effect", array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => 'none',
            //'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control("sparklestore_pro_services_parallax_effect", array(
            'type' => 'radio',
            'section' => 'sparklestore_pro_services_area',
            'label' => esc_html__('Background Effect', 'sparklestore-pro'),
            'choices' => array(
                'none' => esc_html__('None', 'sparklestore-pro'),
                'parallax' => esc_html__('Enable Parallax', 'sparklestore-pro'),
                'scroll' => esc_html__('Horizontal Moving', 'sparklestore-pro')
            ),
            
        ));
        
        $wp_customize->add_setting("sparklestore_pro_services_bg_video", array(
            'default' => '6O9Nd1RSZSY',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control("sparklestore_pro_services_bg_video", array(
            'section' => 'sparklestore_pro_services_area',
            'type' => 'text',
            'label' => esc_html__('Youtube Video ID', 'sparklestore-pro'),
            'description' => esc_html__('https://www.youtube.com/watch?v=yNAsk4Zw2p0. Add only yNAsk4Zw2p0', 'sparklestore-pro'),
            
        ));

        $wp_customize->add_setting('sparklestore_pro_services_box_heading', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_services_box_heading', array(
            'section' => 'sparklestore_pro_services_area',
            'label' => esc_html__('Service Box Style', 'sparklestore-pro')
        )));


        $wp_customize->add_setting("sparklestore_pro_services_box_bg_color", array(
            'default' => '#f2f4f6',
            'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
            ////'transport' => 'postMessage'
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "sparklestore_pro_services_box_bg_color", array(
            'section' => 'sparklestore_pro_services_area',
            'label' => esc_html__('Service Box Background', 'sparklestore-pro'),
            
        )));


        $wp_customize->add_setting("sparklestore_pro_services_icon_color", array(
            'default' => '#f33c3c',
            'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
            ////'transport' => 'postMessage'
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "sparklestore_pro_services_icon_color", array(
            'section' => 'sparklestore_pro_services_area',
            'label' => esc_html__('Icon Color', 'sparklestore-pro'),
            
        )));

        $wp_customize->selective_refresh->add_partial( 'sparklestore_pro_services_icon_color', array(
            'selector'        => '.footerservices .services_icon',
        ) );

        $wp_customize->add_setting("sparklestore_pro_services_title_color", array(
            'default' => '#232529',
            'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
            //'transport' => 'postMessage'
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "sparklestore_pro_services_title_color", array(
            'section' => 'sparklestore_pro_services_area',
            'label' => esc_html__('Title Color', 'sparklestore-pro'),
            
        )));

        $wp_customize->add_setting("sparklestore_pro_services_description_color", array(
            'default' => '#232529',
            'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
            //'transport' => 'postMessage'
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "sparklestore_pro_services_description_color", array(
            'section' => 'sparklestore_pro_services_area',
            'label' => esc_html__('Description Color', 'sparklestore-pro'),
        )));