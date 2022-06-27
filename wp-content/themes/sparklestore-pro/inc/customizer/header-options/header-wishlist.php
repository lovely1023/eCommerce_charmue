<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Wishlist Menu Section*/
$wp_customize->add_section(
	$this->wishlist,
	array(
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'Wishlist', 'sparklestore-pro' ),
		'panel'      => $this->panel,
		'priority'   => 89,
	)
);
// Heading
$wp_customize->add_setting(
	'wishlist-setting-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'wishlist-setting-msg',
		array(
			'label'   => esc_html__( 'Settings', 'sparklestore-pro' ),
			'section' => $this->wishlist,
		)
	)
);

/*Menu Close Icon*/
$wp_customize->add_setting(
	'wishlist-icon',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => 'fas fa-heart',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Fontawesome_Icon_Chooser(
		$wp_customize,
		'wishlist-icon',
		array(
			'label'           => esc_html__( 'Icon', 'sparklestore-pro' ),
			'section'         => $this->wishlist,
			'settings'        => 'wishlist-icon',
		)
	)
);

/*Menu Icon align*/
$wp_customize->add_setting(
	'wishlist-icon-align',
	array(
		'default'           => 'swp-flex-align-left',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Buttonset(
		$wp_customize,
		'wishlist-icon-align',
		array(
			'choices'  => sparklewp_flex_align(),
			'label'    => esc_html__( 'Icon/Text Alignment', 'sparklestore-pro' ),
			'section'  => $this->wishlist,
			'settings' => 'wishlist-icon-align',
		)
	)
);

/*Menu icon*/
$wp_customize->add_setting(
	'wishlist-icon-options',
	array(
		'default'           => 'icon',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		// 'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	'wishlist-icon-options',
	array(
		'choices'  => sparklewp_menu_indicator_options(),
		'label'    => esc_html__( 'Wishlist Indicator Option', 'sparklestore-pro' ),
		'section'  => $this->wishlist,
		'settings' => 'wishlist-icon-options',
		'type'     => 'select',
	)
);

/*Menu open Text*/
$wp_customize->add_setting(
	'wishlist-text',
	array(
		'default' => esc_html__( 'Wishlist', 'sparklestore-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'wishlist-text',
	array(
		'label'           => esc_html__( 'Text', 'sparklestore-pro' ),
		'section'         => $this->wishlist,
		'settings'        => 'wishlist-text',
		'type'            => 'text',
	)
);

// Heading
$wp_customize->add_setting(
	'wishlist-margin-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'wishlist-margin-msg',
		array(
			'label'   => esc_html__( 'Margin & Padding', 'sparklestore-pro' ),
			'section' => $this->wishlist,
		)
	)
);

/*Padding*/
$wp_customize->add_setting(
	'wishlist-icon-padding',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => '',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'wishlist-icon-padding',
		array(
			'label'    => esc_html__( 'Padding', 'sparklestore-pro' ),
			'section'  => $this->wishlist,
			'settings' => 'wishlist-icon-padding',
		),
		array(),
		array()
	)
);

/*Margin*/
$wp_customize->add_setting(
	'wishlist-icon-margin',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => '',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'wishlist-icon-margin',
		array(
			'label'    => esc_html__( 'Margin', 'sparklestore-pro' ),
			'section'  => $this->wishlist,
			'settings' => 'wishlist-icon-margin',
		),
		array(),
		array()
	)
);

// Heading
$wp_customize->add_setting(
	'wishlist-color-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'wishlist-color-msg',
		array(
			'label'   => esc_html__( 'Color', 'sparklestore-pro' ),
			'section' => $this->wishlist,
		)
	)
);

/** color */
$wp_customize->add_setting(
	'wishlist-icon-color', array(
		'default'     => '#000',
		'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
	)
); 
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'wishlist-icon-color',array(
			'label'      => esc_html__( 'Color', 'sparklestore-pro' ),
			'section'    => $this->wishlist
		)
	)
);