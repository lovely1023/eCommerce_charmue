<?php
/**
 * Initial functions.
 *
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class to manipulate menus.
 *
 */
class SparkleTheme_Nav_Walker {

    /**
     * Constructor.
     *
     * @access public
     */
    public function __construct() {

        // Edit menu walker
        add_filter('wp_edit_nav_menu_walker', array($this, 'edit_walker'), 100);

        // Add custom fields to menu
        add_filter('wp_setup_nav_menu_item', array($this, 'add_custom_fields_meta'));
        add_action('wp_nav_menu_item_custom_fields', array($this, 'add_custom_fields'), 10, 4);

        // Save menu custom fields
        add_action('wp_update_nav_menu_item', array($this, 'update_custom_nav_fields'), 10, 3);

        add_action('admin_enqueue_scripts', array($this, 'enqueue_script'));
        add_action( 'wp_enqueue_scripts', array($this, 'enqueue_script_frontend' ));
    }

    /**
     * Add custom menu style fields data to the menu.
     *
     * @access public
     * @param object $menu_item A single menu item.
     * @return object The menu item.
     */
    public function add_custom_fields_meta($menu_item) {
        $menu_item->megamenu = get_post_meta($menu_item->ID, '_menu_item_megamenu', true);
        $menu_item->megamenu_col = get_post_meta($menu_item->ID, '_menu_item_megamenu_col', true);
        $menu_item->megamenu_heading = get_post_meta($menu_item->ID, '_menu_item_megamenu_heading', true);
        $menu_item->megamenu_template = get_post_meta($menu_item->ID, '_menu_item_megamenu_template', true);
        $menu_item->megamenu_widgetarea = get_post_meta($menu_item->ID, '_menu_item_megamenu_widgetarea', true);
        $menu_item->category_post = get_post_meta($menu_item->ID, '_menu_item_category_post', true);
        $menu_item->icon = get_post_meta($menu_item->ID, '_menu_item_icon', true);

        return $menu_item;
    }

    /**
     * Add custom megamenu fields data to the menu.
     *
     * @access public
     * @param object $menu_item A single menu item.
     * @return object The menu item.
     */
    public function add_custom_fields($id, $item, $depth, $args) {
        ?>
        <?php if ($item->object == 'category') { ?>
            <p class="field-category-post description description-wide">
                <label for="edit-menu-item-category-post-<?php echo esc_attr($item->ID); ?>">
                    <input type="checkbox" id="edit-menu-item-category-post-<?php echo esc_attr($item->ID); ?>" class="edit-menu-item-category-post" value="category_post" name="menu-item-category_post[<?php echo esc_attr($item->ID); ?>]"<?php checked($item->category_post, 'category_post'); ?> />
                    <?php esc_html_e('Display Latest Posts', 'sparklethemes'); ?>
                </label>
            </p>
        <?php } ?>

        <p class="field-megamenu description description-wide">
            <label for="edit-menu-item-megamenu-<?php echo esc_attr($item->ID); ?>">
                <?php esc_html_e('Mega Menu', 'sparklethemes'); ?><br/>
                <select id="edit-menu-item-megamenu-<?php echo esc_attr($item->ID); ?>" class="widefat edit-menu-item-megamenu" name="menu-item-megamenu[<?php echo esc_attr($item->ID); ?>]"<?php checked($item->megamenu, 'sparklethemes'); ?>>
                    <option value="normal" <?php selected($item->megamenu, 'normal') ?>><?php esc_html_e('Disable', 'sparklethemes'); ?></option>
                    <option value="megamenu_full_width" <?php selected($item->megamenu, 'megamenu_full_width') ?>><?php esc_html_e('Megamenu - Full Width', 'sparklethemes'); ?></option>
                    <option value="megamenu_auto_width" <?php selected($item->megamenu, 'megamenu_auto_width') ?>><?php esc_html_e('Megamenu - Auto Width', 'sparklethemes'); ?></option>
                </select>
            </label>
        </p>

        <p class="field-megamenu-columns description description-wide">
            <label for="edit-menu-item-megamenu-col-<?php echo esc_attr($item->ID); ?>">
                <?php esc_html_e('Mega Menu Columns (from 1 to 6)', 'sparklethemes'); ?><br />
                <select id="edit-menu-item-megamenu-col-<?php echo esc_attr($item->ID); ?>" class="widefat edit-menu-item-custom" name="menu-item-megamenu_col[<?php echo esc_attr($item->ID); ?>]">
                    <option value="1" <?php selected($item->megamenu_col, 1) ?>><?php esc_html_e('1', 'sparklethemes'); ?></option>
                    <option value="2" <?php selected($item->megamenu_col, 2) ?>><?php esc_html_e('2', 'sparklethemes'); ?></option>
                    <option value="3" <?php selected($item->megamenu_col, 3) ?>><?php esc_html_e('3', 'sparklethemes'); ?></option>
                    <option value="4" <?php selected($item->megamenu_col, 4) ?>><?php esc_html_e('4', 'sparklethemes'); ?></option>
                    <option value="5" <?php selected($item->megamenu_col, 5) ?>><?php esc_html_e('5', 'sparklethemes'); ?></option>
                    <option value="6" <?php selected($item->megamenu_col, 6) ?>><?php esc_html_e('6', 'sparklethemes'); ?></option>
                </select>
            </label>
        </p>      

        <p class="field-megamenu-heading description description-wide">
            <label for="edit-menu-item-megamenu-heading-<?php echo esc_attr($item->ID); ?>">
                <?php esc_html_e('Is Heading?', 'sparklethemes'); ?>
                <select id="edit-menu-item-megamenu-heading-<?php echo esc_attr($item->ID); ?>" class="widefat edit-menu-item-custom" name="menu-item-megamenu_heading[<?php echo esc_attr($item->ID); ?>]">
                    <option value="no" <?php selected($item->megamenu_heading, 'no') ?>><?php esc_html_e('No', 'sparklethemes'); ?></option>
                    <option value="yes" <?php selected($item->megamenu_heading, 'yes') ?>><?php esc_html_e('Yes', 'sparklethemes'); ?></option>
                    <option value="hide" <?php selected($item->megamenu_heading, 'hide') ?>><?php esc_html_e('Hide', 'sparklethemes'); ?></option>
                </select>
            </label>
        </p>

        <p class="field-megamenu-template description description-thin">
            <label for="edit-menu-item-megamenu-template-<?php echo esc_attr($item->ID); ?>">
                <?php esc_html_e('Mega Menu Template', 'sparklethemes'); ?>
                <select id="edit-menu-item-megamenu-template-<?php echo esc_attr($item->ID); ?>" class="widefat edit-menu-item-custom" name="menu-item-megamenu_template[<?php echo esc_attr($item->ID); ?>]">
                    <option value="0"><?php esc_html_e('Select Template', 'sparklethemes'); ?></option>
                    <?php
                    $templates_list = get_posts(array('post_type' => 'sp-megamenu', 'numberposts' => -1, 'post_status' => 'publish'));
                    if (!empty($templates_list)) {
                        foreach ($templates_list as $template) {
                            $templates[$template->ID] = $template->post_title;
                            ?>
                            <option value="<?php echo esc_attr($template->ID); ?>" <?php selected($item->megamenu_template, $template->ID); ?>><?php echo esc_html($template->post_title); ?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </label>
        </p>

        <p class="field-megamenu-widgetarea description description-thin">
            <label for="edit-menu-item-megamenu-widgetarea-<?php echo esc_attr($item->ID); ?>">
                <?php esc_html_e('Mega Menu Widget Area', 'sparklethemes'); ?>
                <select id="edit-menu-item-megamenu-widgetarea-<?php echo esc_attr($item->ID); ?>" class="widefat edit-menu-item-custom" name="menu-item-megamenu_widgetarea[<?php echo esc_attr($item->ID); ?>]">
                    <option value="0"><?php esc_html_e('Select Widget Area', 'sparklethemes'); ?></option>
                    <?php
                    global $wp_registered_sidebars;
                    if (!empty($wp_registered_sidebars) && is_array($wp_registered_sidebars)) :
                        foreach ($wp_registered_sidebars as $sidebar) :
                            ?>
                            <option value="<?php echo esc_attr($sidebar['id']); ?>" <?php selected($item->megamenu_widgetarea, $sidebar['id']); ?>><?php echo esc_html($sidebar['name']); ?>
                            </option>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </label>
        </p>
        <?php
    }

    /**
     * Add the custom menu style fields menu item data to fields in database.
     *
     * @access public
     * @param string|int $menu_id         The menu ID.
     * @param string|int $menu_item_db_id The menu ID from the db.
     * @param array      $args            The arguments array.
     * @return void
     */
    public function update_custom_nav_fields($menu_id, $menu_item_db_id, $args) {

        $check = array('megamenu_template', 'category_post', 'megamenu', 'megamenu_col', 'megamenu_heading', 'megamenu_widgetarea', 'icon');

        foreach ($check as $key) {
            if (!isset($_POST['menu-item-' . $key][$menu_item_db_id])) {
                $_POST['menu-item-' . $key][$menu_item_db_id] = '';
            }

            $value = sanitize_text_field(wp_unslash($_POST['menu-item-' . $key][$menu_item_db_id]));
            update_post_meta($menu_item_db_id, '_menu_item_' . $key, $value);
        }
    }

    /**
     * Function to replace normal edit nav walker.
     *
     * @return string Class name of new navwalker
     */
    public function edit_walker() {
        require_once get_template_directory().'/inc/walker/class-walker-edit-custom.php';
        return 'Walker_Nav_Menu_Edit_Custom';
    }

    public function enqueue_script() {
        wp_enqueue_media();
        wp_enqueue_style('sparklethemes-mega-menu-admin-style', get_template_directory_uri() . '/inc/walker/assets/mega-menu-admin.css');
        wp_enqueue_script( 'sparklethemes-mega-menu-admin-script' , get_template_directory_uri() . '/inc/walker/assets/mega-menu-admin.js',array('jquery', 'jquery-ui-sortable'), false, true );
        wp_enqueue_script( 'sparklethemes-mega-menu-icon-admin-script' , get_template_directory_uri() . '/inc/walker/menu-icons/js/admin.js',array('jquery', 'jquery-ui-sortable'), false, true );
    }

    public function enqueue_script_frontend(){
        wp_enqueue_script('sparkle-megamenu', get_template_directory_uri() . '/inc/walker/assets/megaMenu.js', array('jquery'), '1.00', true);
    }

    function avia_ajax_switch_menu_walker() {   
        if ( ! current_user_can( 'edit_theme_options' ) )
        die('-1');

        check_ajax_referer( 'add-menu_item', 'menu-settings-column-nonce' );
    
        require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
    
        $item_ids = wp_save_nav_menu_items( 0, $_POST['menu-item'] );
        if ( is_wp_error( $item_ids ) )
            die('-1');
    
        foreach ( (array) $item_ids as $menu_item_id ) {
            $menu_obj = get_post( $menu_item_id );
            if ( ! empty( $menu_obj->ID ) ) {
                $menu_obj = wp_setup_nav_menu_item( $menu_obj );
                $menu_obj->label = $menu_obj->title; // don't show "(pending)" in ajax-added items
                $menu_items[] = $menu_obj;
            }
        }
    
        if ( ! empty( $menu_items ) ) {
            $args = array(
                'after' => '',
                'before' => '',
                'link_after' => '',
                'link_before' => '',
                'walker' => new avia_backend_walker,
            );
            echo walk_nav_menu_tree( $menu_items, 0, (object) $args );
        }
        
        die('end');
    }

}

new SparkleTheme_Nav_Walker();



/**
 * @package Sparkle Store Pro
 */
function sparkle_custom_post_types() {
    $labels = array(
        'name' => _x('Mega Menus', 'post type general name', 'sparklestore-pro'),
        'singular_name' => _x('Mega Menu', 'post type singular name', 'sparklestore-pro'),
        'menu_name' => _x('Mega Menus', 'admin menu', 'sparklestore-pro'),
        'name_admin_bar' => _x('Mega Menu', 'add new on admin bar', 'sparklestore-pro'),
        'add_new' => _x('Add New', 'Mega Menu', 'sparklestore-pro'),
        'add_new_item' => __('Add New Mega Menu', 'sparklestore-pro'),
        'new_item' => __('New Mega Menu', 'sparklestore-pro'),
        'edit_item' => __('Edit Mega Menu', 'sparklestore-pro'),
        'view_item' => __('View Mega Menu', 'sparklestore-pro'),
        'all_items' => __('All Mega Menus', 'sparklestore-pro'),
        'search_items' => __('Search Mega Menus', 'sparklestore-pro'),
        'parent_item_colon' => __('Parent Mega Menus:', 'sparklestore-pro'),
        'not_found' => __('No Mega Menu found.', 'sparklestore-pro'),
        'not_found_in_trash' => __('No Mega Menu found in Trash.', 'sparklestore-pro')
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Show Mega Menu Items', 'sparklestore-pro'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'sp-mega-menu'),
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-schedule',
        'supports' => array('title', 'editor'),
        'show_in_rest' => true,
        'capability_type' => 'post'
    );

    register_post_type('sp-megamenu', $args);
}

add_action('init', 'sparkle_custom_post_types');
