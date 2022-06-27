<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*Site Identity Sorting*/
$wp_title_tagline = $wp_customize->get_section( 'title_tagline' );
if ( ! empty( $wp_title_tagline ) ) {
	$wp_title_tagline->panel    = $this->panel;
	$wp_title_tagline->priority = 45;
}


$wp_customize->add_setting('sparklestore_pro_header_tagline_nav', array(
	// 'transport' => 'postMessage',
	'sanitize_callback' => 'wp_kses_post',
	
));

$wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_pro_header_tagline_nav', array(
	'type' => 'tab',
	'section' => 'title_tagline',
	'priority' => -1,
	'buttons' => array(
		array(
			'name' => esc_html__('Content', 'sparklestore-pro'),
			'fields' => array(
				'site-logo-msg',
				'custom_logo',
				'blogname',
				'blogdescription',
				'display_header_text'
			),
			'active' => true
		),
		array(
			'name' => esc_html__('Style', 'sparklestore-pro'),
			'fields' => array(
				'header_textcolor',
				'site-logo-max-width-group',
				'sparklestore_pro_title_tagline_alignment',
			),
		),
	),
 )));

 /**
  * tagline
  */
 $wp_customize->get_control('header_textcolor')->section = "title_tagline";
 $wp_customize->get_control('header_textcolor')->priority = 30;
 $wp_customize->get_control('header_textcolor')->label = esc_html__("Title/Tagline Color", 'sparklestore-pro');



 /**
  * Logo Text Aligment
  */
$wp_customize->add_setting(
	'sparklestore_pro_title_tagline_alignment',
	array(
		'default'           => $header_defaults['sparklestore_pro_title_tagline_alignment'],
		'sanitize_callback' => 'sparklewp_sanitize_field_responsive_buttonset',
		// 'transport'         => 'postMessage',
	)
);
$choices = array(
	'left'   => esc_html__('Left', 'sparklestore-pro'),
	'center' => esc_html__('Center', 'sparklestore-pro'),
	'right'  => esc_html__('Right', 'sparklestore-pro')
);
$wp_customize->add_control(
	new SparkleWP_Custom_Control_Responsive_Buttonset(
		$wp_customize,
		'sparklestore_pro_title_tagline_alignment',
		array(
			'choices'  => $choices,
			'label'    => esc_html__( 'Alignment', 'sparklestore-pro' ),
			'section'  => 'title_tagline',
			'settings' => 'sparklestore_pro_title_tagline_alignment',
		)
	)
);


/*Site Logo Msg*/
$wp_customize->add_setting(
	'site-logo-msg',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control(
	new Sparklestore_Pro_Customize_Heading(
		$wp_customize,
		'site-logo-msg',
		array(
			'label'   => esc_html__( 'Site Logo ', 'sparklestore-pro' ),
			'section' => 'title_tagline',
			'priority' => 1,
		)
	)
);

/*Site Logo Max width*/
$wp_customize->add_setting("site-logo-max-width", array(
	'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
	'default' => 100,
	// 'transport' => 'postMessage'
));

$wp_customize->add_setting("site-logo-max-width_tablet", array(
	'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
	// 'transport' => 'postMessage'
));

$wp_customize->add_setting("site-logo-max-width_mobile", array(
	'sanitize_callback' => 'sparklestore_pro_sanitize_number_blank',
	// 'transport' => 'postMessage'
));

$wp_customize->add_control(
	new Sparklestore_Pro_Range_Slider_Control(
		$wp_customize,
		'site-logo-max-width-group',
		array(
			'label'       => esc_html__( 'Logo Max Width (%)', 'sparklestore-pro' ),
			'section'     => 'title_tagline',
			'settings' => array(
				'desktop' => "site-logo-max-width",
				'tablet' => "site-logo-max-width_tablet",
				'mobile' => "site-logo-max-width_mobile",
			),
			'input_attrs' => array(
				'min'  => 10,
				'max'  => 100,
				'step' => 1,
			),
		)
	)
);

