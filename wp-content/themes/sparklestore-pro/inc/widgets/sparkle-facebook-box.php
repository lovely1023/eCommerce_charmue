<?php
/**
 * @package Sparkle Themes
 */
add_action('widgets_init', 'sparklestore_pro_register_facebook_box');

function sparklestore_pro_register_facebook_box() {
    register_widget('sparklestore_pro_facebook_box');
}

class sparklestore_pro_facebook_box extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'sparklestore_pro_facebook_box', '&nbsp;Facebook Box', array(
            'description' => __('A widget to Facebook Like Box', 'sparklestore-pro')
                )
        );
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
            'facebook_url' => array(
                'sparklestore_pro_widgets_name' => 'facebook_url',
                'sparklestore_pro_widgets_title' => __('Facebook Page URL', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'url'
            ),
            'tabs' => array(
                'sparklestore_pro_widgets_name' => 'tabs',
                'sparklestore_pro_widgets_title' => __('Tabs', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'multicheckbox',
                'sparklestore_pro_widgets_field_options' => array(
                    'timeline' => __('Show Timeline', 'sparklestore-pro'),
                    'messages' => __('Show Message', 'sparklestore-pro'),
                    'events' => __('Show Events', 'sparklestore-pro')
                )
            ),
            'width' => array(
                'sparklestore_pro_widgets_name' => 'width',
                'sparklestore_pro_widgets_title' => __('Width', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'number',
                'sparklestore_pro_widgets_default' => 300
            ),
            'height' => array(
                'sparklestore_pro_widgets_name' => 'height',
                'sparklestore_pro_widgets_title' => __('Height', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'number',
                'sparklestore_pro_widgets_default' => 500
            ),
            'use_small_header' => array(
                'sparklestore_pro_widgets_name' => 'use_small_header',
                'sparklestore_pro_widgets_title' => __('Use Small Header', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'checkbox'
            ),
            'hide_cover_photo' => array(
                'sparklestore_pro_widgets_name' => 'hide_cover_photo',
                'sparklestore_pro_widgets_title' => __('Hide Cover Photo', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'checkbox'
            ),
            'show_faces' => array(
                'sparklestore_pro_widgets_name' => 'show_faces',
                'sparklestore_pro_widgets_title' => __('Show Friend\'s Faces', 'sparklestore-pro'),
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
        $facebook_url = isset($instance['facebook_url']) ? $instance['facebook_url'] : '';
        $tabs = isset($instance['tabs']) ? $instance['tabs'] : '';
        $width = isset($instance['width']) ? $instance['width'] : 300;
        $height = isset($instance['height']) ? $instance['height'] : 500;
        $use_small_header = (isset($instance['use_small_header']) && $instance['use_small_header'] == '1') ? 'true' : 'false';
        $hide_cover_photo = (isset($instance['hide_cover_photo']) && $instance['hide_cover_photo'] == '1') ? 'true' : 'false';
        $show_faces = (isset($instance['show_faces']) && $instance['show_faces'] == '1') ? 'true' : 'false';
        if (!empty($tabs)) {
            $new = array();
            foreach ($tabs as $tab_key => $tab_value) {
                $new[] = $tab_key;
            }
            $data_tabs = implode(',', $new);
        }
        echo $before_widget;
    ?>
        <div class="container">
            <?php
                if (!empty($title)):
                    echo $before_title . apply_filters('widget_title', $title) . $after_title;
                endif;
            ?>
            <script>
                (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=699919794195053';
                fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>
            <div class="cl-facebook-box">
                <div class="fb-page" 
                    data-href="<?php echo esc_url($facebook_url) ?>" 
                    data-width="<?php echo absint($width) ?>"
                    data-height="<?php echo absint($height) ?>" 
                    data-small-header="<?php echo esc_attr($use_small_header) ?>" 
                    data-adapt-container-width="true" 
                    data-hide-cover="<?php echo esc_attr($hide_cover_photo) ?>" 
                    data-show-facepile="<?php echo esc_attr($show_faces) ?>"
                    data-tabs="<?php echo esc_attr($data_tabs); ?>" >
                    <blockquote cite="<?php echo esc_url($facebook_url) ?>" class="fb-xfbml-parse-ignore">
                        <a href="<?php echo esc_url($facebook_url) ?>">Facebook</a>
                    </blockquote>
                </div>
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