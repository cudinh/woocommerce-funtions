<?php
add_filter( 'attachment_fields_to_edit', 'mrpi_be_attachment_field_credit', 10, 2 );
function mrpi_be_attachment_field_credit( $form_fields, $post ){
	$form_fields['mrpi-attachment-youtube'] = array(
		'label' => 'Youtube ID',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'ruby_attachment_youtube', true ),
		'helps' => 'Ex: https://www.youtube.com/watch?v=<font color="red">jrh88xT-UZA</font>',
	);
    return $form_fields;
}

add_filter( 'attachment_fields_to_save', 'mrpi_be_attachment_field_credit_save', 10, 2 );
function mrpi_be_attachment_field_credit_save( $post, $attachment ){
	if( isset( $attachment['mrpi-attachment-youtube'] ) )
		update_post_meta( $post['ID'], 'ruby_attachment_youtube', $attachment['ruby-attachment-youtube'] );
	return $post;
}
?>
