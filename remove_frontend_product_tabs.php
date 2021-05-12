add_filter( 'woocommerce_product_tabs', 'mrpi_remove_product_tabs', 99 );
function mrpi_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
    return $tabs;
}
