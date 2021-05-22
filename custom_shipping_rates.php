add_filter( 'woocommerce_package_rates', 'mrpi_custom_shipping_rates', 100, 2 );
function mrpi_custom_shipping_rates( $rates, $package ) {
    $cc_total = WC()->cart->cart_contents_total;
    $percentage = 0.01; // 1%

    foreach( $rates as $rate_key => $rate ) {
        if ( 'free_shipping' === $rate->method_id ){

            // Calculation
            $surcharge = $cc_total * $percentage;

            // Set the new Label name
            $rates[$rate_key]->label .= ' ' . __("Fee", "woocommerce");

            // Set Custom rate cost
            $rates[$rate_key]->cost = round($surcharge, 2);
        }
    }
    return $rates;
}
