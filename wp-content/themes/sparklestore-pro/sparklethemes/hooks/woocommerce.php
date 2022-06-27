<?php
if ( ! function_exists( 'sparklestore_pro_ecommerce_items' ) ) :
    /**
     * eCommerce Items
     *
     * @since 1.0.0
     */
    function sparklestore_pro_ecommerce_items() { ?>

        <ul class="ecommerce_items">
            
            <?php if (is_user_logged_in()) { ?>
                <?php if( !get_theme_mod('sparklestore_pro_myaccount_options') ) : ?>
                    <li>
                        <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><span class="fab fa-opencart"></span> <?php esc_html_e('My Account','sparklestore-pro'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>"><span class="fas fa-sign-out-alt"></span><?php esc_html_e('Logout','sparklestore-pro'); ?></a>
                    </li>   
                <?php endif; ?>

            <?php } else{ ?>
                
                <?php if( !get_theme_mod('sparklestore_pro_myaccount_options') ) : ?>
                    <li>
                        <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"><span class="fas fa-sign-in-alt"></span><?php esc_html_e('Login / Signup','sparklestore-pro'); ?></a>
                    </li>
                <?php endif; ?>
            
            <?php } if(function_exists( 'sparklestore_pro_products_wishlist' )) { ?>
                <?php if( !get_theme_mod('sparklestore_pro_wishlist_options') ) : ?>
                    <li>                                    
                        <?php sparklestore_pro_products_wishlist(); ?>
                    </li>
                <?php endif; ?>
            <?php } ?>

            <?php if( !get_theme_mod('sparklestore_pro_cart_options') ) : ?>
                <li class="cart_items">
                    <?php sparklestore_pro_woocommerce_cart_link(); ?>
                </li>
            <?php endif; ?>

        </ul>
    <?php
    }
endif;
add_action('sparklestore_extra','sparklestore_pro_ecommerce_items');

/**
 * sparklestore_pro_wishlist
 * since 1.2.8
 * Header Wishlist Icon
 * @return void
 */
if( !function_exists('sparklestore_pro_wishlist')){
	function sparklestore_pro_wishlist (){
		sparklestore_pro_products_wishlist();
	}
	add_action('sparklestore_pro_wishlist', 'sparklestore_pro_wishlist');
}

/**
 * sparklestore_pro_compare
 * since 1.2.8
 * Header Wishlist Icon
 * @return void
 */
if( !function_exists('sparklestore_pro_compare')){
	function sparklestore_pro_compare (){
		
	}
	add_action('sparklestore_pro_compare', 'sparklestore_pro_compare');
}

/**
 * sparklestore_pro_cart
 * since 1.2.8
 * Header Cart Icon
 * @return void
 */
if( !function_exists('sparklestore_pro_cart')){
	function sparklestore_pro_cart(){
        ?>
		<div class="cart_items">
            <?php sparklestore_pro_woocommerce_cart_link(); ?>
        </div>
        <?php
	}
	add_action('sparklestore_pro_cart', 'sparklestore_pro_woocommerce_header_cart');
}
/**
 * sparklestore_pro_login_register 
 * since 1.2.8
 * Header Cart Icon
 * @return void
 */
if( !function_exists('sparklestore_pro_login_register ')){
	function sparklestore_pro_login_register (){
        $icon_or_text = get_theme_mod('account-icon-options', 'icon');
        $icon = get_theme_mod('account-icon', 'fab fa-opencart');
        $text = get_theme_mod('account-text', 'My Account');
        $text_before = get_theme_mod( 'account-before-text', 'Register' );

        $alignment = get_theme_mod('account-icon-align', 'swp-flex-align-left');
        
        if (is_user_logged_in()): ?>
            <div class="sparkle-column spel-my-account <?php esc_attr_e($alignment); ?>">
                <span class="my-account">
                    <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
                        <?php if( $icon_or_text == 'both' || $icon_or_text == 'icon'): ?>
                        <span class="<?php esc_attr_e($icon); ?>"></span> 
                        <?php endif; ?>
                        <?php if( $icon_or_text == 'both' || $icon_or_text == 'text'): ?>
                        <?php esc_html_e($text); ?>
                        <?php endif; ?>
                    </a>
                </span>
                <?php if( get_theme_mod('account-show-logout', true)): ?>
                <span class="logout">
                    <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>"><span class="fas fa-sign-out-alt"></span><?php esc_html_e('Logout','sparklestore-pro'); ?></a>
                </span>
                <?php endif; ?>
            </div>  
        <?php else: ?>
            <div class="sparkle-column <?php esc_attr_e($alignment); ?>">
                <span class="register">
                    <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
                        <span class="<?php esc_attr_e($icon); ?>"></span> 
                        <?php esc_html_e($text_before); ?>
                    </a>
                </span>
            </div> 
        <?php endif;
	}
	add_action('sparklestore_pro_login_register', 'sparklestore_pro_login_register');
}



if ( ! function_exists( 'sparklestore_pro_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function sparklestore_pro_woocommerce_header_cart() { 
        $alignment     = get_theme_mod('cart-icon-align', 'swp-flex-align-right');
        ?>

		<div id="site-header-cart" class="site-header-cart block-minicart sparkle-column <?php esc_attr_e($alignment); ?>">
			<?php sparklestore_pro_woocommerce_cart_link(); ?>
            <div class="shopcart-description">
				<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
            </div>
        </div>
		<?php
	}
}
add_action( 'sparklestore_pro_woocommerce_header_cart', 'sparklestore_pro_woocommerce_header_cart' );

// *****************************************************************************// 
// ! OFF Wrappers elements: cart widget, search (full screen), header banner
// *****************************************************************************// 

if ( ! function_exists( 'sparklestore_cart_side_widget' ) ) {
	function sparklestore_cart_side_widget() {
		?>
			<div class="cart-widget-side">
				<div class="widget-heading">
					<h3 class="widget-title"><?php esc_html_e( 'Shopping cart', 'sparklestore-pro' ); ?></h3>
					<a href="#" class="close-side-widget"><?php esc_html_e( 'close', 'sparklestore-pro' ); ?></a>
                </div>
                
                    <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                
			</div>
		<?php
	}

	add_action( 'sparklestore_pro_footer_after', 'sparklestore_cart_side_widget', 140 );
}


//add_action('body_class', 'sparklestore_pro_woo_body_class');
if (!function_exists('sparklestore_pro_woo_body_class')) {
    function sparklestore_pro_woo_body_class($class) {
        $class[] = 'columns-' . sparklestore_pro_loop_columns();
        return $class;
    }
}

if ( ! function_exists( 'sparklestore_pro_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function sparklestore_pro_woocommerce_cart_link_fragment( $fragments ) {
        
        ob_start();
        
        sparklestore_pro_woocommerce_cart_link();
        
        $fragments['div.block-cart-link'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'sparklestore_pro_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'sparklestore_pro_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function sparklestore_pro_woocommerce_cart_link() { 
        
        global $woocommerce;

        $icon_or_text = get_theme_mod('cart-icon-options', 'icon');
        $icon         = get_theme_mod('cart-icon', 'fas fa-cart-arrow-down');
        $text         = get_theme_mod('cart-text', 'Cart');
        $show_price   = get_theme_mod('cart-show-price', false);
        $show_count   = get_theme_mod('cart-show-count', true);
        ?>
		<div class="shopcart-dropdown block-cart-link spel-cart">
           <a class="cart-contents grid-row" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'sparklestore-pro' ); ?>">
				<div class="site-cart-items-wrap">

                    <?php if( $icon_or_text == 'icon' || $icon_or_text == 'both'): ?>
                    <div class="cart-icon <?php esc_attr_e($icon); ?>">
                        <?php if( $show_count) : ?>
                        <span class="count"><?php echo intval( WC()->cart->cart_contents_count ); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php if( $icon_or_text == 'text' || $icon_or_text == 'both'): ?>
                        <span class="text"><?php echo esc_html($text) ?></span>
                    <?php endif; ?>
                    
                    <?php if($show_price): ?>
                    <span class="item"><?php echo wp_kses_post( $woocommerce->cart->get_cart_subtotal() ); ?></span>
                    <?php endif; ?>
				</div>
            </a>
        </div>
		<?php
	}
}

if ( ! function_exists( 'sparklestore_pro_products_wishlist' ) ) {
    /**
     * Wishlist Header Count Ajax Function
     *
     * @since 1.0.0
    */
    function sparklestore_pro_products_wishlist() {

        if ( function_exists( 'YITH_WCWL' ) ) { 

            $wishlist_url = YITH_WCWL()->get_wishlist_url(); 
            $icon_or_text = get_theme_mod('wishlist-icon-options', 'icon');
            $icon         = get_theme_mod('wishlist-icon', 'fas fa-heart');
            $text         = get_theme_mod('wishlist-text', 'Wishlist');
            $alignment    = get_theme_mod('wishlist-icon-align', 'swp-flex-align-left');
            ?>
            <div class="top-wishlist sparkle-column <?php esc_attr_e($alignment); ?>">                
                    <a href="<?php echo esc_url( $wishlist_url ); ?>" title="Wishlist" data-toggle="tooltip">
                        <div class="count">
                                <div class="bigcounter">
                                    
                                    <?php if( $icon_or_text == 'icon' || $icon_or_text == 'both'): ?>
                                        <span class="<?php esc_attr_e($icon); ?>"></span>
                                    <?php endif; ?>

                                    <?php if( $icon_or_text == 'text' || $icon_or_text == 'both'): ?>
                                        <span><?php echo esc_html($text) ?></span>
                                    <?php endif; ?>
                                    <span class="count_number">(<?php echo intval( yith_wcwl_count_products() ); ?>)</span>
                                </div>
                        </div>
                    </a>
            </div>
        <?php
        }
    }	
}
add_action( 'wp_ajax_yith_wcwl_update_single_product_list', 'sparklestore_pro_products_wishlist' );
add_action( 'wp_ajax_nopriv_yith_wcwl_update_single_product_list', 'sparklestore_pro_products_wishlist' );



/**
 * Product wishlist button function area
*/
if ( function_exists( 'YITH_WCWL' ) ) {

    function sparklestore_pro_wishlist_products() {

        echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );

    }

 }

/**
 * define the yith-wcwl-browse-wishlist-label callback
*/
function filter_yith_wcwl_browse_wishlist_label( $var ) { 

    return '<span class="sparkle-tooltip-label">'.$var.'</span>';

}; 
add_filter( 'yith-wcwl-browse-wishlist-label', 'filter_yith_wcwl_browse_wishlist_label', 10, 1 ); 


/**
 * Add the link to compare function area
*/
if (defined('YITH_WOOCOMPARE')) {

    function sparklestore_pro_add_compare_link($product_id = false, $args = array()) {
        extract($args);
        if (!$product_id) {
            global $product;
            $productid = $product->get_id();
            $product_id = isset( $productid ) ? $productid : 0;
        }
        $is_button = !isset($button_or_link) || !$button_or_link ? get_option('yith_woocompare_is_button') : $button_or_link;

        if (!isset($button_text) || $button_text == 'default') {
            $button_text = get_option('yith_woocompare_button_text', esc_html__('Compare', 'sparklestore-pro'));
            yit_wpml_register_string('Plugins', 'plugin_yit_compare_button_text', $button_text);
            $button_text = yit_wpml_string_translate('Plugins', 'plugin_yit_compare_button_text', $button_text);
        }
        printf('<a href="%s" class="%s" data-product_id="%d" rel="nofollow">%s</a>', '#', 'compare link-compare', intval( $product_id ), '<span class="sparkle-tooltip-label">'.esc_html( $button_text ).'</span>'.esc_html( $button_text ) );
    }

    remove_action('woocommerce_after_shop_loop_item', array('YITH_Woocompare_Frontend', 'add_compare_link'), 20);
}

/**
 * Add the link to quickview function area
*/
if (defined('YITH_WCQV')) {
    function sparklestore_pro_quickview() {
        global $product;
        $quick_view = YITH_WCQV_Frontend();
        remove_action('woocommerce_after_shop_loop_item', array($quick_view, 'yith_add_quick_view_button'), 15);
        $label = esc_html(get_option('yith-wcqv-button-label'));
        echo '<a href="#" class="link-quickview yith-wcqv-button" data-product_id="' . intval( $product->get_id() ) . '"><span class="sparkle-tooltip-label">'.esc_html__('Quick view', 'sparklestore-pro').'</span>' . esc_html( $label ) . '</a>';
    }
}


/**
 * Percentage calculation function area
*/
if( !function_exists ('sparklestore_pro_sale_percentage_loop') ){
	/**
     * Woocommerce Products Discount Show
     *
     * @since 1.0.0
    */
	function sparklestore_pro_sale_percentage_loop() {

        if( !get_theme_mod('sparklestore_pro_catelog_enable_discount', true) ) return;

		global $product;
		
		if ( $product->is_on_sale() ) {
			
			if ( ! $product->is_type( 'variable' ) and $product->get_regular_price() and $product->get_sale_price() ) {
				
				$max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
			
			} else {
				$max_percentage = 0;
				
				foreach ( $product->get_children() as $child_id ) {

                    $variation = wc_get_product( $child_id );
                    
                    if( !$variation ) continue;

					$price = $variation->get_regular_price();

					$sale = $variation->get_sale_price();

					$percentage = '';

					if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;

						if ( $percentage > $max_percentage ) {
							$max_percentage = $percentage;
						}
				}
			
			}
            
            
            

            $color = get_theme_mod('sparklestore_pro_catelog_discount_tag_text_color', '#ffffff');
            $bg_color = get_theme_mod('sparklestore_pro_catelog_discount_tag_bg_color', '#ffc60a');
            
            $style = "style='color: $color; background-color: $bg_color;'";

            echo "<span class='on_sale' ". $style. ">" . esc_html( round( - $max_percentage ) ) . esc_html__("%", 'sparklestore-pro')."</span>";
		
		}

	}
}

/**
 * Sparkle Tabs Category Products Ajax Function
*/
if (!function_exists('sparklestore_pro_tabs_ajax_action')) {

    function sparklestore_pro_tabs_ajax_action() {

        $cat_slug       = $_POST['category_slug'];
        $product_number = $_POST['product_num'];
        $layout         = $_POST['layout']; //'grid';
        $column_number  = $_POST['column']; //3;

        ob_start(); ?>
        <?php
            $product_args = array(
                'post_type' => 'product',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => $cat_slug
                    )),
                'posts_per_page' => $product_number
            );

            $query = new WP_Query($product_args);

            if ($query->have_posts()) {
                while ($query->have_posts()) { $query->the_post();
                    wc_get_template_part('content', 'product');
                }
            }
            wp_reset_postdata();
        ?>
            
        <?php
            $sparkle_html = ob_get_contents();
            ob_get_clean();
            echo $sparkle_html;
            die();
    }
}
add_action('wp_ajax_sparklestore_pro_tabs_ajax_action', 'sparklestore_pro_tabs_ajax_action');
add_action('wp_ajax_nopriv_sparklestore_pro_tabs_ajax_action', 'sparklestore_pro_tabs_ajax_action');


/**
 * Load sparkleStore WooCommerce action and filter function area
*/
function sparklestore_pro_woocommerce_breadcrumb() {

    do_action('breadcrumb-woocommerce');
}
add_action('woocommerce_before_main_content', 'sparklestore_pro_woocommerce_breadcrumb', 9);

/**
 *  Remove WooCommerce Default Breadcrumb & Title
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_filter('woocommerce_show_page_title', '__return_false');



/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'sparklestore_pro_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function sparklestore_pro_woocommerce_wrapper_before() {
		
        $product_sidebar =  get_theme_mod( 'sparklestore_pro_woo_category_settings_section','rightsidebar' );
        if( is_singular('product') ) {
            $product_sidebar =  get_theme_mod( 'sparklestore_pro_woo_product_page_layout','fullwidth' );
        }
        elseif( is_shop() || is_product_category() || is_product_tag() ){
            $product_sidebar =  get_theme_mod( 'sparklestore_pro_catelog_layout','rightsidebar' );
        }
        
        ?>
        <div class="site-wrapper <?php echo esc_attr( $product_sidebar ); ?>">
            <div class="container">
                <?php 
                    if( $product_sidebar == 'leftsidebar') get_sidebar('left');

                    $css = array();
                    $css[] = $product_sidebar;
                    $css[] = 'product-hover-'.get_theme_mod('sparklestore_pro_woo_product_hover_style', 'style1');
                    $css[] = get_theme_mod('sparklestore_pro_catelog_cat_hover_style', 'cat-hover1');
                    
                    if(  is_shop() || is_product_category() || is_product_tag() )
                        $css[] = sparkle_get_product_list_grid_class();
                    $css[] = 'upsell-product-layout-'.get_theme_mod('sparklestore_pro_woo_single_product_upsell_style', 'grid');
                    $css[] = 'related-product-layout-'.get_theme_mod('sparklestore_pro_woo_single_product_related_style', 'grid');

                    $data = "related-column=". get_theme_mod('sparklestore_pro_woo_single_product_related_column', 4);
                    $data .= " upsell-column=". get_theme_mod('sparklestore_pro_woo_single_product_upsell_column', 4);
                ?>

                <div id="primary" class="content-area <?php echo implode(' ', $css); ?>" <?php echo $data; ?>>

                    <main id="main" class="site-main" role="main">

				<?php
	}
}
add_action( 'woocommerce_before_main_content', 'sparklestore_pro_woocommerce_wrapper_before' );

if ( ! function_exists( 'sparklestore_pro_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function sparklestore_pro_woocommerce_wrapper_after() {
            
            $product_sidebar =  get_theme_mod( 'sparklestore_pro_woo_category_settings_section','rightsidebar' );

            if( is_singular('product') ) {

                $product_sidebar =  get_theme_mod( 'sparklestore_pro_woo_product_page_layout','fullwidth' );
            
            }elseif( is_shop() || is_product_category() || is_product_tag() ){

                $product_sidebar =  get_theme_mod( 'sparklestore_pro_catelog_layout','rightsidebar' );
            }

        ?>
                    </main>
                </div>

				<?php  if( $product_sidebar == 'rightsidebar') get_sidebar(); ?>
		    </div>
		</div>

		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'sparklestore_pro_woocommerce_wrapper_after' );


/********
 * Category List Title
 */
remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
function sparklestore_pro_template_loop_category_title( $category ) { 
    ?> 
    <div class="products-cat-info">
        <h3 class="woocommerce-loop-category__title">
            <?php 
                echo $category->name; 
    
                if ( $category->count > 0 ) 
                    echo apply_filters( 'woocommerce_subcategory_count_html', ' <span class="count">' . $category->count . ' '.esc_html__('Products','sparklestore-pro').'</span>', $category ); 
            ?> 
        </h3> 
    </div>
    <?php 
} 
add_action( 'woocommerce_shop_loop_subcategory_title', 'sparklestore_pro_template_loop_category_title', 10 );

/**
 * Remove Default Sidebar
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

/**
 * Remove Before & After Product Linbk
 */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

function sparklestore_pro_woocommerce_template_loop_product_thumbnail(){ 
    $icon_hover_style = get_theme_mod('sparklestore_pro_woo_product_hover_icon_position', 'left');
    ?>

    <div class="product_wrapper">

        <div class="content-product-imagin"></div>

        <div class="store_products_item">
            <div class="store_products_item_body">
                <?php
                    global $post, $product, $product_label_custom; 

                    $sale_class = '';
                    if( $product->is_on_sale() == 1 ){
                        $sale_class = 'new_sale';
                    }
                ?>
                <div class="flash <?php echo esc_attr( $sale_class ); ?>">

                    <?php sparklestore_pro_sale_percentage_loop(); ?>

                    <?php 
                        
                            
                        if( get_theme_mod('sparklestore_pro_catelog_enable_new_tag', true)):
                            $newness_days = 7;
                            $created = strtotime( $product->get_date_created() );
                            if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
                                sparklestore_pro_flash_sale_new_tag();
                            }
                        endif;
                        

                        if ( $product->is_on_sale() && get_theme_mod('sparklestore_pro_catelog_enable_sales_tag', true) ) :

                            echo apply_filters( 'woocommerce_sale_flash', sparklestore_pro_flash_sale_tag(), $post, $product );
                        
                        endif;
                    ?>
                </div>

                <a href="<?php the_permalink(); ?>" class="store_product_item_link">
                    <?php 
                    if(has_post_thumbnail(  ) ): 
                        the_post_thumbnail('woocommerce_thumbnail'); #Products Thumbnail 
                    else:
                        $img = get_store_default_image();
                        echo "<img src='". $img."' />";
                    endif;
                    ?>
                </a>
                
                <?php if( function_exists( 'sparklestore_pro_quickview' ) || function_exists( 'sparklestore_pro_add_compare_link' ) || function_exists( 'sparklestore_pro_wishlist_products' ) ){ ?>
                    
                    <div class="store_products_items_info position-<?php echo esc_attr($icon_hover_style); ?> hoverstyletwo">
                        <?php 
                            $producthoverstyle = get_theme_mod('sparklestore_pro_woo_product_hover_style', 'style1');
                            
                            if( !empty( $producthoverstyle ) && $producthoverstyle == 'style4' ){ 
                        ?>
                            <div class="products_item_info"> 
                                <?php
                                    /**
                                     * woocommerce_template_loop_add_to_cart
                                    */
                                    woocommerce_template_loop_add_to_cart();
                                ?>
                            </div>
                        <?php } ?>
                        
                        <?php if(function_exists( 'sparklestore_pro_quickview' )) { ?>
                            <div class="products_item_info">
                                <?php  sparklestore_pro_quickview(); ?>
                            </div>
                        <?php } ?>

                        <?php if(function_exists( 'sparklestore_pro_add_compare_link' )) { ?>
                            <div class="products_item_info">
                                <?php  sparklestore_pro_add_compare_link(); ?>
                            </div>
                        <?php } ?>

                        <?php if(function_exists( 'sparklestore_pro_wishlist_products' )) { ?>
                            <div class="products_item_info">
                                <?php  sparklestore_pro_wishlist_products(); ?>
                            </div>
                        <?php } ?>
                    </div>

                <?php } ?>

            </div>
        </div>

  	<?php 
}
add_action( 'woocommerce_before_shop_loop_item_title', 'sparklestore_pro_woocommerce_template_loop_product_thumbnail', 10 );

/**
 *  Hover Style Four
*/
$producthoverstyle = get_theme_mod('sparklestore_pro_woo_product_hover_style', 'style1');


if( !empty( $producthoverstyle ) && $producthoverstyle == 'style5' ){ 

    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    
    if(!function_exists('sparklestore_pro_add_compare_items_add_to_cart')){

        function sparklestore_pro_add_compare_items_add_to_cart(){
        
            if(function_exists( 'sparklestore_pro_add_compare_link' )) { ?>
                <div class="store_products_items_info hoverstyletwo">
                    <?php
                        /**
                         * woocommerce_template_loop_add_to_cart
                        */
                        woocommerce_template_loop_add_to_cart();
                    ?>
                    <div class="products_item_info">
                        <?php  sparklestore_pro_add_compare_link(); ?>
                    </div>
                    <div class="products_item_info">
                        <?php  sparklestore_pro_quickview(); ?>
                    </div>
                </div>
            <?php } 
        }
    }
    add_action( 'woocommerce_after_shop_loop_item', 'sparklestore_pro_add_compare_items_add_to_cart', 12 );
}

if(!function_exists('sparklestore_pro_flash_sale_new_tag')){

    function sparklestore_pro_flash_sale_new_tag(){

        $new_tag_text = get_theme_mod('sparklestore_pro_catelog_enable_new_tag_text', esc_html__( 'New!', 'sparklestore-pro' ));

        $color = get_theme_mod('sparklestore_pro_catelog_enable_new_tag_text_color', '#ffffff');
        $bg_color = get_theme_mod('sparklestore_pro_catelog_enable_new_tag_text_bg_color', '#009966');
        
        $style = "style='color: $color; background-color: $bg_color;'";

        echo '<span class="onnew" '.$style. ' ><span class="text">' . $new_tag_text . '</span></span>';
    }
}

if(!function_exists('sparklestore_pro_flash_sale_tag')){

    function sparklestore_pro_flash_sale_tag(){

        $new_tag_text = get_theme_mod('sparklestore_pro_catelog_enable_sales_tag_text', esc_html__( 'Sale!', 'sparklestore-pro' ));

        $color = get_theme_mod('sparklestore_pro_catelog_enable_sales_tag_text_color', '#ffffff');
        $bg_color = get_theme_mod('sparklestore_pro_catelog_enable_sales_tag_text_bg_color', '#f33c3c');
        
        $style = "style='color: $color; background-color: $bg_color;'";

        return '<span class="store_sale_label" '.$style. ' ><span class="text">' . $new_tag_text . '</span></span>';
    }
}

/******
 * Remove Default Title
 */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

if ( !function_exists('sparklestore_pro_woocommerce_shop_loop_item_title') ) {

    function sparklestore_pro_woocommerce_shop_loop_item_title(){ ?>

        <div class="store_products_item_details">
            <h3>
                <a class="store_products_title" href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
	          	</a>
          	</h3>
      <?php 
    }
}
add_action( 'woocommerce_shop_loop_item_title', 'sparklestore_pro_woocommerce_shop_loop_item_title', 8 );

/**
 * Price & Rating Wrap
*/
if (!function_exists('sparklestore_pro_woocommerce_before_rating_loop_price')) {

    function sparklestore_pro_woocommerce_before_rating_loop_price(){ ?>

    	<div class="price-rating-wrap"> 

      <?php 
    }
}
add_action( 'woocommerce_after_shop_loop_item_title', 'sparklestore_pro_woocommerce_before_rating_loop_price', 4 );

if (!function_exists('sparklestore_pro_woocommerce_after_rating_loop_price')) {

    function sparklestore_pro_woocommerce_after_rating_loop_price(){  ?>
        
        </div>
            <?php if( is_shop() || is_product_category() || is_product_tag() ) : ?> 
            <?php if( ! get_theme_mod('sparklestore_pro_show_product_description', false) && sparkletheme_get_products_list_grid_view() != 'list' ) return ; ?>
            <div class="sparklestore-more-desc sparklestore-more-effect">
                <div class="woocommerce-product-details__short-description">
                    <?php the_excerpt(); ?>
                </div>
                <a href="#" class="sparklestore-more-desc-btn"><span></span></a>
            </div>

      <?php 
      endif;
    }
}
add_action( 'woocommerce_after_shop_loop_item_title', 'sparklestore_pro_woocommerce_after_rating_loop_price', 12 );



if (!function_exists('sparklestore_pro_woocommerce_product_item_details_close')) {

    function sparklestore_pro_woocommerce_product_item_details_close(){ ?>

    	    </div>
    	</div>

      <?php 
    }
}
add_action( 'woocommerce_after_shop_loop_item', 'sparklestore_pro_woocommerce_product_item_details_close', 12 );



/**
 *  Default Breadcrumb & Product Next and Prev Menu
*/
if (!function_exists('sparklestore_pro_single_product_breadcrumb_and_product_nav')) {

    function sparklestore_pro_single_product_breadcrumb_and_product_nav(){ ?>

        <div class="single_product_breadcrumb_wrap">
            <?php
                /**
                 *  Default Breadcrumb
                */
                woocommerce_breadcrumb();

                /**
                 *  Product Next & Prev Nav
                 */
                if( get_theme_mod('sparklestore_pro_single_product_next_previous', true ) ):

                    sparkletheme_product_next_prev_nav();
    
                endif;
            ?>
        </div>
    <?php }
}
//add_action( 'woocommerce_single_product_summary', 'sparklestore_pro_single_product_breadcrumb_and_product_nav', 2 );


/**
 * Single Product Page Wrapper
*/
if (!function_exists('sparklestore_pro_woocommerce_before_single_product_summary')) {

    function sparklestore_pro_woocommerce_before_single_product_summary(){ 
        $slider_layout = get_theme_mod('sparklestore_pro_woo_product_gallery_layout', 'default');
        $gallery_width = get_theme_mod('sparklestore_pro_woo_product_gallery_width', '6-12');
        
        ?>
        <div class="product-summary-wrapper clearfix gallery-width-<?php echo esc_attr($gallery_width); ?> gallery-layout-<?php echo esc_attr($slider_layout); ?>">
        
        <?php if( get_theme_mod('sparklestore_pro_product_page_breadcrumb_position', 'inside') == 'outside'): ?>
        <div class="single_product_breadcrumb_wrap">
            <?php
                /**
                 *  Default Breadcrumb
                */
                if( get_theme_mod('sparklestore_pro_single_breadcrumb', true ) ):
                    
                    woocommerce_breadcrumb();
                
                endif;

                /**
                 *  Product Next & Prev Nav
                 */
                if( get_theme_mod('sparklestore_pro_single_product_next_previous', true ) ):

                    sparkletheme_product_next_prev_nav();
    
                endif;
            ?>
        </div>
        <?php endif; ?>

      <?php 
    }
}
add_action( 'woocommerce_before_single_product_summary', 'sparklestore_pro_woocommerce_before_single_product_summary', 9);



if (!function_exists('sparklestore_pro_woocommerce_after_single_product_summary')) {

    function sparklestore_pro_woocommerce_after_single_product_summary(){ ?>

    	</div>

      <?php 
    }
}
add_action( 'woocommerce_after_single_product_summary', 'sparklestore_pro_woocommerce_after_single_product_summary', 9 );


/** remove gallery images */
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

add_action('woocommerce_before_single_product_summary', 'sparklestore_pro_woocommerce_show_product_images', 20);
function sparklestore_pro_woocommerce_show_product_images(){
    wc_get_template( 'single-product/product-image.php' );    
}

/* 
 * Product Single Page
*/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

function sparklestore_pro_group_flash(){

    global $post, $product; ?>

	<div class="flash">
		<?php 

			sparklestore_pro_sale_percentage_loop(); 

		    $newness_days = 7;
            
            if( get_theme_mod('sparklestore_pro_catelog_enable_new_tag', true)):
                $created = strtotime( $product->get_date_created() );
                if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
                    sparklestore_pro_flash_sale_new_tag();
                }
            endif;

            if ( $product->is_on_sale() && get_theme_mod('sparklestore_pro_catelog_enable_sales_tag', true ) ) :

             	echo apply_filters( 'woocommerce_sale_flash', sparklestore_pro_flash_sale_tag(), $post, $product );
            
			endif;
        ?>
	</div>

	<?php 
}
add_action( 'woocommerce_single_product_summary','sparklestore_pro_group_flash', 10 );


function sparklestore_pro_single_disocunt(){
    
    if( !get_theme_mod('sparklestore_pro_woo_product_countdown_timer', true)) return;

    global $post, $product; 
    $product_id             = get_the_ID();
    $sale_price_dates_to    = ( $date = get_post_meta( $product_id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
    $price_sale             = get_post_meta( $product_id, '_sale_price', true );
    $date                   = date_create($sale_price_dates_to);
    $new_date               = date_format($date,"Y/m/d H:i");
    if(!empty( $sale_price_dates_to ) ) { if(!empty( $price_sale) ) {
?>
    <div class="pcountdown-single-page">
        <div class="pcountdown-timer">
            <ul class="countdown_<?php echo intval( $product_id ); ?>">
                <li><div class="time-days"><span class="days">00</span><span class="time"><?php esc_html_e('Days','sparklestore-pro'); ?></span></div></li>
                <li><div class="time-hours"><span class="hours">00</span><span class="time"><?php esc_html_e('Hours','sparklestore-pro'); ?></span></div></li>
                <li><div class="time-minutes"><span class="minutes">00</span><span class="time"><?php esc_html_e('Mins','sparklestore-pro'); ?></span></div></li>
                <li><div class="time-seconds"><span class="seconds">00</span><span class="time"><?php esc_html_e('Secs','sparklestore-pro'); ?></span></div></li>
            </ul>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            jQuery(".countdown_<?php echo intval( $product_id ); ?>").countdown({
                date: "<?php echo esc_attr( $new_date ); ?>",
                offset: -8,
                day: "Day",
                days: "Days"
            }, function () {
            //  alert("Done!");
            });
        });
    </script>
<?php } } 
}

add_action( 'woocommerce_single_product_summary','sparklestore_pro_single_disocunt', 10 );


/*****
 * Comment Overright
 */
if (!function_exists('sparklestore_pro_custom_ratting_single_product')) {
    function sparklestore_pro_custom_ratting_single_product(){
        global $product;
        if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
            return;
        }
        $rating_count = $product->get_rating_count();
        $average      = $product->get_average_rating();
        if ( $rating_count > 0 ) : ?>
            <div class="woocommerce-product-rating">
                <span class="star-rating">
                    <span style="width:<?php echo( ( intval($average) / 5 ) * 100 ); ?>%">
                        <?php printf(
                            wp_kses( '%1$s out of %2$s', 'sparklestore-pro' ),
                            '<strong class="rating">' . esc_html( $average ) . '</strong>',
                            '<span>5</span>'
                        ); ?>
                    </span>
                </span>

                <span>
                    <?php printf(
                        wp_kses( 'based on %s rating', 'Based on %s ratings', $rating_count, 'sparklestore-pro' ),
                        '<span class="rating">' . esc_html( $rating_count ) . '</span>'
                    ); ?>
                </span>

                <?php if ( comments_open() ) : ?>
                    <a href="#reviews" class="woocommerce-review-link" rel="nofollow">
                        <i class="fas fa-pencil-alt"></i>
                        <?php echo esc_html__( 'write a review', 'sparklestore-pro' ) ?>
                    </a>
                <?php endif ?>
            </div>
        <?php endif;
    }
}
add_action( 'woocommerce_single_product_summary', 'sparklestore_pro_custom_ratting_single_product', 5 );



/**
 * WooCommerce display related product.
*/
if (!function_exists('sparklestore_pro_related_products_args')) {
    function sparklestore_pro_related_products_args( $args ) {
        $args['columns']  = get_theme_mod('sparklestore_pro_woo_single_product_related_column', 4 );
        $args['posts_per_page']  = get_theme_mod('sparklestore_pro_woo_single_product_related_no_of_product', 8 );
        return $args;
    }
}
add_filter( 'woocommerce_output_related_products_args', 'sparklestore_pro_related_products_args' );



// Change Related Products Text
function sparklestore_pro_related_text_strings( $translated_text, $text, $domain ) {

    switch ( trim($translated_text) ) {

        case 'Related products' :

            $translated_text = get_theme_mod( 'sparklestore_pro_woo_single_product_related_title','Related products' );

            break;
            
        case 'You may also like&hellip;':
            
            $translated_text = get_theme_mod( 'sparklestore_pro_woo_single_product_upsell_title','Upsell products' );

            break;
    }

    return $translated_text;
}
add_filter( 'gettext', 'sparklestore_pro_related_text_strings', 20, 3 );


/**
 * WooCommerce display upsell product.
*/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
if ( ! function_exists( 'sparklestore_pro_woocommerce_upsell_display' ) ) {
  function sparklestore_pro_woocommerce_upsell_display() {
    if( !get_theme_mod('sparklestore_pro_enable_upsell_product', true)) return;
    
    $posts_per_page   = get_theme_mod( 'sparklestore_pro_woo_single_product_upsell_no_of_product', 8 );
	    
    $upsells_product_columns   = get_theme_mod( 'sparklestore_pro_woo_single_product_upsell_column', 4 );
    
    woocommerce_upsell_display( $posts_per_page, $upsells_product_columns ); 
  }
}
add_action( 'woocommerce_after_single_product_summary', 'sparklestore_pro_woocommerce_upsell_display', 15 );

/**
 * Outputs an extra tab to the default set of info tabs on the single product page.
*/
function sparklestore_pro_extra_tab_options_tab() { ?>
    <li class="custom_tab"><a href="#custom_tab_data"><?php esc_html_e('Extra Tab Options', 'sparklestore-pro'); ?></a></li>
<?php
}
add_action('woocommerce_product_write_panel_tabs', 'sparklestore_pro_extra_tab_options_tab'); 


/**
 * Provides the input fields and add/remove buttons for custom tabs on the single product page.
 */
function sparklestore_pro_tab_options() {
    global $post;   
    $sparklestore_pro_tab_options = array(
        'sparklestore_pro_extra_title'   => get_post_meta( $post->ID, 'sparklestore_pro_extra_tab_title', true ),
        'sparklestore_pro_extra_content' => get_post_meta( $post->ID, 'sparklestore_pro_extra_tab_content', true ),
    );
    
    ?>
    <div id="custom_tab_data" class="panel woocommerce_options_panel">
        <div class="options_group">
            <p class="form-field">
                <?php 
                    woocommerce_wp_checkbox( array( 'id' => 'sparklestore_pro_tab_enabled', 'label' => esc_html__('Enable Extra Tab ?', 'sparklestore-pro'),
                    'description' => esc_html__('Enable this option to enable the extra tab on the frontend.', 'sparklestore-pro') ) ); 
                ?>
            </p>
        </div>
        
        <div class="options_group sparklestore_pro_tab_options">                                              
            <p class="form-field">
                <label><?php esc_html_e('Extra Tab Title :', 'sparklestore-pro'); ?></label>
                <input class="short" type="text" name="sparklestore_pro_extra_tab_title" value="<?php echo esc_attr( $sparklestore_pro_tab_options['sparklestore_pro_extra_title'] ); ?>" placeholder="<?php esc_attr_e('Enter your extra tab title', 'sparklestore-pro'); ?>" />
            </p>

            <p class="form-field">
                <label><?php esc_html_e('Extra Tab Content Area :', 'sparklestore-pro'); ?></label>
            </p>
            <p class="extra_tab_options">
                <?php
                    $settings = array(
                        'text_area_name' => 'sparklestore_pro_extra_tab_content'
                    );
                    $id = 'sparklestore_pro_extra_tab_content';
                    wp_editor( $sparklestore_pro_tab_options['sparklestore_pro_extra_content'], $id, $settings ); 
                ?>
            </p>
        </div>  
    </div>
<?php
}
add_action('woocommerce_product_data_panels', 'sparklestore_pro_tab_options');


/**
 * Processes the custom tab options when a post is saved
 */
function sparklestore_pro_process_product_meta_extra_tab( $post_id ) {
    update_post_meta( $post_id, 'sparklestore_pro_tab_enabled', ( isset($_POST['sparklestore_pro_tab_enabled'] ) && $_POST['sparklestore_pro_tab_enabled'] ) ? 'yes' : 'no' );
    update_post_meta( $post_id, 'sparklestore_pro_extra_tab_title', $_POST['sparklestore_pro_extra_tab_title'] );
    update_post_meta( $post_id, 'sparklestore_pro_extra_tab_content', $_POST['sparklestore_pro_extra_tab_content'] );
}
add_action('woocommerce_process_product_meta', 'sparklestore_pro_process_product_meta_extra_tab');

/**
 * extra tab from customizer settigns
 */

add_filter( 'woocommerce_product_tabs', 'sparklestore_pro_woocommerce_product_extra_panel_from_customizer' );
function sparklestore_pro_woocommerce_product_extra_panel_from_customizer( $tabs ) {
    global $post;       
    $sparklestore_pro_tab_options = array(
        'enabled' => get_theme_mod('sparklestore_pro_woo_show_extra_tab', true),
        'sparklestore_pro_global_title'   => get_theme_mod('sparklestore_pro_woo_product_extra_tab_title')
    );

    if ( $sparklestore_pro_tab_options['enabled'] && $sparklestore_pro_tab_options['sparklestore_pro_global_title']){
        $tabs['global_tab'] = array(
            'title'     => $sparklestore_pro_tab_options['sparklestore_pro_global_title'],
            'priority'  => 50,
            'callback'  => 'sparklestore_pro_woocommerce_product_extra_panel_from_customizer_area'
        );
    }

    return $tabs;

}
function sparklestore_pro_woocommerce_product_extra_panel_from_customizer_area(){
    $sparklestore_pro_tab_options = array(
        'sparklestore_pro_extra_title'   => get_theme_mod('sparklestore_pro_woo_product_extra_tab_title'),
        'sparklestore_pro_extra_content' => get_theme_mod('sparklestore_pro_woo_product_extra_tab'),
    );
    //echo '<h2>'.esc_html( $sparklestore_pro_tab_options['sparklestore_pro_extra_title'] ).'</h2>';
    echo force_balance_tags($sparklestore_pro_tab_options['sparklestore_pro_extra_content'] );
}

/** 
 * Add extra tabs to front end product page 
*/
add_filter( 'woocommerce_product_tabs', 'sparklestore_pro_woocommerce_product_extra_panel' );
function sparklestore_pro_woocommerce_product_extra_panel( $tabs ) {
    global $post;       
    $sparklestore_pro_tab_options = array(
        'enabled' => get_post_meta( $post->ID, 'sparklestore_pro_tab_enabled', true),
        'sparklestore_pro_extra_title'   => get_post_meta($post->ID, 'sparklestore_pro_extra_tab_title', true)
    );

    if ( $sparklestore_pro_tab_options['enabled'] == 'yes' ){
        $tabs['test_tab'] = array(
            'title'     => $sparklestore_pro_tab_options['sparklestore_pro_extra_title'],
            'priority'  => 50,
            'callback'  => 'sparklestore_pro_woocommerce_product_extra_panel_area'
        );
    }

    return $tabs;

}

function sparklestore_pro_woocommerce_product_extra_panel_area() {

    global $post;

    $sparklestore_pro_tab_options = array(
        'sparklestore_pro_extra_title'   => get_post_meta($post->ID, 'sparklestore_pro_extra_tab_title', true),
        'sparklestore_pro_extra_content' => get_post_meta($post->ID, 'sparklestore_pro_extra_tab_content', true),
    );

    echo '<h2>'.esc_html( $sparklestore_pro_tab_options['sparklestore_pro_extra_title'] ).'</h2>';
    echo '<p>'.esc_html( $sparklestore_pro_tab_options['sparklestore_pro_extra_content'] ).'</p>';
    
}

/** 
 * single product page next previous product link
 */
if(!function_exists('sparkletheme_product_next_prev_nav')) {
    function sparkletheme_product_next_prev_nav($class = ''){ 

        $next_product = $previous_product = null;

        $next_post = get_next_post();
        $prev_post = get_previous_post();
        
        if( $next_post )
            $next_product = wc_get_product( $next_post->ID );
        
        if( $prev_post)
            $previous_product = wc_get_product( $prev_post->ID );

    ?>

        <div class="sparkle-products-nav">
            <div class="product-btn product-prev">
                <?php if( $previous_product ): ?>
                    <a href="<?php echo get_the_permalink( $prev_post->ID ); ?>"  rel="prev">
                        <i class="icofont-thin-left"></i>
                    </a>
                    
                    <div class="wrapper-short">
                        <div class="product-short">
                            <div class="product-short-image">
                                <a href="<?php echo get_the_permalink($prev_post->ID); ?>" class="store_product_item_link">
                                    <?php echo $previous_product->get_image(); #Products Thumbnail ?>
                                </a>
                            </div>
                            <div class="product-short-description"> 
                                <a href="<?php echo esc_url( get_the_permalink( $prev_post->ID ) ); ?>" class="product-title"> <?php esc_html($prev_post->post_title); ?> </a> 
                                <?php echo $previous_product->get_price_html() ;?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="sparkle-back-btn">
                <?php $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) ); ?>
                <a href="<?php echo esc_url($shop_page_url); ?>">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve">
                        <path d="M7,2v5H2V2H7 M9,0H0v9h9V0L9,0z"></path>
                        <path d="M17,2v5h-5V2H17 M19,0h-9v9h9V0L19,0z"></path>
                        <path d="M7,12v5H2v-5H7 M9,10H0v9h9V10L9,10z"></path>
                        <path d="M17,12v5h-5v-5H17 M19,10h-9v9h9V10L19,10z"></path>
                    </svg>
                </a>    
            </div>

            <div class="product-btn product-next">
                <?php if( $next_product ): ?>
                <a href="<?php echo get_the_permalink( $next_post->ID ); ?>"  rel="next">
                    <i class="icofont-thin-right"></i>
                </a>
                <div class="wrapper-short">
                    <div class="product-short">
                        <div class="product-short-image">
                            <a href="<?php echo get_the_permalink( $next_post->ID ); ?>" class="store_product_item_link">
                                <?php echo $next_product->get_image(); #Products Thumbnail ?>
                            </a>
                        </div>
                        <div class="product-short-description"> 
                            <a href="<?php echo esc_url( get_the_permalink( $next_post->ID ) ); ?>" class="product-title"> <?php esc_html($next_post->post_title); ?> </a> 
                            <?php echo $next_product->get_price_html() ;?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
    <?php }
}  




/** product page filter */
/**
 * Hook: woocommerce_before_shop_loop.
 *
 * @hooked woocommerce_output_all_notices - 10
 * @hooked woocommerce_result_count - 20
 * @hooked woocommerce_catalog_ordering - 30
 * do_action( 'woocommerce_before_shop_loop' );
 */

/**
 * Result Count & Pagination Wrap
*/
if (!function_exists('sparklestore_pro_woocommerce_before_catalog_ordering')) {

    function sparklestore_pro_woocommerce_before_catalog_ordering(){ ?>

    	<div class="shop-before-control">

      <?php 
    }
}
add_action( 'woocommerce_before_shop_loop', 'sparklestore_pro_woocommerce_before_catalog_ordering', 15);

if (!function_exists('sparklestore_pro_woocommerce_after_catalog_ordering')) {

    function sparklestore_pro_woocommerce_after_catalog_ordering(){ ?>

    	</div>

      <?php 
    }
}
add_action( 'woocommerce_before_shop_loop', 'sparklestore_pro_woocommerce_after_catalog_ordering', 31 );


if( !function_exists('sparklestore_pro_product_listing_style')){

    function sparklestore_pro_product_listing_style(){

        wc_get_template_part( 'product-listing-style' );

    }
}
add_action( 'woocommerce_before_shop_loop', 'sparklestore_pro_product_listing_style',  25);

/**
 * hidden sidebar
 */
if( !function_exists('sparklestore_pro_product_hidden_sidebar_action_btn')){

    function sparklestore_pro_product_hidden_sidebar_action_btn(){ 
        if(get_theme_mod('sparklestore_pro_catelog_layout', 'rightsidebar') != 'fullwidth-sidebar' ) return;
        ?>
        
        <div class="sparkle-show-sidebar-btn" data-toggle-target=".sidebar-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle"> 
            <div class="sparkle-side-bar-icon">
                <svg version="1.1" id="list-view" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15" height="15" viewBox="0 0 18 18" enable-background="new 0 0 18 18" xml:space="preserve">
                <rect width="18" height="2"></rect>
                <rect y="16" width="18" height="2"></rect>
                <rect y="8" width="18" height="2"></rect>
                </svg>
                <span><?php _e('Show sidebar', 'sparklestore-pro'); ?></span>
            </div> 
            
        </div>    

        <?php
    
        // include sidebar widget as nav
        function sparklestore_pro_hidden_sideabar_content(){
        
            get_template_part('template-parts/hidden', 'sidebar');
        }
        add_action('wp_footer', 'sparklestore_pro_hidden_sideabar_content');


    }


}
add_action( 'woocommerce_before_shop_loop', 'sparklestore_pro_product_hidden_sidebar_action_btn',  15);




/**
 * Woo Commerce Number of row filter Function
*/
add_filter('loop_shop_columns', 'sparklestore_pro_loop_columns');
if (!function_exists('sparklestore_pro_loop_columns')) {
    function sparklestore_pro_loop_columns() {
        return sparkletheme_get_products_per_row();
    }
}

add_filter( 'loop_shop_per_page', 'sparklestore_loop_shop_per_page', 20 );
function sparklestore_loop_shop_per_page( $cols ) {
    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
    return sparkletheme_get_products_per_page();
}

// **********************************************************************//
// ! Get Items per page number on the shop page
// **********************************************************************//
if( ! function_exists( 'sparkletheme_get_products_per_page' ) ) {
	function sparkletheme_get_products_per_page() {
        
		if( ! class_exists('WC_Session_Handler') ) return;
        $s = WC()->session; // WC()->session
        
		if ( is_null( $s ) ) return sparklestore_pro_default_product_per_page();
		
        if ( isset( $_REQUEST['per_page'] ) && ! empty( $_REQUEST['per_page'] ) ) :
            $val = $s->__set( 'shop_per_page',  $_REQUEST['per_page'] );
			return intval( $_REQUEST['per_page'] );
		elseif ( $s->__isset( 'shop_per_page' ) ) :
			$val = $s->__get( 'shop_per_page' );
			if( ! empty( $val ) )
				return intval( $s->__get( 'shop_per_page' ) );
		endif;
		return sparklestore_pro_default_product_per_page();
	}
}


if( ! function_exists( 'sparkletheme_get_products_per_row' ) ) {
	function sparkletheme_get_products_per_row() {
        
		if( ! class_exists('WC_Session_Handler') ) return;
        $s = WC()->session; // WC()->session
        
		if ( is_null( $s ) ) return sparklestore_pro_default_product_per_row();
		
        if ( isset( $_REQUEST['per_row'] ) && ! empty( $_REQUEST['per_row'] ) ) :
            $val = $s->__set( 'shop_per_row',  $_REQUEST['per_row'] );
			return intval( $_REQUEST['per_row'] );
		elseif ( $s->__isset( 'shop_per_row' ) ) :
			$val = $s->__get( 'shop_per_row' );
			if( ! empty( $val ) )
				return intval( $s->__get( 'shop_per_row' ) );
		endif;
		return sparklestore_pro_default_product_per_row();
	}
}


if( ! function_exists( 'sparkletheme_get_products_list_grid_view' ) ) {
	function sparkletheme_get_products_list_grid_view() {
        
		if( ! class_exists('WC_Session_Handler') ) return;
        $s = WC()->session; // WC()->session
        
		if ( is_null( $s ) ) return sparkle_get_product_list_grid_default_class();
		
        if ( isset( $_REQUEST['shop_view'] ) && ! empty( $_REQUEST['shop_view'] ) ) :
            $val = $s->__set( 'shop_shop_view',  $_REQUEST['shop_view'] );
			return $_REQUEST['shop_view'];
		elseif ( $s->__isset( 'shop_shop_view' ) ) :
			$val = $s->__get( 'shop_shop_view' );
			if( ! empty( $val ) )
				return $s->__get( 'shop_shop_view' );
		endif;
		return sparkle_get_product_list_grid_default_class();
	}
}

function sparklestore_pro_default_product_per_page($option = false){
    return get_theme_mod('sparklestore_pro_catelog_per_page', 12);
}

function sparklestore_pro_default_product_per_row(){
    return get_theme_mod('woocommerce_catalog_rows', 3);
}

function sparkle_get_product_list_grid_default_class(){
    $style = get_theme_mod('sparklestore_pro_catelog_list_style');
    return $style;
}

function sparkle_get_product_list_grid_class(){
    $style = sparkletheme_get_products_list_grid_view();
    return 'shop-product-'. $style;
}

/** hide product price */
if( get_theme_mod('sparklestore_pro_hide_price', false)){
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
}

/** hide rating */
if( get_theme_mod('sparklestore_pro_hide_rating', false)){
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
}

if( !get_theme_mod('sparklestore_pro_enable_related_product', true)){
    /**
     * Remove related products output
     */
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}

/**
 * woocommerce pagination type
 */
$woo_pagination_type = get_theme_mod('sparklestore_pro_pagination_style', 'normal');
if( $woo_pagination_type != 'normal'){
    remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
    add_action( 'woocommerce_after_shop_loop', 'sparklestore_woocommerce_pagination', 10 );

    if( !function_exists('sparklestore_woocommerce_pagination')){
        function sparklestore_woocommerce_pagination(){
            ?>
            <div class="woocommerce-pagination-preloader" style="display:none">
                <?php
                    $preloader_type     = get_theme_mod('sparklestore_pro_preloader', 'preloader15');
                    $preloader_image    = get_theme_mod('sparkle_store_pro_preloader_image', 'off');

                    if ($preloader_type != 'custom') {
                        get_template_part('inc/preloader/' . $preloader_type);
                    } else {
                        echo '<img src="' . esc_url($preloader_image) . '" alt="Preloader"/>';
                    }
                    
                ?>
            </div>
            
            <?php if( get_next_posts_link() ): ?>
                <div class="sp-woo-load-more">
                    <?php esc_html_e('Load More', 'sparklestore-pro'); ?>
                </div>
            <?php endif; ?>
                
            <div class="woo-pagination-wrapper hidden">
                <div class="nav-previous alignleft"><?php previous_posts_link( 'Older posts' ); ?></div>
                <div class="nav-next alignright"><?php next_posts_link( 'Newer posts' ); ?></div>
            </div>

            <?php
        }
    }
}