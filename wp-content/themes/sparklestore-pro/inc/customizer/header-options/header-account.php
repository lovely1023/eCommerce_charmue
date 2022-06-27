<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/* Account Section*/
$wp_customize->add_section(
	$this->login_register,
	array(
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'Account(Login/Register)', 'sparklestore-pro' ),
		'panel'      => $this->panel,
		'priority'   => 87,
	)
);
// Heading
$wp_customize->add_setting(
	'account-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'account-msg',
		array(
			'label'   => esc_html__( 'Account Settings', 'sparklestore-pro' ),
			'section' => $this->login_register,
		)
	)
);

/* Icon*/
$wp_customize->add_setting(
	'account-icon',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => 'fab fa-opencart',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Fontawesome_Icon_Chooser(
		$wp_customize,
		'account-icon',
		array(
			'label'           => esc_html__( 'Icon', 'sparklestore-pro' ),
			'section'         => $this->login_register,
			'settings'        => 'account-icon',
		)
	)
);

/*Menu Icon align*/
$wp_customize->add_setting(
	'account-icon-align',
	array(
		'default'           => 'swp-flex-align-left',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Buttonset(
		$wp_customize,
		'account-icon-align',
		array(
			'choices'  => sparklewp_flex_align(),
			'label'    => esc_html__( 'Icon/Text Alignment', 'sparklestore-pro' ),
			'section'  => $this->login_register,
			'settings' => 'account-icon-align',
		)
	)
);

/*Menu icon*/
$wp_customize->add_setting(
	'account-icon-options',
	array(
		'default'           => 'icon',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		// 'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	'account-icon-options',
	array(
		'choices'  => sparklewp_menu_indicator_options(),
		'label'    => esc_html__( 'Indicator Option', 'sparklestore-pro' ),
		'section'  => $this->login_register,
		'settings' => 'account-icon-options',
		'type'     => 'select',
	)
);

/*Menu open Text*/
$wp_customize->add_setting(
	'account-text',
	array(
		'default' => esc_html__( 'My Account', 'sparklestore-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'account-text',
	array(
		'label'           => esc_html__( 'After Login Text', 'sparklestore-pro' ),
		'section'         => $this->login_register,
		'settings'        => 'account-text',
		'type'            => 'text',
	)
);


$wp_customize->add_setting(
	'account-before-text',
	array(
		'default' => esc_html__( 'Register', 'sparklestore-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'account-before-text',
	array(
		'label'           => esc_html__( 'Before Login Text', 'sparklestore-pro' ),
		'section'         => $this->login_register,
		'settings'        => 'account-before-text',
		'type'            => 'text',
	)
);

/** show logout */
$wp_customize->add_setting('account-show-logout', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => true,
    // 'transport' => 'postMessage',
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'account-show-logout', array(
    'section' => $this->login_register,
    'label' => esc_html__('Show Logout', 'sparklestore-pro'),
)));

// Heading
$wp_customize->add_setting(
	'account-margin-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'account-margin-msg',
		array(
			'label'   => esc_html__( 'Margin & Padding', 'sparklestore-pro' ),
			'section' => $this->login_register,
		)
	)
);

/*Padding*/
$wp_customize->add_setting(
	'account-icon-padding',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => ''
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'account-icon-padding',
		array(
			'label'    => esc_html__( 'Padding', 'sparklestore-pro' ),
			'section'  => $this->login_register,
			'settings' => 'account-icon-padding',
		),
		array(),
		array()
	)
);

/*Margin*/
$wp_customize->add_setting(
	'account-icon-margin',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => '',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'account-icon-margin',
		array(
			'label'    => esc_html__( 'Margin', 'sparklestore-pro' ),
			'section'  => $this->login_register,
			'settings' => 'account-icon-margin',
		),
		array(),
		array()
	)
);

// Heading
$wp_customize->add_setting(
	'account-color-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'account-color-msg',
		array(
			'label'   => esc_html__( 'Color', 'sparklestore-pro' ),
			'section' => $this->login_register,
		)
	)
);

/** color */
$wp_customize->add_setting(
	'account-icon-color', array(
		'default'     => '#000',
		'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
	)
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'account-icon-color',array(
			'label'      => esc_html__( 'Color', 'sparklestore-pro' ),
			'section'    => $this->login_register
		)
	)
);

$wp_customize->selective_refresh->add_partial( 'account-icon', array(
	'selector' => '.header-container .spel-my-account',
	'container_inclusive' => false,
) );