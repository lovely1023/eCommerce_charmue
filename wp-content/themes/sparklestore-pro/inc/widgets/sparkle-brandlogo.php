<?php
/**
 ** Adds sparklestore_pro_brand_logo widget.
**/
add_action('widgets_init', 'sparklestore_pro_brand_logo');
function sparklestore_pro_brand_logo() {
    register_widget('sparklestore_pro_brand_logo_area');
}

class sparklestore_pro_brand_logo_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'sparklestore_pro_brand_logo_area', esc_html__('&bull; Brands/Client Logo','sparklestore-pro'), array(
            'description' => esc_html__('A widget display your busincess brand logo', 'sparklestore-pro')
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

            'sparklestore_pro_brandlogo_display_style' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_brandlogo_display_style',
                'sparklestore_pro_widgets_title' => __('Display Style', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'slider',
                'sparklestore_pro_widgets_field_options' => array(
                    'slider' => esc_html__('Slider', 'sparklestore-pro'),
                    'grid' => esc_html__('Grid', 'sparklestore-pro')
                )
            ),

            'sparklestore_pro_brandlogo_display_column' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_brandlogo_display_column',
                'sparklestore_pro_widgets_title' => __('Column', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 5,
                'sparklestore_pro_widgets_field_options' => array(
                    2 => esc_html__('2 Column', 'sparklestore-pro'),
                    3 => esc_html__('3 Column', 'sparklestore-pro'),
                    4 => esc_html__('4 Column', 'sparklestore-pro'),
                    5 => esc_html__('5 Column', 'sparklestore-pro'),
                    6 => esc_html__('6 Column', 'sparklestore-pro'),
                )
            ),

            'sparklestore_pro_brandlogo_items' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_brandlogo_items',
                'sparklestore_pro_widgets_title' => esc_html__('Logos', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'repeater',
                'sparklestore_pro_widgets_repeater_title' => 'Item',
                'sparklestore_pro_widgets_repeater_fields_title' => '',
                'sparklestore_pro_widgets_repeater_fields' => array(
                    'image' => array(
                        'title' => __('Image', 'sparklestore-pro'),
                        'type' => 'upload'
                    ),
                    'url' => array(
                        'title' => __('URL', 'sparklestore-pro'),
                        'type' => 'text'
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
        
        $title           = empty( $instance['sparklestore_pro_title'] ) ? '' : $instance['sparklestore_pro_title'];
        $sub_title       = empty( $instance['sparklestore_pro_short_desc'] ) ? '' : $instance['sparklestore_pro_short_desc'];
        $titlestyle      = empty( $instance['sparklestore_pro_title_style'] ) ? '' : $instance['sparklestore_pro_title_style'];

        $all_brands_logo = empty( $instance['sparklestore_pro_brandlogo_items'] ) ? '' : $instance['sparklestore_pro_brandlogo_items'];

        $layout = empty( $instance['sparklestore_pro_brandlogo_display_style'] ) ? '' : $instance['sparklestore_pro_brandlogo_display_style'];
        $column = empty( $instance['sparklestore_pro_brandlogo_display_column'] ) ? '3' : $instance['sparklestore_pro_brandlogo_display_column'];

        echo $before_widget;

        $id = wp_generate_uuid4(  );
        sparkle_themes_widget_dynamic_style($instance, '#section-'.$id);   
    ?>
        <div id="section-<?php echo $id; ?>" class="brand-logo-wrap section-wrap <?php echo esc_attr( $layout ); ?>">
            <div class="container">
                <div class="section-content">
                    
                    <?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>
                    
                    <ul class="brandlogo storeproductlist gird-<?php echo esc_attr( $column ); ?> <?php if($layout == 'slider'){ echo esc_attr('storeslider owl-carousel'); } ?>" data-column="<?php echo esc_attr( $column ); ?>" data-style="<?php echo esc_attr( $layout ); ?>">
                        <?php
                            if( $all_brands_logo ) {        
                            foreach($all_brands_logo as $logo){ 
                                
                        ?>
                            <li>
                                <a <?php if($logo['url']): ?>href="<?php echo esc_url( $logo['url'] ); ?>" target="_blank" <?php endif; ?>>
                                    <img src="<?php echo esc_url( $logo['image'] ); ?>" />
                                </a>
                            </li>                    
                        <?php } } ?>
                    </ul>
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