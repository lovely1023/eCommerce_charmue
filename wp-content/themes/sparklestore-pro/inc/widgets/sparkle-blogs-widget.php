<?php
/**
 ** Adds sparklestore_pro_blog_widget widget.
*/
add_action('widgets_init', 'sparklestore_pro_blog_widget');
function sparklestore_pro_blog_widget() {
    register_widget('sparklestore_pro_blog_widget_area');
}

class sparklestore_pro_blog_widget_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'sparklestore_pro_blog_widget_area', esc_html__('&bull; Blog Posts','sparklestore-pro'), array(
            'description' => esc_html__('A widget display selected category posts', 'sparklestore-pro')
        ));
    }

    private function widget_fields() {

        $args = array(
          'type'       => 'post',
          'child_of'   => 0,
          'orderby'    => 'name',
          'order'      => 'ASC',
          'hide_empty' => 1,
          'taxonomy'   => 'category',
        );
        $categories = get_categories( $args );
        $cat_lists = array();
        foreach( $categories as $category ) {
            $cat_lists[$category->term_id] = $category->name;
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

            'blogs_category_list' => array(
              'sparklestore_pro_widgets_name' => 'blogs_category_list',
              'sparklestore_pro_widgets_title' => esc_html__('Category', 'sparklestore-pro'),
              'sparklestore_pro_widgets_field_type' => 'multiselect',
              'sparklestore_pro_widgets_field_options' => $cat_lists
            ),

            'sparklestore_pro_blog_display_style' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_blog_display_style',
                'sparklestore_pro_widgets_title' => esc_html__('Display Style', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 'masonry',
                'sparklestore_pro_widgets_field_options' => array(
                    'slide' => esc_html__('Slide', 'sparklestore-pro'),
                    'normal' => esc_html__('Grid', 'sparklestore-pro'),
                    'masonry' => esc_html__('Masonry', 'sparklestore-pro'),
                )
            ),

            'sparklestore_pro_blog_column' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_blog_column',
                'sparklestore_pro_widgets_title' => esc_html__('Column', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'select',
                'sparklestore_pro_widgets_default' => 3,
                'sparklestore_pro_widgets_field_options' => array(
                    1 => esc_html__('1 Column', 'sparklestore-pro'),
                    2 => esc_html__('2 Column', 'sparklestore-pro'),
                    3 => esc_html__('3 Column', 'sparklestore-pro'),
                    4 => esc_html__('4 Column', 'sparklestore-pro'),
                )
            ),

            'sparklestore_pro_number_blogs_posts' => array(
                'sparklestore_pro_widgets_name' => 'sparklestore_pro_number_blogs_posts',
                'sparklestore_pro_widgets_title' => esc_html__('Numebr of Posts', 'sparklestore-pro'),
                'sparklestore_pro_widgets_field_type' => 'number',
                'sparklestore_pro_widgets_default' => 6
            ),

            'content_close' => array(
                'sparklestore_pro_widgets_field_type' => 'close'
            ),

            // style tab start from here
            'style_open' => array(
                'sparklestore_pro_widgets_class' => 'cl-widget-tab-content cl-flex-wrap',
                'sparklestore_pro_widgets_data_id' => 'cl-style',
                'sparklestore_pro_widgets_field_type' => 'open'
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
         ** wp query for first block
        */
        



        $title           = empty( $instance['sparklestore_pro_title'] ) ? '' : $instance['sparklestore_pro_title'];
        $sub_title       = empty( $instance['sparklestore_pro_short_desc'] ) ? '' : $instance['sparklestore_pro_short_desc'];
        $titlestyle      = empty( $instance['sparklestore_pro_title_style'] ) ? '' : $instance['sparklestore_pro_title_style'];

        $blogs_category_list    = empty( $instance['blogs_category_list'] ) ? '' : $instance['blogs_category_list'];
        $shot_desc              = empty( $instance['sparklestore_pro_blogs_short_desc'] ) ? '' : $instance['sparklestore_pro_blogs_short_desc'];
        $number_blogs_posts     = empty( $instance['sparklestore_pro_number_blogs_posts'] ) ? '' : $instance['sparklestore_pro_number_blogs_posts'];
        $blogs_style            = empty( $instance['sparklestore_pro_blog_display_style'] ) ? '' : $instance['sparklestore_pro_blog_display_style'];
        
        $blogscol     = empty( $instance['sparklestore_pro_blog_column'] ) ? 3 : $instance['sparklestore_pro_blog_column'];
        
        $blogs_cat_id = array();
        
        if(!empty($blogs_category_list)){
            $blogs_cat_id = $blogs_category_list;
        }

        $blogs_posts = new WP_Query( array(
            'posts_per_page'      => $number_blogs_posts,
            'post_type'           => 'post',
            'category__in'        => $blogs_cat_id,
            'ignore_sticky_posts' => true
        ));

        echo $before_widget;

        
       $id = wp_generate_uuid4(  );
       sparkle_themes_widget_dynamic_style($instance, '#section-'.$id);

    ?>
        <div id="section-<?php echo $id; ?>" class="sparklestore-blogwrap section-wrap <?php echo esc_attr( $blogs_style ); ?>" data-layout="<?php echo esc_attr( $blogs_style  ); ?><?php echo intval($blogscol); ?>">
            <div class="container">
                
                <?php sparklestore_pro_section_title($title, $sub_title, $titlestyle ) ?>

                <ul class="store_blog_wrap blogwrap<?php echo esc_attr( $blogscol ); ?> <?php if($blogs_style == 'slide'){ echo esc_attr('storeslider owl-carousel'); }elseif($blogs_style == 'normal'){ echo esc_attr('blogspostlist'); }else{ echo esc_attr('sparklestore-masonry');  } ?>" data-column="<?php echo esc_attr( $blogscol ); ?>" data-style="<?php echo esc_attr( $blogs_style ); ?>">
                    <?php
                        if( $blogs_posts->have_posts() ) : while( $blogs_posts->have_posts() ) : $blogs_posts->the_post();
                        $postformat = get_post_format();
                        $blogreadmore_btn = get_theme_mod( 'sparklestore_blogtemplate_btn', 'Read More' );
                    ?>
                        <li class="articlesListing blog-grid">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?> itemtype="http://schema.org/BlogPosting" itemtype="http://schema.org/BlogPosting">

                                <?php
                                    sparklestore_post_format_media( $postformat );
                                ?>

                                <div class="box text-center">

                                    <?php 

                                        the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); 

                                        if ( 'post' === get_post_type() ){ do_action( 'sparklestore_post_meta', 10 ); } 
                                    ?>
                                    
                                    <div class="entry-content">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <div class="site-button">
                                        <a class="btn btn-primary" href="<?php the_permalink(); ?>">
                                            <?php echo esc_html( $blogreadmore_btn ); ?>
                                        </a>
                                    </div>
                                    
                                </div>

                            </article><!-- #post-<?php the_ID(); ?> -->
                            <?php //get_template_part('template-parts/content', get_post_format()); ?>
                        </li>
                    <?php endwhile; endif; wp_reset_postdata(); ?>
                </ul>
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

        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            $instance[$sparklestore_pro_widgets_name] = sparklestore_pro_widgets_updated_field_value($widget_field, $new_instance[$sparklestore_pro_widgets_name]);
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
