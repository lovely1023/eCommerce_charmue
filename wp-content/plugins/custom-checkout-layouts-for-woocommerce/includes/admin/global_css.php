<?php 
$prefix = 'cclw_';
$cclw_panel = new_cmb2_box( array(
        'id'            => $prefix .'global_css',
        'title'         => __( 'Global Style', 'cclw' ),
        'object_types'  => array( 'options-page', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
		'option_key'      => 'cclw_global_css',
		'parent_slug'     => 'custom_checkout_settings'
      
    ) );
	
	/*color panel*/		
			
			$cclw_panel->add_field( array(
				//'name' => 'Select colors for checkout page to match your theme Color settings ',
				'desc' => "Select colors for checkout page to match your theme's Color settings",
				'type' => 'title',
				'id'   => $prefix . 'colorheader',
			) );
			
			$cclw_panel->add_field( array(
			'name'          => __( 'Header Background Color', 'cclw' ),
			'desc' => 'Select a background color for headers i.e like "Billing section"',
			'id'            => $prefix . 'heading_background',
			'type'    => 'colorpicker',
	         'default' => '#fafafa',
			) );
			
			$cclw_panel->add_field( array(
			'name'          => __( 'Header Border Color', 'cclw' ),
			'desc' => 'Select a Border color for headers i.e like "Billing section"',
			'id'            => $prefix . 'heading_border',
			'type'    => 'colorpicker',
	         'default' => '#1e85be',
			) );
			$cclw_panel->add_field( array(
			'name'          => __( 'Header Text Color', 'cclw' ),
			'desc' => 'Select a text color for header content i.e  "Billing section"',
			'id'            => $prefix . 'heading_text_color',
			'type'    => 'colorpicker',
	         'default' => '#000000',
			) );
			
			$cclw_panel->add_field( array(
			'name'          => __( 'Button Color', 'cclw' ),
			'desc' => 'Select a color for buttons i.e like "Place order or Apply coupon"',
			'id'            => $prefix . 'button_color',
			'type'    => 'colorpicker',
	         'default' => '#1e85be',
			) );
			
			$cclw_panel->add_field( array(
			'name'          => __( 'Button Text Color', 'cclw' ),
			'desc' => 'Select a color for text on buttons',
			'id'            => $prefix . 'buttontext_color',
			'type'    => 'colorpicker',
	         'default' => '#fff',
			) );