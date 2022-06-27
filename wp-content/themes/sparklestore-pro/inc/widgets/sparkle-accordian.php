<?php
/**
 * @package Sparkle Themes
 */
add_action('widgets_init', 'sparklestore_pro_register_accordian');

function sparklestore_pro_register_accordian() {
    register_widget('sparklestore_pro_accordian');
}

class sparklestore_pro_accordian extends WP_Widget {

    public function __construct() {
        parent::__construct('sparklestore_pro_accordian', '&nbsp;Accordian Tabs', array(
            'description' => __('A widget to display Accordian', 'sparklestore-pro')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $image_path = get_template_directory_uri();
        $fields = array(
            'title' => array(
                'sparklestore_pro_widgets_name' => 'title',
                'sparklestore_pro_widgets_title' => __('Title', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text'
            ),
            'items' => array(
                'sparklestore_pro_widgets_name' => 'items',
                'sparklestore_pro_widgets_title' => __('Accordians', 'sparklestore-pro'),
                'sparklestore_pro_widgets_repeater_title' => __('Accordian', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'repeater',
                'sparklestore_pro_widgets_repeater_fields_title' => 'title',
                'sparklestore_pro_widgets_repeater_fields' => array(
                    'title' => array(
                        'title' => __('Accordian Title', 'sparklestore-pro'),
                        'type' => 'text'
                    ),
                    'content' => array(
                        'title' => __('Accordian Content', 'sparklestore-pro'),
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

        echo $before_widget;
    ?>
        <div class="container">
            <?php
                if (!empty($title)):
                    echo $before_title . apply_filters('widget_title', $title) . $after_title;
                endif;
            ?>
            <div class="accordion">
                <?php
                    if (!empty($items)) {
                    $i = 0;
                    foreach ($items as $item) {
                        $accordion_open = ($i == 0) ? ' open' : '';
                ?>
                    <div class="accordion-box<?php echo esc_attr($accordion_open); ?>">
                        <div class="accordion-header" data-control>
                            <?php echo esc_html($item['title']); ?>
                        </div>

                        <div class="accordion-content">
                            <div class="accordion-content-wrap clearfix">
                                <?php echo wp_kses_post(wpautop($item['content'])); ?>
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
