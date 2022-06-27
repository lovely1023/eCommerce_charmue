<?php
/**
 * @package Sparkle Themes
 */
add_action('widgets_init', 'sparklestore_pro_register_tabs');

function sparklestore_pro_register_tabs() {
    register_widget('sparklestore_pro_tabs');
}

class sparklestore_pro_tabs extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'sparklestore_pro_tabs', esc_html__('&nbsp; Normal Tabs','sparklestore-pro'), array(
            'description' => esc_html__('A widget to display Tabs', 'sparklestore-pro')
        ));
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'title' => array(
                'sparklestore_pro_widgets_name' => 'title',
                'sparklestore_pro_widgets_title' => __('Title', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text'
            ),
            'style' => array(
                'sparklestore_pro_widgets_name' => 'style',
                'sparklestore_pro_widgets_title' => __('Tabs Layout', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'style3',
                'sparklestore_pro_widgets_field_options' => array(
                    'style1' => __('Style One', 'sparklestore-pro'),
                    'style2' => __('Style Two', 'sparklestore-pro'),
                    'style3' => __('Style Three', 'sparklestore-pro'),
                    'style5' => __('Style Four', 'sparklestore-pro')
                )
            ),
            'items' => array(
                'sparklestore_pro_widgets_name' => 'items',
                'sparklestore_pro_widgets_title' => __('Tabs Box', 'sparklestore-pro'),
                'sparklestore_pro_widgets_repeater_title' => __('Tabs', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'repeater',
                'sparklestore_pro_widgets_repeater_fields_title' => 'title',
                'sparklestore_pro_widgets_repeater_fields' => array(
                    'icon' => array(
                        'title' => __('Icon', 'sparklestore-pro'),
                        'type' => 'icon'
                    ),
                    'title' => array(
                        'title' => __('Tabs Title', 'sparklestore-pro'),
                        'type' => 'text'
                    ),
                    'content' => array(
                        'title' => __('Tabs Content', 'sparklestore-pro'),
                        'type' => 'editor'
                    )
                ),
                'sparklestore_pro_widgets_add_button' => __('Add New', 'sparklestore-pro')
            )
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        
        extract($args);

        $title = isset($instance['title']) ? $instance['title'] : '';
        $items = isset($instance['items']) ? $instance['items'] : '';
        $style = isset($instance['style']) ? $instance['style'] : '';

        echo $before_widget;
    ?>
        <div class="container">
            <?php
            if (!empty($title)):
                echo $before_title . apply_filters('widget_title', $title) . $after_title;
            endif;
            ?>

            <?php if (!empty($items)) { ?>
                <div class="sparkle-tab-wrap clearfix <?php echo esc_attr($style); ?>">
                    <div class="sparkle-tabs">
                        <?php
                            $i = 0;
                            $tab_array = array();
                            foreach ($items as $item) {
                            $tab_array[$i] = rand();
                            $tab_id = 'sparkle-tab-' . $tab_array[$i];
                        ?>
                            <div class="sparkle-tab" id="<?php echo $tab_id ?>">
                                <i class="<?php echo esc_html($item['icon']); ?>"></i>
                                <span><?php echo esc_html($item['title']); ?></span>
                            </div>
                        <?php
                            $i++;
                        }
                        ?>
                    </div>

                    <div class="sparkle-tab-content clearfix">
                        <?php
                            $i = 0;
                            foreach ($items as $item) {
                            $tab_content = 'sparkle-content-' . $tab_array[$i];
                        ?>
                            <div class="sparkle-content" id="<?php echo $tab_content; ?>">
                                <?php echo wp_kses_post(wpautop($item['content'])); ?>
                            </div>
                        <?php
                            $i++;
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>

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
