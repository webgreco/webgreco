<?php

add_action( 'woocommerce_cart_calculate_fees', function() {
	$greek_cod_fee = 2;
    $cyprus_cod_fee = 3;
    $chosen_gateway = WC()->session->get( 'chosen_payment_method' );

    // Get an instance of the WC_Customer Object from the user ID

    $customer = new WC_Customer( get_current_user_id() );

    $session_customer = WC()->session->get('customer'); 
    
    $billing_country = $session_customer[country];

    // echo $billing_country;
    
    if ( $chosen_gateway == 'cod' AND $billing_country == 'GR') 
    {
    	$chosen_shipping_methods = wc_get_chosen_shipping_method_ids();

    	if ( !in_array('local_pickup', $chosen_shipping_methods) )
    	{    		
    		WC()->cart->add_fee( __('Αντικαταβολή', 'woocommerce'), $greek_cod_fee );
    	}
    }

    if ( $chosen_gateway == 'cod' AND $billing_country == 'CY') {
        $chosen_shipping_methods = wc_get_chosen_shipping_method_ids();

    	if ( !in_array('local_pickup', $chosen_shipping_methods) )
    	{    		
    		WC()->cart->add_fee( __('Αντικαταβολή', 'woocommerce'), $cyprus_cod_fee );
    	}
    }

} );


?>
