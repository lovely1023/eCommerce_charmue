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

class Sparklestore_WooProductType extends Widget_Base{

	/**
	 * Retrieve Sparklestore_WooTabProdcuts widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'sparklestore-woo-product-type';
	}

	/**
	 * Retrieve Sparklestore_WooTabProdcuts widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Woo Product Type', 'sparklestore-pro' );
	}

	/**
	 * Retrieve Sparklestore_WooTabProdcuts widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-post-list';
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

    function getQuery($product_type, $product_number = 5){
        if($product_type == 'latest_product'){
            $product_label_custom = esc_html__('New', 'sparklestore-pro');
            $product_args = array(
                'post_type' => 'product',
                'posts_per_page' => $product_number
            );
        }
        elseif($product_type == 'upsell_product'){
            $product_args = array(
                'post_type'         => 'product',
                'posts_per_page'    => 10,
                'meta_key'          => 'total_sales',
                'orderby'           => 'meta_value_num',
                'posts_per_page'    => $product_number
            );
        }
        elseif($product_type == 'feature_product'){
            $product_args = array(
                'post_type'        => 'product',  
                'tax_query' => array(
                      'relation' => 'AND',      
                  array(
                      'taxonomy' => 'product_visibility',
                      'field'    => 'name',
                      'terms'    => 'featured',
                      'operator' => 'IN'
                  )
                ), 
                'posts_per_page'   => $product_number   
            );
        }
        elseif($product_type == 'on_sale'){
            $product_args = array(
            'post_type'      => 'product',
            'meta_query'     => array(
                'relation' => 'OR',
                array( // Simple products type
                    'key'           => '_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                ),
                array( // Variable products type
                    'key'           => '_min_variation_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                )
            ));
        }

        return $product_args;
    }

    function getType(){
        return array(
            'latest_product' => esc_html__('Latest Product', 'sparklestore-pro'),
            'upsell_product' => esc_html__('UpSell Product', 'sparklestore-pro'),
            'feature_product' => esc_html__('Feature Product', 'sparklestore-pro'),
            'on_sale' => esc_html__('On Sale Product', 'sparklestore-pro'),
        );

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
			'product_type',
			[
				'label' => __( 'Product Type', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $this->getType(),
				'default' => 'category'
			]
        );
		$this->add_control(
			'tab_layout',
			[
				'label' => __( 'Tab Layout', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => false,
				'options' => array(
                    'tab_styleone' => __('Style One', 'sparklestore-pro'),
                    'tab_styletwo' => __('Style Two', 'sparklestore-pro'),
                    'tab_stylethree' => __('Style Three', 'sparklestore-pro'),
                ),
				'default' => 'tab_styleone'
			]
        );
		
		$this->add_control(
			'columns',
			[
				'label' => __( 'Columns', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
                'multiple' => false,
                'default' => 4,
				'options' => array(   
                    1 => esc_html__('One Column','sparklestore-pro'),                 
                    2 => esc_html__('Two Column','sparklestore-pro'),
                    3 => esc_html__('Three Column','sparklestore-pro'),
                    4 => esc_html__('Four Column','sparklestore-pro'),
                    5 => esc_html__('Five Column','sparklestore-pro'),
                    6 => esc_html__('Six Column','sparklestore-pro'),                    
                )
			]
        );
		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
                'multiple' => false,
                'default' => 'grid',
				'options' => array(                    
                    'slider' => esc_html__('Slider','sparklestore-pro'),
                    'grid' => esc_html__('Grid','sparklestore-pro')
                )
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
		$title     		= $settings['title'];
		$sub_title  	= $settings['subtitle'];
        $titlestyle     = $settings['title_style'];
        $tab_style      = $settings['tab_layout'];
		
        $column_number      = $settings['columns'];
        
        $layout     		= $settings['view'];
        
        $product_types       = $settings['product_type'];
        $product_number     = $settings['no_of_post']['size'];

		$css = array();
        $css[] = 'producttype-wrap section-wrap';
        $css[] = 'product-hover-'.get_theme_mod('sparklestore_pro_woo_product_hover_style', 'style1'); 
        $css[] = esc_attr( $layout );

   ?>

	<div class="<?php echo implode(' ', $css); ?>">           
        <div class="container">
            <div class="product-list-area section-content"> 

                <?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>

                <div class="sparkletabs tabsblockwrap <?php echo esc_attr( $tab_style ); ?> clearfix">
                    <?php if( count($product_types) != 1) : ?>
                        <ul class="sparkletablinks">
                            <?php
                                if(!empty($product_types)){
                                    foreach ($product_types as $key ) { ?>
                                        <li><a class="btn btn-primary" id="<?php echo esc_attr( $key); ?>" data-noajax="1" href="#<?php echo esc_attr( $key); ?>"><?php echo esc_html( $this->getType()[$key] ); ?></a></li>
                                    <?php }
                                }
                            ?>
                        </ul>
                    <?php endif; ?>
                </div>

                <div class="sparkletablinkscontent">
                    <div class="tabscontentwrap">
                        <div class="sparkletabproductarea">
                            <?php 
                            $count = 1;
                            if( $product_types )
                            foreach ($product_types as $key) : ?>
                                <ul id="<?php echo esc_attr($key); ?>" class="storeproductlist tabsproduct tab-content <?php echo esc_attr($key); ?> gird-<?php echo esc_attr( $column_number ); ?> <?php if($layout == 'slider'){ echo esc_attr('storeslider owl-carousel'); } ?>" data-column="<?php echo esc_attr( $column_number ); ?>" data-style="<?php echo esc_attr( $layout ); ?>" <?php if( $count != 1): ?> style="display:none" <?php endif; ?>>
                                    <?php $count++;
                                        $query = new \WP_Query($this->getQuery($key, $product_number));

                                        if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                    ?>
                                        <?php wc_get_template_part( 'content', 'product' ); ?>

                                    <?php } } wp_reset_postdata(); ?>
                                </ul>
                            <?php endforeach; ?>
                        </div>
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