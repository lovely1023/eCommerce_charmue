<?php
/**
 ** Adds sparklestore_pro_faq_widget widget.
*/
add_action('widgets_init', 'sparklestore_pro_faq_widget');
function sparklestore_pro_faq_widget() {
    register_widget('sparklestore_pro_faq_widget_area');
}

class sparklestore_pro_faq_widget_area extends WP_Widget {
    /**
     * Register widget with WordPress.
    */
    public function __construct() {
        parent::__construct(
            'sparklestore_pro_faq_widget_area', esc_html__('&bull; FAQ Widget','sparklestore-pro'), array(
            'description' => esc_html__('A widget that shows FAQ Section Dynamically', 'sparklestore-pro')
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
            
            //title dynamic fields
           'title_dynamic_fields' => array(),
           

            'sparklestore_pro_section_alignment' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_section_alignment',
                'sparklestore_pro_widgets_title' => esc_html__('Section Alignment', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_field_options' => array(
                        'left' => __('Left', 'sparklestore-pro'),
                        'right' => __('Right', 'sparklestore-pro')
                    )
            ),

            'sparklestore_pro_content' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_content',
                'sparklestore_pro_widgets_title' => esc_html__('Content', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'editor'
            ),

            'sparklestore_pro_faq_items' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_faq_items',
                'sparklestore_pro_widgets_title' => esc_html__('FAQ Items', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'repeater',
                'sparklestore_pro_widgets_repeater_title' => 'Faq',
                'sparklestore_pro_widgets_repeater_fields_title' => 'title',
                'sparklestore_pro_widgets_repeater_fields' => array(
                    'title' => array(
                        'title' => __('Title', 'sparklestore-pro'),
                        'type' => 'text'
                    ),
                    'description' => array(
                        'title' => __('Description', 'sparklestore-pro'),
                        'type' => 'editor'
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
        /**
         * wp query for first block
        */
         
        $title           = empty( $instance['sparklestore_pro_title'] ) ? '' : $instance['sparklestore_pro_title'];
        $sub_title       = empty( $instance['sparklestore_pro_short_desc'] ) ? '' : $instance['sparklestore_pro_short_desc'];
        $titlestyle      = empty( $instance['sparklestore_pro_title_style'] ) ? '' : $instance['sparklestore_pro_title_style'];
        
        $alignment       = empty( $instance['sparklestore_pro_section_alignment'] ) ? '' : $instance['sparklestore_pro_section_alignment'];
        $bottom_seprator  = empty( $instance['sparklestore_pro_bottom_seprator']) ? '' : $instance['sparklestore_pro_bottom_seprator'];
        $content  = empty( $instance['sparklestore_pro_content']) ? '' : $instance['sparklestore_pro_content'];
        $items = empty( $instance['sparklestore_pro_faq_items']) ? '' : $instance['sparklestore_pro_faq_items'];

        echo $before_widget;
            
        $id = wp_generate_uuid4(  );
        sparkle_themes_widget_dynamic_style($instance, '#section-'.$id);
    ?>
        <div id="section-<?php echo $id; ?>" class="faq-outer-container section-wrap alignment-<?php echo esc_attr($alignment); ?>">
          
            <div class="container">
                <div class="section-content">

                    
                    <?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>
                    

                    <div class="faq-wrapper <?php if(empty( $content ) ): echo esc_attr('nosidecontent'); endif; ?>">
                        <?php if(!empty($content)): ?>
                            <div class="faq-content">
                                <?php echo apply_filters('the_content', wpautop( $content)  ); ?>
                            </div>
                        <?php endif; ?>

                        <div class="accordion">
                            <?php
                                if (!empty($items)) {
                                    $i = 0;
                                    foreach ($items as $item) {
                                    $accordion_open = ($i == 0) ? ' open' : '';
                            ?>
                                    <div class="accordion-box <?php echo esc_attr($accordion_open); ?>">
                                        <div class="accordion-header">
                                            <?php echo esc_html($item['title']); ?>
                                        </div>

                                        <div class="accordion-content">
                                            <div class="accordion-content-wrap clearfix">
                                                <?php echo wp_kses_post(wpautop($item['description'])); ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    $i++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
                $bottom_seprator   = empty( $instance['sparklestore_pro_bottom_seprator']) ? '' : $instance['sparklestore_pro_bottom_seprator'];
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
