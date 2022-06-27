<?php
/**
 * Main Custom admin functions area
 *
 * @since Sparkle Themes
 *
 * @param SparkleStore Pro
 *
 */
function sparkle_wpt_post_metabox($meta_boxes) {
    $prefix = 'sparkle_wpt_';
    $image_url = get_template_directory_uri() . '/inc/customizer/images/';

    $blog_cats = get_categories( array( 'post_type'=>'post', 'hide_empty'=>false ) );
    
    $category = array();
    foreach($blog_cats as $cat){
        $category[$cat->term_id] = $cat->name;
    }

    $meta_boxes[] = array(
        'id' => 'sparkle_wpt_post_setting',
        'title' => esc_html__('Page Setting', 'sparklestore-pro'),
        'post_types' => array('page', 'product', 'portfolio'),
        'context' => 'advanced',
        'priority' => 'high',
        'autosave' => true,
        'tabs' => array(
            'general-setting' => array(
                'label' => esc_html__('General Setting','sparklestore-pro'),
                'icon' => 'dashicons-admin-generic'
            ),
            'titlebar-setting' => array(
                'label' => esc_html__('Title Setting','sparklestore-pro'),
                'icon' => 'dashicons-editor-kitchensink'
            ),
           
            'sidebar-setting' => array(
                'label' => esc_html__('Sidebar Setting','sparklestore-pro'),
                'icon' => 'dashicons-welcome-widgets-menus'
            ),
            'blog-setting' => array(
                'label' => esc_html__('Blog Setting','sparklestore-pro'),
                'icon' => 'dashicons-welcome-widgets-menus',
                'visible' => array( 'page_template', 'template-blogpage.php' )
            )
        ),
        'tab_style' => 'left',
        'tab_wrapper' => true,
        'fields' => array(
            array(
                'name' => esc_html__('Hide Header','sparklestore-pro'),
                'id' => 'hide_header',
                'type' => 'switch',
                'style' => 'total',
                'on_label' => esc_html__('Yes','sparklestore-pro'),
                'off_label' => esc_html__('No','sparklestore-pro'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'general-setting'
            ),
            array(
                'name' => esc_html__('Hide Footer','sparklestore-pro'),
                'id' => 'hide_footer',
                'type' => 'switch',
                'style' => 'total',
                'on_label' => esc_html__('Yes','sparklestore-pro'),
                'off_label' => esc_html__('No','sparklestore-pro'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'general-setting'
            ),
            
            array(
                'name' => esc_html__('Hide Breadcumb','sparklestore-pro'),
                'label_description' => esc_html__('Hide breadcumb area','sparklestore-pro'),
                'id' => 'hide_breadcrumb',
                'type' => 'switch',
                'style' => 'total',
                'on_label' => esc_html__('Yes','sparklestore-pro'),
                'off_label' => esc_html__('No','sparklestore-pro'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('OverWrite Default Style','sparklestore-pro'),
                'label_description' => esc_html__('A set of settings will appear','sparklestore-pro'),
                'id' => 'page_overwrite_defaults',
                'type' => 'switch',
                'style' => 'total',
                'on_label' => esc_html__('Yes','sparklestore-pro'),
                'off_label' => esc_html__('No','sparklestore-pro'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Breadcrumb Background Options','sparklestore-pro'),
                'type' => 'group',
                'class' => 'background-group',
                'tab' => 'titlebar-setting',
                'id' => 'titlebar_background',
                'hidden' => array('overwrite_defaults', false),
                'fields' => array(
                    array(
                        'id' => 'titlebar_bg_color',
                        'type' => 'color'
                    ),
                    array(
                        'id' => 'titlebar_bg_image',
                        'type' => 'image_advanced',
                        'max_file_uploads' => 1,
                        'max_status' => false
                    ),
                    array(
                        'placeholder' => esc_html__('Background Repeat','sparklestore-pro'),
                        'id' => 'titlebar_bg_repeat',
                        'type' => 'select_advanced',
                        'options' => array(
                            'no-repeat' => esc_html__('No Repeat','sparklestore-pro'),
                            'repeat' => esc_html__('Repeat All','sparklestore-pro'),
                            'repeat-x' => esc_html__('Repeat Horizontally','sparklestore-pro'),
                            'repeat-y' => esc_html__('Repeat Vertically','sparklestore-pro')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Size','sparklestore-pro'),
                        'id' => 'titlebar_bg_size',
                        'type' => 'select_advanced',
                        'options' => array(
                            'inherit' => esc_html__('Inherit','sparklestore-pro'),
                            'cover' => esc_html__('Cover','sparklestore-pro'),
                            'contain' => esc_html__('Contain','sparklestore-pro')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Attachment','sparklestore-pro'),
                        'id' => 'titlebar_bg_attachment',
                        'type' => 'select_advanced',
                        'options' => array(
                            'inherit' => esc_html__('Inherit','sparklestore-pro'),
                            'fixed' => esc_html__('Fixed','sparklestore-pro'),
                            'scroll' => esc_html__('Scroll','sparklestore-pro')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Position','sparklestore-pro'),
                        'id' => 'titlebar_bg_position',
                        'type' => 'select_advanced',
                        'options' => array(
                            'left top' => esc_html__('Left Top','sparklestore-pro'),
                            'left center' => esc_html__('Left Center','sparklestore-pro'),
                            'left bottom' => esc_html__('Left Bottom','sparklestore-pro'),
                            'center top' => esc_html__('Center Top','sparklestore-pro'),
                            'center center' => esc_html__('Center Center','sparklestore-pro'),
                            'center bottom' => esc_html__('Center Bottom','sparklestore-pro'),
                            'right top' => esc_html__('Right Top','sparklestore-pro'),
                            'right center' => esc_html__('Right Center','sparklestore-pro'),
                            'right bottom' => esc_html__('Right Bottom','sparklestore-pro')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'name' => esc_html__('Overlay Background Color','sparklestore-pro'),
                        'id' => 'overlay_bg_color',
                        'type' => 'color',
                        'alpha_channel' => true,
                        'hidden' => array('titlebar_bg_image', 0)
                    ),
                    array(
                        'name' => esc_html__('Enable Parallax Effect','sparklestore-pro'),
                        'id' => 'enable_parallax_effect',
                        'type' => 'switch',
                        'style' => 'total',
                        'on_label' => esc_html__('Yes','sparklestore-pro'),
                        'off_label' => esc_html__('No','sparklestore-pro'),
                        'std' => 0,
                        'class' => '2switch no-margin',
                        'hidden' => array('titlebar_bg_image', 0)
                    )
                )
            ),
            array(
                'name' => esc_html__('Title Color','sparklestore-pro'),
                'id' => 'titlebar_color',
                'type' => 'color',
                'hidden' => array('overwrite_defaults', false),
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Text Color','sparklestore-pro'),
                'id' => 'titlebar_text_color',
                'type' => 'color',
                'hidden' => array('overwrite_defaults', false),
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Link Color','sparklestore-pro'),
                'id' => 'titlebar_link_color',
                'type' => 'color',
                'hidden' => array('overwrite_defaults', false),
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Top Bottom Padding','sparklestore-pro'),
                'id' => 'titlebar_padding',
                'type' => 'slider',
                'suffix' => ' px',
                'js_options' => array(
                    'min' => 0,
                    'max' => 200,
                    'step' => 5
                ),
                'std' => 80,
                'hidden' => array('overwrite_defaults', false),
                'tab' => 'titlebar-setting'
            ),

            array(
                'name' => esc_html__('Top Bottom Margin','sparklestore-pro'),
                'id' => 'titlebar_margin',
                'type' => 'slider',
                'suffix' => ' px',
                'js_options' => array(
                    'min' => 0,
                    'max' => 200,
                    'step' => 5
                ),
                'std' => 0,
                'hidden' => array('overwrite_defaults', false),
                'tab' => 'titlebar-setting'
            ),
           
          
            array(
                'id' => 'sidebar_layout',
                'type' => 'image_select',
                'name' => esc_html__('Sidebar Layout','sparklestore-pro'),
                'options' => array(
                    'rightsidebar' => $image_url . '/layout/rightsidebar.png',
                    'leftsidebar' => $image_url . '/layout/leftsidebar.png',
                    'nosidebar' => $image_url . '/layout/nosidebar.png',
                ),
                'std' => 'rightsidebar',
                'tab' => 'sidebar-setting'
            ),
            array(
                'name' => esc_html__('Left Sidebar','sparklestore-pro'),
                'id' => 'left_sidebar',
                'type' => 'sidebar',
                'field_type' => 'select_advanced',
                'placeholder' => esc_html__('Select a sidebar','sparklestore-pro'),
                'columns' => 6,
                'tab' => 'sidebar-setting'
            ),
            array(
                'name' => esc_html__('Right Sidebar','sparklestore-pro'),
                'id' => 'right_sidebar',
                'type' => 'sidebar',
                'field_type' => 'select_advanced',
                'placeholder' => esc_html__('Select a sidebar','sparklestore-pro'),
                'columns' => 6,
                'tab' => 'sidebar-setting'
            ),


            //blog settings
            array(
                'id' => 'sparklestore_pro_blog_page_layout',
                'type' => 'image_select',
                'name' => esc_html__('Blog Page Layout','sparklestore-pro'),
                
                'options' => array(
                    'default' => $image_url . '/blog-layout/default.png',
                    'gridview' => $image_url . '/blog-layout/gridview.png',
                    'masonry' => $image_url . '/blog-layout/masonry.png',
                    'largelistview' => $image_url . '/blog-layout/largelistview.png',
                    'alternateview' => $image_url . '/blog-layout/alternateview.png'
                ),
                'std' => 'default',
                'tab' => 'blog-setting'
            ),
            array(
                'id' => 'sparklestore_pro_blog_cats',
                'type' => 'checkbox_list',
                'name' => esc_html__('Display Blogs Posts From Following Categories','sparklestore-pro'),
                'options' => $category,
                'tab' => 'blog-setting'
            ),
            array(
                'id' => 'sparklestore_pro_blog_per_page',
                'type' => 'select',
                'columns' => 4,
                'name' => esc_html__('Display Posts Per Page','sparklestore-pro'),
                'options' => array(
                    '-1' => esc_html__("All Posts", 'sparklestore-pro'),
                    4   => 4,
                    8   => 8,
                    12  => 12,
                    16  => 16,
                    20  => 20,
                ),
                'tab' => 'blog-setting'
            ),
                        
            array(
                'id' => 'sparklestore_post_description_options',
                'type' => 'select',
                'columns' => 4,
                'name' => esc_html__('Post Description','sparklestore-pro'),
                
                'options' => array(
                    'none'   => esc_html__( 'Default', 'sparklestore-pro' ),
                    'excerpt'   => esc_html__( 'Post Excerpt', 'sparklestore-pro' ),
                    'content'   => esc_html__( 'Post Content', 'sparklestore-pro' )
                ),
                'std' => 'excerpt',
                'tab' => 'blog-setting'
            ),

            array(
                'id' => 'sparklestore_post_description_text_alignment',
                'type' => 'select',
                'columns' => 4,
                'name' => esc_html__( 'Text Alignment', 'sparklestore-pro' ),
                
                'options' => array(
                    'center'   => esc_html__('Center', 'sparklestore-pro'),
                    'left'   => esc_html__('Left', 'sparklestore-pro'),
                    'right'   => esc_html__('Right', 'sparklestore-pro'),
                ),
                'std' => '',
                'tab' => 'blog-setting'
            ),
            
            array(
                'name' => esc_html__('Enable Post Date','sparklestore-pro'),
                'id' => 'sparklestore_post_date_options',
                'type' => 'switch',
                'on_label' => esc_html__('Yes','sparklestore-pro'),
                'off_label' => esc_html__('No','sparklestore-pro'),
                'std' => 0,
                'columns' => 4,
                'tab' => 'blog-setting',
            ),
            array(
                'name' => esc_html__('Enable Post Author','sparklestore-pro'),
                'id' => 'sparklestore_post_author_options',
                'type' => 'switch',
                'on_label' => esc_html__('Yes','sparklestore-pro'),
                'off_label' => esc_html__('No','sparklestore-pro'),
                'std' => 0,
                'columns' => 4,
                'tab' => 'blog-setting',
            ),
            array(
                'name' => esc_html__('Enable Post Comments','sparklestore-pro'),
                'id' => 'sparklestore_post_comments_options',
                'type' => 'switch',
                'on_label' => esc_html__('Yes','sparklestore-pro'),
                'off_label' => esc_html__('No','sparklestore-pro'),
                'std' => 0,
                'columns' => 4,
                'tab' => 'blog-setting',
            ),

            array(
                'id' => 'sparklestore_pro_blog_readmore_text',
                'type' => 'text',
                'columns' => 6,
                'name' => esc_html__('Read More Text','sparklestore-pro'),
                'std' => esc_html__('Read More', 'sparklestore-pro'),
                'tab' => 'blog-setting',
            ),

            array(
                'id' => 'sparklestore_post_excerpt_length',
                'type' => 'number',
                'columns' => 6,
                'name'     => esc_html__( 'Enter Posts Excerpt Length', 'sparklestore-pro' ),
                'std' => 45,
                'tab' => 'blog-setting',
            ),

        )
    );

    $meta_boxes[] = array(
        'id' => 'sparkle_wpt_post_setting',
        'title' => esc_html__('Post Setting', 'sparklestore-pro'),
        'post_types' => array('post'),
        'context' => 'advanced',
        'priority' => 'high',
        'autosave' => true,
        'tabs' => array(
            'general-setting' => array(
                'label' => esc_html__('General Setting','sparklestore-pro'),
                'icon' => 'dashicons-admin-generic'
            ),
            'titlebar-setting' => array(
                'label' => esc_html__('Title Setting','sparklestore-pro'),
                'icon' => 'dashicons-editor-kitchensink'
            ),
            
            'sidebar-setting' => array(
                'label' => esc_html__('Sidebar Setting','sparklestore-pro'),
                'icon' => 'dashicons-welcome-widgets-menus'
            )
        ),
        'tab_style' => 'left',
        'tab_wrapper' => true,
        'fields' => array(
            array(
                'name' => esc_html__('Hide Header','sparklestore-pro'),
                'id' => 'hide_header',
                'type' => 'switch',
                'style' => 'total',
                'on_label' => esc_html__('Yes','sparklestore-pro'),
                'off_label' => esc_html__('No','sparklestore-pro'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'general-setting'
            ),
            array(
                'name' => esc_html__('Hide Footer','sparklestore-pro'),
                'id' => 'hide_footer',
                'type' => 'switch',
                'style' => 'total',
                'on_label' => esc_html__('Yes','sparklestore-pro'),
                'off_label' => esc_html__('No','sparklestore-pro'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'general-setting'
            ),
            array(
                'name' => esc_html__('Hide Breadcrumb','sparklestore-pro'),
                'label_description' => esc_html__('Hide breadcumb area','sparklestore-pro'),
                'id' => 'hide_breadcrumb',
                'type' => 'switch',
                'style' => 'total',
                'on_label' => esc_html__('Yes','sparklestore-pro'),
                'off_label' => esc_html__('No','sparklestore-pro'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('OverWrite Default Style','sparklestore-pro'),
                'label_description' => esc_html__('A set of settings will appear','sparklestore-pro'),
                'id' => 'page_overwrite_defaults',
                'type' => 'switch',
                'style' => 'total',
                'on_label' => esc_html__('Yes','sparklestore-pro'),
                'off_label' => esc_html__('No','sparklestore-pro'),
                'std' => 0,
                'columns' => 6,
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Breadcumb Background Options','sparklestore-pro'),
                'type' => 'group',
                'class' => 'background-group',
                'tab' => 'titlebar-setting',
                'id' => 'titlebar_background',
                'hidden' => array('overwrite_defaults', false),
                'fields' => array(
                    array(
                        'id' => 'titlebar_bg_color',
                        'type' => 'color'
                    ),
                    array(
                        'id' => 'titlebar_bg_image',
                        'type' => 'image_advanced',
                        'max_file_uploads' => 1,
                        'max_status' => false
                    ),
                    array(
                        'placeholder' => esc_html__('Background Repeat','sparklestore-pro'),
                        'id' => 'titlebar_bg_repeat',
                        'type' => 'select_advanced',
                        'options' => array(
                            'no-repeat' => esc_html__('No Repeat','sparklestore-pro'),
                            'repeat' => esc_html__('Repeat All','sparklestore-pro'),
                            'repeat-x' => esc_html__('Repeat Horizontally','sparklestore-pro'),
                            'repeat-y' => esc_html__('Repeat Vertically','sparklestore-pro')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Size','sparklestore-pro'),
                        'id' => 'titlebar_bg_size',
                        'type' => 'select_advanced',
                        'options' => array(
                            'inherit' => esc_html__('Inherit','sparklestore-pro'),
                            'cover' => esc_html__('Cover','sparklestore-pro'),
                            'contain' => esc_html__('Contain','sparklestore-pro')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Attachment','sparklestore-pro'),
                        'id' => 'titlebar_bg_attachment',
                        'type' => 'select_advanced',
                        'options' => array(
                            'inherit' => esc_html__('Inherit','sparklestore-pro'),
                            'fixed' => esc_html__('Fixed','sparklestore-pro'),
                            'scroll' => esc_html__('Scroll','sparklestore-pro')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'placeholder' => esc_html__('Background Position','sparklestore-pro'),
                        'id' => 'titlebar_bg_position',
                        'type' => 'select_advanced',
                        'options' => array(
                            'left top' => esc_html__('Left Top','sparklestore-pro'),
                            'left center' => esc_html__('Left Center','sparklestore-pro'),
                            'left bottom' => esc_html__('Left Bottom','sparklestore-pro'),
                            'center top' => esc_html__('Center Top','sparklestore-pro'),
                            'center center' => esc_html__('Center Center','sparklestore-pro'),
                            'center bottom' => esc_html__('Center Bottom','sparklestore-pro'),
                            'right top' => esc_html__('Right Top','sparklestore-pro'),
                            'right center' => esc_html__('Right Center','sparklestore-pro'),
                            'right bottom' => esc_html__('Right Bottom','sparklestore-pro')
                        ),
                        'js_options' => array(
                            'width' > '500px',
                            'allowClear' => false
                        ),
                        'hidden' => array('titlebar_bg_image', 0),
                        'columns' => 6
                    ),
                    array(
                        'name' => esc_html__('Overlay Background Color','sparklestore-pro'),
                        'id' => 'overlay_bg_color',
                        'type' => 'color',
                        'alpha_channel' => true,
                        'hidden' => array('titlebar_bg_image', 0)
                    ),
                    array(
                        'name' => esc_html__('Enable Parallax Effect','sparklestore-pro'),
                        'id' => 'enable_parallax_effect',
                        'type' => 'switch',
                        'style' => 'total',
                        'on_label' => esc_html__('Yes','sparklestore-pro'),
                        'off_label' => esc_html__('No','sparklestore-pro'),
                        'std' => 0,
                        'class' => 'switch2 no-margin',
                        'hidden' => array('titlebar_bg_image', 0)
                    )
                )
            ),
            array(
                'name' => esc_html__('Title Color','sparklestore-pro'),
                'id' => 'titlebar_color',
                'type' => 'color',
                'hidden' => array('overwrite_defaults', false),
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Text Color','sparklestore-pro'),
                'id' => 'titlebar_text_color',
                'type' => 'color',
                'hidden' => array('overwrite_defaults', false),
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Link Color','sparklestore-pro'),
                'id' => 'titlebar_link_color',
                'type' => 'color',
                'hidden' => array('overwrite_defaults', false),
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Top Bottom Padding','sparklestore-pro'),
                'id' => 'titlebar_padding',
                'type' => 'slider',
                'suffix' => ' px',
                'js_options' => array(
                    'min' => 0,
                    'max' => 200,
                    'step' => 5
                ),
                'std' => 80,
                'hidden' => array('overwrite_defaults', false),
                'tab' => 'titlebar-setting'
            ),
            array(
                'name' => esc_html__('Top Bottom Margin','sparklestore-pro'),
                'id' => 'titlebar_margin',
                'type' => 'slider',
                'suffix' => ' px',
                'js_options' => array(
                    'min' => 0,
                    'max' => 200,
                    'step' => 5
                ),
                'std' => 0,
                'hidden' => array('overwrite_defaults', false),
                'tab' => 'titlebar-setting'
            ),
            array(
                'id' => 'sidebar_layout',
                'type' => 'image_select',
                'name' => esc_html__('Sidebar Layout','sparklestore-pro'),
                'options' => array(
                    'default' => $image_url . 'default.png',
                    'rightsidebar' => $image_url . 'right-sidebar.png',
                    'leftsidebar' => $image_url . 'left-sidebar.png',
                    'nosidebar' => $image_url . 'no-sidebar.png',
                    // 'bothsidebar' => $image_url . 'both-sidebar.png',
                ),
                'std' => 'default',
                'tab' => 'sidebar-setting'
            ),
            array(
                'name' => esc_html__('Left Sidebar','sparklestore-pro'),
                'id' => 'left_sidebar',
                'type' => 'sidebar',
                'field_type' => 'select_advanced',
                'placeholder' => esc_html__('Select a sidebar','sparklestore-pro'),
                'columns' => 6,
                'tab' => 'sidebar-setting'
            ),
            array(
                'name' => esc_html__('Right Sidebar','sparklestore-pro'),
                'id' => 'right_sidebar',
                'type' => 'sidebar',
                'field_type' => 'select_advanced',
                'placeholder' => esc_html__('Select a sidebar','sparklestore-pro'),
                'columns' => 6,
                'tab' => 'sidebar-setting'
            )
        )
    );

    return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'sparkle_wpt_post_metabox');


add_filter( 'rwmb_outside_conditions', function( $conditions ) {
    $conditions['.rwmb-tab-blog-setting'] = array(
        'visible' => array( 'page_template', 'template-blogpage.php' )
    );
    return $conditions;
} );
