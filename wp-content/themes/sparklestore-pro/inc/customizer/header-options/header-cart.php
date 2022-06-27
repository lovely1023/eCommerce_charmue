<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* cart Menu Section*/
$wp_customize->add_section(
	$this->cart,
	array(
		'capability' => 'edit_theme_options',
		'title'      => esc_html__( 'Cart', 'sparklestore-pro' ),
		'panel'      => $this->panel,
		'priority'   => 88,
	)
);

$wp_customize->add_setting('sparklestore_pro_header_cart_nav', array(
	// 'transport' => 'postMessage',
	'sanitize_callback' => 'wp_kses_post',
	
));

$wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_pro_header_cart_nav', array(
	'type' => 'tab',
	'section' => $this->cart,
	'priority' => -1,
	'buttons' => array(
		array(
			'name' => esc_html__('Content', 'sparklestore-pro'),
			'fields' => array(
				'cart-icon',
				'cart-icon-options',
				'cart-text',
				'cart-show-count',
				'cart-show-price',
				'cart-options'
			),
			'active' => true
		),
		array(
			'name' => esc_html__('Style', 'sparklestore-pro'),
			'fields' => array(
				'cart-setting-msg',
				'cart-icon-align',
				'cart-padding-msg',
				'cart-icon-padding', 
				'cart-icon-margin',
				'cart-count-margin',
				'cart_bg_color',
			),
		),
	),
 )));






/*Menu Close Icon*/
$wp_customize->add_setting(
	'cart-icon',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => 'fas fa-cart-arrow-down',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Fontawesome_Icon_Chooser(
		$wp_customize,
		'cart-icon',
		array(
			'label'           => esc_html__( 'Icon', 'sparklestore-pro' ),
			'section'         => $this->cart,
			'settings'        => 'cart-icon',
		)
	)
);

// Heading
$wp_customize->add_setting(
	'cart-setting-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'cart-setting-msg',
		array(
			'label'   => esc_html__( 'Alignment', 'sparklestore-pro' ),
			'section' => $this->cart,
		)
	)
);

/*Menu Icon align*/
$wp_customize->add_setting(
	'cart-icon-align',
	array(
		'default'           => 'swp-flex-align-right',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Buttonset(
		$wp_customize,
		'cart-icon-align',
		array(
			'choices'  => sparklewp_flex_align(),
			'label'    => esc_html__( 'Icon/Text Alignment', 'sparklestore-pro' ),
			'section'  => $this->cart,
			'settings' => 'cart-icon-align',
		)
	)
);


/*Menu icon*/
$wp_customize->add_setting(
	'cart-icon-options',
	array(
		'default'           => 'icon',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		// 'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	'cart-icon-options',
	array(
		'choices'  => sparklewp_menu_indicator_options(),
		'label'    => esc_html__( 'Cart Indicator Option', 'sparklestore-pro' ),
		'section'  => $this->cart,
		'settings' => 'cart-icon-options',
		'type'     => 'select',
	)
);

/*Menu open Text*/
$wp_customize->add_setting(
	'cart-text',
	array(
		'default' => esc_html__( 'Cart', 'sparklestore-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'cart-text',
	array(
		'label'           => esc_html__( 'Text', 'sparklestore-pro' ),
		'section'         => $this->cart,
		'settings'        => 'cart-text',
		'type'            => 'text',
	)
);

$wp_customize->add_setting('cart-show-count', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => true,
    // 'transport' => 'postMessage',
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'cart-show-count', array(
    'section' => $this->cart,
    'label' => esc_html__('Show Count', 'sparklestore-pro'),
)));

$wp_customize->add_setting('cart-show-price', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => false,
    // 'transport' => 'postMessage',
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'cart-show-price', array(
    'section' => $this->cart,
    'label' => esc_html__('Show Price', 'sparklestore-pro'),
)));

// Heading
$wp_customize->add_setting(
	'cart-padding-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'cart-padding-msg',
		array(
			'label'   => esc_html__( 'Margin & Padding', 'sparklestore-pro' ),
			'section' => $this->cart,
		)
	)
);

/*Padding*/
$wp_customize->add_setting(
	'cart-icon-padding',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'cart-icon-padding',
		array(
			'label'    => esc_html__( 'Padding', 'sparklestore-pro' ),
			'section'  => $this->cart,
			'settings' => 'cart-icon-padding',
		),
		array(),
		array()
	)
);

/*Margin*/
$wp_customize->add_setting(
	'cart-icon-margin',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'cart-icon-margin',
		array(
			'label'    => esc_html__( 'Margin', 'sparklestore-pro' ),
			'section'  => $this->cart,
			'settings' => 'cart-icon-margin',
		),
		array(),
		array()
	)
);

/** cart count margin */
$wp_customize->add_setting(
	'cart-count-margin',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'cart-count-margin',
		array(
			'label'    => esc_html__( 'Count Margin', 'sparklestore-pro' ),
			'section'  => $this->cart,
			'settings' => 'cart-count-margin',
			'min' => -20
		),
		array(),
		array()
	)
);

/**
 * Cart Icon Color, font size
 */
$wp_customize->add_setting(
	'cart-options',
	array(
		'sanitize_callback' => 'sparklewp_sanitize_field_background',
		'default'           => array(
			
		),
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Group(
		$wp_customize,
		'cart-options',
		array(
			'label'           => esc_html__( 'Cart Settings', 'sparklestore-pro' ),
			'section'         => $this->cart,
			'settings'        => 'cart-options'
		),
		array(
			'background-color'         => array(
				'type'  => 'color',
				'label' => esc_html__( 'Background Color', 'sparklestore-pro' ),
			),
			'text-color'         => array(
				'type'  => 'color',
				'label' => esc_html__( 'Text Color', 'sparklestore-pro' ),
			),
			'icon-font-size'         => array(
				'type'  => 'text',
				'label' => esc_html__( 'Icon Size', 'sparklestore-pro' ),
			),

			'text-font-size'         => array(
				'type'  => 'text',
				'label' => esc_html__( 'Text Size', 'sparklestore-pro' ),
			),
			
			
			'count-bg-color'         => array(
				'type'  => 'color',
				'label' => esc_html__( 'Count Background', 'sparklestore-pro' ),
			),
			'count-text-color'         => array(
				'type'  => 'color',
				'label' => esc_html__( 'Count Text Color', 'sparklestore-pro' ),
			)
		)
	)
);

$wp_customize->selective_refresh->add_partial( 'cart-icon', array(
	'selector' => '.header-container .spel-cart',
	// 'container_inclusive' => false,
) );