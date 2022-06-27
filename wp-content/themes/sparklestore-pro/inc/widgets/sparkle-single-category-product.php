<?php
/**
 ** Adds sparklestore_pro_cat_with_product_widget widget.
**/
add_action('widgets_init', 'sparklestore_pro_cat_with_product_widget');
function sparklestore_pro_cat_with_product_widget() {
    register_widget('sparklestore_pro_cat_with_product_widget_area');
}
class sparklestore_pro_cat_with_product_widget_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'sparklestore_pro_cat_with_product_widget_area', esc_html__('&#9733; Single Category & Products','sparklestore-pro'), array(
            'description' => esc_html__('A widget single category features image with selected category products', 'sparklestore-pro')
        ));
    }
    
    private function widget_fields() {
        
        $prod_type = array(
            'rightalign' => esc_html__('Right Align Category Image', 'sparklestore-pro'),
            'leftalign' => esc_html__('Left Align Category Image', 'sparklestore-pro'),
        );

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

            'sparklestore_pro_cat_image_aligment' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_cat_image_aligment',
                'sparklestore_pro_widgets_title' => esc_html__('Select Style (Image Alignment)', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_field_options' => $prod_type
            ),
            'sparklestore_pro_woo_category' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_woo_category',
                'sparklestore_pro_widgets_title' => esc_html__('Select Category', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_field_options' => $woocommerce_categories
            ),

            // 'sparklestore_pro_product_list_number' => array(
            //     'sparklestore_pro_widgets_name' => 'sparklestore_pro_product_list_number',
            //     'sparklestore_pro_widgets_title' => esc_html__('Number of Products', 'sparklestore-pro'),
            //     'sparklestore_pro_widgets_field_type' => 'number',
            //     'sparklestore_pro_widgets_default' => 3,
            // ),
            
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
        extract($instance);
        /**
         * wp query for first block
        */  
        $title           = empty( $instance['sparklestore_pro_title'] ) ? '' : $instance['sparklestore_pro_title'];
        $sub_title       = empty( $instance['sparklestore_pro_short_desc'] ) ? '' : $instance['sparklestore_pro_short_desc'];
        $titlestyle      = empty( $instance['sparklestore_pro_title_style'] ) ? '' : $instance['sparklestore_pro_title_style'];

        $product_number   = empty( $instance['sparklestore_pro_product_list_number'] ) ? '' : $instance['sparklestore_pro_product_list_number'];
        $cat_aligment     = empty( $instance['sparklestore_pro_cat_image_aligment'] ) ? 'rightalign' : $instance['sparklestore_pro_cat_image_aligment'];
        $product_category = empty( $instance['sparklestore_pro_woo_category'] ) ? '' : $instance['sparklestore_pro_woo_category'];
        
        $category_link = get_permalink( wc_get_page_id( 'shop' ) );

        if( !empty( $product_category ) ){
          $cat_id = get_term($product_category, 'product_cat');
          if( $cat_id ){
            $category_id = $cat_id->term_id;
            $category_link = get_term_link( $category_id,'product_cat' );
          }
        } 

        echo $before_widget; 
        $id = wp_generate_uuid4(  );
        sparkle_themes_widget_dynamic_style($instance, '#section-'.$id);

    ?> 
        <div class="categorproducts section-wrap grid <?php echo esc_attr( $cat_aligment ); ?>" id="section-<?php echo $id; ?>">
            <div class="container">                
                <div class="section-content">
                    
                    <?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>
                    
                    <?php if( !empty($product_category)): ?>
                        <div class="categorproducts-inner">
                            <div class="homeblockinner"> 
                                <?php 
                                    $taxonomy = 'product_cat';                                
                                    $terms = term_description( $product_category, $taxonomy );
                                    $terms_name = get_term( $product_category, $taxonomy );
                                    $image[0] = get_store_default_image();
                                    if( $terms_name ){
                                        $thumbnail_id = get_term_meta( $terms_name->term_id, 'thumbnail_id', true );
                                        if($thumbnail_id){
                                            $image = wp_get_attachment_image_src($thumbnail_id, 'full', true);
                                        }
                                    }
                                ?>
                                <div class="catblockwrap">
                                    <figure class="catblockimage cover-image" style="background-image: url(<?php echo esc_url( $image[0] ); ?>); height: 954px;"></figure>
                                    <div class="catblock-title-wrap">
                                        <?php if( !empty( $terms_name->name ) ) { ?>
                                            <h2><?php echo esc_html( $terms_name->name ); ?></h2>
                                        <?php } ?>
                                        <a class="btn btn-primary" href="<?php echo esc_url($category_link); ?>">
                                            <?php esc_html_e('View Collection','sparklestore-pro'); ?>
                                        </a>                   
                                    </div>
                                </div>                        
                            </div>               
                            <?php
                                $css[] = 'product-hover-'.get_theme_mod('sparklestore_pro_woo_product_hover_style', 'style1');
                            ?>
                            <div class="singlecat-product-wrap">
                                <ul class="single-catproducts grid2 <?php echo implode(' ', $css); ?>">                       
                                    <?php 
                                        $product_args = array(
                                            'post_type' => 'product',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy'  => 'product_cat',
                                                    'field'     => 'id', 
                                                    'terms'     => $product_category                                                                 
                                                )),
                                            'posts_per_page' => 3
                                        );
                                        $query = new WP_Query($product_args);

                                        if( $query->have_posts() ) { while( $query->have_posts() ) { $query->the_post();
                                    ?>
                                        <?php wc_get_template_part( 'content', 'product' ); ?>
                                        
                                    <?php } } wp_reset_postdata(); ?>                          
                                </ul>
                            </div>                    
                        </div>
                    <?php endif; ?>
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