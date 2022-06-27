<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*Menu Icon sidebar section*/
$wp_customize->add_section(
	'sparklewp_header_sidebar',
	array(
		'title'    => esc_html__( 'Menu Icon Sidebar', 'sparklestore-pro' ),
		'panel'    => $this->panel,
		'priority' => 195,
	)
);

/** 
 * Enable Search
 */
$wp_customize->add_setting('sparklewp_header_sidebar_enable_search', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
    'default' => true
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklewp_header_sidebar_enable_search', array(
    'section' => 'sparklewp_header_sidebar',
    'label' => esc_html__('Enable Search', 'sparklestore-pro'),
)));

/**
 * Enable Tab
 */
$wp_customize->add_setting('sparklewp_header_sidebar_enable_tab', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
    'default' => true
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklewp_header_sidebar_enable_tab', array(
    'section' => 'sparklewp_header_sidebar',
    'label' => esc_html__('Enable Tab', 'sparklestore-pro'),
)));

/**
 * First tab Text
 */

$wp_customize->add_setting('sparklewp_header_sidebar_tab_1_text', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> esc_html__( "Menu", 'sparklestore-pro' )
));

$wp_customize->add_control('sparklewp_header_sidebar_tab_1_text', array(
    'section' => 'sparklewp_header_sidebar',
    'type' => 'text',
    'label' => esc_html__('First Tab', 'sparklestore-pro'),
));
/**
 * Second tab Text
 */
$wp_customize->add_setting('sparklewp_header_sidebar_tab_2_text', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> esc_html__( "Category", 'sparklestore-pro' )
));

$wp_customize->add_control('sparklewp_header_sidebar_tab_2_text', array(
    'section' => 'sparklewp_header_sidebar',
    'type' => 'text',
    'label' => esc_html__('Second Tab', 'sparklestore-pro'),
));

/**
 * Second Tab Content
 */
$choices = sparklewp_get_nav_menus();
$wp_customize->add_setting(
	'sparklecategory-custom-menu',
	array(
		'capability'        => 'edit_theme_options',
		'default'           => '',
		'sanitize_callback' => 'sparklestore_pro_sanitize_select',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	'sparklecategory-custom-menu',
	array(
		'label'           => esc_html__( 'Select Menu', 'sparklestore-pro' ),
		'section'         => 'sparklewp_header_sidebar',
		'settings'        => 'sparklecategory-custom-menu',
		'type'            => 'select',
		'choices'         => $choices,
	)
);