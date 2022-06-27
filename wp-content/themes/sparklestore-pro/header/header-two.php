<header id="masthead" class="site-header headertwo" itemscope="itemscope" itemtype="http://schema.org/WPHeader" role="banner">		
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
					
					<div class="sparklelogo sparkle-column">
						<?php do_action( 'sparklestore_pro_get_logo' ); ?>
					</div>

                    <div class="box-header-nav main-menu-wapper sparkle-column">
                        <div class="main-menu">
                            <div class="main-menu-links">
                                <?php
                                    wp_nav_menu(array(
                                        'menu_id' => 'primary-menu',
                                        'theme_location' => 'sparkleprimary',
                                        'container_class' => '',
                                        'container'       => '',
                                        'container_id'    => '',
                                        'menu_class' => 'main-menu',
                                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                        'walker' => new SparkleTheme_Custom_Nav_Walker()
                                    ));
                                ?>
                            </div>
                        </div>
                    </div>

				</div>
			</div>
		</div>
    </div>

    <div class="header-nav">
        <div class="container">
            <div class="header-nav-inner vertical-menu-disable-<?php echo sparklestore_header_vertical_enable_callback(); ?>">
                
                <?php do_action( 'sparklestore_header_vertical' ); ?>

                <div class="headertwo-search-cart-wrap sparkle-column">
                    <div class="header-control">
                        <?php
                            /**
                             * Advance & Normal Search
                             */
                            do_action( 'sparklestore_pro_woocommerce_product_search' );
                        ?>
                    </div>
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