<?php
/*
Plugin Name: UI Concerns
Description: Custom content types for themes developed by Urge Interactive
Version: 2.0
Author: Urge Interactive
Author URI: http://urgeinteractive.com
*/


function create_pt_concerns() {
    $options_concerns_names = get_option('post_type_concerns_names');

	register_post_type( 'concerns', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	array('labels' => array(
			'name' => $options_concerns_names['plural'] ? $options_concerns_names['plural'] : __('Concerns'), /* This is the Title of the Group */
			'singular_name' => $options_concerns_names['singular'] ? $options_concerns_names['singular'] :__('Concern'), /* This is the individual type */
			'all_items' => $options_concerns_names['singular'] ? 'All '.$options_concerns_names['singular'] :__('All Concern'), /* the all items menu item */
			'add_new' => $options_concerns_names['singular'] ? 'Add New '.$options_concerns_names['singular'] :__('Add New Concern'), /* The add new menu item */
			'add_new_item' => $options_concerns_names['singular'] ? 'Add New '.$options_concerns_names['singular'] :__('Add New Concern'), /* Add New Display Title */
			'edit' => __( 'Edit' ), /* Edit Dialog */
			'edit_item' => $options_concerns_names['singular'] ? 'Edit '.$options_concerns_names['singular'] :__('Edit Concern'), /* Edit Display Title */
			'new_item' => $options_concerns_names['singular'] ? 'New '.$options_concerns_names['singular'] :__('New Concern'), /* New Display Title */
			'view_item' => $options_concerns_names['singular'] ? 'View '.$options_concerns_names['singular'] :__('View Concern'), /* View Display Title */
			'search_items' => $options_concerns_names['plural'] ? 'Search '.$options_concerns_names['plural'] :__('Search Concerns'), /* Search Product Title */
			'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */
			'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			),
			'description' => $options_concerns_names['plural'] ? $options_concerns_names['plural'].' for '.get_bloginfo() :__( 'Concerns for '.get_bloginfo() ), /* Product Description */
			'public' => true,
			'menu_icon' => 'dashicons-plus',
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'rewrite'	=> array( 'slug' => $options_concerns_names['slug'] ? $options_concerns_names['slug'] :'concerns', 'with_front' => true ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
      'supports' => array( 'title','post-options','editor','page-attributes', 'author', 'excerpt','thumbnail'),
      'show_in_rest' => true,
			'taxonomies' => array( 'post_tag' ),

	 	) /* end of options */
	); /* end of register post type */
}
add_action( 'init','create_pt_concerns' );

function create_concerns_cat_tax() {
    $options_concerns_names = get_option('post_type_concerns_names');

	$labels = array(
			'name'              => _x( $options_concerns_names['plural'] ? $options_concerns_names['plural'].' Сategories' :'Concerns Сategories', 'taxonomy general name' ),
			'singular_name'     => _x( $options_concerns_names['plural'] ? $options_concerns_names['plural'].' Сategory' :'Concerns Сategory', 'taxonomy singular name' ),
			'search_items'      => __( $options_concerns_names['plural'] ? 'Search '.$options_concerns_names['plural'].' Сategories' :'Search Concerns Сategories' ),
			'all_items'         => __( $options_concerns_names['plural'] ? 'All '.$options_concerns_names['plural'].' Сategories' :'All Concerns Сategories' ),
			'parent_item'       => __( $options_concerns_names['plural'] ? 'Parent '.$options_concerns_names['plural'].' Сategory' :'Parent Concerns Сategory' ),
			'parent_item_colon' => __( $options_concerns_names['plural'] ? 'Parent '.$options_concerns_names['plural'].' Сategory' :'Parent Concerns Сategory:' ),
			'edit_item'         => __( $options_concerns_names['plural'] ? 'Edit '.$options_concerns_names['plural'].' Сategory' :'Edit Concerns Сategory' ),
			'update_item'       => __( $options_concerns_names['plural'] ? 'Update '.$options_concerns_names['plural'].' Сategory' :'Update Concerns Сategory' ),
			'add_new_item'      => __( $options_concerns_names['plural'] ? 'Add New '.$options_concerns_names['plural'].' Сategory' :'Add New Concerns Сategory' ),
			'new_item_name'     => __( $options_concerns_names['plural'] ? 'New '.$options_concerns_names['plural'].' Сategory Name' :'New Concerns Сategory Name' ),
			'menu_name'         => __( $options_concerns_names['plural'] ? $options_concerns_names['plural'].' Сategories' :'Concerns Сategories' ),
		);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
    'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => $options_concerns_names['slug'] ? $options_concerns_names['slug'].'_category' :'concerns_category' ),
	);

	register_taxonomy( 'concerns_category', array( 'concerns' ), $args );
}
add_action( 'init', 'create_concerns_cat_tax' );


function concerns_meta_boxes_ca(){
    add_meta_box( 'events_meta_box_ca',
        'Content Association',
        'urge_options_display_child_meta_box_ca', // Use urge_options_display_child_meta_box_ca() from parent plugin
        'concerns',
        'normal',
        'high'
    );
}


if (get_option('post_type_concerns_caf')){
    add_action( 'add_meta_boxes','concerns_meta_boxes_ca' );
}


function concerns_shortcode( $atts ){
	$args = array(
		'post_type'       => 'concerns',
		'posts_per_page'  => -1,
	);
	if($_GET['category']){
		$categories = explode(';', $_GET['category']);
		foreach ($categories as $item) {
			$terms[] = $item;
		}
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'concerns_category',
				'field'    => 'slug',
				'terms'    => $terms,
			),
		);
	}
	new WP_Query( $args );
	$loop = new WP_Query( $args ); ?>
	<?php if ( $loop->have_posts() ):  ?>
		<ul class=“elements-list”>
			<?php while ( $loop->have_posts() ) : $loop->the_post() ?>
				<li><a href="<?php echo the_permalink(); ?>"><?php the_title() ?></a></li>
			<?php endwhile ?>
		</ul>
	<?php else: ?>
		'No concerns found'
	<?php endif ?>
<?php }
add_shortcode( 'concerns', 'concerns_shortcode' );

function related_treatments_shortcode(){
	$postId = get_the_ID();
	$treatments = get_post_meta($postId, 'concern_treatments', true);
	if(!empty($treatments)): ?>
		<ul>
			<?php foreach ($treatments as $id): ?>
				<?php $item = get_post($id) ?>
				<li><a href="<?php echo site_url().'/'.$item->post_name?>"><?php echo $item->post_title ?></a></li>
			<?php endforeach ?>
		</ul>
	<?php endif ?>
<?php }
add_shortcode( 'related_treatments', 'related_treatments_shortcode' );


if(!function_exists('related_galleries_shortcode')){
	function related_galleries_shortcode(){
		$galleries = get_post_meta(get_the_ID(),'concern_galleries'); ?>
		<?php if(isset($galleries[0]) && !empty($galleries[0])): ?>
			<div class="row">
				<?php foreach ($galleries[0] as $val): ?>
					<?php $gallery = get_post($val); ?>
					<div class="col-md-4">
						<a href="<?php echo site_url() ?>/galleries/<?php echo $gallery->post_name ?>" class="btn btn-blue"><?php echo $gallery->post_title ?></a>
					</div>
				<?php endforeach ?>
			</div>
		<?php endif;
	}
	add_shortcode( 'related_galleries', 'related_galleries_shortcode' );
}
