<header id="masthead" class="site-header headersix" itemscope="itemscope" itemtype="http://schema.org/WPHeader" role="banner">		
	<div class="header-container">
        <?php
            sparklestore_pro_top_header_top_notice_bar();
            /**
             * Top Header
             */
            sparklestore_pro_top_header();

            /**
             * Main Header
            */
            sparklestore_pro_main_header();
        ?>
    </div>

    <div class="header-nav">
        <div class="container">
            <?php
                /**
                 * Responsive Header
                */
                get_template_part('header/header', 'responsive');
            ?>

            <div class="header-nav-inner header-middle-inner-desktop">
                
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

                <div class="quick-search-wrapper sparkle-column">
                    <?php
                        $header_minicart = get_theme_mod( 'sparklestore_pro_mini_cart_options', 'on' );
                            
                        if( !empty( $header_minicart ) && $header_minicart == 'on' ){

                            do_action( 'sparklestore_pro_woocommerce_header_cart' );
                        }
                    ?>
                </div>

            </div>
        </div>
    </div>
</header>