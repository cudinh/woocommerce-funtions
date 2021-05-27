// Shipping field on my account edit-addresses and checkout
function mrpi_filter_woocommerce_shipping_fields( $fields ) {    
    $fields['shipping_phone'] = array(
        'label' => __( 'Shipping Phone', 'woocommerce' ),
        'required' => true,
        'class' => array( 'form-row-wide' ),
        'priority'    => 55
    );
    
    return $fields;
}
add_filter( 'woocommerce_shipping_fields' , 'mrpi_filter_woocommerce_shipping_fields', 10, 1 ); 

// Display on the order edit page (backend)
function mrpi_action_woocommerce_admin_order_data_after_shipping_address( $order ) {
    if ( $value = $order->get_meta( '_shipping_phone' ) ) {
        echo '<p><strong>' . __( 'Shipping Phone', 'woocommerce' ) . ':</strong> ' . $value . '</p>';
    }
}
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'mrpi_action_woocommerce_admin_order_data_after_shipping_address', 10, 1 );

// Display on email notifications
function mrpi_filter_woocommerce_email_order_meta_fields( $fields, $sent_to_admin, $order ) {
    // Get meta
    $shipping_phone = $order->get_meta( '_shipping_phone' );
    
    // NOT empty
    if ( ! empty( $shipping_phone ) ) { 
        $fields['_shipping_phone'] = array(
            'label' => __( 'Shipping Phone', 'woocommerce' ),
            'value' => $shipping_phone,
        );
    }
    
    return $fields;
}
add_filter( 'woocommerce_email_order_meta_fields', 'mrpi_filter_woocommerce_email_order_meta_fields', 10, 3 );
