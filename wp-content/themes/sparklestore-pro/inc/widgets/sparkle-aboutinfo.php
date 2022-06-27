<?php
/**
 * Adds sparklestore_pro_aboutus_info widget.
*/
add_action('widgets_init', 'sparklestore_pro_aboutus_info');
function sparklestore_pro_aboutus_info() {
    register_widget('sparklestore_pro_aboutus_info_area');
}

class sparklestore_pro_aboutus_info_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'sparklestore_pro_aboutus_info_area', esc_html__('&nbsp; About Information','sparklestore-pro'), array(
            'description' => esc_html__('A widget that display about your information', 'sparklestore-pro')
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

            'sparklestore_pro_about_logo' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_about_logo',
                'sparklestore_pro_widgets_title' => esc_html__('Upload Background Image', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'upload',
            ),
            
            'sparklestore_pro_about_title' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_about_title',
                'sparklestore_pro_widgets_title' => esc_html__('Title', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text',
                'sparklestore_pro_widgets_row' => '3'
            ),

            'sparklestore_pro_about_author_image' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_about_author_image',
                'sparklestore_pro_widgets_title' => esc_html__('About Single Image', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'upload',
            ),

            'sparklestore_pro_about_short_desc' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_about_short_desc',
                'sparklestore_pro_widgets_title' => esc_html__('Short Description', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'editor',
                'sparklestore_pro_widgets_row' => '3'
            ),

            'sparklestore_pro_about_address' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_about_address',
                'sparklestore_pro_widgets_title' => esc_html__('Address', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text',
            ),

            'sparklestore_pro_about_phone' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_about_phone',
                'sparklestore_pro_widgets_title' => esc_html__('Phone', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text',
            ),

            'sparklestore_pro_about_email' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_about_email',
                'sparklestore_pro_widgets_title' => esc_html__('Email', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text',
            ),

            'sparklestore_pro_social_links' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_social_links',
                'sparklestore_pro_widgets_title' => __('Social Links', 'sparklestore-pro'),
                'sparklestore_pro_widgets_repeater_title' => __('Social Link', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'repeater',
                'sparklestore_pro_widgets_repeater_fields_title' => 'icon',
                'sparklestore_pro_widgets_repeater_fields' => array(
                    'icon' => array(
                        'title' => __('Icon', 'sparklestore-pro'),
                        'type' => 'icon'
                    ),
                    'link' => array(
                        'title' => __('URL', 'sparklestore-pro'),
                        'type' => 'text'
                    )
                ),
                'sparklestore_pro_widgets_add_button' => __('Add New', 'sparklestore-pro')
            ),

            'sparklestore_pro_about_us_alignment' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_about_us_alignment',
                'sparklestore_pro_widgets_title' => esc_html__('Text Alignment', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'center',
                'sparklestore_pro_widgets_field_options' => array(
                        'left'   => __("Left", 'sparklestore-pro'),
                        'center' => __("Center", 'sparklestore-pro'),
                        'right'  => __("Right", 'sparklestore-pro')
                    )
            ),

            
            'content_close' => array(
                'sparklestore_pro_widgets_field_type' => 'close'
            ),

            // style tab start from here
            'style_open' => array(
                'sparklestore_pro_widgets_class' => 'cl-widget-tab-content',
                'sparklestore_pro_widgets_data_id' => 'cl-style',
                'sparklestore_pro_widgets_field_type' => 'open'
            ),

            'sparklestore_pro_about_title_color' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_about_title_color',
                'sparklestore_pro_widgets_title' => __('Title Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color',
                'sparklestore_pro_widgets_default' => '#333333'
            ),

            'sparklestore_pro_about_text_color' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_about_text_color',
                'sparklestore_pro_widgets_title' => __('Text Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color',
                'sparklestore_pro_widgets_default' => '#333333'
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

        $logo         = empty( $instance['sparklestore_pro_about_logo'] ) ? '' : $instance['sparklestore_pro_about_logo'];
        $shor_desc    = empty( $instance['sparklestore_pro_about_short_desc'] ) ? '' : $instance['sparklestore_pro_about_short_desc'];
        $title        = empty( $instance['sparklestore_pro_about_title'] ) ? '' : $instance['sparklestore_pro_about_title'];
        $social_links = empty( $instance['sparklestore_pro_social_links'] ) ? '' : $instance['sparklestore_pro_social_links'];
        
        $text_alignment   = empty( $instance['sparklestore_pro_about_us_alignment'] ) ? '' : $instance['sparklestore_pro_about_us_alignment'];
        $author_image   = empty( $instance['sparklestore_pro_about_author_image'] ) ? '' : $instance['sparklestore_pro_about_author_image'];
        $address        = empty( $instance['sparklestore_pro_about_address'] ) ? '' : $instance['sparklestore_pro_about_address'];
        $email          = empty($instance['sparklestore_pro_about_email']) ? '' : $instance['sparklestore_pro_about_email'];
        $phone          = empty($instance['sparklestore_pro_about_phone']) ? '' : $instance['sparklestore_pro_about_phone'];
        
        $title_color    = empty($instance['sparklestore_pro_about_title_color']) ? '' : $instance['sparklestore_pro_about_title_color'];
        $text_color     = empty($instance['sparklestore_pro_about_text_color']) ? '' : $instance['sparklestore_pro_about_text_color'];
       
        echo $before_widget; 
    ?>
        <style>
            .about-title{
                color: <?php echo esc_attr($title_color); ?>
            }
            .about-desc{
                color: <?php echo esc_attr($text_color); ?>
            }
        </style>
    
        <div class="container">
            <div class="about-info text-<?php echo esc_attr( $text_alignment ); ?> <?php if(!empty( $logo )) { echo esc_attr('nofeaturesimg'); } ?>">
                <?php if(!empty( $logo )) { ?>
                    <div class="aboutfeaturesimg">
                        <img src="<?php echo esc_url( $logo ); ?>" />
                    </div>
                <?php }  if(!empty( $author_image )) { ?>
                    <div class="aboutauthorimg">
                        <img src="<?php echo esc_url( $author_image ); ?>" />
                    </div>
                <?php }  if(!empty( $title )) { ?>
                    <h2 class="about-title">
                        <?php echo wp_kses_post( $title ); ?>
                    </h2>
                <?php }  if(!empty( $shor_desc )) { ?>
                    <div class="about-desc">
                        <?php echo wp_kses_post(wpautop($shor_desc)); ?>
                    </div>
                <?php } ?>

                <div class='about-address'>
                    <?php if( !empty($address ) ) : ?>
                        <p><i class="fas fa-map-marker-alt"></i><?php echo esc_html( $address ); ?></p>
                    <?php endif; ?>
                    
                    <?php if( !empty($email ) ) : ?>
                        <p><i class="fas fa-envelope-open"></i><?php echo esc_html( antispambot( $email ) ); ?></p>
                    <?php endif; ?>
                    
                    <?php if( !empty($phone ) ) : ?>
                        <p><i class="fas fa-phone-square-alt"></i><?php echo esc_html( $phone ); ?></p>
                    <?php endif; ?>

                    <div class="social">
                        <ul>
                            <?php if( $social_links ): foreach ($social_links as $link) : if(!empty( $link['icon'] )): ?>
                                <li>
                                    <a href="<?php echo esc_url( $link['link'] ); ?>" target="_blank"><i class="<?php echo esc_attr( $link['icon'] ); ?>"></i></a>
                                </li>
                            <?php endif; endforeach; endif; ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    <?php         
        echo $after_widget;
    }
   
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    sparklestore_pro_widgets_updated_field_value()        defined in widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
        public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {
            extract($widget_field);
            if (!sparklestore_pro_exclude_widget_update($sparklestore_pro_widgets_field_type)) {
                $new = isset($new_instance[$sparklestore_pro_widgets_name]) ? $new_instance[$sparklestore_pro_widgets_name] : '';
                // Use helper function to get updated field values
                $instance[$sparklestore_pro_widgets_name] = sparklestore_pro_widgets_updated_field_value($widget_field, $new);
            }
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