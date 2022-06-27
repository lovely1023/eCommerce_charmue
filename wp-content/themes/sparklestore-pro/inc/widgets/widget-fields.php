<?php

/**
 * @package Sparkle Themes
 */
function sparklestore_pro_widgets_show_widget_field($instance = '', $widget_field = '', $sparklestore_pro_field_value = '') {

    extract($widget_field);

    if (isset($sparklestore_pro_widgets_default)) {
        if ($sparklestore_pro_widgets_field_type == 'checkbox') {
            $sparklestore_pro_field_value = !empty($sparklestore_pro_field_value) ? $sparklestore_pro_field_value : '0';
        } else {
            $sparklestore_pro_field_value = !empty($sparklestore_pro_field_value) ? $sparklestore_pro_field_value : $sparklestore_pro_widgets_default;
        }
    }

    $sparklestore_pro_widgets_class = isset($sparklestore_pro_widgets_class) ? $sparklestore_pro_widgets_class : '';
    $sparklestore_pro_widgets_row = isset($sparklestore_pro_widgets_row) ? $sparklestore_pro_widgets_row : 3;

    switch ($sparklestore_pro_widgets_field_type) {
        case 'tab' :
            $selector = 'sparklestore_pro_' . md5(uniqid(rand(), true));
            ?>
            <script>
                jQuery(function ($) {
                    var id = $('#<?php echo $selector; ?>').parent();
                    sparkle_widget_tabs(id);
                });
            </script>
            <div class="cl-widget-tab <?php echo $sparklestore_pro_widgets_class; ?>" id="<?php echo $selector; ?>">
                <?php
                foreach ($sparklestore_pro_widgets_tabs as $sparklestore_pro_widgets_class => $sparklestore_pro_widgets_tab_name) {
                    ?>
                    <div class="<?php echo esc_attr($sparklestore_pro_widgets_class); ?>"><?php echo esc_html($sparklestore_pro_widgets_tab_name) ?></div>
                <?php }
                ?>
            </div>
            <?php
            break;

        case 'open' :
            $data_id = '';
            if (isset($sparklestore_pro_widgets_data_id)) {
                $data_id .= 'data-id ="' . $sparklestore_pro_widgets_data_id . '"';
            }
            echo '<div class ="' . $sparklestore_pro_widgets_class . '" ' . $data_id . '>';
            break;

        case 'close' :
            echo '</div>';
            break;

        case 'icon' :
            ?>
            <div class="cl-widget-icon-box cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>">
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>"><?php echo esc_html($sparklestore_pro_widgets_title); ?>:</label>
                <?php } ?>

                <div class="cl-selected-icon">
                    <i class="<?php echo esc_attr($sparklestore_pro_field_value); ?>"></i>
                    <span><i class="fas fa-angle-down"></i></span>
                </div>

                <div class="cl-icon-box">
                    <div class="cl-icon-search">
                        <input type="text" class="cl-icon-search-input" placeholder="<?php echo esc_attr__('Type to filter', 'sparklestore-pro') ?>" />
                    </div>

                    <ul class="cl-icon-list clearfix">
                        <?php
                        if (isset($sparklestore_pro_icon_array) && !empty($sparklestore_pro_icon_array)) {
                            $icon_array = $sparklestore_pro_icon_array;
                        } else {
                            $icon_array = sparklestore_pro_font_awesome_icon_array();
                        }

                        foreach ($icon_array as $icon) {
                            $icon_class = ($sparklestore_pro_field_value == $icon) ? 'icon-active' : '';
                            echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($icon) . '"></i></li>';
                        }
                        ?>
                    </ul>
                </div>
                <input type="hidden" name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name); ?>" value="<?php echo esc_attr($sparklestore_pro_field_value); ?>" />

                <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>
            </div>
            <?php
            break;

        case 'selector' :
            ?>
            <p class="cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>">
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label><?php echo esc_html($sparklestore_pro_widgets_title); ?></label>
                <?php } ?>

                <?php foreach ($sparklestore_pro_widgets_field_options as $sparklestore_pro_option_name => $sparklestore_pro_option_title) { ?>
                    <label class="image-label" for="<?php echo $instance->get_field_id($sparklestore_pro_option_name); ?>">
                        <input id="<?php echo $instance->get_field_id($sparklestore_pro_option_name); ?>" name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name); ?>" type="radio" value="<?php echo esc_attr($sparklestore_pro_option_name); ?>" <?php checked($sparklestore_pro_option_name, $sparklestore_pro_field_value); ?> />
                        <img src="<?php echo esc_url($sparklestore_pro_option_title); ?>" />
                    </label>
                <?php }
                ?>

                <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'text' :
            ?>
            <p class="cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>">
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>"><?php echo esc_html($sparklestore_pro_widgets_title); ?>:</label>
                <?php } ?>

                <input class="widefat" id="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>" name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name); ?>" type="text" value="<?php echo esc_html($sparklestore_pro_field_value); ?>" />

                <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'url' :
            ?>
            <p class="cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>">
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>"><?php echo esc_html($sparklestore_pro_widgets_title); ?>:</label>
                <?php } ?>

                <input class="widefat" id="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>" name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name); ?>" type="text" value="<?php echo esc_url($sparklestore_pro_field_value); ?>" />

                <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'editor' :
            ?>
            <p class="cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>">
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>"><?php echo esc_html($sparklestore_pro_widgets_title); ?>:</label>
                <?php }
                ?>
                <input class="widefat" id="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>" name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name); ?>" value="<?php echo htmlentities($sparklestore_pro_field_value); ?>" type="hidden" />
                <a href="#" class="button cl-wp-editor-button"><?php esc_html_e('Add/Edit Content', 'sparklestore-pro') ?></a>

                <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'inline_editor' :
            $selector = 'sparklestore_pro_' . md5(uniqid(rand(), true));
            ?>
            <div class="cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>" id="<?php echo $selector; ?>">
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>"><?php echo esc_html($sparklestore_pro_widgets_title); ?>:</label>
                <?php } ?>

                <textarea class="widefat cl-inline-editor" rows="<?php echo absint($sparklestore_pro_widgets_row); ?>" id="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>" name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name); ?>"><?php echo wp_kses_post($sparklestore_pro_field_value); ?></textarea>

                <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>
            </div>
            <script>
                jQuery(function ($) {
                    if (!$('body').hasClass('wp-customizer')) {
                        sparkle_widget_editor('#<?php echo $selector; ?>');
                    }
                });
            </script>
            <?php
            break;

        case 'textarea' :
            ?>
            <p class="cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>">
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>"><?php echo esc_html($sparklestore_pro_widgets_title); ?>:</label>
                <?php } ?>

                <textarea class="widefat" rows="<?php echo absint($sparklestore_pro_widgets_row); ?>" id="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>" name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name); ?>"><?php echo wp_kses_post($sparklestore_pro_field_value); ?></textarea>

                <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'color' :
            $selector = 'sparklestore_pro_' . md5(uniqid(rand(), true));
            ?>
            <div class="cl-color-widget cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>" id="<?php echo $selector; ?>">
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>"><?php echo esc_html($sparklestore_pro_widgets_title); ?>:</label>
                <?php } ?>

                <input class="cl-widget-color-picker" id="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>" name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name); ?>" type="text" value="<?php echo esc_attr($sparklestore_pro_field_value) ?>"/>

                <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>
            </div>
            <script>
                jQuery(function ($) {
                    if (!$('body').hasClass('wp-customizer')) {
                        sparkle_widget_color_picker('#<?php echo $selector; ?>');
                    }
                });
            </script>
            <?php
            break;

        case 'alpha-color' :
            $selector = 'sparklestore_pro_' . md5(uniqid(rand(), true));
            $show_opacity = true;
            ?>
            <div class="cl-color-widget cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>" id="<?php echo $selector; ?>">
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>"><?php echo esc_html($sparklestore_pro_widgets_title); ?>:</label>
                <?php } ?>

                <input class="cl-widget-color-picker alpha-color-control" id="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>" name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name); ?>" type="text" value="<?php echo esc_attr($sparklestore_pro_field_value) ?>"
                data-alpha="<?php echo esc_attr($show_opacity); ?>"
                data-palette="" data-default-color="<?php echo esc_attr($sparklestore_pro_field_value) ?>"
                />

                <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>
            </div>
            <script>
                jQuery(function ($) {
                    if (!$('body').hasClass('wp-customizer')) {
                        sparkle_widget_color_picker('#<?php echo $selector; ?>');
                    }
                });
            </script>
            <?php
            break;

        case 'checkbox' :
            ?>
            <p class="cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>">
                <label for="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>">
                    <span class="switch">
                        <input id="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>" name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name); ?>" type="checkbox" value="1" <?php checked('1', $sparklestore_pro_field_value); ?>/>
                        <span class="slider round"></span>
                    </span>

                    <span class="label"><?php echo esc_html($sparklestore_pro_widgets_title); ?></span>
                </label>

                <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'multicheckbox' :
            ?>
            <div class="cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>">
                
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label><?php echo esc_html($sparklestore_pro_widgets_title); ?></label>
                    <?php
                }
                echo '<div class="checkbox-wrap">';
                    if (!empty($sparklestore_pro_widgets_field_options)) {
                        foreach ($sparklestore_pro_widgets_field_options as $sparklestore_pro_option_name => $sparklestore_pro_option_title) {
                            ?>
                            <input id="<?php echo $instance->get_field_id($sparklestore_pro_option_name); ?>" name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name) . '[' . $sparklestore_pro_option_name . ']'; ?>" type="checkbox" value="1" <?php checked('1', isset($sparklestore_pro_field_value[$sparklestore_pro_option_name])); ?>/>

                            <label for="<?php echo $instance->get_field_id($sparklestore_pro_option_name); ?>"><?php echo esc_html($sparklestore_pro_option_title); ?></label><br />
                            <?php
                        }
                    } else {
                        esc_html_e('- No options found', 'sparklestore-pro');
                    }
                    ?>

                    <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                        <br />
                        <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                    <?php } ?>
                </div>
            </div>
            <?php
            break;

        case 'radio' :
            ?>
            <p class="cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>">
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label><?php echo esc_html($sparklestore_pro_widgets_title); ?></label>
                    <br />
                <?php } ?>

                <?php foreach ($sparklestore_pro_widgets_field_options as $sparklestore_pro_option_name => $sparklestore_pro_option_title) { ?>
                    <input id="<?php echo $instance->get_field_id($sparklestore_pro_option_name); ?>" name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name); ?>" type="radio" value="<?php echo esc_attr($sparklestore_pro_option_name); ?>" <?php checked($sparklestore_pro_option_name, $sparklestore_pro_field_value); ?> />
                    <label for="<?php echo $instance->get_field_id($sparklestore_pro_option_name); ?>"><?php echo esc_html($sparklestore_pro_option_title); ?></label>
                    <br />
                <?php }
                ?>

                <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'select' :
            ?>
            <p class="cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>">
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>"><?php echo esc_html($sparklestore_pro_widgets_title); ?>:</label>
                <?php } ?>

                <select name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name); ?>" id="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>" class="widefat">
                    <?php foreach ($sparklestore_pro_widgets_field_options as $sparklestore_pro_option_name => $sparklestore_pro_option_title) { ?>
                        <option value="<?php echo esc_attr($sparklestore_pro_option_name); ?>" <?php selected($sparklestore_pro_option_name, $sparklestore_pro_field_value); ?>><?php echo esc_html($sparklestore_pro_option_title); ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'multiselect' :
            ?>
            <p class="cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>">
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>"><?php echo esc_html($sparklestore_pro_widgets_title); ?>:</label>
                <?php } ?>
                    
                
                <select name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name); ?>[]" id="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>" class="widefat sp-chosen-select" multiple>
                    <?php foreach ($sparklestore_pro_widgets_field_options as $sparklestore_pro_option_name => $sparklestore_pro_option_title) { ?>
                        <?php if( in_array($sparklestore_pro_option_name, $sparklestore_pro_field_value)): ?>
                            <option value="<?php echo esc_attr($sparklestore_pro_option_name); ?>" selected><?php echo esc_html($sparklestore_pro_option_title); ?></option>
                        <?php else: ?>
                            <option value="<?php echo esc_attr($sparklestore_pro_option_name); ?>"><?php echo esc_html($sparklestore_pro_option_title); ?></option>
                        <?php endif; ?>
                    <?php } ?>
                </select>

                <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>
            </p>
            <script>
                jQuery(function ($) {
                    $(".sp-chosen-select").chosen({
                        width: "100%"
                    });
                });
            </script>

            <?php
            break;

        case 'number' :
            ?>
            <p class="cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>">
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>"><?php echo esc_html($sparklestore_pro_widgets_title); ?>:</label>
                <?php } ?>

                <input name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name); ?>" type="number" step="1" min="0" id="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>" value="<?php echo absint($sparklestore_pro_field_value); ?>" class="large-text" />

                <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'upload':
            $image = $image_class = "";
            if ($sparklestore_pro_field_value) {
                $image = '<img src="' . esc_url($sparklestore_pro_field_value) . '" style="max-width:100%;"/>';
                $image_class = ' hidden';
            }
            ?>
            <div class="cl-form-row attachment-media-view widget-media-view <?php echo $sparklestore_pro_widgets_class; ?>">

                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>"><?php echo esc_html($sparklestore_pro_widgets_title); ?>:</label>
                <?php } ?>

                <div class="placeholder<?php echo $image_class; ?>">
                    <?php esc_html_e('No image selected', 'sparklestore-pro'); ?>
                </div>
                <div class="thumbnail thumbnail-image">
                    <?php echo $image; ?>
                </div>

                <div class="actions clearfix">
                    <button type="button" class="button cl-delete-button align-left"><?php esc_html_e('Remove', 'sparklestore-pro'); ?></button>
                    <button type="button" class="button cl-upload-button alignright"><?php esc_html_e('Select Image', 'sparklestore-pro'); ?></button>

                    <input name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name); ?>" id="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>" class="upload-id" type="hidden" value="<?php echo esc_url($sparklestore_pro_field_value) ?>"/>
                </div>

                <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>

            </div>
            <?php
            break;

        case 'datepicker' :
            $selector = 'sparklestore_pro_' . md5(uniqid(rand(), true));
            ?>
            <p class="cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>" id="<?php echo $selector; ?>">
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>"><?php echo esc_html($sparklestore_pro_widgets_title); ?>:</label>
                <?php } ?>

                <input class="widefat cl-datepicker" id="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>" name="<?php echo $instance->get_field_name($sparklestore_pro_widgets_name); ?>" type="text" value="<?php echo esc_html($sparklestore_pro_field_value); ?>" autocomplete="off" />

                <?php if (isset($sparklestore_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>
            </p>
            <script>
                jQuery(function ($) {
                    if (!$('body').hasClass('wp-customizer')) {
                        sparkle_widget_datepicker('#<?php echo $selector; ?>');
                    }
                });
            </script>
            <?php
            break;

        case 'heading' :
            ?>
            <p class="cl-form-row <?php echo $sparklestore_pro_widgets_class; ?>">
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <label class="label-headding" for="<?php echo $instance->get_field_id($sparklestore_pro_widgets_name); ?>"><?php echo esc_html($sparklestore_pro_widgets_title); ?>:</label>
                    <?php
                }

                if (isset($sparklestore_pro_widgets_description)) {
                    ?>
                    <br />
                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'repeater':
            $selector = 'sparklestore_pro_' . md5(uniqid(rand(), true));
            ?>
            <div class="cl-form-row cl-widget-repeater-wrap <?php echo $sparklestore_pro_widgets_class; ?>" id="<?php echo $selector; ?>">
                <?php if (isset($sparklestore_pro_widgets_title)) { ?>
                    <p><?php echo esc_html($sparklestore_pro_widgets_title); ?></p>
                    <?php
                }

                if (!is_array($sparklestore_pro_field_value)) {
                    foreach ($sparklestore_pro_widgets_repeater_fields as $key => $sparklestore_pro_widgets_repeater_field) {
                        $sparklestore_pro_default_fields[$key] = '';
                    }

                    $sparklestore_pro_field_value = array();
                    $sparklestore_pro_field_value[1] = $sparklestore_pro_default_fields;
                }

                $count = count($sparklestore_pro_field_value);
                
                $limit = '';
                if( isset($sparklestore_pro_widgets_repeater_limit)){
                    $limit = 'data-limit='.intval($sparklestore_pro_widgets_repeater_limit);
                }

                ?>

                <div class="cl-widget-repeater" data-count="<?php echo $count; ?>" <?php echo $limit; ?>>
                    <?php
                    $i = 0;
                    foreach ($sparklestore_pro_field_value as $sparklestore_pro_field_val) {
                        $i++;
                        ?>
                        <div class="cl-widget-repeater-box">
                            <?php if (!empty($sparklestore_pro_widgets_repeater_title)) { ?>
                                <div class="cl-repeater-box-title"><?php echo '<span>' . esc_html($sparklestore_pro_widgets_repeater_title) ?>
                                <?php if($sparklestore_pro_widgets_repeater_fields_title != '') echo ' - ' . $sparklestore_pro_field_val[$sparklestore_pro_widgets_repeater_fields_title] ?>
                                <?php echo '</span>'; ?> <span class="cl-repeater-toggle"></span></div>
                            <?php }
                            ?>
                            <div class="cl-repeater-content" style="display:none">
                                <?php
                                foreach ($sparklestore_pro_widgets_repeater_fields as $key => $sparklestore_pro_widgets_repeater_field) {
                                    $id = $instance->get_field_id($sparklestore_pro_widgets_name . '-' . $i . '-' . $key);
                                    $name = $instance->get_field_name($sparklestore_pro_widgets_name);
                                    $value = isset($sparklestore_pro_field_val[$key]) ? $sparklestore_pro_field_val[$key] : '';

                                    switch ($sparklestore_pro_widgets_repeater_field['type']) {
                                        case 'text':
                                            ?>
                                            <p>
                                                <?php if (isset($sparklestore_pro_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($sparklestore_pro_widgets_repeater_field['title']); ?>:</label><br />
                                                <?php }
                                                ?>
                                                <input class="widefat" id="<?php echo esc_attr($id); ?>" name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>" type="text" value="<?php echo wp_kses_post($value); ?>" />

                                                <?php if (isset($sparklestore_pro_widgets_repeater_field['desc'])) { ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_repeater_field['desc']); ?></small>
                                                <?php }
                                                ?>
                                            </p>
                                            <?php
                                            break;

                                        case 'textarea':
                                            ?>
                                            <p>
                                                <?php if (isset($sparklestore_pro_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($sparklestore_pro_widgets_repeater_field['title']); ?>:</label><br />
                                                <?php }
                                                ?>
                                                <textarea class="widefat" id="<?php echo esc_attr($id); ?>" name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>"><?php echo wp_kses_post($value); ?></textarea>

                                                <?php if (isset($sparklestore_pro_widgets_repeater_field['desc'])) { ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_repeater_field['desc']); ?></small>
                                                <?php }
                                                ?>
                                            </p>
                                            <?php
                                            break;

                                        case 'select' :
                                            ?>
                                            <p>
                                                <?php if (isset($sparklestore_pro_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($sparklestore_pro_widgets_repeater_field['title']); ?>:</label><br />
                                                    <?php
                                                }

                                                $options = $sparklestore_pro_widgets_repeater_field['options'];
                                                if ($options) {
                                                    ?>
                                                    <select name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>" id="<?php echo esc_attr($id); ?>" class="widefat">
                                                        <?php foreach ($options as $sparklestore_pro_option_name => $sparklestore_pro_option_title) { ?>
                                                            <option value="<?php echo esc_attr($sparklestore_pro_option_name); ?>" <?php selected($sparklestore_pro_option_name, $value); ?>><?php echo esc_html($sparklestore_pro_option_title); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php
                                                }
                                                if (isset($sparklestore_pro_widgets_repeater_field['desc'])) {
                                                    ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_repeater_field['desc']); ?></small>
                                                <?php }
                                                ?>
                                            </p>
                                            <?php
                                            break;

                                        case 'icon' :
                                            ?>
                                            <div class="cl-widget-icon-box">
                                                <?php if (isset($sparklestore_pro_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($sparklestore_pro_widgets_repeater_field['title']); ?>:</label><br />
                                                <?php }
                                                ?>

                                                <div class="cl-selected-icon">
                                                    <i class="<?php echo esc_attr($value); ?>"></i>
                                                    <span><i class="fas fa-angle-down"></i></span>
                                                </div>

                                                <div class="cl-icon-box">
                                                    <div class="cl-icon-search">
                                                        <input type="text" class="cl-icon-search-input" placeholder="<?php echo esc_attr__('Type to filter', 'sparklestore-pro') ?>" />
                                                    </div>
                                                    <ul class="cl-icon-list clearfix">
                                                        <?php
                                                        if (isset($sparklestore_pro_widgets_repeater_field['icon_array']) && !empty($sparklestore_pro_widgets_repeater_field['icon_array'])) {
                                                            $icon_array = $sparklestore_pro_widgets_repeater_field['icon_array'];
                                                        } else {
                                                            $icon_array = sparklestore_pro_font_awesome_icon_array();
                                                        }
                                                        foreach ($icon_array as $icon) {
                                                            $icon_class = $value == $icon ? 'icon-active' : '';
                                                            echo '<li class=' . esc_attr($icon_class) . '><i class="' . $icon . '"></i></li>';
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                                <input type="hidden" name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>" value="<?php echo esc_attr($value); ?>" />

                                                <?php if (isset($sparklestore_pro_widgets_repeater_field['desc'])) { ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_repeater_field['desc']); ?></small>
                                                <?php } ?>
                                            </div>
                                            <?php
                                            break;

                                        case 'editor' :
                                            ?>
                                            <p>
                                                <?php if (isset($sparklestore_pro_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($sparklestore_pro_widgets_repeater_field['title']); ?>:</label><br />
                                                <?php }
                                                ?>
                                                <input class="widefat" id="<?php echo esc_attr($id); ?>" name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>" value="<?php echo esc_textarea($value); ?>" type="hidden" />
                                                <a href="#" class="button cl-wp-editor-button"><?php esc_html_e('Add/Edit Content', 'sparklestore-pro') ?></a>
                                                <?php if (isset($sparklestore_pro_widgets_repeater_field['desc'])) { ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_repeater_field['desc']); ?></small>
                                                <?php } ?>
                                            </p>
                                            <?php
                                            break;

                                        case 'upload':
                                            $image = $image_class = "";
                                            if ($value) {
                                                $image = '<img src="' . esc_url($value) . '" style="max-width:100%;"/>';
                                                $image_class = ' hidden';
                                            }
                                            ?>
                                            <div class="attachment-media-view widget-media-view">

                                                <?php if (isset($sparklestore_pro_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($sparklestore_pro_widgets_repeater_field['title']); ?>:</label>
                                                <?php } ?>

                                                <div class="placeholder<?php echo $image_class; ?>">
                                                    <?php esc_html_e('No image selected', 'sparklestore-pro'); ?>
                                                </div>
                                                <div class="thumbnail thumbnail-image">
                                                    <?php echo $image; ?>
                                                </div>

                                                <div class="actions clearfix">
                                                    <button type="button" class="button cl-delete-button align-left"><?php esc_html_e('Remove', 'sparklestore-pro'); ?></button>
                                                    <button type="button" class="button cl-upload-button alignright"><?php esc_html_e('Select Image', 'sparklestore-pro'); ?></button>

                                                    <input name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>" id="<?php echo esc_attr($id); ?>" class="upload-id" type="hidden" value="<?php echo esc_url($value) ?>"/>
                                                </div>

                                                <?php if (isset($sparklestore_pro_widgets_repeater_field['desc'])) { ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($sparklestore_pro_widgets_repeater_field['desc']); ?></small>
                                                <?php } ?>

                                            </div>
                                            <?php
                                            break;
                                    }
                                }
                                ?>
                                <a href="#" class="button cl-widget-repeater-remove"><?php esc_html_e('Remove', 'sparklestore-pro'); ?></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <a href="#" class="button cl-widget-add-item"><?php echo esc_html($sparklestore_pro_widgets_add_button); ?></a>


                <?php if( isset($sparklestore_pro_widgets_repeater_limit) && $sparklestore_pro_widgets_repeater_limit) :?>
                    <p class="repeator-count-wrap"><span class="count-value"><?php echo intval($count); ?></span> <?php esc_html_e('of', 'sparklestore-pro'); ?> <?php echo intval($sparklestore_pro_widgets_repeater_limit); ?> <?php esc_html_e('blocks', 'sparklestore-pro'); ?></p>
                <?php endif; ?>


            </div>
            <script>
                jQuery(function ($) {
                    sparkle_widget_sortable('#<?php echo $selector; ?>');
                });
            </script>
            <?php
            break;
    }
}

function sparklestore_pro_exclude_widget_update($widget_field_type) {
    $uncheck_array = array('tab', 'open', 'close', 'heading');
    if(in_array($widget_field_type, $uncheck_array)){
        return true;
    }else{
        return false;
    }
}

function sparklestore_pro_widgets_updated_field_value($widget_field, $new_field_value) {
    extract($widget_field);
    if ($sparklestore_pro_widgets_field_type == 'number') {
        return absint($new_field_value);
    } elseif ($sparklestore_pro_widgets_field_type == 'editor' || $sparklestore_pro_widgets_field_type == 'inline_editor' || $sparklestore_pro_widgets_field_type == 'textarea') {
        return wp_kses_post(force_balance_tags($new_field_value));
    } elseif ($sparklestore_pro_widgets_field_type == 'url') {
        return esc_url_raw($new_field_value);
    } elseif ($sparklestore_pro_widgets_field_type == 'multicheckbox') {
        return $new_field_value;
    }elseif ($sparklestore_pro_widgets_field_type == 'multiselect') {
        return $new_field_value;
    }elseif ($sparklestore_pro_widgets_field_type == 'checkbox') {
        if ($new_field_value) {
            return '1';
        } else {
            return '0';
        }
    } elseif ($sparklestore_pro_widgets_field_type == 'repeater') {
        if (!empty($new_field_value)) {
            foreach ($new_field_value as $new_field_key => $new_field_val) {
                foreach ($new_field_val as $key => $value) {
                    $output[$new_field_key][$key] = wp_kses_post($value);
                }
            }
            return $output;
        }
    } else {
        return strip_tags($new_field_value);
    }
}
