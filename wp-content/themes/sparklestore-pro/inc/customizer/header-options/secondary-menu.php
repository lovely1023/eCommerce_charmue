<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*Adding sections for secondary menu options*/
$wp_customize->add_section(
	$this->secondary_menu,
	array(
		'priority'   => 82,
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'Secondary Menu', 'sparklestore-pro' ),
		'panel'      => $this->panel,
	)
);

//tab
$wp_customize->add_setting('sparklestore_pro_secondary_menu_nav', array(
	'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_pro_secondary_menu_nav', array(
	'type' => 'tab',
	'section' => $this->secondary_menu,
	'buttons' => array(
		array(
			'name' => esc_html__('Settings', 'sparklestore-pro'),
			'active' => true,
			'fields' => array(
				'secondary-menu-custom-menu',
				'secondary-menu-disable-sub-menu',
				'secondary-menu-layout-msg',
				'secondary-menu-align',
				'secondary-menu-item-margin',
				'secondary-menu-item-padding',
				'secondary-menu-sub-menu-layout-msg',
				'secondary-menu-sub-menu-item-margin',
				'secondary-menu-sub-menu-item-padding',

				'secondary-menu-margin-padding-msg',
				'secondary-menu-margin',
				'secondary-menu-padding'


			),
		),
		array(
			'name' => esc_html__('Color', 'sparklestore-pro'),
			'fields' => array(
				'secondary-color-msg',
				'sparklestore_second_menu_item_color',
				'sparklestore_pro_main_hover_menu_heading',
				'sparklestore_second_menu_active_bg_color',
				'sparklestore_second_menu_active_item_color',
				'sparklestore_pro_second_sub_menu_heading',
				'sparklestore_pro_second_sub_menu_bg_color',
				'sparklestore_pro_second_sub_menu_text_color',
				'sparklestore_pro_second_sub_menu_hover_bg_color',
				'sparklestore_pro_second_sub_menu_hover_text_color',

			),
		),
	),
)));


/*Secondary Menu*/
$choices = sparklewp_get_nav_menus();
$wp_customize->add_setting(
	'secondary-menu-custom-menu',
	array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'secondary-menu-custom-menu',
	array(
		'label'    => esc_html__( 'Select Secondary Menu', 'sparklestore-pro' ),
		'section'  => $this->secondary_menu,
		'settings' => 'secondary-menu-custom-menu',
		'type'     => 'select',
		'choices'  => $choices,
	)
);

/*Disable Sub menu */
$wp_customize->add_setting(
	'secondary-menu-disable-sub-menu',
	array(
		'default'           => false,
		'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'secondary-menu-disable-sub-menu',
	array(
		'label'    => esc_html__( 'Disable Sub Menu Item', 'sparklestore-pro' ),
		'section'  => $this->secondary_menu,
		'settings' => 'secondary-menu-disable-sub-menu',
		'type'     => 'checkbox',
	)
);
/*Secondary Menu align*/
$wp_customize->add_setting(
	'secondary-menu-align',
	array(
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		'default' => 'swp-flex-align-left',
		// 'transport'         => 'postMessage',
	)
);
$choices = sparklewp_flex_align();
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Buttonset(
		$wp_customize,
		'secondary-menu-align',
		array(
			'choices'  => $choices,
			'label'    => esc_html__( 'Secondary Menu Alignment', 'sparklestore-pro' ),
			'section'  => $this->secondary_menu,
			'settings' => 'secondary-menu-align',
		)
	)
);

/*Margin and Padding msg*/
$wp_customize->add_setting(
	'secondary-menu-margin-padding-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'secondary-menu-margin-padding-msg',
		array(
			'label'   => esc_html__( 'Margin & Padding', 'sparklestore-pro' ),
			'section' => $this->secondary_menu,
		)
	)
);

/* Margin*/
$wp_customize->add_setting(
	'secondary-menu-margin',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'secondary-menu-margin',
		array(
			'label'    => esc_html__( 'Margin', 'sparklestore-pro' ),
			'section'  => $this->secondary_menu,
			'settings' => 'secondary-menu-margin',
		),
		array(),
		array()
	)
);

/* Padding*/
$wp_customize->add_setting(
	'secondary-menu-padding',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'secondary-menu-padding',
		array(
			'label'    => esc_html__( 'Padding', 'sparklestore-pro' ),
			'section'  => $this->secondary_menu,
			'settings' => 'secondary-menu-padding',
		),
		array(),
		array()
	)
);

/*Margin and padding*/
$wp_customize->add_setting(
	'secondary-menu-layout-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'secondary-menu-layout-msg',
		array(
			'label'   => esc_html__( 'Menu Item Margin & Padding', 'sparklestore-pro' ),
			'section' => $this->secondary_menu,
		)
	)
);


/* Margin*/
$wp_customize->add_setting(
	'secondary-menu-item-margin',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'secondary-menu-item-margin',
		array(
			'label'    => esc_html__( 'Margin (px)', 'sparklestore-pro' ),
			'section'  => $this->secondary_menu,
			'settings' => 'secondary-menu-item-margin',
		),
		array(),
		array()
	)
);

/* Padding*/
$wp_customize->add_setting(
	'secondary-menu-item-padding',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'secondary-menu-item-padding',
		array(
			'label'    => esc_html__( 'Padding (px)', 'sparklestore-pro' ),
			'section'  => $this->secondary_menu,
			'settings' => 'secondary-menu-item-padding',
		),
		array(),
		array()
	)
);
// Heading
$wp_customize->add_setting(
	'secondary-color-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'secondary-color-msg',
		array(
			'label'   => esc_html__( 'Color', 'sparklestore-pro' ),
			'section' => $this->secondary_menu,
		)
	)
);

/**
 * Style Tab Content
 */

$wp_customize->add_setting(
    'sparklestore_second_menu_item_color', array(
        'default'     => '',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_second_menu_item_color', array(
    'label'      => esc_html__( 'Menu Items Color', 'sparklestore-pro' ),
    'section'    => $this->secondary_menu,
)));


$wp_customize->add_setting("sparklestore_pro_main_hover_menu_heading", array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, "sparklestore_pro_main_hover_menu_heading", array(
    'section' => $this->secondary_menu,
    'label' => esc_html__('Menu Item', 'sparklestore-pro')
)));

$wp_customize->add_setting(
    'sparklestore_second_menu_active_bg_color', array(
        'default'     => '#f33c3c',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_second_menu_active_bg_color', array(
    'label'      => esc_html__( 'Hover & Active BG Color', 'sparklestore-pro' ),
    'section'    => $this->secondary_menu,
)));


$wp_customize->add_setting(
    'sparklestore_second_menu_active_item_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_second_menu_active_item_color', array(
    'label'      => esc_html__( 'Active & Hover Color', 'sparklestore-pro' ),
    'section'    => $this->secondary_menu,
)));

/**
 * Sub Menu 
 */
$wp_customize->add_setting("sparklestore_pro_second_sub_menu_heading", array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, "sparklestore_pro_second_sub_menu_heading", array(
    'section' => $this->secondary_menu,
    'label' => esc_html__('Sub Menu', 'sparklestore-pro')
)));

$wp_customize->add_setting(
    'sparklestore_pro_second_sub_menu_bg_color', array(
        'default'     => 'rgba(255,255,255,1)',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_second_sub_menu_bg_color', array(
    'label'      => esc_html__( 'Background', 'sparklestore-pro' ),
    'section'    => $this->secondary_menu,
)));

$wp_customize->add_setting(
    'sparklestore_pro_second_sub_menu_text_color', array(
        'default'     => '#232529',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_second_sub_menu_text_color', array(
    'label'      => esc_html__( 'Text Color', 'sparklestore-pro' ),
    'section'    => $this->secondary_menu,
)));


$wp_customize->add_setting(
    'sparklestore_pro_second_sub_menu_hover_bg_color', array(
        'default'     => '#fff',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_second_sub_menu_hover_bg_color', array(
    'label'      => esc_html__( 'Hover & Active BG Color', 'sparklestore-pro' ),
    'section'    => $this->secondary_menu,
)));

$wp_customize->add_setting(
    'sparklestore_pro_second_sub_menu_hover_text_color', array(
        'default'     => '#000',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_second_sub_menu_hover_text_color', array(
    'label'      => esc_html__( 'Hover & Active Color', 'sparklestore-pro' ),
    'section'    => $this->secondary_menu,
)));