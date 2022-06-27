<?php

/**
 * Custom wp_nav_menu walker.
 *
 */

function sparkle_menu_header_style() {
    return 'horizontal';
}

define('SPARKLE_THEMES_ELEMENTOR_ACTIVE', class_exists('Elementor\Plugin'));
define('SPARKLE_THEMES_BEAVER_BUILDER_ACTIVE', class_exists('FLBuilder'));
define('SPARKLE_THEMES_SITEORIGIN_ACTIVE', class_exists('SiteOrigin_Panels'));

if (!class_exists('SparkleTheme_Custom_Nav_Walker')) {

    class SparkleTheme_Custom_Nav_Walker extends Walker_Nav_Menu {

        /**
         * Starts the list before the elements are added.
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   An array of arguments. @see wp_nav_menu()
         */
        public function start_lvl(&$output, $depth = 0, $args = array()) {
            $indent = str_repeat("\t", $depth);

            // Megamenu columns
            $col = !empty($this->megamenu_col) ? ( 'col-' . $this->megamenu_col . '' ) : 'col-2';

            if ($depth === 0 && $this->megamenu != '' && $this->megamenu != 'normal' && 'full_screen' != sparkle_menu_header_style() && 'vertical' != sparkle_menu_header_style()) {
                $output .= "\n$indent<ul class=\"megamenu " . $col . " sub-menu\">\n";
            } else {
                $output .= "\n$indent<ul class=\"sub-menu\">\n";
            }
        }

        /**
         * Modified the menu output.
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $item   Menu item data object.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   An array of arguments. @see wp_nav_menu()
         * @param int    $id     Current item ID.
         */
        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
            global $wp_query;
            $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

            // Set some vars
            if ($depth === 0) {
                $this->megamenu = get_post_meta($item->ID, '_menu_item_megamenu', true);
                $this->megamenu_col = get_post_meta($item->ID, '_menu_item_megamenu_col', true);
            }

            // Set up empty variable.
            $class_names = '';

            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            // Mega menu
            if ($depth === 0 && $this->has_children && $item->category_post == '' && 'vertical' != sparkle_menu_header_style()) {
                if ($this->megamenu == 'megamenu_full_width') {
                    $classes[] = 'menu-item-megamenu megamenu-full-width';
                } else if ($this->megamenu == 'megamenu_auto_width') {
                    $classes[] = 'menu-item-megamenu megamenu-auto-width';
                }
            }
            
            $this->megamenu_heading = get_post_meta($item->ID, '_menu_item_megamenu_heading', true);
            if ($depth != 0 && $this->megamenu_heading != '' && $this->megamenu != 'normal') {
                $classes[] = 'heading-'.$this->megamenu_heading;
            }

            // Latest post for menu item categories
            if ($depth === 0 && $item->category_post != '' && $item->object == 'category' && 'vertical' != sparkle_menu_header_style()) {
                $classes[] = 'menu-item-has-children menu-item-megamenu megamenu-full-width megamenu-category';
            }

            /**
             * Filters the arguments for a single nav menu item.
             *
             * @since 4.4.0
             *
             * @param stdClass $args  An object of wp_nav_menu() arguments.
             * @param WP_Post  $item  Menu item data object.
             * @param int      $depth Depth of menu item. Used for padding.
             */
            $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

            /**
             * Filters the CSS class(es) applied to a menu item's list item element.
             *
             * @since 3.0.0
             * @since 4.1.0 The `$depth` parameter was added.
             *
             * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
             * @param WP_Post  $item    The current menu item.
             * @param stdClass $args    An object of wp_nav_menu() arguments.
             * @param int      $depth   Depth of menu item. Used for padding.
             */
            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

            /**
             * Filters the ID applied to a menu item's list item element.
             *
             * @since 3.0.1
             * @since 4.1.0 The `$depth` parameter was added.
             *
             * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
             * @param WP_Post  $item    The current menu item.
             * @param stdClass $args    An object of wp_nav_menu() arguments.
             * @param int      $depth   Depth of menu item. Used for padding.
             */
            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $class_names . '>';

            $atts = array();
            $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
            $atts['href'] = !empty($item->url) ? $item->url : '';

            /**
             * Filters the HTML attributes applied to a menu item's anchor element.
             *
             * @since 3.6.0
             * @since 4.1.0 The `$depth` parameter was added.
             *
             * @param array $atts {
             *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
             *
             *     @type string $title  Title attribute.
             *     @type string $target Target attribute.
             *     @type string $rel    The rel attribute.
             *     @type string $href   The href attribute.
             * }
             * @param WP_Post  $item  The current menu item.
             * @param stdClass $args  An object of wp_nav_menu() arguments.
             * @param int      $depth Depth of menu item. Used for padding.
             */
            $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ( 'href' === $attr ) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            /** This filter is documented in wp-includes/post-template.php */
            $title = apply_filters('the_title', $item->title, $item->ID);

            /**
             * Filters a menu item's title.
             *
             * @since 4.4.0
             *
             * @param string   $title The menu item's title.
             * @param WP_Post  $item  The current menu item.
             * @param stdClass $args  An object of wp_nav_menu() arguments.
             * @param int      $depth Depth of menu item. Used for padding.
             */
            $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

            // Description
            $description = '';
            if ($item->description != '') {
                $description = '<p class="nav-desc">' . $item->description . '</p>';
            }

            // Output
            $item_output = !empty($args->before) ? $args->before : '';
            $link_before = !empty($args->link_before) ? $args->link_before : '';
            $link_after = !empty($args->link_after) ? $args->link_after : '';
            $item_output .= '<a' . $attributes . ' class="menu-link">';

            $item_output .= $link_before . $title . $link_after;

            if ($depth !== 0) {
                $item_output .= $description;
            }

            $item_output .= '</a>';
            if ($depth !== 0 && $item->megamenu_template && $this->megamenu != 'normal' && 'vertical' != sparkle_menu_header_style()) {
                ob_start();
                include( get_template_directory() . '/inc/walker/template.php' );
                $template_content = ob_get_contents();
                ob_end_clean();
                $item_output .= $template_content;
            }

            if ($depth !== 0 && $item->megamenu_widgetarea && $this->megamenu != 'normal' && 'vertical' != sparkle_menu_header_style()) {
                ob_start();
                echo '<div class="menu-widget">';
                dynamic_sidebar($item->megamenu_widgetarea);
                echo '</div>';
                $sidebar_content = ob_get_contents();
                ob_end_clean();
                $item_output .= $sidebar_content;
            }

            $item_output .= !empty($args->after) ? $args->after : '';

            /**
             * Filters a menu item's starting output.
             *
             * The menu item's starting output only includes `$args->before`, the opening `<a>`,
             * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
             * no filter for modifying the opening and closing `<li>` for a menu item.
             *
             * @since 3.0.0
             *
             * @param string   $item_output The menu item's starting HTML output.
             * @param WP_Post  $item        Menu item data object.
             * @param int      $depth       Depth of menu item. Used for padding.
             * @param stdClass $args        An object of wp_nav_menu() arguments.
             */
            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }

        /**
         * Modified the menu end.
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $item   Menu item data object.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   An array of arguments. @see wp_nav_menu()
         */
        public function end_el(&$output, $item, $depth = 0, $args = array()) {

            // Header style
            $header_style = sparkle_menu_header_style();

            if ($depth === 0 && $item->category_post != '' && 'full_screen' != $header_style && 'vertical' != $header_style) {

                global $post;

                $output .= "\n<ul class=\"megamenu col-4 sub-menu ht-clear\">\n";

                // Sub Categories ===============================================================
                if ($item->category_post != '' && $item->object == 'category') {
                    $no_sub_categories = $sub_categories_exists = $sub_categories = $cat_title = $cat_content = '';
                    
                    $query_args = array(
                        'parent' => $item->object_id,
                        'hide_empty' => false
                    );
                    $sub_categories = get_categories($query_args);
                    
                    //Check if the category doesn't contain any sub categories.
                    if (count($sub_categories) == 0) {
                        $sub_categories = array($item->object_id);
                        $no_sub_categories = true;
                    }

                    foreach ($sub_categories as $category) {

                        if (!$no_sub_categories) {
                            $cat_id = $category->term_id;
                            $post_per_page = 3;
                            $cat_content_class = 'cat-megamenu-content';
                        } else {
                            $cat_id = $category;
                            $post_per_page = 4;
                            $cat_content_class = 'cat-megamenu-content-full';
                        }

                        $original_post = $post;

                        $args = array(
                            'posts_per_page' => $post_per_page,
                            'cat' => $cat_id,
                            'no_found_rows' => true,
                            'ignore_sticky_posts' => true
                        );
                        $cat_query = new WP_Query($args);

                        // Title
                        $cat_title .= '<div data-catid="mm-cat-'.$item->ID.$cat_id.'">' . get_cat_name($cat_id) . '</div>';
                        
                        $cat_content .= '<ul class="ht-clear" id="mm-cat-'.$item->ID.$cat_id.'">';
                        while ($cat_query->have_posts()) {

                            $cat_query->the_post();

                            $cat_content .= '<li class="megamenu-category-post">';

                            if (has_post_thumbnail()) {
                                // Image args
                                $img_args = array(
                                    'alt' => get_the_title(),
                                );

                                $cat_content .= '<a href="' . get_permalink() . '" title="' . get_the_title() . '" class="mega-post-link">';

                                $cat_content .= get_the_post_thumbnail(get_the_ID(), 'total-400x280', $img_args);

                                $cat_content .= '</a>';

                                $cat_content .= '<h3 class="mega-post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
                                $cat_content .= '<div class="mega-post-date"><i class="icon-clock"></i>' . get_the_date() . '</div>';
                            }

                            $output .= '</li>';
                        }
                        $cat_content .= '</ul>';

                        wp_reset_postdata();
                    }
                    
                    if(!$no_sub_categories){
                        $output .= '<div class="cat-megamenu-tab">';
                        $output .= $cat_title;
                        $output .= '</div>';
                    }
                    
                    $output .= '<div class="'.$cat_content_class.'">';
                    $output .= $cat_content;
                    $output .= '</div>';

                    $output .= '</ul>';
                }
            }
            $output .= '</li>';
        }

        /**
         * Ends the list of after the elements are added.
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   An array of arguments. @see wp_nav_menu()
         */
        public function end_lvl(&$output, $depth = 0, $args = array()) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
        }

        /**
         * Icon if sub menu.
         */
        public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {

            // Define vars
            $id_field = $this->db_fields['id'];
            $header_style = sparkle_menu_header_style();

            if (is_object($args[0]))
                $args[0]->has_children = !empty($children_elements[$element->$id_field]);

            // Down Arrows
            if (($depth == 0 && !empty($children_elements[$element->$id_field] )) || ( $depth == 0 && $element->category_post != '' && $element->object == 'category') && 'full_screen' != $header_style) {
                $element->title .= '<span class="dropdown-nav mdi mdi-chevron-down"></span>';
            }

            // Right/Left Arrows
            if (!empty($children_elements[$element->$id_field]) && ( $depth > 0 )) {
                if (is_rtl()) {
                    $element->title .= '<span class="dropdown-nav mdi mdi-chevron-left"></span>';
                } else {
                    $element->title .= '<span class="dropdown-nav mdi mdi-chevron-right"></span>';
                }
            }

            // Define walker
            Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }

    }

}