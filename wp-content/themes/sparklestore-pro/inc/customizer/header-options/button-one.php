<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*Button one section*/
$wp_customize->add_section( $this->button_one,
	array(
		'title' => esc_html__( 'Button One', 'sparklestore-pro' ),
		'panel' => $this->panel,
	)
);

/*Button Text*/
$wp_customize->add_setting( 'button-one-text',
	array(
		'default'           => esc_html__("Shop Now", 'sparklestore-pro'),
		'sanitize_callback' => 'sanitize_text_field',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'button-one-text',
	array(
		'label'    => esc_html__( 'Button Text', 'sparklestore-pro' ),
		'section'  => $this->button_one,
		'settings' => 'button-one-text',
		'type'     => 'text',
	)
);

/*Enable Icon */
$wp_customize->add_setting( 'button-one-enable-icon',
	array(
		'default'           => true,
		'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'button-one-enable-icon',
	array(
		'label'    => esc_html__( 'Enable Icon', 'sparklestore-pro' ),
		'section'  => $this->button_one,
		'settings' => 'button-one-enable-icon',
		'type'     => 'checkbox',
	)
);

/*Icon*/
$wp_customize->add_setting( 'button-one-icon',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => '',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Sparklestore_Pro_Fontawesome_Icon_Chooser( $wp_customize, 'button-one-icon',
		array(
			'label'           => esc_html__( 'Icon', 'sparklestore-pro' ),
			'section'         => $this->button_one,
			'settings'        => 'button-one-icon'
		)
	)
);

/*Icon Position*/
$wp_customize->add_setting( 'button-one-icon-position',
	array(
		'default'           => '',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		// 'transport'         => 'postMessage',
	)
);
$choices = sparklewp_icon_position();
$wp_customize->add_control(new SparkleWP_Custom_Control_Buttonset( $wp_customize, 'button-one-icon-position',
		array(
			'choices'         => $choices,
			'label'           => esc_html__( 'Icon Position', 'sparklestore-pro' ),
			'section'         => $this->button_one,
			'settings'        => 'button-one-icon-position'
		)
	)
);

/*Button URL*/
$wp_customize->add_setting( 'button-one-url',
	array(
		'default'           => $header_defaults['button-one-url'],
		'sanitize_callback' => 'esc_url_raw',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'button-one-url',
	array(
		'label'     => esc_html__( 'Button URL', 'sparklestore-pro' ),
		'section'   => $this->button_one,
		'settings'  => 'button-one-url',
		'type'      => 'url',
		'transport' => 'postMessage',
	)
);

/*Open link in new tab */
$wp_customize->add_setting( 'button-one-open-link-new-tab',
	array(
		'default'           => true,
		'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'button-one-open-link-new-tab',
	array(
		'label'    => esc_html__( 'Open link in a new tab', 'sparklestore-pro' ),
		'section'  => $this->button_one,
		'settings' => 'button-one-open-link-new-tab',
		'type'     => 'checkbox',
	)
);

$wp_customize->add_setting( 'button-one-class-name',
	array(
		'default'           => $header_defaults['button-one-class-name'],
		'sanitize_callback' => 'sanitize_text_field',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'button-one-class-name',
	array(
		'label'       => esc_html__( 'Button CSS Class ', 'sparklestore-pro' ),
		'description' => __( 'Multiple classes added by space', 'sparklestore-pro' ),
		'section'     => $this->button_one,
		'settings'    => 'button-one-class-name',
		'type'        => 'text',
	)
);

/*Margin & Padding Msg*/
$wp_customize->add_setting( 'button-one-padding-margin-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control( new Sparklestore_Pro_Customize_Heading( $wp_customize, 'button-one-padding-margin-msg',
		array(
			'label'   => esc_html__( 'Margin & Padding', 'sparklestore-pro' ),
			'section' => $this->button_one,
		)
	)
);

/*Margin*/
$wp_customize->add_setting( 'button-one-margin',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => $header_defaults['button-one-margin'],
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox( $wp_customize, 'button-one-margin',
		array(
			'label'    => esc_html__( 'Margin (px)', 'sparklestore-pro' ),
			'section'  => $this->button_one,
			'settings' => 'button-one-margin',
		),
		array(),
		array()
	)
);

/*Padding*/
$wp_customize->add_setting( 'button-one-padding',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => $header_defaults['button-one-padding'],
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox( 
		$wp_customize, 
		'button-one-padding',
		array(
			'label'    => esc_html__( 'Padding (px)', 'sparklestore-pro' ),
			'section'  => $this->button_one,
			'settings' => 'button-one-padding',
		),
		array(),
		array()
	)
);

/*Button One Styling Msg*/
$wp_customize->add_setting(
	'button-one-styling-styling-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'button-one-styling-styling-msg',
		array(
			'label'   => esc_html__( 'Button One Styling', 'sparklestore-pro' ),
			'section' => $this->button_one,
		)
	)
);

/*Button align*/
$wp_customize->add_setting(
	'button-one-align',
	array(
		'default'           => 'swp-flex-align-left',
		'sanitize_callback' => 'sparklewp_sanitize_field_responsive_buttonset',
		// 'transport'         => 'postMessage',
	)
);
$choices = sparklewp_flex_align();
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Responsive_Buttonset(
		$wp_customize,
		'button-one-align',
		array(
			'choices'  => $choices,
			'label'    => esc_html__( 'Button Alignment', 'sparklestore-pro' ),
			'section'  => $this->button_one,
			'settings' => 'button-one-align',
		)
	)
);

// font size
$wp_customize->add_setting('button-one-font-size', array(
    'default' => 14,
    'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank'  // done
));

$wp_customize->add_control('button-one-font-size', array(
    'type' => 'number',
    'label' => esc_html__('Font Size(px)', 'sparklestore-pro'),
    'section' => $this->button_one,
    'settings' => 'button-one-font-size'
));

/*Tabs button color*/
$wp_customize->add_setting('button-one_bg_color', array(
    'default' => '#003772',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color'
));

$wp_customize->add_setting('button-one_border_color', array(
    'default' => '#003772',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color'
));

$wp_customize->add_setting('button-one_text_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color'
));

// Slider Button Hover Color
$wp_customize->add_setting('button-one_bg_hov_color', array(
    'default' => '#003772',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color'
));

$wp_customize->add_setting('button-one_border_hov_color', array(
    'default' => '#003772',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color'
));

$wp_customize->add_setting('button-one_text_hov_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color'
));


$wp_customize->add_control(new Sparklestore_Pro_Color_Tab_Control($wp_customize, 'button-one_color_group', array(
    'label' => esc_html__('Button Color', 'sparklestore-pro'),
    'section' => $this->button_one,
    'show_opacity' => false,
    'settings' => array(
        'normal_button-one_bg_color' => 'button-one_bg_color',
        'normal_button-one_border_color' => 'button-one_border_color',
        'normal_button-one_text_color' => 'button-one_text_color',
        'hover_button-one_bg_hov_color' => 'button-one_bg_hov_color',
        'hover_button-one_border_hov_color' => 'button-one_border_hov_color',
        'hover_button-one_text_hov_color' => 'button-one_text_hov_color',
    ),
    'group' => array(
        'normal_button-one_bg_color' => esc_html__('Background Color', 'sparklestore-pro'),
        'normal_button-one_border_color' => esc_html__('Border Color', 'sparklestore-pro'),
        'normal_button-one_text_color' => esc_html__('Text Color', 'sparklestore-pro'),
        'hover_button-one_bg_hov_color' => esc_html__('Background Color', 'sparklestore-pro'),
        'hover_button-one_border_hov_color' => esc_html__('Border Color', 'sparklestore-pro'),
        'hover_button-one_text_hov_color' => esc_html__('Text Color', 'sparklestore-pro')
    )
)));

$wp_customize->selective_refresh->add_partial( 'button-one-text', array(
	'selector' => '.header-container .swp-header-button',
	'container_inclusive' => false,
) );