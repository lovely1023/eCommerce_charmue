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

class Sparklestore_Blog extends Widget_Base{

	/**
	 * Retrieve Sparklestore_Blog widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'sparklestore-blog';
	}

	/**
	 * Retrieve Sparklestore_Blog widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Blogs', 'sparklestore-pro' );
	}

	/**
	 * Retrieve Sparklestore_Blog widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-masonry';
	}

	/**
	 * Retrieve the list of categories the Sparklestore_Blog widget belongs to.
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
			'blog_category',
			[
				'label' => __( 'Select Multiple Category:', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => sparklestore_categories(),
			]
		);

		
		$this->add_control(
			'no_of_post',
			[
				'label' => __( 'No of post', 'sparklestore-pro' ),
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

		$this->add_control(
			'columns',
			[
				'label' => __( 'No of Columns', 'sparklestore-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 4,
						'step' => 1,
					],
				],
				'default' => [
					'size' => 3,
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

		//title layout.
		$this->add_control(
			'block_display_layout',
			[
				'label'       => esc_html__( 'Blog Layouts', 'sparklestore-pro' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'default'     => 'normal',
				'options' => 
				[
					
					'slide' =>  esc_html__('Slide Layout', 'sparklestore-pro'),
					'normal' =>  esc_html__('Grid Layout', 'sparklestore-pro'),
					'masonry' =>  esc_html__('Masonry Layout', 'sparklestore-pro')
					
				],
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

		$blog_category  = $settings['blog_category'] ? $settings['blog_category'] : array(); 
		$blog_columns   = $settings['columns']['size'];
		$block_layout   = $settings['block_display_layout'];
		$no_of_post    	= $settings['no_of_post']['size'];

		$post_category = implode( ",", $blog_category );
        $post_category = explode( ',', $post_category );
		// print_r($block_layout); exit;
        $blogs_args = array(
            'post_type' => 'post',
            'tax_query' => array(
                array(
                    'taxonomy'  => 'category',
                    'field'     => 'term_id', 
                    'terms'     => $post_category                                                                 
                )
            ),
            'posts_per_page' => intval($no_of_post)
		);
		$blogs_posts = new \WP_Query( $blogs_args );

		$post_content_type 	= get_theme_mod( 'sparklestore_post_description_options', 'excerpt' );
		$blogreadmore_btn 	= get_theme_mod( 'sparklestore_blogtemplate_btn', 'Read More' );
		$text_align 		= get_theme_mod('sparklestore_post_description_text_alignment', 'center');

		$template_args = array(
			'post_content_type' => $post_content_type,
			'blogreadmore_btn' 	=> $blogreadmore_btn,
			'text_align'    	=> $text_align
		);
		?>
		<div class="widget">
			<div class="sparklestore-blogwrap section-wrap <?php echo esc_attr( $block_layout ); ?>" data-blogcolumn="<?php echo intval($blog_columns); ?>" data-layout="<?php echo esc_attr( $block_layout  ); ?>">
				<div class="container">
					<?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>
					
					<ul class="store_blog_wrap blogwrap<?php echo esc_attr( $blog_columns ); ?> <?php if($block_layout == 'slide'){ echo esc_attr('blogslider owl-carousel'); }elseif($block_layout == 'normal'){ echo esc_attr('blogspostlist'); }else{ echo esc_attr('sparklestore-masonry');  } ?>" data-column="<?php echo esc_attr( $blog_columns ); ?>" data-style="<?php echo esc_attr( $block_layout ); ?>">
						<?php
							if( $blogs_posts->have_posts() ) : while( $blogs_posts->have_posts() ) : $blogs_posts->the_post();
						?>
							<li class="articlesListing blog-grid">
								<?php get_template_part('template-parts/content', get_post_format(), $template_args); ?>
							</li>
						<?php endwhile; endif; wp_reset_postdata(); ?>
					</ul>
				</div>
				
				<?php 
					$bottom_seprator = $settings['bottom_seprator'];
					if( $bottom_seprator ) sparklestore_pro_add_bottom_seperator($bottom_seprator); 
				?>
				
			</div>
		</div>
		
		<?php
	}



}