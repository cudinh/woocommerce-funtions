<?php
function mrpi_create_order(){
	$product = WC_Helper_Product::create_simple_product();
	WC_Helper_Shipping::create_simple_flat_rate();
	$order_data = array(
		'status' => 'pending', 
		'customer_id' => 1, 
		'customer_note' => '', 
		'total' => ''
	);
	$order = wc_create_order($order_data);

	$item_id = $order->add_product($product, 4);

	$billing_address = array(
		'country' => 'US', 
		'first_name' => 'Jeroen', 
		'last_name' => 'Sormani', 
		'company' => 'WooCompany', 
		'address_1' => 'WooAddress', 
		'address_2' => '', 
		'postcode' => '123456', 
		'city' => 'WooCity', 
		'state' => 'NY', 
		'email' => 'admin@example.org', 
		'phone' => '555-32123'
	);
	$order->set_address($billing_address, 'billing');

	$shipping_taxes = WC_Tax::calc_shipping_tax('10', WC_Tax::get_shipping_tax_rates());
	$order->add_shipping(new WC_Shipping_Rate('flat_rate_shipping', 'Flat rate shipping', '10', $shipping_taxes, 'flat_rate'));

	$payment_gateways = WC()->payment_gateways->payment_gateways();
	$order->set_payment_method($payment_gateways['bacs']);

	$order->set_total(10, 'shipping');
	$order->set_total(0, 'cart_discount');
	$order->set_total(0, 'cart_discount_tax');
	$order->set_total(0, 'tax');
	$order->set_total(0, 'shipping_tax');
	$order->set_total(40, 'total');
	return wc_get_order($order->id);
}
?>
