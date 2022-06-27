<?php
/**
 *
 * @package Sparkle Themes
 */
require_once get_template_directory() . '/inc/widgets/add-widget.php';

require_once get_template_directory() . '/inc/widgets/widget-fields.php';

$active_widgets = array_keys(of_get_option('enabled_widgets', sparklestore_pro_widget_list()));

if (is_array($active_widgets)) {
    foreach ($active_widgets as $widgets) {
        if (file_exists(get_template_directory() . '/inc/widgets/' . $widgets . '.php')) {
            require_once get_template_directory() . '/inc/widgets/' . $widgets . '.php';
        }
    }
}

function sparklestore_pro_widget_list() {
    // return array();
    return array(
        'sparkle-product-categories' => esc_html__('Product Categories', 'sparklestore-pro'),
        'sparkle-tabs-product-categories' => esc_html__('Tabs Category by Products', 'sparklestore-pro'),
        'sparkle-single-category-product' => esc_html__('Single Category & Products', 'sparklestore-pro'),
        'sparkle-offer-products' => esc_html__('Hot Offer Products', 'sparklestore-pro'),
        'sparkle-single-product-offer' => esc_html__('Hot Single Offer Product', 'sparklestore-pro'),
        'sparkle-productlist-pro' => esc_html__('Products by Category', 'sparklestore-pro'),
        'sparkle-products-type' => esc_html__('All Type Products', 'sparklestore-pro'),
        'sparkle-blogs-widget' => esc_html__('Blog Posts', 'sparklestore-pro'),
        'sparkle-brandlogo' => esc_html__('Client Or Brand Logo', 'sparklestore-pro'),
        'sparkle-fullpromo-pro' => esc_html__('Full Promo Image/Video', 'sparklestore-pro'),
        'sparkle-promo-pro' => esc_html__('Grid Promo Widget', 'sparklestore-pro'),
        'sparkle-services' => esc_html__('Quick Services Area', 'sparklestore-pro'),
        'sparkle-team' => esc_html__('All Team Member', 'sparklestore-pro'),
        'sparkle-testimonial' => esc_html__('Testimonials', 'sparklestore-pro'),
        'sparkle-faq' => esc_html__('Frequently Asked Questions', 'sparklestore-pro'),
        'sparkle-aboutinfo' => esc_html__('About Information', 'sparklestore-pro'),
        'sparkle-accordian' => esc_html__('Accordian Widget', 'sparklestore-pro'),
        'sparkle-tab' => esc_html__('Tabs Widget', 'sparklestore-pro'),
        'sparkle-facebook-box' => esc_html__('Facebook', 'sparklestore-pro'),
        'sparkle-instagram' => esc_html__('Instagram', 'sparklestore-pro'),
        'sparkle-social-icons' => esc_html__('Social Icons', 'sparklestore-pro'),
        'sparkle-contact-detail' => esc_html__('Contact Details', 'sparklestore-pro'),
    );
}

/**
 * Enqueue Style and Script for widgets
 */
function sparklestore_pro_admin_widgets_scripts() {

    global $pagenow;
    
    if( $pagenow === 'widgets.php' || $pagenow == 'customize.php' || $pagenow == 'post.php' ){
        wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/library/fontawesome/css/all.min.css' );

        // wp_enqueue_style('icofont', get_template_directory_uri() . '/assets/css/icofont.css', array(), '1.0.0');
        wp_enqueue_style('sparklestore-pro-admin-widget-style', get_template_directory_uri() . '/inc/widgets/css/widget-style.css', array('wp-color-picker'), '1.0');
        wp_enqueue_style('chosen', get_template_directory_uri() . '/inc/customizer/css/chosen.css');


        wp_enqueue_script('wp-color-picker-alpha', get_template_directory_uri() . '/inc/customizer/js/wp-color-picker-alpha.js', array('jquery', 'wp-color-picker'), '1.0.2', true);
        wp_enqueue_media();
        wp_enqueue_script('chosen', get_template_directory_uri() . '/inc/customizer/js/chosen.jquery.js', array("jquery"), '1.4.1', true);
        wp_enqueue_script('sparklestore-pro-widget-script', get_template_directory_uri() . '/inc/widgets/js/widget-script.js', array('jquery', 'wp-color-picker', 'jquery-ui-datepicker'), true);
    }

    
}
add_action('admin_enqueue_scripts', 'sparklestore_pro_admin_widgets_scripts', 100);
add_action('elementor/editor/before_enqueue_scripts', 'sparklestore_pro_admin_widgets_scripts');


/* ADD EDITOR TO CUSTOMIZER */

function sparklestore_pro_customizer_editor() {
    ?>
    <div id="cl-wp-editor-widget-container" style="display: none;">
        <a class="cl-wp-editor-widget-close" href="#" title="<?php esc_attr_e('Close', 'sparklestore-pro'); ?>"><i class="icofont-close-squared-alt"></i></a>
        <div class="editor">
            <?php
            $settings = array('textarea_rows' => 55, 'editor_height' => 260);
            wp_editor('', 'wpeditorwidget', $settings);
            ?>
            <p><a href="#" class="cl-wp-editor-widget-update-close button button-primary"><?php _e('Save and Close', 'sparklestore-pro'); ?></a></p>
        </div>
    </div>
    <div id="cl-wp-editor-widget-backdrop" style="display: none;"></div>
    <?php
}

// END output_wp_editor_widget_html*/

add_action('widgets_admin_page', 'sparklestore_pro_customizer_editor', 100);
add_action('customize_controls_print_footer_scripts', 'sparklestore_pro_customizer_editor');
add_action('elementor/editor/before_enqueue_scripts', 'sparklestore_pro_customizer_editor');

//SiteOrigin Builder
if (function_exists('siteorigin_panels_render')) {
    add_action('admin_print_scripts-post.php', 'sparklestore_pro_customizer_editor', 100);
    add_action('admin_print_scripts-post-new.php', 'sparklestore_pro_customizer_editor', 100);
}

//Beaver Builder
if (class_exists('FLBuilder')) {
    if (isset($_GET['fl_builder'])) {
        add_action('sparklestore_pro_after_footer', 'sparklestore_pro_customizer_editor', 100);
    }
}

/* Add Filters for the Customizer wp_editor */
add_filter('wp_editor_widget_content', 'wptexturize');
add_filter('wp_editor_widget_content', 'convert_smilies');
add_filter('wp_editor_widget_content', 'convert_chars');
add_filter('wp_editor_widget_content', 'wpautop');
add_filter('wp_editor_widget_content', 'shortcode_unautop');
add_filter('wp_editor_widget_content', 'do_shortcode', 11);
