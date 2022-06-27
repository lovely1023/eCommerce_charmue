<?php
/**
 * Template Name: FrontPage Template
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sparkle Store Pro
 */

get_header();

  /**
   * HomePage Template Top FullWidth Widget area
  */
  if ( is_active_sidebar( 'sparkletopwidgetarea' ) ) {

    dynamic_sidebar( 'sparkletopwidgetarea' );

  }

  /**
   * HomePage Template Main Widget area
  */
  // $page_layout = get_theme_mod( 'sparklestore_layout_sidebar', 'rightsidebar');
  // if(!$page_layout){
  //   $page_layout = 'rightsidebar';
  // }

$page_layout = rwmb_meta('sidebar_layout');
if( empty($page_layout) || $page_layout == 'default') $page_layout = get_theme_mod( 'sparklestore_layout_sidebar', 'rightsidebar');
  
?>
  <div class='container container-reset <?php echo esc_attr( $page_layout ); ?>'>
      <div class="site-wrapper homepagewrap">
          <?php if( $page_layout == 'leftsidebar'  && is_active_sidebar('sparklemainsidebar')){  ?>
              <aside id="secondary" class="widget-area" role="complementary">
                  <div class='homesidebarwidget'>
                      <?php dynamic_sidebar( 'sparklemainsidebar' ); ?>
                  </div>
              </aside><!-- #secondary -->
          <?php } ?>

          <div id="primary" class="content-area clearfix">
			        <main id="main" class="site-main" role="main">
                  <?php if ( is_active_sidebar( 'sparklemainwidgetarea' ) ) { ?>
                      <div class='homemainwidget'>
                          <?php dynamic_sidebar( 'sparklemainwidgetarea' ); ?>
                      </div>
                  <?php } ?>
              </main>
          </div>
            
          <?php if( $page_layout == 'rightsidebar' && is_active_sidebar('sparklemainsidebar')){  ?>
              <aside id="secondary" class="widget-area" role="complementary">
                  <div class='homesidebarwidget'>
                      <?php dynamic_sidebar( 'sparklemainsidebar' ); ?>
                  </div>
              </aside><!-- #secondary -->
          <?php } ?>
          
      </div>
  </div>

<?php

  /**
   * HomePage Template Buttom FullWidth Widget area
  */
  if ( is_active_sidebar( 'sparklebuttomwidgetarea' ) ) {

    dynamic_sidebar( 'sparklebuttomwidgetarea' );

  }

get_footer();
