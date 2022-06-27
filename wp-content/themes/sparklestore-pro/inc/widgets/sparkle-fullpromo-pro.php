<?php
/**
 * Adds sparklestore_pro_full_promo_pro widget.
*/
add_action('widgets_init', 'sparklestore_pro_full_promo_pro');
function sparklestore_pro_full_promo_pro() {
    register_widget('sparklestore_pro_full_promo_pro_area');
}

class sparklestore_pro_full_promo_pro_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    */
    public function __construct() {
        parent::__construct(
            'sparklestore_pro_full_promo_pro_area', esc_html__('&bull; Full Promo Image/Video','sparklestore-pro'), array(
            'description' => esc_html__('A widget that promote you busincess', 'sparklestore-pro')
        ));
    }
    
    private function widget_fields() {
       
        $fields = array( 

            'cl_tab' => array(
                'sparklestore_pro_widgets_tabs' => array(
                    'cl-content' => __('Content', 'sparklestore-pro'),
                    'cl-style' => __('Style', 'sparklestore-pro'),
                ),
                'sparklestore_pro_widgets_field_type' => 'tab'
            ),
            'tab_open' => array(
                'sparklestore_pro_widgets_class' => 'cl-widget-tab-content-wrap',
                'sparklestore_pro_widgets_field_type' => 'open'
            ),
            'content_open' => array(
                'sparklestore_pro_widgets_class' => 'cl-widget-tab-content',
                'sparklestore_pro_widgets_data_id' => 'cl-content',
                'sparklestore_pro_widgets_field_type' => 'open'
            ),

            'sparklestore_pro_full_promo_title' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_title',
                'sparklestore_pro_widgets_title' => esc_html__('Promo Title', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text',
            ),

            'sparklestore_pro_full_promo_description' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_description',
                'sparklestore_pro_widgets_title' => esc_html__('Description', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'editor',
            ),

            'sparklestore_pro_full_promo_bg_image' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_bg_image',
                'sparklestore_pro_widgets_title' => __('Background Image', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'upload'
            ),

            'sparklestore_pro_full_promo_bg_video' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_bg_video',
                'sparklestore_pro_widgets_title' => __('OR Background Video', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text',
                'sparklestore_pro_widgets_description' => __('https://www.youtube.com/watch?v=yNAsk4Zw2p0 (Only ADD : yNAsk4Zw2p0 )', 'sparklestore-pro'),
                'sparklestore_pro_widgets_default' => '',
            ),

            'sparklestore_pro_full_promo_bg_alpha_color' => array(
				'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_bg_alpha_color',
				'sparklestore_pro_widgets_title' => __('Background Overlay Color', 'sparklestore-pro'),
				'sparklestore_pro_widgets_field_type' => 'alpha-color',
				'sparklestore_pro_widgets_default' => 'rgba(0, 0, 0, 0.4)'
            ),

            'sparklestore_pro_full_promo_button_text' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_button_text',
                'sparklestore_pro_widgets_title' => esc_html__('Promo Button Text', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text',
            ),

            'sparklestore_pro_full_promo_button_link' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_button_link',
                'sparklestore_pro_widgets_title' => esc_html__('Promo Button Link', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'url',
            ),

            'sparklestore_pro_full_promo_button_text2' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_button_text2',
                'sparklestore_pro_widgets_title' => esc_html__('Promo Button Text2', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text',
            ),

            'sparklestore_pro_full_promo_button_link2' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_button_link2',
                'sparklestore_pro_widgets_title' => esc_html__('Promo Button Link2', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'url',
            ),

            'sparklestore_pro_full_promo_banner_img' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_banner_img',
                'sparklestore_pro_widgets_title' => __('Promo Banner Img', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'upload'
            ),

            'sparklestore_pro_full_promo_text_alignment' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_text_alignment',
                'sparklestore_pro_widgets_title' => __('Text Alignment', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_class' => 'cl-col6',
                'sparklestore_pro_widgets_default' => 'center',
                'sparklestore_pro_widgets_field_options' => array(
                    'text-left' => esc_html__('Left', 'sparklestore-pro'),
                    'text-right' => esc_html__('Right', 'sparklestore-pro'),
                    'text-center' => esc_html__('center', 'sparklestore-pro'),
                )
            ),

            'sparklestore_pro_promo_info' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_promo_info',
                'sparklestore_pro_widgets_title' => esc_html__('Disable Information', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'checkbox',

            ),

            'sparklestore_pro_promo_display_boxwidth' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_promo_display_boxwidth',
                'sparklestore_pro_widgets_title' => esc_html__('Box Width', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'checkbox'
            ),
            

            'content_close' => array(
                'sparklestore_pro_widgets_field_type' => 'close'
            ),

            // style tab start from here
            'style_open' => array(
                'sparklestore_pro_widgets_class' => 'cl-widget-tab-content cl-flex-wrap',
                'sparklestore_pro_widgets_data_id' => 'cl-style',
                'sparklestore_pro_widgets_field_type' => 'open',
            ),

            'sparklestore_pro_full_promo_title_color' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_title_color',
                'sparklestore_pro_widgets_title' => __('Title Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color',
                'sparklestore_pro_widgets_default' => '#ffffff',
                'sparklestore_pro_widgets_class' => 'cl-col6'
            ),

            'sparklestore_pro_full_promo_text_color' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_text_color',
                'sparklestore_pro_widgets_title' => __('Text Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color',
                'sparklestore_pro_widgets_default' => '#ffffff',
                'sparklestore_pro_widgets_class' => 'cl-col6'
            ),

            'sparklestore_pro_full_promo_button_bg_color' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_button_bg_color',
                'sparklestore_pro_widgets_title' => __('Button Background', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color',
                'sparklestore_pro_widgets_default' => '#003772',
                'sparklestore_pro_widgets_class' => 'cl-col6'
            ),

            'sparklestore_pro_full_promo_button_text_color' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_button_text_color',
                'sparklestore_pro_widgets_title' => __('Button Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color',
                'sparklestore_pro_widgets_default' => '#ffffff',
                'sparklestore_pro_widgets_class' => 'cl-col6'
            ),

            'sparklestore_pro_full_promo_button_hover_bg_color' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_button__hover_bg_color',
                'sparklestore_pro_widgets_title' => __('Button Hover Background', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color',
                'sparklestore_pro_widgets_default' => '#ffffff',
                'sparklestore_pro_widgets_class' => 'cl-col6'
            ),

            'sparklestore_pro_full_promo_button_hover_text_color' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_button_hover_text_color',
                'sparklestore_pro_widgets_title' => __('Button Hover Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color',
                'sparklestore_pro_widgets_default' => '#003772',
                'sparklestore_pro_widgets_class' => 'cl-col6'
            ),
            
            'sparklestore_pro_full_promo_bottom_seprator_heading' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_full_promo_bottom_seprator_heading',
                'sparklestore_pro_widgets_title' => __('Seprator', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'heading'
            ),
            
            // Bottom Seperator
			'sparklestore_pro_bottom_seprator' => array(
				'sparklestore_pro_widgets_name' => 'sparklestore_pro_bottom_seprator',
				'sparklestore_pro_widgets_title' => __('Bottom Seprator', 'sparklestore-pro'),
				'sparklestore_pro_widgets_field_type' => 'select',
				'sparklestore_pro_widgets_field_options' => array_merge(array('none' => 'None'), sparklestore_pro_svg_seperator())

			),

			'sparklestore_pro_seprator_height' => array(
				'sparklestore_pro_widgets_name' => 'sparklestore_pro_seprator_height',
				'sparklestore_pro_widgets_title' => __('Seprator Height', 'sparklestore-pro'),
				'sparklestore_pro_widgets_field_type' => 'number',
				'sparklestore_pro_widgets_default' => 150,
			),

			'sparklestore_pro_bottom_seprator_color' => array(
				'sparklestore_pro_widgets_name' => 'sparklestore_pro_bottom_seprator_color',
				'sparklestore_pro_widgets_title' => __('Seprator Color', 'sparklestore-pro'),
				'sparklestore_pro_widgets_field_type' => 'alpha-color',
				'sparklestore_pro_widgets_default' => 'rgba(0, 0, 0, 0.4)'
            ),
                        
            'style_close' => array(
                'sparklestore_pro_widgets_field_type' => 'close'
            ),

            'tab_close' => array(
                'sparklestore_pro_widgets_field_type' => 'close'
            )
                


        );

        return $fields;
    }

    public function widget($args, $instance) {

        extract($args);
        extract($instance);
        
        $promo_bg_image  = empty( $instance['sparklestore_pro_full_promo_bg_image'] ) ? '' : $instance['sparklestore_pro_full_promo_bg_image'];
        $title           = empty( $instance['sparklestore_pro_full_promo_title'] ) ? '' : $instance['sparklestore_pro_full_promo_title'];
        $short_desc      = empty( $instance['sparklestore_pro_full_promo_description'] ) ? '' : $instance['sparklestore_pro_full_promo_description'];
        $button_link     = empty( $instance['sparklestore_pro_full_promo_button_link'] ) ? '' : $instance['sparklestore_pro_full_promo_button_link'];
        $button_text     = empty( $instance['sparklestore_pro_full_promo_button_text'] ) ? '' : $instance['sparklestore_pro_full_promo_button_text'];

        $button_link_one     = empty( $instance['sparklestore_pro_full_promo_button_link2'] ) ? '' : $instance['sparklestore_pro_full_promo_button_link2'];
        $button_text_one     = empty( $instance['sparklestore_pro_full_promo_button_text2'] ) ? '' : $instance['sparklestore_pro_full_promo_button_text2'];
        
        $bg_video = empty( $instance['sparklestore_pro_full_promo_bg_video']) ? '' : $instance['sparklestore_pro_full_promo_bg_video'];
        $text_alignment = empty( $instance['sparklestore_pro_full_promo_text_alignment']) ? '' : $instance['sparklestore_pro_full_promo_text_alignment'];
        $promo_banner_img = empty( $instance['sparklestore_pro_full_promo_banner_img']) ? '' : $instance['sparklestore_pro_full_promo_banner_img'];
        $promo_info = empty( $instance['sparklestore_pro_promo_info']) ? '' : $instance['sparklestore_pro_promo_info'];
        $boxwidth = empty( $instance['sparklestore_pro_promo_display_boxwidth']) ? '' : $instance['sparklestore_pro_promo_display_boxwidth'];

        $bottom_seprator  = empty( $instance['sparklestore_pro_bottom_seprator']) ? '' : $instance['sparklestore_pro_bottom_seprator'];

        if( $bg_video ):
            $video_data = 'data-property="{videoURL:\'' . $bg_video . '\', mobileFallbackImage:\'https://img.youtube.com/vi/' . $bg_video . '/maxresdefault.jpg\'}"';
        else: 
            $video_data = '';
        endif;

        $promo_bg_rgba    = !empty($instance['sparklestore_pro_full_promo_bg_alpha_color']) ? $instance['sparklestore_pro_full_promo_bg_alpha_color'] : 'rgba(0, 0, 0, 0.4)';

        $title_color    = !empty($instance['sparklestore_pro_full_promo_title_color']) ? $instance['sparklestore_pro_full_promo_title_color'] : '#ffffff';
        $text_color     = !empty($instance['sparklestore_pro_full_promo_text_color']) ? $instance['sparklestore_pro_full_promo_text_color'] : '#ffffff';
        
        $btn_color      = !empty($instance['sparklestore_pro_full_promo_button_text_color']) ? $instance['sparklestore_pro_full_promo_button_text_color'] : '#003772';
        $btn_bg_color   = !empty($instance['sparklestore_pro_full_promo_button_bg_color']) ? $instance['sparklestore_pro_full_promo_button_bg_color'] : '#ffffff';
        
        $hover_bg_color   = !empty($instance['sparklestore_pro_full_promo_button_hover_bg_color']) ? $instance['sparklestore_pro_full_promo_button_hover_bg_color'] : '#ffffff';
        $hover_color      = !empty($instance['sparklestore_pro_full_promo_button_hover_text_color']) ? $instance['sparklestore_pro_full_promo_button_hover_text_color'] : '#003772';

        $svg_color      = !empty($instance['sparklestore_pro_bottom_seprator_color']) ? $instance['sparklestore_pro_bottom_seprator_color'] : 'rgba(0, 0, 0, 0.4)';
        $svg_height     = !empty($instance['sparklestore_pro_seprator_height']) ? $instance['sparklestore_pro_seprator_height'] : '';

        
        $id = wp_generate_uuid4(  );
       
        $style = "
            <style>
                #section-{$id} .header-banner::before{
                    background-color: $promo_bg_rgba;
                }
                #section-{$id} .banneritem-caption h2{
                    color: $title_color;
                }
                .section-{$id} .banneritem-caption div *{
                    color: $text_color; 
                }
                #section-{$id} .banneritem-caption a.btn-primary{
                    background-color: $btn_bg_color;
                    border-color: $btn_bg_color;
                    color: $btn_color;
                }

                #section-{$id} .banneritem-caption a.btn-secondary{
                    background-color: $hover_bg_color;
                    border-color: $hover_bg_color;
                    color: $hover_color;
                }

                #section-{$id} .banneritem-caption a:hover{
                    background-color: $hover_bg_color;
                    border-color: $btn_bg_color;
                    color: $hover_color;
                }

                .section-{$id} .bottom-section-seperator svg{
                    fill: $svg_color;
                    height: {$svg_height}px;
                }

            </style>
        ";

        echo $style;

        echo $before_widget; ?>

        <div class=" fullpromobanner" id="section-<?php echo $id; ?>">
            <?php if( $boxwidth ): ?>
                <div class='container'>
            <?php endif; ?>

            <div class="sp-section header-banner video-banner" <?php echo $video_data; ?>>

                    <?php if( isset($promo_bg_image) && $bg_video == '' ) : ?>
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

            <?php sparklestore_pro_add_bottom_seperator($bottom_seprator);  ?>

           
            <?php if( $boxwidth ): ?>
                </div>
            <?php endif; ?> <!-- container -->
        </div>

    <?php  echo $after_widget;  }
   
    public function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            $instance[$sparklestore_pro_widgets_name] = sparklestore_pro_widgets_updated_field_value($widget_field, $new_instance[$sparklestore_pro_widgets_name]);
        }

        return $instance;
    }

      /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    sparklestore_pro_widgets_show_widget_field()      defined in widget-fields.php
     */
    public function form($instance) {

        $widget_fields = $this->widget_fields();
        // Loop through fields
        foreach ($widget_fields as $widget_field) {
            // Make array elements available as variables
            extract($widget_field);

            if (!sparklestore_pro_exclude_widget_update($sparklestore_pro_widgets_field_type)) {
                $sparklestore_pro_widgets_field_value = !empty($instance[$sparklestore_pro_widgets_name]) ? $instance[$sparklestore_pro_widgets_name] : '';
            }else{
                $sparklestore_pro_widgets_field_value = '';
            }

            sparklestore_pro_widgets_show_widget_field($this, $widget_field, $sparklestore_pro_widgets_field_value);
        }
    }
}