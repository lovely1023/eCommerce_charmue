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

class Sparklestore_SingleHotOffer extends Widget_Base{

	/**
	 * Retrieve Sparklestore_WooTabProdcuts widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'sparklestore-woo-single-hot-offer';
	}

	/**
	 * Retrieve Sparklestore_WooTabProdcuts widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Single Product Offer', 'sparklestore-pro' );
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
        
        $params = array(
            'post_type'      => 'product',
            'posts_per_page' => 5,
            'meta_query'     => array(
                    array(
                        'key'           => '_sale_price_dates_to',
                        'value'         => 0,
                        'compare'       => '>',
                        'type'          => 'numeric'
                    )
                )
        );

        $all_product = get_posts( $params );
        $offter_deal = array();
        // $offter_deal[''] = esc_html__('Select Special Offter Product','sparklestore-pro');
        foreach ($all_product as $key => $value) {
            $offter_deal[$value->ID] = $value->post_title;
        }

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
				'label' => __( 'Hot Product Style', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => false,
				'options' => array(
                    'product-style-1' => esc_html__('Product Style 1', 'sparklestore-pro'),
                    'product-style-2' => esc_html__('Product Style 2', 'sparklestore-pro'),
                    'product-style-3' => esc_html__('Product Style 3', 'sparklestore-pro'),
                ),
				'default' => 'product-style-2'
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
			'image_alignment',
			[
				'label' => __( 'Image Alignment', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'multiple' => false,
				'default' => 'left',
				'options' => array(   
					"left" => esc_html__('Left','sparklestore-pro'),                 
					"right" => esc_html__('Right','sparklestore-pro'),                 
				)
			]
        );
        
        



        //woo category.
		$this->add_control(
			'deal_products',
			[
				'label' => __( 'Special Offer Product :', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $offter_deal,
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
		
        $display_style		= $settings['layout'];
        $alignment_image    = $settings['image_alignment'];
		
        $layout     		= $settings['view'];
        $single_hot_product = $settings['deal_products'] ? $settings['deal_products'] : array();
        
        $product_args = array(
            'post_type'  => 'product',
            'post__in'  => $single_hot_product
        );


        $wrap_class [] = 'image-alignment-'.$alignment_image;
        $wrap_class [] = 'display-'.$display_style;
   ?>
    <div class="widget">
    <div class="speicla-wrap section-wrap List <?php echo esc_attr( $layout ); ?> <?php echo implode(" ", $wrap_class); ?>">
            <div class="container">
                <div class="specialoffter-deal section-content">

                    
                    <?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>
                    
                    <div class="single-product-offer-wrap <?php if( $layout == 'slider' ) echo 'storeslider owl-carousel'; ?>" data-column="1" >  
                    <?php
                        $query = new \WP_Query( $product_args );
                        $count = 0;
                        if( $query->have_posts() ) { while( $query->have_posts() ) { $query->the_post();
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full');
                    ?>
                    
                        <div class="product offerproduct-wrapper singlecount-<?php echo intval( $query->post_count ); ?>" <?php if( $display_style == "product-style-2" ){ ?> style="background-image: url(<?php echo esc_url( $image[0] ); ?>); background-size: cover; background-position: center;"<?php } ?>>
                            <?php if( $display_style != "product-style-2" ){  ?>
                                <div class="offerproduct-inner-wrap">
                                    <div class="offerproduct-images">
                                        <a href="<?php the_permalink(); ?>" class="store_product_item_link">
                                            <?php the_post_thumbnail('full'); #Products Thumbnail ?>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php
                                $product_id = get_the_ID();
                                $sale_price_dates_to    = ( $date = get_post_meta( $product_id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
                                $price_sale = get_post_meta( $product_id, '_sale_price', true );
                                $date = date_create($sale_price_dates_to);
                                $new_date = date_format($date,"Y/m/d H:i");
                                
                                if(!empty( $sale_price_dates_to ) ) { if(!empty( $price_sale) ) {
                            ?>
                                 <?php if( $display_style == "product-style-1" ){  ?>
                                    <div class="pcountdown-cnt">
                                        <ul class="countdown countdown_<?php echo intval( $product_id ); ?>">
                                            <li><div class="time-clock"><i class="fa fa fa-clock-o"></i></div></li>
                                            <li><div class="time-days"><span class="days">00</span><span class="days_text"><?php esc_html_e('Days','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-hours"><span class="hours">00</span><span class="hours_text"><?php esc_html_e('Hours','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-minutes"><span class="minutes">00</span><span class="minutes_text"><?php esc_html_e('Mins','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-seconds"><span class="seconds">00</span><span class="seconds_text"><?php esc_html_e('Secs','sparklestore-pro'); ?></span></div></li>
                                        </ul>
                                    </div>
                                 <?php } ?>
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
                    
                            <div class="offerproduct-infowrap">
                                
                                <div class="blockitem-title">
                                    <?php
                                        global $product;
                                        
                                        $term = wp_get_post_terms( $product->get_id(),'product_cat',array( 'fields'=>'ids' ) );
                                        if(!empty( $term[0] )) {
                                            $procut_cat = get_term_by( 'id', $term[0], 'product_cat' );
                                            $category_link = get_term_link( $term[0], 'product_cat' );
                                        }
                                        
                                    ?>
                                    <span class="mini-title">
                                        <a href="<?php esc_url( $category_link ); ?>">
                                            <?php  echo esc_attr( $procut_cat->name ); ?>
                                        </a>
                                    </span>
                                    <h3>
                                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                </div>

                               
                                <?php if( $display_style == "product-style-2" ){  ?>
                                    
                                    <div class="offerwrap">
                                        <?php woocommerce_template_loop_price(); ?>
                                    </div>
                                    
                                    <div class="pcountdown-cnt">
                                        <ul class="countdown_<?php echo intval( $product_id ); ?> clearfix">
                                            <li><div class="time-days"><span class="days">00</span><span class="time"><?php esc_html_e('Days','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-hours"><span class="hours">00</span><span class="time"><?php esc_html_e('Hours','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-minutes"><span class="minutes">00</span><span class="time"><?php esc_html_e('Mins','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-seconds"><span class="seconds">00</span><span class="time"><?php esc_html_e('Secs','sparklestore-pro'); ?></span></div></li>
                                        </ul>
                                    </div>
                                <?php }elseif( $display_style == "product-style-3" ){ ?>

                                    <div class="pcountdown-cnt">
                                        <ul class="countdown_<?php echo intval( $product_id ); ?> clearfix">
                                            <li><div class="time-days"><span class="days">00</span><span class="time"><?php esc_html_e('Days','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-hours"><span class="hours">00</span><span class="time"><?php esc_html_e('Hours','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-minutes"><span class="minutes">00</span><span class="time"><?php esc_html_e('Mins','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-seconds"><span class="seconds">00</span><span class="time"><?php esc_html_e('Secs','sparklestore-pro'); ?></span></div></li>
                                        </ul>
                                    </div>

                                    <div class="offer-deal">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <div class="offerwrap">
                                        <?php woocommerce_template_loop_price(); ?>
                                    </div>

                                <?php }else{ ?>

                                    <div class="offer-deal">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <div class="offerwrap">
                                        <?php woocommerce_template_loop_price(); ?>
                                    </div>

                                <?php } ?>

                                <div class="productbutton-wrap clearfix">
                                    <?php woocommerce_template_loop_add_to_cart(); ?>
                                    <a class="villa-details add_to_cart_button button" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                        <?php esc_html_e('View Details','sparklestore-pro'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        

                    <?php $count++; } } wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
	   
        </div>
    
    <?php
		$bottom_seprator = $settings['bottom_seprator'];
		if( $bottom_seprator ) sparklestore_pro_add_bottom_seperator($bottom_seprator); 
        
	}



}