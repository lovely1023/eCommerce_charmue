<?php
/**
 * StparkleStore Blog.
 *
 * @package    SparkleThemes
 * @subpackage SparkleStore
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	return; // Exit if it is accessed directly
}

class Sparklestore_Category_Products extends Widget_Base{

	/**
	 * Retrieve Sparklestore_Category_Products widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'sparklestore-category-products';
	}

	/**
	 * Retrieve Sparklestore_Category_Products widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( '&#9733;Category With Product', 'sparklestore-pro' );
	}

	/**
	 * Retrieve Sparklestore_Category_Products widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-products';
	}

	/**
	 * Retrieve the list of categories the Sparklestore_Category_Products widget belongs to.
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

		//blog category.
		$this->add_control(
			'category',
			[
				'label' => __( 'Select Category', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => false,
				'options' => sparkle_woocommerce_category(),
			]
		);

		$this->add_control(
			'image_alignment',
			[
				'label' => __( 'Image Alignment', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'multiple' => false,
				'default'     => 'rightalign',
				'options' => array(
					'rightalign' => esc_html__('Right Align Category Image', 'sparklestore-pro'),
					'leftalign' => esc_html__('Left Align Category Image', 'sparklestore-pro'),
				),
			]
		);

		

		$this->add_control(
			'no_of_post',
			[
				'label' => __( 'No of Product', 'sparklestore-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				'default' => [
					'size' => 10,
				]
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
		
		/**
         * wp query for first block
		*/ 
		$settings       = $this->get_settings_for_display();
		$title     		= $settings['title'];
		$sub_title  	= $settings['subtitle'];
		$titlestyle     = $settings['title_style'];

        $cat_aligment   = $settings['image_alignment'];
		$product_category = $settings['category'] ? $settings['category'] : array();
		$product_number   = empty( $settings['no_of_post']['size'] ) ? 5 : $settings['no_of_post']['size'];
		
		if( !empty( $product_category ) ){
		  $cat_id = get_term($product_category,'product_cat');
		  
          $category_id = $cat_id->term_id;
          $category_link = get_term_link( $category_id,'product_cat' );
        }
        else{
          $category_link = get_permalink( wc_get_page_id( 'shop' ) );
		}
		
		$css = array();
        $css[] = 'categorproducts section-wrap grid';
        $css[] = 'product-hover-'.get_theme_mod('sparklestore_pro_woo_product_hover_style', 'style1'); 
        $css[] = esc_attr( $cat_aligment );

   ?>

	<div class="<?php echo implode(' ', $css); ?>">
		<div class="container">                
			<div class="section-content">
				
				<?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>
				

				<div class="categorproducts-inner">
					<div class="homeblockinner"> 
						<?php 
							$taxonomy = 'product_cat';                                
							$terms = term_description( $product_category, $taxonomy );
							$terms_name = get_term( $product_category, $taxonomy );
							$thumbnail_id = get_term_meta( $product_category, 'thumbnail_id', true);
							$image = wp_get_attachment_image_src($thumbnail_id, 'full');
						?>
						<div class="catblockwrap">
							<figure class="catblockimage cover-image" style="background-image: url(<?php echo esc_url( $image[0] ); ?>); height: 856px;"></figure>
							<div class="catblock-title-wrap">
								<?php if( !empty( $terms_name->name ) ) { ?>
									<h2><?php echo esc_html( $terms_name->name ); ?></h2>
								<?php } ?>
								<a class="btn btn-primary" href="<?php echo esc_url($category_link); ?>">
									<?php esc_html_e('View Collection','sparklestore-pro'); ?>
								</a>                   
							</div>
						</div>                        
					</div>               

					<div class="singlecat-product-wrap">
						<ul class="storeproductlist gird-2">                       
							<?php 
								$product_args = array(
									'post_type' => 'product',
									'tax_query' => array(
										array(
											'taxonomy'  => 'product_cat',
											'field'     => 'id', 
											'terms'     => $product_category                                                                 
										)),
									'posts_per_page' => $product_number
								);
								$query = new \WP_Query($product_args);

								if( $query->have_posts() ) { while( $query->have_posts() ) { $query->the_post();
							?>
								<?php wc_get_template_part( 'content', 'product' ); ?>
								
							<?php } } wp_reset_postdata(); ?>                          
						</ul>
					</div>                    
				</div>
			</div>        
		</div>

		
	</div>
	<?php 
		$bottom_seprator = $settings['bottom_seprator'];
		if( $bottom_seprator ) sparklestore_pro_add_bottom_seperator($bottom_seprator); 
	?>      
		
		
	<?php
	}



}