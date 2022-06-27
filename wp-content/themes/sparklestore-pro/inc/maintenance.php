<?php
$sparklestore_pro_maintenance_date = get_theme_mod('sparklestore_pro_maintenance_date');
$date = str_replace('/', '-', $sparklestore_pro_maintenance_date);
$utcdate = date("D, d M Y H:i:s T", strtotime($date));
header("HTTP/1.1 503 Service Unavailable");
header("Retry-After: $utcdate");
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php
        wp_head();
        $sparklestore_pro_maintenance_bg_type = get_theme_mod('sparklestore_pro_maintenance_bg_type', 'banner');
        ?>
    </head>
    <body class="<?php echo esc_attr($sparklestore_pro_maintenance_bg_type); ?>">
        <?php
        $sparklestore_pro_maintenance_logo = get_theme_mod('sparklestore_pro_maintenance_logo');
        $sparklestore_pro_maintenance_title = get_theme_mod('sparklestore_pro_maintenance_title', esc_html__('WEBSITE UNDER MAINTENANCE', 'sparklestore-pro'));
        $sparklestore_pro_maintenance_text = get_theme_mod('sparklestore_pro_maintenance_text', esc_html__('We are coming soon with new changes. Stay Tuned!', 'sparklestore-pro'));
        $sparklestore_pro_maintenance_shortcode = get_theme_mod('sparklestore_pro_maintenance_shortcode');
        $sparklestore_pro_maintenance_banner_image = get_theme_mod('sparklestore_pro_maintenance_banner_image', get_template_directory_uri() . '/assets/images/bg.jpg');
        $sparklestore_pro_maintenance_slider_shortcode = get_theme_mod('sparklestore_pro_maintenance_slider_shortcode');
        $sparklestore_pro_maintenance_sliders = get_theme_mod('sparklestore_pro_maintenance_sliders');
        $sparklestore_pro_maintenance_slider_pause = get_theme_mod('sparklestore_pro_maintenance_slider_pause', 5);
        $sparklestore_pro_maintenance_video = get_theme_mod('sparklestore_pro_maintenance_video', 'yNAsk4Zw2p0');
        $sparklestore_pro_maintenance_bg_overlay_color = get_theme_mod('sparklestore_pro_maintenance_bg_overlay_color', 'rgba(255,255,255,0)');
        $sparklestore_pro_maintenance_title_color = get_theme_mod('sparklestore_pro_maintenance_title_color', '#FFFFFF');
        $sparklestore_pro_maintenance_text_color = get_theme_mod('sparklestore_pro_maintenance_text_color', '#FFFFFF');
        $sparklestore_pro_maintenance_counter_color = get_theme_mod('sparklestore_pro_maintenance_counter_color', '#FFFFFF');
        $sparklestore_pro_maintenance_social_icon_color = get_theme_mod('sparklestore_pro_maintenance_social_icon_color', '#FFFFFF');
        ?>

        <div class="cl-maintenance-bg">
            <?php
            if ($sparklestore_pro_maintenance_bg_type == 'revolution' && !empty($sparklestore_pro_maintenance_slider_shortcode)) {
                echo do_shortcode($sparklestore_pro_maintenance_slider_shortcode);
            } elseif ($sparklestore_pro_maintenance_bg_type == 'banner' && !empty($sparklestore_pro_maintenance_banner_image)) {
                ?>
                <div class="cl-maintenance-banner" style="background-image:url(<?php echo esc_url($sparklestore_pro_maintenance_banner_image) ?>)"></div>
                <?php
            } elseif ($sparklestore_pro_maintenance_bg_type == 'video' && !empty($sparklestore_pro_maintenance_video)) {
                $video_attr = 'data-property="{videoURL:\'' . $sparklestore_pro_maintenance_video . '\', mobileFallbackImage:\'https://img.youtube.com/vi/' . $sparklestore_pro_maintenance_video . '/maxresdefault.jpg\'}"';
                ?>
                <div class="cl-maintenance-video" <?php echo $video_attr; ?>></div>
                <?php
            } elseif ($sparklestore_pro_maintenance_bg_type == 'slider' && !empty($sparklestore_pro_maintenance_sliders)) {
                ?>
                <div class="sparklestore-slider cl-maintenance-slider" data-autoplay="1" data-timeout="<?php echo $sparklestore_pro_maintenance_slider_pause * 1000; ?>" data-column="1">
                <ul class="slides">
                    <?php
                    $sliders = json_decode($sparklestore_pro_maintenance_sliders);
                    if( $sliders )
                    foreach ($sliders as $slider) {
                        $image = $slider->image;
                        if ($image) {
                            $slide_bg_css = "style=background-image:url(" . esc_url($image) . ")";
                            ?>
                            <li>
                                <div class="cl-maintenance-slide" <?php echo esc_attr($slide_bg_css) ?>></div>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php
            }
            ?>
            </ul>
        </div>

        <div id="cl-maintenance-page">
            <div class="cl-maintenance-page animated fadeInUp">
                <header>
                    <?php
                    if (!empty($sparklestore_pro_maintenance_logo)) {
                        ?>
                        <div class="cl-maintenance-logo">
                            <img src="<?php echo esc_url($sparklestore_pro_maintenance_logo) ?>" alt="Logo">
                        </div>
                        <?php
                    }
                    ?>

                    <?php
                    if (!empty($sparklestore_pro_maintenance_title)) {
                        ?>
                        <h1>
                            <?php echo esc_html($sparklestore_pro_maintenance_title) ?>
                        </h1>
                        <?php
                    }
                    ?>

                    <?php echo wp_kses_post($sparklestore_pro_maintenance_text); ?>
                </header>

                <?php if ($sparklestore_pro_maintenance_date) { ?>
                    <div class="cl-maintenance-countdown">
                        <div class="cl-count-label"><span class="days">%D</span><label><?php esc_html_e('Days','sparklestore-pro'); ?></label></div>
                        <div class="cl-count-label"><span class="hours">%H</span><label><?php echo __('Hours', 'sparklestore-pro'); ?></label></div>
                        <div class="cl-count-label"><span class="minutes">%M</span><label><?php echo __('Minutes', 'sparklestore-pro'); ?></label></div>
                        <div class="cl-count-label"><span class="seconds">%S</span><label><?php echo __('Seconds', 'sparklestore-pro'); ?></label></div>
                                
                    </div>
                        
                        <script type="text/javascript">
                            jQuery(document).ready(function($) {
                                jQuery(".cl-maintenance-countdown").countdown({ date: "<?php echo esc_attr( $sparklestore_pro_maintenance_date ); ?>" })
                            });
                        </script>
                               
                <?php } ?>

                <?php if ($sparklestore_pro_maintenance_shortcode) {
                    ?>
                    <div class="cl-maintenance-shortcode">
                        <?php echo do_shortcode($sparklestore_pro_maintenance_shortcode); ?>
                    </div>
                <?php } ?>

                <footer>
                    <div class="cl-maintenance-social">
                        <?php do_action('sparklestore_social_media_link'); ?>
                    </div>
                </footer>
            </div>
        </div>
        <style type="text/css">
            .cl-maintenance-bg:after{
                background-color: <?php echo $sparklestore_pro_maintenance_bg_overlay_color; ?>
            }
            #cl-maintenance-page{
                color: <?php echo $sparklestore_pro_maintenance_text_color; ?>
            }
            #cl-maintenance-page h1,
            #cl-maintenance-page h2,
            #cl-maintenance-page h3,
            #cl-maintenance-page h4,
            #cl-maintenance-page h5,
            #cl-maintenance-page h6{
                color: <?php echo $sparklestore_pro_maintenance_title_color; ?>
            }
            #cl-maintenance-page .cl-maintenance-countdown *{
                color: <?php echo $sparklestore_pro_maintenance_counter_color; ?>
            }
            .cl-maintenance-social a{
                border-color: <?php echo $sparklestore_pro_maintenance_social_icon_color; ?>;
                color: <?php echo $sparklestore_pro_maintenance_social_icon_color; ?>;
            }
        </style>
        <?php
        wp_footer();
        ?>
    </body>
</html>