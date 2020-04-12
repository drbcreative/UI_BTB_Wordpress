<?php
/*
Plugin Name: UI Treatments
Description: Custom content types for themes developed by Urge Interactive
Version: 2.0
Author: Urge Interactive
Author URI: http://urgeinteractive.com
*/

function create_pt_treatments() {
    $options_treatments_names = get_option('post_type_treatments_names');
	register_post_type( 'treatments', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
        array('labels' => array(
            'name' => $options_treatments_names['plural'] ? $options_treatments_names['plural'] : __('Treatments'), /* This is the Title of the Group */
            'singular_name' => $options_treatments_names['singular'] ? $options_treatments_names['singular'] :__('Treatment'), /* This is the individual type */
            'all_items' => $options_treatments_names['singular'] ? 'All '.$options_treatments_names['singular'] :__('All Treatment'), /* the all items menu item */
            'add_new' => $options_treatments_names['singular'] ? 'Add New '.$options_treatments_names['singular'] :__('Add New Treatment'), /* The add new menu item */
            'add_new_item' => $options_treatments_names['singular'] ? 'Add New '.$options_treatments_names['singular'] :__('Add New Treatment'), /* Add New Display Title */
            'edit' => __( 'Edit' ), /* Edit Dialog */
            'edit_item' => $options_treatments_names['singular'] ? 'Edit '.$options_treatments_names['singular'] :__('Edit Treatment'), /* Edit Display Title */
            'new_item' => $options_treatments_names['singular'] ? 'New '.$options_treatments_names['singular'] :__('New Treatment'), /* New Display Title */
            'view_item' => $options_treatments_names['singular'] ? 'View '.$options_treatments_names['singular'] :__('View Treatment'), /* View Display Title */
            'search_items' => $options_treatments_names['plural'] ? 'Search '.$options_treatments_names['plural'] :__('Search Treatments'), /* Search Product Title */
            'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */
            'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
        ),
			'description' =>  $options_treatments_names['plural'] ? $options_treatments_names['plural'].' for '.get_bloginfo() :__( 'Treatments for '.get_bloginfo() ), /* Product Description */
			'public' => true,
			'menu_icon' => 'dashicons-plus-alt',
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'rewrite'	=> array( 'slug' => $options_treatments_names['slug'] ? $options_treatments_names['slug'] :'treatments', 'with_front' => true ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title','post-options','editor','page-attributes', 'author', 'excerpt','thumbnail'),
      'show_in_rest' => true,
	 	) /* end of options */
	); /* end of register post type */
}
add_action( 'init','create_pt_treatments' );

function create_treatments_cat_tax() {
    $options_treatments_names = get_option('post_type_treatments_names');
	$labels = array(
        'name'              => _x( $options_treatments_names['singular'] ? $options_treatments_names['singular'].' Category' :'Treatment Category', 'taxonomy general name' ),
        'singular_name'     => _x( $options_treatments_names['singular'] ? $options_treatments_names['singular'].' Category' :'Treatment Category', 'taxonomy singular name' ),
        'search_items'      => __( $options_treatments_names['singular'] ? 'Search '.$options_treatments_names['singular'].' Сategories' :'Search Treatment Сategories' ),
        'all_items'         => __( $options_treatments_names['singular'] ? 'All '.$options_treatments_names['singular'].' Сategories' :'All Treatment Сategories' ),
        'parent_item'       => __( $options_treatments_names['singular'] ? 'Parent '.$options_treatments_names['singular'].' Сategory' :'Parent Treatment Сategory' ),
        'parent_item_colon' => __( $options_treatments_names['singular'] ? 'All '.$options_treatments_names['singular'].' Сategory' :'Parent Treatment Сategory:' ),
        'edit_item'         => __( $options_treatments_names['singular'] ? 'Edit '.$options_treatments_names['singular'].' Сategory' :'Edit Treatment Сategory' ),
        'update_item'       => __( $options_treatments_names['singular'] ? 'Update '.$options_treatments_names['singular'].' Сategory' :'Update Treatment Сategory' ),
        'add_new_item'      => __( $options_treatments_names['singular'] ? 'Add New '.$options_treatments_names['singular'].' Сategory' :'Add New Treatment Сategory' ),
        'new_item_name'     => __( $options_treatments_names['singular'] ? 'New '.$options_treatments_names['singular'].' Сategory Name' :'New Treatment Сategory Name' ),
        'menu_name'         => __( $options_treatments_names['singular'] ? $options_treatments_names['singular'].' Сategory' :'Treatment Category' ),
    );

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
        'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'treatments-category' ),
	);

	register_taxonomy( 'treatments_category', array( 'treatments' ), $args );
}
add_action( 'init', 'create_treatments_cat_tax' );

function treatments_meta_box_ca() {
    add_meta_box( 'treatments_meta_box_ca',
        'Content Association',
        'urge_options_display_child_meta_box_ca', // Use urge_options_display_child_meta_box_ca() from parent plugin
        'treatments',
        'normal',
        'high'
    );
}

$options_treatments_caf = get_option('post_type_treatments_caf');
if ($options_treatments_caf){
    add_action( 'add_meta_boxes', 'treatments_meta_box_ca' );
}
