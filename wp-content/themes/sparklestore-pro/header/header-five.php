<header id="masthead" class="site-header headerfive" itemscope="itemscope" itemtype="http://schema.org/WPHeader" role="banner">		
	<div class="header-container">
        <?php
            sparklestore_pro_top_header_top_notice_bar();
            /**
             * Top Header
             */
            sparklestore_pro_top_header();
        ?>

        <div class="header-middle clearfix">
			<div class="container">
                
                <?php
                    /**
                     * Responsive Header
                    */
                    get_template_part('header/header', 'responsive');
                ?>

				<?php $hide_mobile = get_theme_mod('sparklestore_pro_header_hide_search_on_mobile', 0); ?>
				<div class="header-middle-inner header-middle-inner-desktop hide-mobile-<?php echo intval($hide_mobile); ?>">
                    
                    <div class="sparklelogo">
						<?php do_action( 'sparklestore_pro_get_logo' ); ?>
                    </div>
                    
                </div>

			</div>
		</div>
    </div>

    <div class="header-nav">
        <div class="container">
                
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
                    <div class="toggle-useraccount">
                        <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
                            <i class="icofont-user-alt-3"></i>
                        </a>
                    </div>
                    <div class="toggle-searchicon">
                        <i class="icofont-search"></i>
                    </div>
                    <?php
                        $header_minicart = get_theme_mod( 'sparklestore_pro_mini_cart_options', 'on' );
                            
                        if( !empty( $header_minicart ) && $header_minicart == 'on' ){

                            do_action( 'sparklestore_pro_woocommerce_header_cart' );
                        }
                    ?>
                </div>

            </div>

            <div class="header-control toggle-search">
                <?php
                    /**
                     * Advance & Normal Search
                     */
                    do_action( 'sparklestore_pro_woocommerce_product_search' );
                ?>
            </div>
        </div>
    </div>
</header>