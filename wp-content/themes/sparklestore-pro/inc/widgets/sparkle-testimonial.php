<?php
/**
 ** Adds sparklestore_pro_testimonial_widget widget.
*/
add_action('widgets_init', 'sparklestore_pro_testimonial_widget');
function sparklestore_pro_testimonial_widget() {
    register_widget('sparklestore_pro_testimonial_widget_area');
}

class sparklestore_pro_testimonial_widget_area extends WP_Widget {
    /**
     * Register widget with WordPress.
    */
    public function __construct() {
        parent::__construct(
            'sparklestore_pro_testimonial_widget_area', esc_html__('&bull; Testimonial Widget','sparklestore-pro'), array(
            'description' => esc_html__('A widget that shows client testimonial posts', 'sparklestore-pro')
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

            'sparklestore_pro_testimonialt_layout' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_testimonialt_layout',
                'sparklestore_pro_widgets_title' => esc_html__('View Style', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'slider',
                'sparklestore_pro_widgets_field_options' => array(                    
                        'slider' => esc_html__('Slider','sparklestore-pro'),
                        'grid' => esc_html__('Grid','sparklestore-pro')
                    )
            ),

            'sparklestore_pro_columns' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_columns',
                'sparklestore_pro_widgets_title' => esc_html__('Columns', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 2,
                'sparklestore_pro_widgets_field_options' => array(
                        1 => __("1 Column", 'sparklestore-pro'),
                        2 => __("2 Column", 'sparklestore-pro'),
                        3 => __("3 Column", 'sparklestore-pro')
                    )
            ),

            'sparklestore_pro_testimonial_layout' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_testimonial_layout',
                'sparklestore_pro_widgets_title' => esc_html__('Testimonial Design Layout', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'layout-two',
                'sparklestore_pro_widgets_field_options' => array(
                        'layout-one' => __('Layout One', 'sparklestore-pro'), 
                        'layout-two' => __('Layout Two', 'sparklestore-pro'),
                        'layout-three' => __('Layout Three', 'sparklestore-pro'),
                        'layout-four' => __('Layout Four', 'sparklestore-pro'),
                    )
            ),

            'sparklestore_pro_testimonial_items' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_testimonial_items',
                'sparklestore_pro_widgets_title' => esc_html__('Testimonials', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'repeater',
                'sparklestore_pro_widgets_repeater_title' => 'Testimonial',
                'sparklestore_pro_widgets_repeater_fields_title' => 'title',
                'sparklestore_pro_widgets_repeater_fields' => array(
                    'title' => array(
                        'title' => __('Title', 'sparklestore-pro'),
                        'type' => 'text'
                    ),
                    'description' => array(
                        'title' => __('Description', 'sparklestore-pro'),
                        'type' => 'editor'
                    ),
                    'rating' => array(
                        'title' => __('Rating', 'sparklestore-pro'),
                        'type' => 'select',
                        'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5)
                    ),

                    'image' => array(
                        'title' => __('Image', 'sparklestore-pro'),
                        'type' => 'upload'
                    ),
                    'author_name' => array(
                        'title' => __('Author Name', 'sparklestore-pro'),
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

        /**
         * wp query for first block
        */  
        $title           = empty( $instance['sparklestore_pro_title'] ) ? '' : $instance['sparklestore_pro_title'];
        $sub_title       = empty( $instance['sparklestore_pro_short_desc'] ) ? '' : $instance['sparklestore_pro_short_desc'];
        $titlestyle      = empty( $instance['sparklestore_pro_title_style'] ) ? '' : $instance['sparklestore_pro_title_style'];

        $testimonial_items  = empty( $instance['sparklestore_pro_testimonial_items'] ) ? '' : $instance['sparklestore_pro_testimonial_items'];
        $display_layout     = empty( $instance['sparklestore_pro_testimonial_layout'] ) ? '' : $instance['sparklestore_pro_testimonial_layout'];
        $column_number      = empty( $instance['sparklestore_pro_columns'] ) ? 3 : $instance['sparklestore_pro_columns'];
        $layout             = empty( $instance['sparklestore_pro_testimonialt_layout'] ) ? '' : $instance['sparklestore_pro_testimonialt_layout'];
        $bottom_seprator    = empty( $instance['sparklestore_pro_bottom_seprator']) ? '' : $instance['sparklestore_pro_bottom_seprator'];

        echo $before_widget;
        sparkle_themes_widget_dynamic_style($instance, '.testimonial-wrapper');   
    ?>
        <div class="testimonial-wrapper section-wrap <?php echo esc_attr( $display_layout ); ?> <?php echo esc_attr( $layout ); ?>">
            <div class="container">
                <div class="section-content">
                    <?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>
                    
                    <div class="testimonial-wrap gird-<?php echo esc_attr( $column_number ); ?> <?php if($layout == 'slider'){ echo esc_attr('storeslider owl-carousel'); } ?>" data-column="<?php echo esc_attr( $column_number ); ?>" data-style="<?php echo esc_attr( $layout ); ?>">
                        <?php
                            if( $testimonial_items ):
                                foreach($testimonial_items as $item ):
                        ?>
                            <div class="testimonial-item">
                                <span class="testimonial-quote-icon fa fa-quote-left"></span>
                                <div class="testimonial-inner-wrap">
                                    <?php if( $item['image'] ){ ?>
                                        <div class="testimonial-image">
                                            <img src="<?php echo esc_url( $item['image'] ); ?>">
                                        </div>
                                    <?php } if( $display_layout != 'layout-four' ){ ?>
                                        <div class="testimonial-desc">
                                            <?php if(!empty( $item['title'] )) { ?>
                                                <h2 class="name">
                                                    <?php echo esc_html( $item['title'] ); ?>
                                                </h2>
                                            <?php } if(!empty( $item['author_name'] ) ) { ?>
                                                <div class="designation">
                                                    <?php echo esc_html( $item['author_name'] ); ?>
                                                </div>
                                            <?php } ?>

                                            <div class="review-rating">
                                            
                                                <?php for($i = 0; $i < intval(@$item['rating']); $i++): ?>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                <?php endfor; 
                                                    $star_count = 5 -  intval( @$item['rating'] );
                                                    if( $star_count > 0 ){
                                                        for($i = 0; $i < $star_count; $i++){ ?>
                                                        <i class="fa fa-star blank" aria-hidden="true"></i>
                                                        <?php }
                                                    } 
                                                ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="testimonial-desc">
                                    <?php echo force_balance_tags($item['description']); ?>
                                </div>

                                <?php if( $display_layout == 'layout-four' ){ ?>
                                    <div class="testimonial-desc">
                                        <?php if(!empty( $item['title'] )) { ?>
                                            <h2 class="name">
                                                <?php echo esc_html( $item['title'] ); ?>
                                            </h2>
                                        <?php } if(!empty( $item['author_name'] ) ) { ?>
                                            <div class="designation">
                                                <?php echo esc_html( $item['author_name'] ); ?>
                                            </div>
                                        <?php } ?>

                                        <div class="review-rating"> 
                                            <?php for($i = 0; $i < intval(@$item['rating']); $i++): ?>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            <?php endfor; 
                                                $star_count = 5 -  intval( @$item['rating'] );
                                                if( $star_count > 0 ){
                                                    for($i = 0; $i < $star_count; $i++){ ?>
                                                    <i class="fa fa-star blank" aria-hidden="true"></i>
                                                    <?php }
                                                } 
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php endforeach; endif; ?>
                    </div>
                </div>
            </div>

            <?php sparklestore_pro_add_bottom_seperator($bottom_seprator); ?>

        </div><!-- End Latest Blog -->

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
