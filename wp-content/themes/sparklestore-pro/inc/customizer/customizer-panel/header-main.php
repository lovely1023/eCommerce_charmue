<?php
/**
* Main Header
*/
  $wp_customize->add_section('sparklewp_header_main', array(
    'title' => esc_html__('Main Header', 'sparklestore-pro'),
    'panel' => $this->panel,
    'priority' => 26,
  ));

   $wp_customize->add_setting('sparklestore_pro_header_settings_nav', array(
       // 'transport' => 'postMessage',
       'sanitize_callback' => 'wp_kses_post',
   ));

   $wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_pro_header_settings_nav', array(
       'type' => 'tab',
       'section' => 'sparklewp_header_main',
       'buttons' => array(
           
           array(
               'name' => esc_html__('Style', 'sparklestore-pro'),
               'active' => true,
               'fields' => array(
                   'header_image',
                   'sparklestore_pro_main_header_bg_type',
                   'sparklestore_pro_main_header_bg_color',
                   'sparklestore_pro_main_header_bg_gradient',
                   'sparklestore_pro_main_header_overlay_color',
                   'sparklestore_pro_main_header_parallax_effect',
                   
                   'main-header-padding-margin-msg',
                   'header-main-margin',
                   'header-main-padding',
                   'main-header-border-styling-msg',
                   'header-main-border-styling',

               ),
           ),
       ),
   )));


   $wp_customize->remove_section('header_image');
   $wp_customize->get_control('header_image')->section = 'sparklewp_header_main';
   $wp_customize->get_control('header_image' )->priority = 11;


    // Background Option MSG    
    $wp_customize->add_setting(
        'main-header-bg-option-msg',
        array(
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control(
        new Sparklestore_Pro_Customize_Heading(
            $wp_customize,
            'main-header-bg-option-msg',
            array(
                'label'   => esc_html__( 'Background Options', 'sparklestore-pro' ),
                'section' => 'sparklewp_header_main',
            )
        )
    );

   /**
    * Style
    */
   $wp_customize->add_setting("sparklestore_pro_main_header_bg_type", array(
       'default' => 'color-bg',
       'sanitize_callback' => 'sparklestore_pro_sanitize_select',
       // 'transport' => 'postMessage'
   ));

   $wp_customize->add_control("sparklestore_pro_main_header_bg_type", array(
       'section' => 'sparklewp_header_main',
       'type' => 'select',
       'label' => esc_html__('Background Type', 'sparklestore-pro'),
       'choices' => array(
           'color-bg' => esc_html__('Color Background', 'sparklestore-pro'),
           'gradient-bg' => esc_html__('Gradient Background', 'sparklestore-pro'),
           'image-bg' => esc_html__('Image Background', 'sparklestore-pro'),
           // 'video-bg' => esc_html__('Video Background', 'sparklestore-pro')
       ),
       
   ));

   $wp_customize->add_setting("sparklestore_pro_main_header_bg_color", array(
       'default' => '#FFFFFF',
       'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
       // 'transport' => 'postMessage'
   ));

   $wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, "sparklestore_pro_main_header_bg_color", array(
       'section' => 'sparklewp_header_main',
       'label' => esc_html__('Background Color', 'sparklestore-pro'),
       
   )));

   $wp_customize->add_setting("sparklestore_pro_main_header_bg_gradient", array(
       'sanitize_callback' => 'sanitize_text_field',
       // 'transport' => 'postMessage'
   ));

   $wp_customize->add_control(new Sparklestore_Pro_Gradient_Control($wp_customize, "sparklestore_pro_main_header_bg_gradient", array(
       'section' => 'sparklewp_header_main',
       'label' => esc_html__('Gradient Background', 'sparklestore-pro'),
       
   )));

   $wp_customize->add_setting("sparklestore_pro_main_header_parallax_effect", array(
       'sanitize_callback' => 'sanitize_text_field',
       'default' => 'none',
       // 'transport' => 'postMessage'
   ));

   $wp_customize->add_control("sparklestore_pro_main_header_parallax_effect", array(
       'type' => 'radio',
       'section' => 'sparklewp_header_main',
       'label' => esc_html__('Background Effect', 'sparklestore-pro'),
       'choices' => array(
           'none' => esc_html__('None', 'sparklestore-pro'),
           'fixed' => esc_html__('Enable Parallax', 'sparklestore-pro'),
           'scroll' => esc_html__('Horizontal Moving', 'sparklestore-pro')
       ),
       
   ));

   $wp_customize->add_setting("sparklestore_pro_main_header_overlay_color", array(
       'default' => 'rgba(255,255,255,0)',
       'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
       // 'transport' => 'postMessage'
   ));

   $wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, "sparklestore_pro_main_header_overlay_color", array(
       'label' => esc_html__('Background Overlay Color', 'sparklestore-pro'),
       'section' => 'sparklewp_header_main',
       'palette' => array(
           'rgb(255, 255, 255, 0.3)', // RGB, RGBa, and hex values supported
           'rgba(0, 0, 0, 0.3)',
           'rgba( 255, 255, 255, 0.2 )', // Different spacing = no problem
           '#00CC99', // Mix of color types = no problem
           '#00C439',
           '#00C569',
           'rgba( 255, 234, 255, 0.2 )', // Different spacing = no problem
           '#AACC99', // Mix of color types = no problem
           '#33C439',
       ),
   )));




   /*Margin & Padding*/
   $wp_customize->add_setting(
       'main-header-padding-margin-msg',
       array(
           'sanitize_callback' => 'wp_kses_post',
       )
   );
   $wp_customize->add_control(
       new Sparklestore_Pro_Customize_Heading(
           $wp_customize,
           'main-header-padding-margin-msg',
           array(
               'label'   => esc_html__( 'Margin & Padding', 'sparklestore-pro' ),
               'section' => 'sparklewp_header_main',
           )
       )
   );

   /* Margin*/
   $wp_customize->add_setting(
       'header-main-margin',
       array(
           'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
           'default'           => $header_defaults['header-main-margin'],
           'transport'         => 'postMessage',
       )
   );
   $wp_customize->add_control(
       new SparkleWP_Custom_Control_Cssbox(
           $wp_customize,
           'header-main-margin',
           array(
               'label'    => esc_html__( 'Margin', 'sparklestore-pro' ),
               'section'  => 'sparklewp_header_main',
               'settings' => 'header-main-margin',
           ),
           array(),
           array()
       )
   );

   /* Padding*/
   $wp_customize->add_setting(
       'header-main-padding',
       array(
           'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
           'default'           => $header_defaults['header-main-padding'],
           'transport'         => 'postMessage',
       )
   );
   $wp_customize->add_control(
       new SparkleWP_Custom_Control_Cssbox(
           $wp_customize,
           'header-main-padding',
           array(
               'label'    => esc_html__( 'Padding', 'sparklestore-pro' ),
               'section'  => 'sparklewp_header_main',
               'settings' => 'header-main-padding',
           ),
           array(),
           array()
       )
   );

   /*Middle Row*/
   $wp_customize->add_setting(
       'main-header-border-styling-msg',
       array(
           'sanitize_callback' => 'wp_kses_post',
       )
   );
   $wp_customize->add_control(
       new Sparklestore_Pro_Customize_Heading(
           $wp_customize,
           'main-header-border-styling-msg',
           array(
               'label'   => esc_html__( 'Border & Box Options', 'sparklestore-pro' ),
               'section' => 'sparklewp_header_main',
           )
       )
   );

   $wp_customize->add_setting(
       'header-main-border-styling',
       array(
           'sanitize_callback' => 'sparklewp_sanitize_field_border',
           'default'           => '',
           // 'transport'         => 'postMessage',
       )
   );
   $wp_customize->add_control(
       new SparkleWP_Custom_Control_Group(
           $wp_customize,
           'header-main-border-styling',
           array(
               'label'    => esc_html__( 'Border & Box', 'sparklestore-pro' ),
               'section'  => 'sparklewp_header_main',
               'settings' => 'header-main-border-styling',
           ),
           array(
               'border-style'     => array(
                   'type'    => 'select',
                   'label'   => esc_html__( 'Border Style', 'sparklestore-pro' ),
                   'options' => sparklewp_header_border_style(),
               ),
               'border-width'     => array(
                   'type'       => 'cssbox',
                   'label'      => esc_html__( 'Border Width', 'sparklestore-pro' ),
                   'class'      => 'spwp-element-show',
                   'box_fields' => array(
                       'top'    => true,
                       'right'  => true,
                       'bottom' => true,
                       'left'   => true,
                   ),
                   'attr'       => array(
                       'min'       => 0,
                       'max'       => 1000,
                       'step'      => 1,
                       'link'      => 1,
                       'devices'   => array(
                           'desktop' => array(
                               'icon' => 'dashicons-laptop',
                           ),
                       ),
                       'link_text' => esc_html__( 'Link', 'sparklestore-pro' ),
                   ),
               ),
               'border-color'     => array(
                   'type'  => 'color',
                   'label' => esc_html__( 'Border Color', 'sparklestore-pro' ),
               ),
               'border-radius'    => array(
                   'type'       => 'cssbox',
                   'label'      => esc_html__( 'Border Radius', 'sparklestore-pro' ),
                   'class'      => 'spwp-element-show',
                   'box_fields' => array(
                       'top'    => true,
                       'right'  => true,
                       'bottom' => true,
                       'left'   => true,
                   ),
                   'attr'       => array(
                       'min'       => 0,
                       'max'       => 1000,
                       'step'      => 1,
                       'link'      => 1,
                       'devices'   => array(
                           'desktop' => array(
                               'icon' => 'dashicons-laptop',
                           ),
                       ),
                       'link_text' => esc_html__( 'Link', 'sparklestore-pro' ),
                   ),
               ),
               'box-shadow-color' => array(
                   'type'  => 'color',
                   'label' => esc_html__( 'Box Shadow Color', 'sparklestore-pro' ),
               ),
               'box-shadow-css'   => array(
                   'type'       => 'cssbox',
                   'class'      => 'spwp-element-show',
                   'box_fields' => array(
                       'x'      => true,
                       'Y'      => true,
                       'BLUR'   => true,
                       'SPREAD' => true,
                   ),
                   'attr'       => array(
                       'min'         => 0,
                       'max'         => 1000,
                       'step'        => 1,
                       'link'        => 1,
                       'link_toggle' => false,
                       'devices'     => array(
                           'desktop' => array(
                               'icon' => 'dashicons-laptop',
                           ),
                       ),
                       'link_text'   => esc_html__( 'INSET', 'sparklestore-pro' ),
                   ),
               ),
           )
       )
   );