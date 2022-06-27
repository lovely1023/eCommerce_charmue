<?php 
$prefix = 'cclw_';
$cclw_panel = new_cmb2_box( array(
        'id'            => $prefix .'customize_sections',
        'title'         => __( 'Customize Sections', 'cclw' ),
        'object_types'  => array( 'options-page', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
		'option_key'      => 'cclw_customize_sections',
		'parent_slug'     => 'custom_checkout_settings'
      
    ) );
$cclw_panel->add_field( array(
				//'name' => 'Test Title',
				'desc' => 'You can change the headers names and can hide those headers. Add custom class to match your theme borders',
				'type' => 'title',
				'id'   => $prefix . 'position_title',
			) );
			/*billing section*/
			$billing_section = $cclw_panel->add_field( array(
				'id'   => $prefix . 'billing_section',
				'type'        => 'group',
			    'repeatable'  => false, // use false if you want non-repeatable group
				'options'     => array(
					'group_title'       => __( 'Billing Details', 'cclw' ), 
					'sortable'          => true,
					'closed'         => false,
			),
			) );
			
			$cclw_panel->add_group_field( $billing_section, array(
				'name'             => 'Select Position ',
				'desc'             => 'Select a Position where you want to show "Billing Details".',
				'id'               =>$prefix . 'position_to_call',
				'type'             =>  'hidden',
				'default'          => '1',
			) );
			
			$cclw_panel->add_group_field( $billing_section, array(
				'id'   => $prefix . 'section_to_call',
				'type' => 'hidden',
				'default' =>'cclw_billing_details_section',
			) );
			$cclw_panel->add_group_field( $billing_section, array(
				'name' => 'Label',
				'desc' =>'Leave empty if you want to hide label',
				'id'   => $prefix . 'title',
				//'default' => 'Billing Details',
				'type' => 'text',
				'attributes'  => array(
					'placeholder' => 'For example :-Billing Details',
				),
				// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
			) );
			$cclw_panel->add_group_field( $billing_section, array(
				'name'    => 'CSS Class',
				'id'      => $prefix . 'class',
				'type'    => 'text_small',
			) );
			
			
			
			/*Review your Order section*/
			$review_order_section = $cclw_panel->add_field( array(
				'id'   => $prefix . 'review_order_section',
				'type'        => 'group',
			    'repeatable'  => false, // use false if you want non-repeatable group
				'options'     => array(
					'group_title'       => __( 'Review Order', 'cclw' ), 
					'sortable'          => true,
					'closed'         => true,
			),
			) );
			$cclw_panel->add_group_field( $review_order_section, array(
				'name'             => 'Select Position ',
				'desc'             => 'Select a Position where you want to show "Review Order".Make sure to select different position from other sections',
				'id'               =>$prefix . 'position_to_call',
				'type' => 'hidden',
				'default'          => '2',
			) );
			
			$cclw_panel->add_group_field( $review_order_section, array(
				'id'   => $prefix . 'section_to_call',
				'type' => 'hidden',
				'default' =>'cclw_review_order_section',
			) );
			$cclw_panel->add_group_field( $review_order_section, array(
				'name' => 'Label',
				'desc' =>'Leave empty if you want to hide label',
				'id'   => $prefix . 'title',
				//'default' => 'Review Order',
				'attributes'  => array(
					'placeholder' => 'For example :-Review Order',
				),
				'type' => 'text',
				// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
			) );
			
			$cclw_panel->add_group_field( $review_order_section, array(
				'name'    => 'CSS Class',
				'id'      => $prefix . 'class',
				'type'    => 'text_small',
			) );
			
			
						
			/*Confirm & Pay section*/
		 	$payment_section = $cclw_panel->add_field( array(
				'id'   => $prefix . 'payment_section',
				'type'        => 'group',
			    'repeatable'  => false, // use false if you want non-repeatable group
				'options'     => array(
					'group_title'       => __( 'Confirm & Pay', 'cclw' ), 
					'sortable'          => true,
					'closed'         => true,
			),
			) );
			$cclw_panel->add_group_field( $payment_section, array(
				'name'             => 'Select Position ',
				'desc'             => 'Select a Position where you want to show "Payment section".Make sure to select different position from other sections',
				'id'               =>$prefix . 'position_to_call',
				'type'             => 'hidden',
				'default'          => '3',
			) );
			
			$cclw_panel->add_group_field( $payment_section, array(
				'id'   => $prefix . 'section_to_call',
				'type' => 'hidden',
				'default' =>'cclw_payment_section',
			) );
			$cclw_panel->add_group_field( $payment_section, array(
				'name' => 'Label',
				'desc' =>'Leave empty if you want to hide label',
				'id'   => $prefix . 'title',
				//'default' => 'Confirm & Pay',
				'attributes'  => array(
					'placeholder' => 'For example :-Confirm & Pay',
				),
				'type' => 'text',
				// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
			) );
			$cclw_panel->add_group_field( $payment_section, array(
			    'name'    => 'CSS Class',
				'id'      => $prefix . 'class',
				'type'    => 'text_small',
			) );