<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sparkle Store Pro
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php sparklestore_pro_html_tag_schema(); ?> >
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

    <?php do_action('sparklestore_pro_before_page'); ?>
    
    <div id="page" class="site">
    
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'sparklestore-pro' ); ?></a>

    <?php
    /**
     * Header Type
    */
    if( is_singular(array('post', 'page', 'product', 'portfolio')) ){

        $hide_header = rwmb_meta('hide_header');

    }else{

        $hide_header = '';
    }
    
    if (!$hide_header) {
        /**
         * sparklewp_action_header hook
         *
         * @hooked sparklewp_header - 10
         */
        do_action( 'sparklewp_action_header' );
        
    }
    ?>

<?php
/**
 * Banner Slider
*/
    if( is_home() || is_front_page() ){
        
        $slider_options     = get_theme_mod( 'sparklestore_pro_slider_section_section', 'off' );
        $slider_type        = get_theme_mod( 'sparklestore_pro_homepage_slider_type', 'default' );
        $promo_displayside  = get_theme_mod( 'sparklestore_pro_promo_display_side', 'left' );
        $slider_layout      = get_theme_mod( 'sparklestore_pro_slider_layout', 'fullwidth' );

        $slidercss = array();
        $slidercss[] = $slider_layout;
        $slidercss[] = 'off'; //get_theme_mod( 'sparklestore_vertical_menu_options','off' );
        
        if( $slider_options == 'off' ){
            
            echo '<div class="sp-normal-slider clearfix '.implode(' ', $slidercss).'">';

                if($slider_layout == 'fullwidth'){

                    if($slider_type == 'default'){

                        // Normal Slider
                        do_action('sparklestore-slider');

                    }elseif($slider_type == 'advance'){

                        // Advance Slider
                        do_action('sparklestore-advance-slider');

                    }elseif($slider_type == 'banner'){

                        // Normal Banner
                        do_action('sparklestore-header-banner');

                    }elseif($slider_type == 'video'){

                        // video banner
                        do_action('sparklestore-header-video-banner');

                    }else{
                        
                        // Revolution Slider
                        do_action('sparklestore-revolution');
                    }

                    /**
                     *  Seperator
                    */
                    do_action('after_slider_section');
                    

                }elseif($slider_layout == 'boxed'){ ?>

                    <div class="container">
                        <?php
                            if($slider_type == 'default'){

                                // Normal Slider
                                do_action('sparklestore-slider');

                            }elseif($slider_type == 'advance'){

                                // Advance Slider
                                do_action('sparklestore-advance-slider');

                            }elseif($slider_type == 'banner'){
                                
                                // Normal Banner
                                do_action('sparklestore-header-banner');

                            }elseif($slider_type == 'video'){

                                // video banner
                                do_action('sparklestore-header-video-banner');

                            }else{

                                // Revolution Slider
                                do_action('sparklestore-revolution');
                            }

                            /**
                             *  Seperator
                            */
                            do_action('after_slider_section');
                        ?>
                    </div>

                <?php }elseif($slider_layout == 'sliderpromo'){ ?>
                    
                    <div class="sliderpromo alighment-<?php echo esc_attr( $promo_displayside ); ?>">
                        <div class="container">
                            <div class="slider-inner-wrap">
                                <div class="sliderwrap">
                                    <?php 
                                        if($slider_type == 'default'){

                                            // Normal Slider
                                            do_action('sparklestore-slider');
                    
                                        }elseif($slider_type == 'advance'){
                    
                                            // Advance Slider
                                            do_action('sparklestore-advance-slider');
                    
                                        }elseif($slider_type == 'banner'){
                    
                                            // Normal Banner
                                            do_action('sparklestore-header-banner');
                    
                                        }elseif($slider_type == 'video'){
                    
                                            // video banner
                                            do_action('sparklestore-header-video-banner');
                    
                                        }
                                    ?>
                                </div>
                                <div class="promowrap">
                                    <?php
                                        $promoone    = get_theme_mod( 'sparklestore_pro_slider_promo_one' );
                                        $promooneurl = get_theme_mod( 'sparklestore_pro_slider_promo_one_url' );
                                        $promotwo    = get_theme_mod( 'sparklestore_pro_slider_promo_two' );
                                        $promotwourl = get_theme_mod( 'sparklestore_pro_slider_promo_two_url' );
                                        
                                        if(!empty($promoone)){
                                    ?>
                                        <div class="promoitems">
                                            <a href="<?php echo esc_url( $promooneurl ); ?>" target="_blank">
                                                <img src="<?php echo esc_url( $promoone ); ?>" />
                                                <div class="promoarea_img" style="background-image:url(<?php echo esc_url( $promoone ); ?>);"></div>
                                            </a>
                                        </div>
                                    <?php } if(!empty($promotwo)){ ?>
                                        <div class="promoitems">
                                            <a href="<?php echo esc_url( $promotwourl ); ?>" target="_blank">
                                                <img src="<?php echo esc_url( $promotwo ); ?>" />
                                                <div class="promoarea_img" style="background-image:url(<?php echo esc_url( $promotwo ); ?>);"></div>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    /**
                     *  Seperator
                    */
                    do_action('after_slider_section'); 

                }elseif($slider_layout == 'sliderverticalmenu'){ ?>
                    
                    <div class="container">
                        <div class="sliderverticalmenuwrap">
                            <?php 
                                if($slider_type == 'default'){

                                    // Normal Slider
                                    do_action('sparklestore-slider');
            
                                }elseif($slider_type == 'advance'){
            
                                    // Advance Slider
                                    do_action('sparklestore-advance-slider');
            
                                }elseif($slider_type == 'banner'){
            
                                    // Normal Banner
                                    do_action('sparklestore-header-banner');
            
                                }elseif($slider_type == 'video'){
            
                                    // video banner
                                    do_action('sparklestore-header-video-banner');
            
                                }
                            ?>
                        </div>
                    </div>
                    
                    <div class="contaner">
                        <?php do_action('after_slider_section'); ?>
                    </div>
                <?php }

            echo '</div>';
        }
    }
?>

<div id="content" class="site-content">

<?php
    $service_position = get_theme_mod('sparklestore_display_services_section', 'footer');
    if( $service_position == 'header' && (is_home() || is_front_page())){
        /**
         * HomePage Header Services Area
         */
        do_action( 'sparklestore_pro_services_footer_area', 5 );
    }