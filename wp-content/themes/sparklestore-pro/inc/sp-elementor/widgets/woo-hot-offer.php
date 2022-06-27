<?php
/**
 *
 * @package    SparkleThemes
 * @subpackage SparkleStore
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	return; // Exit if it is accessed directly
}

class Sparklestore_HotOfferDeal extends Widget_Base{

	/**
	 * Retrieve Sparklestore_WooTabProdcuts widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'sparklestore-woo-hot-offer';
	}

	/**
	 * Retrieve Sparklestore_WooTabProdcuts widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Hot Offer Deal', 'sparklestore-pro' );
	}

	/**
	 * Retrieve Sparklestore_WooTabProdcuts widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-product-stock';
	}

	/**
	 * Retrieve the list of categories the Sparklestore_WooTabProdcuts widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories(){
		return array( 'sparklestore-widget-blocks' );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'sparklestore-pro' ),
				
			]
		);

		//include title fields
		include get_template_directory() . '/inc/sp-elementor/widgets/title-fields.php';


		
		$this->add_control(
			'layout',
			[
				'label' => __( 'Offer Product Style', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => false,
				'options' => array(
                    'offer-style-1' => __('Offer Style One', 'sparklestore-pro'),
                    'offer-style-2' => __('Offer Style Two', 'sparklestore-pro'),
                    'offer-style-3' => __('Offer Style Three', 'sparklestore-pro'),
                    // 'offer-style-4' => __('Offer Style Four', 'sparklestore-pro'),
                ),
				'default' => 'offer-style-2'
			]
        );
        $this->add_control(
			'view',
			[
				'label' => __( 'View Layout', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'multiple' => false,
				'default' => 'grid',
				'options' => array(   
					"grid" => esc_html__('Grid','sparklestore-pro'),                 
					"slider" => esc_html__('Slider','sparklestore-pro'),                 
				)
			]
        );
        
        $this->add_control(
            'offer_text',
            [
                'label'     => esc_html__( 'Offer Text', 'sparklestore-pro' ),
                'description'     => esc_html__('This text only works for style four', 'sparklestore-pro'),
                'type'      => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );



        $this->add_control(
			'column',
			[
				'label' => __( 'Columns', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'multiple' => false,
				'default' => '3',
				'options' => array(   
					1 => esc_html__('One Column','sparklestore-pro'),                 
					2 => esc_html__('Two Column','sparklestore-pro'),
					3 => esc_html__('Three Column','sparklestore-pro'),
					4 => esc_html__('Four Column','sparklestore-pro')
				)
			]
		);

        //woo category.
		$this->add_control(
			'category',
			[
				'label' => __( 'Select Category :', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => sparkle_woocommerce_category(),
			]
		);

		$this->add_control(
			'no_of_products',
			[
				'label' => __( 'No of Product', 'sparklestore-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'size' => 10,
				],
			]
		);

		$this->end_controls_section();

		//section title style.
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'sparklestore-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//include style fields
		include get_template_directory() . '/inc/sp-elementor/widgets/style-fields.php';

		$this->end_controls_section();

		//include seprator fields
		include get_template_directory() . '/inc/sp-elementor/widgets/seprator-fields.php';
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings       = $this->get_settings_for_display();
		$title     		= $settings['title'];
		$sub_title  	= $settings['subtitle'];
		$titlestyle     = $settings['title_style'];
		
		$product_layout		= $settings['layout'];
		
        $sparklestore_cat_id = $settings['category'] ? $settings['category'] : array();
        $product_number   	= $settings['no_of_products']['size'];
        $layout     		= $settings['view'];
        $column_number 		= $settings['column'];
        $offer_text         = $settings['offer_text'];

		$product_args = array(
            'post_type' => 'product',
            'tax_query' => array(
                array('taxonomy'  => 'product_cat',
                    'field'     => 'term_id',
                    'terms'     => $sparklestore_cat_id,
                )
            ),
            'meta_query'     => array(
                array(
                    'key'           => '_sale_price_dates_to',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                )
            ),
            'posts_per_page' => $product_number
        );

		$css = array();
        $css[] = 'producttype-wrap product-deals section-wrap';
        $css[] = 'product-hover-'.get_theme_mod('sparklestore_pro_woo_product_hover_style', 'style1'); 
        $css[] = esc_attr( $layout );   
        $css[] = esc_attr( $product_layout );
    ?>
		<div class="widget">
        <div class="<?php echo implode(' ', $css); ?>">
            <div class="container">

                <div class="product-list-area section-content">

                    
					<?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>    

                    <!-- <ul class="productarea cS-hidden3"> -->
                    <ul class="storeproductlist gird-<?php echo esc_attr( $column_number ); ?> <?php if($layout == 'slider'){ echo esc_attr('storeslider owl-carousel'); } ?>" data-column="<?php echo esc_attr( $column_number ); ?>" data-style="<?php echo esc_attr( $layout ); ?>">
                        <?php
                            $query = new \WP_Query( $product_args );

                            if($query->have_posts()) {  while( $query->have_posts() ) { $query->the_post();
                        ?>
                            <li <?php post_class(); ?>>
                                <?php
                                    /**
                                     * woocommerce_before_shop_loop_item hook.
                                     *
                                     * @hooked woocommerce_template_loop_product_link_open - 10
                                     */
                                    do_action( 'woocommerce_before_shop_loop_item' );

                                    /**
                                     * woocommerce_before_shop_loop_item_title hook.
                                     *
                                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                                     */
                                    do_action( 'woocommerce_before_shop_loop_item_title' );
                                ?>
                                <?php
                                    $product_id = get_the_ID();
                                    $sale_price_dates_to    = ( $date = get_post_meta( $product_id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
                                    $price_sale = get_post_meta( $product_id, '_sale_price', true );
                                    $date = date_create($sale_price_dates_to);
                                    $new_date = date_format($date,"Y/m/d H:i");

                                    if(!empty( $sale_price_dates_to ) ) { if(!empty( $price_sale) ) {
                                ?>
                                    <div class="pcountdown-cnt-list-slider">
                                        <?php if( $product_layout != "offer-style-2" ){ ?>
                                            <?php if( $offer_text):
                                                echo wp_kses_post(wpautop($offer_text));
                                            endif; ?>
                                            
                                        <?php } ?>
                                        <ul class="countdown_<?php echo intval( $product_id ); ?> clearfix">
                                            <li><div class="time-days"><span class="days">00</span><span class="time"><?php esc_html_e('Days','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-hours"><span class="hours">00</span><span class="time"><?php esc_html_e('Hours','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-minutes"><span class="minutes">00</span><span class="time"><?php esc_html_e('Mins','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-seconds"><span class="seconds">00</span><span class="time"><?php esc_html_e('Secs','sparklestore-pro'); ?></span></div></li>
                                        </ul>
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
                                <?php } } ?>
                                <?php
                                    /**
                                     * woocommerce_shop_loop_item_title hook.
                                     *
                                     * @hooked woocommerce_template_loop_product_title - 10
                                     */
                                    do_action( 'woocommerce_shop_loop_item_title' );

                                    /**
                                     * woocommerce_after_shop_loop_item_title hook.
                                     *
                                     * @hooked woocommerce_template_loop_rating - 5
                                     * @hooked woocommerce_template_loop_price - 10
                                     */
                                    do_action( 'woocommerce_after_shop_loop_item_title' );

                                    /**
                                     * woocommerce_after_shop_loop_item hook.
                                     *
                                     * @hooked woocommerce_template_loop_product_link_close - 5
                                     * @hooked woocommerce_template_loop_add_to_cart - 10
                                     */
                                    do_action( 'woocommerce_after_shop_loop_item' );
                                ?>
                            </li>

                        <?php } } wp_reset_postdata(); ?>
                    </ul>
                </div>
            </div>
        </div><!-- End Product Slider -->
		</div>
	 
	<?php
		$bottom_seprator = $settings['bottom_seprator'];
		if( $bottom_seprator ) sparklestore_pro_add_bottom_seperator($bottom_seprator); 
        
	}



}