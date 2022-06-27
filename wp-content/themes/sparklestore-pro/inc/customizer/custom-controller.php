<?php 
if(class_exists( 'WP_Customize_control')):

	/**
    * Repeater Custom Control Function
    */
    class Sparklestore_Pro_Repeater_Control extends WP_Customize_Control {

        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'repeater';
        public $box_label = '';
        public $add_label = '';
        public $limit = null;
        private $cats = '';

        /**
         * The fields that each container row will contain.
         *
         * @access public
         * @var array
         */
        public $fields = array();

        /**
         * Repeater drag and drop controller
         *
         * @since  1.0.0
         */
        public function __construct($manager, $id, $args = array(), $fields = array()) {
            $this->fields = $fields;
            $this->box_label = $args['box_label'];
            $this->add_label = $args['add_label'];
            $this->cats = get_categories(array('hide_empty' => false));
            $this->repeator_label = false;
            if( isset($args['repeator_label'])) $this->repeator_label = $args['repeator_label'];

            if( isset($args['limit'])) $this->limit = $args['limit'];
            

            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            ?>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>

            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php } ?>

            <ul class="sparklestore-pro-repeater-field-control-wrap">
                <?php
                $this->sparklestore_pro_get_fields();
                ?>
            </ul>

            <input type="hidden" <?php esc_attr($this->link()); ?> class="sparklestore-pro-repeater-collector" value="<?php echo esc_attr($this->value()); ?>" />


            <input type="hidden" class="sparklestore-pro-repeater-collector-limit" value="<?php echo esc_attr($this->limit); ?>" />
            <?php $values = json_decode($this->value()); ?>
            <?php if( $this->limit ): ?>
                <span class="sparklestore-pro-block-limit"><span class="current-block-count"><?php  echo count($values); ?></span> of <?php echo intval($this->limit); ?> blocks</span>
            <?php endif; ?>

            <button type="button" class="button sparklestore-pro-add-control-field" <?php if($this->limit == count($values) ) echo 'style="display:none;"'; ?>><?php echo esc_html($this->add_label); ?></button>
            
            <?php
        }

        private function sparklestore_pro_get_fields() {
            $fields = $this->fields;
            $values = json_decode($this->value());

            if (is_array($values)) {
                foreach ($values as $value) {
                    ?>
                    <li class="sparklestore-pro-repeater-field-control">
                        <h3 class="sparklestore-pro-repeater-field-title">
                            <?php echo esc_html($this->box_label); ?>
                            <?php 
                                if( $this->repeator_label ):
                                    $t = $this->repeator_label;
                                    if(isset($value->$t) ) echo " - ". $value->$t;
                                endif;
                            ?>
                        </h3>

                        <div class="sparklestore-pro-repeater-fields">
                            <?php
                            foreach ($fields as $key => $field) {
                                $class = isset($field['class']) ? $field['class'] : '';
                                ?>
                                <div class="sparklestore-pro-fields sparklestore-pro-type-<?php echo esc_attr($field['type']) . ' ' . esc_attr($class); ?>">

                                    <?php
                                    $label = isset($field['label']) ? $field['label'] : '';
                                    $description = isset($field['description']) ? $field['description'] : '';
                                    if ($field['type'] != 'checkbox') {
                                        ?>
                                        <span class="customize-control-repeater-title"><?php echo esc_html($label); ?></span>
                                        <span class="description customize-control-description"><?php echo esc_html($description); ?></span>
                                        <?php
                                    }

                                    $new_value = isset($value->$key) ? $value->$key : '';
                                    $default = isset($field['default']) ? $field['default'] : '';

                                    switch ($field['type']) {
                                        case 'url':
                                            echo '<input data-default="' . esc_attr($default) . '" data-name="' . esc_attr($key) . '" type="url" value="' . esc_attr($new_value) . '"/>';
                                            break;

                                        
                                        case 'text':
                                            echo '<input data-default="' . esc_attr($default) . '" data-name="' . esc_attr($key) . '" type="text" value="' . esc_attr($new_value) . '"/>';
                                            break;

                                        case 'textarea':
                                            echo '<textarea data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">' . esc_textarea($new_value) . '</textarea>';
                                            break;

                                        case 'upload':
                                            $image = $image_class = "";
                                            if ($new_value) {
                                                $image = '<img src="' . esc_url($new_value) . '" style="max-width:100%;"/>';
                                                $image_class = ' hidden';
                                            }
                                            echo '<div class="sparklestore-pro-fields-wrap">';
                                            echo '<div class="attachment-media-view">';
                                            echo '<div class="placeholder' . esc_attr($image_class) . '">';
                                            esc_html_e('No image selected', 'sparklestore-pro');
                                            echo '</div>';
                                            echo '<div class="thumbnail thumbnail-image">';
                                            echo $image;
                                            echo '</div>';
                                            echo '<div class="actions clearfix">';
                                            echo '<button type="button" class="button sparklestore-pro-delete-button align-left">' . esc_html__('Remove', 'sparklestore-pro') . '</button>';
                                            echo '<button type="button" class="button sparklestore-pro-upload-button alignright">' . esc_html__('Select Image', 'sparklestore-pro') . '</button>';
                                            echo '<input data-default="' . esc_attr($default) . '" class="upload-id" data-name="' . esc_attr($key) . '" type="hidden" value="' . esc_attr($new_value) . '"/>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            break;

                                        case 'category':
                                            echo '<select data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">';
                                            echo '<option value="0">' . esc_html__('Select Category', 'sparklestore-pro') . '</option>';
                                            echo '<option value="-1">' . esc_html__('Latest Posts', 'sparklestore-pro') . '</option>';
                                            foreach ($this->cats as $cat) {
                                                printf('<option value="%1$s" %2$s>%3$s</option>', esc_attr($cat->term_id), selected($new_value, $cat->term_id, false), esc_html($cat->name));
                                            }
                                            echo '</select>';
                                            break;

                                        case 'select':
                                            $options = $field['options'];
                                            echo '<select  data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">';
                                            foreach ($options as $option => $val) {
                                                printf('<option value="%1$s" %2$s>%3$s</option>', esc_attr($option), selected($new_value, $option, false), esc_html($val));
                                            }
                                            echo '</select>';
                                            break;

                                        case 'checkbox':
                                            echo '<label>';
                                            echo '<input data-default="' . esc_attr($default) . '" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '" type="checkbox" ' . checked($new_value, 'yes', false) . '/>';
                                            echo esc_html($label);
                                            echo '<span class="description customize-control-description">' . esc_html($description) . '</span>';
                                            echo '</label>';
                                            break;

                                        case 'colorpicker':
                                            echo '<input data-default="' . esc_attr($default) . '" class="sparklestore-pro-color-picker" data-alpha="true" data-name="' . esc_attr($key) . '" type="text" value="' . esc_attr($new_value) . '"/>';
                                            break;

                                        case 'selector':
                                            $options = $field['options'];
                                            echo '<div class="selector-labels">';
                                            foreach ($options as $option => $val) {
                                                $class = ( $new_value == $option ) ? 'selector-selected' : '';
                                                echo '<label class="' . $class . '" data-val="' . esc_attr($option) . '">';
                                                echo '<img src="' . esc_url($val) . '"/>';
                                                echo '</label>';
                                            }
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;

                                        case 'radio':
                                            $options = $field['options'];
                                            echo '<div class="radio-labels">';
                                            foreach ($options as $option => $val) {
                                                echo '<label>';
                                                echo '<input value="' . esc_attr($option) . '" type="radio" ' . checked($new_value, $option, false) . '/>';
                                                echo esc_html($val);
                                                echo '</label>';
                                            }
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;

                                        case 'switch':
                                            $switch = $field['switch'];
                                            $switch_class = ($new_value == 'on') ? 'switch-on' : '';
                                            echo '<div class="onoffswitch ' . esc_attr($switch_class) . '">';
                                            echo '<div class="onoffswitch-inner">';
                                            echo '<div class="onoffswitch-active">';
                                            echo '<div class="onoffswitch-switch">' . esc_html($switch["on"]) . '</div>';
                                            echo '</div>';
                                            echo '<div class="onoffswitch-inactive">';
                                            echo '<div class="onoffswitch-switch">' . esc_html($switch["off"]) . '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;

                                        case 'range':
                                            $options = $field['options'];
                                            $new_value = $new_value ? $new_value : $options['val'];
                                            echo '<div class="sparklestore-pro-range-slider" >';
                                            echo '<div class="range-input" data-defaultvalue="' . esc_attr($options['val']) . '" data-value="' . esc_attr($new_value) . '" data-min="' . esc_attr($options['min']) . '" data-max="' . esc_attr($options['max']) . '" data-step="' . esc_attr($options['step']) . '"></div>';
                                            echo '<input  class="range-input-selector" type="text" disabled="disabled" value="' . esc_attr($new_value) . '"  data-name="' . esc_attr($key) . '"/>';
                                            echo '<span class="unit">' . esc_html($options['unit']) . '</span>';
                                            echo '</div>';
                                            break;

                                        case 'icon':
                                            echo '<div class="sparklestore-pro-customizer-icon-box">';
                                            echo '<div class="sparklestore-pro-selected-icon">';
                                            echo '<i class="' . esc_attr($new_value) . '"></i>';
                                            echo '<span><i class="fas fa-angle-down"></i></span>';
                                            echo '</div>';
                                            echo '<div class="sparklestore-pro-icon-box">';
                                            echo '<div class="sparklestore-pro-icon-search">';
                                            echo '<select>';

                                            if (apply_filters('sparklestore_pro_show_ico_font', true)) {
                                                echo '<option value="icofont-list">' . esc_html__('Ico Font', 'sparklestore-pro') . '</option>';
                                            }

                                            if (apply_filters('sparklestore_pro_show_font_awesome', true)) {
                                                echo '<option value="fontawesome-list">' . esc_html__('Font Awesome', 'sparklestore-pro') . '</option>';
                                            }

                                            echo '</select>';
                                            echo '<input type="text" class="sparklestore-pro-icon-search-input" placeholder="' . esc_html__('Type to filter', 'sparklestore-pro') . '" />';
                                            echo '</div>';

                                            if (apply_filters('sparklestore_pro_show_ico_font', true)) {
                                                echo '<ul class="sparklestore-pro-icon-list icofont-list clearfix active">';
                                                $sparklestore_pro_icofont_icon_array = sparklestore_pro_icofont_icon_array();
                                                foreach ($sparklestore_pro_icofont_icon_array as $sparklestore_pro_icofont_icon) {
                                                    $icon_class = $new_value == $sparklestore_pro_icofont_icon ? 'icon-active' : '';
                                                    echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($sparklestore_pro_icofont_icon) . '"></i></li>';
                                                }
                                                echo '</ul>';
                                            }

                                            if (apply_filters('sparklestore_pro_show_font_awesome', true)) {
                                                echo '<ul class="sparklestore-pro-icon-list fontawesome-list clearfix">';
                                                $sparklestore_pro_font_awesome_icon_array = sparklestore_pro_font_awesome_icon_array();
                                                foreach ($sparklestore_pro_font_awesome_icon_array as $sparklestore_pro_font_awesome_icon) {
                                                    $icon_class = $new_value == $sparklestore_pro_font_awesome_icon ? 'icon-active' : '';
                                                    echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($sparklestore_pro_font_awesome_icon) . '"></i></li>';
                                                }
                                                echo '</ul>';
                                            }

                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            echo '</div>';
                                            break;

                                        case 'multicategory':
                                            $new_value_array = !is_array($new_value) ? explode(',', $new_value) : $new_value;
                                            echo '<ul class="sparklestore-pro-multi-category-list">';
                                            echo '<li><label><input type="checkbox" value="-1" ' . checked('-1', $new_value, false) . '/>' . esc_html__('Latest Posts', 'sparklestore-pro') . '</label></li>';
                                            foreach ($this->cats as $cat) {
                                                $checked = in_array($cat->term_id, $new_value_array) ? 'checked="checked"' : '';
                                                echo '<li>';
                                                echo '<label>';
                                                echo '<input type="checkbox" value="' . esc_attr($cat->term_id) . '" ' . $checked . '/>';
                                                echo esc_html($cat->name);
                                                echo '</label>';
                                                echo '</li>';
                                            }
                                            echo '</ul>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr(implode(',', $new_value_array)) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;

                                        default:
                                            break;
                                    }
                                    ?>
                                </div>
                            <?php }
                            ?>

                            <div class="clearfix sparklestore-pro-repeater-footer">
                                <div class="alignright">
                                    <a class="sparklestore-pro-repeater-field-remove" href="#remove"><?php esc_html_e('Delete', 'sparklestore-pro') ?></a> |
                                    <a class="sparklestore-pro-repeater-field-close" href="#close"><?php esc_html_e('Close', 'sparklestore-pro') ?></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
            }
        }

    }


    //end repeater control
    /**
     * Dropdown Select
     */
    class Sparklestore_Pro_Dropdown_Chooser extends WP_Customize_Control {

      public $type = 'dropdown_chooser';

      public function render_content() {
          if (empty($this->choices)) {
              return;
          }
          ?>
          <label>
              <span class="customize-control-title">
                  <?php echo esc_html($this->label); ?>
              </span>

              <?php if ($this->description) { ?>
                  <span class="description customize-control-description">
                      <?php echo wp_kses_post($this->description); ?>
                  </span>
              <?php } ?>

              <select class="sp-chosen-select" <?php $this->link(); ?>>
                  <?php
                  foreach ($this->choices as $value => $label) {
                      echo '<option value="' . esc_attr($value) . '"' . selected($this->value(), $value, false) . '>' . esc_html($label) . '</option>';
                  }
                  ?>
              </select>
          </label>
          <?php
      }

    }
    /**
     * Fontawesome Icon Select
     */
    class Sparklestore_Pro_Fontawesome_Icon_Chooser extends WP_Customize_Control {

        public $type = 'icon';
        public $icon_array = array();

        public function __construct($manager, $id, $args = array()) {
            if (isset($args['icon_array'])) {
                $this->icon_array = $args['icon_array'];
            }
            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>
                <div class="sparklestore-pro-customizer-icon-box">
                    <div class="sparklestore-pro-selected-icon">
                        <i class="<?php echo esc_attr($this->value()); ?>"></i>
                        <span><i class="fas fa-angle-down"></i></span>
                    </div>

                    <div class="sparklestore-pro-icon-box">
                        <div class="sparklestore-pro-icon-search">
                            <input type="text" class="sparklestore-pro-icon-search-input" placeholder="<?php echo esc_attr__('Type to filter', 'sparklestore-pro'); ?>" />
                        </div>

                        <ul class="sparklestore-pro-icon-list clearfix active">
                            <?php
                            if (isset($this->icon_array) && !empty($this->icon_array)) {
                                $sparklestore_pro_font_awesome_icon_array = $this->icon_array;
                            } else {
                                $sparklestore_pro_font_awesome_icon_array = sparklestore_pro_font_awesome_icon_array();
                            }

                            foreach ($sparklestore_pro_font_awesome_icon_array as $sparklestore_pro_font_awesome_icon) {
                                $icon_class = $this->value() == $sparklestore_pro_font_awesome_icon ? 'icon-active' : '';
                                echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($sparklestore_pro_font_awesome_icon) . '"></i></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <input type="hidden" value="<?php esc_attr($this->value()); ?>" <?php $this->link(); ?> />
                </div>
            </label>
            <?php
        }

    }
    /**
     * Gallery Control
     */
    class Sparklestore_Pro_Display_Gallery_Control extends WP_Customize_Control {

        public $type = 'gallery';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>

                <div class="gallery-screenshot clearfix">
                    <?php
                    $value = $this->value();
                    if ($value) {
                        $ids = explode(',', $value);
                        foreach ($ids as $attachment_id) {
                            $img = wp_get_attachment_image_src($attachment_id, 'sparklestore-pro-100x100');
                            echo '<div class="screen-thumb"><img src="' . esc_url($img[0]) . '" /></div>';
                        }
                    }
                    ?>
                </div>

                <input id="edit-gallery" class="button upload_gallery_button" type="button" value="<?php esc_attr_e('Add/Edit Gallery', 'sparklestore-pro') ?>" />
                <input id="clear-gallery" class="button upload_gallery_button" type="button" value="<?php esc_attr_e('Clear', 'sparklestore-pro') ?>" />
                <input type="hidden" class="gallery_values" <?php echo $this->link() ?> value="<?php echo esc_attr($this->value()); ?>">
            </label>
            <?php
        }

    }
    
    /**
     * Multiple Checkbox Control
     */
    class Sparklestore_Pro_Multiple_Check_Control extends WP_Customize_Control {

        public $type = 'checkbox-multiple';

        public function render_content() {

            if (empty($this->choices)) {
                return;
            }
            ?>

            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>

            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php } ?>

            <?php $multi_values = !is_array($this->value()) ? explode(',', $this->value()) : $this->value(); ?>

            <ul>
                <?php foreach ($this->choices as $value => $label) : ?>

                    <li>
                        <label>
                            <input type="checkbox" value="<?php echo esc_attr($value); ?>" <?php checked(in_array($value, $multi_values)); ?> />
                            <?php echo esc_html($label); ?>
                        </label>
                    </li>

                <?php endforeach; ?>
            </ul>

            <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr(implode(',', $multi_values)); ?>" />
            <?php
        }

    }
    /**
     * Custom Heading Control
     */
    class Sparklestore_Pro_Customize_Heading extends WP_Customize_Control {

        public $type = 'heading';

        public function render_content() {
            if (!empty($this->label)) :
                ?>
                <h3 class="sparklestore-pro-accordion-section-title"><?php echo esc_html($this->label); ?></h3>
                <?php
            endif;

            if ($this->description) {
                ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php
            }
        }

    }
    /**
     * Mulitple Dropdown Control
     */
    class Sparklestore_Pro_Dropdown_Multiple_Chooser extends WP_Customize_Control {

        public $type = 'dropdown_multiple_chooser';
        public $placeholder = '';

        public function __construct($manager, $id, $args = array()) {
            $this->placeholder = $args['placeholder'];

            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            if (empty($this->choices)) {
                return;
            }
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php }
                ?>

                <select data-placeholder="<?php echo esc_attr($this->placeholder); ?>" multiple="multiple" class="sp-chosen-select" <?php $this->link(); ?>>
                    <?php
                    foreach ($this->choices as $value => $label) {
                        $selected = '';
                        if ( in_array($value, explode(',', $this->value()) ) ) {
                            $selected = 'selected="selected"';
                        }
                        echo '<option value="' . esc_attr($value) . '"' . $selected . '>' . esc_html($label) . '</option>';
                    }
                    ?>
                </select>
            </label>
            <?php
        }

    }
    /**
     * Category Dropdown
     */
    class Sparklestore_Pro_Category_Dropdown extends WP_Customize_Control {

        private $cats = false;

        public function __construct($manager, $id, $args = array(), $options = array()) {
            $this->cats = get_categories($options);

            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            if (!empty($this->cats)) {
                ?>
                <label>
                    <span class="customize-control-title">
                        <?php echo esc_html($this->label); ?>
                    </span>

                    <?php if ($this->description) { ?>
                        <span class="description customize-control-description">
                            <?php echo wp_kses_post($this->description); ?>
                        </span>
                    <?php } ?>

                    <select <?php $this->link(); ?>>
                        <?php
                        foreach ($this->cats as $cat) {
                            printf('<option value="%1$s" %2$s>%3$s</option>', esc_attr($cat->term_id), selected($this->value(), $cat->term_id, false), esc_html($cat->name));
                        }
                        ?>
                    </select>
                </label>
                <?php
            }
        }

    }
    /**
     * Image Select Control
     */
    class Sparklestore_Pro_Image_Select extends WP_Customize_Control {

        public $type = 'select';

        public function __construct($manager, $id, $args = array(), $choices = array()) {
            $this->image_path = $args['image_path'];
            $this->choices = $args['choices'];
            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            if (!empty($this->choices)) {
                ?>
                <label>
                    <span class="customize-control-title">
                        <?php echo esc_html($this->label); ?>
                    </span>

                    <?php if ($this->description) { ?>
                        <span class="description customize-control-description">
                            <?php echo wp_kses_post($this->description); ?>
                        </span>
                    <?php } ?>

                    <select class="select-image-control" <?php $this->link(); ?>>
                        <?php
                        foreach ($this->choices as $key => $choice) {
                            printf('<option data-image="%1$s" value="%2$s" %3$s>%4$s</option>', esc_attr($this->image_path . $key) . '.png', esc_attr($key), selected($this->value(), $key, false), esc_html($choice));
                        }
                        ?>
                    </select>

                    <div class="select-image-wrap"><img src="<?php echo $this->image_path . $this->value(); ?>.png"/></div>
                </label>
                <?php
            }
        }

    }

    /**
     * Switch Control
     */
    class Sparklestore_Pro_Switch_Control extends WP_Customize_Control {

        public $type = 'switch';
        public $on_off_label = array();
        public $class;

        public function __construct($manager, $id, $args = array()) {
            $this->on_off_label = $args['on_off_label'];
            $this->class = isset($args['class']) ? $args['class'] : '';
            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            $switch_class = ($this->value() == 'on') ? 'switch-on ' : '';
            $switch_class .= $this->class;
            $on_off_label = $this->on_off_label;
            ?>
            <div class="onoffswitch <?php echo esc_attr($switch_class); ?>">
                <div class="onoffswitch-inner">
                    <div class="onoffswitch-active">
                        <div class="onoffswitch-switch"><?php echo esc_html($on_off_label['on']) ?></div>
                    </div>

                    <div class="onoffswitch-inactive">
                        <div class="onoffswitch-switch"><?php echo esc_html($on_off_label['off']) ?></div>
                    </div>
                </div>
            </div>
            <input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr($this->value()); ?>"/>
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>

            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php } ?>
            <?php
        }

    }
    /**
     * Info Text Control
     */
    class Sparklestore_Pro_Info_Text extends WP_Customize_Control {

        public function render_content() {
            ?>
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>

            <?php if ($this->description) { ?>
                <span class="customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php
            }
        }

    }

    /**
     * Select Box Control
     */
    class Sparklestore_Pro_Selector extends WP_Customize_Control {

        public $type = 'selector';
        public $options = array();
        public $class = '';

        public function __construct($manager, $id, $args = array()) {
            $this->options = $args['options'];
            $this->class = isset($args['class']) ? $args['class'] : '';
            parent::__construct($manager, $id, $args);
        }

        public function render_content() {
            $options = $this->options;
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if (!empty($this->description)) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>

                <div class="selector-labels <?php echo esc_attr($this->class) ?>">
                    <?php
                    foreach ($options as $key => $image) {
                        $class = ( $this->value() == $key ) ? 'selector-selected' : '';
                        echo '<label class="' . esc_attr($class) . '" data-val="' . esc_attr($key) . '">';
                        echo '<img src="' . esc_url($image) . '"/>';
                        echo '</label>';
                    }
                    ?>
                </div>
                <input type="hidden" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />

            </label>
            <?php
        }

    }

    /**
     * Alpha Color Control
     */
    class Sparklestore_Pro_Alpha_Color_Control extends WP_Customize_Control {

        /**
         * Official control name.
         */
        public $type = 'alpha-color';

        /**
         * Add support for palettes to be passed in.
         *
         * Supported palette values are true, false, or an array of RGBa and Hex colors.
         */
        public $palette;

        /**
         * Add support for showing the opacity value on the slider handle.
         */
        public $show_opacity;

        /**
         * Render the control.
         */
        public function render_content() {

            // Process the palette
            if (is_array($this->palette)) {
                $palette = implode('|', $this->palette);
            } else {
                // Default to true.
                $palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
            }

            // Support passing show_opacity as string or boolean. Default to true.
            $show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';

            // Begin the output. 
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if (!empty($this->description)) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>
            </label>
            <input class="alpha-color-control" data-alpha="<?php echo esc_attr($show_opacity); ?>" type="text" data-palette="<?php echo esc_attr($palette); ?>" data-default-color="<?php echo esc_attr($this->settings['default']->default); ?>" <?php $this->link(); ?>  />
            <?php
        }

    }
    /**
     * Checkbox Control
     */
    class Sparklestore_Pro_Checkbox_Control extends WP_Customize_Control {

        /**
         * Control type
         *
         * @var string
         */
        public $type = 'checkbox-toggle';

        /**
         * Control method
         *
         * @since 1.0.0
         */
        public function render_content() {
            ?>
            <div class="sparklestore-pro-checkbox-toggle">
                <div class="onoff-switch">
                    <input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="onoff-switch-checkbox" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> <?php checked($this->value()); ?>>
                    <label class="onoff-switch-label" for="<?php echo esc_attr($this->id); ?>"></label>
                </div>
                <span class="customize-control-title onoff-switch-title"><?php echo esc_html($this->label); ?></span>
                <?php if (!empty($this->description)) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>
            </div>
            <?php
        }

    }
    /**
     * Separator Control
     */
    class Sparklestore_Pro_Separator_Control extends WP_Customize_Control {

        /**
         * Control type
         *
         * @var string
         */
        public $type = 'separator';

        /**
         * Control method
         *
         * @since 1.0.0
         */
        public function render_content() {
            ?>
            <p><span></span></p>
            <?php
        }

    }
    /**
     * Page Editor Control
     */
    class Sparklestore_Pro_Page_Editor extends WP_Customize_Control {

        /**
         * Flag to do action admin_print_footer_scripts.
         * This needs to be true only for one instance.
         *
         * @var bool|mixed
         */
        private $include_admin_print_footer = false;

        /**
         * Flag to load teeny.
         *
         * @var bool|mixed
         */
        private $teeny = false;

        /**
         * Sparkle_Page_Editor constructor.
         *
         * @param WP_Customize_Manager $manager Manager.
         * @param string               $id Id.
         * @param array                $args Constructor args.
         */
        public function __construct($manager, $id, $args = array()) {
            parent::__construct($manager, $id, $args);

            if (!empty($args['include_admin_print_footer'])) {
                $this->include_admin_print_footer = $args['include_admin_print_footer'];
            }

            if (!empty($args['teeny'])) {
                $this->teeny = $args['teeny'];
            }
        }

        /**
         * Render the content on the theme customizer page
         */
        public function render_content() {
            ?>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>

            <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea($this->value()); ?>">
            <?php
            $settings = array(
                'textarea_name' => $this->id,
                'teeny' => $this->teeny,
                'textarea_rows' => 6
            );

            $page_content = $this->value();

            wp_editor($page_content, $this->id, $settings);

            if ($this->include_admin_print_footer === true) {
                do_action('admin_print_footer_scripts');
            }
        }

    }
    /**
     * Gradient Control
     */
    class Sparklestore_Pro_Gradient_Control extends WP_Customize_Control {

        public $type = 'gradient';
        public $params = array();

        public function __construct($manager, $id, $args = array()) {
            if (isset($args['params'])) {
                $this->params = $args['params'];
            }
            parent::__construct($manager, $id, $args);
        }

        public function enqueue() {
            wp_enqueue_script('color-picker', get_template_directory_uri() . '/inc/customizer/js/colorpicker.js', array('jquery'), '1.0', true);
            wp_enqueue_script('jquery-classygradient', get_template_directory_uri() . '/inc/customizer/js/jquery.classygradient.js', array('jquery'), '1.0', true);
            wp_enqueue_script('custom-gradient', get_template_directory_uri() . '/inc/customizer/js/custom-gradient.js', array('jquery', 'jquery-ui-slider'), '1.0', true);

            wp_enqueue_style('color-picker', get_template_directory_uri() . '/inc/customizer/css/colorpicker.css');
            wp_enqueue_style('jquery-classygradient', get_template_directory_uri() . '/inc/customizer/css/jquery.classygradient.css');
        }

        public function render_content() {

            if (!empty($this->label)) :
                ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php
            endif;

            if (!empty($this->description)) :
                ?>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php
            endif;

            $type = $this->type;
            $params = $this->params;
            $class = isset($params['class']) ? $params['class'] : '';
            $default_color = isset($params['default_color']) ? $params['default_color'] : '0% #0051FF, 100% #00C5FF';
            $picker_label = isset($params['picker_label']) ? $params['picker_label'] : esc_html__("Define Gradient Colors", "sparklestore-pro");
            $picker_description = isset($params['picker_description']) ? $params['picker_description'] : esc_html__("For a gradient, at least one starting and one end color should be defined.", "sparklestore-pro");
            $angle_label = isset($params['angle_label']) ? $params['angle_label'] : esc_html__("Define Gradient Direction", "sparklestore-pro");
            $preview_label = isset($params['preview_label']) ? $params['preview_label'] : esc_html__("Gradient Preview", "sparklestore-pro");


            $html = '<div class="gradient-box" data-default-color="' . esc_attr($default_color) . '">';

            // Classy Gradient Picker
            $html .= '<div class="gradient-row">';
            $html .= '<div class="gradient-label">' . esc_html($picker_label) . '</div>';
            $html .= '<div class="gradient-picker"></div>';
            $html .= '<div class="gradient-description">' . esc_html($picker_description) . '</div>';
            $html .= '</div>';

            // Gradient Linear Direction Selector
            $html .= '<div class="gradient-row">';
            $html .= '<div class="gradient-label">' . esc_html($angle_label) . '</div>';
            $html .= '<select class="gradient-direction">
        <option value="vertical">' . esc_html__('Vertical Spread (Top to Bottom)', 'sparklestore-pro') . '</option>
        <option value="horizontal">' . esc_html__('Horizontal Spread (Left To Right)', 'sparklestore-pro') . '</option>
        <option value="custom">' . esc_html__('Custom Angle Spread', 'sparklestore-pro') . '</option>
      </select>';
            $html .= '</div>';

            // Gradient Custom Angle Input
            $html .= '<div class="gradient-row">';
            $html .= '<div class="gradient-custom" style="display: none;">';
            $html .= '<div class="gradient-label">' . esc_html__('Define Custom Angle', 'sparklestore-pro') . '</div>';
            $html .= '<div class="gradient-angle-slider">';
            $html .= '<div class="gradient-range"></div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            // Gradient Preview Panel
            $html .= '<div class="gradient-row">';
            $html .= '<div class="gradient-label">' . esc_html($preview_label) . '</div>';
            $html .= '<div class="gradient-preview"></div>';
            $html .= '</div>';
            echo $html;
            ?>
            <input type="hidden" class="<?php echo esc_attr($type) . ' ' . esc_attr($class) ?> gradient-val"  value="<?php echo esc_attr($this->value()) ?>" <?php $this->link(); ?> />
            </div>
            <?php
        }

    }
    /**
     * Background Control
     */
    class Sparklestore_Pro_Background_Control extends WP_Customize_Upload_Control {

        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'background-image';

        /**
         * Mime type for upload control.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $mime_type = 'image';

        /**
         * Labels for upload control buttons.
         *
         * @since  1.0.0
         * @access public
         * @var    array
         */
        public $button_labels = array();

        /**
         * Field labels
         *
         * @since  1.0.0
         * @access public
         * @var    array
         */
        public $field_labels = array();

        /**
         * Background choices for the select fields.
         *
         * @since  1.0.0
         * @access public
         * @var    array
         */
        public $background_choices = array();

        /**
         * Constructor.
         *
         * @since 1.0.0
         * @uses WP_Customize_Upload_Control::__construct()
         *
         * @param WP_Customize_Manager $manager Customizer bootstrap instance.
         * @param string               $id      Control ID.
         * @param array                $args    Optional. Arguments to override class property defaults.
         */
        public function __construct($manager, $id, $args = array()) {

            // Calls the parent __construct
            parent::__construct($manager, $id, $args);

            // Set button labels for image uploader
            $button_labels = $this->get_button_labels();
            $this->button_labels = apply_filters('customizer_background_button_labels', $button_labels, $id);

            // Set field labels
            $field_labels = $this->get_field_labels();
            $this->field_labels = apply_filters('customizer_background_field_labels', $field_labels, $id);

            // Set background choices
            $background_choices = $this->get_background_choices();
            $this->background_choices = apply_filters('customizer_background_choices', $background_choices, $id);
        }

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {

            parent::to_json();

            $background_choices = $this->background_choices;
            $field_labels = $this->field_labels;

            // Loop through each of the settings and set up the data for it.
            foreach ($this->settings as $setting_key => $setting_id) {

                $this->json[$setting_key] = array(
                    'link' => $this->get_link($setting_key),
                    'value' => $this->value($setting_key),
                    'label' => isset($field_labels[$setting_key]) ? $field_labels[$setting_key] : ''
                );

                if ('image_url' === $setting_key) {
                    if ($this->value($setting_key)) {
                        // Get the attachment model for the existing file.
                        $attachment_id = attachment_url_to_postid($this->value($setting_key));
                        if ($attachment_id) {
                            $this->json['attachment'] = wp_prepare_attachment_for_js($attachment_id);
                        }
                    }
                } elseif ('repeat' === $setting_key) {
                    $this->json[$setting_key]['choices'] = $background_choices['repeat'];
                } elseif ('size' === $setting_key) {
                    $this->json[$setting_key]['choices'] = $background_choices['size'];
                } elseif ('position' === $setting_key) {
                    $this->json[$setting_key]['choices'] = $background_choices['position'];
                } elseif ('attach' === $setting_key) {
                    $this->json[$setting_key]['choices'] = $background_choices['attach'];
                }
            }
        }

        /**
         * Render a JS template for the content of the media control.
         *
         * @since 1.0.0
         */
        public function content_template() {

            parent::content_template();
            ?>

            <div class="background-image-fields">
                <# if ( data.attachment && data.repeat && data.repeat.choices ) { #>
                <li class="background-image-repeat">
                    <# if ( data.repeat.label ) { #>
                    <span class="customize-control-title">{{ data.repeat.label }}</span>
                    <# } #>
                    <select {{{ data.repeat.link }}}>
                        <# _.each( data.repeat.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.repeat.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
                <# } #>

                <# if ( data.attachment && data.size && data.size.choices ) { #>
                <li class="background-image-size">
                    <# if ( data.size.label ) { #>
                    <span class="customize-control-title">{{ data.size.label }}</span>
                    <# } #>
                    <select {{{ data.size.link }}}>
                        <# _.each( data.size.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.size.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
                <# } #>

                <# if ( data.attachment && data.position && data.position.choices ) { #>
                <li class="background-image-position">
                    <# if ( data.position.label ) { #>
                    <span class="customize-control-title">{{ data.position.label }}</span>
                    <# } #>
                    <select {{{ data.position.link }}}>
                        <# _.each( data.position.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.position.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
                <# } #>

                <# if ( data.attachment && data.attach && data.attach.choices ) { #>
                <li class="background-image-attach">
                    <# if ( data.attach.label ) { #>
                    <span class="customize-control-title">{{ data.attach.label }}</span>
                    <# } #>
                    <select {{{ data.attach.link }}}>
                        <# _.each( data.attach.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.attach.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
                <# } #>

            </div>

            <?php
        }

        /**
         * Returns button labels.
         *
         * @since 1.0.0
         */
        public static function get_button_labels() {

            $button_labels = array(
                'select' => esc_html__('Select Image', 'sparklestore-pro'),
                'change' => esc_html__('Change Image', 'sparklestore-pro'),
                'remove' => esc_html__('Remove', 'sparklestore-pro'),
                'default' => esc_html__('Default', 'sparklestore-pro'),
                'placeholder' => esc_html__('No image selected', 'sparklestore-pro'),
                'frame_title' => esc_html__('Select Image', 'sparklestore-pro'),
                'frame_button' => esc_html__('Choose Image', 'sparklestore-pro'),
            );

            return $button_labels;
        }

        /**
         * Returns field labels.
         *
         * @since 1.0.0
         */
        public static function get_field_labels() {

            $field_labels = array(
                'repeat' => esc_html__('Repeat', 'sparklestore-pro'),
                'size' => esc_html__('Size', 'sparklestore-pro'),
                'position' => esc_html__('Position', 'sparklestore-pro'),
                'attach' => esc_html__('Attachment', 'sparklestore-pro')
            );

            return $field_labels;
        }

        /**
         * Returns the background choices.
         *
         * @since 1.0.0
         * @return array
         */
        public static function get_background_choices() {

            $choices = array(
                'repeat' => array(
                    'no-repeat' => esc_html__('No Repeat', 'sparklestore-pro'),
                    'repeat' => esc_html__('Tile', 'sparklestore-pro'),
                    'repeat-x' => esc_html__('Tile Horizontally', 'sparklestore-pro'),
                    'repeat-y' => esc_html__('Tile Vertically', 'sparklestore-pro')
                ),
                'size' => array(
                    'auto' => esc_html__('Default', 'sparklestore-pro'),
                    'cover' => esc_html__('Cover', 'sparklestore-pro'),
                    'contain' => esc_html__('Contain', 'sparklestore-pro')
                ),
                'position' => array(
                    'left-top' => esc_html__('Left Top', 'sparklestore-pro'),
                    'left-center' => esc_html__('Left Center', 'sparklestore-pro'),
                    'left-bottom' => esc_html__('Left Bottom', 'sparklestore-pro'),
                    'right-top' => esc_html__('Right Top', 'sparklestore-pro'),
                    'right-center' => esc_html__('Right Center', 'sparklestore-pro'),
                    'right-bottom' => esc_html__('Right Bottom', 'sparklestore-pro'),
                    'center-top' => esc_html__('Center Top', 'sparklestore-pro'),
                    'center-center' => esc_html__('Center Center', 'sparklestore-pro'),
                    'center-bottom' => esc_html__('Center Bottom', 'sparklestore-pro')
                ),
                'attach' => array(
                    'fixed' => esc_html__('Fixed', 'sparklestore-pro'),
                    'scroll' => esc_html__('Scroll', 'sparklestore-pro')
                )
            );

            return $choices;
        }

    }
    /**
     * Tab Control
     */
    class Sparklestore_Pro_Control_Tab extends WP_Customize_Control {

        public $type = 'tab';
        public $buttons = '';

        public function __construct($manager, $id, $args = array()) {
            parent::__construct($manager, $id, $args);
        }

        public function to_json() {
            parent::to_json();
            $first = true;
            $formatted_buttons = array();
            $all_fields = array();
            foreach ($this->buttons as $button) {
                //$fields = array();
                $active = isset($button['active']) ? $button['active'] : false;
                if ($active && $first) {
                    $first = false;
                } elseif ($active && !$first) {
                    $active = false;
                }

                $formatted_buttons[] = array(
                    'name' => $button['name'],
                    'fields' => $button['fields'],
                    'active' => $active,
                );
                $all_fields = array_merge($all_fields, $button['fields']);
            }
            $this->json['buttons'] = $formatted_buttons;
            $this->json['fields'] = $all_fields;
        }

        public function content_template() {
            ?>
            <div class="customizer-tab-wrap">
                <# if ( data.buttons ) { #>
                <div class="customizer-tabs">
                    <# for (tab in data.buttons) { #>
                    <a href="#" class="customizer-tab <# if ( data.buttons[tab].active ) { #> active <# } #>" data-tab="{{ tab }}">{{ data.buttons[tab].name }}</a>
                    <# } #>
                </div>
                <# } #>
            </div>
            <?php
        }

    }


    /**
     * Date Control
     */
    class Sparklestore_Pro_Date_Control extends WP_Customize_Control {

        public $type = 'date_picker';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>

                <input class="cl-datepicker-control" type="text" autocomplete="off" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?>>
            </label>
            <?php
        }

    }
    /**
     * Dimensions Control
     */
    class Sparklestore_Pro_Dimensions_Control extends WP_Customize_Control {

        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'dimensions';

        /**
         * Renders the control wrapper and calls $this->render_content() for the internals.
         *
         * @see WP_Customize_Control::render()
         */
        protected function render() {
            $id = 'customize-control-' . str_replace(array('[', ']'), array('-', ''), $this->id);
            $class = 'customize-control has-switchers customize-control-' . $this->type;
            ?><li id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class); ?>">
                <?php $this->render_content(); ?>
            </li><?php
        }

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @see WP_Customize_Control::to_json()
         */
        public function to_json() {
            parent::to_json();

            $this->json['id'] = $this->id;
            $this->json['l10n'] = $this->l10n();
            $this->json['title'] = esc_html__('Link values together', 'sparklestore-pro');

            $this->json['inputAttrs'] = '';
            foreach ($this->input_attrs as $attr => $value) {
                $this->json['inputAttrs'] .= $attr . '="' . esc_attr($value) . '" ';
            }

            $this->json['desktop'] = array();
            $this->json['tablet'] = array();
            $this->json['mobile'] = array();

            foreach ($this->settings as $setting_key => $setting) {

                list( $_key ) = explode('_', $setting_key);

                $this->json[$_key][$setting_key] = array(
                    'id' => $setting->id,
                    'link' => $this->get_link($setting_key),
                    'value' => $this->value($setting_key),
                );
            }
        }

        /**
         * An Underscore (JS) template for this control's content (but not its container).
         *
         * Class variables for this control class are available in the `data` JS object;
         * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
         *
         * @see WP_Customize_Control::print_template()
         *
         * @access protected
         */
        protected function content_template() {
            ?>
            <# if ( data.label ) { #>
            <span class="customize-control-title">
                <span>{{{ data.label }}}</span>

                <ul class="responsive-switchers">
                    <li class="desktop">
                        <button type="button" class="preview-desktop active" data-device="desktop">
                            <i class="dashicons dashicons-desktop"></i>
                        </button>
                    </li>
                    <li class="tablet">
                        <button type="button" class="preview-tablet" data-device="tablet">
                            <i class="dashicons dashicons-tablet"></i>
                        </button>
                    </li>
                    <li class="mobile">
                        <button type="button" class="preview-mobile" data-device="mobile">
                            <i class="dashicons dashicons-smartphone"></i>
                        </button>
                    </li>
                </ul>

            </span>
            <# } #>

            <# if ( data.description ) { #>
            <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>

            <ul class="desktop control-wrap active">
                <# _.each( data.desktop, function( args, key ) { #>
                <li class="dimension-wrap {{ key }}">
                    <input {{{ data.inputAttrs }}} type="number" class="dimension-{{ key }}" {{{ args.link }}} value="{{{ args.value }}}" />
                        <span class="dimension-label">{{ data.l10n[ key ] }}</span>
                </li>
                <# } ); #>

                <li class="dimension-wrap">
                    <div class="link-dimensions">
                        <span class="dashicons dashicons-admin-links sparklestore-pro-linked" data-element="{{ data.id }}" title="{{ data.title }}"></span>
                        <span class="dashicons dashicons-editor-unlink sparklestore-pro-unlinked" data-element="{{ data.id }}" title="{{ data.title }}"></span>
                    </div>
                </li>
            </ul>

            <ul class="tablet control-wrap">
                <# _.each( data.tablet, function( args, key ) { #>
                <li class="dimension-wrap {{ key }}">
                    <input {{{ data.inputAttrs }}} type="number" class="dimension-{{ key }}" {{{ args.link }}} value="{{{ args.value }}}" />
                        <span class="dimension-label">{{ data.l10n[ key ] }}</span>
                </li>
                <# } ); #>

                <li class="dimension-wrap">
                    <div class="link-dimensions">
                        <span class="dashicons dashicons-admin-links sparklestore-pro-linked" data-element="{{ data.id }}_tablet" title="{{ data.title }}"></span>
                        <span class="dashicons dashicons-editor-unlink sparklestore-pro-unlinked" data-element="{{ data.id }}_tablet" title="{{ data.title }}"></span>
                    </div>
                </li>
            </ul>

            <ul class="mobile control-wrap">
                <# _.each( data.mobile, function( args, key ) { #>
                <li class="dimension-wrap {{ key }}">
                    <input {{{ data.inputAttrs }}} type="number" class="dimension-{{ key }}" {{{ args.link }}} value="{{{ args.value }}}" />
                        <span class="dimension-label">{{ data.l10n[ key ] }}</span>
                </li>
                <# } ); #>

                <li class="dimension-wrap">
                    <div class="link-dimensions">
                        <span class="dashicons dashicons-admin-links sparklestore-pro-linked" data-element="{{ data.id }}_mobile" title="{{ data.title }}"></span>
                        <span class="dashicons dashicons-editor-unlink sparklestore-pro-unlinked" data-element="{{ data.id }}_mobile" title="{{ data.title }}"></span>
                    </div>
                </li>
            </ul>

            <?php
        }

        /**
         * Returns an array of translation strings.
         *
         * @access protected
         * @param string|false $id The string-ID.
         * @return string
         */
        protected function l10n($id = false) {
            $translation_strings = array(
                'desktop_top' => esc_attr__('Top', 'sparklestore-pro'),
                'desktop_right' => esc_attr__('Right', 'sparklestore-pro'),
                'desktop_bottom' => esc_attr__('Bottom', 'sparklestore-pro'),
                'desktop_left' => esc_attr__('Left', 'sparklestore-pro'),
                'tablet_top' => esc_attr__('Top', 'sparklestore-pro'),
                'tablet_right' => esc_attr__('Right', 'sparklestore-pro'),
                'tablet_bottom' => esc_attr__('Bottom', 'sparklestore-pro'),
                'tablet_left' => esc_attr__('Left', 'sparklestore-pro'),
                'mobile_top' => esc_attr__('Top', 'sparklestore-pro'),
                'mobile_right' => esc_attr__('Right', 'sparklestore-pro'),
                'mobile_bottom' => esc_attr__('Bottom', 'sparklestore-pro'),
                'mobile_left' => esc_attr__('Left', 'sparklestore-pro'),
            );
            if (false === $id) {
                return $translation_strings;
            }
            return $translation_strings[$id];
        }

    }
    /**
     * Slider Control
     */
    class Sparklestore_Pro_Range_Slider_Control extends WP_Customize_Control {

        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'range-slider';

        /**
         * Renders the control wrapper and calls $this->render_content() for the internals.
         *
         * @see WP_Customize_Control::render()
         */
        protected function render() {
            $id = 'customize-control-' . str_replace(array('[', ']'), array('-', ''), $this->id);
            $class = 'customize-control has-switchers customize-control-' . $this->type;
            ?><li id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class); ?>">
                <?php $this->render_content(); ?>
            </li><?php
        }

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @see WP_Customize_Control::to_json()
         */
        public function to_json() {
            parent::to_json();

            $this->json['id'] = $this->id;

            $this->json['inputAttrs'] = '';
            foreach ($this->input_attrs as $attr => $value) {
                $this->json['inputAttrs'] .= $attr . '="' . esc_attr($value) . '" ';
            }

            $this->json['desktop'] = array();
            $this->json['tablet'] = array();
            $this->json['mobile'] = array();

            foreach ($this->settings as $setting_key => $setting) {
                $this->json[$setting_key] = array(
                    'id' => $setting->id,
                    'default' => $setting->default,
                    'link' => $this->get_link($setting_key),
                    'value' => $this->value($setting_key),
                );
            }
        }

        /**
         * An Underscore (JS) template for this control's content (but not its container).
         *
         * Class variables for this control class are available in the `data` JS object;
         * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
         *
         * @see WP_Customize_Control::print_template()
         *
         * @access protected
         */
        protected function content_template() {
            ?>
            <# if ( data.label ) { #>
            <span class="customize-control-title">
                <span>{{{ data.label }}}</span>

                <ul class="responsive-switchers">
                    <li class="desktop">
                        <button type="button" class="preview-desktop active" data-device="desktop">
                            <i class="dashicons dashicons-desktop"></i>
                        </button>
                    </li>
                    <li class="tablet">
                        <button type="button" class="preview-tablet" data-device="tablet">
                            <i class="dashicons dashicons-tablet"></i>
                        </button>
                    </li>
                    <li class="mobile">
                        <button type="button" class="preview-mobile" data-device="mobile">
                            <i class="dashicons dashicons-smartphone"></i>
                        </button>
                    </li>
                </ul>

            </span>
            <# } #>

            <# if ( data.description ) { #>
            <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>

            <# if ( data.desktop ) { #>
            <div class="desktop control-wrap active">
                <div class="sparklestore-pro-slider desktop-slider"></div>
                <div class="sparklestore-pro-slider-input">
                    <input {{{ data.inputAttrs }}} type="number" class="slider-input desktop-input" value="{{ data.desktop.value }}" {{{ data.desktop.link }}} />
                </div>
            </div>
            <# } #>

            <# if ( data.tablet ) { #>
            <div class="tablet control-wrap">
                <div class="sparklestore-pro-slider tablet-slider"></div>
                <div class="sparklestore-pro-slider-input">
                    <input {{{ data.inputAttrs }}} type="number" class="slider-input tablet-input" value="{{ data.tablet.value }}" {{{ data.tablet.link }}} />
                </div>
            </div>
            <# } #>

            <# if ( data.mobile ) { #>
            <div class="mobile control-wrap">
                <div class="sparklestore-pro-slider mobile-slider"></div>
                <div class="sparklestore-pro-slider-input">
                    <input {{{ data.inputAttrs }}} type="number" class="slider-input mobile-input" value="{{ data.mobile.value }}" {{{ data.mobile.link }}} />
                </div>
            </div>
            <# } #>

            <?php
        }

    }
    /**
     * Sortable Control
     */
    class Sparklestore_Pro_Sortable_Control extends WP_Customize_Control {

        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'sortable';

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @see WP_Customize_Control::to_json()
         */
        public function to_json() {
            parent::to_json();

            $this->json['default'] = $this->setting->default;
            if (isset($this->default)) {
                $this->json['default'] = $this->default;
            }
            $this->json['value'] = maybe_unserialize($this->value());
            $this->json['choices'] = $this->choices;
            $this->json['link'] = $this->get_link();
            $this->json['id'] = $this->id;

            $this->json['inputAttrs'] = '';
            foreach ($this->input_attrs as $attr => $value) {
                $this->json['inputAttrs'] .= $attr . '="' . esc_attr($value) . '" ';
            }

            $this->json['inputAttrs'] = maybe_serialize($this->input_attrs());
        }

        /**
         * An Underscore (JS) template for this control's content (but not its container).
         *
         * Class variables for this control class are available in the `data` JS object;
         * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
         *
         * @see WP_Customize_Control::print_template()
         *
         * @access protected
         */
        protected function content_template() {
            ?>
            <label class='sparklestore-pro-sortable'>
                <span class="customize-control-title">
                    {{{ data.label }}}
                </span>
                <# if ( data.description ) { #>
                <span class="description customize-control-description">{{{ data.description }}}</span>
                <# } #>

                <ul class="sortable">
                    <# _.each( data.value, function( choiceID ) { #>
                    <li {{{ data.inputAttrs }}} class='sparklestore-pro-sortable-item' data-value='{{ choiceID }}'>
                        <i class='dashicons dashicons-menu'></i>
                        <i class="dashicons dashicons-visibility visibility"></i>
                        {{{ data.choices[ choiceID ] }}}
                    </li>
                    <# }); #>
                    <# _.each( data.choices, function( choiceLabel, choiceID ) { #>
                    <# if ( -1 === data.value.indexOf( choiceID ) ) { #>
                    <li {{{ data.inputAttrs }}} class='sparklestore-pro-sortable-item invisible' data-value='{{ choiceID }}'>
                        <i class='dashicons dashicons-menu'></i>
                        <i class="dashicons dashicons-visibility visibility"></i>
                        {{{ data.choices[ choiceID ] }}}
                    </li>
                    <# } #>
                    <# }); #>
                </ul>
            </label>
            <?php
        }

    }
    /**
     * Range Control
     */
    class Sparklestore_Pro_Range_Control extends WP_Customize_Control {

        /**
         * The type of control being rendered
         */
        public $type = 'range';

        /**
         * Render the control in the customizer
         */
        public function render_content() {
            ?>
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
                <span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr($this->value()); ?>"></span>
            </span>

            <div class="control-wrap"> 
                <div class="sparklestore-pro-slider" slider-min-value="<?php echo esc_attr($this->input_attrs['min']); ?>" slider-max-value="<?php echo esc_attr($this->input_attrs['max']); ?>" slider-step-value="<?php echo esc_attr($this->input_attrs['step']); ?>"></div>
                <div class="sparklestore-pro-slider-input">
                    <input type="number" value="<?php echo esc_attr($this->value()); ?>" class="slider-input" <?php $this->link(); ?> />
                </div>
            </div>

            <?php
            if ($this->description) {
                ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php
            }
        }

    }
    /**
     * Color Tab Control
     */
    class Sparklestore_Pro_Color_Tab_Control extends WP_Customize_Control {

        public $type = 'color-tab';

        /**
         * Add support for palettes to be passed in.
         *
         * Supported palette values are true, false, or an array of RGBa and Hex colors.
         */
        public $palette;

        /**
         * Add support for showing the opacity value on the slider handle.
         */
        public $show_opacity;
        public $group;

        public function __construct($manager, $id, $args = array()) {
            if (isset($args['palette'])) {
                $this->palette = $args['palette'];
            }
            parent::__construct($manager, $id, $args);
        }

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @see WP_Customize_Control::to_json()
         */
        public function to_json() {
            parent::to_json();

            // Process the palette
            if (is_array($this->palette)) {
                $palette_string = implode('|', $this->palette);
            } else {
                // Default to true.
                $palette_string = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
            }
            $this->json['show_opacity'] = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';
            $this->json['group'] = array();
            $this->json['l10n'] = $this->l10n();
            $this->json['group'] = $this->group;
            $this->json['palette'] = $palette_string;

            foreach ($this->settings as $setting_key => $setting) {
                list( $_key ) = explode('_', $setting_key);
                $this->json[$_key][$setting_key] = array(
                    'id' => $setting->id,
                    'link' => $this->get_link($setting_key),
                    'value' => $this->value($setting_key),
                    'default' => $setting->default
                );
            }
        }

        /**
         * An Underscore (JS) template for this control's content (but not its container).
         *
         * Class variables for this control class are available in the `data` JS object;
         * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
         *
         * @see WP_Customize_Control::print_template()
         *
         * @access protected
         */
        protected function content_template() {
            ?>
            <# if ( data.label ) { #>
            <span class="customize-control-title">
                <label>{{{ data.label }}}</label>
                <div class="color-tab-toggle"><span class="dashicons dashicons-edit"></span></div>
            </span>
            <# } #>

            <# if ( data.description ) { #>
            <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>

            <div class="color-tab-wrap" style="display:none">
                <ul class="color-tab-switchers">
                    <li data-tab="color-tab-content-normal" class="active">{{{ data.l10n['normal'] }}}</li>
                    <li data-tab="color-tab-content-hover">{{{ data.l10n['hover'] }}}</li>
                </ul>

                <div class="color-tab-contents">
                    <div class="color-tab-content-normal" style="display:block">
                        <# _.each( data.normal, function( args, key ) { #>
                        <div class="color-content-wrap {{ key }}">
                            <label class="color-tab-label">{{ data.group[ key ] }}</label>
                            <input class="alpha-color-control" type="text" value="{{ args.value }}" data-alpha="{{ data.show_opacity }}" data-default-color="{{ args.default }}" data-palette="{{ data.palette }}" {{{ args.link }}} />   
                        </div>
                        <# } ); #>
                    </div>

                    <div class="color-tab-content-hover" style="display:none">
                        <# _.each( data.hover, function( args, key ) { #>
                        <div class="color-content-wrap {{ key }}">
                            <label class="color-tab-label">{{ data.group[ key ] }}</label>
                            <input class="alpha-color-control" type="text"  value="{{ args.value }}" data-alpha="{{ data.show_opacity }}" data-default-color="{{ args.default }}" data-palette="{{ data.palette }}" {{{ args.link }}} />   
                        </div>
                        <# } ); #>
                    </div>
                </div>
            </div>
            <?php
        }

        /**
         * Returns an array of translation strings.
         *
         * @access protected
         * @param string|false $id The string-ID.
         * @return string
         */
        protected function l10n($id = false) {
            $translation_strings = array(
                'normal' => esc_attr__('Normal', 'sparklestore-pro'),
                'hover' => esc_attr__('Hover', 'sparklestore-pro')
            );
            if (false === $id) {
                return $translation_strings;
            }
            return $translation_strings[$id];
        }

    }

endif;

if (class_exists('WP_Customize_Section')) {

    /**
     * Class Sparklestore_Pro_Toggle_Section
     *
     * @access public
     */
    class Sparklestore_Pro_Toggle_Section extends WP_Customize_Section {

        /**
         * The type of customize section being rendered.
         *
         * @access public
         * @var    string
         */
        public $type = 'toggle-section';

        /**
         * Flag to display icon when entering in customizer
         *
         * @access public
         * @var bool
         */
        public $hide;

        /**
         * Name of customizer hiding control.
         *
         * @access public
         * @var bool
         */
        public $hiding_control;

        /**
         * Sparklestore_Pro_Toggle_Section constructor.
         *
         * @param WP_Customize_Manager $manager Customizer Manager.
         * @param string               $id Control id.
         * @param array                $args Arguments.
         */
        public function __construct(WP_Customize_Manager $manager, $id, array $args = array()) {
            parent::__construct($manager, $id, $args);

            if (isset($args['hiding_control'])) {
                $this->hide = get_theme_mod($args['hiding_control'], 'off');
            }

            add_action('customize_controls_init', array($this, 'enqueue'));
        }

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @access public
         */
        public function json() {
            $json = parent::json();
            $json['hide'] = $this->hide;
            $json['hiding_control'] = $this->hiding_control;
            return $json;
        }

        /**
         * Enqueue function.
         *
         * @access public
         * @return void
         */
        public function enqueue() {
            wp_enqueue_script('sparklestore-pro-toggle-section', get_template_directory_uri() . '/inc/customizer/js/toggle-section.js', array('jquery'), '1.0', true);
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @access public
         * @return void
         */
        protected function render_template() {
            ?>
            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }}">
                <h3 class="accordion-section-title <# if ( data.hide != 'on' ) { #> sparklestore-pro-section-visible <# } else { #> sparklestore-pro-section-hidden <# }#>" tabindex="0">
                    {{ data.title }}
                    <# if ( data.hide != 'on' ) { #>
                    <a data-control="{{ data.hiding_control }}" class="sparklestore-pro-toggle-section" href="#"><span class="dashicons dashicons-visibility"></span></a>
                    <# } else { #>
                    <a data-control="{{ data.hiding_control }}" class="sparklestore-pro-toggle-section" href="#"><span class="dashicons dashicons-hidden"></span></a>
                    <# } #>
                </h3>
                <ul class="accordion-section-content">
                    <li class="customize-section-description-container section-meta <# if ( data.description_hidden ) { #>customize-info<# } #>">
                        <div class="customize-section-title">
                            <button class="customize-section-back" tabindex="-1">
                            </button>
                            <h3>
                                <span class="customize-action">
                                    {{{ data.customizeAction }}}
                                </span>
                                {{ data.title }}
                            </h3>
                            <# if ( data.description && data.description_hidden ) { #>
                            <button type="button" class="customize-help-toggle dashicons dashicons-editor-help" aria-expanded="false"></button>
                            <div class="description customize-section-description">
                                {{{ data.description }}}
                            </div>
                            <# } #>
                        </div>

                        <# if ( data.description && ! data.description_hidden ) { #>
                        <div class="description customize-section-description">
                            {{{ data.description }}}
                        </div>
                        <# } #>
                    </li>
                </ul>
            </li>
            <?php
        }

    }

    if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'SparkleWP_Customize_Section_H3' ) ) :
        class SparkleWP_Customize_Section_H3 extends WP_Customize_Section {
    
            public $section;
            public $type = 'sparklewp_section_h3';
    
            protected function render_template() {
                ?>
                <li id="accordion-section-{{ data.id }}" class="accordion-section control-section sparklewp-section-separator cannot-expand control-section-{{ data.type }}">
                    <h3 class="accordion-section-title accordion-section-h3" tabindex="0">
                        {{ data.title }}
                    </h3>
                </li>
                <?php
            }
    
        }
    endif;
}

/**
 * repeater icons function
*/
if(!function_exists('sparklestore_pro_awesome_icon_array') ){

	function sparklestore_pro_awesome_icon_array(){

		return  array("fab fa-500px",
                    "fab fa-accessible-icon",
                    "fab fa-accusoft",
                    "fas fa-address-book", "far fa-address-book",
                    "fas fa-address-card", "far fa-address-card",
                    "fas fa-adjust",
                    "fab fa-adn",
                    "fab fa-adversal",
                    "fab fa-affiliatetheme",
                    "fab fa-algolia",
                    "fas fa-align-center",
                    "fas fa-align-justify",
                    "fas fa-align-left",
                    "fas fa-align-right",
                    "fab fa-amazon",
                    "fas fa-ambulance",
                    "fas fa-american-sign-language-interpreting",
                    "fab fa-amilia",
                    "fas fa-anchor",
                    "fab fa-android",
                    "fab fa-angellist",
                    "fas fa-angle-double-down",
                    "fas fa-angle-double-left",
                    "fas fa-angle-double-right",
                    "fas fa-angle-double-up",
                    "fas fa-angle-down",
                    "fas fa-angle-left",
                    "fas fa-angle-right",
                    "fas fa-angle-up",
                    "fab fa-angrycreative",
                    "fab fa-angular",
                    "fab fa-app-store",
                    "fab fa-app-store-ios",
                    "fab fa-apper",
                    "fab fa-apple",
                    "fab fa-apple-pay",
                    "fas fa-archive",
                    "fas fa-arrow-alt-circle-down", "far fa-arrow-alt-circle-down",
                    "fas fa-arrow-alt-circle-left", "far fa-arrow-alt-circle-left",
                    "fas fa-arrow-alt-circle-right", "far fa-arrow-alt-circle-right",
                    "fas fa-arrow-alt-circle-up", "far fa-arrow-alt-circle-up",
                    "fas fa-arrow-circle-down",
                    "fas fa-arrow-circle-left",
                    "fas fa-arrow-circle-right",
                    "fas fa-arrow-circle-up",
                    "fas fa-arrow-down",
                    "fas fa-arrow-left",
                    "fas fa-arrow-right",
                    "fas fa-arrow-up",
                    "fas fa-arrows-alt",
                    "fas fa-arrows-alt-h",
                    "fas fa-arrows-alt-v",
                    "fas fa-assistive-listening-systems",
                    "fas fa-asterisk",
                    "fab fa-asymmetrik",
                    "fas fa-at",
                    "fab fa-audible",
                    "fas fa-audio-description",
                    "fab fa-autoprefixer",
                    "fab fa-avianex",
                    "fab fa-aviato",
                    "fab fa-aws",
                    "fas fa-backward",
                    "fas fa-balance-scale",
                    "fas fa-ban",
                    "fab fa-bandcamp",
                    "fas fa-barcode",
                    "fas fa-bars",
                    "fas fa-bath",
                    "fas fa-battery-empty",
                    "fas fa-battery-full",
                    "fas fa-battery-half",
                    "fas fa-battery-quarter",
                    "fas fa-battery-three-quarters",
                    "fas fa-bed",
                    "fas fa-beer",
                    "fab fa-behance",
                    "fab fa-behance-square",
                    "fas fa-bell", "far fa-bell",
                    "fas fa-bell-slash", "far fa-bell-slash",
                    "fas fa-bicycle",
                    "fab fa-bimobject",
                    "fas fa-binoculars",
                    "fas fa-birthday-cake",
                    "fab fa-bitbucket",
                    "fab fa-bitcoin",
                    "fab fa-bity",
                    "fab fa-black-tie",
                    "fab fa-blackberry",
                    "fas fa-blind",
                    "fab fa-blogger",
                    "fab fa-blogger-b",
                    "fab fa-bluetooth",
                    "fab fa-bluetooth-b",
                    "fas fa-bold",
                    "fas fa-bolt",
                    "fas fa-bomb",
                    "fas fa-book",
                    "fas fa-bookmark", "far fa-bookmark",
                    "fas fa-braille",
                    "fas fa-briefcase",
                    "fab fa-btc",
                    "fas fa-bug",
                    "fas fa-building", "far fa-building",
                    "fas fa-bullhorn",
                    "fas fa-bullseye",
                    "fab fa-buromobelexperte",
                    "fas fa-bus",
                    "fab fa-buysellads",
                    "fas fa-calculator",
                    "fas fa-calendar", "far fa-calendar",
                    "fas fa-calendar-alt", "far fa-calendar-alt",
                    "fas fa-calendar-check", "far fa-calendar-check",
                    "fas fa-calendar-minus", "far fa-calendar-minus",
                    "fas fa-calendar-plus", "far fa-calendar-plus",
                    "fas fa-calendar-times", "far fa-calendar-times",
                    "fas fa-camera",
                    "fas fa-camera-retro",
                    "fas fa-car",
                    "fas fa-caret-down",
                    "fas fa-caret-left",
                    "fas fa-caret-right",
                    "fas fa-caret-square-down", "far fa-caret-square-down",
                    "fas fa-caret-square-left", "far fa-caret-square-left",
                    "fas fa-caret-square-right", "far fa-caret-square-right",
                    "fas fa-caret-square-up", "far fa-caret-square-up",
                    "fas fa-caret-up",
                    "fas fa-cart-arrow-down",
                    "fas fa-cart-plus",
                    "fab fa-cc-amex",
                    "fab fa-cc-apple-pay",
                    "fab fa-cc-diners-club",
                    "fab fa-cc-discover",
                    "fab fa-cc-jcb",
                    "fab fa-cc-mastercard",
                    "fab fa-cc-paypal",
                    "fab fa-cc-stripe",
                    "fab fa-cc-visa",
                    "fab fa-centercode",
                    "fas fa-certificate",
                    "fas fa-chart-area",
                    "fas fa-chart-bar", "far fa-chart-bar",
                    "fas fa-chart-line",
                    "fas fa-chart-pie",
                    "fas fa-check",
                    "fas fa-check-circle", "far fa-check-circle",
                    "fas fa-check-square", "far fa-check-square",
                    "fas fa-chevron-circle-down",
                    "fas fa-chevron-circle-left",
                    "fas fa-chevron-circle-right",
                    "fas fa-chevron-circle-up",
                    "fas fa-chevron-down",
                    "fas fa-chevron-left",
                    "fas fa-chevron-right",
                    "fas fa-chevron-up",
                    "fas fa-child",
                    "fab fa-chrome",
                    "fas fa-circle", "far fa-circle",
                    "fas fa-circle-notch",
                    "fas fa-clipboard", "far fa-clipboard",
                    "fas fa-clock", "far fa-clock",
                    "fas fa-clone", "far fa-clone",
                    "fas fa-closed-captioning", "far fa-closed-captioning",
                    "fas fa-cloud",
                    "fas fa-cloud-download-alt",
                    "fas fa-cloud-upload-alt",
                    "fab fa-cloudscale",
                    "fab fa-cloudsmith",
                    "fab fa-cloudversify",
                    "fas fa-code",
                    "fas fa-code-branch",
                    "fab fa-codepen",
                    "fab fa-codiepie",
                    "fas fa-coffee",
                    "fas fa-cog",
                    "fas fa-cogs",
                    "fas fa-columns",
                    "fas fa-comment", "far fa-comment",
                    "fas fa-comment-alt", "far fa-comment-alt",
                    "fas fa-comments", "far fa-comments",
                    "fas fa-compass", "far fa-compass",
                    "fas fa-compress",
                    "fab fa-connectdevelop",
                    "fab fa-contao",
                    "fas fa-copy", "far fa-copy",
                    "fas fa-copyright", "far fa-copyright",
                    "fab fa-cpanel",
                    "fab fa-creative-commons",
                    "fas fa-credit-card", "far fa-credit-card",
                    "fas fa-crop",
                    "fas fa-crosshairs",
                    "fab fa-css3",
                    "fab fa-css3-alt",
                    "fas fa-cube",
                    "fas fa-cubes",
                    "fas fa-cut",
                    "fab fa-cuttlefish",
                    "fab fa-d-and-d",
                    "fab fa-dashcube",
                    "fas fa-database",
                    "fas fa-deaf",
                    "fab fa-delicious",
                    "fab fa-deploydog",
                    "fab fa-deskpro",
                    "fas fa-desktop",
                    "fab fa-deviantart",
                    "fab fa-digg",
                    "fab fa-digital-ocean",
                    "fab fa-discord",
                    "fab fa-discourse",
                    "fab fa-dochub",
                    "fab fa-docker",
                    "fas fa-dollar-sign",
                    "fas fa-dot-circle", "far fa-dot-circle",
                    "fas fa-download",
                    "fab fa-draft2digital",
                    "fab fa-dribbble",
                    "fab fa-dribbble-square",
                    "fab fa-dropbox",
                    "fab fa-drupal",
                    "fab fa-dyalog",
                    "fab fa-earlybirds",
                    "fab fa-edge",
                    "fas fa-edit", "far fa-edit",
                    "fas fa-eject",
                    "fas fa-ellipsis-h",
                    "fas fa-ellipsis-v",
                    "fab fa-ember",
                    "fab fa-empire",
                    "fas fa-envelope", "far fa-envelope",
                    "fas fa-envelope-open", "far fa-envelope-open",
                    "fas fa-envelope-square",
                    "fab fa-envira",
                    "fas fa-eraser",
                    "fab fa-erlang",
                    "fab fa-etsy",
                    "fas fa-euro-sign",
                    "fas fa-exchange-alt",
                    "fas fa-exclamation",
                    "fas fa-exclamation-circle",
                    "fas fa-exclamation-triangle",
                    "fas fa-expand",
                    "fas fa-expand-arrows-alt",
                    "fab fa-expeditedssl",
                    "fas fa-external-link-alt",
                    "fas fa-external-link-square-alt",
                    "fas fa-eye",
                    "fas fa-eye-dropper",
                    "fas fa-eye-slash", "far fa-eye-slash",
                    "fab fa-facebook",
                    "fab fa-facebook-f",
                    "fab fa-facebook-messenger",
                    "fab fa-facebook-square",
                    "fas fa-fast-backward",
                    "fas fa-fast-forward",
                    "fas fa-fax",
                    "fas fa-female",
                    "fas fa-fighter-jet",
                    "fas fa-file", "far fa-file",
                    "fas fa-file-alt", "far fa-file-alt",
                    "fas fa-file-archive", "far fa-file-archive",
                    "fas fa-file-audio", "far fa-file-audio",
                    "fas fa-file-code", "far fa-file-code",
                    "fas fa-file-excel", "far fa-file-excel",
                    "fas fa-file-image", "far fa-file-image",
                    "fas fa-file-pdf", "far fa-file-pdf",
                    "fas fa-file-powerpoint", "far fa-file-powerpoint",
                    "fas fa-file-video", "far fa-file-video",
                    "fas fa-file-word", "far fa-file-word",
                    "fas fa-film",
                    "fas fa-filter",
                    "fas fa-fire",
                    "fas fa-fire-extinguisher",
                    "fab fa-firefox",
                    "fab fa-first-order",
                    "fab fa-firstdraft",
                    "fas fa-flag", "far fa-flag",
                    "fas fa-flag-checkered",
                    "fas fa-flask",
                    "fab fa-flickr",
                    "fab fa-fly",
                    "fas fa-folder", "far fa-folder",
                    "fas fa-folder-open", "far fa-folder-open",
                    "fas fa-font",
                    "fab fa-font-awesome",
                    "fab fa-font-awesome-alt",
                    "fab fa-font-awesome-flag",
                    "fab fa-fonticons",
                    "fab fa-fonticons-fi",
                    "fab fa-fort-awesome",
                    "fab fa-fort-awesome-alt",
                    "fab fa-forumbee",
                    "fas fa-forward",
                    "fab fa-foursquare",
                    "fab fa-free-code-camp",
                    "fab fa-freebsd",
                    "fas fa-frown", "far fa-frown",
                    "fas fa-futbol", "far fa-futbol",
                    "fas fa-gamepad",
                    "fas fa-gavel",
                    "fas fa-gem", "far fa-gem",
                    "fas fa-genderless",
                    "fab fa-get-pocket",
                    "fab fa-gg",
                    "fab fa-gg-circle",
                    "fas fa-gift",
                    "fab fa-git",
                    "fab fa-git-square",
                    "fab fa-github",
                    "fab fa-github-alt",
                    "fab fa-github-square",
                    "fab fa-gitkraken",
                    "fab fa-gitlab",
                    "fab fa-gitter",
                    "fas fa-glass-martini",
                    "fab fa-glide",
                    "fab fa-glide-g",
                    "fas fa-globe",
                    "fab fa-gofore",
                    "fab fa-goodreads",
                    "fab fa-goodreads-g",
                    "fab fa-google",
                    "fab fa-google-drive",
                    "fab fa-google-play",
                    "fab fa-google-plus",
                    "fab fa-google-plus-g",
                    "fab fa-google-plus-square",
                    "fab fa-google-wallet",
                    "fas fa-graduation-cap",
                    "fab fa-gratipay",
                    "fab fa-grav",
                    "fab fa-gripfire",
                    "fab fa-grunt",
                    "fab fa-gulp",
                    "fas fa-h-square",
                    "fab fa-hacker-news",
                    "fab fa-hacker-news-square",
                    "fas fa-hand-lizard", "far fa-hand-lizard",
                    "fas fa-hand-paper", "far fa-hand-paper",
                    "fas fa-hand-peace", "far fa-hand-peace",
                    "fas fa-hand-point-down", "far fa-hand-point-down",
                    "fas fa-hand-point-left", "far fa-hand-point-left",
                    "fas fa-hand-point-right", "far fa-hand-point-right",
                    "fas fa-hand-point-up", "far fa-hand-point-up",
                    "fas fa-hand-pointer", "far fa-hand-pointer",
                    "fas fa-hand-rock", "far fa-hand-rock",
                    "fas fa-hand-scissors", "far fa-hand-scissors",
                    "fas fa-hand-spock", "far fa-hand-spock",
                    "fas fa-handshake", "far fa-handshake",
                    "fas fa-hashtag",
                    "fas fa-hdd", "far fa-hdd",
                    "fas fa-heading",
                    "fas fa-headphones",
                    "fas fa-heart", "far fa-heart",
                    "fas fa-heartbeat",
                    "fab fa-hire-a-helper",
                    "fas fa-history",
                    "fas fa-home",
                    "fab fa-hooli",
                    "fas fa-hospital", "far fa-hospital",
                    "fab fa-hotjar",
                    "fas fa-hourglass", "far fa-hourglass",
                    "fas fa-hourglass-end",
                    "fas fa-hourglass-half",
                    "fas fa-hourglass-start",
                    "fab fa-houzz",
                    "fab fa-html5",
                    "fab fa-hubspot",
                    "fas fa-i-cursor",
                    "fas fa-id-badge", "far fa-id-badge",
                    "fas fa-id-card", "far fa-id-card",
                    "fas fa-image", "far fa-image",
                    "fas fa-images", "far fa-images",
                    "fab fa-imdb",
                    "fas fa-inbox",
                    "fas fa-indent",
                    "fas fa-industry",
                    "fas fa-info",
                    "fas fa-info-circle",
                    "fab fa-instagram",
                    "fab fa-internet-explorer",
                    "fab fa-ioxhost",
                    "fas fa-italic",
                    "fab fa-itunes",
                    "fab fa-itunes-note",
                    "fab fa-jenkins",
                    "fab fa-joget",
                    "fab fa-joomla",
                    "fab fa-js",
                    "fab fa-js-square",
                    "fab fa-jsfiddle",
                    "fas fa-key",
                    "fas fa-keyboard", "far fa-keyboard",
                    "fab fa-keycdn",
                    "fab fa-kickstarter",
                    "fab fa-kickstarter-k",
                    "fas fa-language",
                    "fas fa-laptop",
                    "fab fa-laravel",
                    "fab fa-lastfm",
                    "fab fa-lastfm-square",
                    "fas fa-leaf",
                    "fab fa-leanpub",
                    "fas fa-lemon", "far fa-lemon",
                    "fab fa-less",
                    "fas fa-level-down-alt",
                    "fas fa-level-up-alt",
                    "fas fa-life-ring", "far fa-life-ring",
                    "fas fa-lightbulb", "far fa-lightbulb",
                    "fab fa-line",
                    "fas fa-link",
                    "fab fa-linkedin",
                    "fab fa-linkedin-in",
                    "fab fa-linode",
                    "fab fa-linux",
                    "fas fa-lira-sign",
                    "fas fa-list",
                    "fas fa-list-alt", "far fa-list-alt",
                    "fas fa-list-ol",
                    "fas fa-list-ul",
                    "fas fa-location-arrow",
                    "fas fa-lock",
                    "fas fa-lock-open",
                    "fas fa-long-arrow-alt-down",
                    "fas fa-long-arrow-alt-left",
                    "fas fa-long-arrow-alt-right",
                    "fas fa-long-arrow-alt-up",
                    "fas fa-low-vision",
                    "fab fa-lyft",
                    "fab fa-magento",
                    "fas fa-magic",
                    "fas fa-magnet",
                    "fas fa-male",
                    "fas fa-map", "far fa-map",
                    "fas fa-map-marker",
                    "fas fa-map-marker-alt",
                    "fas fa-map-pin",
                    "fas fa-map-signs",
                    "fas fa-mars",
                    "fas fa-mars-double",
                    "fas fa-mars-stroke",
                    "fas fa-mars-stroke-h",
                    "fas fa-mars-stroke-v",
                    "fab fa-maxcdn",
                    "fab fa-medapps",
                    "fab fa-medium",
                    "fab fa-medium-m",
                    "fas fa-medkit",
                    "fab fa-medrt",
                    "fab fa-meetup",
                    "fas fa-meh", "far fa-meh",
                    "fas fa-mercury",
                    "fas fa-microchip",
                    "fas fa-microphone",
                    "fas fa-microphone-slash",
                    "fab fa-microsoft",
                    "fas fa-minus",
                    "fas fa-minus-circle",
                    "fas fa-minus-square", "far fa-minus-square",
                    "fab fa-mix",
                    "fab fa-mixcloud",
                    "fab fa-mizuni",
                    "fas fa-mobile",
                    "fas fa-mobile-alt",
                    "fab fa-modx",
                    "fab fa-monero",
                    "fas fa-money-bill-alt", "far fa-money-bill-alt",
                    "fas fa-moon", "far fa-moon",
                    "fas fa-motorcycle",
                    "fas fa-mouse-pointer",
                    "fas fa-music",
                    "fab fa-napster",
                    "fas fa-neuter",
                    "fas fa-newspaper", "far fa-newspaper",
                    "fab fa-nintendo-switch",
                    "fab fa-node",
                    "fab fa-node-js",
                    "fab fa-npm",
                    "fab fa-ns8",
                    "fab fa-nutritionix",
                    "fas fa-object-group", "far fa-object-group",
                    "fas fa-object-ungroup", "far fa-object-ungroup",
                    "fab fa-odnoklassniki",
                    "fab fa-odnoklassniki-square",
                    "fab fa-opencart",
                    "fab fa-openid",
                    "fab fa-opera",
                    "fab fa-optin-monster",
                    "fab fa-osi",
                    "fas fa-outdent",
                    "fab fa-page4",
                    "fab fa-pagelines",
                    "fas fa-paint-brush",
                    "fab fa-palfed",
                    "fas fa-paper-plane", "far fa-paper-plane",
                    "fas fa-paperclip",
                    "fas fa-paragraph",
                    "fas fa-paste",
                    "fab fa-patreon",
                    "fas fa-pause",
                    "fas fa-pause-circle", "far fa-pause-circle",
                    "fas fa-paw",
                    "fab fa-paypal",
                    "fas fa-pen-square",
                    "fas fa-pencil-alt",
                    "fas fa-percent",
                    "fab fa-periscope",
                    "fab fa-phabricator",
                    "fab fa-phoenix-framework",
                    "fas fa-phone",
                    "fas fa-phone-square",
                    "fas fa-phone-volume",
                    "fab fa-pied-piper",
                    "fab fa-pied-piper-alt",
                    "fab fa-pied-piper-pp",
                    "fab fa-pinterest",
                    "fab fa-pinterest-p",
                    "fab fa-pinterest-square",
                    "fas fa-plane",
                    "fas fa-play",
                    "fas fa-play-circle", "far fa-play-circle",
                    "fab fa-playstation",
                    "fas fa-plug",
                    "fas fa-plus",
                    "fas fa-plus-circle",
                    "fas fa-plus-square", "far fa-plus-square",
                    "fas fa-podcast",
                    "fas fa-pound-sign",
                    "fas fa-power-off",
                    "fas fa-print",
                    "fab fa-product-hunt",
                    "fab fa-pushed",
                    "fas fa-puzzle-piece",
                    "fab fa-python",
                    "fab fa-qq",
                    "fas fa-qrcode",
                    "fas fa-question",
                    "fas fa-question-circle", "far fa-question-circle",
                    "fab fa-quora",
                    "fas fa-quote-left",
                    "fas fa-quote-right",
                    "fas fa-random",
                    "fab fa-ravelry",
                    "fab fa-react",
                    "fab fa-rebel",
                    "fas fa-recycle",
                    "fab fa-red-river",
                    "fab fa-reddit",
                    "fab fa-reddit-alien",
                    "fab fa-reddit-square",
                    "fas fa-redo",
                    "fas fa-redo-alt",
                    "fas fa-registered", "far fa-registered",
                    "fab fa-rendact",
                    "fab fa-renren",
                    "fas fa-reply",
                    "fas fa-reply-all",
                    "fab fa-replyd",
                    "fab fa-resolving",
                    "fas fa-retweet",
                    "fas fa-road",
                    "fas fa-rocket",
                    "fab fa-rocketchat",
                    "fab fa-rockrms",
                    "fas fa-rss",
                    "fas fa-rss-square",
                    "fas fa-ruble-sign",
                    "fas fa-rupee-sign",
                    "fab fa-safari",
                    "fab fa-sass",
                    "fas fa-save", "far fa-save",
                    "fab fa-schlix",
                    "fab fa-scribd",
                    "fas fa-search",
                    "fas fa-search-minus",
                    "fas fa-search-plus",
                    "fab fa-searchengin",
                    "fab fa-sellcast",
                    "fab fa-sellsy",
                    "fas fa-server",
                    "fab fa-servicestack",
                    "fas fa-share",
                    "fas fa-share-alt",
                    "fas fa-share-alt-square",
                    "fas fa-share-square", "far fa-share-square",
                    "fas fa-shekel-sign",
                    "fas fa-shield-alt",
                    "fas fa-ship",
                    "fab fa-shirtsinbulk",
                    "fas fa-shopping-bag",
                    "fas fa-shopping-basket",
                    "fas fa-shopping-cart",
                    "fas fa-shower",
                    "fas fa-sign-in-alt",
                    "fas fa-sign-language",
                    "fas fa-sign-out-alt",
                    "fas fa-signal",
                    "fab fa-simplybuilt",
                    "fab fa-sistrix",
                    "fas fa-sitemap",
                    "fab fa-skyatlas",
                    "fab fa-skype",
                    "fab fa-slack",
                    "fab fa-slack-hash",
                    "fas fa-sliders-h",
                    "fab fa-slideshare",
                    "fas fa-smile", "far fa-smile",
                    "fab fa-snapchat",
                    "fab fa-snapchat-ghost",
                    "fab fa-snapchat-square",
                    "fas fa-snowflake", "far fa-snowflake",
                    "fas fa-sort",
                    "fas fa-sort-alpha-down",
                    "fas fa-sort-alpha-up",
                    "fas fa-sort-amount-down",
                    "fas fa-sort-amount-up",
                    "fas fa-sort-down",
                    "fas fa-sort-numeric-down",
                    "fas fa-sort-numeric-up",
                    "fas fa-sort-up",
                    "fab fa-soundcloud",
                    "fas fa-space-shuttle",
                    "fab fa-speakap",
                    "fas fa-spinner",
                    "fab fa-spotify",
                    "fas fa-square", "far fa-square",
                    "fab fa-stack-exchange",
                    "fab fa-stack-overflow",
                    "fas fa-star", "far fa-star",
                    "fas fa-star-half", "far fa-star-half",
                    "fab fa-staylinked",
                    "fab fa-steam",
                    "fab fa-steam-square",
                    "fab fa-steam-symbol",
                    "fas fa-step-backward",
                    "fas fa-step-forward",
                    "fas fa-stethoscope",
                    "fab fa-sticker-mule",
                    "fas fa-sticky-note", "far fa-sticky-note",
                    "fas fa-stop",
                    "fas fa-stop-circle", "far fa-stop-circle",
                    "fab fa-strava",
                    "fas fa-street-view",
                    "fas fa-strikethrough",
                    "fab fa-stripe",
                    "fab fa-stripe-s",
                    "fab fa-studiovinari",
                    "fab fa-stumbleupon",
                    "fab fa-stumbleupon-circle",
                    "fas fa-subscript",
                    "fas fa-subway",
                    "fas fa-suitcase",
                    "fas fa-sun", "far fa-sun",
                    "fab fa-superpowers",
                    "fas fa-superscript",
                    "fab fa-supple",
                    "fas fa-sync",
                    "fas fa-sync-alt",
                    "fas fa-table",
                    "fas fa-tablet",
                    "fas fa-tablet-alt",
                    "fas fa-tachometer-alt",
                    "fas fa-tag",
                    "fas fa-tags",
                    "fas fa-tasks",
                    "fas fa-taxi",
                    "fab fa-telegram",
                    "fab fa-telegram-plane",
                    "fab fa-tencent-weibo",
                    "fas fa-terminal",
                    "fas fa-text-height",
                    "fas fa-text-width",
                    "fas fa-th",
                    "fas fa-th-large",
                    "fas fa-th-list",
                    "fab fa-themeisle",
                    "fas fa-thermometer-empty",
                    "fas fa-thermometer-full",
                    "fas fa-thermometer-half",
                    "fas fa-thermometer-quarter",
                    "fas fa-thermometer-three-quarters",
                    "fas fa-thumbs-down", "far fa-thumbs-down",
                    "fas fa-thumbs-up", "far fa-thumbs-up",
                    "fas fa-thumbtack",
                    "fas fa-ticket-alt",
                    "fas fa-times",
                    "fas fa-times-circle", "far fa-times-circle",
                    "fas fa-tint",
                    "fas fa-toggle-off",
                    "fas fa-toggle-on",
                    "fas fa-trademark",
                    "fas fa-train",
                    "fas fa-transgender",
                    "fas fa-transgender-alt",
                    "fas fa-trash",
                    "fas fa-trash-alt", "far fa-trash-alt",
                    "fas fa-tree",
                    "fab fa-trello",
                    "fab fa-tripadvisor",
                    "fas fa-trophy",
                    "fas fa-truck",
                    "fas fa-tty",
                    "fab fa-tumblr",
                    "fab fa-tumblr-square",
                    "fas fa-tv",
                    "fab fa-twitch",
                    "fab fa-twitter",
                    "fab fa-twitter-square",
                    "fab fa-typo3",
                    "fab fa-uber",
                    "fab fa-uikit",
                    "fas fa-umbrella",
                    "fas fa-underline",
                    "fas fa-undo",
                    "fas fa-undo-alt",
                    "fab fa-uniregistry",
                    "fas fa-universal-access",
                    "fas fa-university",
                    "fas fa-unlink",
                    "fas fa-unlock",
                    "fas fa-unlock-alt",
                    "fab fa-untappd",
                    "fas fa-upload",
                    "fab fa-usb",
                    "fas fa-user", "far fa-user",
                    "fas fa-user-circle", "far fa-user-circle",
                    "fas fa-user-md",
                    "fas fa-user-plus",
                    "fas fa-user-secret",
                    "fas fa-user-times",
                    "fas fa-users",
                    "fab fa-ussunnah",
                    "fas fa-utensil-spoon",
                    "fas fa-utensils",
                    "fab fa-vaadin",
                    "fas fa-venus",
                    "fas fa-venus-double",
                    "fas fa-venus-mars",
                    "fab fa-viacoin",
                    "fab fa-viadeo",
                    "fab fa-viadeo-square",
                    "fab fa-viber",
                    "fas fa-video",
                    "fab fa-vimeo",
                    "fab fa-vimeo-square",
                    "fab fa-vimeo-v",
                    "fab fa-vine",
                    "fab fa-vk",
                    "fab fa-vnv",
                    "fas fa-volume-down",
                    "fas fa-volume-off",
                    "fas fa-volume-up",
                    "fab fa-vuejs",
                    "fab fa-weibo",
                    "fab fa-weixin",
                    "fab fa-whatsapp",
                    "fab fa-whatsapp-square",
                    "fas fa-wheelchair",
                    "fab fa-whmcs",
                    "fas fa-wifi",
                    "fab fa-wikipedia-w",
                    "fas fa-window-close", "far fa-window-close",
                    "fas fa-window-maximize", "far fa-window-maximize",
                    "fas fa-window-minimize",
                    "fas fa-window-restore", "far fa-window-restore",
                    "fab fa-windows",
                    "fas fa-won-sign",
                    "fab fa-wordpress",
                    "fab fa-wordpress-simple",
                    "fab fa-wpbeginner",
                    "fab fa-wpexplorer",
                    "fab fa-wpforms",
                    "fas fa-wrench",
                    "fab fa-xbox",
                    "fab fa-xing",
                    "fab fa-xing-square",
                    "fab fa-y-combinator",
                    "fab fa-yahoo",
                    "fab fa-yandex",
                    "fab fa-yandex-international",
                    "fab fa-yelp",
                    "fas fa-yen-sign",
                    "fab fa-yoast",
                    "fab fa-youtube"
            	);
	}
}

if( is_admin() ){
	add_action( 'wp_default_scripts', 'wp_default_custom_scripts' );
	function wp_default_custom_scripts( $scripts ){
		$scripts->add( 'wp-color-picker', "/wp-admin/js/color-picker.js", array( 'iris' ), false, 1 );
		did_action( 'init' ) && $scripts->localize(
			'wp-color-picker',
			'wpColorPickerL10n',
			array(
				'clear'            => __( 'Clear' ),
				'clearAriaLabel'   => __( 'Clear color' ),
				'defaultString'    => __( 'Default' ),
				'defaultAriaLabel' => __( 'Select default color' ),
				'pick'             => __( 'Select Color' ),
				'defaultLabel'     => __( 'Color value' ),
			)
		);
	}
}