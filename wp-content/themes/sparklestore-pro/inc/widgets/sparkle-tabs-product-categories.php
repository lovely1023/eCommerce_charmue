<?php
/**
** Adds sparklestore_pro_cat_collection_tabs_widget widget.
*/
add_action('widgets_init', 'sparklestore_pro_cat_collection_tabs_widget');
function sparklestore_pro_cat_collection_tabs_widget() {
   register_widget('sparklestore_pro_cat_collection_tabs_widget_area');
}

class sparklestore_pro_cat_collection_tabs_widget_area extends WP_Widget {

   /**
    * Register widget with WordPress.
   **/
   public function __construct() {
       parent::__construct(
           'sparklestore_pro_cat_collection_tabs_widget_area', esc_html__('&#9733; Tabs Category by Products','sparklestore-pro'), array(
           'description' => esc_html__('A widget display multiple categories products in tabs', 'sparklestore-pro')
       ));
   }

   private function widget_fields() {
        $taxonomy     = 'product_cat';
        $empty        = 1;
        $orderby      = 'name';
        $show_count   = 0;      // 1 for yes, 0 for no
        $pad_counts   = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no
        $title        = '';
        $empty        = 0;
        $args = array(
         'taxonomy'     => $taxonomy,
         'orderby'      => $orderby,
         'show_count'   => $show_count,
         'pad_counts'   => $pad_counts,
         'hierarchical' => $hierarchical,
         'title_li'     => $title,
         'hide_empty'   => $empty
        );

        $woocommerce_categories = array();
        $woocommerce_categories_obj = get_categories($args);
        foreach ($woocommerce_categories_obj as $category) {
         $woocommerce_categories[$category->term_id] = $category->name;
        }

        $fields = array(
            'cl_tab' => array(
                'sparklestore_pro_widgets_tabs' => array(
                    'cl-content' => __('Content', 'sparklestore-pro'),
                    'cl-style' => __('Style', 'sparklestore-pro'),
                ),
                'sparklestore_pro_widgets_field_type' => 'tab'
            ),
            'tab_open' => array(
                'sparklestore_pro_widgets_class' => 'cl-widget-tab-content-wrap',
                'sparklestore_pro_widgets_field_type' => 'open'
            ),
            'content_open' => array(
                'sparklestore_pro_widgets_class' => 'cl-widget-tab-content',
                'sparklestore_pro_widgets_data_id' => 'cl-content',
                'sparklestore_pro_widgets_field_type' => 'open'
            ),

            
            //title dynamic fields
           'title_dynamic_fields' => array(),
            
            'sparklestore_pro_tab_display_layout' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_tab_display_layout',
                'sparklestore_pro_widgets_title' => esc_html__('Tab Layout Style', 'sparklestore-pro'),
                'sparklestore_pro_widgets_default' => 'tab_styleone',
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_field_options' => array(
                    'tab_styleone' => __('Style One', 'sparklestore-pro'),
                    'tab_styletwo' => __('Style Two', 'sparklestore-pro'),
                    'tab_stylethree' => __('Style Three', 'sparklestore-pro'),
                )
            ),

            'sparklestore_pro_product_display_layout' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_product_display_layout',
                'sparklestore_pro_widgets_title' => esc_html__('Product Display Style', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'grid',
                'sparklestore_pro_widgets_field_options' => array(
                    'slider' => __('Slider', 'sparklestore-pro'),
                    'grid' => __('Grid', 'sparklestore-pro')
                )
            ),

            'sparklestore_pro_product_list_column' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_product_list_column',
                'sparklestore_pro_widgets_title' => esc_html__('Select Column', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 4,
                'sparklestore_pro_widgets_field_options' => array(   
                        1 => esc_html__('1 Column','sparklestore-pro'),                 
                        2 => esc_html__('2 Column','sparklestore-pro'),
                        3 => esc_html__('3 Column','sparklestore-pro'),
                        4 => esc_html__('4 Column','sparklestore-pro'),
                        5 => esc_html__('5 Column','sparklestore-pro'),
                        6 => esc_html__('6 Column','sparklestore-pro'),                    
                    )
                ),

            'sparklestore_pro_select_category' => array(
               'sparklestore_pro_widgets_name' => 'sparklestore_pro_select_category',
               'sparklestore_pro_widgets_title' => esc_html__('Select Category', 'sparklestore-pro'),
               'sparklestore_pro_widgets_field_type' => 'multiselect',
               'sparklestore_pro_widgets_field_options' => $woocommerce_categories
            ),

            'sparklestore_pro_number_products' => array(
               'sparklestore_pro_widgets_name' => 'sparklestore_pro_number_products',
               'sparklestore_pro_widgets_title' => esc_html__('Number of Products', 'sparklestore-pro'),
               'sparklestore_pro_widgets_field_type' => 'number',
               'sparklestore_pro_widgets_default' => 8,
            ),

            'content_close' => array(
                'sparklestore_pro_widgets_field_type' => 'close'
            ),

            // style tab start from here
            'style_open' => array(
                'sparklestore_pro_widgets_class' => 'cl-widget-tab-content cl-flex-wrap',
                'sparklestore_pro_widgets_data_id' => 'cl-style',
                'sparklestore_pro_widgets_field_type' => 'open',
            ),

            //dynamic fields
            'style_dynamic_fields' => array(),

            
            'style_close' => array(
                'sparklestore_pro_widgets_field_type' => 'close'
            ),

            'tab_close' => array(
                'sparklestore_pro_widgets_field_type' => 'close'
            )

       );

       //replace
        $new_fields = array();
        foreach($fields as $field => $value){

            if( $field == 'title_dynamic_fields' || $field == 'style_dynamic_fields'){
                if($field == 'title_dynamic_fields' ){
                    foreach(sparklestore_pro_default_title_block() as $f => $v){
                        $new_fields[$f] = $v;
                    }
                }
                if($field == 'style_dynamic_fields' ){
                    foreach(sparklestore_pro_widget_default_style() as $f => $v){
                        $new_fields[$f] = $v;
                    }
                }
            }else{
                $new_fields[$field] = $value;
            }
        }

        unset($fields);
        return $new_fields;
   }

   public function widget($args, $instance) {

       extract($args);
        
       /**
        * wp query for first block
       */
        $title           = empty( $instance['sparklestore_pro_title'] ) ? '' : $instance['sparklestore_pro_title'];
        $sub_title       = empty( $instance['sparklestore_pro_short_desc'] ) ? '' : $instance['sparklestore_pro_short_desc'];
        $titlestyle      = empty( $instance['sparklestore_pro_title_style'] ) ? '' : $instance['sparklestore_pro_title_style'];

        //$tab_position    = empty( $instance['sparklestore_pro_tab_position'] ) ? '' : $instance['sparklestore_pro_tab_position'];
        $sparklestore_pro_cat_id = $instance['sparklestore_pro_select_category'] ?  $instance['sparklestore_pro_select_category'] : '';

        $product_number   = empty( $instance['sparklestore_pro_number_products'] ) ? 8 : $instance['sparklestore_pro_number_products'];
        $layout           = empty( $instance['sparklestore_pro_product_display_layout'] ) ? '' : $instance['sparklestore_pro_product_display_layout'];
        $column_number    = empty( $instance['sparklestore_pro_product_list_column'] ) ? '' : $instance['sparklestore_pro_product_list_column'];

        $tab_style         = empty( $instance['sparklestore_pro_tab_display_layout'] ) ? 'tab_styleone' : $instance['sparklestore_pro_tab_display_layout'];
        $bottom_seprator   = empty( $instance['sparklestore_pro_bottom_seprator']) ? '' : $instance['sparklestore_pro_bottom_seprator'];
        
        if(!empty( $sparklestore_pro_cat_id )) {
            $first_cat_id =  current( $sparklestore_pro_cat_id );
        }
        
       echo $before_widget;

       $id = wp_generate_uuid4(  );
       sparkle_themes_widget_dynamic_style($instance, '#section-'.$id);

        $css = array();
        $css[] = 'sparkletabsproductwrap section-wrap';
        $css[] = 'product-hover-'.get_theme_mod('sparklestore_pro_woo_product_hover_style', 'style1'); 
        $css[] = esc_attr( $layout );
   ?>

       <div id="section-<?php echo $id; ?>" class="<?php echo implode(' ', $css); ?>">
            <div class="container">
                <div class="section-content">

                    <?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>

                    <div class="sparkletabs tabsblockwrap <?php echo esc_attr( $tab_style ); ?> clearfix">
                        <ul class="sparkletablinks" data-noofporduct="<?php echo intval( $product_number ); ?>" data-column="<?php echo intval($column_number); ?>" data-layout="<?php echo esc_attr($layout); ?>">
                            <?php
                                if(!empty($sparklestore_pro_cat_id)){
                                    $count = 0;
                                    foreach ($sparklestore_pro_cat_id as $key ) { $count++;
                                        if( $count == 1){
                                            $data_loaded = 1;
                                        }else{
                                            $data_loaded = 0;
                                        }

                                        $term = get_term_by( 'id', $key, 'product_cat');
                                        if(!$term) continue;
                                    ?>
                                        <li data-loaded="<?php echo esc_attr( $data_loaded ); ?>"><a class="btn btn-primary" href="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
                                    <?php
                                }
                                }
                            ?>
                        </ul>
                    </div>

                    <div class="sparkletablinkscontent">

                        <div class="preloader" style="display:none;">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/rhombus.gif">
                        </div>

                        <div class="tabscontentwrap">
                            <div class="sparkletabproductarea">
                                
                                <?php
                                    if(!empty($sparklestore_pro_cat_id)):
                                        
                                        $count = 1;
                                        foreach ($sparklestore_pro_cat_id as $key):

                                        $term = get_term_by( 'id', $key, 'product_cat');
                                        if(!$term) continue;
                                        $hidden = 'hidden';
                                        
                                        if( $count == 1){
                                            $hidden = '';
                                            
                                        }

                                        ?>
                                        <ul id="<?php echo esc_attr( $term->slug ); ?>" class="storeproductlist gird-<?php echo esc_attr( $column_number ); ?> <?php echo esc_attr($hidden); ?> <?php if($layout == 'slider'){ echo esc_attr('storeslider owl-carousel'); } ?>" data-column="<?php echo esc_attr( $column_number ); ?>" data-style="<?php echo esc_attr( $layout ); ?>">
                                            
                                            <?php
                                                if( $count == 1):
                                                    $product_args = array(
                                                        'post_type' => 'product',
                                                        'tax_query' => array(
                                                            array(
                                                                'taxonomy'  => 'product_cat',
                                                                'field'     => 'term_id',
                                                                'terms'     => $first_cat_id
                                                            )),
                                                        'posts_per_page' => $product_number
                                                    );
                                                    $query = new WP_Query($product_args);

                                                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                            ?>
                                                    <?php wc_get_template_part( 'content', 'product' ); ?>

                                            <?php } } wp_reset_postdata(); endif; $count++ ?>


                                        </ul>
                                    
                                        <?php
                                        endforeach;
                                    endif;
                                ?>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

          <?php sparklestore_pro_add_bottom_seperator($bottom_seprator); ?>
       </div>

   <?php
       echo $after_widget;
   }

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