<?php
/**
 * @package Sparkle Themes
 */
add_action('widgets_init', 'sparklestore_pro_register_social_icons');

function sparklestore_pro_register_social_icons() {
    register_widget('sparklestore_pro_social_icons');
}

class sparklestore_pro_social_icons extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'sparklestore_pro_social_icons', '&nbsp;Social Icons List', array(
            'description' => __('A widget to display Social Icons', 'sparklestore-pro')
        ));
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
            'style' => array(
                'sparklestore_pro_widgets_name' => 'style',
                'sparklestore_pro_widgets_title' => __('Style', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_field_options' => array(
                    'style1' => __('Square', 'sparklestore-pro'),
                    'style2' => __('Circle', 'sparklestore-pro'),
                    'style3' => __('Square Outline', 'sparklestore-pro'),
                    'style4' => __('Circle Outline', 'sparklestore-pro'),
                    'style5' => __('Rounded Corner', 'sparklestore-pro'),
                    'style6' => __('Rounded Corner With Circle', 'sparklestore-pro'),
                    'style7' => __('3D', 'sparklestore-pro')
                )
            ),
            'align' => array(
                'sparklestore_pro_widgets_name' => 'align',
                'sparklestore_pro_widgets_title' => __('Alignment', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_field_options' => array(
                    'left' => __('Left', 'sparklestore-pro'),
                    'center' => __('Center', 'sparklestore-pro'),
                    'right' => __('Right', 'sparklestore-pro')
                )
            ),
            'size' => array(
                'sparklestore_pro_widgets_name' => 'size',
                'sparklestore_pro_widgets_title' => __('Size', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_field_options' => array(
                    'small' => __('Small', 'sparklestore-pro'),
                    'normal' => __('Normal', 'sparklestore-pro'),
                    'big' => __('Big', 'sparklestore-pro'),
                    'large' => __('Large', 'sparklestore-pro')
                )
            ),
            'bg-color' => array(
                'sparklestore_pro_widgets_name' => 'bg-color',
                'sparklestore_pro_widgets_title' => __('Icon Background Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color',
                'sparklestore_pro_widgets_field_default' => '#FFFFFF'
            ),
            'icon-color' => array(
                'sparklestore_pro_widgets_name' => 'icon-color',
                'sparklestore_pro_widgets_title' => __('Icon Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color',
                'sparklestore_pro_widgets_field_default' => '#333333'
            ),
            'items' => array(
                'sparklestore_pro_widgets_name' => 'items',
                'sparklestore_pro_widgets_title' => __('Icons Box', 'sparklestore-pro'),
                'sparklestore_pro_widgets_repeater_title' => __('Icons', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'repeater',
                'sparklestore_pro_widgets_repeater_fields_title' => 'title',
                'sparklestore_pro_widgets_repeater_fields' => array(
                    'title' => array(
                        'title' => __('Title', 'sparklestore-pro'),
                        'type' => 'text'
                    ),
                    'icon' => array(
                        'title' => __('Icon', 'sparklestore-pro'),
                        'type' => 'icon',
                        'icon_array' => sparklestore_pro_brand_icon_array()
                    ),
                    'url' => array(
                        'title' => __('URL', 'sparklestore-pro'),
                        'type' => 'text'
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
        $bg_color = isset($instance['bg-color']) ? $instance['bg-color'] : '#FFFFFF';
        $icon_color = isset($instance['icon-color']) ? $instance['icon-color'] : '#333333';
        $style = isset($instance['style']) ? $instance['style'] : 'style1';
        $size = isset($instance['size']) ? $instance['size'] : 'normal';
        $align = isset($instance['align']) ? $instance['align'] : 'center';
        $items = isset($instance['items']) ? $instance['items'] : '';
        $css_style = '';
        $css_styles = array();
        if (!empty($bg_color) && ($style == 'style1' || $style == 'style2' || $style == 'style5' || $style == 'style6' || $style == 'style7')) {
            $css_styles[] = "background-color:$bg_color";
        }

        if (!empty($icon_color)) {
            $css_styles[] = "color:$icon_color";
            $css_styles[] = "border-color:$icon_color";
        }

        if (!empty($css_styles)) {
            $css_style = 'style="' . implode(';', $css_styles) . '"';
        }

        $class = array(
            'sparkle-social-icons',
            $style,
            'icon-' . $size,
            'icon-' . $align
        );

        if ($style == 'style5' || $style == 'style6' || $style == 'style7') {
            $class[] = 'rounded-corner';
        }

        echo $before_widget;
    ?>
        <div class="container">
            <?php
                if (!empty($title)):
                    echo $before_title . apply_filters('widget_title', $title) . $after_title;
                endif;
            ?>
            <div class="<?php echo esc_attr(implode(' ', $class)); ?>">
                <?php
                    if (!empty($items)) {
                        foreach ($items as $item) {
                            $title = $item['title'];
                            $icon = $item['icon'];
                            $url = $item['url'];
                            ?>
                            <a <?php echo $css_style; ?> class="sparkle-social-button" href="<?php echo esc_attr($url); ?>" title="<?php echo esc_attr($title); ?>" target="_blank">
                                <i class='<?php echo esc_attr($icon) ?>'></i>
                            </a>
                            <?php
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