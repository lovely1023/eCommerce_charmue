<?php
/**
 * Adds sparklestore_pro_offer_deal_widget widget.
*/
add_action('widgets_init', 'sparklestore_pro_offer_deal_widget');
function sparklestore_pro_offer_deal_widget() {
    register_widget('sparklestore_pro_offer_deal_widget_area');
}

class sparklestore_pro_offer_deal_widget_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    */
    public function __construct() {
        parent::__construct(
            'sparklestore_pro_offer_deal_widget_area', esc_html__('&#9733; Hot Single Deal Product','sparklestore-pro'), array(
            'description' => __('A widget display single special offer product.', 'sparklestore-pro')
        ));
    }

    private function widget_fields() {

        $params = array(
            'post_type'      => 'product',
            'posts_per_page' => 5,
            'meta_query'     => array(
                    array(
                        'key'           => '_sale_price_dates_to',
                        'value'         => 0,
                        'compare'       => '>',
                        'type'          => 'numeric'
                    )
                )
        );

        $all_product = get_posts( $params );
        $offter_deal = array();
        // $offter_deal[''] = esc_html__('Special Offter Product','sparklestore-pro');
        foreach ($all_product as $key => $value) {
            $offter_deal[$value->ID] = $value->post_title;
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
            

            'sparklestore_pro_offer_deal_product' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_offer_deal_product',
                'sparklestore_pro_widgets_title' => esc_html__('Select Special Offer Product', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'multicheckbox',
                'sparklestore_pro_widgets_field_options' => $offter_deal
            ),

            'sparklestore_pro_offer_deal_product_layout' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_offer_deal_product_layout',
                'sparklestore_pro_widgets_title' => esc_html__('Display View Style', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'List',
                'sparklestore_pro_widgets_field_options' => array(                    
                    'slider' => esc_html__('Slider View','sparklestore-pro'),
                    'List' => esc_html__('List View','sparklestore-pro')
                )
            ),

            'sparklestore_pro_display_style' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_display_style',
                'sparklestore_pro_widgets_title' => __('Hot Product Style', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'product-style-2',
                'sparklestore_pro_widgets_field_options' => array(
                    'product-style-1' => esc_html__('Product Style 1', 'sparklestore-pro'),
                    'product-style-2' => esc_html__('Product Style 2', 'sparklestore-pro'),
                    'product-style-3' => esc_html__('Product Style 3', 'sparklestore-pro'),
                )
            ),

            'sparklestore_pro_block_position' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_block_position',
                'sparklestore_pro_widgets_title' => __('Product Image Alignment', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'left',
                'sparklestore_pro_widgets_field_options' => array(
                    'left' => esc_html__('Left', 'sparklestore-pro'),
                    'right' => esc_html__('Right', 'sparklestore-pro'),
                )
            ),

            // 'sparklestore_pro_timer_layout_style' => array(
            //     'sparklestore_pro_widgets_name' => 'sparklestore_pro_timer_layout_style',
            //     'sparklestore_pro_widgets_title' => __('Timer Layout', 'sparklestore-pro'),
            //     'sparklestore_pro_widgets_field_type' => 'select',
            //     'sparklestore_pro_widgets_default' => 'cl-col6',
            //     'sparklestore_pro_widgets_field_options' => array(
            //         'style-1' => esc_html__('Style 1', 'sparklestore-pro'),
            //         'style-2' => esc_html__('Style 2', 'sparklestore-pro'),
            //         'style-3' => esc_html__('Style 3', 'sparklestore-pro'),
            //     )
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

            'sparklestore_pro_timer_bg_color' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_timer_bg_color',
                'sparklestore_pro_widgets_title' => __('Timer BG Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'alpha-color',
                'sparklestore_pro_widgets_default' => '#f33c3c',
                'sparklestore_pro_widgets_class' => 'cl-col6'
            ),
            'sparklestore_pro_timer_color' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_timer_color',
                'sparklestore_pro_widgets_title' => __('Timer Color', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'color',
                'sparklestore_pro_widgets_default' => '#fff',
                'sparklestore_pro_widgets_class' => 'cl-col6'
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

        $offer_deal         = empty( $instance['sparklestore_pro_offer_deal_product'] ) ? '' : $instance['sparklestore_pro_offer_deal_product'];
        $alignment_image    = empty( $instance['sparklestore_pro_block_position'] ) ? '' : $instance['sparklestore_pro_block_position'];
        $display_style      =   empty( $instance['sparklestore_pro_display_style'] ) ? 'product-style-2' : $instance['sparklestore_pro_display_style'];
        $layout             = empty( $instance['sparklestore_pro_offer_deal_product_layout'] ) ? '' : $instance['sparklestore_pro_offer_deal_product_layout'];
        $timer_bg             = empty( $instance['sparklestore_pro_timer_bg_color'] ) ? '' : $instance['sparklestore_pro_timer_bg_color'];
        $timer_color             = empty( $instance['sparklestore_pro_timer_color'] ) ? '' : $instance['sparklestore_pro_timer_color'];
       
        //$timer_style   = empty( $instance['sparklestore_pro_timer_layout_style'] ) ? 'style-1' : $instance['sparklestore_pro_timer_layout_style'];
        $single_hot_product = array();
        if( is_array( $offer_deal ) ){
            $single_hot_product = array_keys( $offer_deal );
        }
        $product_args = array(
            'post_type'  => 'product',
            'post__in'  => $single_hot_product
        );

        $wrap_class [] = 'image-alignment-'.$alignment_image;
        //$wrap_class [] = 'timer-'.$timer_style;
        $wrap_class [] = 'display-'.$display_style;

        echo $before_widget;
        
    if(!empty($offer_deal)){
        $id = wp_generate_uuid4(  );


        $extra_style = "
            #section-{$id} .specialoffter-deal .pcountdown-cnt ul li{
                background-color: $timer_bg;
            }
            #section-{$id} .specialoffter-deal .pcountdown-cnt ul li > div {
                border-bottom: 1px solid $timer_color;
                color: $timer_color;
            }
        ";



        sparkle_themes_widget_dynamic_style($instance, '#section-'.$id, $extra_style);
    ?>
        <div class="speicla-wrap section-wrap <?php echo esc_attr( $layout ); ?> <?php echo implode(" ", $wrap_class); ?>" id="section-<?php echo $id; ?>">
            <div class="container">
                <div class="specialoffter-deal section-content">

                    
                    <?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>
                    

                    <div class="single-product-offer-wrap <?php if( $layout == 'slider' ) echo 'storeslider owl-carousel'; ?>" data-column="1" >  
                    <?php
                        $query = new WP_Query( $product_args );
                        $count = 0;
                        if( $query->have_posts() ) { while( $query->have_posts() ) { $query->the_post();
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full');
                    ?>
                    
                        <div class="product offerproduct-wrapper singlecount-<?php echo intval( $query->post_count ); ?>" <?php if( $display_style == "product-style-2" ){ ?> style="background-image: url(<?php echo esc_url( $image[0] ); ?>); background-size: cover; background-position: center;"<?php } ?>>
                            <?php if( $display_style != "product-style-2" ){  ?>
                                <div class="offerproduct-inner-wrap">
                                    <div class="offerproduct-images">
                                        <a href="<?php the_permalink(); ?>" class="store_product_item_link">
                                            <?php the_post_thumbnail('full'); #Products Thumbnail ?>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php
                                $product_id = get_the_ID();
                                $sale_price_dates_to    = ( $date = get_post_meta( $product_id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
                                $price_sale = get_post_meta( $product_id, '_sale_price', true );
                                $date = date_create($sale_price_dates_to);
                                $new_date = date_format($date,"Y/m/d H:i");
                                
                                if(!empty( $sale_price_dates_to ) ) { if(!empty( $price_sale) ) {
                            ?>
                                 <?php if( $display_style == "product-style-1" ){  ?>
                                    <div class="pcountdown-cnt">
                                        <ul class="countdown countdown_<?php echo intval( $product_id ); ?>">
                                            <li><div class="time-clock"><i class="fa fa-clock"></i></div></li>
                                            <li><div class="time-days"><span class="days">00</span><span class="days_text"><?php esc_html_e('Days','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-hours"><span class="hours">00</span><span class="hours_text"><?php esc_html_e('Hours','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-minutes"><span class="minutes">00</span><span class="minutes_text"><?php esc_html_e('Mins','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-seconds"><span class="seconds">00</span><span class="seconds_text"><?php esc_html_e('Secs','sparklestore-pro'); ?></span></div></li>
                                        </ul>
                                    </div>
                                 <?php } ?>
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
                    
                            <div class="offerproduct-infowrap">
                                
                                <div class="blockitem-title">
                                    <?php
                                        global $product;
                                        
                                        $term = wp_get_post_terms( $product->get_id(),'product_cat',array( 'fields'=>'ids' ) );
                                        if(!empty( $term[0] )) {
                                            $procut_cat = get_term_by( 'id', $term[0], 'product_cat' );
                                            $category_link = get_term_link( $term[0], 'product_cat' );
                                        }
                                        
                                    ?>
                                    <span class="mini-title">
                                        <a href="<?php esc_url( $category_link ); ?>">
                                            <?php  echo esc_attr( $procut_cat->name ); ?>
                                        </a>
                                    </span>
                                    <h3>
                                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                </div>

                               
                                <?php if( $display_style == "product-style-2" ){  ?>
                                    
                                    <div class="offerwrap">
                                        <?php woocommerce_template_loop_price(); ?>
                                    </div>
                                    
                                    <div class="pcountdown-cnt">
                                        <ul class="countdown_<?php echo intval( $product_id ); ?> clearfix">
                                            <li><div class="time-days"><span class="days">00</span><span class="time"><?php esc_html_e('Days','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-hours"><span class="hours">00</span><span class="time"><?php esc_html_e('Hours','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-minutes"><span class="minutes">00</span><span class="time"><?php esc_html_e('Mins','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-seconds"><span class="seconds">00</span><span class="time"><?php esc_html_e('Secs','sparklestore-pro'); ?></span></div></li>
                                        </ul>
                                    </div>
                                <?php }elseif( $display_style == "product-style-3" ){ ?>

                                    <div class="pcountdown-cnt">
                                        <ul class="countdown_<?php echo intval( $product_id ); ?> clearfix">
                                            <li><div class="time-days"><span class="days">00</span><span class="time"><?php esc_html_e('Days','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-hours"><span class="hours">00</span><span class="time"><?php esc_html_e('Hours','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-minutes"><span class="minutes">00</span><span class="time"><?php esc_html_e('Mins','sparklestore-pro'); ?></span></div></li>
                                            <li><div class="time-seconds"><span class="seconds">00</span><span class="time"><?php esc_html_e('Secs','sparklestore-pro'); ?></span></div></li>
                                        </ul>
                                    </div>

                                    <div class="offer-deal">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <div class="offerwrap">
                                        <?php woocommerce_template_loop_price(); ?>
                                    </div>

                                <?php }else{ ?>

                                    <div class="offer-deal">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <div class="offerwrap">
                                        <?php woocommerce_template_loop_price(); ?>
                                    </div>

                                <?php } ?>

                                <div class="productbutton-wrap clearfix">
                                    <?php woocommerce_template_loop_add_to_cart(); ?>
                                    <a class="villa-details add_to_cart_button button" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                        <?php esc_html_e('View Details','sparklestore-pro'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        

                    <?php $count++; } } wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>

            <?php 
                $bottom_seprator = empty( $instance['sparklestore_pro_bottom_seprator']) ? '' : $instance['sparklestore_pro_bottom_seprator'];
                sparklestore_pro_add_bottom_seperator($bottom_seprator); 
            ?>  
        </div>

    <?php }
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