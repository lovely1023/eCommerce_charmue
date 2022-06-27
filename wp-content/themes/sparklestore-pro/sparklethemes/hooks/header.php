<?php
if ( ! function_exists( 'sparklestore_pro_header_before' ) ) {
	/**
	 * Header Area
	 * @since  1.0.0
	 * @return void
	*/
	function sparklestore_pro_header_before() { 
	?>
		<header id="masthead" class="site-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader" role="banner">		
			<div class="header-container">
		<?php
	}
}
add_action( 'sparklestore_pro_header_before', 'sparklestore_pro_header_before', 10 );


/**
 * Top Header News Ticker Area / top notice bar
*/
if ( ! function_exists( 'sparklestore_pro_top_header_top_notice_bar' ) ) {

	function sparklestore_pro_top_header_top_notice_bar() {

		$newsticker = get_theme_mod( 'sparklestore_pro_notice_bar_options','on' );
		if($newsticker == 'off'){	
			?>
		
		    <div class="top-notice-bar clearfix">
				<div class="notice-bar">
					<?php 
						/**
							* News Ticker
						*/ 
						do_action('sparklestore_top_notice_bar');
					?>
				</div>
		    </div>
    	<?php }
	}
}
add_action( 'sparklestore_pro_header', 'sparklestore_pro_top_header_top_notice_bar', 12 );
add_action('sparklestore_pro_top_header_notice_bar', 'sparklestore_pro_top_header_top_notice_bar', 10);

/**
 * News Ticker Top Header Function Area
*/
if ( ! function_exists( 'sparklestore_pro_top_notice_bar' ) ) {

	function sparklestore_pro_top_notice_bar() { ?>
		<div class="newstickerwrap">
		
			<?php if( get_theme_mod('sparklestore_pro_top_notice_bar_type', 'free-hand') == 'free-hand') : ?>
				<div class="news-free-hand">
					<?php echo force_balance_tags(get_theme_mod('sparklestore_pro_top_notice_bar_editor')); ?>
				</div>	
			<?php else: ?>
			
			<div class="acme-news-ticker">
				<?php
					$label = get_theme_mod( 'sparklestore_pro_top_notice_bar_label' ); 
					if( $label != ''):
				 ?>
				<div class="acme-news-ticker-label"><?php  echo esc_html( get_theme_mod( 'sparklestore_pro_top_notice_bar_label' ) );  ?></div>
				<?php endif; ?>
				<div class="acme-news-ticker-box">
					<ul class="newstirer my-news-ticker" id="newstirer">
						<?php
						$top_notice_bars = wp_kses_post( get_theme_mod('sparklestore_pro_notice_bar_items') );
						if(!empty( $top_notice_bars )):

							$top_notice_bars = json_decode($top_notice_bars);

							foreach($top_notice_bars as $ticker): ?>
								<li>
									<a href="#"><?php echo wp_kses_post( force_balance_tags( $ticker->news_text ) ); ?></a>
								</li>
							<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>
				<?php /*
				<div class="acme-news-ticker-controls acme-news-ticker-horizontal-controls">
					<!-- <span class="acme-news-ticker-arrow acme-news-ticker-prev"></span> -->
					<!-- <span class="acme-news-ticker-pause"></span> -->
					<!-- <span class="acme-news-ticker-arrow acme-news-ticker-next"></span> -->
				</div> */ ?>

				<div class="noticeclose">
					<i class="fas fa-times"></i>
				</div>
			</div>


			
			<?php endif; ?>
		</div>
	<?php
	}
}
add_action('sparklestore_top_notice_bar','sparklestore_pro_top_notice_bar');

if ( ! function_exists( 'sparklestore_pro_header_after' ) ) {
	/**
	 * Header Area
	 * @since  1.0.0
	 * @return void
	*/
	function sparklestore_pro_header_after() {	?>

			</div>
		</header><!-- #masthead -->
		<?php 
			if ( !sparklestore_pro_is_preview() ) {

				$preloader = get_theme_mod( 'sparklestore_pro_preloader_options', 1 ); 

				if( $preloader == 0 ) {
		?>
			<div class="sparklestore-preloader">
				<?php
					$preloader_type     = get_theme_mod('sparklestore_pro_preloader', 'preloader15');
					$preloader_image    = get_theme_mod('sparkle_store_pro_preloader_image', 'off');

					if ($preloader_type != 'custom') {
						get_template_part('inc/preloader/' . $preloader_type);
					} else {
						echo '<img src="' . esc_url($preloader_image) . '" alt="Preloader"/>';
					}
					
				?>
			</div>
		<?php } }
	}
}
add_action( 'sparklestore_pro_header_after', 'sparklestore_pro_header_after', 25 );

/**
 * sparklestore_pro_user_search_and_cart_icons
 * since 1.2.8
 * Header Icons list
 * will rmeove in future
 * @return void
 */
if( !function_exists('sparklestore_pro_user_search_and_cart_icons')){
	function sparklestore_pro_user_search_and_cart_icons(){
		?>

		<div class="quick-search-wrapper sparkle-column">
			<div class="toggle-useraccount">
				<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
					<i class="icofont-user-alt-3"></i>
				</a>
			</div>
			<div class="toggle-searchicon">
				<i class="icofont-search"></i>
			</div>
			<?php
				$header_minicart = get_theme_mod( 'sparklestore_pro_mini_cart_options', 'on' );
					
				if( !empty( $header_minicart ) && $header_minicart == 'on' ){

					do_action( 'sparklestore_pro_woocommerce_header_cart' );
				}
			?>
		</div>
		<div class="header-control toggle-search">
			<?php
				/**
				 * Advance & Normal Search
				 */
				do_action( 'sparklestore_pro_woocommerce_product_search' );
			?>
		</div>
	 <?php
	}

	add_action('sparklestore_pro_header_icons', 'sparklestore_pro_user_search_and_cart_icons');
}

/**
 * sparklestore_pro_primary_menu
 * since 1.2.8
 * Primary Menu
 * @return void
 */
if(! function_exists('sparklestore_pro_primary_menu' )){
	function sparklestore_pro_primary_menu(){
		$alignment = get_theme_mod('primary-menu-align', 'swp-flex-align-left');
		$depth = get_theme_mod('primary-menu-disable-sub-menu', false) ? 1 : 0;
		$disable_class = $depth ? 'child-menu-icon-hide' : "";
		?>
		<div class="box-header-nav main-menu-wapper clearfix sparkle-column <?php esc_attr_e($alignment); ?>">
			<div class="main-menu">
				<div class="main-menu-links">
					<?php
						wp_nav_menu( array(
								'theme_location'  => 'sparkleprimary',
								'menu'            => 'primary-menu',
								'container'       => '',
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => 'main-menu '.$disable_class,
								'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth' => $depth,
								'walker' => new SparkleTheme_Custom_Nav_Walker()
							)
						);
					?>
				</div>
			</div>
		</div>
		<?php
	}
	add_action( 'sparklestore_pro_primary_menu', 'sparklestore_pro_primary_menu');
}

/**
 * sparklestore_pro_primary_menu_mobile
 * since 1.2.8
 * Primary Menu
 * @return void
 */
if(! function_exists('sparklestore_pro_primary_menu_mobile')){
    function sparklestore_pro_primary_menu_mobile(){
		$alignment = get_theme_mod('primary-menu-align', 'swp-flex-align-left');
        ?>

        <nav class="mobile-menu  <?php esc_attr_e($alignment); ?>" aria-label="<?php esc_attr_e( 'Mobile', 'sparklestore-pro' ); ?>" role="navigation">
            <ul class="modal-menu">
                <?php
					wp_nav_menu(
						array(
							'container'      => '',
							'items_wrap'     => '%3$s',
							'show_toggles'   => true,
							'theme_location' => 'sparkleprimary',
						)
					);
                ?>
            </ul>
        </nav>


        <?php
    }
    add_action('sparklestore_pro_primary_menu_mobile', 'sparklestore_pro_primary_menu_mobile');
}

/**
 * sparklestore_pro_button_one
 * since 1.2.8
 * Button One
 * @return void
 */
if(!function_exists('sparklestore_pro_button_one')){
	function sparklestore_pro_button_one(){
		$button_css_class = get_theme_mod( 'button-one-class-name' );
		$button1_link     = get_theme_mod( 'button-one-url' );
		$button_link      = ( $button1_link ) ? $button1_link : '#';

		$button1_open_new_tab = get_theme_mod( 'button-one-open-link-new-tab', true );
		$target_blank         = ( $button1_open_new_tab ) ? 'target="_blank"' : '';

		$enable_icon          = get_theme_mod( 'button-one-enable-icon', true );
		$button_text          = get_theme_mod( 'button-one-text', esc_html__("Shop Now", 'sparklestore-pro'));
		$button_text          = apply_filters( 'sparklewp_button_one_text', $button_text );
		$button_icon          = get_theme_mod( 'button-one-icon' );
		$button_icon_position = get_theme_mod( 'button-one-icon-position' );
		
		$button_one_structure = "";
		if ( $enable_icon ) {
			$btn_icon = wp_kses_post( '<i class="' . esc_attr(  $button_icon ) . '"></i>' );
			if ( $button_text ) {
				
				if($button_icon_position == 'after'){
					$button_one_structure .= "<span>";
					$button_one_structure .= $button_text;
					$button_one_structure .= "</span>";
					$button_one_structure .= $btn_icon;
				}else{
					$button_one_structure .= $btn_icon;
					$button_one_structure .= "<span>";
					$button_one_structure .= $button_text;
					$button_one_structure .= "</span>";	
				}
			} else {
				$button_one_structure .= $btn_icon;
			}
		} else {
			$button_one_structure = esc_html( $button_text );
		}

		// button align.
		$button_align = get_theme_mod( 'button-one-align' );

		if ( ! empty( $button_text ) || ( $enable_icon != false ) ) {
			?>
			
			<span class="swp-header-button sparkle-column button-one <?php esc_attr_e($button_align); ?> <?php esc_attr_e($button_css_class); ?>">
				<a href="<?php echo esc_attr( $button_link ); ?>" <?php echo esc_attr( $target_blank ); ?>
				class="btn btn-primary"><?php echo $button_one_structure; ?></a>
			</span>

			<?php
		}
	}

	add_action('button_one', 'sparklestore_pro_button_one');
}