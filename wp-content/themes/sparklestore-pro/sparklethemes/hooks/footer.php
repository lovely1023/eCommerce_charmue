<?php
/**
 * Footer Area Before
*/
if ( ! function_exists( 'sparklestore_pro_footer_before' ) ) {

	function sparklestore_pro_footer_before(){ ?>

		<footer class="site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
	<?php
	}
}
add_action( 'sparklestore_pro_footer_before', 'sparklestore_pro_footer_before', 5 );

/**
 * Top Footer Widget Area
*/
if ( ! function_exists( 'sparklestore_pro_top_footer_widget_area' ) ) {

	function sparklestore_pro_top_footer_widget_area(){ 
		$display = get_theme_mod('sparklestore_pro_top_footer_area', 'homepage');
		if(  $display != 'none'):
			if( $display == 'homepage'):
				if( ( is_front_page() || is_home() ) ):
					sparklestore_pro_top_footer_content();
				endif;
			else:
				sparklestore_pro_top_footer_content();
			endif;
		endif; 
	}
}
add_action( 'sparklestore_pro_top_footer_widget', 'sparklestore_pro_top_footer_widget_area', 8 );


if(!function_exists('sparklestore_pro_top_footer_content')){
	function sparklestore_pro_top_footer_content(){
		if ( is_active_sidebar( 'footer-1' ) ):
			$topfooterarea =  count( wp_get_sidebars_widgets()['footer-1'] ); ?>
			<div class="top-footer-area">
				<div class="container">
					<div class="top-footer-inner topfooter-<?php echo intval( $topfooterarea ); ?>">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div> 
				</div>
			</div>
		<?php endif;
	}
}

/**
 * Footer Widget Area
*/


/**
 * Main Footer Wrapper Open
*/
if ( ! function_exists( 'sparklestore_pro_footer_wrapper_open_widget_area' ) ) {

	function sparklestore_pro_footer_wrapper_open_widget_area(){ 
		echo '<div class="mainfooterwrapper">';
	}
}
add_action( 'sparklestore_pro_footer_widget', 'sparklestore_pro_footer_wrapper_open_widget_area', 5 );


/**
 * Main Footer
*/
if ( ! function_exists( 'sparklestore_pro_footer_widget_area' ) ) {

	function sparklestore_pro_footer_widget_area(){ 
		if( get_theme_mod('sparklestore_pro_middle_footer_area', 'off') == 'off'): 
			$footer_style = get_theme_mod('sparklestore_pro_footer_layout', 'footer-style1');
			$col_footer_count = get_theme_mod('sparklestore_pro_footer_col', 'col-4-1-1-1-1');
			$col_footer = explode('-', $col_footer_count);
			$count = count($col_footer);
			$footer_col = $count - 1;
			if (is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') || is_active_sidebar('footer-5')):
		?>
			<div class="middle-footer-area footer-widgets">
				<div class="container">
					<div class="middle-footer-inner <?php echo esc_attr($footer_style . ' ' . $col_footer_count) ?>">
						<?php
							for ($i = 2; $i <= $footer_col; $i++) {

								if (is_active_sidebar('footer-' . $i)) {
						?>
							<div class="cl-footer cl-footer<?php echo absint($i); ?>">

								<?php dynamic_sidebar('footer-' . $i); ?>

							</div>

						<?php } } ?>
					</div> 
				</div>
			</div>
		<?php
		endif;
		endif; 
	}
}
add_action( 'sparklestore_pro_footer_widget', 'sparklestore_pro_footer_widget_area', 10 );


/**
 * Full Width Footer Widget Area
*/
if ( ! function_exists( 'sparklestore_pro_bottom_footer_widget_area' ) ) {

	function sparklestore_pro_bottom_footer_widget_area(){ 

		if( get_theme_mod('sparklestore_pro_bottom_footer_area', 'off') == 'off'): 

			if ( is_active_sidebar( 'footer-6' ) ) { 
		?>
			<div class="bottom-footer-area footer-widgets">
				<div class="container">
					<div class="bottom-footer-inner">
						<?php dynamic_sidebar( 'footer-6' ); ?>
					</div> 
				</div>
			</div>
		<?php }
		endif; 
	}
}
add_action( 'sparklestore_pro_footer_widget', 'sparklestore_pro_bottom_footer_widget_area', 15 );

/**
 * Social Icon & Payment Logo
*/
if ( ! function_exists( 'sparklestore_pro_top_footer_before' ) ) {

	function sparklestore_pro_top_footer_before(){ 
		if( get_theme_mod('sparklestore_pro_sub_top_footer_area', 'off') == 'off'): 
			$options = get_theme_mod( 'sparklestore_pro_sub_footer', 0 );

			if( $options != 1 ){  ?>

				<div class="sub-top-footer">
					<div class="container">
						<div class="sub-top-inner">
							<div class="sociallink">
								<?php apply_filters( 'sparklestore_pro_social_links', 5 ); ?>	            
							</div>
							<div class="paymentlogo">
								<?php apply_filters( 'sparklestore_pro_payment_logo', 10 ); ?>
							</div>
						</div>
					</div>
				</div>

			<?php }
		endif;
	}
}
add_action( 'sparklestore_pro_footer_widget', 'sparklestore_pro_top_footer_before', 20 );

/**
 * Main Footer Wrap Close
*/
if ( ! function_exists( 'sparklestore_pro_footer_wrapper_close_widget_area' ) ) {

	function sparklestore_pro_footer_wrapper_close_widget_area(){ 
		echo '</div>';
	}
}
add_action( 'sparklestore_pro_footer_widget', 'sparklestore_pro_footer_wrapper_close_widget_area', 25 );


/**
 * Bottom Footer Area
*/
if ( ! function_exists( 'sparklestore_pro_bottom_footer_before' ) ) {
	
	function sparklestore_pro_bottom_footer_before(){ ?>
	
		<div class="sub-footer">
		    <div class="container">
		        <div class="sub-footer-inner">
					<div class="coppyright">
						<?php
							/**
							 *  Copyright Message
							 */
							do_action( 'sparklestore_pro_footer_copyright' );

							the_privacy_policy_link();
						?>
					</div>

					<div class="footer_menu">
						<?php do_action( 'sparklestore_pro_sub_footer_menu' ); ?>
					</div>
				</div>
		    </div>
		</div>
		<?php
	}
}
add_action( 'sparklestore_pro_bottom_footer', 'sparklestore_pro_bottom_footer_before', 20 );


/**
 * Footer Area After
*/
if ( ! function_exists( 'sparklestore_pro_footer_after' ) ) {

	function sparklestore_pro_footer_after(){ ?>

		</footer>
	<?php
	}
}
add_action( 'sparklestore_pro_footer_after', 'sparklestore_pro_footer_after', 25 );