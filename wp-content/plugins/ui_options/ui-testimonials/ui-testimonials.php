<?php
/*
Plugin Name: UI Testimonials
Description: Custom content types for themes developed by Urge Interactive
Version: 2.0
Author: Urge Interactive
Author URI: http://urgeinteractive.com
*/

function create_pt_testimonials() {
    $options_testimonials_names = get_option('post_type_testimonials_names');
	register_post_type( 'testimonials', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
        array('labels' => array(
            'name' => $options_testimonials_names['plural'] ? $options_testimonials_names['plural'] : __('Testimonials'), /* This is the Title of the Group */
            'singular_name' => $options_testimonials_names['singular'] ? $options_testimonials_names['singular'] :__('Testimonial'), /* This is the individual type */
            'all_items' => $options_testimonials_names['singular'] ? 'All '.$options_testimonials_names['singular'] :__('All Testimonial'), /* the all items menu item */
            'add_new' => $options_testimonials_names['singular'] ? 'Add New '.$options_testimonials_names['singular'] :__('Add New Testimonial'), /* The add new menu item */
            'add_new_item' => $options_testimonials_names['singular'] ? 'Add New '.$options_testimonials_names['singular'] :__('Add New Testimonial'), /* Add New Display Title */
            'edit' => __( 'Edit' ), /* Edit Dialog */
            'edit_item' => $options_testimonials_names['singular'] ? 'Edit '.$options_testimonials_names['singular'] :__('Edit Testimonial'), /* Edit Display Title */
            'new_item' => $options_testimonials_names['singular'] ? 'New '.$options_testimonials_names['singular'] :__('New Testimonial'), /* New Display Title */
            'view_item' => $options_testimonials_names['singular'] ? 'View '.$options_testimonials_names['singular'] :__('View Testimonial'), /* View Display Title */
            'search_items' => $options_testimonials_names['plural'] ? 'Search '.$options_testimonials_names['plural'] :__('Search Testimonials'), /* Search Product Title */
            'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */
            'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
        ),
			'description' => $options_testimonials_names['plural'] ? $options_testimonials_names['plural'].' for '.get_bloginfo() :__( 'Testimonials for '.get_bloginfo() ), /* Product Description */
			'public' => true,
			'menu_icon' => 'dashicons-format-quote',
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'rewrite'	=> array( 'slug' => $options_testimonials_names['slug'] ? $options_testimonials_names['slug'] :'testimonials', 'with_front' => true ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
      'supports' => array( 'title','post-options','editor','page-attributes', 'author', 'excerpt','thumbnail'),
      'show_in_rest' => true,
	 	) /* end of options */
	); /* end of register post type */
}

add_action( 'init','create_pt_testimonials' );


function create_testimonials_cat_tax() {
    $options_testimonials_names = get_option('post_type_testimonials_names');
    $labels = array(
        'name'              => _x( $options_testimonials_names['singular'] ? $options_testimonials_names['singular'].' Category' :'Testimonial Category', 'taxonomy general name' ),
        'singular_name'     => _x( $options_testimonials_names['singular'] ? $options_testimonials_names['singular'].' Category' :'Testimonial Category', 'taxonomy singular name' ),
        'search_items'      => __( $options_testimonials_names['singular'] ? 'Search '.$options_testimonials_names['singular'].' Сategories' :'Search Testimonial Сategories' ),
        'all_items'         => __( $options_testimonials_names['singular'] ? 'All '.$options_testimonials_names['singular'].' Сategories' :'All Testimonial Сategories' ),
        'parent_item'       => __( $options_testimonials_names['singular'] ? 'Parent '.$options_testimonials_names['singular'].' Сategory' :'Parent Testimonial Сategory' ),
        'parent_item_colon' => __( $options_testimonials_names['singular'] ? 'All '.$options_testimonials_names['singular'].' Сategory' :'Parent Testimonial Сategory:' ),
        'edit_item'         => __( $options_testimonials_names['singular'] ? 'Edit '.$options_testimonials_names['singular'].' Сategory' :'Edit Testimonial Сategory' ),
        'update_item'       => __( $options_testimonials_names['singular'] ? 'Update '.$options_testimonials_names['singular'].' Сategory' :'Update Testimonial Сategory' ),
        'add_new_item'      => __( $options_testimonials_names['singular'] ? 'Add New '.$options_testimonials_names['singular'].' Сategory' :'Add New Testimonial Сategory' ),
        'new_item_name'     => __( $options_testimonials_names['singular'] ? 'New '.$options_testimonials_names['singular'].' Сategory Name' :'New Testimonial Сategory Name' ),
        'menu_name'         => __( $options_testimonials_names['singular'] ? $options_testimonials_names['singular'].' Сategory' :'Testimonial Category' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'testimonials_category' ),
    );

    register_taxonomy( 'testimonials_category', array( 'testimonials' ), $args );
}
add_action( 'init', 'create_testimonials_cat_tax' );

function testimonials_meta_box_ca() {
    add_meta_box( 'testimonials_meta_box_ca',
        'Content Association',
        'urge_options_display_child_meta_box_ca', // Use urge_options_display_child_meta_box_ca() from parent plugin
        'testimonials',
        'normal',
        'high'
    );
}

if (get_option('post_type_testimonials_caf')) {
    add_action( 'add_meta_boxes', 'testimonials_meta_box_ca' );
}

//add testimonial form shortcode
function testimonial_form( $attr ) {
  ob_start();
  get_template_part( 'forms/testimonial-submit' );
  return ob_get_clean();
}
add_shortcode( 'testimonial_form', 'testimonial_form' );

//code to submit post to ajax function in ui_ajax
function testimonial_submit_ajax() { ?>

<script>
jQuery(document).ready(function($) {

   $('#testimonial_submit').submit(function(e){
 		e.preventDefault();
 		var form = $(this);
 		var form_results = $('#form-results');

 		form_results.html(' ');
 		form_results.removeClass('alert');
 		form_results.removeClass('alert-error');
 		form_results.removeClass('alert-success');

 		form.find('.btn').prop('disabled', true);

 		var errors = [];

 		// Validation
 		if( form.find('input[name=name]').val() == "" ) { errors.push('The name field is required'); }
 		if( form.find('input[name=email]').val() == "" ) { errors.push('The email field is required'); }
 		if( form.find('textarea[name=testimonial]').val() == "" ) { errors.push('The testimonial field is required'); }

 		if( errors.length > 0 ){

 			var error_html = '<ul>';
 			form_results.addClass('alert');
 			form_results.addClass('alert-info');

 			$.each(errors, function( index, value ) {
 				error_html += '<li>' +value+ '</li>';
 			});
 			error_html += '</ul>';

 			form_results.html(error_html);
 			form.find('.btn').prop('disabled', false);
 			return false;
 		}

 		var data = {
 			action: 'do_ajax',
 			fn: 'testimonial_submit',
 			data: {
        'name': form.find('input[name=name]').val(),
        'email': form.find('input[name=email]').val(),
        'testimonial': form.find('textarea[name=testimonial]').val()
      }
 		};

    console.log(data);

 		jQuery.post( the_theme.url + '/wp-admin/admin-ajax.php' , data, function(response) {

 		  console.log(response);
 			form.find('.btn').prop('disabled', false);
 			$('#form-results').html(response);
 		}, 'json');
 	});
});
</script>

<?php }
add_action ('wp_footer', 'testimonial_submit_ajax');
