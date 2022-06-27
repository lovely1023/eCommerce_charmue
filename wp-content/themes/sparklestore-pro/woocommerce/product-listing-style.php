<?php 
    $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
?>

<div class="sparklestore-products-per-page">

    <span class="per-page-title"><?php esc_html_e('Show', 'sparklestore-pro'); ?></span>

        <?php
            global $wp_query;

            $per_page_options = get_theme_mod('per_page_options');

            $products_per_page_options = (!empty($per_page_options)) ? explode(',', $per_page_options) : array(12,24,36,-1);
        
            foreach( $products_per_page_options as $key => $value ) :
        ?>
            <a rel="nofollow" href="<?php echo add_query_arg('per_page', $value, $shop_page_url ); ?>" class="per-page-variation<?php echo sparkletheme_get_products_per_page() == $value ? ' current-variation' : ''; ?>">
                <span><?php
                    $text = '%s';
                    esc_html( printf( $text, $value == -1 ? esc_html__( 'All', 'sparklestore-pro' ) : $value ) );
                ?></span>
            </a>
            <span class="per-page-border"></span>
        <?php endforeach; ?>
</div>

<?php 
    $per_row = sparkletheme_get_products_per_row();
    $view = sparkletheme_get_products_list_grid_view();
?>
<div class="sparkle-products-shop-view products-view-grid_list">
    <a rel="nofollow" href="<?php echo esc_url($shop_page_url); ?>?shop_view=list" class="shop-view per-row-list <?php if( $view== 'list') echo 'current-variation'; ?>">
        <svg version="1.1" id="list-view" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18" height="18" viewBox="0 0 18 18" enable-background="new 0 0 18 18" xml:space="preserve">
            <rect width="18" height="2"></rect>
            <rect y="16" width="18" height="2"></rect>
            <rect y="8" width="18" height="2"></rect>
        </svg>
    </a>
    <a rel="nofollow" href="<?php echo esc_url($shop_page_url); ?>?per_row=2&amp;shop_view=grid" class="per-row-2 shop-view <?php if( $per_row == '2' and $view =='grid') echo 'current-variation'; ?>">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px" height="19px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve">
            <path d="M7,2v5H2V2H7 M9,0H0v9h9V0L9,0z"></path>
            <path d="M17,2v5h-5V2H17 M19,0h-9v9h9V0L19,0z"></path>
            <path d="M7,12v5H2v-5H7 M9,10H0v9h9V10L9,10z"></path>
            <path d="M17,12v5h-5v-5H17 M19,10h-9v9h9V10L19,10z"></path>
        </svg>
    </a>
    <a rel="nofollow" href="<?php echo esc_url($shop_page_url); ?>?per_row=3&amp;shop_view=grid" class="per-row-3 shop-view <?php if( $per_row == '3' and $view =='grid') echo 'current-variation'; ?>">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px" height="19px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve">
            <rect width="5" height="5"></rect>
            <rect x="7" width="5" height="5"></rect>
            <rect x="14" width="5" height="5"></rect>
            <rect y="7" width="5" height="5"></rect>
            <rect x="7" y="7" width="5" height="5"></rect>
            <rect x="14" y="7" width="5" height="5"></rect>
            <rect y="14" width="5" height="5"></rect>
            <rect x="7" y="14" width="5" height="5"></rect>
            <rect x="14" y="14" width="5" height="5"></rect>
        </svg>
    </a>
    <a rel="nofollow" href="<?php echo esc_url($shop_page_url); ?>?per_row=4&amp;shop_view=grid" class="per-row-4 shop-view <?php if( $per_row == '4' and $view =='grid') echo 'current-variation'; ?>">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px" height="19px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve">
            <rect width="4" height="4"></rect>
            <rect x="5" width="4" height="4"></rect>
            <rect x="10" width="4" height="4"></rect>
            <rect x="15" width="4" height="4"></rect>
            <rect y="5" width="4" height="4"></rect>
            <rect x="5" y="5" width="4" height="4"></rect>
            <rect x="10" y="5" width="4" height="4"></rect>
            <rect x="15" y="5" width="4" height="4"></rect>
            <rect y="15" width="4" height="4"></rect>
            <rect x="5" y="15" width="4" height="4"></rect>
            <rect x="10" y="15" width="4" height="4"></rect>
            <rect x="15" y="15" width="4" height="4"></rect>
            <rect y="10" width="4" height="4"></rect>
            <rect x="5" y="10" width="4" height="4"></rect>
            <rect x="10" y="10" width="4" height="4"></rect>
            <rect x="15" y="10" width="4" height="4"></rect>
        </svg>
    </a>
</div>