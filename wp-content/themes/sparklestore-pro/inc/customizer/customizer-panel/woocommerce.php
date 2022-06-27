<?php
if(! class_exists( 'WooCommerce' ) ) return;

$wp_customize->get_panel('woocommerce')->title = esc_html__( 'WooCommerce Settings', 'sparklestore-pro' );
$wp_customize->get_panel('woocommerce' )->priority = 16;

 /**
 * WooCommerce Category/Archive Page Layout Settings
 *
 * @since 1.0.0
*/
$wp_customize->get_section('woocommerce_product_catalog')->title = esc_html__( 'Shop & Category Page Settings', 'sparklestore' );
$wp_customize->get_section('woocommerce_product_catalog' )->priority = 1;

/** 
 * Tab 
*/
$wp_customize->add_setting('sparklestore_pro_woo_nav', array(
    //'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_pro_woo_nav', array(
    'type' => 'tab',
    'section' => 'woocommerce_product_catalog',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('General', 'sparklestore-pro'),
            'fields' => array(
                'woocommerce_shop_page_display',
                'woocommerce_category_archive_display',
                'woocommerce_default_catalog_orderby',
                'sparklestore_pro_catelog_cat_hover_style',
                'woocommerce_catalog_rows',
                'sparklestore_pro_catelog_per_page',
                'sparklestore_pro_pagination_style'

            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Layout', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_woo_cat_product_hover_style',
                'sparklestore_pro_catelog_layout',
                'sparklestore_pro_catelog_list_style',
                'sparklestore_pro_woo_product_hover_style',
                'sparklestore_pro_woo_product_hover_icon_position'
            ),
        ),
        array(
            'name' => esc_html__('Advance', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_catelog_sticky_sidebar',
                'sparklestore_pro_catelog_enable_qty_input',
                'sparklestore_pro_catelog_qty_input_style',
                'sparklestore_pro_catelog_enable_sales_tag',
                'sparklestore_pro_catelog_enable_sales_tag_text',
                'sparklestore_pro_catelog_enable_sales_tag_text_color',
                'sparklestore_pro_catelog_enable_sales_tag_text_bg_color',
                'sparklestore_pro_catelog_enable_new_tag',
                'sparklestore_pro_catelog_enable_new_tag_text',
                'sparklestore_pro_catelog_enable_new_tag_text_color',
                'sparklestore_pro_catelog_enable_new_tag_text_bg_color',
                'sparklestore_pro_catelog_enable_discount',
                'sparklestore_pro_show_product_description',
                'sparklestore_pro_hide_price',
                'sparklestore_pro_hide_rating', 

                'sparklestore_pro_catelog_enable_sales_tag_heading',
                'sparklestore_pro_catelog_enable_new_tag_heading',
                'sparklestore_pro_catelog_enable_discount_heading',
                'sparklestore_pro_catelog_discount_tag_text_color',
                'sparklestore_pro_catelog_discount_tag_bg_color',
            ),
        )
    ),
)));


/**
 * Layout Tabs
*/
$wp_customize->add_setting('sparklestore_pro_catelog_cat_hover_style', array(
    'default' => 'cat-hover1',
    'priority' => 1,
    'sanitize_callback' => 'sparklestore_pro_sanitize_select'  //done
));

$wp_customize->add_control(new Sparklestore_Pro_Image_Select($wp_customize, 'sparklestore_pro_catelog_cat_hover_style', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Shop Category Hover Style', 'sparklestore-pro'),
    'image_path' => $imagepath . '/inc/customizer/images/woocommerce/',
    'choices' => array(
        'cat-hover1' => esc_html__('Style 1', 'sparklestore-pro'),
        'cat-hover2' => esc_html__('Style 2', 'sparklestore-pro'),
        'cat-hover3' => esc_html__('Style 3', 'sparklestore-pro')
    )
)));

$wp_customize->add_setting('woocommerce_catalog_rows', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 3,
    //'transport' => 'postMessage',
));

$wp_customize->add_control('woocommerce_catalog_rows', array(
    'section' => 'woocommerce_product_catalog',
    'type' => 'number',
    'label' => esc_html__('Products per row', 'sparklestore-pro'),
    'description' => esc_html__('How many products should be shown per row?', 'sparklestore-pro')
));

$wp_customize->add_setting('sparklestore_pro_catelog_per_page', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 12,
    //'transport' => 'postMessage',
));

$wp_customize->add_control('sparklestore_pro_catelog_per_page', array(
    'section' => 'woocommerce_product_catalog',
    'type' => 'number',
    'label' => esc_html__('Products per page', 'sparklestore-pro'),
    'description' => esc_html__('How many products should be shown per page?', 'sparklestore-pro')
));

$wp_customize->add_setting('sparklestore_pro_pagination_style', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_select',
    'default' => 'normal',
    //'transport' => 'postMessage'
));

$wp_customize->add_control('sparklestore_pro_pagination_style', array(
    'section' => 'woocommerce_product_catalog',
    'type' => 'select',
    'label' => esc_html__('Pagination Style', 'sparklestore-pro'),
    'choices' => array(
        'normal' => esc_html__('Normal', 'sparklestore-pro'),
        'loadmore' => esc_html__('Load More', 'sparklestore-pro'),
        'autoscroll' => esc_html__('Infinite Scroll', 'sparklestore-pro')
    )
));


/**
 * prodcut hover style 
*/
$wp_customize->add_setting('sparklestore_pro_woo_product_hover_style', array(
    'default' => 'style1',
    'sanitize_callback' => 'sparklestore_pro_sanitize_select'  //done
));

$wp_customize->add_control(new Sparklestore_Pro_Image_Select($wp_customize, 'sparklestore_pro_woo_product_hover_style', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Display Hover Icon Style', 'sparklestore-pro'),
    'image_path' => $imagepath . '/inc/customizer/images/woocommerce/',
    'choices' => array(
        'style1' => esc_html__('Style 1', 'sparklestore-pro'),
        'style2' => esc_html__('Style 2', 'sparklestore-pro'),
        'style3' => esc_html__('Style 3', 'sparklestore-pro'),
        'style4' => esc_html__('Style 4', 'sparklestore-pro'),
        'style5' => esc_html__('Style 5', 'sparklestore-pro')
    )
)));

// $wp_customize->add_setting('sparklestore_pro_woo_product_hover_style', array(
//     'sanitize_callback' => 'sparklestore_pro_sanitize_select',
//     'default' => 'style1',
// ));

// $wp_customize->add_control('sparklestore_pro_woo_product_hover_style', array(
//     'section' => 'woocommerce_product_catalog',
//     'type' => 'select',
//     'label' => esc_html__('Display Hover Icon Style', 'sparklestore-pro'),
//     'choices' => array(
//         'style1' => esc_html__('Layout One', 'sparklestore-pro'),
//         'style2' => esc_html__('Layout Two', 'sparklestore-pro'),
//         'style3' => esc_html__('Layout Three', 'sparklestore-pro'),
//         'style4' => esc_html__('Layout Four', 'sparklestore-pro'),
//         'style5' => esc_html__('Layout Five', 'sparklestore-pro')
//     )
// ));


$wp_customize->add_setting('sparklestore_pro_woo_product_hover_icon_position', array(
    'default' => 'left',
    'sanitize_callback' => 'sparklestore_pro_sanitize_select'  //done
));

$wp_customize->add_control(new Sparklestore_Pro_Image_Select($wp_customize, 'sparklestore_pro_woo_product_hover_icon_position', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Quick/Wishlist/Compare Icon Position', 'sparklestore-pro'),
    'image_path' => $imagepath . '/inc/customizer/images/woocommerce/',
    'choices' => array(
        'left' => esc_html__('Left', 'sparklestore-pro'),
        'right' => esc_html__('Right', 'sparklestore-pro'),
        'top' => esc_html__('Top', 'sparklestore-pro'),
        'bottom' => esc_html__('Bottom', 'sparklestore-pro')
    )
)));

// $wp_customize->add_setting('sparklestore_pro_woo_product_hover_icon_position', array(
//     'sanitize_callback' => 'sparklestore_pro_sanitize_select',
//     'default' => 'left',
// ));

// $wp_customize->add_control('sparklestore_pro_woo_product_hover_icon_position', array(
//     'section' => 'woocommerce_product_catalog',
//     'type' => 'select',
//     'label' => esc_html__('Quick/Wishlist/Compare Icon Position', 'sparklestore-pro'),
//     'choices' => array(
//         'left' => esc_html__('Left', 'sparklestore-pro'),
//         'right' => esc_html__('Right', 'sparklestore-pro'),
//         'top' => esc_html__('Top', 'sparklestore-pro'),
//         'bottom' => esc_html__('Bottom', 'sparklestore-pro')
//     )
// ));



/**
 * Product Display Style
*/
$wp_customize->add_setting('sparklestore_pro_catelog_list_style', array(
    'default' => 'grid',
    'sanitize_callback' => 'sparklestore_pro_sanitize_select'  //done
));

$wp_customize->add_control(new Sparklestore_Pro_Image_Select($wp_customize, 'sparklestore_pro_catelog_list_style', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Product Display Layout', 'sparklestore-pro'),
    'image_path' => $imagepath . '/inc/customizer/images/woocommerce/',
    'choices' => array(
        'grid' => esc_html__('Grid Style', 'sparklestore-pro'),
        'list' => esc_html__('List Style', 'sparklestore-pro')
    )
)));

/** 
 * Prooduct Page Layout
*/
$wp_customize->add_setting('sparklestore_pro_catelog_layout', array(
    'default' => 'rightsidebar',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sparklestore_pro_sanitize_select'  //done
));

$wp_customize->add_control(new Sparklestore_Pro_Image_Select($wp_customize, 'sparklestore_pro_catelog_layout', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Catalog Page Layout', 'sparklestore-pro'),
    'image_path' => $imagepath . '/inc/customizer/images/layout/',
    'choices' => array(
        'fullwidth' => esc_html__('Full Width', 'sparklestore-pro'),
        'leftsidebar' => esc_html__('Left Sidebar', 'sparklestore-pro'),
        'rightsidebar' => esc_html__('Right Slider', 'sparklestore-pro'),
        'fullwidth-sidebar' => esc_html__('Full Width & Hidden Sidebar', 'sparklestore-pro')
    )
)));

/***
 * Advance Tabs
*/
$wp_customize->add_setting('sparklestore_pro_catelog_sticky_sidebar', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
    'default' => false,
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_catelog_sticky_sidebar', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Sticky Sidebar', 'sparklestore-pro'),
)));

// $wp_customize->add_setting('sparklestore_pro_catelog_enable_qty_input', array(
//     'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
//     'default' => false,
//     //'transport' => 'postMessage'
// ));

// $wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_catelog_enable_qty_input', array(
//     'section' => 'woocommerce_product_catalog',
//     'label' => esc_html__('Enable Quantity Input', 'sparklestore-pro'),
// )));

$wp_customize->add_setting('sparklestore_pro_catelog_qty_input_style', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
    'default' => 'style-1',
    //'transport' => 'postMessage'
));

$wp_customize->add_setting('sparklestore_pro_show_product_description', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
    'default' => false,
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_show_product_description', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Show Description', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_hide_price', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
    'default' => false,
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_hide_price', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Hide Price', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_hide_rating', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
    'default' => false,
    //'transport' => 'postMessage'
));

// $wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_hide_rating', array(
//     'section' => 'woocommerce_product_catalog',
//     'label' => esc_html__('Hide Rating', 'sparklestore-pro'),
// )));


// $wp_customize->add_control('sparklestore_pro_catelog_qty_input_style', array(
//     'type'  => 'select',
//     'section' => 'woocommerce_product_catalog',
//     'label' => esc_html__('Quantity Input Style', 'sparklestore-pro'),
//     'choices' => array(
//         'style-1' => esc_html__('Style 1', 'sparklestore-pro'),
//         'style-2' => esc_html__('Style 2', 'sparklestore-pro'),
//         'style-3' => esc_html__('Style 3', 'sparklestore-pro')
//     )
// ));


$wp_customize->add_setting('sparklestore_pro_catelog_enable_sales_tag_heading', array(
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_catelog_enable_sales_tag_heading', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Sale Tag Setting', 'sparklestore-pro')
)));

// enable sales tags
$wp_customize->add_setting('sparklestore_pro_catelog_enable_sales_tag', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
    'default' => true,
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_catelog_enable_sales_tag', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Enable Sales Tag', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_catelog_enable_sales_tag_text', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => esc_html__("Sale!", 'sparklestore-pro'),
    //'transport' => 'postMessage',
));

$wp_customize->add_control('sparklestore_pro_catelog_enable_sales_tag_text', array(
    'section' => 'woocommerce_product_catalog',
    'type' => 'text',
    'label' => esc_html__('Sales Tag Text', 'sparklestore-pro'),
));


$wp_customize->add_setting('sparklestore_pro_catelog_enable_sales_tag_text_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_catelog_enable_sales_tag_text_color', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Sale Text Color', 'sparklestore-pro'),
)));




$wp_customize->add_setting('sparklestore_pro_catelog_enable_sales_tag_text_bg_color', array(
    'default' => '#f33c3c',
    'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
    //'transport' => 'postMessage'
));

$wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_catelog_enable_sales_tag_text_bg_color', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Sale Background Color', 'sparklestore-pro'),
)));



$wp_customize->add_setting('sparklestore_pro_catelog_enable_new_tag_heading', array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_catelog_enable_new_tag_heading', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('New Tag Setting', 'sparklestore-pro')
)));


$wp_customize->add_setting('sparklestore_pro_catelog_enable_new_tag', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
    'default' => true,
    //'transport' => 'postMessage'
));
$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_catelog_enable_new_tag', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Enable New Tag', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_catelog_enable_new_tag_text', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => esc_html__("New", 'sparklestore-pro'),
    //'transport' => 'postMessage',
));
$wp_customize->add_control('sparklestore_pro_catelog_enable_new_tag_text', array(
    'section' => 'woocommerce_product_catalog',
    'type' => 'text',
    'label' => esc_html__('New Tag Text', 'sparklestore-pro'),
));

$wp_customize->add_setting('sparklestore_pro_catelog_enable_new_tag_text_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    //'transport' => 'postMessage'
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_catelog_enable_new_tag_text_color', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('New Text Color', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_catelog_enable_new_tag_text_bg_color', array(
    'default' => '#009966',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    //'transport' => 'postMessage'
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_catelog_enable_new_tag_text_bg_color', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('New Background Color', 'sparklestore-pro'),
)));


/**
 * discount 
 */
$wp_customize->add_setting('sparklestore_pro_catelog_enable_discount_heading', array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_catelog_enable_discount_heading', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Discount Tag Setting', 'sparklestore-pro')
)));


$wp_customize->add_setting('sparklestore_pro_catelog_enable_discount', array(
    'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
    'default' => true,
    //'transport' => 'postMessage'
));
$wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_catelog_enable_discount', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Enable Discount(%)', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_catelog_discount_tag_text_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    //'transport' => 'postMessage'
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_catelog_discount_tag_text_color', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Discount Text Color', 'sparklestore-pro'),
)));

$wp_customize->add_setting('sparklestore_pro_catelog_discount_tag_bg_color', array(
    'default' => '#ffc60a',
    'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
    //'transport' => 'postMessage'
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_catelog_discount_tag_bg_color', array(
    'section' => 'woocommerce_product_catalog',
    'label' => esc_html__('Discount Background Color', 'sparklestore-pro'),
)));



/** signle page option */
$wp_customize->add_section('sparklestore_pro_woocommerce_signle_product_settings', array(
    'title'    => esc_html__('Single Product Page Settings', 'sparklestore-pro'),
    'panel'    => 'woocommerce',
    'priority' => 2
));

$wp_customize->add_setting('sparklestore_pro_woocommerce_signle_product_settings_nav', array(
    //'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Sparklestore_Pro_Control_Tab($wp_customize, 'sparklestore_pro_woocommerce_signle_product_settings_nav', array(
    'type' => 'tab',
    'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
    'buttons' => array(
        array(
            'name' => esc_html__('Settings', 'sparklestore-pro'),
            'fields' => array(
                'sparklestore_pro_woo_product_page_layout',
                'sparklestore_pro_woo_product_gallery_width',
                'sparklestore_pro_woo_product_gallery_layout',
                'sparklestore_pro_single_breadcrumb',
                'sparklestore_pro_single_product_next_previous',
                'sparklestore_pro_woo_product_image_zoom',
                'sparklestore_pro_woo_product_image_lightbox',
                
                'sparklestore_pro_woo_product_countdown_timer',
                'sparklestore_pro_woo_product_countdown_timer_style',
                'sparklestore_pro_woo_product_tab_style',
                'sparklestore_pro_woo_show_extra_tab',

                'sparklestore_pro_woo_product_extra_tab_title',
                'sparklestore_pro_woo_product_extra_tab',
                
                'sparklestore_pro_woo_single_product_related_heading',
                'sparklestore_pro_enable_related_product',
                'sparklestore_pro_woo_single_product_related_title',
                'sparklestore_pro_woo_single_product_related_style',
                'sparklestore_pro_woo_single_product_related_no_of_product',
                'sparklestore_pro_woo_single_product_related_column',


                'sparklestore_pro_woo_single_product_upsell_heading',
                'sparklestore_pro_enable_upsell_product',
                'sparklestore_pro_woo_single_product_upsell_title',
                'sparklestore_pro_woo_single_product_upsell_style',
                'sparklestore_pro_woo_single_product_upsell_no_of_product',
                'sparklestore_pro_woo_single_product_upsell_column',
                
            ),
            'active' => true,
        )
    ),
)));


    $wp_customize->add_setting('sparklestore_pro_woo_product_page_layout', array(
        'default' => 'fullwidth',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sparklestore_pro_sanitize_select'  //done
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Image_Select($wp_customize, 'sparklestore_pro_woo_product_page_layout', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Page Layout', 'sparklestore-pro'),
        'image_path' => $imagepath . '/inc/customizer/images/layout/',
        'choices' => array(
            'fullwidth' => esc_html__('Full Width', 'sparklestore-pro'),
            'leftsidebar' => esc_html__('Left Sidebar', 'sparklestore-pro'),
            'rightsidebar' => esc_html__('Right Slider', 'sparklestore-pro')
        )
    )));

    $wp_customize->add_setting('sparklestore_pro_single_breadcrumb', array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
        'default' => true,
        //'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_single_breadcrumb', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Breadcrumbs', 'sparklestore-pro'),
    )));

    $wp_customize->add_setting('sparklestore_pro_single_product_next_previous', array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
        'default' => true,
        //'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_single_product_next_previous', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Next / Prev Navigation', 'sparklestore-pro'),
    )));

    /** gallery width */
    $wp_customize->add_setting('sparklestore_pro_woo_product_gallery_width', array(
        'default' => '6-12',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sparklestore_pro_sanitize_select'  //done
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Image_Select($wp_customize, 'sparklestore_pro_woo_product_gallery_width', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Product Gallery Width', 'sparklestore-pro'),
        'image_path' => $imagepath . '/inc/customizer/images/woocommerce/single/',
        'choices' => array(
            '4-12'  => esc_html__('4/12', 'sparklestore-pro'),
            '5-12'  => esc_html__('5/12', 'sparklestore-pro'),
            '6-12'  => esc_html__('6/12(50%)', 'sparklestore-pro'),
            '7-12'  => esc_html__('7/12', 'sparklestore-pro'),
            '8-12'  => esc_html__('8/12', 'sparklestore-pro'),
            '12-12' => esc_html__('12/12', 'sparklestore-pro'),
            
        )
    )));


    $wp_customize->add_setting('sparklestore_pro_woo_product_gallery_layout', array(
        'default' => 'default',
        'sanitize_callback' => 'sparklestore_pro_sanitize_select'  //done
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Image_Select($wp_customize, 'sparklestore_pro_woo_product_gallery_layout', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Product Gallery Display Style', 'sparklestore-pro'),
        'image_path' => $imagepath . '/inc/customizer/images/woocommerce/single/',
        'choices' => array(
            'default' => esc_html__('Default', 'sparklestore-pro'),
            'left' => esc_html__('Gallery Left', 'sparklestore-pro'),
            'right' => esc_html__('Gallery Right', 'sparklestore-pro'),
        )
    )));

    

    $wp_customize->add_setting('sparklestore_pro_woo_product_image_zoom', array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
        'default' => true,
        //'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_woo_product_image_zoom', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Zoom Product Image', 'sparklestore-pro'),
    )));

    $wp_customize->add_setting('sparklestore_pro_woo_product_image_lightbox', array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
        'default' => true,
        //'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_woo_product_image_lightbox', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Lightbox', 'sparklestore-pro'),
    )));


    $wp_customize->add_setting('sparklestore_pro_woo_product_countdown_timer', array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
        'default' => true,
        //'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_woo_product_countdown_timer', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Show Countdown Timer', 'sparklestore-pro'),
    )));
    
    $wp_customize->add_setting('sparklestore_pro_woo_product_tab_style', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'tabs',
        //'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('sparklestore_pro_woo_product_tab_style', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'type' => 'select',
        'label' => esc_html__('Tabs Display Style', 'sparklestore-pro'),
        'choices' => array(
            'tabs' => esc_html__('Default Style', 'sparklestore-pro'),
            'tabs-vertical' => esc_html__('Vertical Tab', 'sparklestore-pro'),
            'accordian'     => esc_html__('Accordion Tab', 'sparklestore-pro'),
            'toggle'        => esc_html__('Toggle Tab', 'sparklestore-pro'),
            'sections'      => esc_html__('Open Section Tab', 'sparklestore-pro'),
        )
    ));

    /**
     * extra tab 
     */
    $wp_customize->add_setting('sparklestore_pro_woo_show_extra_tab', array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
        'default' => true,
        //'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_woo_show_extra_tab', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Show Extra Tab', 'sparklestore-pro'),
    )));

    $wp_customize->add_setting('sparklestore_pro_woo_product_extra_tab_title', array(
        'default'       =>      '',
        'sanitize_callback' => 'sparklestore_pro_sanitize_text'
    ));

    $wp_customize->add_control('sparklestore_pro_woo_product_extra_tab_title', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'type' => 'text',
        'label' => esc_html__('Extra Tab Title', 'sparklestore-pro'),
    ));

    $wp_customize->add_setting('sparklestore_pro_woo_product_extra_tab', array(
        'default'       =>      '',
        'sanitize_callback' => 'sparklestore_pro_sanitize_text'
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Page_Editor($wp_customize, 'sparklestore_pro_woo_product_extra_tab', array(
        'section'    => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label'      => esc_html__('Extra Tab Content', 'sparklestore-pro'),
        'type'       => 'textarea',
        'include_admin_print_footer' => true
    )));


    /** related products settings */
    $wp_customize->add_setting('sparklestore_pro_woo_single_product_related_heading', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_woo_single_product_related_heading', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Related Product', 'sparklestore-pro')
    )));

    
    $wp_customize->add_setting('sparklestore_pro_enable_related_product', array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
        'default' => true,
        //'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_enable_related_product', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Enable Related Product', 'sparklestore-pro'),
    )));


    $wp_customize->add_setting('sparklestore_pro_woo_single_product_related_title', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => esc_html__("Related Products", 'sparklestore-pro'),
        //'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('sparklestore_pro_woo_single_product_related_title', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'type' => 'text',
        'label' => esc_html__('Related Product Title', 'sparklestore-pro'),
    ));


    $wp_customize->add_setting('sparklestore_pro_woo_single_product_related_style', array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_select',
        'default' => 'grid',
        //'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('sparklestore_pro_woo_single_product_related_style', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'type' => 'select',
        'label' => esc_html__('Display Layout', 'sparklestore-pro'),
        'choices' => array(
            'slider'    => esc_html__('Slider', 'sparklestore-pro'),
            'grid'      => esc_html__('Grid', 'sparklestore-pro'),
        )
    ));


    $wp_customize->add_setting('sparklestore_pro_woo_single_product_related_no_of_product', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 8,
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Range_Control($wp_customize, 'sparklestore_pro_woo_single_product_related_no_of_product', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Number of Products', 'sparklestore-pro'),
        'input_attrs' => array(
            'min' => 2,
            'max' => 16,
            'step' => 1
        )
    )));


    $wp_customize->add_setting('sparklestore_pro_woo_single_product_related_column', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 4,
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Range_Control($wp_customize, 'sparklestore_pro_woo_single_product_related_column', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Columns', 'sparklestore-pro'),
        'input_attrs' => array(
            'min' => 2,
            'max' => 6,
            'step' => 1
        )
    )));


    /** upsell products  */
    $wp_customize->add_setting('sparklestore_pro_woo_single_product_upsell_heading', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Customize_Heading($wp_customize, 'sparklestore_pro_woo_single_product_upsell_heading', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Upsell Product', 'sparklestore-pro')
    )));

    $wp_customize->add_setting('sparklestore_pro_enable_upsell_product', array(
        'sanitize_callback' => 'sparklestore_pro_sanitize_checkbox',
        'default' => true,
    ));

    $wp_customize->add_control(new Sparklestore_Pro_Checkbox_Control($wp_customize, 'sparklestore_pro_enable_upsell_product', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Enable Upsell Product', 'sparklestore-pro'),
    )));

    $wp_customize->add_setting('sparklestore_pro_woo_single_product_upsell_title', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => esc_html__("Upsell Products", 'sparklestore-pro'),
    ));
    
    $wp_customize->add_control('sparklestore_pro_woo_single_product_upsell_title', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'type' => 'text',
        'label' => esc_html__('Upsell Product Title', 'sparklestore-pro'),
    ));


    $wp_customize->add_setting('sparklestore_pro_woo_single_product_upsell_style', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'grid',
    ));
    
    $wp_customize->add_control('sparklestore_pro_woo_single_product_upsell_style', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'type' => 'select',
        'label' => esc_html__('Display Layout', 'sparklestore-pro'),
        'choices' => array(
            'slider' => esc_html__('Slider', 'sparklestore-pro'),
            'grid' => esc_html__('Grid', 'sparklestore-pro')
        )
    ));

    $wp_customize->add_setting('sparklestore_pro_woo_single_product_upsell_no_of_product', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 8,
        //'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Range_Control($wp_customize, 'sparklestore_pro_woo_single_product_upsell_no_of_product', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Number of Product', 'sparklestore-pro'),
        'input_attrs' => array(
            'min' => 2,
            'max' => 16,
            'step' => 1
        )
    )));


    $wp_customize->add_setting('sparklestore_pro_woo_single_product_upsell_column', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 4,
        //'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Range_Control($wp_customize, 'sparklestore_pro_woo_single_product_upsell_column', array(
        'section' => 'sparklestore_pro_woocommerce_signle_product_settings',
        'label' => esc_html__('Columns', 'sparklestore-pro'),
        'input_attrs' => array(
            'min' => 2,
            'max' => 6,
            'step' => 1
        )
    )));


    
    /** store notice settings */
    $wp_customize->add_setting('sparklestore_pro_store_notice_bg_color', array(
        'default' => '#a46497',
        'sanitize_callback' => 'sparklestore_pro_sanitize_color_alpha',
        //'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control(new Sparklestore_Pro_Alpha_Color_Control($wp_customize, 'sparklestore_pro_store_notice_bg_color', array(
        'section' => 'woocommerce_store_notice',
        'label' => esc_html__('Background Color', 'sparklestore-pro'),
    )));


    $wp_customize->add_setting('sparklestore_pro_store_notice_text_color', array(
        'default' => '#fff',
        'sanitize_callback' => 'sparklestore_pro_sanitize_hex_color',
        //'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sparklestore_pro_store_notice_text_color', array(
        'section' => 'woocommerce_store_notice',
        'label' => esc_html__('Text Color', 'sparklestore-pro'),
    )));