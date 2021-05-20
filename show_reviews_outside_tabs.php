add_action( 'woocommerce_after_single_product_summary', 'mrpi_show_reviews', 15 );
function mrpi_show_reviews(){
	comments_template();
}
