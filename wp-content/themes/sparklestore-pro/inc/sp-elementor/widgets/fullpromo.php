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

class SparklestorePro_FullPromo extends Widget_Base{

	/**
	 * Retrieve Sparklestore_WooTabProdcuts widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'sparklestore-pro-fullpromo';
	}

	/**
	 * Retrieve Sparklestore_WooTabProdcuts widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Full Promo Image/Video', 'sparklestore-pro' );
	}

	/**
	 * Retrieve Sparklestore_WooTabProdcuts widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'jetelements-icon-10';
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

		//Blog section title.
        $this->add_control(
            'title',
            [
                'label'     => esc_html__( 'Enter Title :', 'sparklestore-pro' ),
                'type'      => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        //Blog section subtitle.
        $this->add_control(
            'subtitle',
            [
                'label'     => esc_html__( 'Enter Short Description :', 'sparklestore-pro' ),
                'type'      => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );


		
		$this->add_control(
            'btn_text',
            [
                'label'     => esc_html__( 'Button Text', 'sparklestore-pro' ),
                'type'      => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
		$this->add_control(
            'btn_link',
            [
                'label'     => esc_html__( 'Button Link', 'sparklestore-pro' ),
                'type'      => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
		
		$this->add_control(
            'btn_text2',
            [
                'label'     => esc_html__( 'Second Button Text', 'sparklestore-pro' ),
                'type'      => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
		$this->add_control(
            'btn_link2',
            [
                'label'     => esc_html__( 'Second Button Link', 'sparklestore-pro' ),
                'type'      => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        
		$this->add_control(
            'banner_img',
            [
                'label'     => esc_html__( 'Promo Banner Img', 'sparklestore-pro' ),
                'type'      => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'bg_img',
            [
                'label'     => esc_html__( 'Background Image', 'sparklestore-pro' ),
                'type'      => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );


		$this->add_control(
            'bg_video',
            [
                'label'     => esc_html__( 'OR Background Video', 'sparklestore-pro' ),
                'type'      => Controls_Manager::TEXT,
                'description' => __('https://www.youtube.com/watch?v=yNAsk4Zw2p0. Add only yNAsk4Zw2p0', 'sparklestore-pro'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
			'show_info',
			[
				'label' => __( 'Show Information', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'sparklestore-pro' ),
				'label_off' => __( 'Hide', 'sparklestore-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        // $this->add_control(
		// 	'boxwidth',
		// 	[
		// 		'label' => __( 'Box Width', 'sparklestore-pro' ),
		// 		'type' => \Elementor\Controls_Manager::SWITCHER,
		// 		'label_on' => __( 'Show', 'sparklestore-pro' ),
		// 		'label_off' => __( 'Hide', 'sparklestore-pro' ),
		// 		'return_value' => 'yes',
		// 		'default' => 'no',
		// 	]
        // );
        

		$this->end_controls_section();

		//section title style.
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'sparklestore-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        // text_alignment
        $this->add_control(
			'text_alignment',
			[
				'label' => __( 'Text Alignment', 'sparklestore-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'multiple' => true,
				'options' => array(
                    'text-left' => esc_html__('Left', 'sparklestore-pro'),
                    'text-right' => esc_html__('Right', 'sparklestore-pro'),
                ),
                'default' => 'text-left'
			]
		);
		//include style fields
		
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
		$short_desc  	= $settings['subtitle'];
        $bg_video       = $settings['bg_video'];
        $promo_bg_image = $settings['bg_img']['url'];
        $boxwidth       = false; //$settings['boxwidth'];

        $promo_info = $settings['show_info'];
        $promo_banner_img = $settings['banner_img']['url'];
        $text_alignment = $settings['text_alignment'];

        $button_text       = $settings['btn_text'];
        $button_link       = $settings['btn_link'];

        $button_text_one       = $settings['btn_text2'];
        $button_link_one       = $settings['btn_link2'];
         
        if( $bg_video ):
            $video_data = 'data-property="{videoURL:\'' . $bg_video . '\', mobileFallbackImage:\'https://img.youtube.com/vi/' . $bg_video . '/maxresdefault.jpg\'}"';
        else: 
            $video_data = '';
        endif;

   ?>
        <div class="widget_sparklestore_pro_full_promo_pro_area">
        <div class="sp-normal-slider fullpromobanner">
            <?php if( $boxwidth ): ?>
                <div class='container'>
            <?php endif; ?>

            <div class="sp-section header-banner video-banner" <?php echo $video_data; ?>>

                    <?php if( $promo_bg_image && $bg_video == '' ) : ?>
                        <div class="banner-img">
                            <img src="<?php echo esc_url($promo_bg_image); ?>">
                        </div>
                    <?php endif; ?> 
                    
                <?php if( !$promo_info ): ?>
                    
                    <div class="container sparklestore-caption noanimation <?php if( empty( $promo_banner_img ) ) echo esc_attr('noimage ');  echo esc_attr($text_alignment); ?>">
                        <div class="banneritem-caption">
                            <?php if ( !empty( $title ) ) { ?>

                                <h2><?php echo esc_html( $title ); ?></h2>
                            <?php } ?>

                            <?php if ( !empty( $short_desc ) ) { ?>
                                <div><?php echo force_balance_tags( $short_desc ); ?></div>
                            <?php } ?>

                            <div class="sliderbtn-wrp">
                                <?php if ( !empty( $button_text ) ) { ?>
                                <a class="btn btn-primary" href="<?php echo esc_url($button_link); ?>">
                                    <?php echo esc_attr( $button_text ); ?>
                                </a>
                                <?php } if( !empty( $button_text_one ) ){ ?>
                                    <a class="btn btn-secondary" href="<?php echo esc_url($button_link_one); ?>">
                                        <?php echo esc_attr( $button_text_one ); ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                        <?php if( $promo_banner_img ): ?>
                            <div class="banneritem-img">
                                <img src="<?php echo esc_url($promo_banner_img); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if( $boxwidth ): ?>
                </div>
            <?php endif; ?> <!-- container -->
        </div>
        </div>

	 
	<?php
		$bottom_seprator = $settings['bottom_seprator'];
		if( $bottom_seprator ) sparklestore_pro_add_bottom_seperator($bottom_seprator); 
        
	}



}