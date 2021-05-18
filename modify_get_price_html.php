add_filter( 'woocommerce_get_price_html', 'mrpi_modify_get_price_html', 100, 2 );
function mrpi_modify_get_price_html( $price, $product ){
	return str_replace('<del>', '<del><label>Regular Price: </label>', $price);
}
