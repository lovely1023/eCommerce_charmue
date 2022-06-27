<?php
/**
 ** Adds sparklestore_pro_product_widget widget.
*/
add_action('widgets_init', 'sparklestore_pro_product_widget');
function sparklestore_pro_product_widget() {
    register_widget('sparklestore_pro_product_widget_area');
}
class sparklestore_pro_product_widget_area extends WP_Widget {
    private $prod_type = '';

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'sparklestore_pro_product_widget_area', esc_html__('&#9733; All Type Products','sparklestore-pro'), array(
            'description' => esc_html__('A widget all type product (Latest, Feature, On Sale, Up Sale) in tabs', 'sparklestore-pro')
        ));

        $this->prod_type = array(
            'latest_product'  => esc_html__('Latest Product', 'sparklestore-pro'),
            'upsell_product'  => esc_html__('UpSell Product', 'sparklestore-pro'),
            'feature_product' => esc_html__('Feature Product', 'sparklestore-pro'),
            'on_sale'         => esc_html__('On Sale Product', 'sparklestore-pro'),
        );
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
        $woocommerce_categories[''] = esc_html__('Select Product Category','sparklestore-pro');
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
            

            'sparklestore_pro_product_type' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_product_type',
                'sparklestore_pro_widgets_title' => esc_html__('Select Product Type', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'multicheckbox',
                'sparklestore_pro_widgets_field_options' => $this->prod_type,
                'sparklestore_pro_widgets_description' => __('Multiple Selection only works for tab view', 'sparklestore-pro'),
            ),

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

            'sparklestore_pro_product_type_column' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_product_type_column',
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

            'sparklestore_pro_product_type_layout' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_product_type_layout',
                'sparklestore_pro_widgets_title' => esc_html__('View Style', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'grid',
                'sparklestore_pro_widgets_field_options' => array(                    
                        'slider' => esc_html__('Slider','sparklestore-pro'),
                        'grid' => esc_html__('Grid','sparklestore-pro')
                    )
            ),
            
            'sparklestore_pro_product_number' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_product_number',
                'sparklestore_pro_widgets_title' => esc_html__('Enter Number of Products Show', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'number',
                'sparklestore_pro_widgets_default' =>  8,
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

    function getQuery($product_type, $product_number = 5){
        if($product_type == 'latest_product'){
            $product_label_custom = esc_html__('New', 'sparklestore-pro');
            $product_args = array(
                'post_type' => 'product',
                'posts_per_page' => $product_number
            );
        }
        elseif($product_type == 'upsell_product'){
            $product_args = array(
                'post_type'         => 'product',
                'posts_per_page'    => 10,
                'meta_key'          => 'total_sales',
                'orderby'           => 'meta_value_num',
                'posts_per_page'    => $product_number
            );
        }
        elseif($product_type == 'feature_product'){
            $product_args = array(
                'post_type'        => 'product',  
                'tax_query' => array(
                      'relation' => 'AND',      
                  array(
                      'taxonomy' => 'product_visibility',
                      'field'    => 'name',
                      'terms'    => 'featured',
                      'operator' => 'IN'
                  )
                ), 
                'posts_per_page'   => $product_number   
            );
        }
        elseif($product_type == 'on_sale'){
            $product_args = array(
            'post_type'      => 'product',
            'meta_query'     => array(
                'relation' => 'OR',
                array( // Simple products type
                    'key'           => '_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                ),
                array( // Variable products type
                    'key'           => '_min_variation_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                )
            ));
        }

        return $product_args;
    }

    public function widget($args, $instance) {

        extract($args);
        extract($instance); 

        /**
         * wp query for first block
        */  
        /**
         * wp query for first block
        */  
        $title           = empty( $instance['sparklestore_pro_title'] ) ? '' : $instance['sparklestore_pro_title'];
        $sub_title       = empty( $instance['sparklestore_pro_short_desc'] ) ? '' : $instance['sparklestore_pro_short_desc'];
        $titlestyle      = empty( $instance['sparklestore_pro_title_style'] ) ? '' : $instance['sparklestore_pro_title_style'];

        $product_types     = empty( $instance['sparklestore_pro_product_type'] ) ? '' : $instance['sparklestore_pro_product_type'];
        
        $product_number   = empty( $instance['sparklestore_pro_product_number'] ) ? 5 : $instance['sparklestore_pro_product_number'];
        $column_number    = empty( $instance['sparklestore_pro_product_type_column'] ) ? '' : $instance['sparklestore_pro_product_type_column'];
        $tab_style         = empty( $instance['sparklestore_pro_tab_display_layout'] ) ? 'tab_styleone' : $instance['sparklestore_pro_tab_display_layout'];
        $layout   = empty( $instance['sparklestore_pro_product_type_layout'] ) ? '' : $instance['sparklestore_pro_product_type_layout'];

        
        $product_args       =   '';
        global $product_label_custom;
        $product_type = '';
        if( !empty($product_types) ){
            $keys = array_keys($product_types);
            $product_type = array_shift($keys);
        }

        $id = wp_generate_uuid4(  );
        sparkle_themes_widget_dynamic_style($instance, '#section-'.$id);
        
        echo $before_widget;
        $css = array();
        $css[] = 'product-hover-'.get_theme_mod('sparklestore_pro_woo_product_hover_style', 'style1'); 
        $css[] = 'producttype-wrap section-wrap';
        $css[] = esc_attr( $layout );
    ?> 

        <div id="section-<?php echo $id; ?>" class="<?php echo implode(' ', $css); ?>">            
            <div class="container">
                <div class="product-list-area section-content"> 
                    <?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>
                    <?php if( count($product_types) != 1) : ?>
                        <div class="sparkletabs tabsblockwrap <?php echo esc_attr( $tab_style ); ?> clearfix">
                        
                            <ul class="sparkletablinks">
                                <?php
                                    if(!empty($product_types)){

                                        foreach ($product_types as $key => $storecat_id) {
                                            
                                        ?>
                                            <li><a class="btn btn-primary" id="<?php echo esc_attr( $key); ?>" data-noajax="1" href="#<?php echo esc_attr( $key); ?>"><?php echo esc_html( $this->prod_type[$key] ); ?></a></li>
                                        <?php
                                        }
                                    }
                                ?>
                            </ul>
                        
                        </div>
                    <?php endif; ?>

                    <div class="sparkletablinkscontent">
                        <div class="tabscontentwrap">
                            <div class="sparkletabproductarea">
                                <?php 
                                $count = 1;
                                if( $product_types )
                                foreach ($product_types as $key => $val) : ?>
                                    <ul id="<?php echo esc_attr($key); ?>" class="storeproductlist tabsproduct tab-content <?php echo esc_attr($key); ?> gird-<?php echo esc_attr( $column_number ); ?> <?php if($layout == 'slider'){ echo esc_attr('storeslider owl-carousel'); } ?>" data-column="<?php echo esc_attr( $column_number ); ?>" data-style="<?php echo esc_attr( $layout ); ?>" <?php if( $count != 1): ?> style="display:none" <?php endif; ?>>
                                        <?php $count++;
                                            $query = new WP_Query($this->getQuery($key, $product_number));

                                            if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                        ?>
                                            <?php wc_get_template_part( 'content', 'product' ); ?>

                                        <?php } } wp_reset_postdata(); ?>
                                    </ul>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>        
            <?php 
                $bottom_seprator = empty( $instance['sparklestore_pro_bottom_seprator']) ? '' : $instance['sparklestore_pro_bottom_seprator'];
                sparklestore_pro_add_bottom_seperator($bottom_seprator); 
            ?>  
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