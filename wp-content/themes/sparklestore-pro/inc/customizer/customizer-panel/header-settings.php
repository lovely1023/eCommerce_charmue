<?php
/**
 * Notice Bar Settings Section
 */
$wp_customize->add_section(new Sparklestore_Pro_Toggle_Section($wp_customize, 'sparklestore_pro_top_header_notice_bar', array(
    'title' => esc_html__('Notice Settings', 'sparklestore-pro'),
    'panel' => $this->panel,
    'hiding_control' => 'sparklestore_pro_notice_bar_options'
)));

/**
* News Ticker Enable/Disable
*/
$wp_customize->add_setting('sparklestore_pro_notice_bar_options', array(
    'default' => 'on',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sparklestore_pro_sanitize_text',
));

$wp_customize->add_control(new Sparklestore_Pro_Switch_Control($wp_customize, 'sparklestore_pro_notice_bar_options', array(
    'section' => 'sparklestore_pro_top_header_notice_bar',
    'label' => esc_html__('Disable', 'sparklestore-pro'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'sparklestore-pro'),
        'off' => esc_html__('No', 'sparklestore-pro')
    )
)));




$wp_customize->add_setting('sparklestore_pro_top_header_notice_bar_nav', array(
    // 'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_pro_top_header_notice_bar_nav', array(
    'type' => 'tab',
    'section' => 'sparklestore_pro_top_header_notice_bar',
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_top_notice_bar_type',
                'sparklestore_pro_top_notice_bar_label',
                'sparklestore_pro_notice_bar_items',
                'sparklestore_pro_top_notice_bar_editor'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_top_notice_bar_label_color',
                'sparklestore_pro_top_notice_bar_label_bg_color',
                'sparklestore_pro_top_notice_bar_section_bg_color',
                'sparklestore_pro_top_notice_bar_section_text_color',
                'sparklestore_pro_top_notice_bar_section_hover_color'
            )
        )
    ),
)));

    /** notice bar type */
    $wp_customize->add_setting("sparklestore_pro_top_notice_bar_type", array(
        'default' => 'free-hand',
        'sanitize_callback' => 'sparklestore_pro_sanitize_select',
        // 'transport' => 'postMessage'
    ));

    $wp_customize->add_control("sparklestore_pro_top_notice_bar_type", array(
        'section' => 'sparklestore_pro_top_header_notice_bar',
        'type' => 'select',
        'label' => esc_html__('Type', 'sparklestore-pro'),
        'choices' => array(
            'news-ticker' => esc_html__('News Ticker', 'sparklestore-pro'),
            'free-hand' => esc_html__('Free Hand', 'sparklestore-pro'),
        ),
        
    ));


    /**
     * Free hand
    */
    $wp_customize->add_setting('sparklestore_pro_top_notice_bar_editor', array(
        'default'       =>      '',
        'sanitize_callback' => 'sparklestore_pro_sanitize_text'
    ));
    $wp_customize->add_control(new Sparklestore_Pro_Page_Editor($wp_customize, 'sparklestore_pro_top_notice_bar_editor', array(
        'section'    => 'sparklestore_pro_top_header_notice_bar',
        'label'      => esc_html__('Free Hand Writing/Banner Image', 'sparklestore-pro'),
        'type'       => 'textarea',
        'description'=> esc_html__('Enter here google ads code or long text or uplaod ads image url image dispaly format "<img src="image path"/>)','sparklestore-pro'),
        'include_admin_print_footer' => true
    )));


    /**
     * News Ticker Label Value
    */
    $wp_customize->add_setting('sparklestore_pro_top_notice_bar_label', array(
        'default'       =>      '',
        'sanitize_callback' => 'sparklestore_pro_sanitize_text'
    ));

    $wp_customize->add_control('sparklestore_pro_top_notice_bar_label', array(
        'section'    => 'sparklestore_pro_top_header_notice_bar',
        'label'      => esc_html__('Notice Label', 'sparklestore-pro'),
        'type'       => 'text'  
    ));

    /**
     * News Ticker Settings Area
    */
    $wp_customize->add_setting( 'sparklestore_pro_notice_bar_items', array(
      'sanitize_callback' => 'sparklestore_pro_sanitize_repeater',
      'default' => json_encode( array(
        array(
              'news_text' => '',
              'news_url' => ''
            )
        ) )        
    ) );

    $wp_customize->add_control(new Sparklestore_Pro_Repeater_Control($wp_customize, 'sparklestore_pro_notice_bar_items', array(
            'label' => esc_html__('Notice Items', 'sparklestore-pro'),
            'section' => 'sparklestore_pro_top_header_notice_bar',
            'box_label' => esc_html__('Item', 'sparklestore-pro'),
            'add_label' => esc_html__('Add', 'sparklestore-pro')
        ), 
        array(
            'news_text' => array(
                'type'      => 'textarea',
                'label'     => esc_html__( 'Notice', 'sparklestore-pro' ),
                'default'   => ''
            )
    )));

    // notice bar styles
    $wp_customize->add_setting(
        'sparklestore_pro_top_notice_bar_section_bg_color',array(
            'default'     => '#003772',
            'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
        )
    ); 
    $wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_top_notice_bar_section_bg_color', array(
        'label'      => esc_html__( 'Section Background Color', 'sparklestore-pro' ),
        'section'    => 'sparklestore_pro_top_header_notice_bar',
    )));
    
    $wp_customize->add_setting(
        'sparklestore_pro_top_notice_bar_section_text_color',array(
            'default'     => '#ffffff',
            'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
        )
    ); 

    $wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_top_notice_bar_section_text_color', array(
        'label'      => esc_html__( 'Section Text Color', 'sparklestore-pro' ),
        'section'    => 'sparklestore_pro_top_header_notice_bar',
    )));

    $wp_customize->selective_refresh->add_partial('sparklestore_pro_top_notice_bar_type', array(
        'selector' => '.notice-bar .ticker-wrapper',
        // 'render_callback' => 'sparklestore_pro_gdpr_notice',
        'container_inclusive' => true
    ));

    $wp_customize->add_setting(
        'sparklestore_pro_top_notice_bar_section_hover_color',array(
            'default'     => '#f33c3c',
            'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
        )
    ); 

    $wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_top_notice_bar_section_hover_color', array(
        'label'      => esc_html__( 'Hover Color', 'sparklestore-pro' ),
        'section'    => 'sparklestore_pro_top_header_notice_bar',
    )));

    /** Quick Information */
    $wp_customize->add_section('sparklestore_pro_header_quickinfo', array(
        'title' => esc_html__('Quick Information', 'sparklestore-pro'),
        'panel' => $this->panel,
    ));

    $wp_customize->add_setting('sparklestore_pro_email_icon', array(
        'default' => 'fas fa-envelope-open',
        'sanitize_callback' => 'sparklestore_pro_sanitize_text', // done
    ));        
    $wp_customize->add_control(new Sparklestore_Pro_Fontawesome_Icon_Chooser($wp_customize, 'sparklestore_pro_email_icon',array(
        'type' => 'icon',
        'label' => esc_html__('Select Icon', 'sparklestore-pro'),
        'section' => 'sparklestore_pro_header_quickinfo',
        'setting' => 'sparklestore_pro_email_icon'
        
    )));

    $wp_customize->add_setting('sparklestore_pro_email_title', array(
        'default' => esc_html__('info@exmaple.com', 'sparklestore-pro'),
        'sanitize_callback' => 'sanitize_email',  // done
    ));        
    $wp_customize->add_control('sparklestore_pro_email_title',array(
        'type' => 'text',
        'label' => esc_html__('Email Address', 'sparklestore-pro'),
        'section' => 'sparklestore_pro_header_quickinfo',
        'setting' => 'sparklestore_pro_email_title'
    ));
    
    
    $wp_customize->add_setting('sparklestore_pro_phone_icon', array(
        'default' => 'fas fa-phone-alt',
        'sanitize_callback' => 'sparklestore_pro_sanitize_text', // done
    ));        
    $wp_customize->add_control(new Sparklestore_Pro_Fontawesome_Icon_Chooser($wp_customize,'sparklestore_pro_phone_icon',array(
        'type' => 'icon',
        'label' => esc_html__('Select Icon', 'sparklestore-pro'),
        'section' => 'sparklestore_pro_header_quickinfo',
        'setting' => 'sparklestore_pro_phone_icon'
    )));
    
    $wp_customize->add_setting('sparklestore_pro_phone_number', array(
        'default' => esc_html__('+1 (8976)-322-221', 'sparklestore-pro'),
        'sanitize_callback' => 'sparklestore_pro_sanitize_text',  // done
    ));        
    $wp_customize->add_control('sparklestore_pro_phone_number',array(
        'type' => 'text',
        'label' => esc_html__('Phone Number', 'sparklestore-pro'),
        'section' => 'sparklestore_pro_header_quickinfo',
        'setting' => 'sparklestore_pro_phone_number'
    ));

    $wp_customize->add_setting('sparklestore_pro_address_icon', array(
        'default' => 'fas fa-map-marker-alt',
        'sanitize_callback' => 'sparklestore_pro_sanitize_text', // done
    ));        
    $wp_customize->add_control(new Sparklestore_Pro_Fontawesome_Icon_Chooser( $wp_customize,'sparklestore_pro_address_icon',array(
        'type' => 'icon',
        'label' => esc_html__('Select Icon', 'sparklestore-pro'),
        'section' => 'sparklestore_pro_header_quickinfo',
        'setting' => 'sparklestore_pro_address_icon'
    )));
    
    $wp_customize->add_setting('sparklestore_pro_map_address', array(
        'default' => esc_html__('Kathmandu 44600, Nepal', 'sparklestore-pro'),
        'sanitize_callback' => 'sparklestore_pro_sanitize_text',  // done
    ));        
    $wp_customize->add_control('sparklestore_pro_map_address',array(
        'type' => 'text',
        'label' => esc_html__('Address', 'sparklestore-pro'),
        'section' => 'sparklestore_pro_header_quickinfo',
        'setting' => 'sparklestore_pro_map_address'
    ));    
    
    
    $wp_customize->add_setting('sparklestore_pro_start_open_icon', array(
        'default' => 'far fa-clock',
        'sanitize_callback' => 'sparklestore_pro_sanitize_text', // done
    ));        
    $wp_customize->add_control(new Sparklestore_Pro_Fontawesome_Icon_Chooser($wp_customize, 'sparklestore_pro_start_open_icon',array(
        'type' => 'icon',
        'label' => esc_html__('Start Time Icon', 'sparklestore-pro'),
        'section' => 'sparklestore_pro_header_quickinfo',
        'setting' => 'sparklestore_pro_start_open_icon'
    )));
    
    $wp_customize->add_setting('sparklestore_pro_start_open_time', array(
        'default' => '',
        'sanitize_callback' => 'sparklestore_pro_sanitize_text',  // done
    ));        
    $wp_customize->add_control('sparklestore_pro_start_open_time',array(
        'type' => 'text',
        'label' => esc_html__('Opening Time', 'sparklestore-pro'),
        'section' => 'sparklestore_pro_header_quickinfo',
        'setting' => 'sparklestore_pro_start_open_time'
    ));
    
    /** color */
    $wp_customize->add_setting(
        'sparklestore_pro_quick_info_color', array(
            'default'     => '#000',
            'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        )
    ); 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            'sparklestore_pro_quick_info_color',array(
                'label'      => esc_html__( 'Color', 'sparklestore-pro' ),
                'section'    => 'sparklestore_pro_header_quickinfo'
            )
        )
    );


    /**
     * HTML
     */

    $wp_customize->add_section('sparklestore_pro_header_html', array(
        'title' => esc_html__('HTML', 'sparklestore-pro'),
        'panel' => $this->panel,
    ));

    $wp_customize->add_setting( 'sparklestore_pro_header_left_free_text', array( 
        'sanitize_callback' => 'sparklestore_pro_sanitize_text' 
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Page_Editor($wp_customize, 'sparklestore_pro_header_left_free_text', array(
        'section' => 'sparklestore_pro_header_html',
        'label' => esc_html__( 'Free Hand Text', 'sparklestore-pro' ),
        'include_admin_print_footer' => true
    )));

    $wp_customize->selective_refresh->add_partial( 'sparklestore_pro_header_left_free_text', array(
		'selector' => '.header-container .free-hand-text-wrap',
		'container_inclusive' => false,
	) );
    /**
     * Search
     */

    $wp_customize->add_section('sparklestore_pro_header_search', array(
        'title' => esc_html__('Search Settings', 'sparklestore-pro'),
        'panel' => $this->panel,
    ));
    //Heading 
    $wp_customize->add_setting("sparklestore_pro_header_search_msg", array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, "sparklestore_pro_header_search_msg", array(
        'section' => 'sparklestore_pro_header_search',
        'label' => esc_html__('Search Type', 'sparklestore-pro')
    )));

    $wp_customize->add_setting('sparklestore_pro_search_type_options', array(
        'default' => 'advancesearch',
        'sanitize_callback' => 'sparklestore_pro_sanitize_select',
    ));

    $wp_customize->add_control('sparklestore_pro_search_type_options', array(
      'type' => 'radio',
      'label' => esc_html__('Select Search Type', 'sparklestore-pro'),
      'section' => 'sparklestore_pro_header_search',
      'settings' => 'sparklestore_pro_search_type_options',
      'choices' => array(
           'advancesearch' => esc_html__('Advance Search ( With Category )', 'sparklestore-pro'),
           'normalsearch' => esc_html__('Normal Search', 'sparklestore-pro'),
           'ajaxsearch' => esc_html__('Ajax Search', 'sparklestore-pro'),
          )
    ));
    $wp_customize->selective_refresh->add_partial( 'sparklestore_pro_search_type_options', array(
		'selector' => '.header-container .block-search',
		'container_inclusive' => false,
	) );   

    /**
     * Text field for search placeholder caption
    */
    $wp_customize->add_setting(
        'sparklestore_search_placeholder_text',
        array(
            'default'    => esc_html__( 'I am searching for...', 'sparklestore-pro' ),
            'sanitize_callback' => 'sparklestore_pro_sanitize_text'
        )
    );

    $wp_customize->add_control(
        'sparklestore_search_placeholder_text',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Enter the Search Box Placeholder Text', 'sparklestore-pro' ),
            'section'   => 'sparklestore_pro_header_search',
        )
    );

    /** icon only heading */
    $wp_customize->add_setting("sparklestore_search_icon_only_msg", array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, "sparklestore_search_icon_only_msg", array(
        'section' => 'sparklestore_pro_header_search',
        'label' => esc_html__('Icon Settings', 'sparklestore-pro')
    )));

    /** show icon only */
    $wp_customize->add_setting('sparklestore_search_icon_only', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => false,
        // 'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_search_icon_only', array(
        'section' => 'sparklestore_pro_header_search',
        'label' => esc_html__('Show Icon Only', 'sparklestore-pro'),
        'description' => esc_html__('Display Icon Only & Show by click on icon', 'sparklestore-pro'),
    )));

    /** alignment */
    $wp_customize->add_setting(
        'sparklestore_search_icon_alignment',
        array(
            'default'           => 'swp-flex-align-left',
            'sanitize_callback' => 'sparklestore_pro_sanitize_select',
            // 'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_control(
        new SparkleWP_Custom_Control_Buttonset(
            $wp_customize,
            'sparklestore_search_icon_alignment',
            array(
                'choices'  => sparklewp_flex_align(),
                'label'    => esc_html__( 'Alignment', 'sparklestore-pro' ),
                'section'  => 'sparklestore_pro_header_search',
                'settings' => 'sparklestore_search_icon_alignment',
            )
        )
    );
    /** icon color */
    $wp_customize->add_setting(
        'sparklestore_search_icon_color', array(
            'default'     => 'rgba(255,255,255,0)',
            'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
        )
    ); 
    $wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_search_icon_color', array(
        'label'      => esc_html__( 'Icon Color', 'sparklestore-pro' ),
        'section'    => 'sparklestore_pro_header_search',
    )));

    $wp_customize->add_setting("sparklestore_search_icon_size", array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
        'default' => 20,
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_setting("sparklestore_search_icon_size_tablet", array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_setting("sparklestore_search_icon_size_mobile", array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Range_Slider_Control($wp_customize, "sparklestore_search_icon_size", array(
        'section' => 'sparklestore_pro_header_search',
        'label' => esc_html__('Icon Size (px)', 'sparklestore-pro'),
        'input_attrs' => array(
            'min' => 20,
            'max' => 200,
            'step' => 1,
        ),
        'settings' => array(
            'desktop' => "sparklestore_search_icon_size",
            'tablet' => "sparklestore_search_icon_size_tablet",
            'mobile' => "sparklestore_search_icon_size_mobile",
        )
    )));

    /** heading */
    $wp_customize->add_setting("sparklestore_search_icon_margin_padding_msg", array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, "sparklestore_search_icon_margin_padding_msg", array(
        'section' => 'sparklestore_pro_header_search',
        'label' => esc_html__('Margin & Padding', 'sparklestore-pro')
    )));

    /** margin */
    $wp_customize->add_setting(
        'sparklestore_search_icon_margin',
        array(
            'default'           => $header_defaults['sparklestore_search_icon_margin'],
            'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
        )
    );
    $wp_customize->add_control(
        new SparkleWP_Custom_Control_Cssbox(
            $wp_customize,
            'sparklestore_search_icon_margin',
            array(
                'label'    => esc_html__( 'Margin', 'sparklestore-pro' ),
                'section'  => 'sparklestore_pro_header_search',
                'settings' => 'sparklestore_search_icon_margin',
            ),
            array(),
            array()
        )
    );
    /** padding */
    $wp_customize->add_setting(
        'sparklestore_search_icon_padding',
        array(
            'default'           => $header_defaults['sparklestore_search_icon_padding'],
            'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
        )
    );
    $wp_customize->add_control(
        new SparkleWP_Custom_Control_Cssbox(
            $wp_customize,
            'sparklestore_search_icon_padding',
            array(
                'label'    => esc_html__( 'Padding', 'sparklestore-pro' ),
                'section'  => 'sparklestore_pro_header_search',
                'settings' => 'sparklestore_search_icon_padding',
            ),
            array(),
            array()
        )
    );