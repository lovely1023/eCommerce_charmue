<?php
/**
 * Add a Sub Nav Toggle to the Expanded Menu and Mobile Menu.
 *
 * @param stdClass $args An array of arguments.
 * @param string   $item Menu item.
 * @param int      $depth Depth of the current menu item.
 *
 * @return stdClass $args An object of wp_nav_menu() arguments.
 */
function sparkletheme_add_sub_toggles_to_main_menu( $args, $item, $depth ) {
    
    if ( isset( $args->show_toggles ) && $args->show_toggles ) {
        $args->after  = '';
    
        // Add a toggle to items with children.
        if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
            $toggle_target_string = '.menu-modal .menu-item-' . $item->ID . ' > .sub-menu';
            // Add the sub menu toggle.
            $args->after .= '<button class="toggle sub-menu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" aria-expanded="false"><i class="fas fa-angle-down"></i></button>';
        }
    }

    return $args;
}
add_filter( 'nav_menu_item_args', 'sparkletheme_add_sub_toggles_to_main_menu', 10, 3 );


/**
 * enqueue script and style
 */
if( !function_exists('sparkletheme_menu_navigation_script')){

    function sparkletheme_menu_navigation_script(){
        wp_enqueue_script( 'sparklestore-navigation', get_template_directory_uri() . '/inc/mobile-menu/navigation.js', array(),  true );
        wp_enqueue_style( 'sparklestore-pro-mobile-menu', get_template_directory_uri() . '/inc/mobile-menu/mobile-menu.css' );
    }
    add_action( 'wp_enqueue_scripts', 'sparkletheme_menu_navigation_script' );
}

/**
 * mobile menu toggle button
 *
 * @return void
 */
function sparkletheme_mobile_menu_toggle_button(){
    $icon_or_text = get_theme_mod('menu-icon-open-icon-options', 'icon');
    $icon         = get_theme_mod('menu-open-icon', 'fas fa-bars');
    $text         = get_theme_mod('menu-open-text', 'Menu');
    $icon_position = get_theme_mod('menu-icon-open-icon-position', 'before');
    $alignment     = get_theme_mod('menu-open-icon-align', 'swp-flex-align-left');

    $icontexthtml = "";
    if( $icon_position == 'before'){
        if( $icon_or_text == 'icon' || $icon_or_text == 'both'){
            $icontexthtml.= '<span class="toggle-icon">
            <i class="'. $icon. '"></i>
            </span>';
        }
    }
    
    if( $icon_or_text == 'text' || $icon_or_text == 'both'){
        $icontexthtml.= '<span class="toggle-text">'.esc_html($text).'</span>';
    }
    
    if( $icon_position == 'after'){
        if( $icon_or_text == 'icon' || $icon_or_text == 'both'){
            $icontexthtml.= '<span class="toggle-icon">
            <i class="'. $icon. '"></i>
            </span>';
        }
    }

    $html = '<button class="sp-toggle-nav-icon toggle nav-toggle mobile-nav-toggle sparkle-column '. esc_attr($alignment). '" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
        <span class="toggle-inner">
            '. $icontexthtml. '
        </span>
    </button>';
    echo force_balance_tags($html);
}
add_action('sparkletheme_menu_toggle', 'sparkletheme_mobile_menu_toggle_button', 10);


if( !function_exists('sparletheme_mobile_menu_register')){

    function sparletheme_mobile_menu_register(){
        
        get_template_part('inc/mobile-menu/mobile-menu');
    }
    add_action('wp_footer', 'sparletheme_mobile_menu_register');
}