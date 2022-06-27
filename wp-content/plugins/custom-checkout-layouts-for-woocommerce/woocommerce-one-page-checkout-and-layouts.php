<?php
/**
Plugin Name: Woocommerce one page checkout and layouts
Plugin URI: https://wordpress.org/plugins/custom-checkout-layouts-for-woocommerce/
Description: This plugin is designed to Combine Cart and Checkout process which gives users a faster checkout experience, with less interruption.
Author: BluePlugins
Author URI: http://blueplugins.com
Version: 2.6
License:GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: cclw
WC requires at least: 3.4
WC tested up to: 4.8.0
*/
 
if ( ! defined( 'WPINC' ) ) {
	die;
}


define( 'CCLW_VERSION', '2.6' );
define('CCLW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define('CCLW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if( !class_exists( 'CclwCheckout' ) ) 
{
	class CclwCheckout 
	{
		
		function __construct()  
		{
		
		add_action( 'plugins_loaded',array($this,'cclw_verify_woocommerce_installed'));
		add_action('admin_init',array($this,'cclw_plugin_redirect'));
		if ( file_exists( CCLW_PLUGIN_DIR . '/cmb2/init.php' ) ) {
            require_once CCLW_PLUGIN_DIR . '/cmb2/init.php';
			require_once CCLW_PLUGIN_DIR . '/cmb2-fontawesome-picker.php';
            }
		add_action('plugins_loaded', array($this, 'cclw_load_plugin_textdomain'));	
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'cclw_action_links' ) );	
		add_action( 'cmb2_admin_init',array($this,'cclw_custom_checkout_panel')) ;	
		add_action( 'wp_enqueue_scripts',array($this,'cclw_register_plugin_styles'));
		add_filter( 'woocommerce_locate_template',array($this,'cclw_adon_plugin_template'), 20, 3 );
		add_filter ('woocommerce_checkout_cart_item_quantity',array($this,'cclw_add_quantity'), 10, 2 );		add_action( 'wp_footer',array($this,'cclw_add_js'));
		add_action( 'init',array($this,'cclw_load_ajax'));
		add_filter( 'gettext',array($this,'cclw_text_strings'), 20, 3 );
		
		
		/*redirect to checkout page*/
		add_action( 'template_redirect',array($this,'cclw_redirect_to_checkout_if_cart'));
		add_action( 'admin_enqueue_scripts', array( $this, 'cclw_setup_admin_scripts' ) );
		add_action( 'admin_notices',array($this,'cclw_admin_pro_notice'));
	  	add_action( 'cmb2_before_form',array($this,'cclw_option_page_menu'));
		 
		}
		function cclw_action_links( $links ) {
		$custom_links = array();
		$custom_links[] = '<a href="' . admin_url( 'admin.php?page=custom_checkout_settings' ) . '">' . __( 'Settings', 'woocommerce' ) . '</a>';
		$custom_links[] = '<a style="font-weight: 800;" href="https://blueplugins.com/product/woocommerce-one-page-checkout-and-layouts-pro">' . __( 'Go Pro', 'woocommerce' ) . '</a>';
		  return array_merge( $custom_links, $links );
	    }
			
			
		/*load traslations*/
		 function cclw_load_plugin_textdomain() {
              $rs = load_plugin_textdomain('cclw', FALSE, basename(dirname(__FILE__)) . '/languages/');
          }
		/*Check if woocommerce is installed*/
		function cclw_verify_woocommerce_installed() {
			if ( ! class_exists( 'WooCommerce' )) {
				add_action( 'admin_notices',array($this,'cclw_show_woocommerce_error_message'));
			}
			
		}
    
		function cclw_show_woocommerce_error_message() {
			if ( current_user_can( 'activate_plugins' ) ) {
				$url = 'plugin-install.php?s=woocommerce&tab=search&type=term';
				$title = __( 'WooCommerce', 'woocommerce' );
				echo '<div class="error"><p>' . sprintf( esc_html( __( 'To begin using "%s" , please install the latest version of %s%s%s and add some product.', 'cclw' ) ), 'Custom Checkout Layouts WooCommerce', '<a href="' . esc_url( admin_url( $url ) ) . '" title="' . esc_attr( $title ) . '">', 'WooCommerce', '</a>' ) . '</p></div>';
			}
		}
		
		/*register admin section*/
        function cclw_setup_admin_scripts($hook) {
			wp_register_style( 'cclw-admin-panel',CCLW_PLUGIN_URL.'asserts/css/admin_panel.css',array(), CCLW_VERSION);
			
			wp_enqueue_style('cclw-admin-panel');
			
		 if($hook == 'woocommerce_page_custom_checkout_settings')
            { 
            wp_enqueue_script('cclw_admin_js',CCLW_PLUGIN_URL.'asserts/js/cclw_admin_js.js', array('jquery'),CCLW_VERSION, true);
		    wp_localize_script('cclw_admin_js', 'cclw_ajax',array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        
    		}
			
			
        }
	
		/**
		* Register style sheet.
		*/
		function cclw_register_plugin_styles() {
		if(is_checkout())
		{
		    wp_register_style( 'custom-checkout-css', CCLW_PLUGIN_URL .'asserts/css/custom-checkout.css', array(), CCLW_VERSION );
	
		    wp_enqueue_style( 'custom-checkout-css' );
		}	
		
 
		}
		/*Admin pro notice*/
		function cclw_admin_pro_notice(){
			if(isset($_GET['page']) && $_GET['page'] == 'custom_checkout_settings')
			{
				echo '<div class="notice notice-info is-dismissible">
			<h3>Features of "woocommerce One page checkout and layouts Pro"</h3>
			<ul>
			<li>6 Predefined layouts</li>
			<li>Create your custom checkout design</li>
			<li>Change Order Table Design</li>
			<li>Settings for every section.</li>
			<li>An Html editor section for shorcodes or Notices. </li>
			<li><a href="https://blueplugins.com/docs/woocommerce-one-page-checkout-and-layouts-pro/general-settings/">Read Documentation</a>
       		</ul>
			</div>';
			}
			
		} /*function close cclw_admin_pro_notice*/
		
		/*option page menu*/
		function cclw_option_page_menu(){
			?>
			<div class="custom_layout_setting_panel">
			    <nav class="nav-tab-wrapper woo-nav-tab-wrapper">
				<a class="nav-tab <?php if( $_GET['page'] == 'custom_checkout_settings'){echo 'nav-tab-active';}?>" href="<?php echo admin_url( 'admin.php?page=custom_checkout_settings');?>">Checkout Layouts</a>
				<a class="nav-tab <?php if( $_GET['page'] == 'cclw_global_css'){echo 'nav-tab-active';}?>" href="<?php echo admin_url( 'admin.php?page=cclw_global_css');?>">Global Style</a>
				<a class="nav-tab <?php if( $_GET['page'] == 'cclw_replace_text'){echo 'nav-tab-active';}?>" href="<?php echo admin_url( 'admin.php?page=cclw_replace_text');?>" class="button-primary">Replace Text</a>
				<a class="nav-tab <?php if( $_GET['page'] == 'cclw_quick_links'){echo 'nav-tab-active';}?>" href="<?php echo admin_url( 'admin.php?page=cclw_quick_links');?>" class="button-primary">How to Setup</a>
				</nav>
			</div>	
			<?php	
		}
		/* custom checkout setting page  */
		function cclw_custom_checkout_panel() {
			
			 require_once CCLW_PLUGIN_DIR . 'includes/admin/setting_panel.php';
			 require_once CCLW_PLUGIN_DIR . 'includes/admin/global_css.php';
			 require_once CCLW_PLUGIN_DIR . 'includes/admin/replace_text.php';
			 require_once CCLW_PLUGIN_DIR . 'includes/admin/quick_links.php';
			 
		} 
		

		/*Locate new woocommerce setting folder */
		function cclw_adon_plugin_template( $template, $template_name, $template_path ) {
			 global $woocommerce;
			 $_template = $template;
			 if ( ! $template_path ) 
			  $template_path = $woocommerce->template_url;
			 $plugin_path  = untrailingslashit( plugin_dir_path( __FILE__ ) )  . '/WooCommerce/';
            if(is_checkout())
			{
			   $template = $plugin_path . $template_name;
			
				if ( file_exists( $template ) ) {
				$template = $plugin_path . $template_name;
				}
				else
				{
				$template = $_template;
				}
			 
			}
            else
			{
				$template = $_template;
			}
			return $template;
			}
    	
          /*set product quantity*/ 
		
	   
		    function cclw_add_quantity( $cart_item, $cart_item_key ) {
				   $product_quantity= '';
				   return $product_quantity;
			}
				
		/**add some footer js*/		
		
     	
            function cclw_add_js(){
			?>
			<?php 
			$checkout_setting = get_option( 'custom_checkout_settings' ); 
			$global_css = get_option( 'cclw_global_css' ); 
			
			if($checkout_setting['cclw_skip_cart'] =='yes')
			{
				?>
				<style>
				    
					.mini_cart_content .checkout
					{
                        display: none !important;
                    } 
				
				</style>
				<?php
			}
			?>
            <style>
			:root {
			--main-bg-color: <?php echo $global_css['cclw_heading_background']?>;  
			--main-bor-color: <?php echo $global_css['cclw_heading_border']?>;
			--main-bor-text-color: <?php echo $global_css['cclw_heading_text_color']?>;
			--main-button-color: <?php echo $global_css['cclw_button_color']?>;
			--main-buttontext-color: <?php echo $global_css['cclw_buttontext_color']?>;

			} 
            </style>
			<?php
				
    	    $admin_url = get_admin_url();
			   
            if (  is_checkout() ) {
				
            ?>
                <script type="text/javascript">
						
						jQuery('form.checkout').on("click", "button.cclwminus", function(){
							var inputqty = jQuery(this).next('input.qty');
							var val = parseInt(inputqty.val());
							var max = parseFloat(inputqty.attr( 'max' ));
							var min = parseFloat(inputqty.attr( 'min' ));
							var step = parseFloat(inputqty.attr( 'step' ));
						  
						   if(val > min )
						   {
							inputqty.val( val - step );
                            jQuery(this).next('input.qty').trigger( "change" ); 							
							
						   }
					
					    });
						
						jQuery('form.checkout').on("click", "button.cclwplus", function(){
							
							var inputqty = jQuery(this).prev('input.qty');
							var val = parseInt(inputqty.val());
							var max = inputqty.attr( 'max' );
							var min = parseFloat(inputqty.attr( 'min' ));
							var step = parseFloat(inputqty.attr( 'step' ));
						  
						    if(val < max || max == ''  )
							   {
							    inputqty.val( val + step );  
                                 jQuery(this).prev('input.qty').trigger( "change" ); 								
							   }
					
					  
					    });
					   
					
					jQuery("form.checkout #order_review_table").on("change", "input.qty", function(){
						                   
                        var data = {
                    		action: 'cclw_update_order_review',
                    		security: wc_checkout_params.update_order_review_nonce,
                    		post_data: jQuery( 'form.checkout' ).serialize()
                    	};
						
                    	jQuery.post( '<?php echo $admin_url; ?>' + 'admin-ajax.php', data, function( response )
                		{
						    jQuery( 'body' ).trigger( 'update_checkout' );
						}); 
                    });
					
					jQuery( document.body ).on( 'added_to_cart', function(){
                        jQuery( 'body' ).trigger( 'update_checkout' );
                    });
					
		     </script>
             <?php  
             }
        }
		
			
        /*starts ajax*/
        function cclw_load_ajax() {
		     
            if ( !is_user_logged_in() ){
                add_action( 'wp_ajax_nopriv_cclw_update_order_review',array($this,'cclw_update_order_review'));
			    add_action( 'wp_ajax_nopriv_cclw_update_rating',array($this,'cclw_update_rating'));
            } else{
                add_action( 'wp_ajax_cclw_update_order_review',array($this,'cclw_update_order_review'));
				add_action( 'wp_ajax_cclw_update_rating',array($this,'cclw_update_rating'));
            }
        
        }
        
		
        function cclw_update_order_review() {
             
            $values = array();
            parse_str($_POST['post_data'], $values);
            $cart = $values['cart'];
            foreach ( $cart as $cart_key => $cart_value ){
                WC()->cart->set_quantity( $cart_key, $cart_value['qty'], true );
                WC()->cart->calculate_totals();
                woocommerce_cart_totals();
            }
            exit;
        }
		function cclw_update_rating() {
           $cclw_ratings = $_POST['cclw_ratings'];
		   update_option( 'show_cclw_rating', $cclw_ratings ); 
            exit;
        }
		/*replace add to cart content*/
		function cclw_text_strings( $translated_text, $text, $domain ) {
		$checkout_text = get_option( 'cclw_replace_text' ); 
		$checkout_setting = get_option( 'custom_checkout_settings' ); 
		 if(isset($checkout_text['cclw_addtocart']) && $checkout_text['cclw_addtocart'] !='')
		{
		 $addtocart = $checkout_text['cclw_addtocart'];
		 $translated_text = str_ireplace( 'Add to cart', $addtocart, $translated_text );	
		}
		if(isset($checkout_text['cclw_viewcart']) && $checkout_text['cclw_viewcart'] !='' && $checkout_setting['cclw_skip_cart'] =='yes')
		{
		 $viewcart = $checkout_text['cclw_viewcart'];
		 $translated_text = str_ireplace( 'View cart', $viewcart, $translated_text );
		}
		if(isset($checkout_text['cclw_placeorder']) && $checkout_text['cclw_placeorder'] !='')
		{
		 $placeorder = $checkout_text['cclw_placeorder'];
		 $translated_text = str_ireplace( 'Place order', $placeorder, $translated_text );
		}
		if(isset($checkout_text['cclw_continueshop']) && $checkout_text['cclw_continueshop'] !='')
		{
		 $cont_shop = $checkout_text['cclw_continueshop'];
		 $translated_text = str_ireplace( 'Continue shopping', $cont_shop, $translated_text );
		} 
		if(isset($checkout_text['cclw_billing_details']) && $checkout_text['cclw_billing_details'] !='')
		{
		 $billing_details = $checkout_text['cclw_billing_details'];
		 $translated_text = str_ireplace( 'Billing Details', $billing_details, $translated_text );
		} 
		if(isset($checkout_text['cclw_review_order']) && $checkout_text['cclw_review_order'] !='')
		{
		 $rev_ord = $checkout_text['cclw_review_order'];
		 $translated_text = str_ireplace( 'Review Order', $rev_ord, $translated_text );
		}
		if(isset($checkout_text['cclw_confirm_pay']) && $checkout_text['cclw_confirm_pay'] !='')
		{
		 $con_pay = $checkout_text['cclw_confirm_pay'];
		 $translated_text = str_ireplace( 'Confirm & Pay', $con_pay, $translated_text );
		}
			
		return $translated_text;
		}
		
		function cclw_redirect_to_checkout_if_cart() {
			global $woocommerce;
			$checkout_setting = get_option( 'custom_checkout_settings' ); 
			
			if ( is_cart() && WC()->cart->get_cart_contents_count() > 0 && $checkout_setting['cclw_skip_cart'] =='yes')
			{
			
			// Redirect to check out url
			wp_redirect( $woocommerce->cart->get_checkout_url(), '301' );
			exit;
			}
			
		}
	/*register activation hook*/
	public static function cclw_myplugin_activate() {
     add_option('cclw_do_activation_redirect', true);
	}
	function cclw_plugin_redirect() {
		if (get_option('cclw_do_activation_redirect', false)) {
			delete_option('cclw_do_activation_redirect');
			wp_redirect(admin_url( 'admin.php?page=custom_checkout_settings' ) );
		}
    }
		
		
	 public static function cclw_myplugin_deactivate() {
	/* 	nothing to do  */
		}
     
		
	
	}// end of class
}// end of if class
register_activation_hook(__FILE__, array('CclwCheckout', 'cclw_myplugin_activate'));
register_deactivation_hook(__FILE__, array('CclwCheckout', 'cclw_myplugin_deactivate'));

$CclwCheckout_obj = new CclwCheckout();   