<?php
$customizer_gdpr_settings = of_get_option('customizer_gdpr_settings', '1');

if (!$customizer_gdpr_settings) {
    return;
}

/**
 * @package Sparkle Store Pro
 */

/**
 *  GDPR SETTINGS PANEL 
 */

$wp_customize->add_section('sparklestore_pro_gdpr_section', array(
    'title' => esc_html__('GDPR Settings', 'sparklestore-pro'),
    'priority' => 40,
    'description' => esc_html__('Use it add GDPR Compliance, Cookies Consent or any other Promotional Stuffs.', 'sparklestore-pro')
));

$wp_customize->add_setting('sparklestore_pro_gdpr_nav', array(
    // 'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_pro_gdpr_nav', array(
    'type' => 'tab',
    'section' => 'sparklestore_pro_gdpr_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_gdpr_position',
                'sparklestore_pro_gdpr_notice',
                'sparklestore_pro_gdpr_confirm_button_text',
                'sparklestore_pro_gdpr_button_text',
                'sparklestore_pro_gdpr_button_link',
                'sparklestore_pro_gdpr_new_tab',
                'sparklestore_pro_gdpr_hide_mobile'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_gdpr_bg',
                'sparklestore_pro_gdpr_text_color',
                'sparklestore_pro_button_bg_color',
                'sparklestore_pro_button_text_color'
            ),
        )
    ),
)));

$wp_customize->add_setting('sparklestore_pro_enable_gdpr', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'off',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Switch_Control($wp_customize, 'sparklestore_pro_enable_gdpr', array(
    'section' => 'sparklestore_pro_gdpr_section',
    'label' => esc_html__('Activate GDPR Notice', 'sparklestore-pro'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'sparklestore-pro'),
        'off' => esc_html__('No', 'sparklestore-pro')
    )
)));

$wp_customize->add_setting('sparklestore_pro_gdpr_position', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'bottom-full-width',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_gdpr_position', array(
    'section' => 'sparklestore_pro_gdpr_section',
    'type' => 'select',
    'label' => esc_html__('Select Position', 'sparklestore-pro'),
    'choices' => array(
        'top-full-width' => esc_html__('Top - Full Width', 'sparklestore-pro'),
        'bottom-full-width' => esc_html__('Bottom - Full Width', 'sparklestore-pro'),
        'bottom-left-float' => esc_html__('Bottom Left - Float', 'sparklestore-pro'),
        'bottom-right-float' => esc_html__('Bottom Right - Float', 'sparklestore-pro')
    )
));

$wp_customize->add_setting('sparklestore_pro_gdpr_bg', array(
    'default' => '#333333',
    'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_gdpr_bg', array(
    'label' => esc_html__('Background Color', 'sparklestore-pro'),
    'section' => 'sparklestore_pro_gdpr_section',
    'palette' => array(
        '#FFFFFF',
        '#000000',
        '#f5245f',
        '#1267b3',
        '#feb600',
        '#00C569',
        'rgba( 255, 255, 255, 0.2 )',
        'rgba( 0, 0, 0, 0.2 )'
    )
)));

$wp_customize->add_setting('sparklestore_pro_gdpr_notice', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => esc_html__('Our website use cookies to improve and personalize your experience and to display advertisements(if any). Our website may also include cookies from third parties like Google Adsense, Google Analytics, Youtube. By using the website, you consent to the use of cookies. We’ve updated our Privacy Policy. Please click on the button to check our Privacy Policy.', 'sparklestore-pro'),
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Page_Editor($wp_customize, 'sparklestore_pro_gdpr_notice', array(
    'section' => 'sparklestore_pro_gdpr_section',
    'label' => esc_html__('GDPR Notice', 'sparklestore-pro'),
    'include_admin_print_footer' => true
)));

$wp_customize->add_setting('sparklestore_pro_gdpr_text_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_gdpr_text_color', array(
    'section' => 'sparklestore_pro_gdpr_section',
    'label' => esc_html__('Text Color', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_gdpr_confirm_button_text', array(
    'default' => esc_html__('Ok, I Agree', 'sparklestore-pro'),
    'sanitize_callback' => 'sanitize_text_field',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_gdpr_confirm_button_text', array(
    'section' => 'sparklestore_pro_gdpr_section',
    'type' => 'text',
    'label' => esc_html__('Confirm Button Text', 'sparklestore-pro'),
    'description' => esc_html__('This button closes the GDPR section. Once you close it, the section will not appear for 1 day.', 'sparklestore-pro')
));

$wp_customize->add_setting('sparklestore_pro_gdpr_button_text', array(
    'default' => esc_html__('Privacy Policy', 'sparklestore-pro'),
    'sanitize_callback' => 'sanitize_text_field',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_gdpr_button_text', array(
    'section' => 'sparklestore_pro_gdpr_section',
    'type' => 'text',
    'label' => esc_html__('GDPR Notice Button Text', 'sparklestore-pro'),
));

$wp_customize->add_setting('sparklestore_pro_gdpr_button_link', array(
    'sanitize_callback' => 'esc_url_raw',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_gdpr_button_link', array(
    'section' => 'sparklestore_pro_gdpr_section',
    'type' => 'text',
    'label' => esc_html__('GDPR Notice Page Link', 'sparklestore-pro'),
    'description' => esc_html__('Leave blank if you don\'t want to show', 'sparklestore-pro')
));

$wp_customize->add_setting('sparklestore_pro_gdpr_new_tab', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => true,
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_gdpr_new_tab', array(
    'section' => 'sparklestore_pro_gdpr_section',
    'label' => esc_html__('Open Link in New Tab', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_button_bg_color', array(
    'default' => '#f33c3c',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_button_bg_color', array(
    'section' => 'sparklestore_pro_gdpr_section',
    'label' => esc_html__('Button Background Color', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_button_text_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_button_text_color', array(
    'section' => 'sparklestore_pro_gdpr_section',
    'label' => esc_html__('Button Text Color', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_gdpr_hide_mobile', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => false,
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_gdpr_hide_mobile', array(
    'section' => 'sparklestore_pro_gdpr_section',
    'label' => esc_html__('Hide Section in Mobile', 'sparklestore-pro')
)));

$wp_customize->selective_refresh->add_partial('sparklestore_pro_gdpr_button_text', array(
    'selector' => '.sparklestore-pro-privacy-policy',
    'render_callback' => 'sparklestore_pro_gdpr_notice',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('sparklestore_pro_gdpr_button_link', array(
    'selector' => '.sparklestore-pro-privacy-policy',
    'render_callback' => 'sparklestore_pro_gdpr_notice',
    'container_inclusive' => true
));
