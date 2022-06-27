<?php
/**
 * StparkleStore Tabs Products.
 *
 * @package    SparkleThemes
 * @subpackage SparkleStore
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	return; // Exit if it is accessed directly
}

class Sparklestore_WooTabProdcuts extends Widget_Base{

	/**
	 * Retrieve Sparklestore_WooTabProdcuts widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'sparklestore-woo-tab-products';
	}

	/**
	 * Retrieve Sparklestore_WooTabProdcuts widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Woo Category Tabs', 'sparklestore-pro' );
	}

	/**
	 * Retrieve Sparklestore_WooTabProdcuts widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-product-tabs';
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
			'tab_position',
			[
				'label' => __( 'Tab Position', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => false,
				'options' => array(
					'top' => __('Top', 'sparklestore-pro'),
					'left' => __('Left', 'sparklestore-pro'),
					'left' => __('Right', 'sparklestore-pro')
				),
				'default' => 'top'
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


        //style.
		$this->add_control(
			'view',
			[
				'label' => __( 'Display View', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'multiple' => false,
				'default' => 'grid',
				'options' => array(
                    'grid' => __('Grid', 'sparklestore-pro'),
                    'slider' => __('Slider', 'sparklestore-pro')
                )
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
					4 => esc_html__('Four Column','sparklestore-pro'),
					5 => esc_html__('Five Column','sparklestore-pro'),
					6 => esc_html__('Six Column','sparklestore-pro'),                    
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
		
		$tab_position 	= $settings['tab_position'];
		$tab_style		= $settings['tab_layout'];
		
        $sparklestore_cat_id = $settings['category'] ? $settings['category'] : array();
        $product_number   	= $settings['no_of_products']['size'];
        $layout     		= $settings['view'];
		$column_number 		= $settings['column'];

		if(!empty( $sparklestore_cat_id )) {
           $first_cat_id =  $sparklestore_cat_id[0];
		}
		
		$css = array();
        $css[] = 'sparkletabsproductwrap section-wrap';
        $css[] = 'product-hover-'.get_theme_mod('sparklestore_pro_woo_product_hover_style', 'style1'); 
        $css[] = esc_attr( $layout );

   ?>

		<div class="<?php echo implode(' ', $css); ?>">
            <div class="container">
                <div class="section-content">

                    
					<?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>
                    
                    <div class="sparkletabs tabsblockwrap <?php echo esc_attr( $tab_style ); ?> clearfix">
                        <ul class="sparkletablinks <?php echo esc_attr($tab_position); ?>" data-noofporduct="<?php echo intval( $product_number ); ?>" data-column="<?php echo intval($column_number); ?>" data-layout="<?php echo esc_attr($layout); ?>">
                            <?php
                                if(!empty($sparklestore_cat_id)){
									$count = 0;
									foreach ($sparklestore_cat_id as $key) { $count++;
                                        if( $count == 1){
                                            $data_loaded = 1;
                                        }else{
                                            $data_loaded = 0;
                                        }

										$term = get_term_by( 'id', $key, 'product_cat');
										if( !$term ) continue;
                                    ?>
                                        <li data-loaded="<?php echo esc_attr( $data_loaded ); ?>"><a class="btn btn-primary" href="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
                                    <?php
                                }
                                }
                            ?>
                        </ul>
                        
                    </div>

                    <div class="sparkletablinkscontent">

                        <div class="preloader" style="display:none;">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/rhombus.gif">
                        </div>

                        <div class="tabscontentwrap">
                            <div class="sparkletabproductarea">
                                
                                <?php
                                    if(!empty($sparklestore_cat_id)):
                                        $count = 1;
                                        foreach ($sparklestore_cat_id as $key):

                                        $term = get_term_by( 'id', $key, 'product_cat');
                                        
                                        $hidden = 'hidden';
                                        
                                        if( $count == 1){
                                            $hidden = '';
                                            
                                        }

                                        ?>
                                        <ul id="<?php echo esc_attr( $term->slug ); ?>" class="storeproductlist gird-<?php echo esc_attr( $column_number ); ?> <?php echo esc_attr($hidden); ?> <?php if($layout == 'slider'){ echo esc_attr('storeslider owl-carousel'); } ?>" data-column="<?php echo esc_attr( $column_number ); ?>" data-style="<?php echo esc_attr( $layout ); ?>">
                                            
                                            <?php
                                                if( $count == 1):
                                                    $product_args = array(
                                                        'post_type' => 'product',
                                                        'tax_query' => array(
                                                            array(
                                                                'taxonomy'  => 'product_cat',
                                                                'field'     => 'term_id',
                                                                'terms'     => $first_cat_id
                                                            )),
                                                        'posts_per_page' => $product_number
                                                    );
                                                    $query = new \WP_Query($product_args);

                                                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                            ?>
                                                    <?php wc_get_template_part( 'content', 'product' ); ?>

                                            <?php } } wp_reset_postdata(); endif; $count++ ?>


                                        </ul>
                                    
                                        <?php
                                        endforeach;
                                    endif;
                                ?>

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