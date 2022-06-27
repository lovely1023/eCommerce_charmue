<?php
/**
 * @package Sparkle Themes
 */
add_action('widgets_init', 'sparklestore_pro_register_contact_detail');

function sparklestore_pro_register_contact_detail() {
    register_widget('sparklestore_pro_contact_detail');
}

class sparklestore_pro_contact_detail extends WP_Widget {

    public function __construct() {
        $widget_ops = array('description' => __('A widget to display quick contact Information', 'sparklestore-pro'));
        $control_ops = array('width' => 400, 'height' => 400);
        parent::__construct('sparklestore_pro_contact_detail', '&nbsp;Contact Detail', $widget_ops, $control_ops);
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $image_path = get_template_directory_uri();

        $fields = array(

            'cl_tab' => array(
                'sparklestore_pro_widgets_tabs' => array(
                    'cl-location' => __('Location', 'sparklestore-pro'),
                    'cl-phone' => __('Phone', 'sparklestore-pro'),
                    'cl-email' => __('Email', 'sparklestore-pro'),
                    'cl-style' => __('Style', 'sparklestore-pro')
                ),
                'sparklestore_pro_widgets_field_type' => 'tab'
            ),

            'tab_open' => array(
                'sparklestore_pro_widgets_class' => 'cl-widget-tab-content-wrap',
                'sparklestore_pro_widgets_field_type' => 'open'
            ),

            'location_open' => array(
                'sparklestore_pro_widgets_class' => 'cl-widget-tab-content',
                'sparklestore_pro_widgets_data_id' => 'cl-location',
                'sparklestore_pro_widgets_field_type' => 'open'
            ),
            
            'location_icon' => array(
                'sparklestore_pro_widgets_name' => 'location_icon',
                'sparklestore_pro_widgets_title' => __('Icon', 'sparklestore-pro'),
                'sparklestore_pro_widgets_default' => 'fas fa-map-marker-alt',
                'sparklestore_pro_widgets_field_type' => 'icon'
            ),
            'location_main_text' => array(
                'sparklestore_pro_widgets_name' => 'location_main_text',
                'sparklestore_pro_widgets_title' => __('Main Text', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text',
                'sparklestore_pro_widgets_default' => __('Find Us', 'sparklestore-pro')
            ),
            'location_sub_text' => array(
                'sparklestore_pro_widgets_name' => 'location_sub_text',
                'sparklestore_pro_widgets_title' => __('Sub Text', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'textarea',
                'sparklestore_pro_widgets_default' => __('Kathmandu, Nepal', 'sparklestore-pro')
            ),
            'location_close' => array(
                'sparklestore_pro_widgets_field_type' => 'close'
            ),
            'phone_open' => array(
                'sparklestore_pro_widgets_class' => 'cl-widget-tab-content',
                'sparklestore_pro_widgets_data_id' => 'cl-phone',
                'sparklestore_pro_widgets_field_type' => 'open'
            ),
            'phone_icon' => array(
                'sparklestore_pro_widgets_name' => 'phone_icon',
                'sparklestore_pro_widgets_title' => __('Icon', 'sparklestore-pro'),
                'sparklestore_pro_widgets_default' => 'fas fa-phone',
                'sparklestore_pro_widgets_field_type' => 'icon'
            ),
            'phone_main_text' => array(
                'sparklestore_pro_widgets_name' => 'phone_main_text',
                'sparklestore_pro_widgets_title' => __('Main Text', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text',
                'sparklestore_pro_widgets_default' => __('Ring Us', 'sparklestore-pro')
            ),
            'phone_sub_text' => array(
                'sparklestore_pro_widgets_name' => 'phone_sub_text',
                'sparklestore_pro_widgets_title' => __('Sub Text', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'textarea',
                'sparklestore_pro_widgets_default' => __('+977 - 9802075711', 'sparklestore-pro')
            ),
            'phone_close' => array(
                'sparklestore_pro_widgets_field_type' => 'close'
            ),
            'email_open' => array(
                'sparklestore_pro_widgets_class' => 'cl-widget-tab-content',
                'sparklestore_pro_widgets_data_id' => 'cl-email',
                'sparklestore_pro_widgets_field_type' => 'open'
            ),
            'email_icon' => array(
                'sparklestore_pro_widgets_name' => 'email_icon',
                'sparklestore_pro_widgets_title' => __('Icon', 'sparklestore-pro'),
                'sparklestore_pro_widgets_default' => 'fas fa-envelope-open',
                'sparklestore_pro_widgets_field_type' => 'icon'
            ),
            'email_main_text' => array(
                'sparklestore_pro_widgets_name' => 'email_main_text',
                'sparklestore_pro_widgets_title' => __('Main Text', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'text',
                'sparklestore_pro_widgets_default' => __('Mail Us', 'sparklestore-pro')
            ),
            'email_sub_text' => array(
                'sparklestore_pro_widgets_name' => 'email_sub_text',
                'sparklestore_pro_widgets_title' => __('Sub Text', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'textarea',
                'sparklestore_pro_widgets_default' => __('info@sparklewptheme.com', 'sparklestore-pro')
            ),
            'email_close' => array(
                'sparklestore_pro_widgets_field_type' => 'close'
            ),
            'style_open' => array(
                'sparklestore_pro_widgets_class' => 'cl-widget-tab-content',
                'sparklestore_pro_widgets_data_id' => 'cl-style',
                'sparklestore_pro_widgets_field_type' => 'open'
            ),
            'sp_layout' => array(
                'sparklestore_pro_widgets_name' => 'sp_layout',
                'sparklestore_pro_widgets_title' => __('Contact Detail Style', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'selector',
                'sparklestore_pro_widgets_field_options' => array(
                    'style1' => $image_path . '/inc/widgets/images/contact-detail1.png',
                    'style2' => $image_path . '/inc/widgets/images/contact-detail2.png',
                    'style3' => $image_path . '/inc/widgets/images/contact-detail3.png'
                ),
                'sparklestore_pro_widgets_default' => 'style1'
            ),
            'icon_color' => array(
                'sparklestore_pro_widgets_name' => 'icon_color',
                'sparklestore_pro_widgets_title' => __('Icon Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color'
            ),
            'title_color' => array(
                'sparklestore_pro_widgets_name' => 'title_color',
                'sparklestore_pro_widgets_title' => __('Title Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color'
            ),
            'text_color' => array(
                'sparklestore_pro_widgets_name' => 'text_color',
                'sparklestore_pro_widgets_title' => __('Text Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color'
            ),
            'style_close' => array(
                'sparklestore_pro_widgets_field_type' => 'close'
            ),
            'tab_close' => array(
                'sparklestore_pro_widgets_field_type' => 'close'
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

        $sp_layout = isset($instance['sp_layout']) ? $instance['sp_layout'] : '';
        $location_icon = isset($instance['location_icon']) ? $instance['location_icon'] : 'fa fa-map-marker';
        $location_main_text = isset($instance['location_main_text']) ? $instance['location_main_text'] : 'Find Us';
        $location_sub_text = isset($instance['location_sub_text']) ? $instance['location_sub_text'] : 'Arizona Park, Australia';
        $phone_icon = isset($instance['phone_icon']) ? $instance['phone_icon'] : 'fa fa-phone';
        $phone_main_text = isset($instance['phone_main_text']) ? $instance['phone_main_text'] : 'Ring Us';
        $phone_sub_text = isset($instance['phone_sub_text']) ? $instance['phone_sub_text'] : '+61 45768202';
        $email_icon = isset($instance['email_icon']) ? $instance['email_icon'] : 'fa fa-envelope-o';
        $email_main_text = isset($instance['email_main_text']) ? $instance['email_main_text'] : 'Mail Us';
        $email_sub_text = isset($instance['email_sub_text']) ? $instance['email_sub_text'] : 'info@totalplus.com';
        $icon_color = isset($instance['icon_color']) ? $instance['icon_color'] : '';
        $title_color = isset($instance['title_color']) ? $instance['title_color'] : '';
        $text_color = isset($instance['text_color']) ? $instance['text_color'] : '';
        $icon_style = $title_style = $text_style = '';

        if (!empty($icon_color)) {
            $icon_style = 'style="color:' . $icon_color . '"';
        }

        if (!empty($title_color)) {
            $title_style = 'style="color:' . $title_color . '"';
        }

        if (!empty($text_color)) {
            $text_style = 'style="color:' . $text_color . '"';
        }

        echo $before_widget;
        ?>
        <div class="container">
            <div class="cl-contact-box <?php echo esc_attr($sp_layout); ?>">
                <?php if (!empty($location_main_text) && !empty($location_sub_text)) { ?>
                    <div class="cl-contact-field">
                        <i class="<?php echo esc_attr($location_icon); ?>" <?php echo $icon_style; ?>></i>
                        <div class="cl-contact-text">
                            <h6 <?php echo $title_style; ?>><?php echo esc_html($location_main_text); ?></h6>
                            <div <?php echo $text_style; ?>><?php echo wp_kses_post(wpautop($location_sub_text)); ?></div>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!empty($phone_main_text) && !empty($phone_sub_text)) { ?>
                    <div class="cl-contact-field">
                        <i class="<?php echo esc_attr($phone_icon); ?>" <?php echo $icon_style; ?>></i>
                        <div class="cl-contact-text">
                            <h6 <?php echo $title_style; ?>><?php echo esc_html($phone_main_text); ?></h6>
                            <div <?php echo $text_style; ?>><?php echo wp_kses_post(wpautop($phone_sub_text)); ?></div>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!empty($email_main_text) || !empty($email_sub_text)) { ?>
                    <div class="cl-contact-field">
                        <i class="<?php echo esc_attr($email_icon); ?>" <?php echo $icon_style; ?>></i>
                        <div class="cl-contact-text">
                            <h6 <?php echo $title_style; ?>><?php echo esc_html($email_main_text); ?></h6>
                            <div <?php echo $text_style; ?>><?php echo wp_kses_post(wpautop($email_sub_text)); ?></div>
                        </div>
                    </div>
                <?php } ?>
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
            } else {
                $sparklestore_pro_widgets_field_value = '';
            }

            sparklestore_pro_widgets_show_widget_field($this, $widget_field, $sparklestore_pro_widgets_field_value);
        }
    }

}
