<?php
/**
 * @package Sparkle Themes
 */
add_action('widgets_init', 'sparklestore_pro_register_flickr');

function sparklestore_pro_register_flickr() {
    register_widget('sparklestore_pro_flickr');
}

class sparklestore_pro_flickr extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'sparklestore_pro_flickr', '&nbsp;Flickr', array(
            'description' => __('A widget to display Flickr Images', 'sparklestore-pro')
        ));
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            // Title
            'title' => array(
                'sparklestore_pro_widgets_name' => 'title',
                'sparklestore_pro_widgets_title' => esc_html__('Title', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text'
            ),
            // Other fields
            'api_key' => array(
                'sparklestore_pro_widgets_name' => 'api_key',
                'sparklestore_pro_widgets_title' => esc_html__('API Key', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text'
            ),
            'flickr_id' => array(
                'sparklestore_pro_widgets_name' => 'flickr_id',
                'sparklestore_pro_widgets_title' => esc_html__('Flickr ID', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text'
            ),
            'count' => array(
                'sparklestore_pro_widgets_name' => 'count',
                'sparklestore_pro_widgets_title' => esc_html__('Number of Images', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'number',
                'sparklestore_pro_widgets_default' => '9'
            ),
            'image_size' => array(
                'sparklestore_pro_widgets_name' => 'image_size',
                'sparklestore_pro_widgets_title' => esc_html__('Image Size', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_field_options' => array(
                    'q' => esc_html__('Small Square Size', 'sparklestore-pro'),
                    't' => esc_html__('Thumbnail', 'sparklestore-pro'),
                    'n' => esc_html__('Small Size', 'sparklestore-pro'),
                    'z' => esc_html__('Medium Size', 'sparklestore-pro'),
                    'b' => esc_html__('Large Size', 'sparklestore-pro')
                ),
                'sparklestore_pro_widgets_default' => 'q'
            ),
            'enable_space' => array(
                'sparklestore_pro_widgets_name' => 'enable_space',
                'sparklestore_pro_widgets_title' => esc_html__('Enable Space Between Images', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'checkbox'
            ),
            'show_caption' => array(
                'sparklestore_pro_widgets_name' => 'show_caption',
                'sparklestore_pro_widgets_title' => esc_html__('Show Caption', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'checkbox'
            ),
            'row_height' => array(
                'sparklestore_pro_widgets_name' => 'row_height',
                'sparklestore_pro_widgets_title' => esc_html__('Row Height', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'number',
                'sparklestore_pro_widgets_default' => 120,
                'sparklestore_pro_widgets_description' => esc_html__('The height determines the no of image in row', 'sparklestore-pro')
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

        $title = isset($instance['title']) ? apply_filters('title', $instance['title']) : '';
        $flickr_id = isset($instance['flickr_id']) ? $instance['flickr_id'] : '';
        $count = isset($instance['count']) ? $instance['count'] : '';
        $api_key = isset($instance['api_key']) ? $instance['api_key'] : '';
        $image_size = isset($instance['image_size']) ? $instance['image_size'] : '';
        $enable_space = (isset($instance['enable_space']) && $instance['enable_space']) ? 'enable-space' : '';
        $show_caption = (isset($instance['show_caption']) && $instance['show_caption']) ? 'true' : 'false';
        $margin = (isset($instance['enable_space']) && $instance['enable_space']) ? 10 : 0;
        $row_height = (isset($instance['row_height']) && $instance['row_height']) ? $instance['row_height'] : 120;

        echo $before_widget; ?>


        <?php 
            if (!empty($title)):
                echo $before_title . apply_filters('widget_title', $title) . $after_title;
            endif;
        ?>
        <div class="container">
            <div id="<?php echo esc_attr($widget_id); ?>wrapper" class="<?php echo $enable_space; ?>"></div>
            <script>
                jQuery(function ($) {
                    $('#<?php echo esc_attr($widget_id); ?>wrapper').photostream({
                        api_key: '<?php echo $api_key; ?>',
                        user_id: '<?php echo $flickr_id; ?>',
                        image_size: '<?php echo $image_size; ?>',
                        image_count: '<?php echo $count; ?>',
                    });

                    $('#<?php echo esc_attr($widget_id); ?>wrapper').on('ps.complete', function () {
                        $(this).justifiedGallery({
                            rowHeight: <?php echo absint($row_height); ?>,
                            lastRow: 'nojustify',
                            captions: <?php echo $show_caption; ?>,
                            //randomize: true,
                            margins: <?php echo $margin; ?>
                        });
                    });
                });
            </script>
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
