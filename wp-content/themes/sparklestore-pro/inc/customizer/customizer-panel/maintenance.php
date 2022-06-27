<?php
$customizer_maintenance_mode = of_get_option('customizer_maintenance_mode', '1');
if(!$customizer_maintenance_mode){
    return;
}
/**
 * Sparklestore Pro Theme Customizer
 *
 * @package Sparklestore Pro
 */
$wp_customize->add_section('sparklestore_pro_maintenance_section', array(
    'title' => esc_html__('Maintenance Mode Settings', 'sparklestore-pro'),
    'priority' => -1,
    'description' => '<strong style="color:red">' . esc_html__('Note: Maintenance Screen only appears for non logged in user. Please open the website in another browser as a non logged in user inorder to check.', 'sparklestore-pro') . '</strong>'
));

$wp_customize->add_setting('sparklestore_pro_maintenance_sec_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_pro_maintenance_sec_nav', array(
    'type' => 'tab',
    'section' => 'sparklestore_pro_maintenance_section',
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_maintenance',
                'sparklestore_pro_maintenance_logo',
                'sparklestore_pro_maintenance_title',
                'sparklestore_pro_maintenance_text',
                'sparklestore_pro_maintenance_date',
                'sparklestore_pro_maintenance_shortcode',
                'sparklestore_pro_maintenance_social',
                'sparklestore_pro_maintenance_bg_type',
                'sparklestore_pro_maintenance_banner_image',
                'sparklestore_pro_maintenance_slider_shortcode',
                'sparklestore_pro_maintenance_sliders',
                'sparklestore_pro_maintenance_slider_info',
                'sparklestore_pro_maintenance_slider_pause',
                'sparklestore_pro_maintenance_video',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_maintenance_bg_overlay_color',
                'sparklestore_pro_maintenance_title_color',
                'sparklestore_pro_maintenance_text_color',
                'sparklestore_pro_maintenance_counter_color',
                'sparklestore_pro_maintenance_social_icon_color'
            ),
        ),
    ),
)));

$wp_customize->add_setting('sparklestore_pro_maintenance', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'off',
    'transport' => 'postMessage',
));

$wp_customize->add_control(new Sparklestore_Pro_Switch_Control($wp_customize, 'sparklestore_pro_maintenance', array(
    'section' => 'sparklestore_pro_maintenance_section',
    'label' => esc_html__('Enable Maintenance Mode', 'sparklestore-pro'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'sparklestore-pro'),
        'off' => esc_html__('No', 'sparklestore-pro')
    )
)));

$wp_customize->add_setting('sparklestore_pro_maintenance_logo', array(
    'sanitize_callback' => 'esc_url_raw'
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sparklestore_pro_maintenance_logo', array(
    'section' => 'sparklestore_pro_maintenance_section',
    'label' => esc_html__('Upload Logo', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_maintenance_title', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => esc_html__('WEBSITE UNDER MAINTENANCE', 'sparklestore-pro'),
    'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_maintenance_title', array(
    'section' => 'sparklestore_pro_maintenance_section',
    'type' => 'text',
    'label' => esc_html__('Maintenance Title', 'sparklestore-pro'),
));

$wp_customize->add_setting('sparklestore_pro_maintenance_text', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => esc_html__('We are coming soon with new changes. Stay Tuned!', 'sparklestore-pro'),
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Page_Editor($wp_customize, 'sparklestore_pro_maintenance_text', array(
    'section' => 'sparklestore_pro_maintenance_section',
    'label' => esc_html__('Maintenance Text', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_maintenance_date', array(
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Date_Control($wp_customize, 'sparklestore_pro_maintenance_date', array(
    'section' => 'sparklestore_pro_maintenance_section',
    'label' => esc_html__('Maintenance Date', 'sparklestore-pro'),
    'description' => esc_html__('Choose the Date when you plan to make your website live.', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_maintenance_shortcode', array(
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_maintenance_shortcode', array(
    'section' => 'sparklestore_pro_maintenance_section',
    'type' => 'text',
    'label' => esc_html__('Maintenance ShortCode', 'sparklestore-pro'),
    'description' => esc_html__('Add the ShortCode for mailchimp or any other content that you want to show', 'sparklestore-pro')
));

$wp_customize->add_setting('sparklestore_pro_maintenance_social', array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new Sparklestore_Pro_Info_Text($wp_customize, 'sparklestore_pro_maintenance_social', array(
    'label' => esc_html__('Social Icons', 'sparklestore-pro'),
    'section' => 'sparklestore_pro_maintenance_section',
    'description' => sprintf(esc_html__('Add your %s here', 'sparklestore-pro'), '<a class="customizer-sociallink" href="#" target="_blank">Social Icons</a>')
)));

$wp_customize->add_setting('sparklestore_pro_maintenance_bg_type', array(
    'default' => 'banner',
    'sanitize_callback' => 'sparklestore_pro_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_maintenance_bg_type', array(
    'section' => 'sparklestore_pro_maintenance_section',
    'type' => 'radio',
    'label' => esc_html__('Maintenance Background Type', 'sparklestore-pro'),
    'choices' => array(
        'banner' => esc_html__('Banner Image', 'sparklestore-pro'),
        'slider' => esc_html__('Image Slider', 'sparklestore-pro'),
        'revolution' => esc_html__('Revolution Slider', 'sparklestore-pro'),
        'video' => esc_html__('Video', 'sparklestore-pro')
    )
));

$wp_customize->add_setting('sparklestore_pro_maintenance_banner_image', array(
    'sanitize_callback' => 'esc_url_raw',
    'default' => get_template_directory_uri() . '/assets/images/bg.jpg',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sparklestore_pro_maintenance_banner_image', array(
    'section' => 'sparklestore_pro_maintenance_section',
    'label' => esc_html__('Upload Banner Image', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_maintenance_slider_shortcode', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_maintenance_slider_shortcode', array(
    'section' => 'sparklestore_pro_maintenance_section',
    'type' => 'text',
    'label' => esc_html__('Slider ShortCode', 'sparklestore-pro'),
    'description' => esc_html__('Add the ShortCode for Slider', 'sparklestore-pro')
));

$wp_customize->add_setting('sparklestore_pro_maintenance_sliders', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_repeater',
    'transport' => 'postMessage',
    'default' => json_encode(array(
        array(
            'image' => ''
        )
    ))
));

$wp_customize->add_control(new Sparklestore_Pro_Repeater_Control($wp_customize, 'sparklestore_pro_maintenance_sliders', array(
    'label' => esc_html__('Add Sliders', 'sparklestore-pro'),
    'section' => 'sparklestore_pro_maintenance_section',
    'box_label' => esc_html__('Slider', 'sparklestore-pro'),
    'add_label' => esc_html__('Add Slider', 'sparklestore-pro')
        ), array(
    'image' => array(
        'type' => 'upload',
        'label' => esc_html__('Upload Image', 'sparklestore-pro'),
        'default' => ''
    )
)));

$wp_customize->add_setting('sparklestore_pro_maintenance_slider_info', array(
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Info_Text($wp_customize, 'sparklestore_pro_maintenance_slider_info', array(
    'section' => 'sparklestore_pro_maintenance_section',
    'label' => esc_html__('Note:', 'sparklestore-pro'),
    'description' => esc_html__('Recommended Image Size: 1900X1000', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_maintenance_slider_pause', array(
    'default' => '5',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Range_Control($wp_customize, 'sparklestore_pro_maintenance_slider_pause', array(
    'section' => 'sparklestore_pro_maintenance_section',
    'label' => esc_html__('Slider Pause Duration', 'sparklestore-pro'),
    'description' => esc_html__('Slider Pause duration in seconds', 'sparklestore-pro'),
    'input_attrs' => array(
        'min' => 2,
        'max' => 10,
        'step' => 1,
    )
)));

$wp_customize->add_setting('sparklestore_pro_maintenance_video', array(
    'default' => 'DJlmVOSEvGA',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_maintenance_video', array(
    'section' => 'sparklestore_pro_maintenance_section',
    'type' => 'text',
    'label' => esc_html__('Video Id', 'sparklestore-pro'),
    'description' => 'https://www.youtube.com/watch?v=<strong>DJlmVOSEvGA</strong>. ' . esc_html__('Add only DJlmVOSEvGA', 'sparklestore-pro')
));

$wp_customize->add_setting('sparklestore_pro_maintenance_bg_overlay_color', array(
    'default' => 'rgba(255,255,255,0)',
    'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_maintenance_bg_overlay_color', array(
    'label' => esc_html__('Background Overlay Color', 'sparklestore-pro'),
    'section' => 'sparklestore_pro_maintenance_section',
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
    )
)));

$wp_customize->add_setting('sparklestore_pro_maintenance_title_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_maintenance_title_color', array(
    'section' => 'sparklestore_pro_maintenance_section',
    'label' => esc_html__('Title Color', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_maintenance_text_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_maintenance_text_color', array(
    'section' => 'sparklestore_pro_maintenance_section',
    'label' => esc_html__('Text Color', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_maintenance_counter_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_maintenance_counter_color', array(
    'section' => 'sparklestore_pro_maintenance_section',
    'label' => esc_html__('Counter Color', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_maintenance_social_icon_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_maintenance_social_icon_color', array(
    'section' => 'sparklestore_pro_maintenance_section',
    'label' => esc_html__('Social Icon Color', 'sparklestore-pro')
)));