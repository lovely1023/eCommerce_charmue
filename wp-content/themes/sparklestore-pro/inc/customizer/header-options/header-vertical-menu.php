<?php
/**
 * Vertical Menu Settings
*/
$wp_customize->add_section( 'sparklestore_vertical_menu_section',array(
        'title'     => esc_html__( 'Vertical Menu Settings', 'sparklestore-pro' ),
        'panel' => $this->panel,
        'priority'   => 81
    )
);

/** vertical menu tab */
$wp_customize->add_setting('sparklestore_vertical_menu_section_nav', array(
    // 'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_vertical_menu_section_nav', array(
    'type' => 'tab',
    'section' => 'sparklestore_vertical_menu_section',
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_vertical_menu_title',
                'sparklestore_vertical_menu_show_all_menu',
                'sparklestore_vertical_menu_show_all_menu_close',
                'sparklestore_vertical_menu_display_itmes',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_main_vertical_menu_heading',
                'sparklestore_vertical_menu_title_bg_color',
                'sparklestore_vertical_menu_title_text_color',
                'sparklestore_pro_main_vertical_menu_content',
                'sparklestore_vertical_menu_bg_color',
                'sparklestore_vertical_menu_item_hover_color',
                'sparklestore_vertical_menu_item_text_color',
                'sparklestore_vertical_menu_item_hover_text_color',
                'sparklestore_vertical_menu_item_hover_bg_color'
            ),
        ),
    ),
)));

/**
 * Text field for Vertical Menu Title
*/
$wp_customize->add_setting(
    'sparklestore_vertical_menu_title',

    array(
        'default'    => esc_html__( 'More Categories', 'sparklestore-pro' ),
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    'sparklestore_vertical_menu_title',

    array(
        'type'      => 'text',
        'label'     => esc_html__( 'Menu Title', 'sparklestore-pro' ),
        'section'   => 'sparklestore_vertical_menu_section',
    )
);

$wp_customize->selective_refresh->add_partial('sparklestore_vertical_menu_title', array(
    'selector' => '.block-nav-category .block-title',
    // 'render_callback' => 'sparklestore_pro_gdpr_notice',
    'container_inclusive' => false
));

/**
 * Text field for Vertical Menu Show All Menu Text
*/
$wp_customize->add_setting(
    'sparklestore_vertical_menu_show_all_menu',

    array(
        'default'    => esc_html__( 'More Categories', 'sparklestore-pro' ),
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    'sparklestore_vertical_menu_show_all_menu',

    array(
        'type'      => 'text',
        'label'     => esc_html__( 'Show All Menu Text', 'sparklestore-pro' ),
        'section'   => 'sparklestore_vertical_menu_section',
    )
);


/**
 * Text field for Vertical Menu Button Close Text
*/
$wp_customize->add_setting(
    'sparklestore_vertical_menu_show_all_menu_close',

    array(
        'default'    => esc_html__( 'Close', 'sparklestore-pro' ),
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    'sparklestore_vertical_menu_show_all_menu_close',

    array(
        'type'      => 'text',
        'label'     => esc_html__( 'Button Close Text', 'sparklestore-pro' ),
        'section'   => 'sparklestore_vertical_menu_section',
    )
);


/**
 * Text field for Visible Vertical Menu Items
*/
$wp_customize->add_setting(
    'sparklestore_vertical_menu_display_itmes',

    array(
        'default'    => 11,
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(new Sparklestore_Pro_Range_Control($wp_customize, "sparklestore_vertical_menu_display_itmes", array(
    'section'   => 'sparklestore_vertical_menu_section',
    'label'     => esc_html__( 'Menu Items', 'sparklestore-pro' ),
    'input_attrs' => array(
        'min' => 5,
        'max' => 50,
        'step' => 1,
    )
)));

// Style Vertical Menu Settings

$wp_customize->add_setting("sparklestore_pro_main_vertical_menu_heading", array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, "sparklestore_pro_main_vertical_menu_heading", array(
    'section' => 'sparklestore_vertical_menu_section',
    'label' => esc_html__('Vertical Heading', 'sparklestore-pro')
)));

$wp_customize->add_setting(
    'sparklestore_vertical_menu_title_bg_color', array(
        'default'     => '#f33c3c',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    )
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'sparklestore_vertical_menu_title_bg_color',array(
            'label'      => esc_html__( 'Title Background Color', 'sparklestore-pro' ),
            'section'    => 'sparklestore_vertical_menu_section',
        )
    )
);

$wp_customize->add_setting(
    'sparklestore_vertical_menu_title_text_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    )
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'sparklestore_vertical_menu_title_text_color',array(
            'label'      => esc_html__( 'Title Text Color', 'sparklestore-pro' ),
            'section'    => 'sparklestore_vertical_menu_section',
        )
    )
);

$wp_customize->add_setting("sparklestore_pro_main_vertical_menu_content", array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, "sparklestore_pro_main_vertical_menu_content", array(
    'section' => 'sparklestore_vertical_menu_section',
    'label' => esc_html__('Vertical Menu Items', 'sparklestore-pro')
)));

$wp_customize->add_setting(
    'sparklestore_vertical_menu_bg_color',
    array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    )
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'sparklestore_vertical_menu_bg_color',
        array(
            'label'      => esc_html__( 'Background Colors', 'sparklestore-pro' ),
            'section'    => 'sparklestore_vertical_menu_section',
        )
    )
);

$wp_customize->add_setting(
    'sparklestore_vertical_menu_item_text_color', array(
        'default'     => '#232529',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    )
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'sparklestore_vertical_menu_item_text_color', array(
            'label'      => esc_html__( 'Text Colors', 'sparklestore-pro' ),
            'section'    => 'sparklestore_vertical_menu_section',
        )
    )
);


$wp_customize->add_setting(
    'sparklestore_vertical_menu_item_hover_bg_color', array(
        'default'     => '#f33c3c',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    )
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'sparklestore_vertical_menu_item_hover_bg_color', array(
            'label'      => esc_html__( 'Menu Item Hover BG Color', 'sparklestore-pro' ),
            'section'    => 'sparklestore_vertical_menu_section',
        )
    )
);

$wp_customize->add_setting(
    'sparklestore_vertical_menu_item_hover_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    )
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'sparklestore_vertical_menu_item_hover_color', array(
            'label'      => esc_html__( 'Menu Item Hover Text Color', 'sparklestore-pro' ),
            'section'    => 'sparklestore_vertical_menu_section',
        )
    )
);