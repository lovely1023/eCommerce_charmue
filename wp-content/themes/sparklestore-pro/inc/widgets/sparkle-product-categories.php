<?php
/**
 * Adds sparklestore_pro_cat_widget widget.
*/
add_action('widgets_init', 'sparklestore_pro_cat_widget');
function sparklestore_pro_cat_widget() {
    register_widget('sparklestore_pro_cat_widget_area');
}

class sparklestore_pro_cat_widget_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'sparklestore_pro_cat_widget_area', esc_html__('&#9733; Product Categories','sparklestore-pro'), array(
            'description' => esc_html__('A widget display features image of product categories.', 'sparklestore-pro')
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
        $woocommerce_categories_obj = get_categories( $args );
        foreach( $woocommerce_categories_obj as $category ) {
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
            
           'sparklestore_pro_category_layout' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_category_layout',
                'sparklestore_pro_widgets_title' => esc_html__('Category Style', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'category-style-2',
                'sparklestore_pro_widgets_field_options' => array(
                    'category-style-1' => __('Category Style One', 'sparklestore-pro'),
                    'category-style-2' => __('Category Style Two', 'sparklestore-pro'),
                    'category-style-3' => __('Category Style Three', 'sparklestore-pro'),
                    'category-style-4' => __('Category Style Four', 'sparklestore-pro'),
                )
            ),

            'sparklestore_pro_category_view' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_category_view',
                'sparklestore_pro_widgets_title' => esc_html__('View', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'slide',
                'sparklestore_pro_widgets_field_options' => array(
                    'grid' => __('Grid', 'sparklestore-pro'),
                    'slider' => __('Slider', 'sparklestore-pro')
                )
            ),
            

            'sparklestore_pro_display_column' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_display_column',
                'sparklestore_pro_widgets_title' => esc_html__('Column', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => '3',
                'sparklestore_pro_widgets_field_options' => array(
                    '1' => __('1 Column', 'sparklestore-pro'),
                    '2' => __('2 Column', 'sparklestore-pro'),
                    '3' => __('3 Column', 'sparklestore-pro'),
                    '4' => __('4 Column', 'sparklestore-pro'),
                    '5' => __('5 Column', 'sparklestore-pro'),
                    '6' => __('6 Column', 'sparklestore-pro')
                )
            ),

            'sparklestore_pro_select_category' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_select_category',
                'sparklestore_pro_widgets_title' => esc_html__('Select Multiple Categories', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'multiselect',
                'sparklestore_pro_widgets_field_options' => $woocommerce_categories
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
        ** wp query for first block
        **/  
        $title           = empty( $instance['sparklestore_pro_title'] ) ? '' : $instance['sparklestore_pro_title'];
        $sub_title       = empty( $instance['sparklestore_pro_short_desc'] ) ? '' : $instance['sparklestore_pro_short_desc'];
        $titlestyle      = empty( $instance['sparklestore_pro_title_style'] ) ? '' : $instance['sparklestore_pro_title_style'];

        $sparklestore_pro_cat_id = empty( $instance['sparklestore_pro_select_category'] ) ? '' : $instance['sparklestore_pro_select_category'];
        
        $layout         = empty( $instance['sparklestore_pro_category_view'] ) ? '' : $instance['sparklestore_pro_category_view'];
        $column_number  = empty( $instance['sparklestore_pro_display_column'] ) ? '' : $instance['sparklestore_pro_display_column'];
       
        $view_style     = empty( $instance['sparklestore_pro_category_layout'] ) ? '' : $instance['sparklestore_pro_category_layout'];

        echo $before_widget;  

        $id = wp_generate_uuid4(  );
        sparkle_themes_widget_dynamic_style($instance, '#section-'.$id);

        
    ?>
        <div class="categoryarea section-wrap <?php echo esc_attr( $layout ); ?>" id="section-<?php echo $id; ?>">
            <div class="container">               
                <div class="section-content">                    
                    <?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>

                    <ul class="storeproductlist gird-<?php echo esc_attr( $column_number ); ?> <?php if($layout == 'slider'){ echo esc_attr('storeslider owl-carousel'); } ?>" data-column="<?php echo esc_attr( $column_number ); ?>" data-style="<?php echo esc_attr( $layout ); ?>">
                        <?php
                            $count = 0; 
                            if(!empty( $sparklestore_pro_cat_id ) ){
                                
                                foreach ($sparklestore_pro_cat_id as $key ) {          
                                    $thumbnail_id = get_term_meta( $key, 'thumbnail_id', true );
                                    if($thumbnail_id){
                                        //$images = wp_get_attachment_url( $thumbnail_id );
                                        $image = wp_get_attachment_image_src($thumbnail_id, 'woocommerce_thumbnail', true);
                                    }else {
                                        $image[0] = get_store_default_image();
                                    }
                                    $term = get_term_by( 'id', $key, 'product_cat');
                                    if( !$term ) continue;
                                    $term_link = get_term_link($term);
                                    $term_name = $term->name;
                                    $sub_count =  apply_filters( 'woocommerce_subcategory_count_html', ' ' . $term->count . ' '.esc_html__('Products','sparklestore-pro').'', $term);
                                
                        ?>
                            <li class="product-category product <?php echo esc_attr( $view_style ); ?>">
                                <div class="product-wrapper">
                                    <a href="<?php echo esc_url($term_link); ?>">
                                        <div class="products-cat-wrap">
                                            <div class="products-cat-image">    
                                                <?php echo '<img class="categoryimage" src="' . esc_url( $image[0] ) . '" />'; ?>
                                            </div>
                                            <div class="products-cat-info">
                                                <h3 class="woocommerce-loop-category__title">
                                                    <?php echo esc_html($term_name); ?>
                                                    <span class="count"><?php echo esc_html( $sub_count );  ?></span>
                                                </h3>
                                            </div>
                                            <?php if( !empty( $view_style ) && $view_style == 'category-style-3' ){ ?>
                                                <ul class="product-sub-cat">
                                                    <?php 
                                                        $parent_id = $key;
                                                        $termchildrens = get_terms('product_cat',array('child_of' => $parent_id));

                                                        foreach( $termchildrens as $termchildren ){

                                                            $termchild_link = get_term_link( $termchildren );
                                                    ?>
                                                        <li><a href="<?php echo esc_url( $termchild_link ); ?>"><?php echo esc_html( $termchildren->name ); ?></a></li>
                                                    
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </div>
                                    </a>            
                                </div>         
                            </li>
                        <?php } }  ?>
                    </ul>
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