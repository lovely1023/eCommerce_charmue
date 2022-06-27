<?php
/**
 * @package Sparkle Themes
 */
add_action('widgets_init', 'sparklestore_pro_register_instagram');

function sparklestore_pro_register_instagram() {
    register_widget('sparklestore_pro_instagram');
}

class sparklestore_pro_instagram extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'sparklestore_pro_instagram', '&nbsp; Instagram', array(
            'description' => __('A widget to display Instagram Images', 'sparklestore-pro')
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
            'accesstoken' => array(
                'sparklestore_pro_widgets_name' => 'accesstoken',
                'sparklestore_pro_widgets_title' => __('Access Token', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text',
                'sparklestore_pro_widgets_description' => sprintf( __( 'More Detail: <a rel="designer" target="_blank" href="%1$s">Click Here</a>', 'sparklestore-pro' ), esc_url( 'https://rudrastyh.com/tools/access-token' ) )
            ),
            'user_id' => array(
                'sparklestore_pro_widgets_name' => 'user_id',
                'sparklestore_pro_widgets_title' => __('User Id', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text',
                'sparklestore_pro_widgets_description' => sprintf( __( 'About UserId Detail: <a rel="designer" target="_blank" href="%1$s">Click Here</a>', 'sparklestore-pro' ), esc_url( 'https://codeofaninja.com/tools/find-instagram-user-id' ) )
            ),
            'sort_by' => array(
                'sparklestore_pro_widgets_name' => 'sort_by',
                'sparklestore_pro_widgets_title' => __('Sort By', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_field_options' => array(
                    'none' => esc_html__('None', 'sparklestore-pro'),
                    'most-recent' => esc_html__('Newest to oldest', 'sparklestore-pro'),
                    'least-recent' => esc_html__('Oldest to newest', 'sparklestore-pro'),
                    'most-liked' => esc_html__('Highest # of likes to lowest', 'sparklestore-pro'),
                    'least-liked' => esc_html__('Lowest # likes to highest', 'sparklestore-pro'),
                    'most-commented' => esc_html__('Highest # of comments to lowest', 'sparklestore-pro'),
                    'least-commented' => esc_html__('Lowest # of comments to highest', 'sparklestore-pro'),
                    'random' => esc_html__('Random', 'sparklestore-pro')
                )
            ),
            'limit' => array(
                'sparklestore_pro_widgets_name' => 'limit',
                'sparklestore_pro_widgets_title' => __('No of Image to Display', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'number',
                'sparklestore_pro_widgets_default' => '10'
            ),
            'resolution' => array(
                'sparklestore_pro_widgets_name' => 'resolution',
                'sparklestore_pro_widgets_title' => __('Image Size', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_field_options' => array(
                    'thumbnail' => esc_html__('Small', 'sparklestore-pro'),
                    'low_resolution' => esc_html__('Medium', 'sparklestore-pro'),
                    'standard_resolution' => esc_html__('Large', 'sparklestore-pro')
                ),
                'sparklestore_pro_widgets_default' => 'thumbnail'
            ),
            'row_height' => array(
                'sparklestore_pro_widgets_name' => 'row_height',
                'sparklestore_pro_widgets_title' => esc_html__('Row Height', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'number',
                'sparklestore_pro_widgets_default' => 120,
                'sparklestore_pro_widgets_description' => esc_html__('The height determines the no of image in row', 'sparklestore-pro')
            ),
            'enable_space' => array(
                'sparklestore_pro_widgets_name' => 'enable_space',
                'sparklestore_pro_widgets_title' => esc_html__('Enable Space Between Images', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'checkbox'
            ),
            'likes_count' => array(
                'sparklestore_pro_widgets_name' => 'likes_count',
                'sparklestore_pro_widgets_title' => __('Show Like Count', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'checkbox'
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
        $user_id = isset($instance['user_id']) ? $instance['user_id'] : '';
        $accesstoken = isset($instance['accesstoken']) ? $instance['accesstoken'] : '';
        $sort_by = isset($instance['sort_by']) ? $instance['sort_by'] : 'none';
        $limit = isset($instance['limit']) ? $instance['limit'] : '10';
        $resolution = isset($instance['resolution']) ? $instance['resolution'] : 'thumbnail';
        $row_height = isset($instance['row_height']) ? $instance['row_height'] : 120;
        $enable_space = (isset($instance['enable_space']) && $instance['enable_space']) ? 'enable-space' : '';
        $likes_count = isset($instance['likes_count']) ? $instance['likes_count'] : '';
        $margin = (isset($instance['enable_space']) && $instance['enable_space']) ? 10 : 0;
        $likes = '';

        echo $before_widget;
        ?>
        <div class="ht-instagram-widget">
            <?php
            if (!empty($title)):
                echo $before_title . apply_filters('widget_title', $title) . $after_title;
            endif;
            ?>
            <div id="<?php echo esc_attr($widget_id); ?>wrapper" class="ht-instagram-widget-wrap"></div>

        </div>
        <?php
        if ($likes_count) {
            $likes = '<div class="ht-iw-likes"><i class="icofont-heart"></i> {{likes}}</div>';
        }

        if (!empty($user_id) && !empty($accesstoken)) {
            ?>
            <script type="text/javascript">
                jQuery(function ($) {
                    var feed = new Instafeed({
                        get: 'user',
                        target: '<?php echo $widget_id; ?>wrapper',
                        userId: '<?php echo absint($user_id); ?>',
                        sortBy: '<?php echo $sort_by; ?>',
                        limit: '<?php echo $limit; ?>',
                        resolution: '<?php echo $resolution; ?>',
                        accessToken: '<?php echo $accesstoken; ?>',
                        template: '<a href="{{link}}" target="_blank"><img src="{{image}}" /><?php echo $likes; ?></a>',
                        after: function () {
                            $('#<?php echo esc_attr($widget_id); ?>wrapper').justifiedGallery({
                                rowHeight: <?php echo absint($row_height); ?>,
                                lastRow: 'nojustify',
                                margins: <?php echo $margin; ?>
                            });
                        }
                    });
                    feed.run();
                });
            </script>
            <?php
        }
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
