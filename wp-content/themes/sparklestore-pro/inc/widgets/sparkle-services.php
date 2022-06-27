<?php
/**
 * Adds sparklestore_pro_services widget.
*/
add_action('widgets_init', 'sparklestore_pro_services');
function sparklestore_pro_services() {
    register_widget('sparklestore_pro_services_area');
}

class sparklestore_pro_services_area extends WP_Widget {
    /**
     * Register widget with WordPress.
    */
    public function __construct() {
        parent::__construct(
            'sparklestore_pro_services_area', esc_html__('&bull; Services Area','sparklestore-pro'), array(
            'description' => esc_html__('A widget that display quick services list!', 'sparklestore-pro')
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


            'sparklestore_pro_service_items' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_service_items',
                'sparklestore_pro_widgets_title' => esc_html__('Service Items', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'repeater',
                'sparklestore_pro_widgets_repeater_title' => 'Service',
                'sparklestore_pro_widgets_repeater_fields_title' => 'title',
                'sparklestore_pro_widgets_repeater_fields' => array(
                    'icon' => array(
                        'title' => __('Icon', 'sparklestore-pro'),
                        'type' => 'icon'
                    ),

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

            'sparklestore_pro_services_layout' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_services_layout',
                'sparklestore_pro_widgets_title' => __('Layout', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'layout-one',
                'sparklestore_pro_widgets_field_options' => array(
                    'layout-one' => esc_html__('Layout One','sparklestore-pro'),
                    'layout-two' => esc_html__('Layout Two','sparklestore-pro'),
                )
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

            'sparklestore_pro_boxitem_seprator_heading' => array(
				'sparklestore_pro_widgets_name' => 'sparklestore_pro_boxitem_seprator_heading',
				'sparklestore_pro_widgets_title' => __('Box Item', 'sparklestore-pro'),
				'sparklestore_pro_widgets_field_type' => 'heading'
			),

            'sparklestore_pro_box_icon_color' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_box_icon_color',
                'sparklestore_pro_widgets_title' => __('Icon Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color',
                'sparklestore_pro_widgets_default' => '#f33c3c',
                'sparklestore_pro_widgets_class' => 'cl-col6'
            ),

            'sparklestore_pro_box_title_color' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_box_title_color',
                'sparklestore_pro_widgets_title' => __('Title Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color',
                'sparklestore_pro_widgets_default' => '#232529',
                'sparklestore_pro_widgets_class' => 'cl-col6'
            ),

            'sparklestore_pro_box_text_color' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_box_text_color',
                'sparklestore_pro_widgets_title' => __('Text Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color',
                'sparklestore_pro_widgets_default' => '#232529',
                'sparklestore_pro_widgets_class' => 'cl-col6'
            ),

            'sparklestore_pro_box_bg_color' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_box_bg_color',
                'sparklestore_pro_widgets_title' => __('Background Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'alpha-color',
                'sparklestore_pro_widgets_default' => '#f2f4f6',
                'sparklestore_pro_widgets_class' => 'cl-col6'
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
        
        $title           = empty( $instance['sparklestore_pro_title'] ) ? '' : $instance['sparklestore_pro_title'];
        $sub_title       = empty( $instance['sparklestore_pro_short_desc'] ) ? '' : $instance['sparklestore_pro_short_desc'];
        $titlestyle      = empty( $instance['sparklestore_pro_title_style'] ) ? '' : $instance['sparklestore_pro_title_style'];

        $services       = empty( $instance['sparklestore_pro_service_items'] ) ? '' : $instance['sparklestore_pro_service_items'];
        $service_layout = empty( $instance['sparklestore_pro_services_layout'] ) ? '' : $instance['sparklestore_pro_services_layout'];
        
        $icon_color  = empty($instance['sparklestore_pro_box_icon_color']) ? '' : $instance['sparklestore_pro_box_icon_color'];
        $text_color  = empty($instance['sparklestore_pro_box_text_color']) ? '' : $instance['sparklestore_pro_box_text_color'];
        $title_color = empty($instance['sparklestore_pro_box_title_color']) ? '' : $instance['sparklestore_pro_box_title_color'];
        $bg_color    = empty($instance['sparklestore_pro_box_bg_color']) ? '' : $instance['sparklestore_pro_box_bg_color'];
        

        $id = wp_generate_uuid4(  );
        echo $before_widget; 

        $sparklestore_pro_colors = "
            #section-{$id} .services_area .services_item{
                background-color: $bg_color;
            }
            #section-{$id} .services_item .services_icon{
                color: $icon_color;
            }
            #section-{$id} .services_item .services_content h3{
                color: $title_color; 
            }
            #section-{$id} .services_area .services_item{
                color: $text_color;
            }
        ";

        sparkle_themes_widget_dynamic_style($instance, '#section-'.$id, $sparklestore_pro_colors);   
        
    ?>
    
        <div id="section-<?php echo $id; ?>" class="services_wrapper section-wrap <?php echo esc_attr( $service_layout ); ?>">
            <div class="container">
                
                <?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>
                

                <div class="services_area section-content">
                    <?php 
                        
                        if( !empty($services)): 

                        foreach($services as $service): ?>
                            <div class="services_item">
                            <?php if( !empty( $service['icon'] ) ){ ?>
                                <div class="services_icon">
                                    <span class="<?php echo esc_attr($service['icon']); ?>"></span>
                                </div>
                            <?php } ?>
                            <div class="services_content">
                                <h3><?php echo force_balance_tags($service['title']); ?></h3>
                                <div><?php echo force_balance_tags($service['description'] ); ?></div>
                            </div>
                            </div>

                    <?php endforeach; endif;  ?>
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