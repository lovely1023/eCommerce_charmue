<?php
/**
 * Add Design Settings Panel
 *
 * @since 1.0.0
 */
$wp_customize->add_panel( 'sparklestore_design_settings_panel', array(
        'title'  => esc_html__( 'Design Layout Settings', 'sparklestore-pro' ),
        'priority' => 28
    )
);


/**
 * Home Page Blog Settings
 *
 * @since 1.0.0
 */

$wp_customize->add_section( 'sparklestore_home_blog_settings_section', array(
        'title'     => esc_html__( 'Blog Template Settings', 'sparklestore-pro' ),
        'priority' => 27
    )
);

/** tabs */
$wp_customize->add_setting('sparklestore_home_blog_settings_section_tab', array(
    //'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_home_blog_settings_section_tab', array(
    'type' => 'tab',
    'section' => 'sparklestore_home_blog_settings_section',
    'buttons' => array(
        array(
            'name' => __('Blog Option', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_home_page_blog_layout',
                'sparklestore_home_page_blog_sidebar',
                'sparklestore_blogtemplate_postcat',
                'sparklestore_post_description_options',
                'sparklestore_post_description_text_alignment',
                'sparklestore_blogtemplate_btn',
                'sparklestore_post_excerpt_length',
                'sparklestore_post_date_options',
                'sparklestore_post_author_options',
                'sparklestore_post_comments_options',
                'sparklestore_post_comments_options',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Blog Details', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_single_blog_sidebar',
                'sparklestore_post_features_options',
                'sparklestore_post_tags_options',
                'sparklestore_post_author_section_options',
                'sparklestore_post_pagination_section_options',
                'sparklestore_post_comment_section_options',
                
            ),
        ),
        array(
            'name' => esc_html__('Style', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_blog_item_bg_color',
                'sparklestore_pro_blog_text_color',
                'sparklestore_pro_blog_hover_color',
                'sparklestore_pro_blog_button_color_group'
            )
        )
    ),
)));

/**
 * Image Radio field for archive/category layout
 *
 * @since 1.0.0
 */
$wp_customize->add_setting('sparklestore_home_page_blog_layout', array(
    'default' => 'default',
    'sanitize_callback' => 'sparklestore_pro_sanitize_choices',
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Image_Select($wp_customize, 'sparklestore_home_page_blog_layout', array(
    'section' => 'sparklestore_home_blog_settings_section',
    'type' => 'select',
    'label' => esc_html__('Blog Layouts', 'sparklestore-pro'),
    'image_path' => $imagepath . '/inc/customizer/images/blog-layout/',
    'choices' => array(
        'default' => esc_html__('Default', 'sparklestore-pro'),
        'masonry' => esc_html__('Masonry', 'sparklestore-pro'),
        'gridview' => esc_html__('Grid View', 'sparklestore-pro'),
        'alternateview' => esc_html__('Alternative List', 'sparklestore-pro'),
        'largelistview' => esc_html__('List View', 'sparklestore-pro')
    )
)));

/**
 * Image Radio field for archive/category sidebar
 *
 * @since 1.0.0
 */

$wp_customize->add_setting('sparklestore_home_page_blog_sidebar', array(
    'default' => 'rightsidebar',
    'sanitize_callback' => 'sparklestore_pro_sanitize_choices',
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Image_Select($wp_customize, 'sparklestore_home_page_blog_sidebar', array(
    'section' => 'sparklestore_home_blog_settings_section',
    'type' => 'select',
    'label' => esc_html__('Sidebar Layouts', 'sparklestore-pro'),
    'image_path' => $imagepath . '/inc/customizer/images/layout/',
    'choices' => array(
        'leftsidebar' => esc_html__('Left Sidebar', 'sparklestore-pro'),
        'rightsidebar' => esc_html__('Right Sidebar', 'sparklestore-pro'),
        'nosidebar' => esc_html__('No Sidebar', 'sparklestore-pro')
    )
)));

//  Blog Template Blog Posts by Category.
$wp_customize->add_setting('sparklestore_blogtemplate_postcat', array(
    // 'sanitize_callback' => 'sanitize_text_field',     //done
));

$wp_customize->add_control(new Sparklestore_Pro_Dropdown_Multiple_Chooser($wp_customize, 'sparklestore_blogtemplate_postcat', array(
    'label'    => esc_html__('Select Category To Show Posts', 'sparklestore-pro'),
    'settings' => 'sparklestore_blogtemplate_postcat',
    'section'  => 'sparklestore_home_blog_settings_section',
    'placeholder' => esc_html__('Select Multiple Category', 'sparklestore-pro'),
    'choices'  => $sparklestore_pro_cat,
    'description' => esc_html__('Note: Selected Category Only Work When you can select page template (
        Blog Template )','sparklestore-pro'),
)));


$post_description = array(
    'none'     => esc_html__( 'None', 'sparklestore-pro' ),
    'excerpt'  => esc_html__( 'Post Excerpt', 'sparklestore-pro' ),
    'content'  => esc_html__( 'Post Content', 'sparklestore-pro' )
);
    
    $wp_customize->add_setting( 
        'sparklestore_post_description_options', 

        array(
            'default'           => 'excerpt',
            'sanitize_callback' => 'sparklestore_pro_sanitize_select'
        ) 
    );
    
    $wp_customize->add_control( 
        'sparklestore_post_description_options', 

        array(
            'type' => 'select',
            'label' => esc_html__( 'Post Description', 'sparklestore-pro' ),
            'section' => 'sparklestore_home_blog_settings_section',
            'choices' => $post_description
        ) 
    );

    /** text alignment */
    $wp_customize->add_setting( 
        'sparklestore_post_description_text_alignment', 

        array(
            'default'           => 'center',
            'sanitize_callback' => 'sparklestore_pro_sanitize_select'
        ) 
    );
    
    $wp_customize->add_control( 
        'sparklestore_post_description_text_alignment', 

        array(
            'type' => 'select',
            'label' => esc_html__( 'Text Alignment', 'sparklestore-pro' ),
            'section' => 'sparklestore_home_blog_settings_section',
            'choices' => array(
                'center'   => esc_html__('Center', 'sparklestore-pro'),
                'left'   => esc_html__('Left', 'sparklestore-pro'),
                'right'   => esc_html__('Right', 'sparklestore-pro'),
            )
        ) 
    );


    // Blog Template Read More Button.
    $wp_customize->add_setting( 'sparklestore_blogtemplate_btn', array(
        'sanitize_callback' => 'sanitize_text_field',   //done
        'default'   => esc_html__( 'Read More', 'sparklestore-pro' ),
    ));

    $wp_customize->add_control('sparklestore_blogtemplate_btn', array(
        'label'     => esc_html__( 'Enter Blog Button Text', 'sparklestore-pro' ),
        'section'   => 'sparklestore_home_blog_settings_section',
        'type'      => 'text',
    ));


    /**
     * Number field for Excerpt Length section
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'sparklestore_post_excerpt_length',
        array(
            'default'    => 45,
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
        'sparklestore_post_excerpt_length',

        array(
            'type'      => 'number',
            'label'     => esc_html__( 'Enter Posts Excerpt Length', 'sparklestore-pro' ),
            'section'   => 'sparklestore_home_blog_settings_section',
        )
    );

    /**
     * Enable/Disable Post Date
     */
    $wp_customize->add_setting( 
        'sparklestore_post_date_options', 

        array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_text',
        'default' => 'on'
        ) 
    );

    $wp_customize->add_control( new Sparklestore_Pro_Switch_Control( $wp_customize, 

        'sparklestore_post_date_options', 

        array(
            'section'       => 'sparklestore_home_blog_settings_section',
            'label'         => esc_html__( 'Enable Post Date', 'sparklestore-pro' ),
            'on_off_label'  => array(
                'on'  => esc_html__( 'On', 'sparklestore-pro' ),
                'off' => esc_html__( 'Off', 'sparklestore-pro' )
            )   
        ) 
        ) 
    );


    /**
     * Enable/Disable Post Author
     */
    $wp_customize->add_setting( 
        'sparklestore_post_author_options', 

        array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_text',
        'default' => 'on'
        ) 
    );

    $wp_customize->add_control( new Sparklestore_Pro_Switch_Control( $wp_customize, 

        'sparklestore_post_author_options', 

        array(
            'section'       => 'sparklestore_home_blog_settings_section',
            'label'         => esc_html__( 'Enable Post Author', 'sparklestore-pro' ),
            'on_off_label'  => array(
                'on'  => esc_html__( 'On', 'sparklestore-pro' ),
                'off' => esc_html__( 'Off', 'sparklestore-pro' )
            )   
        ) 
        ) 
    );


    /**
     * Enable/Disable Post Comments
     */
    $wp_customize->add_setting( 
        'sparklestore_post_comments_options', 

        array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_text',
        'default' => 'on'
        ) 
    );

    $wp_customize->add_control( new Sparklestore_Pro_Switch_Control( $wp_customize, 

        'sparklestore_post_comments_options', 

        array(
            'section'       => 'sparklestore_home_blog_settings_section',
            'label'         => esc_html__( 'Enable Post Comments', 'sparklestore-pro' ),
            'on_off_label'  => array(
                'on'  => esc_html__( 'ON', 'sparklestore-pro' ),
                'off' => esc_html__( 'OFF', 'sparklestore-pro' )
            )   
        ) 
        ) 
    );

    /** blog page style */

    /**
     * Image Radio field for single post sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting('sparklestore_single_blog_sidebar', array(
        'default' => 'rightsidebar',
        'sanitize_callback' => 'sparklestore_pro_sanitize_choices',
        //'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Image_Select($wp_customize, 'sparklestore_single_blog_sidebar', array(
        'section' => 'sparklestore_home_blog_settings_section',
        'type' => 'select',
        'label' => esc_html__('Single Post Sidebar', 'sparklestore-pro'),
        'image_path' => $imagepath . '/inc/customizer/images/layout/',
        'choices' => array(
            'leftsidebar' => esc_html__('Left Sidebar', 'sparklestore-pro'),
            'rightsidebar' => esc_html__('Right Sidebar', 'sparklestore-pro'),
            'nosidebar' => esc_html__('Full Width', 'sparklestore-pro'),
            'middle' => esc_html__('No Sidebar Middle Content', 'sparklestore-pro')
        )
    )));

    // Features Image
    $wp_customize->add_setting( 
        'sparklestore_post_features_options', 

        array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_text',
        'default' => 'on'
        ) 
    );

    $wp_customize->add_control( new Sparklestore_Pro_Switch_Control( $wp_customize, 
        'sparklestore_post_features_options', 
        array(
            'section'       => 'sparklestore_home_blog_settings_section',
            'label'         => esc_html__( 'Display Features Image', 'sparklestore-pro' ),
            'on_off_label'  => array(
                'on'  => esc_html__( 'ON', 'sparklestore-pro' ),
                'off' => esc_html__( 'OFF', 'sparklestore-pro' )
            )   
        ) 
    ));
    
    // tags
    $wp_customize->add_setting( 
        'sparklestore_post_tags_options', 

        array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_text',
        'default' => 'on'
        ) 
    );

    $wp_customize->add_control( new Sparklestore_Pro_Switch_Control( $wp_customize, 
        'sparklestore_post_tags_options', 
        array(
            'section'       => 'sparklestore_home_blog_settings_section',
            'label'         => esc_html__( 'Display Post Tags', 'sparklestore-pro' ),
            'on_off_label'  => array(
                'on'  => esc_html__( 'ON', 'sparklestore-pro' ),
                'off' => esc_html__( 'OFF', 'sparklestore-pro' )
            )   
        ) 
    ));

    $wp_customize->add_setting( 
        'sparklestore_post_author_section_options', 

        array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_text',
        'default' => 'off'
        ) 
    );

    $wp_customize->add_control( new Sparklestore_Pro_Switch_Control( $wp_customize, 
        'sparklestore_post_author_section_options', 
        array(
            'section'       => 'sparklestore_home_blog_settings_section',
            'label'         => esc_html__( 'Display Post Author', 'sparklestore-pro' ),
            'on_off_label'  => array(
                'on'  => esc_html__( 'ON', 'sparklestore-pro' ),
                'off' => esc_html__( 'OFF', 'sparklestore-pro' )
            )   
        ) 
    ));


    $wp_customize->add_setting( 
        'sparklestore_post_pagination_section_options', 

        array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_text',
        'default' => 'on'
        ) 
    );

    $wp_customize->add_control( new Sparklestore_Pro_Switch_Control( $wp_customize, 
        'sparklestore_post_pagination_section_options', 
        array(
            'section'       => 'sparklestore_home_blog_settings_section',
            'label'         => esc_html__( 'Pagination Navigation', 'sparklestore-pro' ),
            'on_off_label'  => array(
                'on'  => esc_html__( 'On', 'sparklestore-pro' ),
                'off' => esc_html__( 'Off', 'sparklestore-pro' )
            )   
        ) 
    ));

    
    /** style section */
    $wp_customize->add_setting("sparklestore_pro_blog_item_bg_color", array(
        'default' => '#fdfdfd',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        //'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "sparklestore_pro_blog_item_bg_color", array(
        'section' => 'sparklestore_home_blog_settings_section',
        'label' => esc_html__('Item Background', 'sparklestore-pro'),
        
    )));


    $wp_customize->add_setting("sparklestore_pro_blog_text_color", array(
        'default' => '#232529',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        //'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "sparklestore_pro_blog_text_color", array(
        'section' => 'sparklestore_home_blog_settings_section',
        'label' => esc_html__('Text Color', 'sparklestore-pro'),
        
    )));


    $wp_customize->add_setting("sparklestore_pro_blog_hover_color", array(
        'default' => '#f33c3c',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        //'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "sparklestore_pro_blog_hover_color", array(
        'section' => 'sparklestore_home_blog_settings_section',
        'label' => esc_html__('Hover Color', 'sparklestore-pro')
    )));

    /** 
     * button and button hover color
     */
    $wp_customize->add_setting('sparklestore_pro_blog_button_bg_color', array(
        'default' => '#003772',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        //'transport' => 'postMessage'
    ));

    $wp_customize->add_setting('sparklestore_pro_blog_button_border_color', array(
        'default' => '#003772',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        //'transport' => 'postMessage'
    ));

    $wp_customize->add_setting('sparklestore_pro_blog_button_text_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        //'transport' => 'postMessage'
    ));

    // Slider Button Hover Color
    $wp_customize->add_setting('sparklestore_pro_blog_button_bg_hov_color', array(
        'default' => '#003772',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        //'transport' => 'postMessage'
    ));

    $wp_customize->add_setting('sparklestore_pro_blog_button_border_hov_color', array(
        'default' => '#003772',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        //'transport' => 'postMessage'
    ));

    $wp_customize->add_setting('sparklestore_pro_blog_button_text_hov_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        //'transport' => 'postMessage'
    ));


    $wp_customize->add_control(new Sparklestore_Pro_Color_Tab_Control($wp_customize, 'sparklestore_pro_blog_button_color_group', array(
        'label' => esc_html__('Button Colors', 'sparklestore-pro'),
        'section' => 'sparklestore_home_blog_settings_section',
        'show_opacity' => false,
        'settings' => array(
            'normal_sparklestore_pro_blog_button_bg_color' => 'sparklestore_pro_blog_button_bg_color',
            'normal_sparklestore_pro_blog_button_border_color' => 'sparklestore_pro_blog_button_border_color',
            'normal_sparklestore_pro_blog_button_text_color' => 'sparklestore_pro_blog_button_text_color',
            'hover_sparklestore_pro_blog_button_bg_hov_color' => 'sparklestore_pro_blog_button_bg_hov_color',
            'hover_sparklestore_pro_blog_button_border_hov_color' => 'sparklestore_pro_blog_button_border_hov_color',
            'hover_sparklestore_pro_blog_button_text_hov_color' => 'sparklestore_pro_blog_button_text_hov_color',
        ),
        'group' => array(
            'normal_sparklestore_pro_blog_button_bg_color' => esc_html__('Button Background Color', 'sparklestore-pro'),
            'normal_sparklestore_pro_blog_button_border_color' => esc_html__('Button Border Color', 'sparklestore-pro'),
            'normal_sparklestore_pro_blog_button_text_color' => esc_html__('Button Text Color', 'sparklestore-pro'),
            'hover_sparklestore_pro_blog_button_bg_hov_color' => esc_html__('Button Background Color', 'sparklestore-pro'),
            'hover_sparklestore_pro_blog_button_border_hov_color' => esc_html__('Button Border Color', 'sparklestore-pro'),
            'hover_sparklestore_pro_blog_button_text_hov_color' => esc_html__('Button Text Color', 'sparklestore-pro')
        )
    )));



/**
 * Search Settings
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
    'sparklestore_layout_settings_section',

    array(
        'title'     => esc_html__( 'Page & Post Layout', 'sparklestore-pro' ),
        'panel'     => 'sparklestore_design_settings_panel',
    )
);      

/**
 * Image Radio field for Page & Post Layout
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'sparklestore_layout_sidebar',
    array(
        'default'           => 'rightsidebar',
        'sanitize_callback' => 'sanitize_key',
    )
);

$wp_customize->add_control( new Sparklestore_Pro_Selector($wp_customize,'sparklestore_layout_sidebar',
    array(
        'label'    => esc_html__( 'Layout Settings', 'sparklestore-pro' ),
        'description' => esc_html__( 'Choose sidebar from available layouts', 'sparklestore-pro' ),
        'section'  => 'sparklestore_layout_settings_section',
        'options' => array(
            'leftsidebar' => $imagepath . '/inc/customizer/images/layout/leftsidebar.png',
            'rightsidebar' => $imagepath . '/inc/customizer/images/layout/rightsidebar.png',
            'nosidebar' => $imagepath . '/inc/customizer/images/layout/nosidebar.png',
        )
    )
));


/**
 * Archive/Category Settings
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
    'sparklestore_archive_settings_section',

    array(
        'title'     => esc_html__( 'Archive/Category Settings', 'sparklestore-pro' ),
        'panel'     => 'sparklestore_design_settings_panel',
    )
);

/**
 * Image Radio field for archive/category layout
 *
 * @since 1.0.0
 */
$wp_customize->add_setting('sparklestore_archive_layout', array(
    'default' => 'default',
    'sanitize_callback' => 'sparklestore_pro_sanitize_choices',
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Image_Select($wp_customize, 'sparklestore_archive_layout', array(
    'section' => 'sparklestore_archive_settings_section',
    'type' => 'select',
    'label' => esc_html__('Category Post Layout', 'sparklestore-pro'),
    'image_path' => $imagepath . '/inc/customizer/images/blog-layout/',
    'choices' => array(
        'default' => esc_html__('Default', 'sparklestore-pro'),
        'masonry' => esc_html__('Masonry', 'sparklestore-pro'),
        'gridview' => esc_html__('Grid View', 'sparklestore-pro'),
        'alternateview' => esc_html__('Alternative List', 'sparklestore-pro'),
        'largelistview' => esc_html__('List View', 'sparklestore-pro')
    )
)));

/**
 * Image Radio field for archive/category sidebar
 *
 * @since 1.0.0
 */

$wp_customize->add_setting('sparklestore_archive_sidebar', array(
    'default' => 'rightsidebar',
    'sanitize_callback' => 'sparklestore_pro_sanitize_choices',
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Image_Select($wp_customize, 'sparklestore_archive_sidebar', array(
    'section' => 'sparklestore_archive_settings_section',
    'type' => 'select',
    'label' => esc_html__('Category Page Sidebar', 'sparklestore-pro'),
    'image_path' => $imagepath . '/inc/customizer/images/layout/',
    'choices' => array(
        'leftsidebar' => esc_html__('Left Sidebar', 'sparklestore-pro'),
        'rightsidebar' => esc_html__('Right Sidebar', 'sparklestore-pro'),
        'nosidebar' => esc_html__('No Sidebar', 'sparklestore-pro')
    )
)));

