add_filter( 'woocommerce_available_variation', 'mrpi_modify_variation', 10, 3);
function mrpi_modify_variation( $data, $product, $variation ) {
    $data['price_html'] = str_replace('<del>', '<del><label>Regular price: </label>', $data['price_html']);
    return $data;
}
