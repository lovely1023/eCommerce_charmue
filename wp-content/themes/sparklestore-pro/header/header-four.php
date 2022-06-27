<header id="masthead" class="site-header headerfour" itemscope="itemscope" itemtype="http://schema.org/WPHeader" role="banner">		
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
					<div class="site-quick-info-wrap sparkle-column">
                        <i class="fas fa-headset"></i>
                        <?php
                            // Quick Information
							do_action('sparklestore_quick_information');
                        ?>
                    </div>

					<div class="sparklelogo">
						<?php do_action( 'sparklestore_pro_get_logo' ); ?>
                    </div>
                    
                    <div class="quick-search-wrapper sparkle-column">
                        <?php if( get_theme_mod('sparklestore_pro_header_user_options', 0) == 0): ?>
                            <div class="toggle-useraccount">
                                <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
                                    <i class="icofont-user-alt-3"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if( get_theme_mod('sparklestore_pro_header_search_options', 0) == 0): ?>
                        <div class="toggle-searchicon">
                            <i class="icofont-search"></i>
                        </div>
                        <?php endif; ?>

                        <?php
                            $header_minicart = get_theme_mod( 'sparklestore_pro_mini_cart_options', 'on' );
                                
                            if( !empty( $header_minicart ) && $header_minicart == 'on' ){

                                do_action( 'sparklestore_pro_woocommerce_header_cart' );
                            }
                        ?>
                    </div>
                    <?php if( get_theme_mod('sparklestore_pro_header_search_options', 0) == 0): ?>
                    <div class="header-control toggle-search">
                        <?php
                            /**
                             * Advance & Normal Search
                             */
                            do_action( 'sparklestore_pro_woocommerce_product_search' );
                        ?>
                    </div>
                    <?php endif; ?>
                </div>
			</div>
		</div>
    </div>

    <div class="header-nav">
        <div class="container">
            <div class="header-nav-inner">

                <?php do_action( 'sparklestore_header_vertical' ); ?>
                
                <?php do_action('sparklestore_pro_primary_menu'); ?>

            </div>
        </div>
    </div>
</header>