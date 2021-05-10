<?php
add_filter( 'attachment_fields_to_edit', 'ruby_be_attachment_field_credit', 10, 2 );
function ruby_be_attachment_field_credit( $form_fields, $post ){
	$form_fields['ruby-attachment-youtube'] = array(
		'label' => 'Youtube ID',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'ruby_attachment_youtube', true ),
		'helps' => 'Ex: https://www.youtube.com/watch?v=<font color="red">jrh88xT-UZA</font>',
	);
	$form_fields['ruby-attachment-vimeo'] = array(
		'label' => 'Vimeo ID',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'ruby_attachment_vimeo', true ),
		'helps' => 'Ex: https://vimeo.com/<font color="red">181997304</font>',
	);
    return $form_fields;
}

add_filter( 'attachment_fields_to_save', 'ruby_be_attachment_field_credit_save', 10, 2 );
function ruby_be_attachment_field_credit_save( $post, $attachment ){
	if( isset( $attachment['ruby-attachment-youtube'] ) )
		update_post_meta( $post['ID'], 'ruby_attachment_youtube', $attachment['ruby-attachment-youtube'] );

	if( isset( $attachment['ruby-attachment-vimeo'] ) )
		update_post_meta( $post['ID'], 'ruby_attachment_vimeo', $attachment['ruby-attachment-vimeo'] );

	return $post;
}
?>
