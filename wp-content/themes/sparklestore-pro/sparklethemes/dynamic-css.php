<?php
/**
 * Dynamic css
*/
if ( ! function_exists( 'sparklestore_pro_dynamic_css' ) ) {
    function sparklestore_pro_dynamic_css() {
        
        $sparklestore_pro_colors = $sparklestore_pro_tablet_style = $sparklestore_pro_mobile_style = '';

        /**
         * primary color settigns
        */
        $theme_color     = sparklewp_get_theme_options('sparklestore_pro_primary_color', '#033772');
        $secondary_color = sparklewp_get_theme_options('sparklestore_pro_secondary_color', '#f33c3c');

        list($r, $g, $b) = array_map('hexdec', str_split(ltrim($secondary_color, '#'), 2));
        $secondary_color_rgb = "rgb(" . ($r - 50) . ", " . $g . ", " . $b .")";
        // exit;
        /**
         * primary color
         */
        // .box-header-nav .main-menu .page_item:hover > .children, 
        // .box-header-nav .main-menu .menu-item:hover > .sub-menu,
        // .box-header-nav .main-menu .sub-menu,
        //.box-header-nav .main-menu .children
        $sparklestore_pro_colors .= "
            .tab_styletwo .sparkletablinks li .btn-primary:hover, .tab_styletwo .sparkletablinks li.active a.btn-primary,
            .social ul li a,
            .btn-primary,
            #respond .form-submit input#submit:hover, .btn-primary:hover, .btn-primary:focus,
            .woocommerce div.product .woocommerce-tabs ul.tabs li,
            .sliderbtn-wrp .btn,
            .store_products_items_info.hoverstyletwo .products_item_info,
            .offer-style-2 .pcountdown-cnt-list-slider ul li > div,
            #respond .form-submit input#submit, a.button, button, input[type=\"submit\"],
            .chosen-container .chosen-results li.highlighted,
            .woocommerce div.product .woocommerce-tabs.nav-tabs-vertical ul.tabs li.active,
            .posts-tag ul li,
            
            
            .flex-control-nav > li > a:hover::before, 
            .flex-control-nav > li > a.flex-active::before,

            .tabsblockwrap.tab_stylethree,
            .product.product-category.category-style-4 .woocommerce-loop-category__title,

            .cat-hover2 .product.product-category .woocommerce-loop-category__title,
            
            .sp-section.widget .member-social li a,
            .header-nav{
                background-color: $theme_color;        
            }

            .cross-sells h2, .cart_totals h2, .up-sells > h2, .related > h2, .woocommerce-billing-fields h3, .woocommerce-shipping-fields h3, .woocommerce-additional-fields h3, #order_review_heading, .woocommerce-order-details h2, .woocommerce-column--billing-address h2, .woocommerce-column--shipping-address h2, .woocommerce-Address-title h3, .woocommerce-MyAccount-content h3, .wishlist-title h2, .comments-area h2.comments-title, .woocommerce-Reviews h2.woocommerce-Reviews-title, .woocommerce-Reviews #review_form_wrapper .comment-reply-title, .woocommerce-account .woocommerce h2, .woocommerce-customer-details h2.woocommerce-column__title, .widget .widget-title,
            .btn-primary,
            .woocommerce-tabs.nav-line .tab-panels,
            .woocommerce div.product .woocommerce-tabs ul.tabs::before,
            .woocommerce div.product .woocommerce-tabs ul.tabs li,
            .sp-section-title-single-row .section-title-wrapper .section-title-wrap,
            .sp-section-title-left-border .section-title-wrap .section-title::before,
            .sliderbtn-wrp .btn,

            .sp-section.widget .member-social li a,
            .social ul li a{
                border-color: $theme_color;
            }
            .woocommerce div.product .woocommerce-tabs.nav-tabs-vertical ul.tabs li.active::before{
                border-left-color: $theme_color; 
            }

            .sp-section.widget .member-social li a:hover,
            .social ul li a:hover{
                color: $theme_color;
            }
            
        ";

        /** secondary color */
        $sparklestore_pro_colors .= "
            .woocommerce a.added_to_cart, .woocommerce a.product_type_simple, .woocommerce a.button.add_to_cart_button, .woocommerce a.button.product_type_grouped, .woocommerce a.button.product_type_external, .woocommerce a.button.product_type_variable,
            .woocommerce a.added_to_cart::before, .woocommerce a.product_type_simple::before, .woocommerce a.button.add_to_cart_button::before, .woocommerce a.button.product_type_grouped::before, .woocommerce a.button.product_type_external::before, .woocommerce a.button.product_type_variable::before,
            .widget .woocommerce-mini-cart__buttons a.checkout:last-child,
            .woocommerce .widget_shopping_cart .cart_list li a.remove:hover, .woocommerce.widget_shopping_cart .cart_list li a.remove:hover,
            .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,
            .woocommerce a.remove:hover,
            .widget_search .search-submit,
            .calendar_wrap caption,
            .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,
            .woocommerce-MyAccount-navigation ul li a,
            .site-cart-items-wrap,
            .chosen-container .chosen-results li.result-selected,
            .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,
            .block-nav-category .block-title,
            .block-nav-category .view-all-category a,
            .block-nav-category .vertical-menu .page_item.current_page_item > a, .block-nav-category .vertical-menu li:hover > a, .block-nav-category .view-all-category a:hover,
            .arrow-top-line,
            .box-header-nav .main-menu .page_item.current_page_item > a, .box-header-nav .main-menu .page_item:hover > a, .box-header-nav .main-menu > .menu-item.current-menu-item > a, .box-header-nav .main-menu > .menu-item:hover > a,
            .box-header-nav .main-menu .children > .page_item:hover > a, .box-header-nav .main-menu .sub-menu > .menu-item:hover > a,
            .promo_block_area .promo-banner-img-inner:hover .promo-img-info .promo-img-info-inner h3,
            .owl-carousel:hover .owl-prev, .owl-carousel:hover .owl-next,
            .single-product div.product .entry-summary .single_add_to_cart_button,
            .single-product div.product .entry-summary .single_add_to_cart_button::before,
            .promosection .promoarea:hover .textwrap h2,
            .woocommerce ul.products li.product .store_products_items_info .products_item_info a:hover,
            .store_products_items_info .products_item_info a:hover,
            .widget.yith-woocompare-widget .compare, .widget.yith-woocompare-widget .clear-all,
            .widget_product_search button,
            .woocommerce ul li.product .store_products_items_info .products_item_info a:hover,
            .articlesListing .article .metainfo div::after,

            .display-product-style-1 .specialoffter-deal .pcountdown-cnt ul li,

            .wc-block-grid__product-add-to-cart .add_to_cart_button,
            .wc-block-grid__product-add-to-cart .add_to_cart_button::before,
            .wc-block-pagination-page.wc-block-components-pagination__page,

            .woocommerce .product-hover-style5 a.button,
            .woocommerce .product-hover-style5 a.button.add_to_cart_button::before,
            .woocommerce .product-hover-style5 a.button.product_type_external::before,
            .woocommerce .product-hover-style5 a.button.product_type_variable::before,
            .woocommerce .product-hover-style5 a.button.product_type_grouped::before,
            .woocommerce .product-hover-style5 a.product_type_simple::before, 
            .woocommerce .product-hover-style5 a.button.product_type_variable,
            .woocommerce .product-hover-style5 ul.products li.product a.button.add_to_cart_button,
            .woocommerce .product-hover-style5 ul.products li.product a.button.product_type_external,
            .woocommerce .product-hover-style5 a.button.product_type_grouped,
            .woocommerce .product-hover-style5 ul.products li.product a.button,
            .woocommerce .product-hover-style5 a.button.add_to_cart_button,
            .woocommerce .product-hover-style5 a.button.product_type_external,
            
            .woocommerce .jet-elements .store_products_item_details .store_products_items_info .products_item_info,

            .product-hover-style5 .store_products_items_info.hoverstyletwo .products_item_info,

            .site-cart-items-wrap,
            .flex-direction-nav li a,
            .reply .comment-reply-link,
            .page-numbers,
            .posts-tag ul li:first-child,
            .posts-tag ul li:hover,
            .block-search .btn-submit{
                background-color: $secondary_color;
            }
            #back-to-top svg.progress-circle path{
                stroke: $secondary_color;
            }

            .wc-block-grid__product-add-to-cart .add_to_cart_button,
            .wc-block-grid__product-add-to-cart .add_to_cart_button::before,
            .wc-block-pagination-page,

            .page-numbers,
            .page-numbers:hover,
            .widget.yith-woocompare-widget .compare, .widget.yith-woocompare-widget .clear-all,
            .widget.yith-woocompare-widget .compare:hover, .widget.yith-woocompare-widget .clear-all:hover,
            .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,
            .woocommerce nav.woocommerce-pagination ul li,
            .woocommerce-MyAccount-navigation ul li a:hover,
            .footer-widgets .widget .widget-title::before,
            .single-product div.product .entry-summary .single_add_to_cart_button,
            .woocommerce a.added_to_cart, .woocommerce a.product_type_simple, .woocommerce a.button.add_to_cart_button,
            .woocommerce a.button.product_type_grouped, .woocommerce a.button.product_type_external, .woocommerce a.button.product_type_variable,
            
            .woocommerce .product-hover-style5 a.button,
            .woocommerce .product-hover-style5 a.button.add_to_cart_button::before,
            .woocommerce .product-hover-style5 a.button.product_type_external::before,
            .woocommerce .product-hover-style5 a.button.product_type_variable::before,
            .woocommerce .product-hover-style5 a.button.product_type_grouped::before,
            .woocommerce .product-hover-style5 a.button.product_type_variable,
            .woocommerce .product-hover-style5 ul.products li.product a.button.add_to_cart_button,
            .woocommerce .product-hover-style5 ul.products li.product a.button.product_type_external,
            .woocommerce .product-hover-style5 a.button.product_type_grouped,
            .woocommerce .product-hover-style5 ul.products li.product a.button,
            .woocommerce .product-hover-style5 a.button.add_to_cart_button,
            .woocommerce .product-hover-style5 a.button.product_type_external,

            .jet-elements .woocommerce a.added_to_cart, 
            .jet-elements .woocommerce a.product_type_simple, 
            .jet-elements .woocommerce a.button.add_to_cart_button, 
            .jet-elements .woocommerce a.button.product_type_grouped, .woocommerce a.button.product_type_external, 
            .jet-elements .woocommerce a.button.product_type_variable,
            
            .site-cart-items-wrap,
            .flex-direction-nav li a,
            .woocommerce a.button.product_type_external, .woocommerce a.button.product_type_variable{
                border-color: $secondary_color;
            }


            .woocommerce-message::before, .woocommerce-info::before,
            .woocommerce-MyAccount-content a,
            .woocommerce nav.woocommerce-pagination ul li .page-numbers,
            .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,
            .woocommerce-MyAccount-navigation ul li a:hover,
            .woocommerce-MyAccount-navigation ul li:hover::before,
            .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,
            .woocommerce .product_list_widget .woocommerce-Price-amount,
            .woocommerce .product_list_widget ins .woocommerce-Price-amount,
            .arrow-top,
            .single-product div.product .entry-summary a.compare:hover,
            a:hover, a:focus, a:active,
            .footer_menu ul li a:hover,
            .sub-footer .coppyright a,
            .top-footer-area ul li a:hover, .top-footer-area a:hover,
            .single-product div.product .entry-summary .single_add_to_cart_button:hover,
            .woocommerce .woocommerce-breadcrumb a,
            .breadcrumbs .trail-items li a,
            .display-product-style-3 .pcountdown-cnt ul li > div span:first-of-type,
            
            .headerfour .header-middle .site-cart-items-wrap:hover,
            .headerfour .quick-search-wrapper i:hover,
            .headerthree .quick-search-wrapper i:hover,
            .headerthree .header-middle .site-cart-items-wrap:hover, .toggle-searchicon:hover, 
            .toggle-searchicon:hover,
            .wc-block-pagination-page--active.wc-block-components-pagination__page--active,
            #cancel-comment-reply-link,
            .page-numbers:hover,
            .page-numbers.current,
            .widget.yith-woocompare-widget .compare:hover, .widget.yith-woocompare-widget .clear-all:hover,
            .footer-widgets .widget_top_rated_products .product_list_widget .product-title:hover, .footer-widgets .widget a:hover, .footer-widgets .widget a:hover::before, .footer-widgets .widget li:hover::before,
            .woocommerce a.added_to_cart:hover, .woocommerce a.product_type_simple:hover, .woocommerce a.button.add_to_cart_button:hover, .woocommerce a.button.product_type_grouped:hover, .woocommerce a.button.product_type_external:hover, .woocommerce a.button.product_type_variable:hover{
                color: $secondary_color;
            }
            
            .woocommerce-message, .woocommerce-info{
                border-top-color: $secondary_color;
            }

            .headerfive .site-cart-items-wrap:hover, .headerfive .quick-search-wrapper i:hover{
                color: $secondary_color_rgb;
            }
        ";

        
        /* Preloader CSS */
        $preloader_color    = esc_attr(sparklewp_get_theme_options('sparkle_store_pro_preloader_color', '#000000'));
        $preloader_bg_color = esc_attr(sparklewp_get_theme_options('sparkle_store_pro_preloader_bg_color', '#FFFFFF'));
    
        $sparklestore_pro_colors .= "
            .sparklestore-preloader{
                color: $preloader_color;
                background-color: $preloader_bg_color;
            }
            .ball-pulse-sync>div, 
            .ball-pulse>div, 
            .ball-scale-random>div, 
            .ball-scale>div,
            .ball-grid-beat>div, 
            .ball-grid-pulse>div, 
            .ball-pulse-rise>div,
            .total-spin>div,
            .ball-rotate>div,
            .ball-rotate>div:before, 
            .ball-rotate>div:after,
            .cube-transition>div,
            .ball-zig-zag>div,
            .line-scale>div,
            .ball-scale-multiple>div,
            .line-scale-pulse-out>div,
            .ball-spin-fade-loader>div,
            .pacman>div:nth-child(3), 
            .pacman>div:nth-child(4), 
            .pacman>div:nth-child(5), 
            .pacman>div:nth-child(6){
                background: $preloader_color !important;
            }
                
            .ball-clip-rotate>div,
            .ball-clip-rotate-multiple>div,
            .ball-scale-ripple-multiple>div,
            .pacman>div:first-of-type,
            .pacman>div:nth-child(2){
                border-color:$preloader_color !important;
            }";
        
        
        /** top header notice section */
        
        $bg_color       = sparklewp_get_theme_options('sparklestore_pro_top_notice_bar_section_bg_color', '#003772');
        $bg_text_color  = sparklewp_get_theme_options('sparklestore_pro_top_notice_bar_section_text_color', '#fff'); 
        $bg_hover_color = sparklewp_get_theme_options('sparklestore_pro_top_notice_bar_section_hover_color', '#f33c3c'); 
        $sparklestore_pro_colors .="
            .top-notice-bar{
                background-color: $bg_color;
            }
            .noticeclose,
            .notice-bar, .header-container .acme-news-ticker-box ul li a{
                color: $bg_text_color;
            }
            .noticeclose a:hover,
            .notice-bar a:hover{
                color: $bg_hover_color;
            }
        ";
    
        /** vertical menu */
        $title_bg_color         = sparklewp_get_theme_options('sparklestore_vertical_menu_title_bg_color'); //f33c3c
        $title_text_color       = sparklewp_get_theme_options('sparklestore_vertical_menu_title_text_color','#ffffff');
        $menu_bg_color          = sparklewp_get_theme_options('sparklestore_vertical_menu_bg_color', '#ffffff');
        $menu_text_color        = sparklewp_get_theme_options('sparklestore_vertical_menu_item_text_color', '#232529');
        $item_hover_color       = sparklewp_get_theme_options('sparklestore_vertical_menu_item_hover_color','#ffffff');
        $item_hover_bg_color    = sparklewp_get_theme_options('sparklestore_vertical_menu_item_hover_bg_color'); // f33c3c
        
        $sparklestore_pro_colors .= "
        .block-nav-category .view-all-category a,
        .block-nav-category .block-title{
            background-color: $title_bg_color; 
            color: $title_text_color;
        }
        .block-nav-category .vertical-menu .children,
        .block-nav-category .vertical-menu .sub-menu,
        .block-nav-category .block-content{
            background-color: $menu_bg_color;
            color: $menu_text_color;
        }
        .block-nav-category .vertical-menu .page_item.current_page_item > a, 
        .block-nav-category .vertical-menu li:hover > a, 
        .block-nav-category .view-all-category a:hover{
            background-color: $item_hover_bg_color;
            color: $item_hover_color;
        }
        ";
        
        /** primary menu */
        $header_style = $header_tablet_style =  $header_mobile_style = "";
        $menu_bg_color = sparklewp_get_theme_options('sparklestore_main_menu_bg_color'); //'#003772'
        if($menu_bg_color){
            $header_style .= 'background-color:' . $menu_bg_color . ';';
        }
        
        //margin
        $menu_margin = sparklewp_get_theme_options( 'primary-menu-margin' );
        $menu_margin = json_decode( $menu_margin, true );
        
        // desktop margin
        $menu_margin_desktop = sparklewp_cssbox_values_inline( $menu_margin, 'desktop' );
        if ( strpos( $menu_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'margin:' . $menu_margin_desktop . ';';
        }
        // tablet margin
        $menu_margin_desktop = sparklewp_cssbox_values_inline( $menu_margin, 'tablet' );
        if ( strpos( $menu_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'margin:' . $menu_margin_desktop . ';';
        }
        // mobile margin
        $menu_margin_desktop = sparklewp_cssbox_values_inline( $menu_margin, 'mobile' );
        if ( strpos( $menu_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'margin:' . $menu_margin_desktop . ';';
        }


        //padding
        $header_nav_padding = sparklewp_get_theme_options( 'primary-menu-padding' );
        $header_nav_padding = json_decode( $header_nav_padding, true );
        
        // desktop padding
        $header_nav_padding_desktop = sparklewp_cssbox_values_inline( $header_nav_padding, 'desktop' );
        if ( strpos( $header_nav_padding_desktop, 'px' ) !== false ) {
            $header_style .= 'padding:' . $header_nav_padding_desktop . ';';
        }

        // tablet padding
        $header_nav_padding_desktop = sparklewp_cssbox_values_inline( $header_nav_padding, 'tablet' );
        if ( strpos( $header_nav_padding_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'padding:' . $header_nav_padding_desktop . ';';
        }
        // mobile padding
        $header_nav_padding_desktop = sparklewp_cssbox_values_inline( $header_nav_padding, 'mobile' );
        if ( strpos( $header_nav_padding_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'padding:' . $header_nav_padding_desktop . ';';
        }


        if($header_style){
            $sparklestore_pro_colors .="
            .box-header-nav.main-menu-wapper{
                $header_style
            }";
        }
        if($header_tablet_style){
            $sparklestore_pro_tablet_style .="
                .box-header-nav.main-menu-wapper{
                    $header_tablet_style
                }
            ";
        }
        if($header_mobile_style){
            $sparklestore_pro_mobile_style .="
                .box-header-nav.main-menu-wapper{
                    $header_mobile_style
                }
            ";
        }
        //menu item margin padding
        //.box-header-nav .main-menu .page_item a, .box-header-nav .main-menu > .menu-item > a
        $header_style = $header_tablet_style =  $header_mobile_style = "";
        //margin
        $menu_margin = sparklewp_get_theme_options( 'primary-menu-item-margin' );
        $menu_margin = json_decode( $menu_margin, true );
        
        // desktop margin
        $menu_margin_desktop = sparklewp_cssbox_values_inline( $menu_margin, 'desktop' );
        if ( strpos( $menu_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'margin:' . $menu_margin_desktop . ';';
        }
        // tablet margin
        $menu_margin_desktop = sparklewp_cssbox_values_inline( $menu_margin, 'tablet' );
        if ( strpos( $menu_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'margin:' . $menu_margin_desktop . ';';
        }
        // mobile margin
        $menu_margin_desktop = sparklewp_cssbox_values_inline( $menu_margin, 'mobile' );
        if ( strpos( $menu_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'margin:' . $menu_margin_desktop . ';';
        }


        //padding
        $header_nav_padding = sparklewp_get_theme_options( 'primary-menu-item-padding' );
        $header_nav_padding = json_decode( $header_nav_padding, true );
        
        // desktop padding
        $header_nav_padding_desktop = sparklewp_cssbox_values_inline( $header_nav_padding, 'desktop' );
        if ( strpos( $header_nav_padding_desktop, 'px' ) !== false ) {
            $header_style .= 'padding:' . $header_nav_padding_desktop . ';';
        }

        // tablet padding
        $header_nav_padding_desktop = sparklewp_cssbox_values_inline( $header_nav_padding, 'tablet' );
        if ( strpos( $header_nav_padding_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'padding:' . $header_nav_padding_desktop . ';';
        }
        // mobile padding
        $header_nav_padding_desktop = sparklewp_cssbox_values_inline( $header_nav_padding, 'mobile' );
        if ( strpos( $header_nav_padding_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'padding:' . $header_nav_padding_desktop . ';';
        }


        if($header_style){
            $sparklestore_pro_colors .="
            .box-header-nav .main-menu .page_item a, .box-header-nav .main-menu > .menu-item > a{
                $header_style
            }";
        }
        if($header_tablet_style){
            $sparklestore_pro_tablet_style .="
                .box-header-nav .main-menu .page_item a, .box-header-nav .main-menu > .menu-item > a{
                    $header_tablet_style
                }
            ";
        }
        if($header_mobile_style){
            $sparklestore_pro_mobile_style .="
                .box-header-nav .main-menu .page_item a, .box-header-nav .main-menu > .menu-item > a{
                    $header_mobile_style
                }
            ";
        }

        
        $menu_text_color = sparklewp_get_theme_options('sparklestore_main_menu_item_color'); //'#fff'

        $active_bg_color = sparklewp_get_theme_options('sparklestore_main_menu_active_bg_color'); //f33c3c
        $active_text_color = sparklewp_get_theme_options('sparklestore_main_menu_active_item_color', '#fff');

        $sub_menu_bg = sparklewp_get_theme_options('sparklestore_pro_main_sub_menu_bg_color'); //, '#003772'
        $sub_menu_text = sparklewp_get_theme_options('sparklestore_pro_main_sub_menu_text_color', '#fff');

        $sub_menu_hover_bg = sparklewp_get_theme_options('sparklestore_pro_main_sub_menu_hover_bg_color'); //, '#003772'
        $sub_menu_hover_text = sparklewp_get_theme_options('sparklestore_pro_main_sub_menu_hover_text_color', '#fff');
        

        $sparklestore_pro_colors .="
            .box-header-nav .main-menu .page_item a,
            .box-header-nav .main-menu > .menu-item > a,
            
            .headertwo .box-header-nav .main-menu .page_item a, 
            .headertwo .box-header-nav .main-menu > .menu-item > a,

            .headerthree .box-header-nav .main-menu .page_item a, 
            .headerthree .box-header-nav .main-menu > .menu-item > a,

            .headerfive .quick-search-wrapper a i,
            .headerfive .toggle-searchicon i,
            .headerfive .header-nav .site-cart-items-wrap
            
            {
                color : $menu_text_color;
            }

            .box-header-nav .main-menu .page_item.current_page_item > a, 
            .box-header-nav .main-menu .page_item:hover > a, 
            .box-header-nav .main-menu > .menu-item.current-menu-item > a, 
            .box-header-nav .main-menu > .menu-item:hover > a{
                background-color: $active_bg_color;
                color: $active_text_color;
            }

            .box-header-nav .main-menu .sub-menu > .menu-item > a,
            .box-header-nav .main-menu .page_item.focus > .children, 
            .box-header-nav .main-menu .menu-item.focus > .sub-menu,
            .box-header-nav .main-menu .page_item:hover > .children, 
            .box-header-nav .main-menu .menu-item:hover > .sub-menu{
                background-color: $sub_menu_bg;
                color: $sub_menu_text;
            }

            .box-header-nav .main-menu .children > .page_item:hover > a, 
            .box-header-nav .main-menu .sub-menu > .menu-item:hover > a,
            .box-header-nav .main-menu .children > .page_item.current_page_item > a, 
            .box-header-nav .main-menu .children > .page_item:hover > a, 
            .box-header-nav .main-menu .sub-menu > .menu-item.current-menu-item > a, 
            .box-header-nav .main-menu .sub-menu > .menu-item:hover > a{
                background-color: $sub_menu_hover_bg;
                color: $sub_menu_hover_text;
            }
        ";

        /** submenu margin padding */
        $header_style = $header_tablet_style =  $header_mobile_style = "";
        //margin
        $menu_margin = sparklewp_get_theme_options( 'primary-menu-sub-menu-item-margin' );
        $menu_margin = json_decode( $menu_margin, true );
        
        // desktop margin
        $menu_margin_desktop = sparklewp_cssbox_values_inline( $menu_margin, 'desktop' );
        if ( strpos( $menu_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'margin:' . $menu_margin_desktop . ';';
        }
        // tablet margin
        $menu_margin_desktop = sparklewp_cssbox_values_inline( $menu_margin, 'tablet' );
        if ( strpos( $menu_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'margin:' . $menu_margin_desktop . ';';
        }
        // mobile margin
        $menu_margin_desktop = sparklewp_cssbox_values_inline( $menu_margin, 'mobile' );
        if ( strpos( $menu_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'margin:' . $menu_margin_desktop . ';';
        }


        //padding
        $header_nav_padding = sparklewp_get_theme_options( 'primary-menu-sub-menu-item-padding' );
        $header_nav_padding = json_decode( $header_nav_padding, true );
        
        // desktop padding
        $header_nav_padding_desktop = sparklewp_cssbox_values_inline( $header_nav_padding, 'desktop' );
        if ( strpos( $header_nav_padding_desktop, 'px' ) !== false ) {
            $header_style .= 'padding:' . $header_nav_padding_desktop . ';';
        }

        // tablet padding
        $header_nav_padding_desktop = sparklewp_cssbox_values_inline( $header_nav_padding, 'tablet' );
        if ( strpos( $header_nav_padding_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'padding:' . $header_nav_padding_desktop . ';';
        }
        // mobile padding
        $header_nav_padding_desktop = sparklewp_cssbox_values_inline( $header_nav_padding, 'mobile' );
        if ( strpos( $header_nav_padding_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'padding:' . $header_nav_padding_desktop . ';';
        }


        if($header_style){
            $sparklestore_pro_colors .="
            .box-header-nav .main-menu .children > .page_item > a, .box-header-nav .main-menu .sub-menu > .menu-item > a{
               $header_style
            }";
        }
        if($header_tablet_style){
            $sparklestore_pro_tablet_style .="
            .box-header-nav .main-menu .children > .page_item > a, .box-header-nav .main-menu .sub-menu > .menu-item > a{
                    $header_tablet_style
                }
            ";
        }
        if($header_mobile_style){
            $sparklestore_pro_mobile_style .="
            .box-header-nav .main-menu .children > .page_item > a, .box-header-nav .main-menu .sub-menu > .menu-item > a{
                    $header_mobile_style
                }
            ";
        }



        /** breadcrumb color */
        $page_overwrite_defaults = '';
        if (is_singular(array('post', 'page', 'product', 'portfolio'))) {
            $page_overwrite_defaults = rwmb_meta('page_overwrite_defaults');
        }

        $breadcrumbs_enable = sparklewp_get_theme_options('sparklestore_pro_normal_page_enable_disable_section', 'on');
        if (!$page_overwrite_defaults && $breadcrumbs_enable == 'on') {
            $title_color                    = sparklewp_get_theme_options('sparklestore_pro_breadcrumb_title_color'); //232529
            $breadcumb_text_color           = sparklewp_get_theme_options('sparklestore_pro_breadcrumb_text_color'); //232529
            $breadcumb_anch_color           = sparklewp_get_theme_options('sparklestore_pro_breadcrumb_anchor_color');// f33c3c
            $breadcumb_anch_hover_color     = sparklewp_get_theme_options('sparklestore_pro_breadcrumb_hover_color'); //232529

            $header_style = $header_tablet_style =  $breadcrum_mobile_style = "";
            //padding
            $breadcrumb_padding = sparklewp_get_theme_options( 'sparklestore_pro_breadcrumb_padding' );
            $breadcrumb_padding = json_decode( $breadcrumb_padding, true );
            
            // desktop padding
            $breadcrumb_padding_desktop = sparklewp_cssbox_values_inline( $breadcrumb_padding, 'desktop' );
            if ( strpos( $breadcrumb_padding_desktop, 'px' ) !== false ) {
                $header_style .= 'padding:' . $breadcrumb_padding_desktop . ';';
            }

            // tablet padding
            $breadcrumb_padding_desktop = sparklewp_cssbox_values_inline( $breadcrumb_padding, 'tablet' );
            if ( strpos( $breadcrumb_padding_desktop, 'px' ) !== false ) {
                $header_tablet_style .= 'padding:' . $breadcrumb_padding_desktop . ';';
            }
            // mobile padding
            $breadcrumb_padding_desktop = sparklewp_cssbox_values_inline( $breadcrumb_padding, 'mobile' );
            if ( strpos( $breadcrumb_padding_desktop, 'px' ) !== false ) {
                $breadcrum_mobile_style .= 'padding:' . $breadcrumb_padding_desktop . ';';
            }

            //margin
            $breadcrum_margin = sparklewp_get_theme_options( 'sparklestore_pro_breadcrumb_margin' );
            $breadcrum_margin = json_decode( $breadcrum_margin, true );
            
            // desktop margin
            $breadcrum_margin_desktop = sparklewp_cssbox_values_inline( $breadcrum_margin, 'desktop' );
            if ( strpos( $breadcrum_margin_desktop, 'px' ) !== false ) {
                $header_style .= 'margin:' . $breadcrum_margin_desktop . ';';
            }

            // tablet margin
            $breadcrum_margin_desktop = sparklewp_cssbox_values_inline( $breadcrum_margin, 'tablet' );
            if ( strpos( $breadcrum_margin_desktop, 'px' ) !== false ) {
                $header_tablet_style .= 'margin:' . $breadcrum_margin_desktop . ';';
            }
            // mobile margin
            $breadcrum_margin_desktop = sparklewp_cssbox_values_inline( $breadcrum_margin, 'mobile' );
            if ( strpos( $breadcrum_margin_desktop, 'px' ) !== false ) {
                $breadcrum_mobile_style .= 'margin:' . $breadcrum_margin_desktop . ';';
            }
            if($header_style){
                $sparklestore_pro_colors .= "
                    .breadcrumbs-wrap{
                        $header_style
                    }
                ";
            }
            
            if( $header_tablet_style ){
                $sparklestore_pro_tablet_style .= "
                    .breadcrumbs-wrap{
                        $header_tablet_style
                    }
                ";
            }

            if( $breadcrum_mobile_style ){
                $sparklestore_pro_mobile_style .= "
                    .breadcrumbs-wrap{
                        $breadcrum_mobile_style
                    }
                ";
            }

            //overlay color 
            $overlay_color = sparklewp_get_theme_options('sparklestore_pro_breadcrumbs_normal_page_overlay_color');
            if( $overlay_color ){
                $sparklestore_pro_colors .= "
                .breadcrumbs-wrap-overlay:before {
                    content: '';
                    background: $overlay_color;
                    height: 100%;
                    width: 100%;
                    position: absolute;
                    top: 0;
                    left:0;
                    right:0;
                    z-index:0;
                  }
                ";
            }

            


            if($title_color ){
                $sparklestore_pro_colors .= "
                .breadcrumbs-wrap h2,
                .breadcrumbs-wrap.withimage h2{
                    color :$title_color;
                }
                ";    
            }

            if($breadcumb_text_color){
                $sparklestore_pro_colors .= "
                .breadcrumbs-wrap.woocommerce .sparkle-products-nav a,
                .breadcrumbs-wrap .breadcrumbs .trail-items li{
                    color : $breadcumb_text_color;
                }
                .breadcrumbs-wrap.woocommerce .sparkle-products-nav .sparkle-back-btn svg{ fill: $breadcumb_text_color; }
                "; 
            }
            if( $breadcumb_anch_color ){
                $sparklestore_pro_colors .= "
                .breadcrumbs .trail-items li a{
                    color : $breadcumb_anch_color;
                }
                ";    
            }

            if( $breadcumb_anch_hover_color ){
                $sparklestore_pro_colors .= "
                    .breadcrumbs-wrap.woocommerce .sparkle-products-nav a:hover,
                    .breadcrumbs-wrap .breadcrumbs .trail-items li a:hover,
                    .breadcrumbs .trail-items li a:hover{
                        color : $breadcumb_anch_hover_color;
                    }
                    .breadcrumbs-wrap.woocommerce .sparkle-products-nav .sparkle-back-btn:hover svg{ fill: $breadcumb_anch_hover_color; }
                ";
            }

            

            $bg_type = sparklewp_get_theme_options('sparklestore_pro_breadcrumbs_normal_page_bg_type', 'color-bg');
            if( $bg_type == 'color-bg'){
                $bg_color = sparklewp_get_theme_options('sparklestore_pro_breadcrumbs_normal_page_bg_color', '#033772');
                $sparklestore_pro_colors .= ".breadcrumbs-wrap{background-color: $bg_color;}";

            } elseif( $bg_type == 'gradient-bg' ){
                $breadcumb_color = sparklewp_get_theme_options('sparklestore_pro_breadcrumbs_normal_page_bg_gradient');
                if( $breadcumb_color){
                    $css[] = "$breadcumb_color";
                    $sparklestore_pro_colors .= ".breadcrumbs-wrap{" . implode(';', $css) . "}";
                }
            }else if($bg_type == 'image-bg'){
                $image          = sparklewp_get_theme_options('sparklestore_pro_breadcrumbs_normal_page_background_image');
                $image_repeat   = sparklewp_get_theme_options('sparklestore_pro_breadcrumbs_normal_page_background_image_repeat');
                $image_size     = sparklewp_get_theme_options('sparklestore_pro_breadcrumbs_normal_page_background_image_size', 'cover');
                $image_position = sparklewp_get_theme_options('sparklestore_pro_breadcrumbs_normal_page_background_image_position');
                $image_attach   = sparklewp_get_theme_options('sparklestore_pro_breadcrumbs_normal_page_background_image_attach');

                $sparklestore_pro_colors .= ".breadcrumbs-wrap{
                    background-image: url($image);
                    background-size: $image_size;
                    background-position: $image_position;
                    background-attachment: $image_attach;    
                }";

                $overlay = sparklewp_get_theme_options('sparklestore_pro_breadcrumbs_normal_page_background_overlay');
                if($overlay){
                    $sparklestore_pro_colors .="
                        .breadcrumbs-wrap::before{
                            background-color: $overlay;
                        }";
                }
            }
        }else{
            $titlebar_background = rwmb_meta('titlebar_background');
            
            $titlebar_padding = rwmb_meta('titlebar_padding');
            
            $title_color                    = rwmb_meta('titlebar_color');
            $breadcumb_text_color           = rwmb_meta('titlebar_text_color');
            $breadcumb_anch_color           = rwmb_meta('titlebar_link_color');
            $breadcumb_anch_hover_color     = sparklewp_get_theme_options('sparklestore_pro_breadcrumb_hover_color', '#232529');

            $padding = rwmb_meta('titlebar_padding');
            $padding_tablet = rwmb_meta('titlebar_padding');
            $padding_mobile = rwmb_meta('titlebar_padding');

            $margin = rwmb_meta('titlebar_margin');
            $margin_tablet = rwmb_meta('titlebar_margin');
            $margin_mobile = rwmb_meta('titlebar_margin');

            $sparklestore_pro_colors .= "
                .breadcrumbs-wrap h2,
                .breadcrumbs-wrap h2{
                    color :$title_color;
                }
                .breadcrumbs-wrap.woocommerce .sparkle-products-nav a,
                .breadcrumbs-wrap .breadcrumbs .trail-items li{
                    color : $breadcumb_text_color;
                }
                .breadcrumbs-wrap.woocommerce .sparkle-products-nav .sparkle-back-btn svg{ fill: $breadcumb_text_color; }

                .breadcrumbs .trail-items li a{
                    color : $breadcumb_anch_color;
                }
                .breadcrumbs-wrap .breadcrumbs .trail-items li a:hover,
                .breadcrumbs .trail-items li a:hover{
                    color : $breadcumb_anch_hover_color;
                }
                
            ";

            if( $padding || $margin ){
                $sparklestore_pro_colors .= "
                    .breadcrumbs-wrap{
                        padding-top: {$padding}px;
                        padding-bottom: {$padding}px;
                        margin-top: {$margin}px;
                        margin-bottom: {$margin}px;
                    }
                ";
            }
            if( $padding_tablet || $margin_tablet ){
                $sparklestore_pro_tablet_style .= "
                    .breadcrumbs-wrap{
                        padding-top: {$padding_tablet}px;
                        padding-bottom: {$padding_tablet}px;

                        margin-top: {$margin_tablet}px;
                        margin-bottom: {$margin_tablet}px;
                    }
                ";
            }

            if( $padding_mobile || $margin_mobile ){
                $sparklestore_pro_mobile_style .= "
                    .breadcrumbs-wrap{
                        padding-top: {$padding_mobile}px;
                        padding-bottom: {$padding_mobile}px;

                        margin-top: {$margin_mobile}px;
                        margin-bottom: {$margin_mobile}px;
                    }
                ";
            }


            $titlebar_background = rwmb_meta('titlebar_background');
            if ($titlebar_background) {
                $titlebar_bg_image = isset($titlebar_background['titlebar_bg_image']) ? $titlebar_background['titlebar_bg_image'] : '';
                $titlebar_bg_color = isset($titlebar_background['titlebar_bg_color']) ? $titlebar_background['titlebar_bg_color'] : '';
                $titlebar_bg_repeat = isset($titlebar_background['titlebar_bg_repeat']) ? $titlebar_background['titlebar_bg_repeat'] : '';
                $titlebar_bg_size = isset($titlebar_background['titlebar_bg_size']) ? $titlebar_background['titlebar_bg_size'] : '';
                $titlebar_bg_attachment = isset($titlebar_background['titlebar_bg_attachment']) ? $titlebar_background['titlebar_bg_attachment'] : '';
                $titlebar_bg_position = isset($titlebar_background['titlebar_bg_position']) ? $titlebar_background['titlebar_bg_position'] : '';
                $titlebar_overlay_bg_color = isset($titlebar_background['overlay_bg_color']) ? $titlebar_background['overlay_bg_color'] : '';
    
                $sparklestore_pro_colors .= ".breadcrumbs-wrap{";
    
                if ($titlebar_bg_image) {
    
                    $image = wp_get_attachment_image_src($titlebar_bg_image[0], 'full');
                    $sparklestore_pro_colors .= "background-image: url($image[0]);";
    
                    if ($titlebar_bg_repeat) {
                        $sparklestore_pro_colors .= "background-repeat: $titlebar_bg_repeat;";
                    }
    
                    if ($titlebar_bg_attachment) {
                        $sparklestore_pro_colors .= "background-attachment: $titlebar_bg_attachment;";
                    }
    
                    if ($titlebar_bg_position) {
                        $sparklestore_pro_colors .= "background-position: $titlebar_bg_position;";
                    }
    
                    if ($titlebar_bg_size) {
                        $sparklestore_pro_colors .= "background-size: $titlebar_bg_size;";
                    }
                }
    
                if ($titlebar_bg_color) {
                    $sparklestore_pro_colors .= "background-color: $titlebar_bg_color;";
                }
    
                $sparklestore_pro_colors .= "}";
    
                if ($titlebar_bg_image && $titlebar_overlay_bg_color) {
                    $sparklestore_pro_colors .= "
                    .breadcrumbs-wrap:before{
                            background-color: $titlebar_overlay_bg_color;
                        }";
                }
            }
        }

        /** slider section */
        $overlay = sparklewp_get_theme_options('sparklestore_pro_slider_bg_overlay_color', 'rgba(255,255,255,0)');
        if( $overlay ){
            $sparklestore_pro_colors .= "
                .sparklestore-slider .slides li:before,
                .header-banner::before {
                    height: 100%;
                    content: '';
                    position: absolute;
                    width: 100%;
                    background-color: $overlay;
                }
            ";
        }
        $sparklestore_pro_caption_title_color = sparklewp_get_theme_options('sparklestore_pro_caption_title_color');
        $sparklestore_pro_caption_subtitle_color = sparklewp_get_theme_options('sparklestore_pro_caption_subtitle_color');

        $btn_bg_color       = sparklewp_get_theme_options('sparklestore_pro_caption_button_bg_color'); //'#003772'
        $btn_border_color   = sparklewp_get_theme_options('sparklestore_pro_caption_button_border_color'); //003772
        $btn_text_color     = sparklewp_get_theme_options('sparklestore_pro_caption_button_text_color'); //fff
        $btn_hov_bg_color     = sparklewp_get_theme_options('sparklestore_pro_caption_button_bg_hov_color'); //fff
        $btn_border_hov_color = sparklewp_get_theme_options('sparklestore_pro_caption_button_border_hov_color'); //fff
        $btn_hover_text_color = sparklewp_get_theme_options('sparklestore_pro_caption_button_text_hov_color'); //003772

        if( $sparklestore_pro_caption_title_color || $sparklestore_pro_caption_subtitle_color || $btn_bg_color || $btn_border_color || $btn_text_color || $btn_hov_bg_color || $btn_border_hov_color || $btn_hover_text_color ) {
            $sparklestore_pro_colors .= "
            .sparklestore-caption h2{
                color : $sparklestore_pro_caption_title_color;
            }
            .sparklestore-caption p{
                color: $sparklestore_pro_caption_subtitle_color;
            }
            .sliderbtn-wrp .btn{
                background-color: $btn_bg_color;
                color: $btn_text_color;
                border-color: $btn_border_color;
            }

            .sliderbtn-wrp .btn:hover{
                background-color: $btn_hov_bg_color;
                color: $btn_hover_text_color;
                border-color: $btn_border_hov_color;
            }
            ";
        }

        /** slider bottom seprator */
        $slider_bs_color = sparklewp_get_theme_options('sparklestore_pro_slider_bs_color');
        $slider_bs_height = sparklewp_get_theme_options('sparklestore_pro_slider_bs_height');
        $slider_bs_height_tablet = sparklewp_get_theme_options('sparklestore_pro_slider_bs_height_tablet');
        $slider_bs_height_mobile = sparklewp_get_theme_options('sparklestore_pro_slider_bs_height_mobile');

        if( $slider_bs_color || $slider_bs_height ){
            $sparklestore_pro_colors .= "
            .sp-normal-slider .svg-seperator svg{
                height: $slider_bs_height;
                fill: $slider_bs_color;
            }
            ";
        }

        if( $slider_bs_color || $slider_bs_height ){
            $sparklestore_pro_colors .= "
            .sp-normal-slider .svg-seperator svg{
                height: {$slider_bs_height}px;
                fill: $slider_bs_color;
            }
            ";
        }
        if( $slider_bs_height_tablet ){
            $sparklestore_pro_tablet_style .= "
            .sp-normal-slider .svg-seperator svg{
                height: {$slider_bs_height_tablet}px;
            }
            ";
        }
        if( $slider_bs_height_mobile ){
            $sparklestore_pro_mobile_style .= "
            .sp-normal-slider .svg-seperator svg{
                height: {$slider_bs_height_mobile}px;
            }
            ";
        }
        
        //slider margin padding
        $slider_style = $slider_tablet_style =  $slider_mobile_style = $color= "";
        //padding
        $slider_padding = sparklewp_get_theme_options( 'sparklestore_pro_slider_padding' );
        $slider_padding = json_decode( $slider_padding, true );
        
        // desktop padding
        $slider_padding_desktop = sparklewp_cssbox_values_inline( $slider_padding, 'desktop' );
        if ( strpos( $slider_padding_desktop, 'px' ) !== false ) {
            $slider_style .= 'padding:' . $slider_padding_desktop . ';';
        }

        // tablet padding
        $slider_padding_desktop = sparklewp_cssbox_values_inline( $slider_padding, 'tablet' );
        if ( strpos( $slider_padding_desktop, 'px' ) !== false ) {
            $slider_tablet_style .= 'padding:' . $slider_padding_desktop . ';';
        }
        // mobile padding
        $slider_padding_desktop = sparklewp_cssbox_values_inline( $slider_padding, 'mobile' );
        if ( strpos( $slider_padding_desktop, 'px' ) !== false ) {
            $slider_mobile_style .= 'padding:' . $slider_padding_desktop . ';';
        }

        $sparklestore_pro_colors .= "
            .fullwidth .banner-height.video-banner .banneritem-caption, 
            .boxed .banner-height.video-banner .banneritem-caption,
            .slider-caption-wrapper .sparklestore-caption{
                $slider_style
            }

            
        ";
        $sparklestore_pro_tablet_style .="
            .fullwidth .banner-height.video-banner .banneritem-caption, 
            .boxed .banner-height.video-banner .banneritem-caption,
            .slider-caption-wrapper .sparklestore-caption{
                $slider_tablet_style
            }
        ";
        $sparklestore_pro_mobile_style .="
            .fullwidth .banner-height.video-banner .banneritem-caption, 
            .boxed .banner-height.video-banner .banneritem-caption,
            .slider-caption-wrapper .sparklestore-caption{
                $slider_mobile_style
            }
        ";

        $slider_style = $slider_tablet_style =  $slider_mobile_style = $color= "";
        //margin
        $slider_margin = sparklewp_get_theme_options( 'sparklestore_pro_slider_margin' );
        $slider_margin = json_decode( $slider_margin, true );
        
        // desktop margin
        $slider_margin_desktop = sparklewp_cssbox_values_inline( $slider_margin, 'desktop' );
        if ( strpos( $slider_margin_desktop, 'px' ) !== false ) {
            $slider_style .= 'margin:' . $slider_margin_desktop . ';';
        }

        // tablet margin
        $slider_margin_desktop = sparklewp_cssbox_values_inline( $slider_margin, 'tablet' );
        if ( strpos( $slider_margin_desktop, 'px' ) !== false ) {
            $slider_tablet_style .= 'margin:' . $slider_margin_desktop . ';';
        }
        // mobile margin
        $slider_margin_desktop = sparklewp_cssbox_values_inline( $slider_margin, 'mobile' );
        if ( strpos( $slider_margin_desktop, 'px' ) !== false ) {
            $slider_mobile_style .= 'margin:' . $slider_margin_desktop . ';';
        }

        if($slider_style) {
            $sparklestore_pro_colors .= "
                .sparklestore-slider .slides{
                    $slider_style
                }
            ";
        }
        
        if( $sparklestore_pro_tablet_style ) {
            $sparklestore_pro_tablet_style .="
                .sparklestore-slider .slides{
                    $slider_tablet_style
                }
            ";
        }

        if( $slider_mobile_style ){
            $sparklestore_pro_mobile_style .="
                .sparklestore-slider .slides{
                    $slider_mobile_style
                }
            ";
        }
        
        
        //reset value
        $slider_style = $slider_tablet_style =  $slider_mobile_style = $color= "";
        //slider height
        $height = sparklewp_get_theme_options('sparklestore_pro_slider_height', 580);
        if( $height){
            $sparklestore_pro_colors .= "
                .header-banner .banner-img img,
                .sparklestore-slider .slides li{
                    height: {$height}px;
                }
            ";
        }
        $height = sparklewp_get_theme_options('sparklestore_pro_slider_height_tablet', 500);
        if( $height){
            $sparklestore_pro_tablet_style .= "
                .header-banner .banner-img img,
                .sparklestore-slider .slides li{
                    height: {$height}px;
                }
            ";
        }

        $height = sparklewp_get_theme_options('sparklestore_pro_slider_height_mobile', 300);
        if( $height){
            $sparklestore_pro_mobile_style .= "
                .header-banner .banner-img img,
                .sparklestore-slider .slides li{
                    height: {$height}px;
                }
            ";
        }


        /** woocommerce notice */
        $store_notice_bg_color = sparklewp_get_theme_options('sparklestore_pro_store_notice_bg_color', '#a46497');
        $store_notice_text_color = sparklewp_get_theme_options('sparklestore_pro_store_notice_text_color', '#fff');
        
        $sparklestore_pro_colors .= "
            .woocommerce-store-notice, p.demo_store{
                background-color: $store_notice_bg_color;
                color : $store_notice_text_color;
            }
            .woocommerce-store-notice a, p.demo_store a{
                color : $store_notice_text_color;
            }
            ";
        

        /** service area */
        $icon_color = sparklewp_get_theme_options('sparklestore_pro_services_icon_color', '#f33c3c');
        $title_color = sparklewp_get_theme_options('sparklestore_pro_services_title_color', '#232529');
        $description_color = sparklewp_get_theme_options('sparklestore_pro_services_description_color', '#232529');
        $service_bg_color = sparklewp_get_theme_options('sparklestore_pro_services_box_bg_color', '#f2f4f6');
        $sparklestore_pro_colors .= "
            .footerservices .services_area .services_item{
                background-color: $service_bg_color;
                color: $description_color;
            }
            .footerservices .services_item .services_icon{
                color: $icon_color;
            }
            .footerservices .services_item .services_content h3{
                color: $title_color; 
            }
        ";


        $sparklestore_pro_services_bg_type = sparklewp_get_theme_options('sparklestore_pro_services_bg_type', 'none');
        if( $sparklestore_pro_services_bg_type != 'none'){
            if( $sparklestore_pro_services_bg_type == 'color-bg') {
                $bg_color = sparklewp_get_theme_options('sparklestore_pro_services_bg_color', '#fff');
                $sparklestore_pro_colors .= "
                    .footerservices.services_wrapper{
                        background-color : $bg_color;
                    }
                ";
            }elseif( $sparklestore_pro_services_bg_type == 'gradient-bg') {
                $bg_color = sparklewp_get_theme_options('sparklestore_pro_services_bg_gradient');
                unset($css);
                $css[] = "$bg_color";
                $sparklestore_pro_colors .= ".footerservices.services_wrapper{" . implode(';', $css) . "}";
            }elseif( $sparklestore_pro_services_bg_type == 'image-bg') {
                $image = sparklewp_get_theme_options('sparklestore_pro_services_bg_image_url');
                $image_repeat = sparklewp_get_theme_options('sparklestore_pro_services_bg_image_repeat', 'no-repeat');
                $image_size = sparklewp_get_theme_options('sparklestore_pro_services_bg_image_size', 'cover');
                $image_position = sparklewp_get_theme_options('sparklestore_pro_services_bg_position', 'center center');
                $image_attach = sparklewp_get_theme_options('sparklestore_pro_services_bg_image_attach', 'scroll');

                $sparklestore_pro_colors .= "
                    .footerservices.services_wrapper{
                        background-image: url($image);
                        background-repeat: $image_repeat;
                        background-size: $image_size;
                        background-position: $image_position;
                        background-attachment: $image_attach;
                    }
                ";
            }

            $padding = sparklewp_get_theme_options('sparklestore_pro_services_padding', 25);
            $sparklestore_pro_colors .= "
                    .footerservices.services_wrapper{
                        padding-top: {$padding}px;
                        padding-bottom: {$padding}px;
                    }
                ";

            
            
        }

        /**
         * blog page template
         */
        $blog_page_box = sparklewp_get_theme_options('sparklestore_pro_blog_item_bg_color', '#fdfdfd');
        $box_text_color = sparklewp_get_theme_options('sparklestore_pro_blog_text_color', '#232529');
        $box_text_hover_color = sparklewp_get_theme_options('sparklestore_pro_blog_hover_color', '#f33c3c');


        $button_bg_color = sparklewp_get_theme_options('sparklestore_pro_blog_button_bg_color', '#003772');
        $button_border_color = sparklewp_get_theme_options('sparklestore_pro_blog_button_border_color','#003772');
        $button_text_color = sparklewp_get_theme_options('sparklestore_pro_blog_button_text_color', '#fff');
        $button_bg_hov_color = sparklewp_get_theme_options('sparklestore_pro_blog_button_bg_hov_color', '#003771');
        $button_border_hov_color = sparklewp_get_theme_options('sparklestore_pro_blog_button_border_hov_color', '#003771');
        $button_text_hov_color = sparklewp_get_theme_options('sparklestore_pro_blog_button_text_hov_color', '#ccc');
        $sparklestore_pro_colors .= "
            .page-template-template-blogpage .articlesListing .article .box{
                background-color: {$blog_page_box};
            }
            .page-template-template-blogpage .articlesListing .article .box h3 a,
            .page-template-template-blogpage .articlesListing .article .box .entry-content,
            .page-template-template-blogpage .articlesListing .article .box .metainfo *{
                color: $box_text_color;
            }
            .page-template-template-blogpage .articlesListing .article .box h3 a:hover,
            .page-template-template-blogpage .articlesListing .article .box .entry-content a:hover,
            .page-template-template-blogpage .articlesListing .article .box .metainfo a:hover{
                color : $box_text_hover_color;
            }

            .page-template-template-blogpage .articlesListing .article .box .site-button a{
                background-color: $button_bg_color;
                border-color: $button_border_color;
                color: $button_text_color;
            }
            .page-template-template-blogpage .articlesListing .article .box .site-button a:hover{
                background-color: $button_bg_hov_color;
                border-color: $button_border_hov_color;
                color: $button_text_hov_color;
            }

        ";
        

        /** 
         * footer section
        */
        $footer_bg_type = sparklewp_get_theme_options('sparklestore_pro_top_footer_bg_type', 'none');
        $heading_color = sparklewp_get_theme_options('sparklestore_pro_footer_text_color'); //232529
        $section_bg_color = sparklewp_get_theme_options('sparklestore_pro_top_footer_section_bg_color'); //fafafa
        $section_text_hover_color = sparklewp_get_theme_options('sparklestore_pro_footer_anchor_color'); //f33c3c
        $color = ariColor::newColor( $section_bg_color );
        $sction_bg_rgb  = $color->getNew( 'lightness', $color->lightness - 5 )->toCSS( 'hex' );

        if( $footer_bg_type == 'color-bg'){
            $footer_bg_color = sparklewp_get_theme_options('sparklestore_pro_top_footer_bg_color', '#f2f4f6');
            $sparklestore_pro_colors .= "
                .top-footer-area{
                    background-color: $footer_bg_color;
                }";
        } else if( 'gradient-bg' ){
            $footer_bg_gradient = sparklewp_get_theme_options('sparklestore_pro_top_footer_bg_gradient');
            if( $footer_bg_gradient){
                $css [] = $footer_bg_gradient;
                $sparklestore_pro_colors .= "
                .top-footer-area{
                    background-color: " . implode(';', $css) ."
                }";
            }
        }
        
        if( $heading_color ){
            $sparklestore_pro_colors .= "
                .top-footer-area ul li:before,
                .top-footer-area .widget ul li a,
                .top-footer-area .widget ul li,
                .top-footer-area .widget .widget-title{
                    color: $heading_color;
                }
                .top-footer-area .widget .widget-title{
                    border-color: $heading_color;
                }
            ";
        }

        if( $section_bg_color ){
            $sparklestore_pro_colors .= "
            .top-footer-area .widget .widget-title, 
            .top-footer-area .widget .widget-title + ul,
            .top-footer-area .widget ul li:nth-child(2n),
            .top-footer-area .widget ul li:nth-child(2n+1){
                background-color: $section_bg_color;
            }";
        }
        if($sction_bg_rgb ){
            $sparklestore_pro_colors .= "
            .top-footer-area .widget ul li:nth-child(2n+1){
                background-color: $sction_bg_rgb;
            }";
        }

        if( $section_text_hover_color ){
            $sparklestore_pro_colors .= "
                .top-footer-area ul li a:hover, 
                .top-footer-area a:hover{
                    color: $section_text_hover_color;
                }
            ";
        }
        
        // middle footer area
        $bg_type = sparklewp_get_theme_options('sparklestore_pro_middle_footer_bg_type', 'none');
        $bg_color = sparklewp_get_theme_options('sparklestore_pro_middle_footer_bg_color', '#232529');
        if( $bg_type == 'color-bg'){
            $sparklestore_pro_colors .= "
                .mainfooterwrapper{
                    background-color: $bg_color;
                }
            ";
        }else if( $bg_type == 'gradient-bg'){
            $footer_bg_gradient = sparklewp_get_theme_options('sparklestore_pro_middle_footer_bg_gradient');
            $css [] = $footer_bg_gradient;
            $sparklestore_pro_colors .= "
            .mainfooterwrapper{
                background-color: " . implode(';', $css) ."
            }";

        }else if($bg_type == 'image-bg'){
            $image      = sparklewp_get_theme_options('sparklestore_pro_middle_footer_bg_image_url');
            $bg_repeat  = sparklewp_get_theme_options('sparklestore_pro_middle_footer_bg_image_repeat', 'no-repeat');
            $bg_size    = sparklewp_get_theme_options('sparklestore_pro_middle_footer_bg_image_size', 'cover');
            $bg_position = sparklewp_get_theme_options('sparklestore_pro_middle_footer_bg_position', 'center center');
            $bg_attach   = sparklewp_get_theme_options('sparklestore_pro_middle_footer_bg_image_attach', 'fixed');
    
            if( $image ){
                $sparklestore_pro_colors .= "
                    .mainfooterwrapper{
                        background-image: url($image);
                        background-repeat: $bg_repeat;
                        background-size: $bg_size;
                        background-position: $bg_position;
                        background-attachment: $bg_attach;
                        background-color: $bg_color;
                        position:relative;
                        z-index: 1;
                    }
                ";
            }
        }
        
       

        $text_color = sparklewp_get_theme_options('sparklestore_pro_middle_footer_text_color');
        $text_hover_color = sparklewp_get_theme_options('sparklestore_pro_middle_footer_anchor_color');
        
        if( $text_color || $text_hover_color ){

            $sparklestore_pro_colors .= "
                .bottom-footer-area * li:before,
                .middle-footer-area * li:before,
                .middle-footer-area *,
                .bottom-footer-area *{
                    color: $text_color !important;
                }";

            $sparklestore_pro_colors .= "
                .middle-footer-area * li:hover:before,
                .middle-footer-area * li:hover *,
                .bottom-footer-area * li:hover:before,
                .bottom-footer-area * li:hover *{
                    color: $text_hover_color !important;
                }
                .bottom-footer-area.footer-widgets .widget .widget-title::before,
                .middle-footer-area.footer-widgets .widget .widget-title::before{
                    border-color: $text_hover_color;
                }

                
                
            ";
        }

        /** sub footer bg  */
        $sub_footer_bg = sparklewp_get_theme_options('sparklestore_pro_sub_footer_bg_color', '#232529');
        $padding = sparklewp_get_theme_options('sparklestore_pro_sub_footer_top_bottom_padding', '10');
        $sparklestore_pro_colors .= "
            .sub-top-footer{
                background-color: $sub_footer_bg;
                padding-top: {$padding}px;
                padding-bottom: {$padding}px;
            }";

        /** footer section */
        $bg_color = sparklewp_get_theme_options('sparklestore_pro_bottom_footer_bg_color'); //1d1e21
        $text_color = sparklewp_get_theme_options('sparklestore_pro_bottom_footer_text_color'); //ffffff;
        $ancher_color = sparklewp_get_theme_options('sparklestore_pro_bottom_footer_anchor_color'); //f33c3c;
        
        if($bg_color){
            $sparklestore_pro_colors .= "
                .sub-footer{
                    background-color: $bg_color;
                }
            ";
        }

        if($ancher_color){
            $sparklestore_pro_colors .= "              
                .sub-footer .sub-footer-inner a:hover,
                .sub-footer .coppyright a{
                    color: $ancher_color;
                }
            ";
        }
        









        /**
         * primary and secondary content area background
         */
        $primary_bg = sparklewp_get_theme_options('sparklestore_pro_primary_content_bg_color', '#fff');
        $secondry_bg = sparklewp_get_theme_options('sparklestore_pro_secondary_bg_color', '#fff');
        $sparklestore_pro_colors .= "
            #secondary.widget-area{
                background-color: $secondry_bg;
            }
            #primary.content-area{
                background-color: $primary_bg;
            }
        ";

        /**
         * gdpr settings
         */
        if( sparklewp_get_theme_options('sparklestore_pro_enable_gdpr', 'off') == 'on'){
            $bg = sparklewp_get_theme_options('sparklestore_pro_gdpr_bg');
            $text_color = sparklewp_get_theme_options('sparklestore_pro_gdpr_text_color');
            $btn_bg_color = sparklewp_get_theme_options('sparklestore_pro_button_bg_color');
            $btn_txt_color = sparklewp_get_theme_options('sparklestore_pro_button_text_color');

            $sparklestore_pro_colors .= ".sparklestore-pro-privacy-policy {
                background-color: $bg !important;
                color: $text_color !important;
            }
            .sparklestore-pro-privacy-policy  .policy-buttons a{
                background-color: $btn_bg_color !important;
                color: $btn_txt_color !important;
            }
            ";

        }

        /** Main Header Settings */
        $header_style = $header_tablet_style =  $header_mobile_style = "";
        //background
        $header_bg          = sparklewp_get_theme_options( 'header-general-background-options' );
        $header_bg          = json_decode( $header_bg, true );
        // print_r($header_bg); exit;
        $header_main_overlay_css = '';
        //bg color
        $header_bg_color = $header_bg['background-color'];

        if ( $header_bg_color ) {
            $header_style .= 'background-color:' . $header_bg_color . ';';
        }

        //bg image
        $header_bg_image = ( $header_bg['background-image'] );
        if ( $header_bg_image ) {
            $header_style .= 'background-image:url(' . esc_url( $header_bg_image ) . ');';
            //bg size
            $header_bg_size = ( $header_bg['background-size'] );
            if ( $header_bg_size ) {
                $header_style .= 'background-size:' . $header_bg_size . ';';
                $header_style .= '-webkit-background-size:' . $header_bg_size . ';';
            }
            //bg position
            $header_bg_position = ( $header_bg['background-position'] );
            if ( $header_bg_position ) {
                $header_style .= 'background-position:' . str_replace( '_', ' ', $header_bg_position ) . ';';

            }
            //bg repeat
            $header_bg_repeat = ( $header_bg['background-repeat'] );
            if ( $header_bg_repeat ) {
                $header_style .= 'background-repeat:' . $header_bg_repeat . ';';
            }
            //bg attachment
            $header_bg_attachment = ( $header_bg['background-attachment'] );
            if ( $header_bg_attachment ) {
                $header_style .= 'background-attachment:' . $header_bg_attachment . ';';
            }

            //bg overlay color
            $header_main_enable_overlay   = ( $header_bg['enable-overlay'] );
            $header_bg_overlay_color = ( $header_bg['background-overlay-color'] );
            if ( $header_bg_overlay_color && $header_main_enable_overlay ) {
                $header_main_overlay_css .= 'background:' . $header_bg_overlay_color . ';';
            }
        }
        
        
        
        //margin
        $header_margin = sparklewp_get_theme_options( 'header-general-margin' );
        $header_margin = json_decode( $header_margin, true );
        
        // desktop margin
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'desktop' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'margin:' . $header_margin_desktop . ';';
        }
        // tablet margin
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'tablet' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'margin:' . $header_margin_desktop . ';';
        }
        // mobile margin
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'mobile' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'margin:' . $header_margin_desktop . ';';
        }


        //padding
        $header_margin = sparklewp_get_theme_options( 'header-general-padding' );
        $header_margin = json_decode( $header_margin, true );
        
        // desktop padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'desktop' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'padding:' . $header_margin_desktop . ';';
        }

        // tablet padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'tablet' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'padding:' . $header_margin_desktop . ';';
        }
        // mobile padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'mobile' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'padding:' . $header_margin_desktop . ';';
        }


        //border options
        $header_border = sparklewp_get_theme_options( 'header-general-border-styling' );
        $header_border = json_decode( $header_border, true );
        //box shadow
        $header_bx_shadow_css = sparklewp_boxshadow_values_inline( ( $header_border['box-shadow-css'] ), 'desktop' );
        if ( strpos( $header_bx_shadow_css, 'px' ) !== false ) {
            $header_bxshadow_color = ( $header_border['box-shadow-color'] );
            $header_bx_shadow      = $header_bx_shadow_css . ' ' . $header_bxshadow_color;
            $header_style           .= '-webkit-box-shadow:' . $header_bx_shadow . ';';
            $header_style           .= '-moz-box-shadow:' . $header_bx_shadow . ';';
            $header_style           .= 'box-shadow:' . $header_bx_shadow . ';';
        }
        //border style
        $header_border_style = ( $header_border['border-style'] );
        if ( 'none' !== $header_border_style ) {

            $header_style .= 'border-style:' . $header_border_style . ';';
            //border width
            $header_border_width = sparklewp_cssbox_values_inline( ( $header_border['border-width'] ), 'desktop' );
            if ( strpos( $header_border_width, 'px' ) !== false ) {
                $header_style .= 'border-width:' . $header_border_width . ';';
            }
            //border color
            $header_border_color = ( $header_border['border-color'] );
            if ( $header_border_color ) {
                $header_style .= 'border-color:' . $header_border_color . ';';
            }
        }
        //border radius
        $header_border_tl_radius = ( $header_border['border-radius']['desktop']['top'] );
        if ( $header_border_tl_radius ) {
            $header_style .= 'border-top-left-radius:' . $header_border_tl_radius . 'px;';
        }
        $header_border_tr_radius = ( $header_border['border-radius']['desktop']['right'] );
        if ( $header_border_tr_radius ) {
            $header_style .= 'border-top-right-radius:' . $header_border_tr_radius . 'px;';
        }
        $header_border_br_radius = ( $header_border['border-radius']['desktop']['bottom'] );
        if ( $header_border_br_radius ) {
            $header_style .= 'border-bottom-right-radius:' . $header_border_br_radius . 'px;';
        }
        $header_border_bl_radius = ( $header_border['border-radius']['desktop']['left'] );
        if ( $header_border_bl_radius ) {
            $header_style .= 'border-bottom-left-radius:' . $header_border_br_radius . 'px;';
        }
        //merge css 
        $sparklestore_pro_colors .= "
            #masthead{
                $header_style
            }
            #masthead:before{
                $header_main_overlay_css
            }
        ";
        $sparklestore_pro_tablet_style .="
            #masthead{
                $header_tablet_style
            }
        ";
        $sparklestore_pro_mobile_style .="
            #masthead{
                $header_mobile_style
            }
        ";



        /**
         * top hader row style
        */
        $header_style = $header_tablet_style =  $header_mobile_style = "";
        if( sparklewp_get_theme_options('header-top-height-option', 'auto') == 'custom'){
            $height = sparklewp_get_theme_options('top-header-height');
            if($height) $header_style = "height: {$height}px;";

            //tablet height
            $height = sparklewp_get_theme_options('top-header-height_tablet');
            if($height) $header_tablet_style = "height: {$height}px;";

            //mobile height
            $height = sparklewp_get_theme_options('top-header-height_mobile');
            if($height) $header_mobile_style = "height: {$height}px;";
        }

        //background options
        $header_top_bg_options = sparklewp_get_theme_options( 'header-top-bg-options' );
        if ( 'custom' == $header_top_bg_options ) {
            //background
            $header_top_bg          = sparklewp_get_theme_options( 'header-top-background-options' );
            $header_top_bg          = json_decode( $header_top_bg, true );
            $header_main_overlay_css = '';
            //bg color
            $header_top_bg_color = $header_top_bg['background-color'];

            if ( $header_top_bg_color ) {
                $header_style .= 'background-color:' . $header_top_bg_color . ';';
            }

            //text color
            $header_top_bg_color = $header_top_bg['text-color'];

            if ( $header_top_bg_color ) {
                $sparklestore_pro_colors .= '.header-top a, .header-top {color:' . $header_top_bg_color . ';}';
            }

            //bg image
            $header_top_bg_image = ( $header_top_bg['background-image'] );
            if ( $header_top_bg_image ) {
                $header_style .= 'background-image:url(' . esc_url( $header_top_bg_image ) . ');';
                //bg size
                $header_top_bg_size = ( $header_top_bg['background-size'] );
                if ( $header_top_bg_size ) {
                    $header_style .= 'background-size:' . $header_top_bg_size . ';';
                    $header_style .= '-webkit-background-size:' . $header_top_bg_size . ';';
                }
                //bg position
                $header_top_bg_position = ( $header_top_bg['background-position'] );
                if ( $header_top_bg_position ) {
                    $header_style .= 'background-position:' . str_replace( '_', ' ', $header_top_bg_position ) . ';';

                }
                //bg repeat
                $header_top_bg_repeat = ( $header_top_bg['background-repeat'] );
                if ( $header_top_bg_repeat ) {
                    $header_style .= 'background-repeat:' . $header_top_bg_repeat . ';';
                }
                //bg attachment
                $header_top_bg_attachment = ( $header_top_bg['background-attachment'] );
                if ( $header_top_bg_attachment ) {
                    $header_style .= 'background-attachment:' . $header_top_bg_attachment . ';';
                }

                //bg overlay color
                $header_main_enable_overlay   = ( $header_top_bg['enable-overlay'] );
                $header_top_bg_overlay_color = ( $header_top_bg['background-overlay-color'] );
                if ( $header_top_bg_overlay_color && $header_main_enable_overlay ) {
                    $header_main_overlay_css .= 'background:' . $header_top_bg_overlay_color . ';';
                }
            }
        }
        
        
        //margin
        $header_margin = sparklewp_get_theme_options( 'top-header-margin' );
        $header_margin = json_decode( $header_margin, true );
        
        // desktop margin
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'desktop' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'margin:' . $header_margin_desktop . ';';
        }
        // tablet margin
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'tablet' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'margin:' . $header_margin_desktop . ';';
        }
        // mobile margin
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'mobile' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'margin:' . $header_margin_desktop . ';';
        }


        //padding
        $header_margin = sparklewp_get_theme_options( 'top-header-padding' );
        $header_margin = json_decode( $header_margin, true );
        
        // desktop padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'desktop' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'padding:' . $header_margin_desktop . ';';
        }

        // tablet padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'tablet' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'padding:' . $header_margin_desktop . ';';
        }
        // mobile padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'mobile' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'padding:' . $header_margin_desktop . ';';
        }


        //border options
        $header_top_border = sparklewp_get_theme_options( 'header-top-border-styling' );
        $header_top_border = json_decode( $header_top_border, true );
        //box shadow
        $header_top_bx_shadow_css = sparklewp_boxshadow_values_inline( ( $header_top_border['box-shadow-css'] ), 'desktop' );
        if ( strpos( $header_top_bx_shadow_css, 'px' ) !== false ) {
            $header_top_bxshadow_color = ( $header_top_border['box-shadow-color'] );
            $header_top_bx_shadow      = $header_top_bx_shadow_css . ' ' . $header_top_bxshadow_color;
            $header_style           .= '-webkit-box-shadow:' . $header_top_bx_shadow . ';';
            $header_style           .= '-moz-box-shadow:' . $header_top_bx_shadow . ';';
            $header_style           .= 'box-shadow:' . $header_top_bx_shadow . ';';
        }
        //border style
        $header_top_border_style = ( $header_top_border['border-style'] );
        if ( 'none' !== $header_top_border_style ) {

            $header_style .= 'border-style:' . $header_top_border_style . ';';
            //border width
            $header_top_border_width = sparklewp_cssbox_values_inline( ( $header_top_border['border-width'] ), 'desktop' );
            if ( strpos( $header_top_border_width, 'px' ) !== false ) {
                $header_style .= 'border-width:' . $header_top_border_width . ';';
            }
            //border color
            $header_top_border_color = ( $header_top_border['border-color'] );
            if ( $header_top_border_color ) {
                $header_style .= 'border-color:' . $header_top_border_color . ';';
            }
        }
        //border radius
        $header_top_border_tl_radius = ( $header_top_border['border-radius']['desktop']['top'] );
        if ( $header_top_border_tl_radius ) {
            $header_style .= 'border-top-left-radius:' . $header_top_border_tl_radius . 'px;';
        }
        $header_top_border_tr_radius = ( $header_top_border['border-radius']['desktop']['right'] );
        if ( $header_top_border_tr_radius ) {
            $header_style .= 'border-top-right-radius:' . $header_top_border_tr_radius . 'px;';
        }
        $header_top_border_br_radius = ( $header_top_border['border-radius']['desktop']['bottom'] );
        if ( $header_top_border_br_radius ) {
            $header_style .= 'border-bottom-right-radius:' . $header_top_border_br_radius . 'px;';
        }
        $header_top_border_bl_radius = ( $header_top_border['border-radius']['desktop']['left'] );
        if ( $header_top_border_bl_radius ) {
            $header_style .= 'border-bottom-left-radius:' . $header_top_border_br_radius . 'px;';
        }




        
        $sparklestore_pro_colors .= "
            .header-container .header-top{
                $header_style
            }
            .header-container .header-top:before{
                $header_main_overlay_css
            }
        ";
        $sparklestore_pro_tablet_style .="
            .header-container .header-top{
                $header_tablet_style
            }
        ";
        $sparklestore_pro_mobile_style .="
            .header-container .header-top{
                $header_mobile_style
            }
        ";
        
        /** 
         * main header row
         */
        $header_style = $header_tablet_style =  $header_mobile_style = "";
        $bg_type = sparklewp_get_theme_options('sparklestore_pro_main_header_bg_type', 'color-bg');
        $bg_effect = sparklewp_get_theme_options('sparklestore_pro_main_header_parallax_effect', 'none');
        $bg_color = sparklewp_get_theme_options('sparklestore_pro_main_header_bg_color', '#fff');

        if( $bg_type == 'image-bg'){
            if ( has_header_image() ) {
                $sparklestore_pro_colors .= '.header-container .header-middle{ 
                    background-image: url("' . esc_url( get_header_image() ) . '"); 
                    background-repeat: no-repeat; 
                    background-position: center center; 
                    background-size: cover;
                    background-color: '. $bg_color. ';
                 }';
                $overlay_color = sparklewp_get_theme_options('sparklestore_pro_main_header_overlay_color', 'rgba(255,255,255,0)');
                $sparklestore_pro_colors .= ".header-container .header-middle:before{
                    background-color: $overlay_color;
                    content: '';
                    position: absolute;
                    top: 0;
                    width: 100%;
                    height: 100%;
                }";

                
                if( $bg_effect != 'none'){
                    $sparklestore_pro_colors .= '.header-container .header-middle{ 
                        background-attachment: $bg_effect;
                     }';
                }
            }
        }else if( $bg_type == 'gradient-bg' ){
            $gd = sparklewp_get_theme_options('sparklestore_pro_main_header_bg_gradient');
            if( $gd ) {
                $css[] = "$gd";
                $sparklestore_pro_colors .= ".header-container .header-middle{" . implode(';', $css) . "}";
            }
        }else{
            $sparklestore_pro_colors .= '
            .header-container .header-middle{ 
                background-color: '. $bg_color. ';
             }';
        }

        //margin
        $header_margin = sparklewp_get_theme_options( 'header-main-margin' );
        $header_margin = json_decode( $header_margin, true );
        
        // desktop margin
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'desktop' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'margin:' . $header_margin_desktop . ';';
        }
        // tablet margin
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'tablet' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'margin:' . $header_margin_desktop . ';';
        }
        // mobile margin
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'mobile' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'margin:' . $header_margin_desktop . ';';
        }


        //padding
        $header_margin = sparklewp_get_theme_options( 'header-main-padding' );
        $header_margin = json_decode( $header_margin, true );
        
        // desktop padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'desktop' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'padding:' . $header_margin_desktop . ';';
        }

        // tablet padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'tablet' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'padding:' . $header_margin_desktop . ';';
        }
        // mobile padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'mobile' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'padding:' . $header_margin_desktop . ';';
        }

        //border options
        $header_top_border = sparklewp_get_theme_options( 'header-main-border-styling' );
        $header_top_border = json_decode( $header_top_border, true );
        //box shadow
        $header_top_bx_shadow_css = sparklewp_boxshadow_values_inline( ( $header_top_border['box-shadow-css'] ), 'desktop' );
        if ( strpos( $header_top_bx_shadow_css, 'px' ) !== false ) {
            $header_top_bxshadow_color = ( $header_top_border['box-shadow-color'] );
            $header_top_bx_shadow      = $header_top_bx_shadow_css . ' ' . $header_top_bxshadow_color;
            $header_style           .= '-webkit-box-shadow:' . $header_top_bx_shadow . ';';
            $header_style           .= '-moz-box-shadow:' . $header_top_bx_shadow . ';';
            $header_style           .= 'box-shadow:' . $header_top_bx_shadow . ';';
        }
        //border style
        $header_top_border_style = ( $header_top_border['border-style'] );
        if ( 'none' !== $header_top_border_style ) {

            $header_style .= 'border-style:' . $header_top_border_style . ';';
            //border width
            $header_top_border_width = sparklewp_cssbox_values_inline( ( $header_top_border['border-width'] ), 'desktop' );
            if ( strpos( $header_top_border_width, 'px' ) !== false ) {
                $header_style .= 'border-width:' . $header_top_border_width . ';';
            }
            //border color
            $header_top_border_color = ( $header_top_border['border-color'] );
            if ( $header_top_border_color ) {
                $header_style .= 'border-color:' . $header_top_border_color . ';';
            }
        }
        //border radius
        $header_top_border_tl_radius = ( $header_top_border['border-radius']['desktop']['top'] );
        if ( $header_top_border_tl_radius ) {
            $header_style .= 'border-top-left-radius:' . $header_top_border_tl_radius . 'px;';
        }
        $header_top_border_tr_radius = ( $header_top_border['border-radius']['desktop']['right'] );
        if ( $header_top_border_tr_radius ) {
            $header_style .= 'border-top-right-radius:' . $header_top_border_tr_radius . 'px;';
        }
        $header_top_border_br_radius = ( $header_top_border['border-radius']['desktop']['bottom'] );
        if ( $header_top_border_br_radius ) {
            $header_style .= 'border-bottom-right-radius:' . $header_top_border_br_radius . 'px;';
        }
        $header_top_border_bl_radius = ( $header_top_border['border-radius']['desktop']['left'] );
        if ( $header_top_border_bl_radius ) {
            $header_style .= 'border-bottom-left-radius:' . $header_top_border_br_radius . 'px;';
        }


        $sparklestore_pro_colors .= "
            .header-container .header-middle{
                $header_style
            }
            
        ";
        $sparklestore_pro_tablet_style .="
            .header-container .header-middle{
                $header_tablet_style
            }
        ";
        $sparklestore_pro_mobile_style .="
            .header-container .header-middle{
                $header_mobile_style
            }
        ";



        /**header bottom row style */
        $header_style = $header_tablet_style =  $header_mobile_style = "";
        if( sparklewp_get_theme_options('header-bottom-height-option', 'auto') == 'custom'){
            $height = sparklewp_get_theme_options('bottom-header-height');
            if($height) $header_style = "height: {$height}px;";

            //tablet height
            $height = sparklewp_get_theme_options('bottom-header-height_tablet');
            if($height) $header_tablet_style = "height: {$height}px;";

            //mobile height
            $height = sparklewp_get_theme_options('bottom-header-height_mobile');
            if($height) $header_mobile_style = "height: {$height}px;";
        }

        //background options
        $header_top_bg_options = sparklewp_get_theme_options( 'header-bottom-bg-options' );
        if ( 'custom' == $header_top_bg_options ) {
            //background
            $header_top_bg          = sparklewp_get_theme_options( 'header-bottom-background-options' );
            $header_top_bg          = json_decode( $header_top_bg, true );
            $header_main_overlay_css = '';
            //bg color
            $header_top_bg_color = $header_top_bg['background-color'];

            if ( $header_top_bg_color ) {
                $header_style .= 'background-color:' . $header_top_bg_color . ';';
            }

            //bg image
            $header_top_bg_image = ( $header_top_bg['background-image'] );
            if ( $header_top_bg_image ) {
                $header_style .= 'background-image:url(' . esc_url( $header_top_bg_image ) . ');';
                //bg size
                $header_top_bg_size = ( $header_top_bg['background-size'] );
                if ( $header_top_bg_size ) {
                    $header_style .= 'background-size:' . $header_top_bg_size . ';';
                    $header_style .= '-webkit-background-size:' . $header_top_bg_size . ';';
                }
                //bg position
                $header_top_bg_position = ( $header_top_bg['background-position'] );
                if ( $header_top_bg_position ) {
                    $header_style .= 'background-position:' . str_replace( '_', ' ', $header_top_bg_position ) . ';';

                }
                //bg repeat
                $header_top_bg_repeat = ( $header_top_bg['background-repeat'] );
                if ( $header_top_bg_repeat ) {
                    $header_style .= 'background-repeat:' . $header_top_bg_repeat . ';';
                }
                //bg attachment
                $header_top_bg_attachment = ( $header_top_bg['background-attachment'] );
                if ( $header_top_bg_attachment ) {
                    $header_style .= 'background-attachment:' . $header_top_bg_attachment . ';';
                }

                //bg overlay color
                $header_main_enable_overlay   = ( $header_top_bg['enable-overlay'] );
                $header_top_bg_overlay_color = ( $header_top_bg['background-overlay-color'] );
                if ( $header_top_bg_overlay_color && $header_main_enable_overlay ) {
                    $header_main_overlay_css .= 'background:' . $header_top_bg_overlay_color . ';';
                }
            }
        }
        
        
        //margin
        $header_margin = sparklewp_get_theme_options( 'header-bottom-margin' );
        $header_margin = json_decode( $header_margin, true );
        
        // desktop margin
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'desktop' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'margin:' . $header_margin_desktop . ';';
        }
        // tablet margin
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'tablet' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'margin:' . $header_margin_desktop . ';';
        }
        // mobile margin
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'mobile' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'margin:' . $header_margin_desktop . ';';
        }


        //padding
        $header_margin = sparklewp_get_theme_options( 'header-bottom-padding' );
        $header_margin = json_decode( $header_margin, true );
        
        // desktop padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'desktop' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'padding:' . $header_margin_desktop . ';';
        }

        // tablet padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'tablet' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'padding:' . $header_margin_desktop . ';';
        }
        // mobile padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'mobile' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'padding:' . $header_margin_desktop . ';';
        }


        //border options
        $header_top_border = sparklewp_get_theme_options( 'header-bottom-border-styling' );
        $header_top_border = json_decode( $header_top_border, true );
        //box shadow
        $header_top_bx_shadow_css = sparklewp_boxshadow_values_inline( ( $header_top_border['box-shadow-css'] ), 'desktop' );
        if ( strpos( $header_top_bx_shadow_css, 'px' ) !== false ) {
            $header_top_bxshadow_color = ( $header_top_border['box-shadow-color'] );
            $header_top_bx_shadow      = $header_top_bx_shadow_css . ' ' . $header_top_bxshadow_color;
            $header_style           .= '-webkit-box-shadow:' . $header_top_bx_shadow . ';';
            $header_style           .= '-moz-box-shadow:' . $header_top_bx_shadow . ';';
            $header_style           .= 'box-shadow:' . $header_top_bx_shadow . ';';
        }
        //border style
        $header_top_border_style = ( $header_top_border['border-style'] );
        if ( 'none' !== $header_top_border_style ) {

            $header_style .= 'border-style:' . $header_top_border_style . ';';
            //border width
            $header_top_border_width = sparklewp_cssbox_values_inline( ( $header_top_border['border-width'] ), 'desktop' );
            if ( strpos( $header_top_border_width, 'px' ) !== false ) {
                $header_style .= 'border-width:' . $header_top_border_width . ';';
            }
            //border color
            $header_top_border_color = ( $header_top_border['border-color'] );
            if ( $header_top_border_color ) {
                $header_style .= 'border-color:' . $header_top_border_color . ';';
            }
        }
        //border radius
        $header_top_border_tl_radius = ( $header_top_border['border-radius']['desktop']['top'] );
        if ( $header_top_border_tl_radius ) {
            $header_style .= 'border-top-left-radius:' . $header_top_border_tl_radius . 'px;';
        }
        $header_top_border_tr_radius = ( $header_top_border['border-radius']['desktop']['right'] );
        if ( $header_top_border_tr_radius ) {
            $header_style .= 'border-top-right-radius:' . $header_top_border_tr_radius . 'px;';
        }
        $header_top_border_br_radius = ( $header_top_border['border-radius']['desktop']['bottom'] );
        if ( $header_top_border_br_radius ) {
            $header_style .= 'border-bottom-right-radius:' . $header_top_border_br_radius . 'px;';
        }
        $header_top_border_bl_radius = ( $header_top_border['border-radius']['desktop']['left'] );
        if ( $header_top_border_bl_radius ) {
            $header_style .= 'border-bottom-left-radius:' . $header_top_border_br_radius . 'px;';
        }




        
        $sparklestore_pro_colors .= "
            .header-container .sp-bottom-header{
                $header_style
            }
            .header-container .sp-bottom-header:before{
                $header_main_overlay_css
            }
        ";
        $sparklestore_pro_tablet_style .="
            .header-container .sp-bottom-header{
                $header_tablet_style
            }
        ";
        $sparklestore_pro_mobile_style .="
            .header-container .sp-bottom-header{
                $header_mobile_style
            }
        ";


        /**
         * Header Cart Element
         * main class spel-cart
         */
        $header_style = $header_tablet_style =  $header_mobile_style = "";
        //padding
        $header_padding = sparklewp_get_theme_options( 'cart-icon-padding' );
        $header_padding = json_decode( $header_padding, true );
        
        // desktop padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'desktop' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_style .= 'padding:' . $header_padding_desktop . ';';
        }

        // tablet padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'tablet' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'padding:' . $header_padding_desktop . ';';
        }
        // mobile padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'mobile' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'padding:' . $header_padding_desktop . ';';
        }


        //margin
        $header_margin = sparklewp_get_theme_options( 'cart-icon-margin' );
        $header_margin = json_decode( $header_margin, true );
        
        // desktop padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'desktop' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'margin:' . $header_margin_desktop . ';';
        }

        // tablet padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'tablet' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'margin:' . $header_margin_desktop . ';';
        }
        // mobile padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'mobile' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'margin:' . $header_margin_desktop . ';';
        }


        //cart more option(settings)
        $cart_option          = sparklewp_get_theme_options( 'cart-options' );
        $cart_option          = json_decode( $cart_option, true );
        //bg color
        $cart_bg_color = $cart_option['background-color'];
        if ( $cart_bg_color ) {
            $header_style .= 'background-color:' . $cart_bg_color . ';';
        }
        //text color
        $cart_text_color = $cart_option['text-color'];
        if ( $cart_text_color ) {
            $header_style .= 'color:' . $cart_text_color . ';';
        }

        //icon size
        $cart_icon_size = $cart_option['icon-font-size'];
        $cart_text_size = $cart_option['text-font-size'];
        $cart_count_bg_color = $cart_option['count-bg-color'];
        $cart_count_text_color = $cart_option['count-text-color'];

        $cart_count_margin = sparklewp_get_theme_options('cart-count-margin');
        $cart_count_margin = json_decode( $cart_count_margin, true );
        
        $cart_count_margin_css = "";
        // desktop margin
        $cart_count_margin_desktop = sparklewp_cssbox_values_inline( $cart_count_margin, 'desktop' );
        if ( strpos( $cart_count_margin_desktop, 'px' ) !== false ) {
            $cart_count_margin_css .= 'margin:' . $cart_count_margin_desktop . ';';
        }

        // header element cart
        $sparklestore_pro_colors .= "
            .spel-cart{
                $header_style
            }
            .spel-cart .site-cart-items-wrap{
                color : $cart_text_color;
                font-size: {$cart_icon_size}px;
            }
            .spel-cart .site-cart-items-wrap .item{
                font-size: {$cart_text_size}px;
            }
            .spel-cart .site-cart-items-wrap .count{
                background-color: $cart_count_bg_color;
                color: $cart_count_text_color;
                $cart_count_margin_css
            }
            
        ";
        $sparklestore_pro_tablet_style .="
            .spel-cart{
                $header_tablet_style
            }
        ";
        $sparklestore_pro_mobile_style .="
            .spel-cart{
                $header_mobile_style
            }
        ";

        /** header seach icon color */
        $header_style = $header_tablet_style =  $header_mobile_style = "";
        $sparklestore_search_icon_color = sparklewp_get_theme_options('sparklestore_search_icon_color');
        if($sparklestore_search_icon_color){
            $header_style .= 'color:' . $sparklestore_search_icon_color . ';';
        }
        $sparklestore_search_icon_size = sparklewp_get_theme_options('sparklestore_search_icon_size');
        if($sparklestore_search_icon_size){
            $header_style .= 'font-size:' . $sparklestore_search_icon_size . 'px;';
        }
        //tablet
        $sparklestore_search_icon_size = sparklewp_get_theme_options('sparklestore_search_icon_size_tablet');
        if($sparklestore_search_icon_size){
            $header_tablet_style .= 'font-size:' . $sparklestore_search_icon_size . 'px;';
        }
        //mobile
        $sparklestore_search_icon_size = sparklewp_get_theme_options('sparklestore_search_icon_size_mobile');
        if($sparklestore_search_icon_size){
            $header_mobile_style .= 'font-size:' . $sparklestore_search_icon_size . 'px;';
        }

        /** header seach icon margin & padding */
        
        //padding
        $header_padding = sparklewp_get_theme_options( 'sparklestore_search_icon_padding' );
        $header_padding = json_decode( $header_padding, true );
        
        // desktop padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'desktop' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_style .= 'padding:' . $header_padding_desktop . ';';
        }

        // tablet padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'tablet' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'padding:' . $header_padding_desktop . ';';
        }
        // mobile padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'mobile' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'padding:' . $header_padding_desktop . ';';
        }

        //margin
        $header_margin = sparklewp_get_theme_options( 'sparklestore_search_icon_margin' );
        $header_margin = json_decode( $header_margin, true );
        
        // desktop padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'desktop' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'margin:' . $header_margin_desktop . ';';
        }

        // tablet padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'tablet' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'margin:' . $header_margin_desktop . ';';
        }
        // mobile padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'mobile' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'margin:' . $header_margin_desktop . ';';
        }

        $sparklestore_pro_colors .= "
            .toggle-searchicon{
                $header_style
            }
            
        ";
        $sparklestore_pro_tablet_style .="
            .toggle-searchicon{
                $header_tablet_style
            }
        ";
        $sparklestore_pro_mobile_style .="
            .toggle-searchicon{
                $header_mobile_style
            }
        ";


        /**
         * Mobile menu icon
         */
        $header_style = $header_tablet_style =  $header_mobile_style = "";
        $header_style .= 'cursor:pointer;';
        $sparklestore_icon_color = sparklewp_get_theme_options('menu-open-icon-color');
        if($sparklestore_icon_color){
            $header_style .= 'color:' . $sparklestore_icon_color . ';';
        }
        $sparklestore_pro_menu_open_size = sparklewp_get_theme_options('sparklestore_pro_menu_open_size');
        if($sparklestore_pro_menu_open_size){
            $header_style .= 'font-size:' . $sparklestore_pro_menu_open_size . 'px;';
        }
        //tablet
        $sparklestore_pro_menu_open_size = sparklewp_get_theme_options('sparklestore_pro_menu_open_size_tablet');
        if($sparklestore_pro_menu_open_size){
            $header_tablet_style .= 'font-size:' . $sparklestore_pro_menu_open_size . 'px;';
        }
        //mobile
        $sparklestore_pro_menu_open_size = sparklewp_get_theme_options('sparklestore_pro_menu_open_size_mobile');
        if($sparklestore_pro_menu_open_size){
            $header_mobile_style .= 'font-size:' . $sparklestore_pro_menu_open_size . 'px;';
        }

        /** header seach icon margin & padding */
        
        //padding
        $header_padding = sparklewp_get_theme_options( 'menu-open-icon-padding' );
        $header_padding = json_decode( $header_padding, true );
        
        // desktop padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'desktop' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_style .= 'padding:' . $header_padding_desktop . ';';
        }

        // tablet padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'tablet' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'padding:' . $header_padding_desktop . ';';
        }
        // mobile padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'mobile' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'padding:' . $header_padding_desktop . ';';
        }

        //margin
        $header_margin = sparklewp_get_theme_options( 'menu-open-icon-margin' );
        $header_margin = json_decode( $header_margin, true );
        
        // desktop padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'desktop' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'margin:' . $header_margin_desktop . ';';
        }

        // tablet padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'tablet' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'margin:' . $header_margin_desktop . ';';
        }
        // mobile padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'mobile' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'margin:' . $header_margin_desktop . ';';
        }

        $sparklestore_pro_colors .= "
            .header-container .sp-toggle-nav-icon{
                $header_style
            }
            
        ";
        $sparklestore_pro_tablet_style .="
            .header-container .sp-toggle-nav-icon{
                $header_tablet_style
            }
        ";
        $sparklestore_pro_mobile_style .="
            .header-container .sp-toggle-nav-icon{
                $header_mobile_style
            }
        ";
        
        /**
         * Header account
         */
        $header_style = $header_tablet_style =  $header_mobile_style = $color= "";
        $sparklestore_icon_color = sparklewp_get_theme_options('account-icon-color');
        if($sparklestore_icon_color){
            $color .= 'color:' . $sparklestore_icon_color . ';';
        }
        
        //padding
        $header_padding = sparklewp_get_theme_options( 'account-icon-padding' );
        $header_padding = json_decode( $header_padding, true );
        
        // desktop padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'desktop' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_style .= 'padding:' . $header_padding_desktop . ';';
        }

        // tablet padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'tablet' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'padding:' . $header_padding_desktop . ';';
        }
        // mobile padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'mobile' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'padding:' . $header_padding_desktop . ';';
        }

        //margin
        $header_margin = sparklewp_get_theme_options( 'account-icon-margin' );
        $header_margin = json_decode( $header_margin, true );
        
        // desktop padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'desktop' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'margin:' . $header_margin_desktop . ';';
        }

        // tablet padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'tablet' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'margin:' . $header_margin_desktop . ';';
        }
        // mobile padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'mobile' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'margin:' . $header_margin_desktop . ';';
        }

        $sparklestore_pro_colors .= "
            .header-container .spel-my-account *, .header-container .spel-my-account a{
                $color
            }
            .header-container .spel-my-account{
                $header_style
            }

            
        ";
        $sparklestore_pro_tablet_style .="
            .header-container .spel-my-account{
                $header_tablet_style
            }
        ";
        $sparklestore_pro_mobile_style .="
            .header-container .spel-my-account{
                $header_mobile_style
            }
        ";

        /**
         * header wishlist element
         * top-wishlist
         */
        $header_style = $header_tablet_style =  $header_mobile_style = $color= "";
        $sparklestore_icon_color = sparklewp_get_theme_options('wishlist-icon-color');
        if($sparklestore_icon_color){
            $color .= 'color:' . $sparklestore_icon_color . ';';
        }
        
        //padding
        $header_padding = sparklewp_get_theme_options( 'wishlist-icon-padding' );
        $header_padding = json_decode( $header_padding, true );
        
        // desktop padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'desktop' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_style .= 'padding:' . $header_padding_desktop . ';';
        }

        // tablet padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'tablet' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'padding:' . $header_padding_desktop . ';';
        }
        // mobile padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'mobile' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'padding:' . $header_padding_desktop . ';';
        }

        //margin
        $header_margin = sparklewp_get_theme_options( 'wishlist-icon-margin' );
        $header_margin = json_decode( $header_margin, true );
        
        // desktop padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'desktop' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'margin:' . $header_margin_desktop . ';';
        }

        // tablet padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'tablet' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'margin:' . $header_margin_desktop . ';';
        }
        // mobile padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'mobile' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'margin:' . $header_margin_desktop . ';';
        }

        $sparklestore_pro_colors .= "
            .header-container .top-wishlist a{
                $color
            }
            .header-container .top-wishlist{
                $header_style
            }

            
        ";
        $sparklestore_pro_tablet_style .="
            .header-container .top-wishlist{
                $header_tablet_style
            }
        ";
        $sparklestore_pro_mobile_style .="
            .header-container .top-wishlist{
                $header_mobile_style
            }
        ";


        /** quick information */
        $color = sparklewp_get_theme_options('sparklestore_pro_quick_info_color');
        if($color){
            $sparklestore_pro_colors .= "
            .quickinfowrap, .quickinfowrap a{
                color: $color;
            }
        ";
        }

        /**
         * Secondary Menu
         * .box-header-nav .main-menu.secondry-menu .page_item a, 
         * .box-header-nav .main-menu.secondry-menu > .menu-item > a
         */
        $item_color = sparklewp_get_theme_options('sparklestore_second_menu_item_color');
        if($item_color){
            $sparklestore_pro_colors .="
            .box-header-nav .main-menu.secondry-menu .page_item a, 
            .box-header-nav .main-menu.secondry-menu > .menu-item > a{
                color: $item_color;
            }";
        }
        $active_color = sparklewp_get_theme_options('sparklestore_second_menu_active_bg_color');
        $active_text_color = sparklewp_get_theme_options('sparklestore_second_menu_active_item_color');
        if($active_color || $active_text_color){
            $sparklestore_pro_colors .="
            .box-header-nav .main-menu.secondry-menu .page_item.current_page_item > a, 
            .box-header-nav .main-menu.secondry-menu .page_item:hover > a, 
            .box-header-nav .main-menu.secondry-menu > .menu-item.current-menu-item > a, 
            .box-header-nav .main-menu.secondry-menu > .menu-item:hover > a{
                background-color: $active_color;
                color: $active_text_color;
            }";
        }
        $sub_meu_bg_color = sparklewp_get_theme_options('sparklestore_pro_second_sub_menu_bg_color', '#fff');
        $sub_meu_text_color = sparklewp_get_theme_options('sparklestore_pro_second_sub_menu_text_color', '#000');
        $sparklestore_pro_colors .="
            .box-header-nav .main-menu.secondry-menu .sub-menu > .menu-item > a, 
            .box-header-nav .main-menu.secondry-menu .page_item:hover > .children, 
            .box-header-nav .main-menu.secondry-menu .menu-item:hover > .sub-menu{
                background-color: $sub_meu_bg_color;
                color: $sub_meu_text_color;
            }";
        $sub_menu_hover_bg_color = sparklewp_get_theme_options('sparklestore_pro_second_sub_menu_hover_bg_color');
        $sub_menu_hover_text_color = sparklewp_get_theme_options('sparklestore_pro_second_sub_menu_hover_text_color');
        if($sub_menu_hover_text_color || $sub_menu_hover_bg_color){
            $sparklestore_pro_colors .="
            .box-header-nav .main-menu.secondry-menu .children > .page_item:hover > a, 
            .box-header-nav .main-menu.secondry-menu .sub-menu > .menu-item:hover > a, 
            .box-header-nav .main-menu.secondry-menu .children > .page_item.current_page_item > a, 
            .box-header-nav .main-menu.secondry-menu .children > .page_item:hover > a, 
            .box-header-nav .main-menu.secondry-menu .sub-menu > .menu-item.current-menu-item > a, 
            .box-header-nav .main-menu.secondry-menu .sub-menu > .menu-item:hover > a{
                background-color: $sub_menu_hover_bg_color;
                color: $sub_menu_hover_text_color;
            }";
        }
        //secondary menu margin and padding
        $header_style = $header_tablet_style =  $header_mobile_style = $color= "";
        
        //padding
        $header_padding = sparklewp_get_theme_options( 'secondary-menu-padding' );
        $header_padding = json_decode( $header_padding, true );
        
        // desktop padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'desktop' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_style .= 'padding:' . $header_padding_desktop . ';';
        }

        // tablet padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'tablet' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'padding:' . $header_padding_desktop . ';';
        }
        // mobile padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'mobile' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'padding:' . $header_padding_desktop . ';';
        }

        //margin
        $header_margin = sparklewp_get_theme_options( 'secondary-menu-margin' );
        $header_margin = json_decode( $header_margin, true );
        
        // desktop padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'desktop' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'margin:' . $header_margin_desktop . ';';
        }

        // tablet padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'tablet' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'margin:' . $header_margin_desktop . ';';
        }
        // mobile padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'mobile' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'margin:' . $header_margin_desktop . ';';
        }

        $sparklestore_pro_colors .= "
            .secondry-links.box-header-nav{
                $header_style
            }

            
        ";
        $sparklestore_pro_tablet_style .="
            .secondry-links.box-header-nav{
                $header_tablet_style
            }
        ";
        $sparklestore_pro_mobile_style .="
            .secondry-links.box-header-nav{
                $header_mobile_style
            }
        ";

        // secondary menu item margin and padding    
        $header_style = $header_tablet_style =  $header_mobile_style = $color= "";
        
        //padding
        $header_padding = sparklewp_get_theme_options( 'secondary-menu-item-padding' );
        $header_padding = json_decode( $header_padding, true );
        
        // desktop padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'desktop' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_style .= 'padding:' . $header_padding_desktop . ';';
        }

        // tablet padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'tablet' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'padding:' . $header_padding_desktop . ';';
        }
        // mobile padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'mobile' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'padding:' . $header_padding_desktop . ';';
        }

        //margin
        $header_margin = sparklewp_get_theme_options( 'secondary-menu-item-margin' );
        $header_margin = json_decode( $header_margin, true );
        
        // desktop padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'desktop' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'margin:' . $header_margin_desktop . ';';
        }

        // tablet padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'tablet' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'margin:' . $header_margin_desktop . ';';
        }
        // mobile padding
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'mobile' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'margin:' . $header_margin_desktop . ';';
        }

        $sparklestore_pro_colors .= "
            .box-header-nav .main-menu.secondry-menu > ul > .page_item a, 
            .box-header-nav .main-menu.secondry-menu > .menu-item a,
            .box-header-nav .main-menu.secondry-menu .children > .page_item > a, 
            .box-header-nav .main-menu.secondry-menu .sub-menu > .menu-item > a{
                $header_style
            }

            
        ";
        $sparklestore_pro_tablet_style .="
            .box-header-nav .main-menu.secondry-menu > ul > .page_item a, 
            .box-header-nav .main-menu.secondry-menu > .menu-item a,
            .box-header-nav .main-menu.secondry-menu .children > .page_item > a, 
            .box-header-nav .main-menu.secondry-menu .sub-menu > .menu-item > a{
                $header_tablet_style
            }
        ";
        $sparklestore_pro_mobile_style .="
            .box-header-nav .main-menu.secondry-menu > ul > .page_item a, 
            .box-header-nav .main-menu.secondry-menu > .menu-item a,
            .box-header-nav .main-menu.secondry-menu .children > .page_item > a, 
            .box-header-nav .main-menu.secondry-menu .sub-menu > .menu-item > a{
                $header_mobile_style
            }
        ";

        /** social icons color settings */
        $social_bg_color = sparklewp_get_theme_options('sparklestore_pro_top_header_social_bg_color', '#003772');
        $social_icon_color = sparklewp_get_theme_options('sparklestore_pro_top_header_social_icon_color', '#fff');
        if( $social_bg_color || $social_icon_color){
            $sparklestore_pro_colors .= "
                .menu-modal-inner .social ul li a,
                .header-container .social ul li a{
                    border-color: $social_bg_color;
                    background-color: $social_bg_color;
                    color: $social_icon_color;
                }
            ";
        }
        /** social icon hover color settings */
        $social_bg_color = sparklewp_get_theme_options('sparklestore_pro_top_header_social_hover_bg_color', '#003772');
        $social_icon_color = sparklewp_get_theme_options('sparklestore_pro_top_header_social_hover_icon_color', '#fff');
        if( $social_bg_color || $social_icon_color){
            $sparklestore_pro_colors .= "
                .menu-modal-inner .social ul li a:hover,
                .header-container .social ul li a:hover{
                    border-color: $social_bg_color;
                    background-color: $social_bg_color;
                    color: $social_icon_color;
                }
            ";
        }

        /**
         * Button One Header Element
         * .swp-header-button.button-one
         */
        $header_style = $header_tablet_style =  $header_mobile_style = $color= "";
        //padding
        $header_padding = sparklewp_get_theme_options( 'button-one-padding' );
        $header_padding = json_decode( $header_padding, true );
        
        // desktop padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'desktop' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_style .= 'padding:' . $header_padding_desktop . ';';
        }

        // tablet padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'tablet' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'padding:' . $header_padding_desktop . ';';
        }
        // mobile padding
        $header_padding_desktop = sparklewp_cssbox_values_inline( $header_padding, 'mobile' );
        if ( strpos( $header_padding_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'padding:' . $header_padding_desktop . ';';
        }

        //margin
        $header_margin = sparklewp_get_theme_options( 'button-one-margin' );
        $header_margin = json_decode( $header_margin, true );
        
        // desktop margin
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'desktop' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_style .= 'margin:' . $header_margin_desktop . ';';
        }

        // tablet margin
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'tablet' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_tablet_style .= 'margin:' . $header_margin_desktop . ';';
        }
        // mobile margin
        $header_margin_desktop = sparklewp_cssbox_values_inline( $header_margin, 'mobile' );
        if ( strpos( $header_margin_desktop, 'px' ) !== false ) {
            $header_mobile_style .= 'margin:' . $header_margin_desktop . ';';
        }

        //color
        $bg_color = sparklewp_get_theme_options('button-one_bg_color', '#003772');
        $border_color = sparklewp_get_theme_options('button-one_border_color', '#003772');
        $text_color = sparklewp_get_theme_options('button-one_text_color', '#ffffff');
        $font_size = sparklewp_get_theme_options('button-one-font-size', 16);

        $header_style .= 'background-color:' . $bg_color . ';';
        $header_style .= 'border-color:' . $border_color . ';';
        $header_style .= 'color:' . $text_color . ';';
        $header_style .= 'text-align:center;';
        $header_style .= 'font-size:' . $font_size . 'px;';

        //hover color 
        $bg_color = sparklewp_get_theme_options('button-one_bg_hov_color', '#003772');
        $border_color = sparklewp_get_theme_options('button-one_border_hov_color', '#003772');
        $text_color = sparklewp_get_theme_options('button-one_text_hov_color', '#ffffff');
        
        $sparklestore_pro_colors .= "
            .swp-header-button.button-one a{
                $header_style
            }
            .swp-header-button.button-one a:hover{
                border-color: $border_color;
                background-color: $bg_color;
                color: $text_color;
            }

            
        ";
        $sparklestore_pro_tablet_style .="
            .swp-header-button.button-one a{
                $header_tablet_style
            }
        ";
        $sparklestore_pro_mobile_style .="
            .swp-header-button.button-one a{
                $header_mobile_style
            }
        ";


        /** 
         * Site logo width 
         */
         $logo_width = sparklewp_get_theme_options('site-logo-max-width');
         if( $logo_width){
            $sparklestore_pro_colors .= "
            .site-branding-wrapper{
                max-width: {$logo_width}%;
                margin: 0 auto;
            }";
         }
         $logo_width = sparklewp_get_theme_options('site-logo-max-width_tablet');
         if( $logo_width){
            $sparklestore_pro_tablet_style .= "
            .site-branding-wrapper{
                max-width: {$logo_width}%;
                margin:0 auto;
            }";
         }

         $logo_width = sparklewp_get_theme_options('site-logo-max-width_mobile');
         if( $logo_width){
            $sparklestore_pro_mobile_style .= "
            .site-branding-wrapper{
                max-width: {$logo_width}%;
                margin:0 auto;
            }";
         }

        // sparklestore_pro_mobile_style

        $sparklestore_pro_colors .= "@media screen and (max-width:768px){{$sparklestore_pro_tablet_style}}";
        $sparklestore_pro_colors .= "@media screen and (max-width:480px){{$sparklestore_pro_mobile_style}}";

        return sparklestore_pro_css_strip_whitespace($sparklestore_pro_colors);
    }
}
add_action( 'wp_enqueue_scripts', 'sparklestore_pro_dynamic_css', 99 );

if( !function_exists('sparklestore_pro_css_strip_whitespace')){
    function sparklestore_pro_css_strip_whitespace($css) {
        $replace = array(
            "#/\*.*?\*/#s" => "", // Strip C style comments.
            "#\s\s+#" => " ", // Strip excess whitespace.
        );
        $search = array_keys($replace);
        $css = preg_replace($search, $replace, $css);

        $replace = array(
            ": " => ":",
            "; " => ";",
            " {" => "{",
            " }" => "}",
            ", " => ",",
            "{ " => "{",
            ";}" => "}", // Strip optional semicolons.
            ",\n" => ",", // Don't wrap multiple selectors.
            "\n}" => "}", // Don't wrap closing braces.
            "} " => "}", // Put each rule on it's own line.
        );
        $search = array_keys($replace);
        $css = str_replace($search, $replace, $css);

        return trim($css);
    }
}