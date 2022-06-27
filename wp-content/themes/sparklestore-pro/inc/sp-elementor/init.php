<?php 
/**
 * Load the SparkleStore Elementor widgets file and registers it
 */
if ( ! function_exists( 'sparklestore_widgets_registered' ) ) :

	/**
	 * Load and register the required Elementor widgets file
	 *
	 * @param $widgets_manager
	 *
	 * @since SparkleStore
	 */
	function sparklestore_widgets_registered( $widgets_manager ) {

		//  Load Elementor Featured Service
		require get_template_directory() . '/inc/sp-elementor/widgets/blog.php';
		require get_template_directory() . '/inc/sp-elementor/widgets/category.php';
		require get_template_directory() . '/inc/sp-elementor/widgets/category-products.php';
		require get_template_directory() . '/inc/sp-elementor/widgets/woo-category-tabs.php';
		require get_template_directory() . '/inc/sp-elementor/widgets/woo-hot-offer.php';
		require get_template_directory() . '/inc/sp-elementor/widgets/woo-single-product-offer.php';
		require get_template_directory() . '/inc/sp-elementor/widgets/woo-product-list.php';
		require get_template_directory() . '/inc/sp-elementor/widgets/woo-product-type.php';
		require get_template_directory() . '/inc/sp-elementor/widgets/fullpromo.php';
		
		//  Register Featured Service Widget
		$widgets_manager->register_widget_type( new \Elementor\Sparklestore_Blog() );
		$widgets_manager->register_widget_type( new \Elementor\Sparklestore_Category() );
		$widgets_manager->register_widget_type( new \Elementor\Sparklestore_Category_Products() );
		$widgets_manager->register_widget_type( new \Elementor\Sparklestore_WooTabProdcuts() );
		$widgets_manager->register_widget_type( new \Elementor\Sparklestore_HotOfferDeal() );
		$widgets_manager->register_widget_type( new \Elementor\Sparklestore_SingleHotOffer() );
		$widgets_manager->register_widget_type( new \Elementor\Sparklestore_WooProductList() );
		$widgets_manager->register_widget_type( new \Elementor\Sparklestore_WooProductType() );
		$widgets_manager->register_widget_type( new \Elementor\SparklestorePro_FullPromo() );
		

	}

endif;

add_action( 'elementor/widgets/widgets_registered', 'sparklestore_widgets_registered' );

if ( ! function_exists( 'sparklestore_elementor_category' ) ) :

	/**
	 * Add the Elementor category for use in SparkleStore widgets as seperator
	 *
	 * @since SparkleStore 1.0.6
	 */
	function sparklestore_elementor_category() {

		// Register widget block category for Elementor section
		\Elementor\Plugin::instance()->elements_manager->add_category( 'sparklestore-widget-blocks', array(
			'title' => esc_html__( 'Sparkle Store Widgets', 'sparklestore-pro' ),
		), 1 );
	}

endif;

add_action( 'elementor/init', 'sparklestore_elementor_category' );

/**
 * Return the values of all the Pages
 * present in the site
 *
 * @since SparkleStore
 */

if( !function_exists('sparklestore_pages')){
	function sparklestore_pages() {

		$output     = array();

		$pages = get_pages();

		foreach ( $pages as $page ) {

			$output[ $page->ID ] = $page->post_title;
		}

		return $output;
	}
}

/**
 * Return the values of all the categories of the posts
 * present in the site
 *
 * @return array of category ids and its respective names
 *
 * @since SparkleStore
 */
if( !function_exists('sparklestore_categories')){
	function sparklestore_categories() {
		$output     = array();
		$categories = get_categories();

		foreach ( $categories as $category ) {
			$output[ $category->term_id ] = $category->name;
		}

		return $output;
	}
}

if( !function_exists('sparkle_woocommerce_category')){
	function sparkle_woocommerce_category(){
		$taxonomy     = 'product_cat';
		$empty        = 1;
		$orderby      = 'name';  
		$show_count   = 0;      // 1 for yes, 0 for no
		$pad_counts   = 0;      // 1 for yes, 0 for no
		$hierarchical = 1;      // 1 for yes, 0 for no  
		$title        = '';  
		$empty        = 0;
		$args = array(
			'taxonomy'     => $taxonomy,
			'orderby'      => $orderby,
			'show_count'   => $show_count,
			'pad_counts'   => $pad_counts,
			'hierarchical' => $hierarchical,
			'title_li'     => $title,
			'hide_empty'   => $empty
		);

		$woocommerce_categories = array();
		$woocommerce_categories_obj = get_categories( $args );
		foreach( $woocommerce_categories_obj as $category ) {
			$woocommerce_categories[$category->term_id] = $category->name;
		}

		return $woocommerce_categories;
	}
}


if ( ! function_exists( 'sparklestore_elementor_scripts' ) ) {

    /**
     * Loads scripts on elementor editor
     *
     * @since SparkleStore
     */
    function sparklestore_elementor_scripts() {
        wp_enqueue_script('sparklestore-custom-elementor', get_template_directory_uri() . '/inc/sp-elementor/assets/custom-elementor.js', array( 'jquery' ) );
    }

}
add_action( 'elementor/frontend/after_enqueue_scripts', 'sparklestore_elementor_scripts' );