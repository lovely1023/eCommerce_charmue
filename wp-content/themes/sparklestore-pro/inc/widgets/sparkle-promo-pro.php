<?php
/**
 * Adds sparklestore_pro_promo_pro widget.
*/
add_action('widgets_init', 'sparklestore_pro_promo_pro');
function sparklestore_pro_promo_pro() {
    register_widget('sparklestore_pro_promo_pro_area');
}

class sparklestore_pro_promo_pro_area extends WP_Widget {
    /**
     * Register widget with WordPress.
    */
    public function __construct() {
        parent::__construct(
            'sparklestore_pro_promo_pro_area', esc_html__('&bull; Grid Promo Widget','sparklestore-pro'), array(
            'description' => esc_html__('A widget that promote you busincess visual way', 'sparklestore-pro')
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

            'sparklestore_pro_promo_layout' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_promo_layout',
                'sparklestore_pro_widgets_title' => __('Layout', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => '3-1-1-1-3-1-1-1',
                'sparklestore_pro_widgets_field_options' => array(
                    '3-1-1-1-3-1-1-1' => __('First 1 1 1 Second 1 1 1', 'sparklestore-pro'),
                    '3-1-1-1-3-2-2' => __('First 1 1 1 Second 2 2', 'sparklestore-pro'),
                    '3-2-2-3-1-1-1' => __('First 2 2 Second 1 1 1', 'sparklestore-pro'),
                    '3-2-2-3-2-2' => __('First 2 2 Second 2 2', 'sparklestore-pro'),
                    '3-1-2-3-1-1-1' => __('First 1 2 Second 1 1 1', 'sparklestore-pro'),
                    '3-2-1-3-1-1-1' => __('First 2 1 Second 1 1 1', 'sparklestore-pro'),
                    '3-2-1-3-2-1' => __('First 2 1 Second 2 1', 'sparklestore-pro'),
                    '3-1-1-1-3-1-2' => __('First 1 1 1 Second 1 2', 'sparklestore-pro'),
                    '3-1-1-1-3-2-1' => __('First 1 1 1 Second 2 1', 'sparklestore-pro'),
                    '3-2-1-3-1-2' => __('First 2 1 Second 1 2', 'sparklestore-pro'),
                    '3-1-2-3-1-2' => __('First 1 2 Second 1 2', 'sparklestore-pro'),
                    '3-1-2-3-2-1' => __('First 1 2 Second 2 1', 'sparklestore-pro'),
                )
            ),

            'sparklestore_pro_promo_items' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_promo_items',
                'sparklestore_pro_widgets_title' => esc_html__('Promo Items', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'repeater',
                'sparklestore_pro_widgets_repeater_title' => 'Promo Item',
                'sparklestore_pro_widgets_repeater_fields_title' => 'title',
                'sparklestore_pro_widgets_repeater_limit'   => 6,
                'sparklestore_pro_widgets_repeater_fields' => array(
                    'title' => array(
                        'title' => __('Title', 'sparklestore-pro'),
                        'type' => 'text'
                    ),
                    'description' => array(
                        'title' => __('Description', 'sparklestore-pro'),
                        'type' => 'textarea'
                    ),
                    'image' => array(
                        'title' => __('Image', 'sparklestore-pro'),
                        'type' => 'upload'
                    ),
                    'button_link' => array(
                        'title' => __('Link', 'sparklestore-pro'),
                        'type'  => 'text',
                    )
                ),
                'sparklestore_pro_widgets_add_button' => __('Add New', 'sparklestore-pro')
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

            //dynamic fields
            'style_dynamic_fields' => array(),
            
            'style_close' => array(
                'sparklestore_pro_widgets_field_type' => 'close'
            ),

            'tab_close' => array(
                'sparklestore_pro_widgets_field_type' => 'close'
            )

        );

        //replace
        $new_fields = array();
        foreach($fields as $field => $value){
            if( $field == 'title_dynamic_fields' || $field == 'style_dynamic_fields'){
                if($field == 'title_dynamic_fields' ){
                    foreach(sparklestore_pro_default_title_block() as $f => $v){
                        $new_fields[$f] = $v;
                    }
                }
                if($field == 'style_dynamic_fields' ){
                    foreach(sparklestore_pro_widget_default_style() as $f => $v){
                        $new_fields[$f] = $v;
                    }
                }
            }else{
                $new_fields[$field] = $value;
            }
        }

        unset($fields);
        return $new_fields;
    }

    public function widget($args, $instance) {

        extract($args);
        extract($instance);

        $sparklestore_pro_promo_items     = empty( $instance['sparklestore_pro_promo_items'] ) ? '' : $instance['sparklestore_pro_promo_items'];
        $sparklestore_pro_promo_layout     = empty( $instance['sparklestore_pro_promo_layout'] ) ? '' : $instance['sparklestore_pro_promo_layout'];
        
        
        echo $before_widget; 
        
       $id = wp_generate_uuid4(  );

       $bg_color         = empty( $instance['sparklestore_pro_bg_color']) ? '' : $instance['sparklestore_pro_bg_color'];
       $title_color      = empty( $instance['sparklestore_pro_title_color']) ? '#ffffff' : $instance['sparklestore_pro_title_color'];
       $text_color       = empty( $instance['sparklestore_pro_text_color']) ? '#ffffff' : $instance['sparklestore_pro_text_color'];
       $overlay_color    = empty( $instance['sparklestore_pro_overlay_color']) ? '' : $instance['sparklestore_pro_overlay_color'];
    
        $extra_style = "
            #section-{$id} .promo_block_area .promoarea h2{
                color: $title_color;
            }
            #section-{$id} .promo_block_area .promoarea p{
                color: $text_color;
            }
        ";
        
       sparkle_themes_widget_dynamic_style($instance, '#section-'.$id, $extra_style);
    ?>
    <div class="promosection section-wrap" id="section-<?php echo $id; ?>">            
        <div class="container">
            <div class="promo_block_area promoarea-div promo-<?php echo esc_attr( $sparklestore_pro_promo_layout ); ?>">
                <?php 
                    if( $sparklestore_pro_promo_items ):
                        $loop = 1;
                        foreach($sparklestore_pro_promo_items as $item ): 
                ?>
                    <div class="promo<?php echo intval( $loop ); $loop++; ?>">                    
                        <div class="promoarea">
                            <a href="<?php echo esc_url( $item['button_link'] ); ?>" class="promo-banner-img">
                                <figure class="promoimage">
                                    <img src="<?php echo esc_url( $item['image'] ); ?>" alt="<?php echo esc_html( $item['title'] ); ?>">
                                </figure>
                            </a>
                            <?php if(!empty( $item['title'] )){ ?>
                                <div class="textwrap">
                                    <h2><?php echo esc_html( $item['title'] ); ?></h2>
                                    <?php if($item['description']): ?>
                                        <p><?php echo force_balance_tags($item['description']);?></p>
                                    <?php endif; ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
        <?php 
            $bottom_seprator = empty( $instance['sparklestore_pro_bottom_seprator']) ? '' : $instance['sparklestore_pro_bottom_seprator'];
            sparklestore_pro_add_bottom_seperator($bottom_seprator); 
        ?>
    </div>

    <?php         
        echo $after_widget;
    }
   
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