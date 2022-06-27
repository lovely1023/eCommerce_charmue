<?php
/**
 * Includes all the custom controller classes
 *
 * @since sparklestore-pro 1.2.8
 *
 * @param string $file_path , path from the theme
 * @return string full path of file inside theme
 *
 */

/*cssbox controller*/
require get_template_directory() .'/inc/custom-controller/cssbox/class-control-cssbox.php';

/*buttonset controller*/
require get_template_directory() .'/inc/custom-controller/buttonset/class-control-buttonset.php';
require get_template_directory() .'/inc/custom-controller/buttonset/class-control-responsive-buttonset.php';

/* group controller*/
require get_template_directory() .'/inc/custom-controller/group/class-control-group.php';




if ( ! function_exists( 'sparklewp_save_menu_location' ) ) {
    /**
     * sparklewp_save_menu_location
     * since 1.2.8
     * Save menu location for select menu on customizer
     * @return void
     */
    function sparklewp_save_menu_location(){

        if( ! current_user_can( 'manage_options' )){
            return;
        }
        /*update menu location value*/
        if( is_customize_preview()){
            $nav_locations =  get_theme_mod( 'nav_menu_locations');
            if( isset($nav_locations['sparkleprimary'] )){
                set_theme_mod( 'primary-menu-custom-menu', $nav_locations['sparkleprimary'] );
            }
            if( isset($nav_locations['sparklesecondrymenu'] )){
                set_theme_mod( 'secondary-menu-custom-menu', $nav_locations['sparklesecondrymenu'] );
            }
            
        }
        /*just run once for previous*/
        if( get_theme_mod( 'primary_menu' ) !== 'lUpdated' ){
            $nav_locations =  get_theme_mod( 'nav_menu_locations');
            if( 'custom' == get_theme_mod( 'primary_menu' ) && get_theme_mod( 'primary-menu-custom-menu' ) ){
                $nav_locations['sparkleprimary'] = get_theme_mod( 'primary-menu-custom-menu' );
            }
            if( get_theme_mod( 'secondary-menu-custom-menu' )){
                $nav_locations['sparklesecondrymenu'] = get_theme_mod( 'secondary-menu-custom-menu' );
            }
            
            /*Now we dont need this theme mode*/
            set_theme_mod( 'primary_menu', 'lUpdated' );
            if( is_array( $nav_locations )){
                set_theme_mod( 'nav_menu_locations', array_map( 'absint', $nav_locations ) );
            }
        }
    }
    add_action( 'after_setup_theme', 'sparklewp_save_menu_location' );
}
