<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*Menu Icon */
$wp_customize->add_section(
	new SparkleWP_Customize_Section_H3(
		$wp_customize,
		'sparklewp_menu_icon_seperator',
		array(
			'title'    => esc_html__( 'Mobile Menu', 'sparklestore-pro' ),
			'panel'    => $this->panel,
			'priority' => 190,
		)
	)
);

/*Menu Icon section*/
$wp_customize->add_section(
	$this->menu_icon,
	array(
		'title'    => esc_html__( 'Menu Icon', 'sparklestore-pro' ),
		'panel'    => $this->panel,
		'priority' => 191,
	)
);

/*Menu Styling*/
$wp_customize->add_setting(
	'menu-icon-open-icon-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'menu-icon-open-icon-msg',
		array(
			'label'   => esc_html__( 'Open Icon/Text Setting', 'sparklestore-pro' ),
			'section' => $this->menu_icon,
		)
	)
);

/*Menu icon*/
$wp_customize->add_setting(
	'menu-icon-open-icon-options',
	array(
		'default'           => 'icon',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	'menu-icon-open-icon-options',
	array(
		'choices'  => sparklewp_menu_indicator_options(),
		'label'    => esc_html__( 'Menu Indicator Option', 'sparklestore-pro' ),
		'section'  => $this->menu_icon,
		'settings' => 'menu-icon-open-icon-options',
		'type'     => 'select',
	)
);

/*Menu open Text*/
$wp_customize->add_setting(
	'menu-open-text',
	array(
		'default'           => esc_html__('Menu', 'sparklestore-pro'),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'menu-open-text',
	array(
		'label'           => esc_html__( 'Open Text', 'sparklestore-pro' ),
		'section'         => $this->menu_icon,
		'settings'        => 'menu-open-text',
		'type'            => 'text',
	)
);


/*Menu Open Icon*/
$wp_customize->add_setting(
	'menu-open-icon',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => 'fas fa-bars',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Fontawesome_Icon_Chooser(
		$wp_customize,
		'menu-open-icon',
		array(
			'label'           => esc_html__( 'Open Icon', 'sparklestore-pro' ),
			'section'         => $this->menu_icon,
			'settings'        => 'menu-open-icon',
		)
	)
);

/*Icon Position*/
$wp_customize->add_setting(
	'menu-icon-open-icon-position',
	array(
		'default'           => 'before',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		'transport'         => 'postMessage',
	)
);
$choices = sparklewp_icon_position();
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Buttonset(
		$wp_customize,
		'menu-icon-open-icon-position',
		array(
			'choices'         => $choices,
			'label'           => esc_html__( 'Icon Position Beside Text', 'sparklestore-pro' ),
			'section'         => $this->menu_icon,
			'settings'        => 'menu-icon-open-icon-position',
		)
	)
);

/*Menu icon size */
/** menu-open-icon-size-responsive size control */
$wp_customize->add_setting("sparklestore_pro_menu_open_size", array(
	'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
	'default' => 25,
	// 'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_menu_open_size_tablet", array(
	'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
	// 'transport' => 'postMessage'
));

$wp_customize->add_setting("sparklestore_pro_menu_open_size_mobile", array(
	'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
	// 'transport' => 'postMessage'
));

$wp_customize->add_setting(
	'menu-open-icon-size-responsive',
	array(
		// 'default'           => $header_defaults['menu-open-icon-size-responsive'],
		'sanitize_callback' => 'sparklewp_sanitize_slider_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Range_Slider_Control(
		$wp_customize,
		'menu-open-icon-size-responsive',
		array(
			'label'           => esc_html__( 'Icon Size', 'sparklestore-pro' ),
			'section'         => $this->menu_icon,
			'settings'        => 'menu-open-icon-size-responsive',
			'input_attrs'     => array(
				'min'  => 10,
				'max'  => 100,
				'step' => 1,
			),
			'settings' => array(
				'desktop' => "sparklestore_pro_menu_open_size",
				'tablet' => "sparklestore_pro_menu_open_size_tablet",
				'mobile' => "sparklestore_pro_menu_open_size_mobile",
			)
		)
	)
);

/*Menu Icon align*/
$wp_customize->add_setting(
	'menu-open-icon-align',
	array(
		'default'           => 'swp-flex-align-left',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Buttonset(
		$wp_customize,
		'menu-open-icon-align',
		array(
			'choices'  => sparklewp_flex_align(),
			'label'    => esc_html__( 'Icon/Text Alignment', 'sparklestore-pro' ),
			'section'  => $this->menu_icon,
			'settings' => 'menu-open-icon-align',
		)
	)
);

/*Padding*/
$wp_customize->add_setting(
	'menu-open-icon-padding',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => $header_defaults['menu-open-icon-padding'],
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'menu-open-icon-padding',
		array(
			'label'    => esc_html__( 'Padding', 'sparklestore-pro' ),
			'section'  => $this->menu_icon,
			'settings' => 'menu-open-icon-padding',
		),
		array(),
		array()
	)
);

/*Margin*/
$wp_customize->add_setting(
	'menu-open-icon-margin',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => $header_defaults['menu-open-icon-margin'],
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'menu-open-icon-margin',
		array(
			'label'    => esc_html__( 'Margin', 'sparklestore-pro' ),
			'section'  => $this->menu_icon,
			'settings' => 'menu-open-icon-margin',
		),
		array(),
		array()
	)
);

/** color */
$wp_customize->add_setting(
    'menu-open-icon-color', array(
        'default'     => '#000',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    )
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        'menu-open-icon-color',array(
            'label'      => esc_html__( 'Color', 'sparklestore-pro' ),
            'section'    => $this->menu_icon,
        )
    )
);


/*Menu close*/
$wp_customize->add_setting(
	'menu-icon-close-icon-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'menu-icon-close-icon-msg',
		array(
			'label'   => esc_html__( 'Close Icon/Text Setting', 'sparklestore-pro' ),
			'section' => $this->menu_icon,
		)
	)
);

/*Menu icon*/
$wp_customize->add_setting(
	'menu-icon-close-icon-options',
	array(
		'default'           => 'icon',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		'transport'         => 'postMessage',
	)
);
$choices = sparklewp_menu_indicator_options();
$wp_customize->add_control(
	'menu-icon-close-icon-options',
	array(
		'choices'  => $choices,
		'label'    => esc_html__( 'Close Menu Icon Option', 'sparklestore-pro' ),
		'section'  => $this->menu_icon,
		'settings' => 'menu-icon-close-icon-options',
		'type'     => 'select',
	)
);

/*Menu Close Text*/
$wp_customize->add_setting(
	'menu-close-text',
	array(
		'default'           => esc_html__( 'Close ', 'sparklestore-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'menu-close-text',
	array(
		'label'           => esc_html__( 'Close Text', 'sparklestore-pro' ),
		'section'         => $this->menu_icon,
		'settings'        => 'menu-close-text',
		'type'            => 'text',
	)
);


/*Menu Close Icon*/
$wp_customize->add_setting(
	'menu-close-icon',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => 'far fa-window-close',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Fontawesome_Icon_Chooser(
		$wp_customize,
		'menu-close-icon',
		array(
			'label'           => esc_html__( 'Close Icon', 'sparklestore-pro' ),
			'section'         => $this->menu_icon,
			'settings'        => 'menu-close-icon',
		)
	)
);

/*Icon Position*/
$wp_customize->add_setting(
	'menu-icon-close-icon-position',
	array(
		'default'           => 'before',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	new SparkleWP_Custom_Control_Buttonset(
		$wp_customize,
		'menu-icon-close-icon-position',
		array(
			'choices'         => sparklewp_icon_position(),
			'label'           => esc_html__( 'Icon Position Beside Text', 'sparklestore-pro' ),
			'section'         => $this->menu_icon,
			'settings'        => 'menu-icon-close-icon-position',
		)
	)
);

$wp_customize->selective_refresh->add_partial( 'menu-icon-open-icon-options', array(
	'selector' => '.header-container .sp-toggle-nav-icon',
) );