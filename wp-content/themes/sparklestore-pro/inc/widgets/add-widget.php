<?php
/**
*
* Save the widget area id options table
*/
add_action('load-widgets.php', 'sparklestore_pro_save_widgets');

function sparklestore_pro_save_widgets() {

    if ( !isset($_POST['cl-add-widget-input']) || !isset( $_POST[ 'cl-sidebar-nonce' ] ) || !wp_verify_nonce( $_POST[ 'cl-sidebar-nonce' ], 'sparklestore_pro_create_widget_area-nonce' ) ){
        return;
    }
    
    $widget = trim($_POST['cl-add-widget-input']);
    if(empty($widget) ){
        return;
    }
    
    $new_widget = isset($_POST['cl-add-widget-input']) ? wp_strip_all_tags($_POST['cl-add-widget-input']) : '';
    
    if(get_theme_mod( 'sparklestore_pro_widget_areas' )){
        $allwidgets = get_theme_mod( 'sparklestore_pro_widget_areas' );
    }else{
        $allwidgets = array();
    }
    
    $allwidgets[sanitize_text_field($new_widget)] = sanitize_key($new_widget);

    array_unique(array_filter($allwidgets));

    set_theme_mod( 'sparklestore_pro_widget_areas', $allwidgets );
    wp_redirect( admin_url( 'widgets.php' ) );
    die();
}

/**
 *
 * Add Widget Related Scripts
 * 
**/
add_action('load-widgets.php', 'sparklestore_pro_widget_scripts');

function sparklestore_pro_widget_scripts(){
    wp_enqueue_script( 'sparklestore-pro-widget-areas', get_template_directory_uri() . '/inc/widgets/js/add-widget-script.js', array('jquery'), true);

    // Localize script
    wp_localize_script(
        'cl-widget-areas',
        'sparkle_widget_params',
        array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'widgeturl' => admin_url('widgets.php'),
        )
    );
}

/**
 *
 * Add Widget Related Styles
 * 
**/
add_action('admin_print_styles-widgets.php', 'sparklestore_pro_widget_inline_styles');

function sparklestore_pro_widget_inline_styles(){ ?>
    <style type="text/css">
        .cl-widgets-holder{ width: 40%; }
        .cl-widgets-holder .add-custom-widgets{padding: 0;}
        .cl-widgets-holder .add-custom-widgets h3{background: #f9f9f9; border-bottom: 1px solid #e2e2e2; padding-left: 33px;padding: 14px 30px;margin: 0;}
        .cl-widgets-holder .add-custom-widgets form{padding: 30px;}
        .cl-widgets-holder .add-custom-widgets .widget-control-actions{margin-top: 12px;}
        .cl-widgets-holder .cl-widget-toggle{ background: #f9f9f9; border-top: 1px solid #e2e2e2; border-bottom: 1px solid #e2e2e2; padding-left: 33px;padding: 14px 30px; margin: 0;}
        .cl-widgets-holder .cl-custom-widgets { padding: 30px; margin: 0; list-style: decimal inside;}
        .cl-custom-widgets li{ padding: 10px; margin: 0; font-size: 14px;}
        .cl-custom-widgets li:nth-child(even){ background: #FAFAFA}
        .cl-custom-widgets li:nth-child(odd){ background: #F0F0F0}
        .cl-custom-widgets a.cl-remove-widget { text-decoration: none; float: right; color: #FF0000; padding: 0 5px; font-size: 18px;}
    </style>
<?php
}

/**
 *
 * Adding Widget Form Interface in widget page
 * 
**/
add_action('sidebar_admin_page', 'sparklestore_pro_add_widget_box');

function sparklestore_pro_add_widget_box() {
    /**
    *
    * Creates a area accepting widget ID
    */
    $nonce = wp_create_nonce ( 'sparklestore_pro_create_widget_area-nonce' );
    
    $all_widgets = get_theme_mods();
    ?>
    <div id="cl-add-widget" class="widgets-holder-wrap cl-widgets-holder">

        <div class="add-custom-widgets">
            <h3><?php esc_html_e( 'Create Widget Area', 'sparklestore-pro' ); ?></h3>
            <form id="addWidgetAreaForm" action="" method="post">
                <input type="hidden" name="cl-sidebar-nonce" value="<?php echo esc_attr( $nonce ); ?>" />
                <div class="widget-content">
                    <input id="cl-add-widget-input" name="cl-add-widget-input" type="text" class="regular-text" placeholder="<?php esc_attr_e( 'Name of Widget', 'sparklestore-pro' ); ?>" />
                </div>
                <div class="widget-control-actions">
                    <input class="button-primary" type="submit" value="<?php esc_attr_e( 'Create Widget Area', 'sparklestore-pro' ); ?>" />
                </div>
            </form>
        </div>

        <div class="remove-custom-widgets">
            <?php
            /** Registering Dynamic Sidebars **/
            $sparklestore_pro_widgets = get_theme_mod('sparklestore_pro_widget_areas');

            if(!empty($sparklestore_pro_widgets)){
                $sparklestore_pro_widgets = array_filter($sparklestore_pro_widgets);
                ?>
                <h3 class="cl-widget-toggle"><?php esc_html_e( 'Remove Custom Widgets', 'sparklestore-pro' ); ?></h3>
                <ol class="cl-custom-widgets" style="">
                <?php
                foreach($sparklestore_pro_widgets as $title => $id) {
                    ?>
                    <li>
                        <span><?php echo esc_html($title); ?></span>
                        <a class="cl-remove-widget" href="#" data-widget="<?php echo esc_attr($title); ?>"><i class="icofont-trash"></i></a>
                    </li>
                    <?php
                }
                ?>
                </ol>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
}

/**
 *
 * Delete Custom Widget Areas
 *
**/
add_action( 'wp_ajax_sparklestore_pro_remove_widget_area', 'sparklestore_pro_remove_widget_area' );

function sparklestore_pro_remove_widget_area() {
    
    $sparklestore_pro_widgets = get_theme_mod('sparklestore_pro_widget_areas');
    
    $widget = isset($_REQUEST['widget']) ? $_REQUEST['widget'] : '';
    unset($sparklestore_pro_widgets[$widget]);

    set_theme_mod( 'sparklestore_pro_widget_areas', $sparklestore_pro_widgets );

    die();
}

/**
 *
 * Registering Dynamic Sidebars
 *
**/
add_action( 'widgets_init', 'sparklestore_pro_register_dynamic_sidebars' );

function sparklestore_pro_register_dynamic_sidebars() {
    $sparklestore_pro_widgets = get_theme_mod('sparklestore_pro_widget_areas');

    if(!empty($sparklestore_pro_widgets)){
        $sparklestore_pro_widgets = array_filter($sparklestore_pro_widgets);
        foreach($sparklestore_pro_widgets as $title => $id) {
            register_sidebar( array(
                'name'          => $title,
                'id'            => $id,
                'description'   => esc_html__( 'Add widgets here.', 'sparklestore-pro' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h4 class="widget-title">',
                'after_title'   => '</h4>',
            ) );
        }
    }
}

/**
 *
 * Adding Button
 *
 * */
function sparklestore_pro_add_widgets_screen_link() {

    // Build link with same style as 'Manage with Live Preview'.
    $link_html = sprintf(
            wp_kses(
                    ' <a href="%1$s" class="page-title-action">%2$s</a>', array(
        // Link tag only.
        'a' => array(
            'href' => array(),
            'class' => array(),
        ),
                    )
            ), esc_url(admin_url('widgets.php#cl-add-widget')), esc_html__('Add New Widget Area', 'sparklestore-pro')
    );

    // Output JavaScript to insert link after 'Manage with Live Preview'.
    ?>

    <script type="text/javascript">

        jQuery(document).ready(function ($) {

            // Encode string for security
            var link_html = <?php echo wp_json_encode($link_html); ?>;

            // Insert after last button by title
            $('.page-title-action').last().after(link_html);

        });

    </script>
    <?php
}

// WP 4.6+.
add_action('admin_print_footer_scripts-widgets.php', 'sparklestore_pro_add_widgets_screen_link');