<?php
/**
 * Sparkle Themes Theme Customizer
 *
 * @package Sparkle Themes
 */

/**
 * General Settings Panel
*/
$wp_customize->add_panel('sparklestore_pro_general_settings', array(
    'capabitity' => 'edit_theme_options',
    'priority' => 4,
    'title' => esc_html__('General Settings', 'sparklestore-pro')
 ));
 
$wp_customize->get_section('background_image')->panel = 'sparklestore_pro_general_settings';
     
     

//GENERAL SETTINGS
$wp_customize->add_section('sparkle_store_pro_general_options_section', array(
    'title' => esc_html__('General Options', 'sparklestore-pro'),
    'panel' => 'sparklestore_pro_general_settings'
));

$wp_customize->add_setting('sparkle_store_pro_style_option', array(
    'default' => 'head',
    'sanitize_callback' => 'sparklestore_pro_sanitize_select',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('sparkle_store_pro_style_option', array(
    'section' => 'sparkle_store_pro_general_options_section',
    'type' => 'radio',
    'label' => esc_html__('Dynamic Style Option', 'sparklestore-pro'),
    'choices' => array(
        'head' => esc_html__('WP Head', 'sparklestore-pro'),
        'file' => esc_html__('Custom File', 'sparklestore-pro')
    ),
    'description' => esc_html__('WP Head option will save the custom CSS in the header of the HTML file and Custom file option will save the custom CSS in a seperate file.', 'sparklestore-pro')
));

$wp_customize->add_setting('sparklestore_pro_web_page_layout_options', array(
    'default' => 'wide',
    'sanitize_callback' => 'sparklestore_pro_sanitize_select',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_web_page_layout_options', array(
    'section' => 'sparkle_store_pro_general_options_section',
    'type' => 'radio',
    'label' => esc_html__('Website Layout', 'sparklestore-pro'),
    'choices' => array(
        'wide' => esc_html__('Wide', 'sparklestore-pro'),
        'boxed' => esc_html__('Boxed', 'sparklestore-pro')
    )
));

$wp_customize->add_setting('sparklestore_pro_website_container_width', array(
    'default' => 1220,
    'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank'  // done
));

$wp_customize->add_control('sparklestore_pro_website_container_width', array(
    'type' => 'number',
    'label' => esc_html__('Container Width', 'sparklestore-pro'),
    'section' => 'sparkle_store_pro_general_options_section',
    'settings' => 'sparklestore_pro_website_container_width'
));

$wp_customize->add_setting('sparkle_store_pro_scroll_animation_seperator', array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new Sparklestore_Pro_Separator_Control($wp_customize, 'sparkle_store_pro_scroll_animation_seperator', array(
    'section' => 'sparkle_store_pro_general_options_section'
)));

$wp_customize->add_setting('sparkle_store_pro_backtotop', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => true
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparkle_store_pro_backtotop', array(
    'section' => 'sparkle_store_pro_general_options_section',
    'label' => esc_html__('Back to Top Button', 'sparklestore-pro'),
    'description' => esc_html__('A button on click scrolls to the top of the page.', 'sparklestore-pro')
)));

$wp_customize->add_section( 'sparklestore_pro_per_loader_settings', array(
    'title' => esc_html__( 'Preloader Settings', 'sparklestore-pro' ),
    'priority' => 2,
    'panel' => 'sparklestore_pro_general_settings'
));

    $wp_customize->add_setting('sparklestore_pro_per_loader_settings_nav', array(
        // 'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_pro_per_loader_settings_nav', array(
        'type' => 'tab',
        'section' => 'sparklestore_pro_per_loader_settings',
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'sparklestore-pro'),
                'fields' => array(
                    'sparklestore_pro_preloader_options',
                    'sparklestore_pro_preloader',
                    'sparkle_store_pro_preloader_image'
                ),
                'active' => true,
            ),
            array(
                'name' => esc_html__('Style', 'sparklestore-pro'),
                'fields' => array(
                    'sparkle_store_pro_preloader_color',
                    'sparkle_store_pro_preloader_bg_color'
                ),
            ),
        ),
    )));

    $wp_customize->add_setting( 'sparklestore_pro_preloader_options', array( 
        'default' => 1,
        'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox' 
    ));

    $wp_customize->add_control( 'sparklestore_pro_preloader_options', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Check to Disable Preloader', 'sparklestore-pro' ),
        'section' => 'sparklestore_pro_per_loader_settings',
        'settings' => 'sparklestore_pro_preloader_options',
    ));

    $wp_customize->add_setting('sparklestore_pro_preloader', array(
        'default' => 'preloader15',
        'sanitize_callback' => 'sparklestore_pro_sanitize_choices',
        //'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Image_Select($wp_customize, 'sparklestore_pro_preloader', array(
        'section' => 'sparklestore_pro_per_loader_settings',
        'type' => 'select',
        'label' => esc_html__('Preloader Type', 'sparklestore-pro'),
        'image_path' => $imagepath . '/inc/customizer/images/preloader/',
        'choices' => array(
            'preloader1' => esc_html__('Preloader 1', 'sparklestore-pro'),
            'preloader2' => esc_html__('Preloader 2', 'sparklestore-pro'),
            'preloader3' => esc_html__('Preloader 3', 'sparklestore-pro'),
            'preloader4' => esc_html__('Preloader 4', 'sparklestore-pro'),
            'preloader5' => esc_html__('Preloader 5', 'sparklestore-pro'),
            'preloader6' => esc_html__('Preloader 6', 'sparklestore-pro'),
            'preloader7' => esc_html__('Preloader 7', 'sparklestore-pro'),
            'preloader8' => esc_html__('Preloader 8', 'sparklestore-pro'),
            'preloader9' => esc_html__('Preloader 9', 'sparklestore-pro'),
            'preloader10' => esc_html__('Preloader 10', 'sparklestore-pro'),
            'preloader11' => esc_html__('Preloader 11', 'sparklestore-pro'),
            'preloader12' => esc_html__('Preloader 12', 'sparklestore-pro'),
            'preloader13' => esc_html__('Preloader 13', 'sparklestore-pro'),
            'preloader14' => esc_html__('Preloader 14', 'sparklestore-pro'),
            'preloader15' => esc_html__('Preloader 15', 'sparklestore-pro'),
            'preloader16' => esc_html__('Preloader 16', 'sparklestore-pro'),
            'custom' => esc_html__('Custom', 'sparklestore-pro')
        )
    )));
    
    $wp_customize->add_setting('sparkle_store_pro_preloader_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        // 'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparkle_store_pro_preloader_color', array(
        'section' => 'sparklestore_pro_per_loader_settings',
        'label' => esc_html__('Preloader Text Color', 'sparklestore-pro')
    )));
    
    $wp_customize->add_setting('sparkle_store_pro_preloader_image', array(
        'sanitize_callback' => 'esc_url_raw',
        // 'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sparkle_store_pro_preloader_image', array(
        'section' => 'sparklestore_pro_per_loader_settings',
        'description' => esc_html__('Custom Preloader Image - gif image is preferable', 'sparklestore-pro')
    )));
    
    $wp_customize->add_setting('sparkle_store_pro_preloader_bg_color', array(
        'default' => 'rgba(0,0,0,0.0.8)',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
        // 'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparkle_store_pro_preloader_bg_color', array(
        'section' => 'sparklestore_pro_per_loader_settings',
        'label' => esc_html__('Preloader Background Color', 'sparklestore-pro')
    )));




//ADMIN LOGO
$wp_customize->add_section('sparklestore_pro_admin_logo_section', array(
    'title' => esc_html__('Admin Logo', 'sparklestore-pro'),
    'panel' => 'sparklestore_pro_general_settings',
    'description' => esc_html__('The logo will appear in the admin login page.', 'sparklestore-pro')
));

    $wp_customize->add_setting('sparklestore_pro_admin_logo', array(
        'sanitize_callback' => 'esc_url_raw',
        // 'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sparklestore_pro_admin_logo', array(
        'section' => 'sparklestore_pro_admin_logo_section',
        'label' => esc_html__('Upload Admin Logo', 'sparklestore-pro'),
    )));

    $wp_customize->add_setting('sparklestore_pro_admin_bg', array(
        'sanitize_callback' => 'esc_url_raw',
        // 'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sparklestore_pro_admin_bg', array(
        'section' => 'sparklestore_pro_admin_logo_section',
        'label' => esc_html__('Upload Admin Background', 'sparklestore-pro'),
    )));

    $wp_customize->add_setting('sparklestore_pro_admin_logo_width', array(
        'sanitize_callback' => 'absint',
        'default' => 180,
        // 'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Range_Control($wp_customize, 'sparklestore_pro_admin_logo_width', array(
        'section' => 'sparklestore_pro_admin_logo_section',
        'label' => esc_html__('Logo Width', 'sparklestore-pro'),
        'input_attrs' => array(
            'min' => 80,
            'max' => 320,
            'step' => 1
        )
    )));

    $wp_customize->add_setting('sparklestore_pro_admin_logo_height', array(
        'sanitize_callback' => 'absint',
        'default' => 80,
        // 'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Range_Control($wp_customize, 'sparklestore_pro_admin_logo_height', array(
        'section' => 'sparklestore_pro_admin_logo_section',
        'label' => esc_html__('Logo Height', 'sparklestore-pro'),
        'input_attrs' => array(
            'min' => 30,
            'max' => 100,
            'step' => 1
        )
    )));

    $wp_customize->add_setting('sparklestore_pro_admin_logo_link', array(
        'sanitize_callback' => 'esc_url_raw',
        // 'transport' => 'postMessage'
    ));

    $wp_customize->add_control('sparklestore_pro_admin_logo_link', array(
        'section' => 'sparklestore_pro_admin_logo_section',
        'type' => 'text',
        'label' => esc_html__('Admin Logo Link', 'sparklestore-pro'),
        'description' => esc_html__('This is the url that is opened when clicked on the admin logo.', 'sparklestore-pro')
    ));

//Default Image
$wp_customize->add_section('sparklestore_pro_default_image_section', array(
    'title' => esc_html__('Default Image', 'sparklestore-pro'),
    'panel' => 'sparklestore_pro_general_settings',
    'description' => esc_html__('Default image for every place where image required but not found', 'sparklestore-pro')
));

    $wp_customize->add_setting('sparklestore_pro_default_image', array(
        'sanitize_callback' => 'esc_url_raw',
        // 'transport' => 'postMessage'
    ));

    // Registers example_background settings
    $wp_customize->add_setting("sparklestore_pro_default_image", array(
        'sanitize_callback' => 'esc_url_raw',
        //'transport' => 'postMessage'
    ));
    
    $wp_customize->add_setting("sparklestore_pro_default_image_id", array(
        'sanitize_callback' => 'absint',
        //'transport' => 'postMessage'
    ));
    
    // Registers example_background control
    $wp_customize->add_control(new Sparklestore_Pro_Background_Control($wp_customize, "sparklestore_pro_default_image", array(
        'label' => esc_html__('Default Image', 'sparklestore-pro'),
        'section' => 'sparklestore_pro_default_image_section',
        'settings' => array(
            'image_url' => "sparklestore_pro_default_image",
            'image_id' => "sparklestore_pro_default_image_id"
        ),
        
    )));
