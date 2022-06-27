<?php
if( !function_exists( 'sparklestore_header_vertical' ) ) :
  /**
   * Header Vertical Menu
  */
  function sparklestore_header_vertical(){

      $vertical_menu_title     = get_theme_mod( 'sparklestore_vertical_menu_title','More Categories' );
      $vertical_all_menu       = get_theme_mod( 'sparklestore_vertical_menu_show_all_menu','More Categories' );
      $vertical_all_close      = get_theme_mod( 'sparklestore_vertical_menu_show_all_menu_close','Close' );
      $vertical_item_visible   = get_theme_mod( 'sparklestore_vertical_menu_display_itmes', 10 );
      $slider_options          = get_theme_mod( 'sparklestore_pro_slider_section_section', 'off' );    
      

          $block_vertical_class = array( 'vertical-wapper block-nav-category has-vertical-menu' ); 
          
          if ( is_front_page() || is_home() ) {
      
              $slider_layout = get_theme_mod( 'sparklestore_pro_slider_layout', 'fullwidth');
              
              if( !empty( $slider_layout ) && $slider_layout == 'sliderverticalmenu' && $slider_options == 'off' ){
  
                  $block_vertical_class[] = 'alway-open has-open';
              }
          }
      ?>
          
          <div data-items="<?php echo esc_attr( $vertical_item_visible ); ?>" class="category-menu-main <?php echo esc_attr( implode( ' ', $block_vertical_class ) ); ?>">
              <div class="category-menu-title block-title">
                  <?php echo esc_html( $vertical_menu_title ); ?>
              </div>
              <div class="block-content verticalmenu-content menu-category">
                <?php
                

                  if( has_nav_menu( 'sparklecategory' ) ){
                    wp_nav_menu( array(
                        'theme_location'  => 'sparklecategory',
                        'depth'           => 4,
                        'container'       => '',
                        'container_class' => '',
                        'container_id'    => '',
                        'menu_class'      => 'vertical-menu',
                      )
                    );
                  }
                ?>
                <div class="view-all-category">
                    <a href="javascript:void(0);"
                       data-closetext="<?php echo esc_attr( $vertical_all_close ); ?>"
                       data-alltext="<?php echo esc_attr( $vertical_all_menu ) ?>"
                       class="btn-view-all open-cate"><?php echo esc_html( $vertical_all_menu ) ?>
                    </a>
                </div>
              </div>
          </div><!-- block category -->
      <?php
  }
endif;
add_action( 'sparklestore_vertical_menu_section', 'sparklestore_header_vertical' );
/**
 * Quick Contact Top Header Function Area
*/
if ( ! function_exists( 'sparklestore_pro_quick_information' ) ) {
  function sparklestore_pro_quick_information() { ?>
      <div class="quickinfowrap">
        <ul class="quickinfo">
            <?php
                $emial_icon       = get_theme_mod('sparklestore_pro_email_icon','fas fa-envelope-open');
                $email_address    = sanitize_email( get_theme_mod('sparklestore_pro_email_title','info@exmaple.com') );
                $phone_icon       = get_theme_mod('sparklestore_pro_phone_icon','fas fa-phone-alt');
                $phone_number     = get_theme_mod('sparklestore_pro_phone_number','+1 (8976)-322-221');
                $map_address_iocn = get_theme_mod('sparklestore_pro_address_icon','fas fa-map-marker-alt');
                $map_address      = get_theme_mod('sparklestore_pro_map_address','Kathmandu 44600, Nepal');
                $shop_open_icon   = get_theme_mod('sparklestore_pro_start_open_icon');
                $shop_open_time   = get_theme_mod('sparklestore_pro_start_open_time');
            ?>
              <?php if(!empty( $phone_number )) { ?>
                <li>
                    <span class="<?php if(!empty( $phone_icon )) { echo esc_attr( $phone_icon ); } ?>">&nbsp;</span>
                    <?php echo esc_attr( $phone_number ); ?>
                </li>
              <?php }  ?>

              <?php if(!empty( $email_address )) { ?>
                <li><a href="mailto:<?php echo esc_attr( antispambot( $email_address ) ); ?>">
                    <span class="<?php if(!empty( $emial_icon )) { echo esc_attr( $emial_icon ); } ?>">&nbsp;</span>
                    <?php echo esc_attr( antispambot( $email_address ) ); ?></a>
                </li>
              <?php }  ?>

              <?php if(!empty( $map_address )) { ?>
                <li><a target="_blank" href="https://www.google.com.np/maps/place/<?php echo esc_html( $map_address ); ?>">
                    <span class="<?php if(!empty( $map_address_iocn )) { echo esc_attr( $map_address_iocn ); } ?>">&nbsp;</span>
                    <?php echo esc_html( $map_address ); ?></a>
                </li>
              <?php }  ?>

              <?php if(!empty( $shop_open_time )) { ?>
                <li>
                    <span class="<?php if(!empty( $shop_open_icon )) { echo esc_attr( $shop_open_icon ); } ?>">&nbsp;</span>
                    <?php echo esc_attr( $shop_open_time ); ?>
                </li>
              <?php }  ?>
        </ul>
      </div>
  <?php
  }
}
add_action('sparklestore_quick_information','sparklestore_pro_quick_information');
add_action('sparklestore_pro_header_quickinfo','sparklestore_pro_quick_information');


if( !function_exists('sparklestore_freetext_left_information')){

  function sparklestore_freetext_left_information(){
    
    $sparklestore_pro_header_left_free_text = get_theme_mod('sparklestore_pro_header_left_free_text', false);
    
    if( $sparklestore_pro_header_left_free_text ){

      echo "<div class='free-hand-text-wrap'>";
            echo force_balance_tags( wp_kses_post( $sparklestore_pro_header_left_free_text));
      echo "</div>";
    }
  }
  add_action('sparklestore_freetext_left_information','sparklestore_freetext_left_information');
  /**
	 * sparklestore_pro_header_html
	 * since 1.2.8
	 * Header HTML
	 * @return void
	 */
	add_action('sparklestore_pro_header_html', 'sparklestore_freetext_left_information');
}


if( !function_exists('sparklestore_freetext_right_information')){
  function sparklestore_freetext_right_information(){
    $sparklestore_pro_header_right_free_text = get_theme_mod('sparklestore_pro_header_right_free_text', false);
    if( $sparklestore_pro_header_right_free_text ){
      echo "<div class='free-hand-text-wrap'>";
            echo force_balance_tags( wp_kses_post( $sparklestore_pro_header_right_free_text));

      echo "</div>";
    }
  }
}
add_action('sparklestore_freetext_right_information','sparklestore_freetext_right_information');

/**
 * Top Navigation Top Header Function Area
*/
if ( ! function_exists( 'sparklestore_pro_top_navigation' ) ) {
  function sparklestore_pro_top_navigation() { 
    $alignment = get_theme_mod('secondary-menu-align', 'swp-flex-align-left');
    $depth = get_theme_mod('secondary-menu-disable-sub-menu', false) ? 1 : 0;
    $disable_class = $depth ? 'child-menu-icon-hide' : "";
    ?>
      <div class="secondry-menu-wrap sparkle-column <?php esc_attr_e($alignment); ?>">
        <div class="secondry-links box-header-nav">
            <?php wp_nav_menu( array( 
                  'theme_location' => 'sparklesecondrymenu', 
                  'menu_class'  => 'secondry-menu main-menu '.$disable_class,
                  'depth' => $depth
                ) ); ?>
        </div><!-- End Header Top Links -->
      </div>
  <?php
  }
}
add_action('sparklestore_top_navigation','sparklestore_pro_top_navigation');
add_action('secondary_menu','sparklestore_pro_top_navigation');

/**
 * Descriptions on Header Menu
 * @author Sparkle Themes
 * @param string $item_output , HTML outputp for the menu item
 * @param object $item , menu item object
 * @param int $depth , depth in menu structure
 * @param object $args , arguments passed to wp_nav_menu()
 * @return string $item_output
 */
function sparklestore_pro_header_menu_desc($item_output, $item, $depth, $args){

  if ( !empty($args->theme_location) && 'sparkleprimary' == $args->theme_location && $item->description)

      $item_output = str_replace('</a>', '<span class="menu-description">' . $item->description . '</span></a>', $item_output);

  return $item_output;
}
add_filter('walker_nav_menu_start_el', 'sparklestore_pro_header_menu_desc', 10, 4);


/**
 * Social Media Link Top Header Function Area
*/
if ( ! function_exists( 'sparklestore_pro_social_media_link' ) ) {
  function sparklestore_pro_social_media_link() {
    $alignment = get_theme_mod('social-align', 'swp-flex-align-right');
    ?>
      <div class="sociallink topsociallink grid-row sp-clearfix <?php esc_attr_e($alignment); ?>">
        <?php apply_filters( 'sparklestore_pro_social_links', 5 ); ?>
      </div>
  <?php
  }
}
add_action('sparklestore_social_media_link','sparklestore_pro_social_media_link');
add_action('sparklestore_pro_social_link_activate_settings','sparklestore_pro_social_media_link');


if ( ! function_exists( 'sparklestore_pro_get_logo' ) ){
  /**
   * Logo function.
   *
   * @since 1.0.0
   */
  function sparklestore_pro_get_logo(){ 
    // site identity align.
    $align = get_theme_mod( 'sparklestore_pro_title_tagline_alignment' );
    $align = json_decode( $align, true );
    $class = array();
    // desktop align.
    $align_desktop = sparklewp_responsive_button_value( $align, 'desktop' );
    $class[] = 'text-'.$align_desktop ? 'text-'.$align_desktop : 'text-center';

    // tablet align.
    $align_tablet = sparklewp_responsive_button_value( $align, 'tablet' );
    $class[] = 'text-'.$align_tablet ? 'text-'.$align_tablet : 'text-center';

    // mobile align.
    $align_mobile = sparklewp_responsive_button_value( $align, 'mobile' );
    $class[] = "text-".$align_mobile ? "text-".$align_mobile : 'text-center';

     
    ?>
    
      <div class="site-branding <?php echo esc_attr( implode(" ", $class) ); ?>">
        <div class="site-branding-wrapper">
          <?php the_custom_logo(); ?>

          <h1 class="site-title">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                  <?php bloginfo( 'name' ); ?>
              </a>
          </h1>
          <?php 
              $sparklestore_pro_description = get_bloginfo( 'description', 'display' );
              if ( $sparklestore_pro_description || is_customize_preview() ) :?>
                  <p class="site-description"><?php echo $sparklestore_pro_description; /* WPCS: xss ok. */ ?></p>
          <?php endif; ?>
        </div>              
      </div> <!-- .site-branding -->
      <?php
  }
}
add_action( 'sparklestore_pro_get_logo', 'sparklestore_pro_get_logo' );
add_action( 'title_tagline', 'sparklestore_pro_get_logo' );


if(!function_exists ('sparklestore_pro_advance_product_search_form')){
    /**
    * Advance Search
    *
    * @since 1.0.0
    */
    function sparklestore_pro_advance_product_search_form(){   

        $searchplaceholder = get_theme_mod('sparklestore_search_placeholder_text','I&#39;m searching for...' ); 
        
        $searchtype = get_theme_mod( 'sparklestore_pro_search_type_options', 'advancesearch' );

        $selected     = '';
        
        if ( isset( $_GET['product_cat'] ) && sanitize_text_field( wp_unslash( $_GET['product_cat'] ) ) ) {

                $selected = sanitize_text_field( wp_unslash( $_GET['product_cat'] ) );

        }
          $args = array(
              'show_option_none'  => esc_html__( 'All Categories', 'sparklestore-pro' ),
              'taxonomy'          => 'product_cat',
              'class'             => 'category-search-option',
              'hide_empty'        => 1,
              'orderby'           => 'name',
              'order'             => "ASC",
              'tab_index'         => true,
              'hierarchical'      => true,
              'id'                => rand(),
              'name'              => 'product_cat',
              'value_field'       => 'slug',
              'selected'          => $selected,
              'option_none_value' => '0',
          );
      ?>
        <div class="block-search spw-width-100">
            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>" class="form-search block-search <?php echo esc_attr( $searchtype ); ?>">
                <?php 
                    if( class_exists( 'WooCommerce' ) && !empty($searchtype) && $searchtype == 'advancesearch' ){
                ?>
                    <input type="hidden" name="post_type" value="product"/>
                    <input type="hidden" name="taxonomy" value="product_cat">
                    <div class="form-content search-box results-search">
                        <div class="inner">
                            <input autocomplete="off" type="text" class="input searchfield txt-livesearch" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_attr( $searchplaceholder ); ?>">
                        </div>
                    </div>
                    <div class="category">
                      <?php wp_dropdown_categories( $args ); ?>
                    </div>
                    <button type="submit" class="btn-submit">
                        <span class="fa fa-search" aria-hidden="true"></span>
                    </button>

                <?php }elseif(!empty($searchtype) && $searchtype == 'ajaxsearch' ){ ?>
        
                        <div class="form-content search-box results-search">
                            <div class="inner">
                                <input autocomplete="off" type="text" class="input searchfield txt-livesearch" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_attr( $searchplaceholder ); ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn-submit">
                            <span class="fa fa-search" aria-hidden="true"></span>
                            <i class="fas fa-spinner form-ajax-preloader"></i>
                        </button>

                        <div id="datafetch" class="datafetch"><?php esc_html_e('Search results will appear here','sparklestore-pro'); ?></div>

                <?php } else{ ?>

                    <input type="hidden" name="post_type" value="post">
                    <div class="form-content search-box results-search">
                        <div class="inner">
                            <input autocomplete="off" type="text" class="input searchfield txt-livesearch" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_attr( $searchplaceholder ); ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">
                        <span class="fa fa-search" aria-hidden="true"></span>
                    </button>

                <?php } ?>
            </form><!-- block search -->
        </div>
      <?php 
    }
}
add_action('sparklestore_pro_woocommerce_product_search','sparklestore_pro_advance_product_search_form', 90);

if(!function_exists('sparklestore_pro_header_search')){
  function sparklestore_pro_header_search(){ 
    $search_icon_only = get_theme_mod('sparklestore_search_icon_only', false);
    $search_icon_alignment = get_theme_mod('sparklestore_search_icon_alignment', 'swp-flex-align-left')
    ?>
    <div class="sparkle-column <?php esc_attr_e($search_icon_alignment); ?>">
      <?php if( $search_icon_only ): ?>
      <button class="toggle-searchicon">
				<i class="icofont-search"></i>
      </button>

      <div class="header-control toggle-search">
        <?php
          /**
           * Advance & Normal Search
           */
          do_action( 'sparklestore_pro_woocommerce_product_search' );
        ?>
      </div>

      <?php
        else: 
        /**
         * Advance & Normal Search
         */
        do_action( 'sparklestore_pro_woocommerce_product_search' );
        endif; 
      ?>
    </div>
    <?php
  }
  add_action('sparklestore_pro_header_search', 'sparklestore_pro_header_search');
}

/**
 * Header Main Banner Function Area
*/
if ( ! function_exists( 'sparklestore_pro_banner_slider' ) ) {

  function sparklestore_pro_banner_slider() { 
    
    $all_slider = get_theme_mod('sparklestore_pro_banner_all_sliders');

    $banner_slider = json_decode( $all_slider );

    if(!empty( $all_slider ) && !empty( $banner_slider[0]->selectpage ) ) { ?>

    <div id="home" class="home-section banner-height">
        <div class="sparklestore-slider"
          data-arrow="<?php echo intval(sparklewp_get_theme_options('sparklestore_pro_slider_arrow')); ?>" 
          data-dots="<?php echo intval(sparklewp_get_theme_options('sparklestore_pro_slider_dots')); ?>"
          data-loop="<?php echo intval(sparklewp_get_theme_options('sparklestore_pro_slider_loop')); ?>"
          data-autoplay="<?php echo intval(sparklewp_get_theme_options('sparklestore_pro_slider_auto_play')); ?>"
          data-drag="<?php echo intval(sparklewp_get_theme_options('sparklestore_pro_slider_mouse_drag')); ?>"
          >
            <ul class="slides">
                <?php
                  

                  foreach($banner_slider as $slider){

                    $slider_page_id = $slider->selectpage;

                    if( !empty( $slider_page_id ) ) {

                    $slider_page = new WP_Query( 'page_id='.$slider_page_id );

                    if( $slider_page->have_posts() ) { while( $slider_page->have_posts() ) { $slider_page->the_post();
                      
                      $image_path = wp_get_attachment_image_src( get_post_thumbnail_id(), 'sparklestore-slider', true );
                ?>
                
                  <li class="bg-dark" style="background-image: url('<?php echo esc_url($image_path[0]); ?>');">
                      <div class="home-slider-overlay"></div>
                      <div class="container slider-caption-wrapper">
                      <div class="sparklestore-caption <?php echo esc_attr($slider->alignment); ?>">
                            <h2><?php the_title(); ?></h2>
                            
                            <p><?php echo wp_kses_post( wp_trim_words( get_the_content(), 50 ) ); ?></p>
                            
                            <div class="sliderbtn-wrp">
                                <?php if($slider->button_text): ?>
                                  <a class="btn btn-primary" href="<?php echo esc_url($slider->button_url); ?>">
                                    <?php echo esc_attr($slider->button_text); ?>
                                  </a>
                                <?php endif; ?>
                                <?php if($slider->button_two_text): ?>
                                  <a class="btn btn-secondary" href="<?php echo esc_url($slider->button_two_url); ?>">
                                    <?php echo esc_attr($slider->button_two_text); ?>
                                  </a>
                                <?php endif; ?>
                            </div>
                      </div>
                      </div>
                  </li>
                
                <?php } } wp_reset_postdata(); } } ?>
            </ul>
        </div>
    </div>

    <?php }
  }
}
add_action( 'sparklestore-slider', 'sparklestore_pro_banner_slider', 30 );


/**
 * Header Advance Slider
*/
if ( ! function_exists( 'sparklestore_pro_advance_slider' ) ) {
  function sparklestore_pro_advance_slider() { ?>
    <div id="home" class="home-section banner-height">
        <div class="sparklestore-slider" 
        data-arrow="<?php echo intval(get_theme_mod('sparklestore_pro_slider_arrow')); ?>" 
        data-dots="<?php echo intval(get_theme_mod('sparklestore_pro_slider_dots')); ?>"
        data-dots="<?php echo intval(get_theme_mod('sparklestore_pro_slider_dots')); ?>"
        data-loop="<?php echo intval(get_theme_mod('sparklestore_pro_slider_loop')); ?>"
        data-autoplay="<?php echo intval(get_theme_mod('sparklestore_pro_slider_auto_play')); ?>"
        data-drag="<?php echo intval(get_theme_mod('sparklestore_pro_slider_mouse_drag')); ?>"
        >
            <ul class="slides">
                <?php
                  $all_slider = wp_kses_post( get_theme_mod('sparklestore_pro_advance_sliders') );

                  if(!empty( $all_slider )) {

                  $banner_slider = json_decode( $all_slider );

                  foreach($banner_slider as $slider){
                ?>
                  <li class="bg-dark" style="background-image: url('<?php echo esc_url($slider->image); ?>');">
                      <div class="home-slider-overlay"></div>
                      <div class="container slider-caption-wrapper">
                          <div class="sparklestore-caption <?php echo esc_attr($slider->alignment); ?>">
                              <h2><?php echo esc_html($slider->title); ?></h2>
                              <p><?php echo wp_kses_post( $slider->subtitle ); ?></p>
                              <div class="sliderbtn-wrp">
                                  <?php if($slider->button_text): ?>
                                    <a class="btn btn-primary" href="<?php echo esc_url($slider->button_link); ?>">
                                      <?php echo esc_attr($slider->button_text); ?>
                                    </a>
                                  <?php endif; ?>
                                  <?php if($slider->button_text_two): ?>
                                    <a class="btn btn-secondary" href="<?php echo esc_url($slider->button_link_two); ?>">
                                      <?php echo esc_attr($slider->button_text_two); ?>
                                    </a>
                                  <?php endif; ?>
                              </div>
                          </div>
                      </div>
                  </li>
                <?php }  } ?>
            </ul>
        </div>
    </div>
    <?php
  }
}
add_action( 'sparklestore-advance-slider', 'sparklestore_pro_advance_slider', 30 );

/** header banner as slider */
if( !function_exists( 'sparklestore_pro_header_banner')){

  function sparklestore_pro_header_banner(){

    $banner_image = get_theme_mod('sparklestore_pro_banner_image');
    $banner_promo_image = get_theme_mod('sparklestore_pro_banner_promo_image');
    $sparklestore_pro_banner_title = get_theme_mod('sparklestore_pro_banner_title');
    $sparklestore_pro_banner_subtitle = get_theme_mod('sparklestore_pro_banner_subtitle');
    $sparklestore_pro_banner_button_text = get_theme_mod('sparklestore_pro_banner_button_text');
    $sparklestore_pro_banner_button_link = get_theme_mod('sparklestore_pro_banner_button_link');
    $sparklestore_pro_banner_text_alignment = get_theme_mod('sparklestore_pro_banner_text_alignment', 'left');

    ?>

    <div class="header-banner">
        <?php if( $banner_image ): ?>
          <div class="banner-img">
              <img src="<?php echo esc_url($banner_image); ?>">
          </div>
        <?php endif; ?>

          <div class="home-slider-overlay"></div>
          <div class="container sparklestore-caption">
              <?php if( $sparklestore_pro_banner_text_alignment == 'left'): ?>
                <div class="banneritem-caption text-left <?php if( !$banner_promo_image ){ echo esc_attr( 'noimage' ); } ?>">
                    <h2><?php echo esc_html($sparklestore_pro_banner_title); ?></h2>
                    <p><?php echo wp_kses_post( $sparklestore_pro_banner_subtitle ); ?></p>
                    <?php if($sparklestore_pro_banner_button_text): ?>
                      <div class="sliderbtn-wrp">
                          <a class="btn btn-primary" href="<?php echo esc_url($sparklestore_pro_banner_button_text); ?>">
                              <?php echo esc_attr($sparklestore_pro_banner_button_text); ?>
                          </a>
                      </div>
                    <?php endif; ?>
                </div>
              <?php endif; ?>

              <?php if( $banner_promo_image ): ?>
              <div class="banneritem-img">
                  <img src="<?php echo esc_url($banner_promo_image); ?>" alt="<?php echo esc_html($sparklestore_pro_banner_title); ?>"/>
              </div>
              <?php endif; ?>


              <?php if( $sparklestore_pro_banner_text_alignment == 'right'): ?>
                <div class="banneritem-caption text-right">
                    <h2><?php echo esc_html($sparklestore_pro_banner_title); ?></h2>
                    <p><?php echo wp_kses_post( $sparklestore_pro_banner_subtitle ); ?></p>
                    <?php if($sparklestore_pro_banner_button_text): ?>
                      <div class="sliderbtn-wrp">
                          <a class="btn btn-primary" href="<?php echo esc_url($sparklestore_pro_banner_button_text); ?>">
                              <?php echo esc_attr($sparklestore_pro_banner_button_text); ?>
                          </a>
                      </div>
                    <?php endif; ?>
                </div>
              <?php endif; ?>
          </div>
    </div>

    <?php

  }
}

add_action( 'sparklestore-header-banner', 'sparklestore_pro_header_banner', 30 );

/** video banner section */
if( !function_exists('sparklestore_pro_video_banner_section')){
  function sparklestore_pro_video_banner_section(){
    $bg_video = get_theme_mod("sparklestore_pro_video_banner", '6O9Nd1RSZSY');
    //$banner_image = get_theme_mod('sparklestore_pro_banner_image');
    //$banner_promo_image = get_theme_mod('sparklestore_pro_banner_promo_image');
    $sparklestore_pro_banner_title = get_theme_mod('sparklestore_pro_banner_title');
    $sparklestore_pro_banner_subtitle = get_theme_mod('sparklestore_pro_banner_subtitle');
    $sparklestore_pro_banner_button_text = get_theme_mod('sparklestore_pro_banner_button_text');
    $sparklestore_pro_banner_button_link = get_theme_mod('sparklestore_pro_banner_button_link');
    //$sparklestore_pro_banner_text_alignment = get_theme_mod('sparklestore_pro_banner_text_alignment', 'left');

    if( $bg_video ):
      $video_data = 'data-property="{videoURL:\'' . $bg_video . '\', mobileFallbackImage:\'https://img.youtube.com/vi/' . $bg_video . '/maxresdefault.jpg\'}"';
    else: 
      $video_data = '';
    endif;
    ?>
      <div class="sp-section header-banner banner-height video-banner " <?php echo $video_data; ?>>
          <div class="home-slider-overlay"></div>
          <div class="container sparklestore-caption">
                <div class="banneritem-caption text-center">
                    <h2><?php echo esc_html($sparklestore_pro_banner_title); ?></h2>
                    <p><?php echo esc_html( $sparklestore_pro_banner_subtitle ); ?></p>
                    <?php if($sparklestore_pro_banner_button_text): ?>
                      <div class="sliderbtn-wrp">
                          <a class="btn btn-primary" href="<?php echo esc_url($sparklestore_pro_banner_button_link); ?>">
                              <?php echo esc_attr($sparklestore_pro_banner_button_text); ?>
                          </a>
                      </div>
                    <?php endif; ?>
                </div>
          </div>
      </div>
    <?php
  }
}
add_action('sparklestore-header-video-banner', 'sparklestore_pro_video_banner_section');
/**
 * Revolution Main Banner Slider Function Area
*/
if ( ! function_exists( 'sparklestore_pro_revolution_slider' ) ) {
  function sparklestore_pro_revolution_slider() { ?>
      <div class="revolutionwrap">
        <?php
          $revolution = get_theme_mod( 'sparklestore_pro_slider_revolution' );
          echo do_shortcode( $revolution );
        ?>
      </div>
    <?php
  }
}
add_action( 'sparklestore-revolution', 'sparklestore_pro_revolution_slider', 30 );

/**
 * Schema type
*/
function sparklestore_pro_html_tag_schema() {
    $schema     = 'http://schema.org/';
    $type       = 'WebPage';
    // Is single post
    if ( is_singular( 'post' ) ) {
        $type   = 'Article';
    }
    // Is author page
    elseif ( is_author() ) {
        $type   = 'ProfilePage';
    }
    // Is search results page
    elseif ( is_search() ) {
        $type   = 'SearchResultsPage';
    }
    echo 'itemscope="itemscope" itemtype="' . esc_attr( $schema ) . esc_attr( $type ) . '"';
}

/**
 * Sparkle Store social links
*/

if( ! function_exists( 'sparklestore_pro_default_social_link' ) ){

    function sparklestore_pro_default_social_link(){

      return json_encode(array(
        array(
            'icon' => 'icofont-facebook',
            'link' => 'https://www.facebook.com/sparklewpthemes',
            'new_tab' => true,
            'enable' => 'on'
        ),
        array(
            'icon' => 'icofont-twitter',
            'link' => 'https://www.twitter.com/sparklewpthemes',
            'new_tab' => true,
            'enable' => 'on'
        ),
        array(
            'icon' => 'icofont-youtube',
            'link' => 'https://www.youtube.com/channel/UCNz4pwcVXsZfVichroSRdKg',
            'new_tab' => true,
            'enable' => 'on'
        ),
        array(
            'icon' => 'icofont-instagram',
            'link' => 'https://www.instagram.com/sparklewptheme/',
            'new_tab' => true,
            'enable' => 'on'
        ),
        array(
            'icon' => 'icofont-linkedin',
            'link' => 'https://np.linkedin.com/in/sparklewpthemes',
            'new_tab' => true,
            'enable' => 'on'
        )

      ));

    }

}

if ( ! function_exists( 'sparklestore_pro_social_links' ) ) {

  function sparklestore_pro_social_links() {

    if( get_theme_mod('sparklestore_pro_social_link_activate', 1 ) == 1 ) { ?>
        <div class="social">
            <ul>
                <?php
                  $sparkle_social_icons = get_theme_mod('sparklestore_pro_social_icons', sparklestore_pro_default_social_link() );
                  if(!empty( $sparkle_social_icons )):
                  $sparkle_social_icons = json_decode($sparkle_social_icons);
                  foreach($sparkle_social_icons as $icon): if( !$icon->enable) continue; 
                ?>
                    <li>
                        <a href="<?php echo esc_url($icon->link); ?>" <?php if( $icon->new_tab ) echo 'target="_blank"'; ?>>
                            <i class="<?php echo esc_attr($icon->icon); ?>"></i>
                        </a>
                    </li>
                <?php endforeach; endif; ?>
            </ul>
        </div>
    <?php }
  }
}
add_filter( 'sparklestore_pro_social_links', 'sparklestore_pro_social_links', 5 );

/**
 * Sparkle Store payment logo section
*/
if( ! function_exists( 'sparklestore_pro_payment_logo_image' ) ){

  function sparklestore_pro_payment_logo_image(){

    return json_encode( array(
      array(
        'image' => get_template_directory_uri().'/assets/images/payment-logo.png',
        'enable' => 'on'
      )
    ));
  }
}

if ( ! function_exists( 'sparklestore_pro_payment_logo' ) ) {

  function sparklestore_pro_payment_logo() {

        $sparklestore_pro_paymentlogo_images = get_theme_mod('sparklestore_pro_paymentlogo_images', sparklestore_pro_payment_logo_image() );

        if( !empty($sparklestore_pro_paymentlogo_images)):

          $sparklestore_pro_paymentlogo_images = json_decode($sparklestore_pro_paymentlogo_images);
      ?>
        <div class="payment-accept">
            <?php foreach($sparklestore_pro_paymentlogo_images as $image):
              if( $image->enable  =='off')  continue; ?>
              <?php if( !empty( $image->image ) ) : ?>
                <img src="<?php echo esc_url($image->image)?>" />
              <?php endif; ?>
            <?php endforeach; ?>
        </div>
      <?php
      endif;
  }
}
add_filter( 'sparklestore_pro_payment_logo', 'sparklestore_pro_payment_logo', 10 );



if ( ! function_exists( 'sparklestore_pro_footer_copyright' ) ){

  /**
   * Footer Copyright Information
   *
   * @since 1.0.0
   */
  function sparklestore_pro_footer_copyright() {

      $copyright = get_theme_mod( 'sparklestore_pro_copyright' ); 
      
      if( !empty( $copyright ) ) { 
          echo ( apply_filters( 'sparklestore_pro_copyright_text', $copyright ) ); 
      } else { 
          echo esc_html( apply_filters( 'sparklestore_pro_copyright_text', $content = esc_html__('&copy; ','sparklestore-pro') . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) .' - ' ) );
          printf( ' WordPress Theme - by %1$s', '<a href=" ' . esc_url('https://sparklewpthemes.com/') . ' " rel="designer" target="_blank">'.esc_html__('Sparkle Themes','sparklestore-pro').'</a>' );
      }

  }
}
add_action( 'sparklestore_pro_footer_copyright', 'sparklestore_pro_footer_copyright', 5 );

/** sub footer menu options */
if(!function_exists('sparklestore_pro_sub_footer_menu')){
  function sparklestore_pro_sub_footer_menu(){
    $option = get_theme_mod('sparklestore_pro_sub_footer_option', 'menu');
    if( $option == 'menu'):
      wp_nav_menu( array( 'theme_location' => 'sparklefootermenu', 'depth' => 1 ) );
    elseif( $option == 'socialicon'):
      apply_filters( 'sparklestore_pro_social_links', 5 );
    elseif( $option == 'paymentlogo'):
        do_action('sparklestore_pro_payment_logo');
    endif;
  }
}
add_action( 'sparklestore_pro_sub_footer_menu', 'sparklestore_pro_sub_footer_menu', 5 );

/**
 * SparkleStore Footer Service Function Area
*/
if ( ! function_exists( 'sparklestore_pro_service_footer_section' ) ) {

  function sparklestore_pro_service_footer_section() {

      $service_area = esc_attr( get_theme_mod( 'sparklestore_pro_services_area_footer_settings', 'off' ) );
      
      $service_layout = esc_attr( get_theme_mod( 'sparklestore_pro_services_footer_layout', 'layout-two' ) );

      if(!empty($service_area) && $service_area == 'off') { ?>
        
        <div class="footerservices services_wrapper <?php echo esc_attr( $service_layout ); ?>">
            <div class="container">
                <div class="services_area">
                    <?php 
                      $services = get_theme_mod('sparklestore_pro_services_footer_loop');

                      if( !empty($services)): 

                          $services = json_decode($services);

                          foreach($services as $service): if($service->enable == 'off') continue; 
                    ?>
                          <div class="services_item">
                              <?php if( !empty( $service->icon ) ){ ?>
                                <div class="services_icon">
                                    <span class="<?php echo esc_attr($service->icon); ?>"></span>
                                </div>
                              <?php } ?>

                              <div class="services_content">
                                  <h3><?php echo force_balance_tags($service->title); ?></h3>
                                  <div><?php echo force_balance_tags($service->description ); ?></div>
                              </div>
                          </div>

                    <?php endforeach; endif; ?>
                </div>
            </div>
        </div>

      <?php  }
  }
}
add_action('sparklestore_pro_services_footer_area','sparklestore_pro_service_footer_section', 5);


/**
 * Custom Control for Customizer Page Layout Settings
*/
if( class_exists( 'WP_Customize_control') ) {

    /**
     * Radio Button Layout Control
    */
    class Sparklestore_Image_Radio_Control extends WP_Customize_Control {
        public $type = 'radioimage';
        public function render_content() {
            $name = '_customize-radio-' . $this->id;
            ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <div id="input_<?php echo $this->id; ?>" class="sparklestoreimage">
                <?php foreach ( $this->choices as $value => $label ) : ?>
                        <label for="<?php echo esc_attr( $this->id . $value ); ?>">
                            <input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $this->id . $value ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
                            <img src="<?php echo esc_html( $label ); ?>"/>
                        </label>
                <?php endforeach; ?>
            </div>
            <?php
        }
    }

    class Sparklestore_Repeater_Controler extends WP_Customize_Control {
      /**
       * The control type.
       *
       * @access public
       * @var string
      */
      public $type = 'repeater';

      public $sparklestore_pro_box_label = '';

      public $sparklestore_pro_box_add_control = '';

      private $cats = '';

      /**
       * The fields that each container row will contain.
       *
       * @access public
       * @var array
      */
      public $fields = array();

      /**
       * Repeater drag and drop controler
       *
       * @since  1.0.0
      */
      public function __construct( $manager, $id, $args = array(), $fields = array() ) {
        $this->fields = $fields;
        $this->sparklestore_pro_box_label = $args['sparklestore_pro_box_label'] ;
        $this->sparklestore_pro_box_add_control = $args['sparklestore_pro_box_add_control'];
        $this->cats = get_categories(array( 'hide_empty' => false ));
        parent::__construct( $manager, $id, $args );
      }

      public function render_content() {
        $values = json_decode($this->value());
        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php if($this->description){ ?>
          <span class="description customize-control-description">
          <?php echo wp_kses_post($this->description); ?>
          </span>
        <?php } ?>

        <ul class="sparklestore-repeater-field-control-wrap">
          <?php $this->sparklestore_pro_get_fields(); ?>
        </ul>
        <input type="hidden" <?php esc_attr( $this->link() ); ?> class="sparklestore-repeater-collector" value="<?php echo esc_attr( $this->value() ); ?>" />
        <button type="button" class="button sparklestore-add-control-field"><?php echo esc_html( $this->sparklestore_pro_box_add_control ); ?></button>
        <?php
      }

      private function sparklestore_pro_get_fields(){
        $fields = $this->fields;
        $values = json_decode($this->value());
        if(is_array($values)){
        foreach($values as $value){    ?>
          <li class="sparklestore-repeater-field-control">
            <h3 class="sparklestore-repeater-field-title accordion-section-title"><?php echo esc_html( $this->sparklestore_pro_box_label ); ?></h3>
            <div class="sparklestore-repeater-fields">
              <?php
                foreach ($fields as $key => $field) {
                $class = isset($field['class']) ? $field['class'] : '';
              ?>
                <div class="sparklestore-fields sparklestore-type-<?php echo esc_attr($field['type']).' '.esc_attr( $class ); ?>">
                  <?php
                    $label = isset($field['label']) ? $field['label'] : '';
                    $description = isset($field['description']) ? $field['description'] : '';
                    if($field['type'] != 'checkbox'){ ?>
                      <span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
                      <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
                  <?php }

                    $new_value = isset($value->$key) ? $value->$key : '';
                    $default = isset($field['default']) ? $field['default'] : '';

                    switch ($field['type']) {
                      case 'text':
                        echo '<input data-default="'.esc_attr($default).'" data-name="'.esc_attr($key).'" type="text" value="'.esc_attr($new_value).'"/>';
                        break;

                      case 'textarea':
                        echo '<textarea data-default="'.esc_attr($default).'"  data-name="'.esc_attr($key).'">'.esc_textarea($new_value).'</textarea>';
                        break;

                      case 'select':
                        $options = $field['options'];
                        echo '<select  data-default="'.esc_attr($default).'"  data-name="'.esc_attr($key).'">';
                              foreach ( $options as $option => $val )
                              {
                                  printf('<option value="%s" %s>%s</option>', esc_attr($option), selected($new_value, $option, false), esc_html($val));
                              }
                        echo '</select>';
                        break;

                        case 'upload':
                          $image = $image_class= "";
                          if($new_value){
                            $image = '<img src="'.esc_url($new_value).'" style="max-width:100%;"/>';
                            $image_class = ' hidden';
                          }
                          echo '<div class="sparklestore-fields-wrap">';
                          echo '<div class="attachment-media-view">';
                          echo '<div class="placeholder'.esc_attr( $image_class ).'">';
                          esc_html_e('No image selected', 'sparklestore-pro');
                          echo '</div>';
                          echo '<div class="thumbnail thumbnail-image">';
                          echo $image;
                          echo '</div>';
                          echo '<div class="actions clearfix">';
                          echo '<button type="button" class="button sparklestore-delete-button align-left">'.esc_html__('Remove', 'sparklestore-pro').'</button>';
                          echo '<button type="button" class="button sparklestore-upload-button alignright">'.esc_html__('Select Image', 'sparklestore-pro').'</button>';
                          echo '<input data-default="'.esc_attr( $default ).'" class="upload-id" data-name="'.esc_attr( $key ).'" type="hidden" value="'.esc_attr($new_value).'"/>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                          break;

                      default:
                        break;
                    }
                  ?>
                </div>
              <?php } ?>
              <div class="clearfix sparklestore-repeater-footer">
                <div class="alignright">
                  <a class="sparklestore-repeater-field-remove" href="#remove"><?php esc_html_e('Delete', 'sparklestore-pro') ?></a> |
                  <a class="sparklestore-repeater-field-close" href="#close"><?php esc_html_e('Close', 'sparklestore-pro') ?></a>
                </div>
              </div>
            </div>
          </li>
        <?php }
        }
      }
    }

    /**
     * Important Link Information
    */
    class Sparklestore_theme_Info_Text extends WP_Customize_Control{
        public function render_content(){  ?>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>
            <?php if($this->description){ ?>
                <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php }
        }
    }

    /**
     * Demo Import
    */
    class Sparklestore_Pro_WP_Customize_Demo_Control extends WP_Customize_Control{            
        public function render_content() { ?>
            <label>
                <?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php endif; ?>
                <div class="">
                    <a href="#" id="demo_import"><?php esc_html_e('Import Demo','sparklestore-pro'); ?></a>
                    <div class=""></div>
                    <div class="import-message"><?php esc_html_e('Click on Import Demo button to import demo contents.','sparklestore-pro'); ?></div>
                </div>
            </label>
            <?php
        }
    }

}

/**
  * Convert hexdec color string to rgb(a) string 
*/
if ( ! function_exists( 'sparklestore_pro_hex2rgba' ) ) {
  function sparklestore_pro_hex2rgba($color, $opacity = false) { 
     $default = 'rgb(0,0,0)'; 
     if(empty($color))
              return $default;  
          if ($color[0] == '#' ) {
           $color = substr( $color, 1 );
          }
          if (strlen($color) == 6) {
                  $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
          } elseif ( strlen( $color ) == 3 ) {
                  $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
          } else {
                  return $default;
          }
          $rgb =  array_map('hexdec', $hex);
          if($opacity){
           if(abs($opacity) > 1)
           $opacity = 1.0;
           $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
          } else {
           $output = 'rgb('.implode(",",$rgb).')';
          }
          return $output;
  }
}

/**
 * Sparklestore_breadcrumbs
*/
if ( ! function_exists( 'sparklestore_pro_breadcrumbs' ) ) {

    function sparklestore_pro_breadcrumbs(){

      global $post;
      if( !$post ) return;
      $breadcrumb_noraml_options  = get_theme_mod('sparklestore_pro_normal_page_enable_disable_section', 'on');
      $breadcrumb_normal_bg_image = get_theme_mod('sparklestore_pro_breadcrumbs_normal_page_background_image');
      $breadcrumb_hide_menu       = get_theme_mod('sparklestore_pro_normal_page_breadcrumb_hide_menu', 'off');
      $breadcrumb_hide_title      = get_theme_mod('sparklestore_pro_normal_page_breadcrumb_hide_title', 'off');
      
      $breadcrumb_page_image = '';
      if( $post ) $breadcrumb_page_image = get_post_meta( $post->ID, 'sparklestore_pro_bread_bg_image', true );

      $bg_image_item = '';
      if(!empty( $breadcrumb_page_image ) ){
          $bg_image_item = "withimage";
          $breadcrumb_normal_bg_image = $breadcrumb_page_image;

      }elseif($breadcrumb_normal_bg_image){
          $breadcrumb_normal_bg_image = $breadcrumb_normal_bg_image;
          $bg_image_item = "withimage";


      }

      $breadcrumb_layout = get_theme_mod('sparklestore_pro_breadcrumb_layout', "boxed");
      $breadcrumb_alighment = get_theme_mod('sparklestore_pro_breadcrumb_alignment', "text-left");
      
      $hide_titlebar = rwmb_meta('hide_breadcrumb', $post->ID);
      
      
      if($breadcrumb_noraml_options == 'on' && $hide_titlebar == 0) { 

          if($breadcrumb_layout == 'fullwidth') { 
      ?>
            <div class="breadcrumbs-wrap <?php echo esc_attr( $bg_image_item ) .' '. esc_attr( $breadcrumb_alighment ); ?>">
                <div class="breadcrumbs-wrap-overlay"></div>
                <div class="container">
                    <?php
                      if($breadcrumb_hide_title == 'off'){ 
                        if( is_archive() || is_category() ) {
                            
                            the_archive_title( '<h2 class="entry-title">', '</h2>' );
                      
                        }elseif( is_search() ){ ?>
                            
                            <h2 class="entry-title"><?php printf( esc_html__( 'Search Results for : %s', 'sparklestore-pro' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
                        
                        <?php }elseif( is_404() ){ ?>
                          
                            <h2 class="entry-title"><?php echo esc_html__('404','sparklestore-pro'); ?></h2>
                        
                        <?php }else{
                            
                              the_title( '<h2 class="entry-title">', '</h2>' );
                            
                        }
                      }

                        if($breadcrumb_hide_menu == 'off'){ 
                            
                            breadcrumb_trail( array(
                                'container'   => 'div',
                                'show_browse' => false,
                            ) );
                        } 
                    ?>
                </div>
            </div>

        <?php }else{ ?>

            <div class="container">
              <div class="breadcrumbs-wrap <?php echo esc_attr( $bg_image_item ) .' '. esc_attr( $breadcrumb_alighment ); ?>">
                  <?php 
                    if($breadcrumb_hide_title == 'off'){ 
                      if( is_archive() || is_category() ) {
                          
                          the_archive_title( '<h2 class="entry-title">', '</h2>' );
                    
                      }elseif( is_search() ){ ?>
                          
                          <h2 class="entry-title"><?php printf( esc_html__( 'Search Results for : %s', 'sparklestore-pro' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
                      
                      <?php }elseif( is_404() ){ ?>
                        
                          <h2 class="entry-title"><?php echo esc_html__('404','sparklestore-pro'); ?></h2>
                      
                      <?php }else{

                          the_title( '<h2 class="entry-title">', '</h2>' );
                      }
                    }
                    if($breadcrumb_hide_menu == 'off'){ 
                        
                        breadcrumb_trail( array(
                            'container'   => 'div',
                            'show_browse' => false,
                        ) );
                    } 
                  ?>
              </div>
            </div>
      <?php } }
    }
}
add_action( 'sparklestore-breadcrumbs', 'sparklestore_pro_breadcrumbs' );


/**
 * WooCommerce product and product single apge breadcrumbs
*/
if ( ! function_exists( 'sparklestore_pro_breadcrumb_woocommerce' ) ) {

    function sparklestore_pro_breadcrumb_woocommerce(){
      // if( is_product() ) return;
      $breadcrumb_options  = esc_attr( get_theme_mod('sparklestore_pro_normal_page_enable_disable_section', 'on') );
      $breadcrumb_hide_menu = esc_attr( get_theme_mod('sparklestore_pro_normal_page_breadcrumb_hide_title', 'off') );
      $breadcrumb_hide_title = esc_attr( get_theme_mod('sparklestore_pro_normal_page_breadcrumb_hide_title', 'off') );

      $bg_image_item = '';
      
      $breadcrumb_layout = get_theme_mod('sparklestore_pro_breadcrumb_layout', "boxed");
      $breadcrumb_alighment = get_theme_mod('sparklestore_pro_breadcrumb_alignment', "text-left");


      if($breadcrumb_options == 'on') { 
        
        if($breadcrumb_layout == 'fullwidth') {
      
      ?>
        <div class="breadcrumbs-wrap woocommerce <?php echo esc_attr( $breadcrumb_alighment ); ?>">
            <div class="breadcrumbs-wrap-overlay"></div>
            <?php if( get_theme_mod('sparklestore_pro_product_page_breadcrumb_position', 'inside') == 'inside'): ?>
              <div class="container">
                <div class="site-itle-wrap">
                  <?php 
                    if($breadcrumb_hide_title == 'off'){ 
                      if( is_product() ) {

                          the_title( '<h2 class="entry-title">', '</h2>' );

                      }elseif( is_search() ){ ?>

                            <h2 class="entry-title"><?php printf( esc_html__( 'Search Results for : %s', 'sparklestore-pro' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
                      
                      <?php }else{ ?>

                          <h2 class="entry-title"><?php woocommerce_page_title(); ?></h2>

                      <?php }
                    } 

                    if($breadcrumb_hide_menu == 'off'){ 

                      breadcrumb_trail( array(
                        'container'   => 'div',
                        'show_browse' => false,
                      ) );
                    }
                  ?>
                </div>
                <?php if( is_product() && get_theme_mod('sparklestore_pro_single_product_next_previous', true ) ) sparkletheme_product_next_prev_nav(); ?>
              <?php endif; ?>
            </div>
        </div>

      <?php }else{ ?>
        
        <div class="container">
            <div class="breadcrumbs-wrap woocommerce <?php echo esc_attr( $bg_image_item ) .' '. esc_attr( $breadcrumb_alighment ); ?>">
                <?php
                  if($breadcrumb_hide_title == 'off'){  
                    if( is_product() ) {

                        the_title( '<h2 class="entry-title">', '</h2>' );

                    }elseif( is_search() ){ ?>

                          <h2 class="entry-title"><?php printf( esc_html__( 'Search Results for : %s', 'sparklestore-pro' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
                    
                    <?php }else{ ?>

                        <h2 class="entry-title"><?php woocommerce_page_title(); ?></h2>

                    <?php } 
                  }
                  if($breadcrumb_hide_menu == 'off'){ 

                    breadcrumb_trail( array(
                      'container'   => 'div',
                      'show_browse' => false,
                    ) );
                  }
                ?>
            </div>
        </div>

    <?php } }
    }
}
add_action( 'breadcrumb-woocommerce', 'sparklestore_pro_breadcrumb_woocommerce' );


function sparklestore_pro_gdpr_notice() {
  $enable_notice = get_theme_mod('sparklestore_pro_enable_gdpr', 'off');
  $customizer_gdpr_settings = of_get_option('customizer_gdpr_settings', '1');
  if ($customizer_gdpr_settings && ($enable_notice == 'on' || is_customize_preview())) {
      $policy_class = array('sparklestore-pro-privacy-policy');
      $sparklestore_pro_gdpr_notice = get_theme_mod('sparklestore_pro_gdpr_notice', esc_html__('Our website use cookies to improve and personalize your experience and to display advertisements(if any). Our website may also include cookies from third parties like Google Adsense, Google Analytics, Youtube. By using the website, you consent to the use of cookies. We’ve updated our Privacy Policy. Please click on the button to check our Privacy Policy.', 'sparklestore-pro'));
      $sparklestore_pro_gdpr_button_text = get_theme_mod('sparklestore_pro_gdpr_button_text', __('Privacy Policy', 'sparklestore-pro'));
      $sparklestore_pro_gdpr_button_link = get_theme_mod('sparklestore_pro_gdpr_button_link');
      $policy_class[] = get_theme_mod('sparklestore_pro_gdpr_position', 'bottom-full-width');
      $confirm_button = get_theme_mod('sparklestore_pro_gdpr_confirm_button_text', __('Ok, I Agree', 'sparklestore-pro'));
      $sparklestore_pro_gdpr_new_tab = get_theme_mod('sparklestore_pro_gdpr_new_tab', true);
      $hide_in_mobile = get_theme_mod('sparklestore_pro_gdpr_hide_mobile', false);
      $new_tab = $sparklestore_pro_gdpr_new_tab ? 'target="_blank"' : '';
      $policy_class[] = $hide_in_mobile ? 'policy-hide-mobile' : '';
      ?>
      <div class="<?php echo esc_attr(implode(' ', $policy_class)); ?>">
          <div class="container">
              <div class="policy-text">
                  <?php echo wp_kses_post($sparklestore_pro_gdpr_notice) ?>
              </div>

              <div class="policy-buttons">
                  <a id="sparklestore-pro-confirm" href="#"><?php echo esc_html($confirm_button); ?></a>
                  <?php if ($sparklestore_pro_gdpr_button_link) { ?>
                      <a href="<?php echo esc_url($sparklestore_pro_gdpr_button_link); ?>" <?php echo esc_attr($new_tab); ?>><?php echo esc_html($sparklestore_pro_gdpr_button_text); ?></a>
                  <?php } ?>
              </div>
          </div>
      </div>
      <?php
  }
}
add_action('sparklestore_pro_before_page', 'sparklestore_pro_gdpr_notice');

function sparklestore_pro_login_logo() {
  $admin_logo = get_theme_mod('sparklestore_pro_admin_logo');
  $admin_bg = get_theme_mod('sparklestore_pro_admin_bg');
  $width      = get_theme_mod('sparklestore_pro_admin_logo_width', 180);
  $height     = get_theme_mod('sparklestore_pro_admin_logo_height', 80);
  if ($admin_logo) {
      ?> 
      <style type="text/css"> 
          body.login div#login h1 a {
              background-image: url(<?php echo esc_url($admin_logo); ?>); 
              width: <?php echo absint($width) ?>px;
              height: <?php echo absint($height) ?>px;
              background-size: contain;
          }
          body.login form[name=loginform]{
            border-radius:15px;
          }
          <?php if( $admin_bg ): ?>
          body.login{
            background-image: url(<?php echo esc_url($admin_bg); ?>); 
            background-size: cover;
          }
          
        <?php endif; ?>

      </style>
      <?php
  }
}

add_action('login_enqueue_scripts', 'sparklestore_pro_login_logo');

function sparklestore_pro_login_link() {
  $admin_logo_link = get_theme_mod('sparklestore_pro_admin_logo_link');
  if ($admin_logo_link) {
      return $admin_logo_link;
  }
}
add_filter('login_headerurl', 'sparklestore_pro_login_link');




/** section top seprator */
function sparklestore_pro_add_top_seperator($section_name) {
  $section_seperator = get_theme_mod("sparklestore_pro_{$section_name}_section_seperator", "no");
  if ($section_seperator == 'top' || $section_seperator == 'top-bottom') {
      $top_seperator = get_theme_mod("sparklestore_pro_{$section_name}_top_seperator", 'big-triangle-center');
      echo '<div class="ht-section-seperator top-section-seperator svg-' . $top_seperator . '-wrap">';
      get_template_part("inc/svg/{$top_seperator}");
      echo '</div>';
  }
}
/** section bottom seprator */
function sparklestore_pro_add_bottom_seperator($bottom_seperator) {
  if ( $bottom_seperator != 'none' ) {
      echo '<div class="svg-seperator bottom-section-seperator svg-' . $bottom_seperator . '-wrap">';
      get_template_part("inc/svg/{$bottom_seperator}");
      echo '</div>';
  }
}

/** slider bottom seprator */
function sparklestore_pro_add_slider_bottom_section_seperator() {
  $bottom_seperator = get_theme_mod("sparklestore_pro_slider_bottom_seperator", 'none');

  if ($bottom_seperator != 'none') {
      echo '<div class="svg-seperator bottom-section-seperator svg-' . $bottom_seperator . '-wrap">';
      get_template_part("inc/svg/{$bottom_seperator}");
      echo '</div>';
  }
}

add_action("after_slider_section", "sparklestore_pro_add_slider_bottom_section_seperator");



/** background image or video section */
function sparklestore_pro_parallax_background($section_name = '') {
  $bg_type = get_theme_mod("sparklestore_pro_{$section_name}_bg_type");
  $bg_image = get_theme_mod("sparklestore_pro_{$section_name}_bg_image_url");
  $bg_video = get_theme_mod("sparklestore_pro_{$section_name}_bg_video", '6O9Nd1RSZSY');
  $parallax_mode = '';
  
  if ($bg_type == "image-bg" && !empty($bg_image)) {
      $parallax_effect = get_theme_mod("sparklestore_pro_{$section_name}_parallax_effect");
      if ($parallax_effect == 'parallax') {
          $parallax_mode = 'data-stellar-background-ratio="0.5"';
      } elseif ($parallax_effect == 'scroll') {
          $parallax_mode = 'data-motion="true"';
      }
  } elseif ($bg_type == "video-bg" && !empty($bg_video)) {
      $parallax_mode = 'data-property="{videoURL:\'' . $bg_video . '\', mobileFallbackImage:\'https://img.youtube.com/vi/' . $bg_video . '/maxresdefault.jpg\'}"';
  }

  return $parallax_mode;
}

if ( ! function_exists( 'sparklestore_pro_section_title' ) ){
  /**
   * Section title block
   *
   * @since 1.0.0
   */
  function sparklestore_pro_section_title($title, $sub_title, $title_style = 'none' ) { 
      if( $title_style == 'none') return;
      
      if( !empty( $title ) || !empty( $sub_title ) ){ ?>
        <div class="blocktitlewrap <?php echo esc_attr( $title_style ); ?>">
          <div class="section-title-wrapper">
              <?php if( !empty( $title ) ){ ?>

                  <div class="section-title-wrap">
                      <h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
                  </div>

              <?php } if( !empty( $sub_title ) ){ ?>
                  <div class="section-tagline-text section-tagline">
                      <p><?php echo esc_html( $sub_title ); ?></p>
                  </div>

              <?php } ?>
          </div>
        </div>
      <?php }
  }
}


if( !function_exists('sparkle_themes_widget_dynamic_style')){

  function sparkle_themes_widget_dynamic_style($instance, $wrapper_class=".seection-wrap", $extra_style = '' ){
    
    /** style field */
    $title_color      = empty( $instance['sparklestore_pro_title_color']) ? '' : $instance['sparklestore_pro_title_color'];
    $text_color       = empty( $instance['sparklestore_pro_text_color']) ? '' : $instance['sparklestore_pro_text_color'];
    $bg_color         = empty( $instance['sparklestore_pro_bg_color']) ? '' : $instance['sparklestore_pro_bg_color'];
    $bg_image         = empty( $instance['sparklestore_pro_bg_image']) ? '' : $instance['sparklestore_pro_bg_image'];
    $overlay_color    = empty( $instance['sparklestore_pro_overlay_color']) ? '' : $instance['sparklestore_pro_overlay_color'];

    $bottom_seprator  = empty( $instance['sparklestore_pro_bottom_seprator']) ? '' : $instance['sparklestore_pro_bottom_seprator'];
    
    $seprator_height  = empty( $instance['sparklestore_pro_seprator_height']) ? '' : $instance['sparklestore_pro_seprator_height'];
    $bottom_seprator_color = empty( $instance['sparklestore_pro_bottom_seprator_color']) ? '' : $instance['sparklestore_pro_bottom_seprator_color'];
    $padding_top      = empty( $instance['sparklestore_pro_padding_top']) ? '' : $instance['sparklestore_pro_padding_top'];
    $padding_bottom   = empty( $instance['sparklestore_pro_padding_bottom']) ? '' : $instance['sparklestore_pro_padding_bottom'];


    $title_style = $text_style = $wrap_style = $seprator = '';
    $wrap_css =  array();

    $dynamic_style = "";
    if (!empty($title_color)) {
        $dynamic_style .= "$wrapper_class .sp-section-title, $wrapper_class .section-title {color: $title_color }";
    }

    if (!empty($text_color)) {
        $dynamic_style .= "$wrapper_class .sp-section-tagline-text, $wrapper_class .section-tagline {color: $text_color }";
    }

    if (!empty($bg_color)) {
        $wrap_css[] = "background-color:$bg_color";
    }

    if (!empty($bg_image)) {
        $wrap_css[] = "background-image:url($bg_image)";
        $wrap_css[] = "background-size: cover; background-repeat: no-repeat;";
        $wrap_css[] = "position: relative;";
    }

    if (!empty($padding_top) || !empty($padding_top)) {
        $wrap_css[] = "padding-top:" . $padding_top . "px";
        $wrap_css[] = "padding-bottom:" . $padding_bottom . "px";
    }

    // $wrapper_class = '.productlist-wrap';
    
    if (!empty($wrap_css)) {
        $dynamic_style .= "$wrapper_class {" .implode(';', $wrap_css) ." }";
    }


    if (!empty($bottom_seprator)) {
        $dynamic_style .= "$wrapper_class .bottom-section-seperator svg {
            height: {$seprator_height}px;
            fill: {$bottom_seprator_color};
        }";
    }

    $dynamic_style .= $extra_style;
    
    if (!empty($overlay_color)) {
      
        $dynamic_style .="$wrapper_class.section-wrap:before {
                          background: $overlay_color;
                          height: 100%;
                          width: 100%;
                          position: absolute;
                          top: 0;
                          content: \"\";
                      }";
    }

    echo "<style>

        $dynamic_style

    </style>";
  }
}

if( !function_exists('sparklestore_pro_product_tabs_classes')){

  function sparklestore_pro_product_tabs_classes(){

      $classes = array('nav','nav-uppercase');

      $tab_style = get_theme_mod('sparklestore_pro_woo_product_tab_style','tabs');
      
      if($tab_style == 'tabs' || !$tab_style){

          $classes[] = 'nav-line';

      } else{

          $tab_style = str_replace("tabs_","",$tab_style);

          if($tab_style == 'vertical') $classes[] = 'nav-line';

          if($tab_style == 'normal') $classes[] = 'nav-tabs';

          $classes[] = 'nav-'.$tab_style;
      }

      echo implode(' ', $classes);
  }
}


/** 
 * ajax search 
 */
add_action('init', 'sparkle_themes_ajax_without_login_init');

function sparkle_themes_ajax_without_login_init(){
  add_action('wp_ajax_sparklestore_pro_search_data_fetch' , 'sparklestore_pro_search_data_fetch');
  add_action( 'wp_ajax_nopriv_sparklestore_pro_search_data_fetch', 'sparklestore_pro_search_data_fetch' );
}
function sparklestore_pro_search_data_fetch(){

  $the_query = new WP_Query( array( 'posts_per_page' => -1, 's' => esc_attr( $_POST['keyword'] ), 'sentence' => true, 'exact' => false) );
  
  if( $the_query->have_posts() ) :

      while( $the_query->have_posts() ): $the_query->the_post(); ?>

          <p><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title();?></a></p>

      <?php endwhile;

      wp_reset_postdata();  

  else:

      echo "<h4>Oops, Nothing found!!!</h4>";
      
  endif;

  die();
}




/** maintenance mode enable disable hook */
function sparklestore_pro_maintenance_mode() {
  global $pagenow;
  $sparklestore_pro_maintenance = get_theme_mod('sparklestore_pro_maintenance', 'off');
  $customizer_maintenance_mode = of_get_option('customizer_maintenance_mode', '1');

  if ($customizer_maintenance_mode && $sparklestore_pro_maintenance == 'on' && $pagenow !== 'wp-login.php' && !current_user_can('manage_options') && !is_admin()) {
      if (file_exists(get_template_directory() . '/inc/maintenance.php')) {
          require_once get_template_directory() . '/inc/maintenance.php';
      }
      die();
  }
}

add_action('wp_loaded', 'sparklestore_pro_maintenance_mode');



/** uplaod default image */
add_action( 'after_switch_theme', 'sparklestore_pro_upload_default_image' );

if( !function_exists('sparklestore_pro_upload_default_image')){
  function sparklestore_pro_upload_default_image(){
    $image_url = get_template_directory_uri(). "/assets/images/default-placeholder.png";

    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents( $image_url );
    $filename = basename( $image_url );

    // $file = get_template_directory(  ). "/assets/images/default-placeholder.png";

    if ( wp_mkdir_p( $upload_dir['path'] ) ) {
      $file = $upload_dir['path'] . '/' . $filename;
    }
    else {
      $file = $upload_dir['basedir'] . '/' . $filename;
    }

    @file_put_contents( $file, $image_data );

    $wp_filetype = wp_check_filetype( $filename, null );
      
    $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title' => sanitize_file_name( $filename ),
      'post_content' => '',
      'post_status' => 'inherit'
    );

    $attach_id = wp_insert_attachment( $attachment, $file );
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    wp_update_attachment_metadata( $attach_id, $attach_data );

    set_theme_mod(  'sparklestore_pro_default_image', $image_url );
    set_theme_mod(  'sparklestore_pro_default_image_id', $attach_id );
  }
}


if(!function_exists('sparkle_store_polylang_switcher')){
  function sparkle_store_polylang_switcher(){
    if( function_exists('pll_the_languages')){ 
        $translations = pll_the_languages( array( 'raw' => 1 ) );
        
        function invenDescSort($item1,$item2)
        {
            if ($item1['current_lang'] == $item2['current_lang']) return 0;
            return ($item1['current_lang'] < $item2['current_lang']) ? 1 : -1;
        }
        usort($translations,'invenDescSort');
        
      ?>


        <!-- not tested in mobiles -->

        <div id="image-dropdown" onmouseleave="hideee();">
          <?php foreach($translations as $t)  :?>
          <div class="img_holder" onclick="myfuunc(this);" onmouseover="showww();" <?php if( $t['current_lang'] ): ?> data-current="<?php esc_attr_e($t['current_lang']);?>" <?php endif; ?>>
              <img class="flagimgs" src="<?php echo esc_url($t['flag']); ?>" alt="<?php echo esc_attr($t['name']); ?>" />
              <span class="iTEXT" data-url="<?php echo esc_url($t['url']); ?>"><?php echo esc_attr($t['name']); ?></span>
            </div>
          <?php endforeach; ?>
         
        </div>

      <style>

        #image-dropdown {
          display: inline-block;
          border: 1px solid;
        }
        #image-dropdown {
          height: 30px;
          overflow: hidden;
        }
        /*#image-dropdown:hover {} */

        #image-dropdown .img_holder {
          cursor: pointer;
        }
        #image-dropdown img.flagimgs {
          /* height: 30px; */
        }
        #image-dropdown span.iTEXT {
          position: relative;
        }

    
      </style>


      <script>
        var shownnn = "yes";
        var dropd = document.getElementById("image-dropdown");

        function showww() {
          dropd.style.height = "auto";
          dropd.style.overflow = "y-scroll";
        }

        function hideee() {
            dropd.style.height = "30px";
            dropd.style.overflow = "hidden";
          }
          //dropd.addEventListener('mouseover', showOrHide, false);
          //dropd.addEventListener('click',showOrHide , false);


        function myfuunc(imgParent) {
          hideee();
          var mainDIVV = document.getElementById("image-dropdown");
          imgParent.parentNode.removeChild(imgParent);
          mainDIVV.insertBefore(imgParent, mainDIVV.childNodes[0]);
          window.location.href = imgParent.childNodes[3].getAttribute("data-url");
        }
      </script>

      <?php

    }
  }

  add_action( "polylang_switcher", 'sparkle_store_polylang_switcher' );
}

if ( ! function_exists( 'sparklewp_not_empty' ) ) {
	/**
	 * sparklewp_not_empty
	 * @param $var
	 * @return bool
	 */
	function sparklewp_not_empty( $var ) {
		if ( trim( $var ) === '' ) {
			return false;
		}
		return true;
	}
}

if ( ! function_exists( 'sparklewp_responsive_button_value' ) ) {

	/**
	 * sparklewp_responsive_button_value
	 * @param  array  $button_group
	 * @param  string $device
	 * @return string
	 */
	function sparklewp_responsive_button_value( $button_group, $device ) {

		$button_val = '';
		if ( ! is_array( $button_group ) ) {
			return false;
		}
		foreach ( $button_group as $device_data => $value ) {

			switch ( $device_data ) {

				case 'desktop':
					if ( 'desktop' == $device ) {
						if ( ! empty( $value ) ) {

							$button_val = $value . '-desktop';
						}
					}
					break;

				case 'tablet':
					if ( 'tablet' == $device ) {
						if ( ! empty( $value ) ) {
							$button_val = $value . '-tablet';
						}
					}
					break;

				case 'mobile':
					if ( 'mobile' == $device ) {
						if ( ! empty( $value ) ) {
							$button_val = $value . '-mobile';
						}
					}
					break;

				default:
					break;
			}
		}
		return $button_val;
	}
}

if ( ! function_exists( 'sparklewp_is_active_header' ) ) :

	/**
	 * sparklewp_is_active_header
	 * @return true
	 */
	function sparklewp_is_active_header() {
		return true;
	}
endif;


if ( ! function_exists( 'sparklewp_cssbox_values_inline' ) ) {

	/**
	 * sparklewp_cssbox_values_inline description
	 * @param  array  $position_collection
	 * @param  string $device
	 * @return string
	 */
	function sparklewp_cssbox_values_inline( $position_collection, $device ) {

		$inline_css = '';
		if ( ! is_array( $position_collection ) ) {
			return false;
		}
		foreach ( $position_collection as $device_data => $value ) {
      
			switch ( $device_data ) {

				case 'desktop':
					if ( 'desktop' == $device ) {

						$top    = ( isset( $value['top'] ) && sparklewp_not_empty( $value['top'] ) ) ? $value['top'] : '';
						$right  = ( isset( $value['right'] ) && sparklewp_not_empty( $value['right'] ) ) ? $value['right'] : '';
						$bottom = ( isset( $value['bottom'] ) && sparklewp_not_empty( $value['bottom'] ) ) ? $value['bottom'] : '';
						$left   = ( isset( $value['left'] ) && sparklewp_not_empty( $value['left'] ) ) ? $value['left'] : '';

						if ( sparklewp_not_empty( $top ) || sparklewp_not_empty( $right ) || sparklewp_not_empty( $bottom ) || sparklewp_not_empty( $left ) ) {
							$top        = ( sparklewp_not_empty( $top ) ) ? $top . 'px' : 0;
							$right      = ( sparklewp_not_empty( $right ) ) ? $right . 'px' : 0;
							$bottom     = ( sparklewp_not_empty( $bottom ) ) ? $bottom . 'px' : 0;
							$left       = ( sparklewp_not_empty( $left ) ) ? $left . 'px' : 0;
							$inline_css = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
						} else {
							$inline_css = '0';
						}
					}
					break;

				case 'tablet':
					if ( 'tablet' == $device ) {

						$top    = ( isset( $value['top'] ) && sparklewp_not_empty( $value['top'] ) ) ? $value['top'] : '';
						$right  = ( isset( $value['right'] ) && sparklewp_not_empty( $value['right'] ) ) ? $value['right'] : '';
						$bottom = ( isset( $value['bottom'] ) && sparklewp_not_empty( $value['bottom'] ) ) ? $value['bottom'] : '';
						$left   = ( isset( $value['left'] ) && sparklewp_not_empty( $value['left'] ) ) ? $value['left'] : '';

						if ( sparklewp_not_empty( $top ) || sparklewp_not_empty( $right ) || sparklewp_not_empty( $bottom ) || sparklewp_not_empty( $left ) ) {
							$top        = ( sparklewp_not_empty( $top ) ) ? $top . 'px' : 0;
							$right      = ( sparklewp_not_empty( $right ) ) ? $right . 'px' : 0;
							$bottom     = ( sparklewp_not_empty( $bottom ) ) ? $bottom . 'px' : 0;
							$left       = ( sparklewp_not_empty( $left ) ) ? $left . 'px' : 0;
							$inline_css = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
						} else {
							$inline_css = '0';
						}
					}
					break;

				case 'mobile':
					if ( 'mobile' == $device ) {

						$top    = ( isset( $value['top'] ) && sparklewp_not_empty( $value['top'] ) ) ? $value['top'] : '';
						$right  = ( isset( $value['right'] ) && sparklewp_not_empty( $value['right'] ) ) ? $value['right'] : '';
						$bottom = ( isset( $value['bottom'] ) && sparklewp_not_empty( $value['bottom'] ) ) ? $value['bottom'] : '';
						$left   = ( isset( $value['left'] ) && sparklewp_not_empty( $value['left'] ) ) ? $value['left'] : '';

						if ( sparklewp_not_empty( $top ) || sparklewp_not_empty( $right ) || sparklewp_not_empty( $bottom ) || sparklewp_not_empty( $left ) ) {
							$top        = ( sparklewp_not_empty( $top ) ) ? $top . 'px' : 0;
							$right      = ( sparklewp_not_empty( $right ) ) ? $right . 'px' : 0;
							$bottom     = ( sparklewp_not_empty( $bottom ) ) ? $bottom . 'px' : 0;
							$left       = ( sparklewp_not_empty( $left ) ) ? $left . 'px' : 0;
							$inline_css = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
						} else {
							$inline_css = '0';
						}
					}
					break;

				default:
					break;
			}
    }
		return $inline_css;
	}
}

if ( ! function_exists( 'sparklewp_boxshadow_values_inline' ) ) {

	/**
	 * sparklewp_boxshadow_values_inline description
	 * @param  array  $position_collection
	 * @param  string $device
	 * @return string
	 */
	function sparklewp_boxshadow_values_inline( $position_collection, $device ) {

		$inline_css = '';
		if ( ! is_array( $position_collection ) ) {
			return false;
		}
		foreach ( $position_collection as $device_data => $value ) {

			switch ( $device_data ) {

				case 'desktop':
					if ( 'desktop' == $device ) {

						$top    = $value['x'];
						$top    = ( ! empty( $top ) ) ? $top . 'px' : '0';
						$right  = $value['Y'];
						$right  = ( ! empty( $right ) ) ? $right . 'px' : '0';
						$bottom = $value['BLUR'];
						$bottom = ( ! empty( $bottom ) ) ? $bottom . 'px' : '0';
						$left   = $value['SPREAD'];
						$left   = ( ! empty( $left ) ) ? $left . 'px' : '0';
						$inset  = $value['cssbox_link'];
						$inset  = ( $inset ) ? 'inset' : '';

						$inline_css = $inset . ' ' . $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
					}
					break;

				case 'tablet':
					if ( 'tablet' == $device ) {

						$top    = $value['x'];
						$top    = ( ! empty( $top ) ) ? $top . 'px' : '0';
						$right  = $value['Y'];
						$right  = ( ! empty( $right ) ) ? $right . 'px' : '0';
						$bottom = $value['BLUR'];
						$bottom = ( ! empty( $bottom ) ) ? $bottom . 'px' : '0';
						$left   = $value['SPREAD'];
						$left   = ( ! empty( $left ) ) ? $left . 'px' : '0';
						$inset  = $value['cssbox_link'];
						$inset  = ( $inset ) ? 'inset' : '';

						$inline_css = $inset . ' ' . $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
					}
					break;

				case 'mobile':
					if ( 'mobile' == $device ) {

						$top    = $value['x'];
						$top    = ( ! empty( $top ) ) ? $top . 'px' : '0';
						$right  = $value['Y'];
						$right  = ( ! empty( $right ) ) ? $right . 'px' : '0';
						$bottom = $value['BLUR'];
						$bottom = ( ! empty( $bottom ) ) ? $bottom . 'px' : '0';
						$left   = $value['SPREAD'];
						$left   = ( ! empty( $left ) ) ? $left . 'px' : '0';
						$inset  = $value['cssbox_link'];
						$inset  = ( $inset ) ? 'inset' : '';

						$inline_css = $inset . ' ' . $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
					}
					break;

				default:
					break;
			}
		}
		return $inline_css;
	}
}
