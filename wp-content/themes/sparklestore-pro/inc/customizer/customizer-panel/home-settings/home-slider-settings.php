<?php
/**
 * Main Slider Section 
*/

$wp_customize->add_section(new Sparklestore_Pro_Toggle_Section($wp_customize, 'sparklestore_pro_slider_section', array(
    'title' => esc_html__('Home Slider', 'sparklestore-pro'),
    'priority' => 12,
    'hiding_control' => 'sparklestore_pro_slider_section_section',
)));

$wp_customize->add_setting('sparklestore_pro_slider_nav', array(
    // 'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

//ENABLE/DISABLE SLIDER
$wp_customize->add_setting('sparklestore_pro_slider_section_section', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'off'
));

$wp_customize->add_control(new Sparklestore_Pro_Switch_Control($wp_customize, 'sparklestore_pro_slider_section_section', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Disable Section', 'sparklestore-pro'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'sparklestore-pro'),
        'off' => esc_html__('No', 'sparklestore-pro')
    ),
    'class' => 'switch-section'
)));

$wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_pro_slider_nav', array(
    'type' => 'tab',
    'section' => 'sparklestore_pro_slider_section',
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_homepage_slider_type',
                'sparklestore_pro_slider_heading',
                'sparklestore_pro_banner_all_sliders',
                'sparklestore_pro_slider_info',
                'sparklestore_pro_slider',
                'sparklestore_pro_advance_sliders',
                'sparklestore_pro_slider_layout',
                'sparklestore_pro_slider_setting_heading',
                'sparklestore_pro_slider_pause',
                'sparklestore_pro_slider_full_screen',
                'sparklestore_pro_slider_arrow',
                'sparklestore_pro_slider_dots',
                'sparklestore_pro_slider_loop',
                'sparklestore_pro_slider_auto_play',
                'sparklestore_pro_slider_mouse_drag',
                'sparklestore_pro_banner_image',
                'sparklestore_pro_banner_promo_image',
                'sparklestore_pro_banner_title',
                'sparklestore_pro_banner_subtitle',
                'sparklestore_pro_banner_button_text',
                'sparklestore_pro_banner_button_link',
                'sparklestore_pro_banner_text_alignment',
                'sparklestore_pro_banner_parallax_effect',
                'sparklestore_pro_slider_revolution',
                'sparklestore_pro_video_banner',

                'sparklestore_pro_promo_display_side',
                'sparklestore_pro_slider_promo_one',
                'sparklestore_pro_slider_promo_one_url',
                'sparklestore_pro_slider_promo_two',
                'sparklestore_pro_slider_promo_two_url',

                'sparklestore_pro_vieo_setting_heading',
                'sparklestore_pro_video_auto_play',
                'sparklestore_pro_video_showcontrols',
                'sparklestore_pro_video_mute',
                'sparklestore_pro_video_loop',
                
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Color', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_slider_overlay_color',
                'sparklestore_pro_slider_bg_overlay_color',
                'sparklestore_pro_caption_title_background_color',
                'sparklestore_pro_caption_title_color',
                'sparklestore_pro_caption_subtitle_color',
                'sparklestore_pro_slider_arrow_color_group',
                'sparklestore_pro_caption_button_color_group'
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_slider_height_msg',
                'sparklestore_pro_slider_height_group',

                'sparklestore_pro_slider_seprator_msg',
                'sparklestore_pro_slider_bottom_seperator',
                'sparklestore_pro_slider_bs_color',
                'sparklestore_pro_slider_bs_height',
                'sparklestore_pro_slider_margin_msg',
                'sparklestore_pro_slider_margin',
                'sparklestore_pro_slider_padding',
            )
        )
    ),
)));

$wp_customize->add_setting('sparklestore_pro_homepage_slider_type', array(
    'default' => 'default',
    'sanitize_callback' => 'sparklestore_pro_sanitize_select'
));

$wp_customize->add_control('sparklestore_pro_homepage_slider_type', array(
    'section' => 'sparklestore_pro_slider_section',
    'type' => 'radio',
    'label' => esc_html__('Slider Type', 'sparklestore-pro'),
    'choices' => array(
        'default'   => esc_html__('Default Slider', 'sparklestore-pro'),
        'advance'   => esc_html__('Advance Slider', 'sparklestore-pro'),
        'revolution' => esc_html__('Revolution Slider', 'sparklestore-pro'),
        'banner'    => esc_html__('Single Banner Image', 'sparklestore-pro'),
        'video'     => esc_html__('Video Banner', 'sparklestore-pro')
    )
));
$wp_customize->selective_refresh->add_partial( 'sparklestore_pro_homepage_slider_type', array(
    'selector'        => '.sparklestore-slider .sparklestore-caption',
) );

/* Slider */
$wp_customize->add_setting('sparklestore_pro_slider_info', array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new Sparklestore_Pro_Info_Text($wp_customize, 'sparklestore_pro_slider_info', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Note:', 'sparklestore-pro'),
    'description' => esc_html__('Recommended Image Size: 1900X800', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_slider_heading', array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_slider_heading', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Slider Items', 'sparklestore-pro')
)));

/** default slider */
$wp_customize->add_setting('sparklestore_pro_banner_all_sliders', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_repeater',		//done
    'default' => json_encode(array(
        array(
            'selectpage' => '',
            'button_text' => '',
            'button_url' => '',
            'button_two_text' => '',
            'button_two_url' => '',
            'alignment'     => 'center'
        )
    ))
));

$wp_customize->add_control(new Sparklestore_Pro_Repeater_Control( $wp_customize, 
    'sparklestore_pro_banner_all_sliders', 

    array(
        'label' 	   => esc_html__('Add Slider', 'sparklestore-pro'),
        'section' 	   => 'sparklestore_pro_slider_section',
        'settings' 	   => 'sparklestore_pro_banner_all_sliders',
        'box_label' => esc_html__('Slider Settings Options', 'sparklestore-pro'),
        'add_label' => esc_html__('Add New Slider', 'sparklestore-pro'),
    ),

    array(

        'selectpage' => array(
            'type' => 'select',
            'label' => esc_html__('Select Slider Page', 'sparklestore-pro'),
            'options' => $pages
        ),

        'button_text' => array(
            'type' => 'text',
            'label' => esc_html__('Enter First Button Text', 'sparklestore-pro'),
            'default' => ''
        ),
        
        'button_url' => array(
            'type' => 'url',
            'label' => esc_html__('Enter First Button Url', 'sparklestore-pro'),
            'default' => ''
        ),

        'button_two_text' => array(
            'type' => 'text',
            'label' => esc_html__('Enter Second Button Text', 'sparklestore-pro'),
            'default' => ''
        ),
        
        'button_two_url' => array(
            'type' => 'url',
            'label' => esc_html__('Enter Second Button Url', 'sparklestore-pro'),
            'default' => ''
        ),
        'alignment' => array(
            'type' => 'select',
            'label' => esc_html__('Slider Text Alignment', 'sparklestore-pro'),
            'default' => 'center',
            'options' => array(
                'text-center' => esc_html__('Center', 'sparklestore-pro'),
                'text-left' => esc_html__('Left', 'sparklestore-pro'),
                'text-right' => esc_html__('Right', 'sparklestore-pro')
            )
        )
    )
));

// advance slider
$wp_customize->add_setting('sparklestore_pro_advance_sliders', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'image' => '',
            'title' => '',
            'subtitle' => '',
            'button_text' => '',
            'button_link' => '',
            'button_link_two' => '',
            'button_text_two' => '',
            'alignment' => 'center',
            'enable' => 'on'
        )
    )),
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Repeater_Control($wp_customize, 'sparklestore_pro_advance_sliders', 
        array(
            'label' => esc_html__('Add Sliders', 'sparklestore-pro'),
            'section' => 'sparklestore_pro_slider_section',
            'box_label' => esc_html__('Slider', 'sparklestore-pro'),
            'add_label' => esc_html__('Add Slider', 'sparklestore-pro'),
        ), 
        array(
            'image' => array(
                'type' => 'upload',
                'label' => esc_html__('Upload Image', 'sparklestore-pro'),
                'default' => ''
            ),
            'title' => array(
                'type' => 'text',
                'label' => esc_html__('Slider Caption Title', 'sparklestore-pro'),
                'default' => ''
            ),
            'subtitle' => array(
                'type' => 'textarea',
                'label' => esc_html__('Slider Caption Subtitle', 'sparklestore-pro'),
                'default' => ''
            ),
            'button_text' => array(
                'type' => 'text',
                'label' => esc_html__('First Button Text', 'sparklestore-pro'),
                'default' => esc_html__('Read More', 'sparklestore-pro')
            ),
            'button_link' => array(
                'type' => 'text',
                'label' => esc_html__('First Button Link', 'sparklestore-pro'),
                'default' => ''
            ),
            'button_text_two' => array(
                'type' => 'text',
                'label' => esc_html__('Second Button Text', 'sparklestore-pro'),
                'default' => ''
            ),
            'button_link_two' => array(
                'type' => 'text',
                'label' => esc_html__('Second Button Link', 'sparklestore-pro'),
                'default' => ''
            ),
            'alignment' => array(
                'type' => 'select',
                'label' => esc_html__('Slider Text Alignment', 'sparklestore-pro'),
                'default' => 'center',
                'options' => array(
                    'text-center' => esc_html__('Center', 'sparklestore-pro'),
                    'text-left' => esc_html__('Left', 'sparklestore-pro'),
                    'text-right' => esc_html__('Right', 'sparklestore-pro')
                )
            ),
            'enable' => array(
                'type' => 'switch',
                'label' => esc_html__('Enable Slider', 'sparklestore-pro'),
                'switch' => array(
                    'on' => 'Yes',
                    'off' => 'No'
                ),
                'default' => 'on'
            )
        )
    ));


    /**
     * Slider Layout Settings Area
    */
    $wp_customize->add_setting('sparklestore_pro_slider_layout', array(
        'default' => 'fullwidth',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sparklestore_pro_sanitize_select'  //done
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Image_Select($wp_customize, 'sparklestore_pro_slider_layout', array(
        'section' => 'sparklestore_pro_slider_section',
        'label' => esc_html__('Slider Layout Options', 'sparklestore-pro'),
        'image_path' => $imagepath . '/inc/customizer/images/slider/',
        'choices' => array(
            'fullwidth' => esc_html__('Full Width Slider', 'sparklestore-pro'),
            'boxed' => esc_html__('Boxed Width Slider', 'sparklestore-pro'),
            'sliderpromo' => esc_html__('Slider With Promo Images', 'sparklestore-pro'),
            'sliderverticalmenu' => esc_html__('Slider With Vertical Menu', 'sparklestore-pro')
        )
    )));
  
  // Promo & Slider Display Side
  $wp_customize->add_setting('sparklestore_pro_promo_display_side', array(
    'default' => 'left',
    'sanitize_callback' => 'sparklestore_pro_sanitize_select',
  ));

  $wp_customize->add_control('sparklestore_pro_promo_display_side', array(
    'type' => 'select',
    'label' => esc_html__('Select Display Side', 'sparklestore-pro'),
    'section' => 'sparklestore_pro_slider_section',
    'settings' => 'sparklestore_pro_promo_display_side',
    'choices' => array( 
        'left' => esc_html__('Left Side','sparklestore-pro'),
        'right' => esc_html__('Right Side','sparklestore-pro')
  )));


  $wp_customize->add_setting( 'sparklestore_pro_slider_promo_one', array(
      'default'       =>      '',
      'sanitize_callback' => 'esc_url_raw'
  ));

  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sparklestore_pro_slider_promo_one', array(
      'section'       => 'sparklestore_pro_slider_section',
      'label'         => esc_html__('Upload Slider Promo Image One', 'sparklestore-pro'),
      'type'          => 'image',
      
  )));

  $wp_customize->add_setting( 'sparklestore_pro_slider_promo_one_url', array(
      'default' => '',
      'sanitize_callback' => 'esc_url_raw',
  ));

  $wp_customize->add_control( 'sparklestore_pro_slider_promo_one_url', array(
      'type' => 'url',
      'section' => 'sparklestore_pro_slider_section',
      'label' => esc_html__( 'Enter Custom External URL', 'sparklestore-pro' ),
      
  ) );

  $wp_customize->add_setting( 'sparklestore_pro_slider_promo_two', array(
      'default'       =>      '',
      'sanitize_callback' => 'esc_url_raw'
  ));  
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sparklestore_pro_slider_promo_two', array(
      'section'       => 'sparklestore_pro_slider_section',
      'label'         => esc_html__('Upload Slider Promo Image Two', 'sparklestore-pro'),
      'type'          => 'image',
      
  )));

  $wp_customize->add_setting( 'sparklestore_pro_slider_promo_two_url', array(
      'default' => '',
      'sanitize_callback' => 'esc_url_raw',
  ));

  $wp_customize->add_control( 'sparklestore_pro_slider_promo_two_url', array(
      'type' => 'url',
      'section' => 'sparklestore_pro_slider_section',
      'label' => esc_html__( 'Enter Custom External URL', 'sparklestore-pro' ),
      
  ) );



$wp_customize->add_setting('sparklestore_pro_slider_setting_heading', array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_slider_setting_heading', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Settings', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_slider_pause', array(
    'default' => '5',
    'sanitize_callback' => 'absint',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Range_Control($wp_customize, 'sparklestore_pro_slider_pause', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Slider Pause Duration', 'sparklestore-pro'),
    'description' => esc_html__('Slider Pause duration in seconds', 'sparklestore-pro'),
    'input_attrs' => array(
        'min' => 2,
        'max' => 10,
        'step' => 1,
    )
)));

$wp_customize->add_setting('sparklestore_pro_slider_arrow', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
    'default' => true,
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_slider_arrow', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Slider Arrow', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_slider_dots', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
    'default' => true,
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_slider_dots', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Slider Dots', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_slider_loop', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
    'default' => true,
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_slider_loop', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Slider Loop', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_slider_auto_play', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
    'default' => true,
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_slider_auto_play', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('AutoPlay', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_slider_mouse_drag', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
    'default' => true,
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_slider_mouse_drag', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Mouse Drag', 'sparklestore-pro'),
)));

/* Banner */
$wp_customize->add_setting('sparklestore_pro_banner_image', array(
    'sanitize_callback' => 'esc_url_raw',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sparklestore_pro_banner_image', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Upload Banner Image', 'sparklestore-pro'),
)));

/** banner promo image */
$wp_customize->add_setting('sparklestore_pro_banner_promo_image', array(
    'sanitize_callback' => 'esc_url_raw',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sparklestore_pro_banner_promo_image', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Upload Promo Image', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_banner_title', array(
    'sanitize_callback' => 'sanitize_text_field',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_banner_title', array(
    'section' => 'sparklestore_pro_slider_section',
    'type' => 'text',
    'label' => esc_html__('Banner Title', 'sparklestore-pro'),
));

$wp_customize->add_setting('sparklestore_pro_banner_subtitle', array(
    'sanitize_callback' => 'sanitize_text_field',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_banner_subtitle', array(
    'section' => 'sparklestore_pro_slider_section',
    'type' => 'textarea',
    'label' => esc_html__('Banner SubTitle', 'sparklestore-pro'),
));

$wp_customize->add_setting('sparklestore_pro_banner_button_text', array(
    'sanitize_callback' => 'sanitize_text_field',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_banner_button_text', array(
    'section' => 'sparklestore_pro_slider_section',
    'type' => 'text',
    'label' => esc_html__('Button Text', 'sparklestore-pro'),
));

$wp_customize->add_setting('sparklestore_pro_banner_button_link', array(
    'default' => '',
    'sanitize_callback' => 'esc_url_raw',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_banner_button_link', array(
    'section' => 'sparklestore_pro_slider_section',
    'type' => 'text',
    'label' => esc_html__('Button Link', 'sparklestore-pro'),
));

$wp_customize->add_setting('sparklestore_pro_banner_text_alignment', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_select',
    'default' => 'left',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_banner_text_alignment', array(
    'type' => 'select',
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Banner Text Alignment', 'sparklestore-pro'),
    'choices' => array(
        'left' => esc_html__('Left', 'sparklestore-pro'),
        'right' => esc_html__('Right', 'sparklestore-pro')
    ),
));

$wp_customize->add_setting('sparklestore_pro_banner_parallax_effect', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'none',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_banner_parallax_effect', array(
    'type' => 'radio',
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Background Effect', 'sparklestore-pro'),
    'choices' => array(
        'none' => esc_html__('None', 'sparklestore-pro'),
        'parallax' => esc_html__('Enable Parallax', 'sparklestore-pro'),
        'scroll' => esc_html__('Horizontal Moving', 'sparklestore-pro')
    ),
));

$wp_customize->add_setting('sparklestore_pro_slider_bg_overlay_color', array(
    'default' => 'rgba(0, 0, 0, 0.4)',
    'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    // 'transport' => 'postMessage'
));
$wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_slider_bg_overlay_color', array(
    'label' => esc_html__('Background Overlay Color', 'sparklestore-pro'),
    'section' => 'sparklestore_pro_slider_section'
)));

$wp_customize->add_setting('sparklestore_pro_caption_title_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    // 'transport' => 'postMessage'
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_caption_title_color', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Caption Title Color', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_caption_subtitle_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    // 'transport' => 'postMessage'
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_caption_subtitle_color', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Caption Sub Title Color', 'sparklestore-pro')
)));


$wp_customize->add_setting('sparklestore_pro_caption_button_bg_color', array(
    'default' => '#003772',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    // 'transport' => 'postMessage'
));

$wp_customize->add_setting('sparklestore_pro_caption_button_border_color', array(
    'default' => '#003772',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    // 'transport' => 'postMessage'
));

$wp_customize->add_setting('sparklestore_pro_caption_button_text_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    // 'transport' => 'postMessage'
));

// Slider Button Hover Color
$wp_customize->add_setting('sparklestore_pro_caption_button_bg_hov_color', array(
    'default' => '#003772',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    // 'transport' => 'postMessage'
));

$wp_customize->add_setting('sparklestore_pro_caption_button_border_hov_color', array(
    'default' => '#003772',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    // 'transport' => 'postMessage'
));

$wp_customize->add_setting('sparklestore_pro_caption_button_text_hov_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    // 'transport' => 'postMessage'
));


$wp_customize->add_control(new Sparklestore_Pro_Color_Tab_Control($wp_customize, 'sparklestore_pro_caption_button_color_group', array(
    'label' => esc_html__('Caption Button Colors', 'sparklestore-pro'),
    'section' => 'sparklestore_pro_slider_section',
    'show_opacity' => false,
    'settings' => array(
        'normal_sparklestore_pro_caption_button_bg_color' => 'sparklestore_pro_caption_button_bg_color',
        'normal_sparklestore_pro_caption_button_border_color' => 'sparklestore_pro_caption_button_border_color',
        'normal_sparklestore_pro_caption_button_text_color' => 'sparklestore_pro_caption_button_text_color',
        'hover_sparklestore_pro_caption_button_bg_hov_color' => 'sparklestore_pro_caption_button_bg_hov_color',
        'hover_sparklestore_pro_caption_button_border_hov_color' => 'sparklestore_pro_caption_button_border_hov_color',
        'hover_sparklestore_pro_caption_button_text_hov_color' => 'sparklestore_pro_caption_button_text_hov_color',
    ),
    'group' => array(
        'normal_sparklestore_pro_caption_button_bg_color' => esc_html__('Button Background Color', 'sparklestore-pro'),
        'normal_sparklestore_pro_caption_button_border_color' => esc_html__('Button Border Color', 'sparklestore-pro'),
        'normal_sparklestore_pro_caption_button_text_color' => esc_html__('Button Text Color', 'sparklestore-pro'),
        'hover_sparklestore_pro_caption_button_bg_hov_color' => esc_html__('Button Background Color', 'sparklestore-pro'),
        'hover_sparklestore_pro_caption_button_border_hov_color' => esc_html__('Button Border Color', 'sparklestore-pro'),
        'hover_sparklestore_pro_caption_button_text_hov_color' => esc_html__('Button Text Color', 'sparklestore-pro')
    )
)));


/* Revolution Slider Shortcode */
$wp_customize->add_setting('sparklestore_pro_slider_revolution', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control('sparklestore_pro_slider_revolution', array(
    'section' => 'sparklestore_pro_slider_section',
    'type' => 'text',
    'label' => esc_html__('Slider ShortCode', 'sparklestore-pro'),
    'description' => esc_html__('Add the ShortCode for Slider', 'sparklestore-pro'),
));

// slider Margin Padding
$wp_customize->add_setting('sparklestore_pro_slider_margin_msg', array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_slider_margin_msg', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Margin & Padding', 'sparklestore-pro')
)));

$wp_customize->add_setting(
	'sparklestore_pro_slider_margin',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => '',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'sparklestore_pro_slider_margin',
		array(
			'label'    => esc_html__( 'Margin (px)', 'sparklestore-pro' ),
			'section'  => 'sparklestore_pro_slider_section',
			'settings' => 'sparklestore_pro_slider_margin',
		),
		array(),
		array()
	)
);

/* Padding*/
$wp_customize->add_setting(
	'sparklestore_pro_slider_padding',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => '',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'sparklestore_pro_slider_padding',
		array(
			'label'    => esc_html__( 'Padding (px)', 'sparklestore-pro' ),
			'section'  => 'sparklestore_pro_slider_section',
			'settings' => 'sparklestore_pro_slider_padding',
		),
		array(),
		array()
	)
);

// height heading 
$wp_customize->add_setting('sparklestore_pro_slider_height_msg', array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_slider_height_msg', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Slider Height', 'sparklestore-pro')
)));
$wp_customize->add_setting("sparklestore_pro_slider_height", array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
    'default' => 580,
    // 'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_slider_height_tablet", array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
    'default' => 500,
    // 'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_slider_height_mobile", array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
    'default' => 300,
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Range_Slider_Control($wp_customize, "sparklestore_pro_slider_height_group", array(
    'section' => "sparklestore_pro_slider_section",
    'label' => esc_html__('Height (px)', 'sparklestore-pro'),
    'input_attrs' => array(
        'min' => 20,
        'max' => 900,
        'step' => 1,
    ),
    'settings' => array(
        'desktop' => "sparklestore_pro_slider_height",
        'tablet' => "sparklestore_pro_slider_height_tablet",
        'mobile' => "sparklestore_pro_slider_height_mobile",
    ),
    // 'priority' => 140
)));




// seprator heading 
$wp_customize->add_setting('sparklestore_pro_slider_seprator_msg', array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_slider_seprator_msg', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Seperator', 'sparklestore-pro')
)));

$wp_customize->add_setting('sparklestore_pro_slider_bottom_seperator', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'none',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_slider_bottom_seperator', array(
    'section' => 'sparklestore_pro_slider_section',
    'type' => 'select',
    'label' => esc_html__('Bottom Seperator', 'sparklestore-pro'),
    'choices' => array_merge(array('none' => 'None'), sparklestore_pro_svg_seperator())
));

$wp_customize->add_setting('sparklestore_pro_slider_bs_color', array(
    'default' => 'rgba(247,247,247,0.2)',
    'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_slider_bs_color', array(
    'section' => 'sparklestore_pro_slider_section',
    'label' => esc_html__('Bottom Seperator Color', 'sparklestore-pro')
)));

$wp_customize->add_setting("sparklestore_pro_slider_bs_height", array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
    'default' => 60,
    // 'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_slider_bs_height_tablet", array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
    // 'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_slider_bs_height_mobile", array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Range_Slider_Control($wp_customize, "sparklestore_pro_slider_bs_height", array(
    'section' => "sparklestore_pro_slider_section",
    'label' => esc_html__('Seperator Height (px)', 'sparklestore-pro'),
    'input_attrs' => array(
        'min' => 20,
        'max' => 200,
        'step' => 1,
    ),
    'settings' => array(
        'desktop' => "sparklestore_pro_slider_bs_height",
        'tablet' => "sparklestore_pro_slider_bs_height_tablet",
        'mobile' => "sparklestore_pro_slider_bs_height_mobile",
    ),
    // 'priority' => 140
)));

/** video banner */
$wp_customize->add_setting('sparklestore_pro_video_banner', array(
    'default' => 'DJlmVOSEvGA',
    'sanitize_callback' => 'sanitize_text_field',
    // 'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_video_banner', array(
    'section' => 'sparklestore_pro_slider_section',
    'type' => 'text',
    'label' => esc_html__('Video Id', 'sparklestore-pro'),
    'description' => 'https://www.youtube.com/watch?v=<strong>DJlmVOSEvGA</strong>. ' . esc_html__('Add only DJlmVOSEvGA', 'sparklestore-pro')
));
/** video settings */
// $wp_customize->add_setting('sparklestore_pro_vieo_setting_heading', array(
//     'sanitize_callback' => 'sanitize_text_field'
// ));

// $wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_vieo_setting_heading', array(
//     'section' => 'sparklestore_pro_slider_section',
//     'label' => esc_html__('Video Settings', 'sparklestore-pro')
// )));

// $wp_customize->add_setting('sparklestore_pro_video_auto_play', array(
//     'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
//     'default' => true,
    // 'transport' => 'postMessage'
// ));

// $wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_video_auto_play', array(
//     'section' => 'sparklestore_pro_slider_section',
//     'label' => esc_html__('Auto Play', 'sparklestore-pro'),
// )));


// $wp_customize->add_setting('sparklestore_pro_video_showcontrols', array(
//     'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
//     'default' => true,
//      'transport' => 'postMessage'
// ));

// $wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_video_showcontrols', array(
//     'section' => 'sparklestore_pro_slider_section',
//     'label' => esc_html__('Show Controls', 'sparklestore-pro'),
// )));

// $wp_customize->add_setting('sparklestore_pro_video_mute', array(
//     'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
//     'default' => true,
// 'transport' => 'postMessage'
// ));

// $wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_video_mute', array(
//     'section' => 'sparklestore_pro_slider_section',
//     'label' => esc_html__('Mute', 'sparklestore-pro'),
// )));

// $wp_customize->add_setting('sparklestore_pro_video_loop', array(
//     'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
//     'default' => true,
    // 'transport' => 'postMessage'
// ));

// $wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_video_loop', array(
//     'section' => 'sparklestore_pro_slider_section',
//     'label' => esc_html__('Loop', 'sparklestore-pro'),
// )));


$wp_customize->selective_refresh->add_partial('sparklestore_pro_banner_all_sliders', array(
    'selector' => '#banner-slider',
    // 'render_callback' => 'sparklestore_pro_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('sparklestore_pro_slider_pause', array(
    'selector' => '#banner-slider',
    // 'render_callback' => 'sparklestore_pro_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('sparklestore_pro_slider_full_screen', array(
    'selector' => '#banner-slider',
    // 'render_callback' => 'sparklestore_pro_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('sparklestore_pro_slider_arrow', array(
    'selector' => '#cl-home-slider-section',
    // 'render_callback' => 'sparklestore_pro_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('sparklestore_pro_slider_dots', array(
    'selector' => '#cl-home-slider-section',
    // 'render_callback' => 'sparklestore_pro_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('sparklestore_pro_slider_bottom_seperator', array(
    'selector' => '#cl-home-slider-section',
    // 'render_callback' => 'sparklestore_pro_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('sparklestore_pro_banner_button_link', array(
    'selector' => '#cl-home-slider-section .btn',
    // 'render_callback' => 'sparklestore_pro_slider_section',
    'container_inclusive' => true
));

$wp_customize->selective_refresh->add_partial('sparklestore_pro_banner_parallax_effect', array(
    'selector' => '#cl-home-slider-section',
    // 'render_callback' => 'sparklestore_pro_slider_section',
    'container_inclusive' => true
));
$wp_customize->selective_refresh->add_partial('sparklestore_pro_banner_title', array(
    'selector' => '#cl-home-slider-section .slider-title',
    // 'render_callback' => 'sparklestore_pro_slider_section',
    'container_inclusive' => true
));

