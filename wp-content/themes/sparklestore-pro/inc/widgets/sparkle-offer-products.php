<?php
/**
 ** Adds sparklestore_pro_specialdeal_product_slide_widget widget.
*/
add_action('widgets_init', 'sparklestore_pro_specialdeal_product_slide_widget');
function sparklestore_pro_specialdeal_product_slide_widget() {
    register_widget('sparklestore_pro_specialdeal_product_slide_widget_area');
}
class sparklestore_pro_specialdeal_product_slide_widget_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'sparklestore_pro_specialdeal_product_slide_widget_area', esc_html__('&#9733; Hot Offer Products List','sparklestore-pro'), array(
            'description' => esc_html__('A widget display multiple special offer products with expiry date.', 'sparklestore-pro')
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

            'sparklestore_pro_offer_product_layout' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_offer_product_layout',
                'sparklestore_pro_widgets_title' => esc_html__('Offer Product Style', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'offer-style-2',
                'sparklestore_pro_widgets_field_options' => array(
                    'offer-style-1' => __('Offer Style One', 'sparklestore-pro'),
                    'offer-style-2' => __('Offer Style Two', 'sparklestore-pro'),
                    'offer-style-3' => __('Offer Style Three', 'sparklestore-pro'),
                    // 'offer-style-4' => __('Offer Style Four', 'sparklestore-pro'),
                )
            ),

            'sparklestore_pro_offer_text' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_offer_text',
                'sparklestore_pro_widgets_title' => esc_html__('Offer Text', 'sparklestore-pro'),
                'sparklestore_pro_widgets_description' => esc_html__('This text only works for style four', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'textarea',
                'sparklestore_pro_widgets_default' => '<span class="color-primary">Hurry up!</span> Offers end in',
            ),

            'sparklestore_pro_product_offer_column' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_product_offer_column',
                'sparklestore_pro_widgets_title' => esc_html__('Select Column', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 4,
                'sparklestore_pro_widgets_field_options' => array(   
                    1 => esc_html__('1 Column','sparklestore-pro'),                 
                    2 => esc_html__('2 Column','sparklestore-pro'),
                    3 => esc_html__('3 Column','sparklestore-pro'),
                    4 => esc_html__('4 Column','sparklestore-pro'),
                    5 => esc_html__('5 Column','sparklestore-pro'),
                    6 => esc_html__('6 Column','sparklestore-pro')                    
                )
            ),

            'sparklestore_pro_product_offer_layout' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_product_offer_layout',
                'sparklestore_pro_widgets_title' => esc_html__('View Style', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'grid',
                'sparklestore_pro_widgets_field_options' => array(                    
                    'slider' => esc_html__('Slider','sparklestore-pro'),
                    'grid' => esc_html__('Grid','sparklestore-pro')
                )
            ),

            'sparklestore_pro_offer_product_category' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_offer_product_category',
                'sparklestore_pro_widgets_title' => esc_html__('Select Special Offer Category', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'multiselect',
                'sparklestore_pro_widgets_field_options' => $woocommerce_categories
            ),

            'sparklestore_pro_offer_product_number' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_offer_product_number',
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

        $offer_category   = empty( $instance['sparklestore_pro_offer_product_category'] ) ? '' : $instance['sparklestore_pro_offer_product_category'];
        $product_number   = empty( $instance['sparklestore_pro_offer_product_number'] ) ? 8 : $instance['sparklestore_pro_offer_product_number'];
        
        $column_number    = empty( $instance['sparklestore_pro_product_offer_column'] ) ? 4 : $instance['sparklestore_pro_product_offer_column'];
        $layout           = empty( $instance['sparklestore_pro_product_offer_layout'] ) ? '' : $instance['sparklestore_pro_product_offer_layout'];
        $product_layout   = empty( $instance['sparklestore_pro_offer_product_layout'] ) ? '' : $instance['sparklestore_pro_offer_product_layout'];
        $offer_text   = empty( $instance['sparklestore_pro_offer_text'] ) ? '' : $instance['sparklestore_pro_offer_text'];


        // if(!empty($offer_category)){
        //     $categories_id = array();
        //     foreach ($offer_category as $key => $value) {
        //         $categories_id[$key] = $key;
        //     }
        // }else{
        //     $categories_id ='';
        // }

        $product_args = array(
            'post_type' => 'product',
            'tax_query' => array(
                array('taxonomy'  => 'product_cat',
                    'field'     => 'term_id',
                    'terms'     => $offer_category,
                )
            ),
            'meta_query'     => array(
                array(
                    'key'           => '_sale_price_dates_to',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                )
            ),
            'posts_per_page' => $product_number
        );

        echo $before_widget;

        sparkle_themes_widget_dynamic_style($instance, '.product-deals');
        
        $css = array();
        $css[] = 'producttype-wrap product-deals section-wrap';
        $css[] = 'product-hover-'.get_theme_mod('sparklestore_pro_woo_product_hover_style', 'style1'); 
        $css[] = esc_attr( $layout );   
        $css[] = esc_attr( $product_layout );
    ?>

        <div class="<?php echo implode(' ', $css); ?>">
            <div class="container">

                <div class="product-list-area section-content">

                    
                    <?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>    

                    <ul class="storeproductlist gird-<?php echo esc_attr( $column_number ); ?> <?php if($layout == 'slider'){ echo esc_attr('storeslider owl-carousel'); } ?>" data-column="<?php echo esc_attr( $column_number ); ?>" data-style="<?php echo esc_attr( $layout ); ?>">
                        <?php
                            $query = new WP_Query( $product_args );

                            if($query->have_posts()) {  while( $query->have_posts() ) { $query->the_post();
                        ?>
                            <li <?php post_class(); ?>>
                                <?php
                                    /**
                                     * woocommerce_before_shop_loop_item hook.
                                     *
                                     * @hooked woocommerce_template_loop_product_link_open - 10
                                     */
                                    do_action( 'woocommerce_before_shop_loop_item' );

                                    /**
                                     * woocommerce_before_shop_loop_item_title hook.
                                     *
                                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                                     */
                                    do_action( 'woocommerce_before_shop_loop_item_title' );
                                ?>
                                <?php
                                    $product_id = get_the_ID();
                                    $sale_price_dates_to    = ( $date = get_post_meta( $product_id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
                                    $price_sale = get_post_meta( $product_id, '_sale_price', true );
                                    $date = date_create($sale_price_dates_to);
                                    $new_date = date_format($date,"Y/m/d H:i");

                                    if(!empty( $sale_price_dates_to ) ) { if(!empty( $price_sale) ) {
                                ?>
                                    <div class="pcountdown-cnt-list-slider">
                                        <?php if( $product_layout != "offer-style-2" ){ ?>
                                            <?php if( $offer_text):
                                                echo wp_kses_post(wpautop($offer_text));
                                            endif; ?>
                                            
                                        <?php } ?>
                                        <ul class="countdown_<?php echo intval( $product_id ); ?> clearfix">
                                            <li><div class="time-days"><span class="days">00</span><span class="time"><?php esc_html_e('Days','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-hours"><span class="hours">00</span><span class="time"><?php esc_html_e('Hours','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-minutes"><span class="minutes">00</span><span class="time"><?php esc_html_e('Mins','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-seconds"><span class="seconds">00</span><span class="time"><?php esc_html_e('Secs','sparklestore-pro'); ?></span></div></li>
                                        </ul>
                                    </div>
                                    <script type="text/javascript">
                                        jQuery(document).ready(function($) {
                                            jQuery(".countdown_<?php echo intval( $product_id ); ?>").countdown({
                                                date: "<?php echo esc_attr( $new_date ); ?>",
                                                offset: -8,
                                                day: "Day",
                                                days: "Days"
                                            }, function () {
                                            //  alert("Done!");
                                            });
                                        });
                                    </script>
                                <?php } } ?>
                                <?php
                                    /**
                                     * woocommerce_shop_loop_item_title hook.
                                     *
                                     * @hooked woocommerce_template_loop_product_title - 10
                                     */
                                    do_action( 'woocommerce_shop_loop_item_title' );

                                    /**
                                     * woocommerce_after_shop_loop_item_title hook.
                                     *
                                     * @hooked woocommerce_template_loop_rating - 5
                                     * @hooked woocommerce_template_loop_price - 10
                                     */
                                    do_action( 'woocommerce_after_shop_loop_item_title' );

                                    /**
                                     * woocommerce_after_shop_loop_item hook.
                                     *
                                     * @hooked woocommerce_template_loop_product_link_close - 5
                                     * @hooked woocommerce_template_loop_add_to_cart - 10
                                     */
                                    do_action( 'woocommerce_after_shop_loop_item' );
                                ?>
                            </li>

                        <?php } } wp_reset_postdata(); ?>
                    </ul>
                </div>
            </div>

            <?php 
                $bottom_seprator = empty( $instance['sparklestore_pro_bottom_seprator']) ? '' : $instance['sparklestore_pro_bottom_seprator'];
                sparklestore_pro_add_bottom_seperator($bottom_seprator); 
            ?>  
        </div><!-- End Product Slider -->

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