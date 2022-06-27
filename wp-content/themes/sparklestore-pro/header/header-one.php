<?php
    /**
     * @see  sparklestore_pro_skip_links() - 5
     */
    do_action('sparklestore_pro_header_before');

    /**
     * @see  sparklestore_pro_top_header() - 15
     * @see  sparklestore_pro_main_header() - 20
     */
    do_action('sparklestore_pro_header');

    do_action('sparklestore_pro_header_after');
?>

<div class="header-nav">
    <div class="container">
        <div class="header-nav-inner">
            
            <?php do_action( 'sparklestore_header_vertical' ); ?>
            
            <div class="box-header-nav main-menu-wapper">
                <div class="main-menu">
                    <div class="main-menu-links">
                        <?php
                            wp_nav_menu( array(
                                    'theme_location'  => 'sparkleprimary',
                                    'menu'            => 'primary-menu',
                                    'container'       => '',
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'menu_class'      => 'main-menu',
                                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'walker' => new SparkleTheme_Custom_Nav_Walker()
                                )
                            );
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>