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

class Sparklestore_Category extends Widget_Base{

	/**
	 * Retrieve Sparklestore_Category widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'sparklestore-category';
	}

	/**
	 * Retrieve Sparklestore_Category widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( '&#9733;Category Collection', 'sparklestore-pro' );
	}

	/**
	 * Retrieve Sparklestore_Category widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-gallery-justified';
	}

	/**
	 * Retrieve the list of categories the Sparklestore_Category widget belongs to.
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
				'label' => __( 'Select Category :', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => sparkle_woocommerce_category(),
			]
		);

		//blog style.
		$this->add_control(
			'style',
			[
				'label' => __( 'Select Style', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => false,
				'default'     => 'category-style-1',
				'options' => array(
                    'category-style-1' => __('Category Style One', 'sparklestore-pro'),
                    'category-style-2' => __('Category Style Two', 'sparklestore-pro'),
                    'category-style-3' => __('Category Style Three', 'sparklestore-pro'),
                    'category-style-4' => __('Category Style Four', 'sparklestore-pro'),
                )
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
				'default'     => 'grid',
				'options' => array(
                    'grid' => __('Grid', 'sparklestore-pro'),
                    'slider' => __('Slider', 'sparklestore-pro')
                )
			]
		);
		//column.
		$this->add_control(
			'column',
			[
				'label' => __( 'Column', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'multiple' => false,
				'default'     => '3',
				'options' => array(
                    '1' => __('1 Column', 'sparklestore-pro'),
                    '2' => __('2 Column', 'sparklestore-pro'),
                    '3' => __('3 Column', 'sparklestore-pro'),
                    '4' => __('4 Column', 'sparklestore-pro')
                )
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
		$sparklestore_pro_cat_id = $settings['category']  ? $settings['category'] : array();

		$column_number    	= $settings['column'];
		$layout    			= $settings['view'];
		$view_style			= $settings['style'];
		
    ?>
        <div class="categoryarea section-wrap <?php echo esc_attr( $layout ); ?>">
            <div class="container">               
                <div class="section-content">                    
                    
					<?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>
                    

                    <ul class="storeproductlist gird-<?php echo esc_attr( $column_number ); ?> <?php if($layout == 'slider'){ echo esc_attr('storeslider owl-carousel'); } ?>" data-column="<?php echo esc_attr( $column_number ); ?>" data-style="<?php echo esc_attr( $layout ); ?>">
                        <?php
                            $count = 0; 
                            if(!empty( $sparklestore_pro_cat_id ) ){
                                
                                foreach ($sparklestore_pro_cat_id as $key) {          
                                    $thumbnail_id = get_term_meta( $key, 'thumbnail_id', true );
                                    if($thumbnail_id){
                                        $images = wp_get_attachment_url( $thumbnail_id );
                                        $image = wp_get_attachment_image_src($thumbnail_id, 'woocommerce_single', true);
                                    }else {
                                        $image[0] = get_store_default_image();
                                    }
									$term = get_term_by( 'id', $key, 'product_cat');
									if( !$term ) continue;
                                    $term_link = get_term_link($term);
                                    $term_name = $term->name;
                                    $sub_count =  apply_filters( 'woocommerce_subcategory_count_html', ' ' . $term->count . ' '.esc_html__('Products','sparklestore-pro').'', $term);
                                
                        ?>
                            <li class="product-category product <?php echo esc_attr( $view_style ); ?>">
                                <div class="product-wrapper">
                                    <a href="<?php echo esc_url($term_link); ?>">
                                        <div class="products-cat-wrap">
                                            <div class="products-cat-image">    
                                                <?php echo '<img class="categoryimage" src="' . esc_url( $image[0] ) . '" />'; ?>
                                            </div>
                                            <div class="products-cat-info">
                                                <?php if( !empty( $view_style ) && $view_style == 'category-style-3' ){ ?>
                                                    <ul>
                                                        <li>
                                                            <h3 class="woocommerce-loop-category__title">
                                                                <?php echo esc_html($term_name); ?>
                                                                <span class="count"><?php echo esc_html( $sub_count );  ?></span>
                                                            </h3>
                                                        </li>
                                                        <?php 
                                                            $parent_id = $key;
                                                            $termchildrens = get_terms('product_cat',array('child_of' => $parent_id));

                                                            foreach( $termchildrens as $termchildren ){

                                                                $termchild_link = get_term_link( $termchildren );
                                                        ?>
                                                            <li><a href="<?php echo esc_url( $termchild_link ); ?>"><?php echo esc_html( $termchildren->name ); ?></a></li>
                                                        
                                                        <?php } if( is_array( $termchildrens ) && count( $termchildrens ) ){ ?>
                                                            
                                                            <li><a class="products-cat-button" href="<?php echo esc_url($term_link); ?>"><?php esc_html_e('Show All','sparklestore-pro'); ?></a></li>
                                                        <?php } ?>
                                                    </ul>
                                                <?php }else{ ?>
                                                    <h3 class="woocommerce-loop-category__title">
                                                        <?php echo esc_html($term_name); ?>
                                                        <span class="count"><?php echo esc_html( $sub_count );  ?></span>
                                                    </h3>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </a>            
                                </div>         
                            </li>
                        <?php } }  ?>
                    </ul>
                </div>
            </div>
        </div>
		
		
	<?php
		$bottom_seprator = $settings['bottom_seprator'];
		if( $bottom_seprator ) sparklestore_pro_add_bottom_seperator($bottom_seprator); 
	}
}