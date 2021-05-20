add_filter( 'woocommerce_upsell_display_args', 'mrpi_change_number_related_products', 20 );
function mrpi_change_number_related_products( $args ) {
  $args['posts_per_page'] = 1;
  $args['columns'] = 4;
  return $args;
}
