<div class="mobile-header-only">
    <div class="header-middle-inner header-middle-inner-mobile">
        <?php do_action('sparkletheme_menu_toggle'); ?>
        
        <div class="sparklelogo sparkle-column">
            <?php do_action( 'sparklestore_pro_get_logo' ); ?>
        </div>

        <?php
            $header_minicart = get_theme_mod( 'sparklestore_pro_mini_cart_options', 'on' );
                
            if( !empty( $header_minicart ) && $header_minicart == 'on' ){

                do_action( 'sparklestore_pro_woocommerce_header_cart' );
            }
        ?>
    </div>
    <div class="header-control sparkle-column">
        <?php
            /**
             * Advance & Normal Search
             */
            do_action( 'sparklestore_pro_woocommerce_product_search' );
        ?>
    </div>
</div>