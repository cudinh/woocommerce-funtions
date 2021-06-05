add_filter('manage_upload_columns', 'mrpi_size_column_register');
function mrpi_size_column_register($columns) {
    $columns['dimensions'] = 'Dimensions';
    return $columns;
}

add_action('manage_media_custom_column', 'mrpi_size_column_display', 10, 2);
function mrpi_size_column_display($column_name, $post_id) {
    if( 'dimensions' != $column_name || !wp_attachment_is_image($post_id)) return;
    list($url, $width, $height) = wp_get_attachment_image_src($post_id, 'full');
    echo esc_html("{$width}&times;{$height}");
}
