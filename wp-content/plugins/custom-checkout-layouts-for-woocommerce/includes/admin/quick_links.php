<?php 
$prefix = 'cclw_';
$cclw_panel = new_cmb2_box( array(
        'id'            => $prefix .'quick_links',
        'title'         => __( 'How to Setup', 'cclw' ),
        'object_types'  => array( 'options-page', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
		'option_key'      => 'cclw_quick_links',
		'parent_slug'     => 'custom_checkout_settings',
		'display_cb' => 'cclw_quick_links_output'
      
    ) );
	
	function  cclw_quick_links_output(){
	?>
	<div class="cclw_sidebar_notice">
			    <div class="cclw_sidebar_wrap">
							
				<div class="quick_links">
				<h2>Quick Links</h2>
				<ul>
				<li><a href="https://blueplugins.com/docs/woocommerce-one-page-checkout-and-layouts/installation-and-update/">Read Documentation(Free Version)</a></li>
				<li><a href="http://demo.blueplugins.com/?add-to-cart=113">View Demo</a></li>
				<li><a href="https://youtu.be/VIwovIySKoM">A Video Guide(Free version )</a></li>
				
				</ul>
				</div>
				<div class="cclw_divider" style="border: 2px solid;"></div>
				
				<div class="pro_features">
				<h2>Features of Pro Version</h2>
				<ul>
				<li>1. 4 More layouts designs(Multistep, Multistep Vertical, Accordian)</li>
				<li>2. Custom layout For your Custom designs.</li>
				<li>3. Replace Positions of sections</li>
				<li>4. Hide Additional Notes</li>
				<li>5. Hide/Show Billing Fields </li>
				<li>6. Change Billing/ Shipping Labels, placeholders and required sections.</li>
				<li><a href="https://blueplugins.com/product/woocommerce-one-page-checkout-and-layouts-pro/" class="button-primary">Upgrade to Pro</a></li>
				<li><a href="https://www.youtube.com/watch?v=JNwUEzBW9YU">A Video Guide(Pro version )</a></li>
				<li><a href="https://blueplugins.com/docs/woocommerce-one-page-checkout-and-layouts-pro/installation/">Read Documentation(Pro Version)</a></li>
				</ul>
				</div>
				<div class="cclw_divider" style="border: 2px solid;"></div>
				
				<div class="cclw_ratings">
				 <?php   $showratings = get_option('show_cclw_rating');
						if($showratings != '' && $showratings == 'no')
						{
							//show nothing
						}
						else{
						echo '<div class="cclw_rating_wrap">
							<h2>Let Us Know How We Did?</h2>
							<div class="cclw_star" style="color:#ffb900;">
							<span class="dashicons dashicons-star-filled"></span>
							<span class="dashicons dashicons-star-filled"></span>
							<span class="dashicons dashicons-star-filled"></span>
							<span class="dashicons dashicons-star-filled"></span>
							<span class="dashicons dashicons-star-filled"></span>
							</div>
							<p>Submit your valueable feedback and helps us to improve.</a> Thanks,we appreciate it!</p>
													
						   <div class="cclw_rating_links"><a class="button-primary" href="https://wordpress.org/support/plugin/custom-checkout-layouts-for-woocommerce/reviews/#new-post">Rate Now</a>
						   </div>
						  
						   
						   </div>';
						}    ?>
				</div>
				
				<div class="cclw_notice"><h4><strong>Important Note :-</strong>All the users who were already using this plugin (before version 2.1) are recommended to save all the settings again to remove any errors.</h4></div>
				</div>
	</div>
	<?php 
	}