<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Primary Menu Section*/
$wp_customize->add_section(
	$this->primary_menu,
	array(
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'Primary Menu', 'sparklestore-pro' ),
		'panel'      => $this->panel,
		'priority'   => 80,
	)
);

$wp_customize->add_setting('sparklestore_pro_primary_menu_nav', array(
	'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_pro_primary_menu_nav', array(
	'type' => 'tab',
	'section' => $this->primary_menu,
	'buttons' => array(
		array(
			'name' => esc_html__('Settings', 'sparklestore-pro'),
			'active' => true,
			'fields' => array(
				'primary-menu-custom-menu',
				'primary-menu-disable-sub-menu',
				'primary-menu-layout-msg',
				'primary-menu-align',
				'primary-menu-item-margin',
				'primary-menu-item-padding',
				'primary-menu-sub-menu-layout-msg',
				'primary-menu-sub-menu-item-margin',
				'primary-menu-sub-menu-item-padding',

				'primary-menu-margin-padding-msg',
				'primary-menu-margin',
				'primary-menu-padding'


			),
		),
		array(
			'name' => esc_html__('Color', 'sparklestore-pro'),
			'fields' => array(
				'sparklestore_main_menu_bg_color',
				'sparklestore_main_menu_item_color',
				'sparklestore_pro_main_hover_menu_heading',
				'sparklestore_main_menu_active_bg_color',
				'sparklestore_main_menu_active_item_color',
				'sparklestore_pro_main_sub_menu_heading',
				'sparklestore_pro_main_sub_menu_bg_color',
				'sparklestore_pro_main_sub_menu_text_color',
				'sparklestore_pro_main_sub_menu_hover_bg_color',
				'sparklestore_pro_main_sub_menu_hover_text_color',

			),
		),
	),
)));



/*Custom Menu*/
$choices = sparklewp_get_nav_menus();
$wp_customize->add_setting(
	'primary-menu-custom-menu',
	array(
		'capability'        => 'edit_theme_options',
		'default'           => $header_defaults['primary-menu-custom-menu'],
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'primary-menu-custom-menu',
	array(
		'label'           => esc_html__( 'Select Primary Menu', 'sparklestore-pro' ),
		'section'         => $this->primary_menu,
		'settings'        => 'primary-menu-custom-menu',
		'type'            => 'select',
		'choices'         => $choices,
	)
);

/*Disable Sub menu */
$wp_customize->add_setting(
	'primary-menu-disable-sub-menu',
	array(
		'default'           => false,
		'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'primary-menu-disable-sub-menu',
	array(
		'label'    => esc_html__( 'Disable Sub Menu Item', 'sparklestore-pro' ),
		'section'  => $this->primary_menu,
		'settings' => 'primary-menu-disable-sub-menu',
		'type'     => 'checkbox',
	)
);

/*Margin and Padding msg*/
$wp_customize->add_setting(
	'primary-menu-margin-padding-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'primary-menu-margin-padding-msg',
		array(
			'label'   => esc_html__( 'Margin & Padding', 'sparklestore-pro' ),
			'section' => $this->primary_menu,
		)
	)
);

/*Margin*/
$wp_customize->add_setting(
	'primary-menu-margin',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => $header_defaults['primary-menu-margin'],
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'primary-menu-margin',
		array(
			'label'    => esc_html__( 'Margin', 'sparklestore-pro' ),
			'section'  => $this->primary_menu,
			'settings' => 'primary-menu-margin',
		),
		array(),
		array()
	)
);

/*Padding*/
$wp_customize->add_setting(
	'primary-menu-padding',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => $header_defaults['primary-menu-padding'],
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'primary-menu-padding',
		array(
			'label'    => esc_html__( 'Padding', 'sparklestore-pro' ),
			'section'  => $this->primary_menu,
			'settings' => 'primary-menu-padding',
		),
		array(),
		array()
	)
);


/*Primary menu Styling*/
$wp_customize->add_setting(
	'primary-menu-layout-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'primary-menu-layout-msg',
		array(
			'label'   => esc_html__( 'Primary Menu Item Layout', 'sparklestore-pro' ),
			'section' => $this->primary_menu,
		)
	)
);

/*Primary Menu align*/
$wp_customize->add_setting(
	'primary-menu-align',
	array(
		'default'           => 'swp-flex-align-left',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		// 'transport'         => 'postMessage',
	)
);
$choices = sparklewp_flex_align();
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Buttonset(
		$wp_customize,
		'primary-menu-align',
		array(
			'choices'  => $choices,
			'label'    => esc_html__( 'Menu Alignment', 'sparklestore-pro' ),
			'section'  => $this->primary_menu,
			'settings' => 'primary-menu-align',
		)
	)
);

/*Margin*/
$wp_customize->add_setting(
	'primary-menu-item-margin',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => $header_defaults['primary-menu-item-margin'],
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'primary-menu-item-margin',
		array(
			'label'    => esc_html__( 'Margin', 'sparklestore-pro' ),
			'section'  => $this->primary_menu,
			'settings' => 'primary-menu-item-margin',
		),
		array(),
		array()
	)
);

/*Padding*/
$wp_customize->add_setting(
	'primary-menu-item-padding',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => $header_defaults['primary-menu-item-padding'],
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'primary-menu-item-padding',
		array(
			'label'    => esc_html__( 'Padding', 'sparklestore-pro' ),
			'section'  => $this->primary_menu,
			'settings' => 'primary-menu-item-padding',
		),
		array(),
		array()
	)
);

/*Primary menu Styling*/
$wp_customize->add_setting(
	'primary-menu-sub-menu-layout-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'primary-menu-sub-menu-layout-msg',
		array(
			'label'   => esc_html__( 'Sub Menu Item Layout', 'sparklestore-pro' ),
			'section' => $this->primary_menu,
		)
	)
);

/*Margin*/
$wp_customize->add_setting(
	'primary-menu-sub-menu-item-margin',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => $header_defaults['primary-menu-sub-menu-item-margin'],
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'primary-menu-sub-menu-item-margin',
		array(
			'label'    => esc_html__( 'Margin', 'sparklestore-pro' ),
			'section'  => $this->primary_menu,
			'settings' => 'primary-menu-sub-menu-item-margin',
		),
		array(),
		array()
	)
);

/*Padding*/
$wp_customize->add_setting(
	'primary-menu-sub-menu-item-padding',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => $header_defaults['primary-menu-sub-menu-item-padding'],
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'primary-menu-sub-menu-item-padding',
		array(
			'label'    => esc_html__( 'Padding', 'sparklestore-pro' ),
			'section'  => $this->primary_menu,
			'settings' => 'primary-menu-sub-menu-item-padding',
		),
		array(),
		array()
	)
);

/**
 * Style Tab Content
 */
$wp_customize->add_setting(
    'sparklestore_main_menu_bg_color', array(
        'default'     => 'rgba(255,255,255,0)',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_main_menu_bg_color', array(
    'label'      => esc_html__( 'Menu Background Color', 'sparklestore-pro' ),
    'section'    => $this->primary_menu,
)));

$wp_customize->add_setting(
    'sparklestore_main_menu_item_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_main_menu_item_color', array(
    'label'      => esc_html__( 'Menu Items Color', 'sparklestore-pro' ),
    'section'    => $this->primary_menu,
)));


$wp_customize->add_setting("sparklestore_pro_main_hover_menu_heading", array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, "sparklestore_pro_main_hover_menu_heading", array(
    'section' => $this->primary_menu,
    'label' => esc_html__('Menu Item', 'sparklestore-pro')
)));

$wp_customize->add_setting(
    'sparklestore_main_menu_active_bg_color', array(
        'default'     => '#f33c3c',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_main_menu_active_bg_color', array(
    'label'      => esc_html__( 'Hover & Active BG Color', 'sparklestore-pro' ),
    'section'    => $this->primary_menu,
)));


$wp_customize->add_setting(
    'sparklestore_main_menu_active_item_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_main_menu_active_item_color', array(
    'label'      => esc_html__( 'Active & Hover Color', 'sparklestore-pro' ),
    'section'    => $this->primary_menu,
)));

/**
 * Sub Menu 
 */
$wp_customize->add_setting("sparklestore_pro_main_sub_menu_heading", array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, "sparklestore_pro_main_sub_menu_heading", array(
    'section' => $this->primary_menu,
    'label' => esc_html__('Sub Menu', 'sparklestore-pro')
)));

$wp_customize->add_setting(
    'sparklestore_pro_main_sub_menu_bg_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_main_sub_menu_bg_color', array(
    'label'      => esc_html__( 'Background', 'sparklestore-pro' ),
    'section'    => $this->primary_menu,
)));

$wp_customize->add_setting(
    'sparklestore_pro_main_sub_menu_text_color', array(
        'default'     => '#232529',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_main_sub_menu_text_color', array(
    'label'      => esc_html__( 'Text Color', 'sparklestore-pro' ),
    'section'    => $this->primary_menu,
)));


$wp_customize->add_setting(
    'sparklestore_pro_main_sub_menu_hover_bg_color', array(
        'default'     => 'rgba(243,60,60,1)',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_main_sub_menu_hover_bg_color', array(
    'label'      => esc_html__( 'Hover & Active BG Color', 'sparklestore-pro' ),
    'section'    => $this->primary_menu,
)));

$wp_customize->add_setting(
    'sparklestore_pro_main_sub_menu_hover_text_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    )
); 
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_main_sub_menu_hover_text_color', array(
    'label'      => esc_html__( 'Hover & Active Color', 'sparklestore-pro' ),
    'section'    => $this->primary_menu,
)));

$wp_customize->selective_refresh->add_partial( 'primary-menu-custom-menu', array(
	'selector' => '.header-container .box-header-nav',
	'container_inclusive' => false,
) );