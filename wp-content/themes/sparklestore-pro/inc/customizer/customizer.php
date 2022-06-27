<?php
/**
 * SparkleStore Pro Theme Customizer
 *
 * @package SparkleStore Pro
 */

if (!function_exists('sparklestore_pro_svg_seperator')) {
    function sparklestore_pro_svg_seperator() {
        return array(
            'big-triangle-center' => esc_html__('Big Triangle Center', 'sparklestore-pro'),
            'big-triangle-left' => esc_html__('Big Triangle Left', 'sparklestore-pro'),
            'big-triangle-right' => esc_html__('Big Triangle Right', 'sparklestore-pro'),
            'clouds' => esc_html__('Clouds', 'sparklestore-pro'),
            'curve-center' => esc_html__('Curve Center', 'sparklestore-pro'),
            'curve-repeater' => esc_html__('Curve Repeater', 'sparklestore-pro'),
            'droplets' => esc_html__('Droplets', 'sparklestore-pro'),
            'paper-cut' => esc_html__('Paint Brush', 'sparklestore-pro'),
            'small-triangle-center' => esc_html__('Small Triangle Center', 'sparklestore-pro'),
            'tilt-left'     => esc_html__('Tilt Left', 'sparklestore-pro'),
            'tilt-right'    => esc_html__('Tilt Right', 'sparklestore-pro'),
            'uniform-waves' => esc_html__('Uniform Waves', 'sparklestore-pro'),
            'water-waves'   => esc_html__('Water Waves', 'sparklestore-pro'),
            'big-waves'     => esc_html__('Big Waves', 'sparklestore-pro'),
            'slanted-waves' => esc_html__('Slanted Waves', 'sparklestore-pro'),
            'zigzag'        => esc_html__('Zigzag', 'sparklestore-pro'),
        );
    }
}


if (!function_exists('sparklestore_pro_pages_list')) {
    function sparklestore_pro_pages_list() {
        $pages = array();
		$pages_obj = get_pages();
		$pages[''] = esc_html__('Select Page', 'sparklestore-pro');

		foreach ($pages_obj as $page) {
			$pages[$page->ID] = $page->post_title;
		}
		return $pages;
    }
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sparklestore_pro_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->get_section('static_front_page' )->priority = 2;
	$wp_customize->get_section('static_front_page' )->description = '';
	$wp_customize->remove_control("page_for_posts");

	// $wp_customize->remove_control("page_for_posts");

	/**
	 * Theme Color Settings
	 */
	$wp_customize->get_section('colors')->panel ="sparklestore_pro_general_settings";

	$wp_customize->get_section('colors')->title = esc_html__( 'Themes Colors Settings', 'sparklestore-pro' );

	$wp_customize->add_setting('sparklestore_pro_color_heading', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_color_heading', array(
		'section' => 'colors',
		'label' => esc_html__('Primary & Secondary Color', 'sparklestore-pro')
	)));

	$wp_customize->add_setting('sparklestore_pro_primary_color', array(
		'default' => '#033772',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',        
	));

	$wp_customize->add_control('sparklestore_pro_primary_color', array(
		'type'     => 'color',
		'label'    => esc_html__('Primary Color', 'sparklestore-pro'),
		'section'  => 'colors',
		'setting'  => 'sparklestore_pro_primary_color',
	));

	$wp_customize->add_setting('sparklestore_pro_secondary_color', array(
		'default' 		=> '#f33c3c',
		'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',        
	));

	$wp_customize->add_control('sparklestore_pro_secondary_color', array(
		'type'     => 'color',
		'label'    => esc_html__('Secondary Color', 'sparklestore-pro'),
		'section'  => 'colors',
		'setting'  => 'sparklestore_pro_secondary_color',
	));


	$wp_customize->add_setting('sparklestore_pro_content_heading', array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_content_heading', array(
		'section' => 'colors',
		'label' => esc_html__('Content & Widget Area Style', 'sparklestore-pro')
	)));

	$wp_customize->add_setting('sparklestore_pro_primary_content_bg_color', array(
		'default' 		=> '#ffffff',
		'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',        
	));
	$wp_customize->add_control('sparklestore_pro_primary_content_bg_color', array(
		'type'     => 'color',
		'label'    => esc_html__('Content Area Background', 'sparklestore-pro'),
		'section'  => 'colors',
	));
	$wp_customize->add_setting('sparklestore_pro_secondary_bg_color', array(
		'default' 		=> '#ffffff',
		'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',        
	));
	$wp_customize->add_control('sparklestore_pro_secondary_bg_color', array(
		'type'     => 'color',
		'label'    => esc_html__('Widget Background Color', 'sparklestore-pro'),
		'section'  => 'colors',
		'setting'  => 'sparklestore_pro_secondary_color',
	));

	/*
	global $wp_registered_sidebars;
	$imagepath = get_template_directory_uri();
	$sparklestore_pro_menu_choice = $sparklestore_pro_portfolio_cat = $sparklestore_pro_page_choice = $sparklestore_pro_cat = array();

	$sparklestore_pro_widget_list[] = esc_html__('-- Don\'t Replace --', 'sparklestore-pro');
    foreach ($wp_registered_sidebars as $wp_registered_sidebar) {
        $sparklestore_pro_widget_list[$wp_registered_sidebar['id']] = $wp_registered_sidebar['name'];
	}
	$sparklestore_pro_plus_menus = get_terms('nav_menu', array('hide_empty' => false));
    foreach ($sparklestore_pro_plus_menus as $sparklestore_pro_plus_menus_single) {
		$sparklestore_pro_menu_choice[$sparklestore_pro_plus_menus_single->slug] = $sparklestore_pro_plus_menus_single->name;
	}
	
	*/
	$sparklestore_pro_cat = array();
	// List All Category
	$categories = get_categories();
	foreach ($categories as $category) {
	    $sparklestore_pro_cat[$category->term_id] = $category->name;
	}

	// List All Pages
	$sparklestore_pro_page_choice = $pages = sparklestore_pro_pages_list();
	
	$wp_customize->register_control_type('Sparklestore_Pro_Background_Control');
    $wp_customize->register_control_type('Sparklestore_Pro_Control_Tab');
    $wp_customize->register_control_type('Sparklestore_Pro_Dimensions_Control');
    $wp_customize->register_control_type('Sparklestore_Pro_Range_Slider_Control');
    $wp_customize->register_control_type('Sparklestore_Pro_Sortable_Control');
    $wp_customize->register_control_type('Sparklestore_Pro_Color_Tab_Control');
	$wp_customize->register_control_type('Sparklestore_Pro_Range_Control');
	
	$wp_customize->register_control_type('SparkleWP_Custom_Control_Buttonset');
	
	
	$wp_customize->register_section_type('Sparklestore_Pro_Toggle_Section');
	$wp_customize->register_section_type('SparkleWP_Customize_Section_H3');
	


	$imagepath = get_template_directory_uri();
	// $imagepath =  get_template_directory_uri() . '/assets/images/';

	/**
	 * pro items
	 */
	require get_template_directory() . '/inc/customizer/customizer-panel/maintenance.php';
    require get_template_directory() . '/inc/customizer/customizer-panel/general-settings.php';
    // require get_template_directory() . '/inc/customizer/customizer-panel/header-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/breadcrumb-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/woocommerce.php';
	
	require get_template_directory() . '/inc/customizer/customizer-panel/home-settings/home-slider-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/service-settings.php';
	
    // require get_template_directory() . '/inc/customizer/customizer-panel/home-settings/home-logo-settings.php';
    require get_template_directory() . '/inc/customizer/customizer-panel/layout-settings.php';
	
    
    require get_template_directory() . '/inc/customizer/customizer-panel/social-settings.php';
    require get_template_directory() . '/inc/customizer/customizer-panel/footer-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/gdpr-settings.php';


	

	if ( isset( $wp_customize->selective_refresh ) ) {

		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'sparklestore_pro_customize_partial_blogname',
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'sparklestore_pro_customize_partial_blogdescription',
		) );
	}


    // List All Pages
	$pages = array();

	$pages_obj = get_pages();

	$pages[''] = esc_html__('Select Page', 'sparklestore-pro');

	foreach ($pages_obj as $page) {
	    $pages[$page->ID] = $page->post_title;
	}

	// List All Category
	$categories = get_categories();
	$blog_cat = array();

	foreach ($categories as $category) {
	    $blog_cat[$category->term_id] = $category->name;
	}

	
	/**
	 * Home Page Settings
	*/
	$wp_customize->add_panel('sparklestore_pro_frontpage_settings', array(
		'title'		=>	esc_html__('Home Sections','sparklestore-pro'),
		'priority'	=>	35,
		'description' => esc_html__('Drag and Drop to Reorder', 'sparklestore-pro'). '<img class="sparklestore_pro-drag-spinner" src="'.admin_url('/images/spinner.gif').'">',
	));	

}
add_action( 'customize_register', 'sparklestore_pro_customize_register' );


/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
if( !function_exists('sparklestore_pro_customize_partial_blogname')){
	function sparklestore_pro_customize_partial_blogname() {

		bloginfo( 'name' );
	}
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
if( !function_exists('sparklestore_pro_customize_partial_blogdescription')){
	function sparklestore_pro_customize_partial_blogdescription() {

		bloginfo( 'description' );
	}
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
*/
function sparklestore_pro_customize_preview_js() {

	wp_enqueue_script( 'sparklestore-pro-customizer', get_template_directory_uri() . '/assets/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'sparklestore_pro_customize_preview_js' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 *
 */
function sparklestore_pro_customize_scripts(){

	wp_enqueue_script('chosen', get_template_directory_uri() . '/inc/customizer/js/chosen.jquery.js', array("jquery"), '1.4.1', true);
    wp_enqueue_script('wp-color-picker-alpha', get_template_directory_uri() . '/inc/customizer/js/wp-color-picker-alpha.js', array('jquery', 'wp-color-picker'), '1.0.2', true);
    wp_enqueue_script('sparklestore-pro-customizer-script', get_template_directory_uri() . '/inc/customizer/js/customizer-controls.js', array('jquery', 'jquery-ui-datepicker'), '1.0.0', true);

	/* Sparkle Store Font Awesome */
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/library/fontawesome/css/all.min.css' );
	wp_enqueue_style('icofont', get_template_directory_uri() . '/assets/css/icofont.css', array(), '1.0.0');
    wp_enqueue_style('chosen', get_template_directory_uri() . '/inc/customizer/css/chosen.css');
    wp_enqueue_style('sparklestore-pro-customizer-style', get_template_directory_uri() . '/inc/customizer/css/customizer-controls.css', array('wp-color-picker'), '1.0.0');
}
add_action('customize_controls_enqueue_scripts', 'sparklestore_pro_customize_scripts');


/**
 * Section Re Order
*/
add_action('wp_ajax_sparklestore_pro_order_sections', 'sparklestore_pro_sections_reorder');

function sparklestore_pro_sections_reorder() {

    if (isset($_POST['sections'])) {

        set_theme_mod('sparklestore_pro_frontpage_sections', $_POST['sections']);
    }

    wp_die();
}

function sparklestore_pro_get_section_position($key) {

    $sections = sparklestore_pro_homepage_section();

    $position = array_search($key, $sections);

    $return = ( $position + 1 ) * 11;

    return $return;
}

if( !function_exists('sparklestore_pro_homepage_section') ){

	function sparklestore_pro_homepage_section(){

		$defaults = apply_filters('sparklestore_pro_homepage_sections',
			array(
				'sparklestore_pro_featured_section',
				'sparklestore_pro_aboutus_section',
				'sparklestore_pro_video_calltoaction_section',
				'sparklestore_pro_service_section',
				'sparklestore_pro_calltoaction_section',
				'sparklestore_pro_recentwork_section',
				'sparklestore_pro_counter_section',
				'sparklestore_pro_blog_section',
				'sparklestore_pro_testimonial_section',
				'sparklestore_pro_team_section',
			)
		);

		$sections = get_theme_mod('sparklestore_pro_frontpage_sections', $defaults);
		// $sections[] = 'sparklestore_pro_cta_section';
		// print_r($sections);exit;

		
        return $sections;
	}
}