<?php
function ui_scripts_and_styles() {

	global $wp_query;

 /******************
        SCRIPTS
  *******************/
	wp_enqueue_script( 'global_js', get_template_directory_uri() . '/js/build/all-min.js', null , null , true );	

	/******************
        STYLES
  *******************/
	wp_dequeue_style( 'wp-block-library' );
	// wp_enqueue_style( 'site_main_css', THEME . '/css/build/theme.css?cache'.time() );
	wp_enqueue_style( 'site_main_css', THEME . '/css/build/theme.css' );
	/******************
        CDATA
  *******************/

	$post_obj = $wp_query->get_queried_object();
	$post_name = isset($post_obj->post_name) ? $post_obj->post_name : '';

	$the_theme = array(
		"url" => get_bloginfo('wpurl'),
		"ajax_url" => get_bloginfo('wpurl') . '/wp-admin/admin-ajax.php',
		"theme_path" => get_template_directory_uri() ,
		"page" => $post_name,
	);
	wp_localize_script( 'global_js', 'the_theme', $the_theme );


}

add_action( 'wp_enqueue_scripts', 'ui_scripts_and_styles' );
?>
