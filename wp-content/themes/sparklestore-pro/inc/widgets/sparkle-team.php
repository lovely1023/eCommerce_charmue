<?php
/**
 ** Adds sparklestore_pro_team_widget widget.
**/
add_action('widgets_init', 'sparklestore_pro_team_widget');
function sparklestore_pro_team_widget() {
    register_widget('sparklestore_pro_team_widget_area');
}

class sparklestore_pro_team_widget_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'sparklestore_pro_team_widget_area', esc_html__('&bull; Team Member Area','sparklestore-pro'), array(
            'description' => esc_html__('A widget display company team member.', 'sparklestore-pro')
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

            'sparklestore_pro_team_layout' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_team_layout',
                'sparklestore_pro_widgets_title' => esc_html__('Select team Layout', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_field_options' => array(
                        'layout-one' => __('Layout One', 'sparklestore-pro'),
                        'layout-two' => __('Layout Two', 'sparklestore-pro'),
                        'layout-three' => __('Layout Three', 'sparklestore-pro'),
                    )
            ),

            'sparklestore_pro_columns' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_columns',
                'sparklestore_pro_widgets_title' => esc_html__('Columns', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 3,
                'sparklestore_pro_widgets_field_options' => array(
                    1 => __("1 Column", 'sparklestore-pro'),
                    2 => __("2 Column", 'sparklestore-pro'),
                    3 => __("3 Column", 'sparklestore-pro')
                )
            ),
            
            'sparklestore_pro_view' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_view',
                'sparklestore_pro_widgets_title' => esc_html__('View', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'slider',
                'sparklestore_pro_widgets_field_options' => array(
                    'grid'   => __("Grid", 'sparklestore-pro'),
                    'slider' => __("Slider", 'sparklestore-pro')
                )
            ),

            'sparklestore_pro_team_items' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_team_items',
                'sparklestore_pro_widgets_title' => esc_html__('Team Members', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'repeater',
                'sparklestore_pro_widgets_repeater_title' => 'Member',
                'sparklestore_pro_widgets_repeater_fields_title' => 'name',
                'sparklestore_pro_widgets_repeater_fields' => array(
                    'name' => array(
                        'title' => __('Name', 'sparklestore-pro'),
                        'type' => 'text'
                    ),
                    'description' => array(
                        'title' => __('Description', 'sparklestore-pro'),
                        'type' => 'editor'
                    ),
                    'image' => array(
                        'title' => __('Image', 'sparklestore-pro'),
                        'type' => 'upload'
                    ),
                    'post' => array(
                        'title' => __('Designation', 'sparklestore-pro'),
                        'type'  => 'text',
                    ),
                    'facebook' => array(
                        'title' => __('Facebook', 'sparklestore-pro'),
                        'type'  => 'text',
                    ),
                    'twitter' => array(
                        'title' => __('Twitter', 'sparklestore-pro'),
                        'type'  => 'text',
                    ),
                    'linkedin' => array(
                        'title' => __('Linkedin', 'sparklestore-pro'),
                        'type'  => 'text',
                    ),
                    'instagram' => array(
                        'title' => __('Instagram', 'sparklestore-pro'),
                        'type'  => 'text',
                    ),
                    'pininterest' => array(
                        'title' => __('Pin Interest', 'sparklestore-pro'),
                        'type'  => 'text',
                    ),
                    'email' => array(
                        'title' => __('Email', 'sparklestore-pro'),
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
         ** wp query for first block
        **/
        $title           = empty( $instance['sparklestore_pro_title'] ) ? '' : $instance['sparklestore_pro_title'];
        $sub_title       = empty( $instance['sparklestore_pro_short_desc'] ) ? '' : $instance['sparklestore_pro_short_desc'];
        $titlestyle      = empty( $instance['sparklestore_pro_title_style'] ) ? '' : $instance['sparklestore_pro_title_style'];
        
        
        $column         = empty( $instance['sparklestore_pro_columns'] ) ? '3' : $instance['sparklestore_pro_columns'];
        $view           = empty( $instance['sparklestore_pro_view'] ) ? 'grid' : $instance['sparklestore_pro_view'];
        $layout         = empty( $instance['sparklestore_pro_team_layout'] ) ? 'layout-one' : $instance['sparklestore_pro_team_layout'];
        $sparklestore_pro_team_items = empty( $instance['sparklestore_pro_team_items']) ? array() : $instance['sparklestore_pro_team_items'];

        echo $before_widget;
        $id = wp_generate_uuid4(  );
        sparkle_themes_widget_dynamic_style($instance, '#section-'.$id);
        
    ?>

        <div class="teamlist-wrap section-wrap <?php echo esc_attr($layout); ?> <?php echo esc_attr($view); ?>" id="section-<?php echo $id; ?>">
            <div class="container">
                <div class="section-content">
                	<?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>
                        
                    <ul class="storeproductlist gird-<?php echo esc_attr( $column ); ?> <?php if($view == 'slider'){ echo esc_attr('storeslider owl-carousel'); } ?>" data-column="<?php echo esc_attr( $column ); ?>" data-style="<?php echo esc_attr( $view ); ?>">
                        <?php
                        if( is_array($sparklestore_pro_team_items)):
                            foreach($sparklestore_pro_team_items as $team): 
                        ?>
                            <li class="teammember-item">

                                <?php if( $team['image'] ) : ?>
                                    <div class="memberimage"> 
                                        <img title="<?php echo esc_html($team['name'] ); ?>" src="<?php echo esc_url( $team['image'] ); ?>">
                                    </div>
                                <?php endif; ?>

                                <div class="memberdetailswrap">
                                    <div class="memberdetails">
                                        <?php if( $team['name'] ) { ?>
                                            <h3><?php echo esc_html( $team['name'] ); ?></h3>
                                        <?php } ?>

                                        <?php if(!empty( $team['post']) ) { ?>
                                            <span class="position"><?php echo esc_html( $team['post'] ); ?></span>
                                        <?php } ?>
                                    </div>

                                    <?php if(!empty( $team['description']) ) { ?>
                                        <div class="description"><?php echo force_balance_tags($team['description']); ?></div>
                                    <?php } ?>

                                    <ul class="member-social">
                                        <?php if(!empty( $team['facebook']) ) { ?><li><a href="<?php echo esc_url( $team['facebook'] ); ?>"><i class="fab fa-facebook"></i></a></li><?php } ?>
                                        <?php if(!empty( $team['twitter']) ) { ?><li><a href="<?php echo esc_url( $team['twitter'] ); ?>"><i class="fab fa-twitter"></i></a></li><?php } ?>
                                        <?php if(!empty( $team['pininterest']) ) { ?><li><a href="<?php echo esc_url( $team['pininterest'] ); ?>"><i class="fab fa-pinterest"></i></a></li><?php } ?>
                                        <?php if(!empty( $team['linkedin']) ) { ?><li><a href="<?php echo esc_url( $team['linkedin'] ); ?>"><i class="fab fa-linkedin"></i></a></li><?php } ?>
                                        <?php if(!empty( $team['instagram']) ) { ?><li><a href="<?php echo esc_url( $team['instagram'] ); ?>"><i class="fab fa-instagram"></i></a></li><?php } ?>
                                        <?php if(!empty( $team['email']) ) { ?><li><a href="mailto:<?php echo esc_attr( antispambot( $team['email'] ) ); ?>"><i class="fa fa-envelope" aria-hidden="true"></i></a></li><?php } ?>
                                    </ul>
                                </div>

                            </li>
                        <?php endforeach; endif; ?>
                    </ul>
                </div>
            </div>

            <?php 
                $bottom_seprator   = empty( $instance['sparklestore_pro_bottom_seprator']) ? '' : $instance['sparklestore_pro_bottom_seprator'];
                sparklestore_pro_add_bottom_seperator($bottom_seprator); 
            ?>
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
