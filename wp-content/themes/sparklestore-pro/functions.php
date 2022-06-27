<?php
/**
 * Sparkle Store functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sparkle Store Pro
 */

if ( ! function_exists( 'sparklestore_pro_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sparklestore_pro_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Sparkle Store, use a find and replace
	 * to change 'sparklestore-pro' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'sparklestore-pro', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	*/
	add_theme_support( 'custom-logo', array(
		'width'       => 190,
		'height'      => 60,
		'flex-width'  => true,				
		'flex-height' => true,
		'header-text' => array( '.site-title', '.site-description' ),
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('sparklestore-slider', 1350, 520, true);


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'sparkleprimary' => esc_html__( 'Primary', 'sparklestore-pro' ),
		'sparklecategory' => esc_html__( 'Category', 'sparklestore-pro' ),		
		'sparklesecondrymenu' => esc_html__( 'Secondary Menu', 'sparklestore-pro' ),
		'sparklefootermenu' => esc_html__( 'Footer Menu', 'sparklestore-pro' ),
	) );


	/*
	 * Editor style.
	*/
	add_editor_style( 'css/editor-style.css' );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'gallery',
		'video',
		'audio',
		'quote',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sparklestore_pro_custom_background_args', array(
		'default-color' => 'f8f8f8',
		'default-image' => '',
	) ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'sparklestore_pro_setup' );

/**
 * WooCommerce Support Themes  
*/
if ( ! function_exists( 'sparklestore_pro_add_woocommerce_support' ) ) {
    /**
     * Call WooCommerce Support Action  
    */
    function sparklestore_pro_add_woocommerce_support() {
        add_theme_support( 'woocommerce', array(
            // 'thumbnail_image_width' => 150,
            // 'single_image_width'    => 600,

            'product_grid'          => array(
                'default_rows'    => 3,
                'min_rows'        => 1,
                'default_columns' => 3,
                'min_columns'     => 1,
                'max_columns'     => 4,
            ),
        ) );


        // Set up the WordPress Gallery Lightbox
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
}
add_action( 'after_setup_theme', 'sparklestore_pro_add_woocommerce_support' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sparklestore_pro_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sparklestore_pro_content_width', 640 );
}
add_action( 'after_setup_theme', 'sparklestore_pro_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sparklestore_pro_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar Widget Area', 'sparklestore-pro' ),
		'id'            => 'sparklesidebarone',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="spstore widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar Widget Area', 'sparklestore-pro' ),
		'id'            => 'sparklesidebartwo',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="spstore widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Home: Top FullWidth Widget Area', 'sparklestore-pro' ),
		'id'            => 'sparkletopwidgetarea',
		'before_widget' => '<section id="%1$s" class="widget sp-section %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="spstore widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Home: Main Widget Area', 'sparklestore-pro' ),
		'id'            => 'sparklemainwidgetarea',
		'before_widget' => '<section id="%1$s" class="widget sp-section %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="spstore widget-title">',
		'after_title'   => '</h2>',
	));


	register_sidebar( array(
		'name'          => esc_html__( 'Home: Sidebar Widget Area', 'sparklestore-pro' ),
		'id'            => 'sparklemainsidebar',
		'before_widget' => '<section id="%1$s" class="widget sp-section %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="spstore widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Home: Buttom FullWidth Widget Area', 'sparklestore-pro' ),
		'id'            => 'sparklebuttomwidgetarea',
		'before_widget' => '<section id="%1$s" class="widget sp-section %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="spstore widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Top Footer Widget Area', 'sparklestore-pro' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area One', 'sparklestore-pro' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area Two', 'sparklestore-pro' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area Three', 'sparklestore-pro' ),
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area Four', 'sparklestore-pro' ),
		'id'            => 'footer-5',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));


	register_sidebar( array(
		'name'          => esc_html__( 'Bottom Footer Widget Area', 'sparklestore-pro' ),
		'id'            => 'footer-6',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

}
add_action( 'widgets_init', 'sparklestore_pro_widgets_init' );

/**
 * Enqueue scripts and styles.
*/
function sparklestore_pro_scripts() {

	$sparklestore_pro_theme = wp_get_theme();
	$theme_version = $sparklestore_pro_theme->get( 'Version' );

	/* Sparklestore Google Font */
	$sparklestore_pro_font_args = array(
        'family' => 'Lato:300,400,700|Open+Sans:300,700,600,800,400|Lato:300,700,600,800,400|Poppins:400,300,500,600,700',
    );
    wp_enqueue_style('sparklestore-google-fonts', add_query_arg( $sparklestore_pro_font_args, "//fonts.googleapis.com/css" ) );

    /* Sparkle Store Pro Font Icon */
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/library/fontawesome/css/all.min.css' );
	wp_enqueue_style('icofont', get_template_directory_uri() . '/assets/css/icofont.css', '1.0.0');
   
	/* flexslider Slider */
	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/assets/library/flexslider/css/flexslider.css' );

    /* Sparkle Store slick CSS */
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css' );

    /**
	 * Load Chosen CSS Library File
	*/
	wp_enqueue_style( 'chosen-css', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/inc/customizer/css/chosen.min.css' );

    wp_enqueue_style( 'sparklestore-pro-bg-color', get_template_directory_uri() . '/assets/css/bg-color.css' );
	wp_enqueue_style( 'sparklestore-pro-font-color', get_template_directory_uri() . '/assets/css/font-color.css' );
	wp_enqueue_style( 'sparklestore-pro-border-color', get_template_directory_uri() . '/assets/css/border-color.css' );
	
	/* Sparkle Store Main Style */
	wp_enqueue_style( 'sparklestore-pro-style', get_stylesheet_uri() );
	wp_enqueue_style( 'sparklestore-pro-responsive', get_template_directory_uri() . '/assets/css/responsive.css' );
	
    
    $max_container  = '.container{ max-width:'. get_theme_mod('sparklestore_pro_website_container_width','1220') .'px; }';
    wp_add_inline_style( 'sparklestore-pro-style', $max_container );

    /* Sparkle Store html5 */
    wp_enqueue_script('html5', get_template_directory_uri() . '/assets/library/html5shiv/html5shiv.min.js', array('jquery'), false);
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

    /* Sparkle Store Respond */
    wp_enqueue_script('respond', get_template_directory_uri() . '/assets/library/respond/respond.min.js', array('jquery'), false);
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

    /* Sparkle Store Video Promo Video */
	wp_enqueue_script('YTPlayer', get_template_directory_uri() . '/assets/js/jquery.mb.YTPlayer.min.js', array('jquery'), true);
	wp_enqueue_style('YTPlayer', get_template_directory_uri() . '/assets/css/jquery.mb.YTPlayer.min.css');


    /* Sparkle Store Countdown */
    wp_enqueue_script('jquery-countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.js', array('jquery'), true);

    /* flexslider Slider Js */
	wp_enqueue_script('flexslider-js', get_template_directory_uri() . '/assets/library/flexslider/js/jquery.flexslider-min.js', array('jquery'), true);

	/** owl */
	wp_enqueue_script('owl.carousel', get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), true);
	wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css');

    /* Sparkle Store slick */
    wp_enqueue_script('slick', get_template_directory_uri() . '/assets//js/slick.min.js', array('jquery'), true);

    /* Sparkle Store News Ticker */
    wp_enqueue_script('acmeticker', get_template_directory_uri() . '/assets/js/acmeticker.js', array('jquery'), true);
    
	/**
	 * Load Chosen JS Library File
	*/
	wp_enqueue_script('chosen-js', get_template_directory_uri() . '/inc/customizer/js/chosen.jquery.js', array("jquery"), true);

    /* Sparkle Store Theme Custom js */
	wp_enqueue_script('sparklestore-common', get_template_directory_uri() . '/assets/js/common.js', array('jquery','masonry'), true);
	
    wp_localize_script( 'sparklestore-common', 'sparklestore_pro_tabs_ajax_action', array( 'ajaxurl' => admin_url( 'admin-ajax.php') ) );

    /* Sparkle Store Jquery Section Start */
    wp_enqueue_script( 'sparklestore-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), true );
	
	/** dynamic css option */
	if ('file' != get_theme_mod('sparkle_store_pro_style_option', 'head')) {
        wp_add_inline_style('sparklestore-pro-responsive', sparklestore_pro_dynamic_css());
    } else {
		// We will probably need to load this file
        require_once( ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'file.php' );

        global $wp_filesystem;
        $upload_dir = wp_upload_dir(); // Grab uploads folder array
        $dir = trailingslashit($upload_dir['basedir']) . 'extra' . DIRECTORY_SEPARATOR; // Set storage directory path

        WP_Filesystem(); // Initial WP file system
        $wp_filesystem->mkdir($dir); // Make a new folder 'oceanwp' for storing our file if not created already.
        $wp_filesystem->put_contents($dir . 'custom-style.css', sparklestore_pro_dynamic_css(), 0644); // Store in the file.
        wp_enqueue_style('sparklestore-pro-dynamic-style', trailingslashit($upload_dir['baseurl']) . 'extra/custom-style.css', array(), NULL);
    }

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/** maintainance mode css */
	if( get_theme_mod('sparklestore_pro_maintenance', 'off') == 'on') {
		wp_enqueue_style('maintainance', get_template_directory_uri() . '/inc/customizer/css/maintenance.css');
	}

	// if ( !sparklestore_pro_is_preview() && get_theme_mod( 'sparklestore_pro_preloader_options', 0 ) == 0 ) {
		wp_enqueue_style('preloader-style', get_template_directory_uri() . '/assets/css/loaders.css');
	// }
  	

}
add_action( 'wp_enqueue_scripts', 'sparklestore_pro_scripts' );

/**
 * Require init.
*/
require  trailingslashit( get_template_directory() ).'sparklethemes/init.php';


if ( isset( $wp_customize->selective_refresh ) ) {
	
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title',
		'container_inclusive' => false,
		'render_callback' => 'sparklestore_pro_customize_partial_blogname',
	) );

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'container_inclusive' => false,
		'render_callback' => 'sparklestore_pro_customize_partial_blogdescription',
	) );

	$wp_customize->selective_refresh->add_partial( 'sparklestore_pro_email_icon', array(
		'selector' => '.quickinfowrap',
		'container_inclusive' => false,
	) );

	$wp_customize->selective_refresh->add_partial( 'paymentlogo_image_one', array(
		'selector' => '.payment-accept',
		'container_inclusive' => false,
	) );

	
	$wp_customize->selective_refresh->add_partial( 'sparklestore_pro_footer_copyright', array(
		'selector' => '.coppyright',
		'container_inclusive' => false,
	) );

}

function sparklestore_pro_customize_partial_blogname() {
	bloginfo( 'name' );
}
function sparklestore_pro_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


/**
 * Load Files.
 */
require get_template_directory() . '/inc/init.php';



if( !function_exists('sparklestore_pro_is_preview')){
	function sparklestore_pro_is_preview(){
		if( defined('ELEMENTOR_VERSION') && \Elementor\Plugin::$instance->preview->is_preview_mode() ){
			return true;
		}

		return false;
	}
}


function sparklestore_pro_tagline_style() {
    return array(
		'none'		=> esc_html__('None', 'sparklestore-pro'),
        'sp-section-title-top-center' => esc_html__('Top Center Aligned', 'sparklestore-pro'),
        'sp-section-title-top-cs' => esc_html__('Top Center Aligned with Seperator', 'sparklestore-pro'),
        'sp-section-title-top-left' => esc_html__('Left Aligned', 'sparklestore-pro'),
        'sp-section-title-top-ls' => esc_html__('Left Aligned with Seperator', 'sparklestore-pro'),
        'sp-section-title-single-row' => esc_html__('Single Row', 'sparklestore-pro'),
        'sp-section-title-big' => esc_html__('Top Center with Double Seperator', 'sparklestore-pro'),
        'sp-section-title-left-border' => esc_html__('Left Aligned with Buttom Border', 'sparklestore-pro'),
        'sp-section-title-bg-color' => esc_html__('Left Aligned Background Color', 'sparklestore-pro')
    );
}

if( !function_exists('sparklestore_pro_default_title_block')){
	function sparklestore_pro_default_title_block(){
		return array(
			'sparklestore_pro_title_style' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_title_style',
                'sparklestore_pro_widgets_title' => __('Title Style', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_field_options' => sparklestore_pro_tagline_style()
            ),

            'sparklestore_pro_title' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_title',
                'sparklestore_pro_widgets_title' => esc_html__('Title', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text',
            ),

            'sparklestore_pro_short_desc' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_short_desc',
                'sparklestore_pro_widgets_title' => esc_html__('Short Description', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'textarea',
                'sparklestore_pro_widgets_row'    => 4,
            ),
		);
	}
}
if( !function_exists('sparklestore_pro_widget_default_style')){
	function sparklestore_pro_widget_default_style(){
		return array(
			'sparklestore_pro_title_color' => array(
				'sparklestore_pro_widgets_name' => 'sparklestore_pro_title_color',
				'sparklestore_pro_widgets_title' => __('Title Color', 'sparklestore-pro'),
				'sparklestore_pro_widgets_field_type' => 'color',
				'sparklestore_pro_widgets_default' => '#232529',
				'sparklestore_pro_widgets_class' => 'cl-col6'
			),

			'sparklestore_pro_text_color' => array(
				'sparklestore_pro_widgets_name' => 'sparklestore_pro_text_color',
				'sparklestore_pro_widgets_title' => __('Text Color', 'sparklestore-pro'),
				'sparklestore_pro_widgets_field_type' => 'color',
				'sparklestore_pro_widgets_default' => '#232529',
				'sparklestore_pro_widgets_class' => 'cl-col6'
			),


			'sparklestore_pro_bg_color' => array(
				'sparklestore_pro_widgets_name' => 'sparklestore_pro_bg_color',
				'sparklestore_pro_widgets_title' => __('Background', 'sparklestore-pro'),
				'sparklestore_pro_widgets_field_type' => 'color',
				'sparklestore_pro_widgets_default' => '',
				'sparklestore_pro_widgets_class' => 'cl-col6'
			),

			'sparklestore_pro_bg_image' => array(
				'sparklestore_pro_widgets_name' => 'sparklestore_pro_bg_image',
				'sparklestore_pro_widgets_title' => __('OR Background Image', 'sparklestore-pro'),
				'sparklestore_pro_widgets_field_type' => 'upload'
			),

			'sparklestore_pro_overlay_color' => array(
				'sparklestore_pro_widgets_name' => 'sparklestore_pro_overlay_color',
				'sparklestore_pro_widgets_title' => __('Overlay Color', 'sparklestore-pro'),
				'sparklestore_pro_widgets_field_type' => 'alpha-color',
				'sparklestore_pro_widgets_default' => '',
				'sparklestore_pro_widgets_class' => 'cl-col6'
			),

			'sparklestore_pro_bottom_seprator_heading' => array(
				'sparklestore_pro_widgets_name' => 'sparklestore_pro_bottom_seprator_heading',
				'sparklestore_pro_widgets_title' => __('Seprator', 'sparklestore-pro'),
				'sparklestore_pro_widgets_field_type' => 'heading'
			),

			// Bottom Seperator
			'sparklestore_pro_bottom_seprator' => array(
				'sparklestore_pro_widgets_name' => 'sparklestore_pro_bottom_seprator',
				'sparklestore_pro_widgets_title' => __('Bottom Seprator', 'sparklestore-pro'),
				'sparklestore_pro_widgets_field_type' => 'select',
				'sparklestore_pro_widgets_field_options' => array_merge(array('none' => 'None'), sparklestore_pro_svg_seperator())

			),

			'sparklestore_pro_seprator_height' => array(
				'sparklestore_pro_widgets_name' => 'sparklestore_pro_seprator_height',
				'sparklestore_pro_widgets_title' => __('Seprator Height', 'sparklestore-pro'),
				'sparklestore_pro_widgets_field_type' => 'number',
				'sparklestore_pro_widgets_default' => '150',
			),

			'sparklestore_pro_bottom_seprator_color' => array(
				'sparklestore_pro_widgets_name' => 'sparklestore_pro_bottom_seprator_color',
				'sparklestore_pro_widgets_title' => __('Seprator Color', 'sparklestore-pro'),
				'sparklestore_pro_widgets_field_type' => 'alpha-color',
				'sparklestore_pro_widgets_default' => ''

			),

			'sparklestore_pro_padding_top' => array(
				'sparklestore_pro_widgets_name' => 'sparklestore_pro_padding_top',
				'sparklestore_pro_widgets_title' => __('Padding Top', 'sparklestore-pro'),
				'sparklestore_pro_widgets_field_type' => 'number',
				'sparklestore_pro_widgets_default' => '40',
				'sparklestore_pro_widgets_class' => 'cl-col6'
			),
			'sparklestore_pro_padding_bottom' => array(
				'sparklestore_pro_widgets_name' => 'sparklestore_pro_padding_bottom',
				'sparklestore_pro_widgets_title' => __('Padding Bottom', 'sparklestore-pro'),
				'sparklestore_pro_widgets_field_type' => 'number',
				'sparklestore_pro_widgets_class' => 'cl-col6',
				'sparklestore_pro_widgets_default' => '40'
			)
		);
	}
}


if( !function_exists('get_store_default_image')){
	function get_store_default_image(){
		if( !isset($_GLOBAL['default_store_image'])){
			$default_img_id = get_theme_mod('sparklestore_pro_default_image_id');
			// $default_img_id = get_theme_mod('sparklestore_pro_default_image');
			
			if( $default_img_id) $_GLOBAL['default_store_image'] = wp_get_attachment_image_src($default_img_id, 'woocommerce_thumbnail', true);
			else $_GLOBAL['default_store_image'][0] = get_template_directory_uri(). '/assets/images/default-placeholder.png';
		}
			
		return $_GLOBAL['default_store_image'][0];
	}
}


/**
REMOVE ADDITIONAL INFO TAB
 */
  
add_filter( 'woocommerce_product_tabs', 'bbloomer_remove_product_tabs', 9999 );
  
function bbloomer_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] ); 
    return $tabs;
}


/**
PRODUCT DESCRIPTION REMOVE
 */
 
add_filter( 'woocommerce_product_description_heading', '__return_null' );


/**
MOVE TABS UNDER ADD TO CART
 */
 
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_before_add_to_cart_quantity', 'woocommerce_output_product_data_tabs', 60 );

