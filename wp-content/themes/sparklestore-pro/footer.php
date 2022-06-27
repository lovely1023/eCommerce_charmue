<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sparkle Store Pro
 */

$service_position = get_theme_mod('sparklestore_display_services_section', 'footer');
if( $service_position == 'footer' ){
	/**
	 * HomePage Footer Services Area
	*/
	do_action( 'sparklestore_pro_services_footer_area', 5 );
}

 ?>

 </div><!-- #content -->

	<?php
		global $post;
	
		$hide_footer = false;
		if($post) $hide_footer = rwmb_meta('hide_footer', $post->ID);
		
		if (!$hide_footer):

			do_action( 'sparklestore_pro_footer_before');	

				/**
				 * @see  sparklestore_pro_top_footer_widget_area() - 8
				*/
				do_action( 'sparklestore_pro_top_footer_widget');
				
				/**
				 * @see  sparklestore_pro_footer_widget_area() - 10
				*/
				do_action( 'sparklestore_pro_footer_widget');

				/**
				 * Sub Footer Area
				 * @social icon filters : sparklestore_pro_footer_menu() - 5
				*/
				do_action( 'sparklestore_pro_bottom_footer');  
			
			do_action( 'sparklestore_pro_footer_after');	 
		endif;
	?>	    

</div><!-- #page -->

<?php if( get_theme_mod('sparkle_store_pro_backtotop',true)): ?>
	<a href="#" id="back-to-top" class="progress" data-tooltip="Back To Top">
		<div class="arrow-top"></div>
		<div class="arrow-top-line"></div>
		<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="xMinYMin meet"> <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/></svg> 
	</a>
<?php endif; ?>
<?php wp_footer(); ?>

</body>
</html>
