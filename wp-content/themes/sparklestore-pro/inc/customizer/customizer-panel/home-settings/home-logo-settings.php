<?php
/**
 * Clients Section
*/
$wp_customize->add_section(new Sparklestore_Pro_Toggle_Section($wp_customize, 'sparklestore_pro_logo_section', array(
    'title' => esc_html__('Brand/Client Logo settings', 'sparklestore-pro'),
    'hiding_control' => 'sparklestore_pro_logo_section_disable'
)));

//ENABLE/DISABLE LOGO SECTION
$wp_customize->add_setting('sparklestore_pro_logo_section_disable', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'off'
));

$wp_customize->add_control(new Sparklestore_Pro_Switch_Control($wp_customize, 'sparklestore_pro_logo_section_disable', array(
    'section' => 'sparklestore_pro_logo_section',
    'label' => esc_html__('Disable Section', 'sparklestore-pro'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'sparklestore-pro'),
        'off' => esc_html__('No', 'sparklestore-pro')
    ),
    'class' => 'switch-section',
    'priority' => -1
)));

$wp_customize->add_setting('sparklestore_pro_logo_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_pro_logo_nav', array(
    'type' => 'tab',
    'section' => 'sparklestore_pro_logo_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_logo_title_subtitle_heading',
                'sparklestore_pro_logo_title',
                'sparklestore_pro_logo_sub_title',
                'sparklestore_pro_logo_title_style',
                'sparklestore_pro_logo_header',
                'sparklestore_pro_brand_logo_options',
                'sparklestore_pro_logo_new_tab',
                'sparklestore_pro_logo_setting_heading',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_logo_style',
                'sparklestore_pro_logo_cs_heading',
                'sparklestore_pro_logo_sub_title_color',
                'sparklestore_pro_logo_title_color'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_logo_bottom_seperator',
                'sparklestore_pro_logo_bs_color',
                'sparklestore_pro_logo_bs_height',
                'sparklestore_pro_logo_bg_type',
                'sparklestore_pro_logo_bg_color',
                'sparklestore_pro_logo_bg_gradient',
                'sparklestore_pro_logo_bg_image',
                'sparklestore_pro_logo_parallax_effect',
                'sparklestore_pro_logo_bg_video',
                'sparklestore_pro_logo_overlay_color'

            ),
        ),
    ),
)));

$wp_customize->add_setting('sparklestore_pro_logo_title_subtitle_heading', array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_logo_title_subtitle_heading', array(
    'section' => 'sparklestore_pro_logo_section',
    'label' => esc_html__('Section Title & Sub Title', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_logo_title_style', array(
    'default' => 'sp-section-title-top-center',
    'sanitize_callback' => 'sparklestore_pro_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_logo_title_style', array(
    'section' => 'sparklestore_pro_logo_section',
    'type' => 'select',
    'label' => esc_html__('Title Style', 'sparklestore-pro'),
    'choices' => array(
        'sp-section-title-top-center' => esc_html__('Top Center Aligned', 'sparklestore-pro'),
        'sp-section-title-top-cs' => esc_html__('Top Center Aligned with Seperator', 'sparklestore-pro'),
        'sp-section-title-top-left' => esc_html__('Top Left Aligned', 'sparklestore-pro'),
        'sp-section-title-top-ls' => esc_html__('Top Left Aligned with Seperator', 'sparklestore-pro'),
        'sp-section-title-single-row' => esc_html__('Top Single Row', 'sparklestore-pro'),
        'sp-section-title-big' => esc_html__('Top Center Aligned with Big Title', 'sparklestore-pro')
    )
));


$wp_customize->add_setting('sparklestore_pro_logo_title', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => esc_html__('Client Logo Section', 'sparklestore-pro'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_logo_title', array(
    'section' => 'sparklestore_pro_logo_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'sparklestore-pro')
));

$wp_customize->add_setting('sparklestore_pro_logo_sub_title', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => esc_html__('Clients Logo Section SubTitle', 'sparklestore-pro'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_logo_sub_title', array(
    'section' => 'sparklestore_pro_logo_section',
    'type' => 'textarea',
    'label' => esc_html__('Sub Title', 'sparklestore-pro')
));
//CLIENTS LOGOS
$wp_customize->add_setting('sparklestore_pro_logo_header', array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_logo_header', array(
    'section' => 'sparklestore_pro_logo_section',
    'label' => esc_html__('Clients Logos', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_brand_logo_options', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'image' => '',
            'link' => '',
            'new_tab' => 'off',
            'enable' => 'on'
        )
    )),
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Repeater_Control($wp_customize, 'sparklestore_pro_brand_logo_options', array(
    'section' => 'sparklestore_pro_logo_section',
    'box_label' => esc_html__('Clients Logo', 'sparklestore-pro'),
    'add_label' => esc_html__('Add New', 'sparklestore-pro'),
        ), array(
    'image' => array(
        'type' => 'upload',
        'label' => esc_html__('Upload Logo', 'sparklestore-pro'),
        'default' => ''
    ),
    'link' => array(
        'type' => 'text',
        'label' => esc_html__('Logo Link', 'sparklestore-pro'),
        'default' => ''
    ),
    'new_tab' => array(
        'type' => 'switch',
        'label' => esc_html__('Open in new tab?', 'sparklestore-pro'),
        'switch' => array(
            'on' => 'Yes',
            'off' => 'No'
        ),
        'default' => 'off'
    ),
    'enable' => array(
        'type' => 'switch',
        'label' => esc_html__('Enable Section', 'sparklestore-pro'),
        'switch' => array(
            'on' => 'Yes',
            'off' => 'No'
        ),
        'default' => 'on'
    )
)));

$wp_customize->add_setting('sparklestore_pro_logo_style', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'style1',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Selector($wp_customize, 'sparklestore_pro_logo_style', array(
    'section' => 'sparklestore_pro_logo_section',
    'label' => esc_html__('Logo Style', 'sparklestore-pro'),
    'options' => array(
        'style1' => $imagepath . '/inc/customizer/images/logo-style1.png',
        'style3' => $imagepath . '/inc/customizer/images/logo-style3.png',
        'style4' => $imagepath . '/inc/customizer/images/logo-style4.png',
    )
)));



$wp_customize->add_setting('sparklestore_pro_logo_bottom_seperator', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'none',
    'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_logo_bottom_seperator', array(
    'section' => 'sparklestore_pro_logo_section',
    'type' => 'select',
    'label' => esc_html__('Bottom Seperator', 'sparklestore-pro'),
    'choices' => array_merge(array('none' => 'None'), sparklestore_pro_svg_seperator())
));

$wp_customize->add_setting('sparklestore_pro_logo_bs_color', array(
    'default' => '#FF0000',
    'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_logo_bs_color', array(
    'section' => 'sparklestore_pro_logo_section',
    'label' => esc_html__('Bottom Seperator Color', 'sparklestore-pro')
)));

$wp_customize->add_setting("sparklestore_pro_logo_bs_height", array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
    'default' => 60,
    'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_logo_bs_height_tablet", array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
    'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_logo_bs_height_mobile", array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Range_Slider_Control($wp_customize, "sparklestore_pro_logo_bs_height", array(
    'section' => 'sparklestore_pro_logo_section',
    'label' => esc_html__('Bottom Seperator Height (px)', 'sparklestore-pro'),
    'input_attrs' => array(
        'min' => 20,
        'max' => 200,
        'step' => 1,
    ),
    'settings' => array(
        'desktop' => "sparklestore_pro_logo_bs_height",
        'tablet' => "sparklestore_pro_logo_bs_height_tablet",
        'mobile' => "sparklestore_pro_logo_bs_height_mobile",
    )
)));


$wp_customize->add_setting("sparklestore_pro_logo_bg_type", array(
    'default' => 'color-bg',
    'sanitize_callback' => 'sparklestore_pro_sanitize_select',
    'transport' => 'postMessage'
));

$wp_customize->add_control("sparklestore_pro_logo_bg_type", array(
    'section' => "sparklestore_pro_logo_section",
    'type' => 'select',
    'label' => esc_html__('Background Type', 'sparklestore-pro'),
    'choices' => array(
        'color-bg' => esc_html__('Color Background', 'sparklestore-pro'),
        'gradient-bg' => esc_html__('Gradient Background', 'sparklestore-pro'),
        'image-bg' => esc_html__('Image Background', 'sparklestore-pro'),
        'video-bg' => esc_html__('Video Background', 'sparklestore-pro')
    ),
    'priority' => 15
));

$wp_customize->add_setting("sparklestore_pro_logo_bg_color", array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "sparklestore_pro_logo_bg_color", array(
    'section' => "sparklestore_pro_logo_section",
    'label' => esc_html__('Background Color', 'sparklestore-pro'),
    'priority' => 20
)));

$wp_customize->add_setting("sparklestore_pro_logo_bg_gradient", array(
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Gradient_Control($wp_customize, "sparklestore_pro_logo_bg_gradient", array(
    'section' => "sparklestore_pro_logo_section",
    'label' => esc_html__('Gradient Background', 'sparklestore-pro'),
    'priority' => 25
)));

// Registers example_background settings
$wp_customize->add_setting("sparklestore_pro_logo_bg_image_url", array(
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_logo_bg_image_id", array(
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_logo_bg_image_repeat", array(
    'default' => 'no-repeat',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_logo_bg_image_size", array(
    'default' => 'cover',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_logo_bg_position", array(
    'default' => 'center-center',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_logo_bg_image_attach", array(
    'default' => 'fixed',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

// Registers example_background control
$wp_customize->add_control(new Sparklestore_Pro_Background_Control($wp_customize, "sparklestore_pro_logo_bg_image", array(
    'label' => esc_html__('Background Image', 'sparklestore-pro'),
    'section' => "sparklestore_pro_logo_section",
    'settings' => array(
        'image_url' => "sparklestore_pro_logo_bg_image_url",
        'image_id' => "sparklestore_pro_logo_bg_image_id",
        'repeat' => "sparklestore_pro_logo_bg_image_repeat", // Use false to hide the field
        'size' => "sparklestore_pro_logo_bg_image_size",
        'position' => "sparklestore_pro_logo_bg_position",
        'attach' => "sparklestore_pro_logo_bg_image_attach"
    ),
    'priority' => 30
)));

$wp_customize->add_setting("sparklestore_pro_logo_parallax_effect", array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'none',
    'transport' => 'postMessage'
));

$wp_customize->add_control("sparklestore_pro_logo_parallax_effect", array(
    'type' => 'radio',
    'section' => "sparklestore_pro_logo_section",
    'label' => esc_html__('Background Effect', 'sparklestore-pro'),
    'choices' => array(
        'none' => esc_html__('None', 'sparklestore-pro'),
        'parallax' => esc_html__('Enable Parallax', 'sparklestore-pro'),
        'scroll' => esc_html__('Horizontal Moving', 'sparklestore-pro')
    ),
    'priority' => 35
));

$wp_customize->add_setting("sparklestore_pro_logo_bg_video", array(
    'default' => '6O9Nd1RSZSY',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control("sparklestore_pro_logo_bg_video", array(
    'section' => "sparklestore_pro_logo_section",
    'type' => 'text',
    'label' => esc_html__('Youtube Video ID', 'sparklestore-pro'),
    'description' => esc_html__('https://www.youtube.com/watch?v=yNAsk4Zw2p0. Add only yNAsk4Zw2p0', 'sparklestore-pro'),
    'priority' => 40
));

$wp_customize->add_setting("sparklestore_pro_logo_overlay_color", array(
    'default' => 'rgba(255,255,255,0)',
    'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, "sparklestore_pro_logo_overlay_color", array(
    'label' => esc_html__('Background Overlay Color', 'sparklestore-pro'),
    'section' => "sparklestore_pro_logo_section",
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
    'priority' => 45
)));

$wp_customize->add_setting("sparklestore_pro_logo_cs_heading", array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, "sparklestore_pro_logo_cs_heading", array(
    'section' => "sparklestore_pro_logo_section",
    'label' => esc_html__('Color Settings', 'sparklestore-pro'),
)));



$wp_customize->add_setting('sparklestore_pro_logo_title_color', array(
    'default' => '#FF0000',
    'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_logo_title_color', array(
    'section' => 'sparklestore_pro_logo_section',
    'label' => esc_html__('Title Color', 'sparklestore-pro')
)));


$wp_customize->add_setting('sparklestore_pro_logo_sub_title_color', array(
    'default' => '#FF0000',
    'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_logo_sub_title_color', array(
    'section' => 'sparklestore_pro_logo_section',
    'label' => esc_html__('Sub Title Color', 'sparklestore-pro')
)));


$wp_customize->selective_refresh->add_partial('sparklestore_pro_logo_title_style', array(
    'selector' => '.cl-logo-section',
    'render_callback' => 'sparklestore_pro_logo_section',
    'container_inclusive' => true
));
