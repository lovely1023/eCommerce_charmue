<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*Header Row Section and Setting*/
$wp_customize->add_section(
	$this->header_bottom,
	array(
		'title'    => esc_html__( 'Header Bottom', 'sparklestore-pro' ),
		'priority' => 35,
		'panel'    => $this->panel,
	)
);

/*Bottom Header Styling*/
$wp_customize->add_setting(
	'bottom-header-styling-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'bottom-header-styling-msg',
		array(
			'label'   => esc_html__( 'Header Bottom Height', 'sparklestore-pro' ),
			'section' => $this->header_bottom,
		)
	)
);

$wp_customize->add_setting(
	'header-bottom-height-option',
	array(
		'default'           => 'auto',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		// 'transport'         => 'postMessage',
	)
);
$choices = sparklewp_header_top_height_option();
$wp_customize->add_control(
	'header-bottom-height-option',
	array(
		'label'    => esc_html__( 'Height Option', 'sparklestore-pro' ),
		'type'     => 'select',
		'section'  => $this->header_bottom,
		'settings' => 'header-bottom-height-option',
		'choices'  => $choices,
	)
);

/*Header Bottom Height*/
$wp_customize->add_setting("bottom-header-height", array(
	'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
	'default' => 0,
	// 'transport' => 'postMessage'
));

$wp_customize->add_setting("bottom-header-height_tablet", array(
	'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
	// 'transport' => 'postMessage'
));

$wp_customize->add_setting("bottom-header-height_mobile", array(
	'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
	// 'transport' => 'postMessage'
));

$wp_customize->add_control(
	new Sparklestore_Pro_Range_Slider_Control(
		$wp_customize,
		'bottom-header-height',
		array(
			'label'           => esc_html__( 'Header Bottom Height (px)', 'sparklestore-pro' ),
			'section'         => $this->header_bottom,
			'settings'        => array(
				'desktop' => 'bottom-header-height',
				'tablet' => 'bottom-header-height_tablet',
				'mobile' => 'bottom-header-height_mobile',
			),
			'input_attrs'     => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			)
		)
	)
);

/*Margin & Padding*/
$wp_customize->add_setting(
	'bottom-header-padding-margin-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'bottom-header-padding-margin-msg',
		array(
			'label'   => esc_html__( 'Margin & Padding', 'sparklestore-pro' ),
			'section' => $this->header_bottom,
		)
	)
);

/* Margin*/
$wp_customize->add_setting(
	'header-bottom-margin',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => '',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'header-bottom-margin',
		array(
			'label'    => esc_html__( 'Margin', 'sparklestore-pro' ),
			'section'  => $this->header_bottom,
			'settings' => 'header-bottom-margin',
		),
		array(),
		array()
	)
);

/* Padding*/
$wp_customize->add_setting(
	'header-bottom-padding',
	array(
		'sanitize_callback' => 'sparklestorepro_sanitize_field_default_css_box',
		'default'           => '',
		// 'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Cssbox(
		$wp_customize,
		'header-bottom-padding',
		array(
			'label'    => esc_html__( 'Padding', 'sparklestore-pro' ),
			'section'  => $this->header_bottom,
			'settings' => 'header-bottom-padding',
		),
		array(),
		array()
	)
);

/*Heading Background Info*/
$wp_customize->add_setting(
	'header-bottom-bg-styling-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'header-bottom-bg-styling-msg',
		array(
			'label'   => esc_html__( 'Background Options', 'sparklestore-pro' ),
			'section' => $this->header_bottom,
		)
	)
);

/*Inherit Options*/
$choices = sparklewp_header_bg_options();
$wp_customize->add_setting(
	'header-bottom-bg-options',
	array(
		'default'           => $header_defaults['header-bottom-bg-options'],
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		// 'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	'header-bottom-bg-options',
	array(
		'label'    => esc_html__( 'Background Options', 'sparklestore-pro' ),
		'type'     => 'select',
		'section'  => $this->header_bottom,
		'settings' => 'header-bottom-bg-options',
		'choices'  => $choices,
	)
);

/*Custom Background*/
$wp_customize->add_setting(
	'header-bottom-background-options',
	array(
		'sanitize_callback' => 'sparklewp_sanitize_field_background',
		'default'           => $header_defaults['header-bottom-background-options'],
		// 'transport'         => 'postMessage',
	)
);
$background_image_size_options       = sparklewp_background_image_size_options();
$background_image_position_options   = sparklewp_background_image_position_options();
$background_image_repeat_options     = sparklewp_background_image_repeat_options();
$background_image_attachment_options = sparklewp_background_image_attachment_options();
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Group(
		$wp_customize,
		'header-bottom-background-options',
		array(
			'label'           => esc_html__( 'Background Option', 'sparklestore-pro' ),
			'section'         => $this->header_bottom,
			'settings'        => 'header-bottom-background-options'
		),
		array(
			'background-color'         => array(
				'type'  => 'color',
				'label' => esc_html__( 'Background Color', 'sparklestore-pro' ),
			),
			'background-image'         => array(
				'type'  => 'image',
				'label' => esc_html__( 'Background Image', 'sparklestore-pro' ),
			),
			'background-size'          => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Size', 'sparklestore-pro' ),
				'options' => $background_image_size_options,
				'class'   => 'image-properties',
			),
			'background-position'      => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Position', 'sparklestore-pro' ),
				'options' => $background_image_position_options,
				'class'   => 'image-properties',
			),
			'background-repeat'        => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Repeat', 'sparklestore-pro' ),
				'options' => $background_image_repeat_options,
				'class'   => 'image-properties',
			),
			'background-attachment'    => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Attachment', 'sparklestore-pro' ),
				'options' => $background_image_attachment_options,
				'class'   => 'image-properties',
			),
			'enable-overlay'           => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Enable Overlay', 'sparklestore-pro' ),
				'class' => 'image-properties image-properties-checkbox',
			),
			'background-overlay-color' => array(
				'type'  => 'color',
				'label' => esc_html__( 'Background Overlay Color', 'sparklestore-pro' ),
				'class' => 'image-properties',
			),
		)
	)
);

/*Heading border Info*/
$wp_customize->add_setting(
	'header-bottom-border-styling-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'header-bottom-border-styling-msg',
		array(
			'label'   => esc_html__( 'Border & Box Options', 'sparklestore-pro' ),
			'section' => $this->header_bottom,
		)
	)
);

/*Border & Box Options*/
/*Header bottom border & box*/
$wp_customize->add_setting(
	'header-bottom-border-styling',
	array(
		'sanitize_callback' => 'sparklewp_sanitize_field_border',
		'default'           => $header_defaults['header-bottom-border-styling'],
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Group(
		$wp_customize,
		'header-bottom-border-styling',
		array(
			'label'    => esc_html__( 'Border & Box', 'sparklestore-pro' ),
			'section'  => $this->header_bottom,
			'settings' => 'header-bottom-border-styling',
		),
		array(
			'border-style'     => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Border Style', 'sparklestore-pro' ),
				'options' => sparklewp_header_border_style(),
			),
			'border-width'     => array(
				'type'       => 'cssbox',
				'label'      => esc_html__( 'Border Width', 'sparklestore-pro' ),
				'class'      => 'spwp-element-show',
				'box_fields' => array(
					'top'    => true,
					'right'  => true,
					'bottom' => true,
					'left'   => true,
				),
				'attr'       => array(
					'min'       => 0,
					'max'       => 1000,
					'step'      => 1,
					'link'      => 1,
					'devices'   => array(
						'desktop' => array(
							'icon' => 'dashicons-laptop',
						),
					),
					'link_text' => esc_html__( 'Link', 'sparklestore-pro' ),
				),
			),
			'border-color'     => array(
				'type'  => 'color',
				'label' => esc_html__( 'Border Color', 'sparklestore-pro' ),
			),
			'border-radius'    => array(
				'type'       => 'cssbox',
				'label'      => esc_html__( 'Border Radius', 'sparklestore-pro' ),
				'class'      => 'spwp-element-show',
				'box_fields' => array(
					'top'    => true,
					'right'  => true,
					'bottom' => true,
					'left'   => true,
				),
				'attr'       => array(
					'min'       => 0,
					'max'       => 1000,
					'step'      => 1,
					'link'      => 1,
					'devices'   => array(
						'desktop' => array(
							'icon' => 'dashicons-laptop',
						),
					),
					'link_text' => esc_html__( 'Link', 'sparklestore-pro' ),
				),
			),
			'box-shadow-color' => array(
				'type'  => 'color',
				'label' => esc_html__( 'Box Shadow Color', 'sparklestore-pro' ),
			),
			'box-shadow-css'   => array(
				'type'       => 'cssbox',
				'class'      => 'spwp-element-show',
				'box_fields' => array(
					'x'      => true,
					'Y'      => true,
					'BLUR'   => true,
					'SPREAD' => true,
				),
				'attr'       => array(
					'min'         => 0,
					'max'         => 1000,
					'step'        => 1,
					'link'        => 1,
					'link_toggle' => false,
					'devices'     => array(
						'desktop' => array(
							'icon' => 'dashicons-laptop',
						),
					),
					'link_text'   => esc_html__( 'INSET', 'sparklestore-pro' ),
				),
			),
		)
	)
);

// $wp_customize->register_section_type('SparkleWP_Customize_Section_H3');
$wp_customize->add_section(
	new SparkleWP_Customize_Section_H3(
		$wp_customize,
		'sparklewp_header_elements_seperator',
		array(
			'title'    => esc_html__( 'Header Elements', 'sparklestore-pro' ),
			'panel'    => $this->panel,
			'priority' => 36,
		)
	)
);