<?php

function bcb_add_mce_btns() {
	if ( !current_user_can( 'edit_posts' ) &&  !current_user_can( 'edit_pages' ) ) {
		return;
	}

	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'bcb_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'bcb_register_mce_button' );
	}
}

function bcb_register_mce_button( $buttons ) {
	array_push( $buttons, 'bcb_mce_button' );
	return $buttons;
}

function bcb_add_tinymce_plugin( $plugin_array ) {
  $plugin_array['bcb_mce_button'] = plugins_url( '/tinymce.js', __FILE__ );
  return $plugin_array;
}

add_action('admin_head', 'bcb_add_mce_btns');
