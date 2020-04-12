<?php
/*
Plugin Name: UI Providers
Description: Custom content types for themes developed by Urge Interactive
Version: 2.0
Author: Urge Interactive
Author URI: http://urgeinteractive.com
*/
function providers_load_assets(){
    wp_enqueue_script('providers_custom-js', plugins_url('/assets/js/metaboxes.js?v='.time(),__FILE__), 'jquery-ui-core', '1.0', true);
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts','providers_load_assets' );


function create_pt_providers() {
    $options_providers_names = get_option('post_type_providers_names');
	register_post_type( 'providers', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
        array('labels' => array(
            'name' => $options_providers_names['plural'] ? $options_providers_names['plural'] : __('Providers'), /* This is the Title of the Group */
            'singular_name' => $options_providers_names['singular'] ? $options_providers_names['singular'] :__('Provider'), /* This is the individual type */
            'all_items' => $options_providers_names['singular'] ? 'All '.$options_providers_names['singular'] :__('All Provider'), /* the all items menu item */
            'add_new' => $options_providers_names['singular'] ? 'Add New '.$options_providers_names['singular'] :__('Add New Provider'), /* The add new menu item */
            'add_new_item' => $options_providers_names['singular'] ? 'Add New '.$options_providers_names['singular'] :__('Add New Provider'), /* Add New Display Title */
            'edit' => __( 'Edit' ), /* Edit Dialog */
            'edit_item' => $options_providers_names['singular'] ? 'Edit '.$options_providers_names['singular'] :__('Edit Provider'), /* Edit Display Title */
            'new_item' => $options_providers_names['singular'] ? 'New '.$options_providers_names['singular'] :__('New Provider'), /* New Display Title */
            'view_item' => $options_providers_names['singular'] ? 'View '.$options_providers_names['singular'] :__('View Provider'), /* View Display Title */
            'search_items' => $options_providers_names['plural'] ? 'Search '.$options_providers_names['plural'] :__('Search Providers'), /* Search Product Title */
            'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */
            'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
        ),
			'description' => $options_providers_names['plural'] ? $options_providers_names['plural'].' for '.get_bloginfo() :__( 'Providers for '.get_bloginfo() ), /* Product Description */
			'public' => true,
			'menu_icon' => 'dashicons-groups',
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'rewrite'	=> array( 'slug' => $options_providers_names['slug'] ? $options_providers_names['slug'] :'providers', 'with_front' => true ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
      'supports' => array( 'title','post-options','editor','page-attributes', 'author', 'excerpt','thumbnail'),
      'show_in_rest' => true,
	 	) /* end of options */
	); /* end of register post type */
}
add_action( 'init','create_pt_providers' );

function create_provider_tax() {
    $options_providers_names = get_option('post_type_providers_names');
    $labels = array(
        'name'              => _x( $options_providers_names['singular'] ? $options_providers_names['singular'].' Category' :'Provider Category', 'taxonomy general name' ),
        'singular_name'     => _x( $options_providers_names['singular'] ? $options_providers_names['singular'].' Category' :'Provider Category', 'taxonomy singular name' ),
        'search_items'      => __( $options_providers_names['singular'] ? 'Search '.$options_providers_names['singular'].' Сategories' :'Search Provider Сategories' ),
        'all_items'         => __( $options_providers_names['singular'] ? 'All '.$options_providers_names['singular'].' Сategories' :'All Provider Сategories' ),
        'parent_item'       => __( $options_providers_names['singular'] ? 'Parent '.$options_providers_names['singular'].' Сategory' :'Parent Provider Сategory' ),
        'parent_item_colon' => __( $options_providers_names['singular'] ? 'All '.$options_providers_names['singular'].' Сategory' :'Parent Provider Сategory:' ),
        'edit_item'         => __( $options_providers_names['singular'] ? 'Edit '.$options_providers_names['singular'].' Сategory' :'Edit Provider Сategory' ),
        'update_item'       => __( $options_providers_names['singular'] ? 'Update '.$options_providers_names['singular'].' Сategory' :'Update Provider Сategory' ),
        'add_new_item'      => __( $options_providers_names['singular'] ? 'Add New '.$options_providers_names['singular'].' Сategory' :'Add New Provider Сategory' ),
        'new_item_name'     => __( $options_providers_names['singular'] ? 'New '.$options_providers_names['singular'].' Сategory Name' :'New Provider Сategory Name' ),
        'menu_name'         => __( $options_providers_names['singular'] ? $options_providers_names['singular'].' Сategory' :'Provider Category' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'provider_info' ),
        'meta_box_cb'                => false,
    );

    register_taxonomy( 'provider_info', array( 'providers' ), $args );
}
add_action( 'init', 'create_provider_tax' );

function create_provider_department_tax() {
    $options_providers_names = get_option('post_type_providers_names');
    $labels = array(
        'name'              => _x( $options_providers_names['singular'] ? $options_providers_names['singular'].' Category' :'Provider Department', 'taxonomy general name' ),
        'singular_name'     => _x( $options_providers_names['singular'] ? $options_providers_names['singular'].' Category' :'Provider Department', 'taxonomy singular name' ),
        'search_items'      => __( $options_providers_names['singular'] ? 'Search '.$options_providers_names['singular'].' Сategories' :'Search Provider Departments' ),
        'all_items'         => __( $options_providers_names['singular'] ? 'All '.$options_providers_names['singular'].' Сategories' :'All Provider Departments' ),
        'parent_item'       => __( $options_providers_names['singular'] ? 'Parent '.$options_providers_names['singular'].' Сategory' :'Parent Provider Department' ),
        'parent_item_colon' => __( $options_providers_names['singular'] ? 'All '.$options_providers_names['singular'].' Сategory' :'Parent Provider Department:' ),
        'edit_item'         => __( $options_providers_names['singular'] ? 'Edit '.$options_providers_names['singular'].' Сategory' :'Edit Provider Department' ),
        'update_item'       => __( $options_providers_names['singular'] ? 'Update '.$options_providers_names['singular'].' Сategory' :'Update Provider Department' ),
        'add_new_item'      => __( $options_providers_names['singular'] ? 'Add New '.$options_providers_names['singular'].' Сategory' :'Add New Provider Department' ),
        'new_item_name'     => __( $options_providers_names['singular'] ? 'New '.$options_providers_names['singular'].' Сategory Name' :'New Provider Department Name' ),
        'menu_name'         => __( $options_providers_names['singular'] ? $options_providers_names['singular'].' Сategory' :'Provider Department' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'department' ),
//        'show_in_quick_edit'         => false,
        'meta_box_cb'                => false,
    );

    register_taxonomy( 'provider_department', array( 'providers' ), $args );
}
add_action( 'init', 'create_provider_department_tax' );


function provider_title_meta_box() {
    $options_providers_names = get_option('post_type_providers_names');
    add_meta_box( 'provider_meta_box',
        $options_providers_names['singular']?$options_providers_names['singular'].' Category':'Provider Information',
        'display_provider_meta_box',
        'providers',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'provider_title_meta_box' );

function display_provider_meta_box() {
    global $post;
    $provider_title = get_post_meta($post->ID, 'provider_title', true);
    $provider_schedule_link = get_post_meta($post->ID, 'provider_schedule_link', true);
    $provider_info = wp_get_post_terms($post->ID, 'provider_info', array("fields" => "ids"));
	  $provider_department = wp_get_post_terms($post->ID, 'provider_department', array("fields" => "ids"));

    $terms = get_terms([
        'taxonomy' => 'provider_info',
        'hide_empty' => false,
        'fields' => "id=>name"
    ]);

    $departments = get_terms([
        'taxonomy' => 'provider_department',
        'hide_empty' => false,
        'fields' => "id=>name"
    ]);

?>

    <table class="form-table">

        <tr>
            <td>
	            <label for="">Category/Suffix</label>
                <select name="provider_info[]" id="provider_info_list" multiple="multiple">
                    <option value="">Select One</option>
                    <?php foreach($terms as $key => $value ): ?>
                        <option value="<?php echo $value ?>", <?php echo $provider_info&&in_array($key,$provider_info)?' selected="selected"':''?> ><?php echo $value ?></option>;
                    <?php endforeach ?>
                </select>
                <br /><span class="description">The provider's suffix, e.g. MD or FNP</span>
            </td>
        </tr>
        <tr>
	        <td>
		        <label for="">Provider Title</label><br>
		        <input name="provider_title" id="provider_title"  type="text" value="<?php echo $provider_title ?>">
		        <br /><span class="description">The provider's title, e.g. CEO/Founder</span>
	        </td>
        </tr>
        <tr>
	        <td>
		        <label for="">External Schedule URL</label><br>
		        <input name="provider_schedule_link" id="provider_schedule_link"  type="text" value="<?php echo $provider_schedule_link ?>">
		        <br /><span class="description">The provider's external link to schedule. e.g. https://zocdoc.com/doctor/greg-morganroth-md-3393</span>
	        </td>
        </tr>
        <tr>
            <td>
	            <label for="">Department</label>
                <select name="provider_department[]" id="provider_department_list" multiple="multiple">
                    <option value="">Select One</option>
                    <?php foreach($departments as $key => $value ): ?>
                        <option value="<?php echo $value ?>", <?php echo $provider_department&&in_array($key,$provider_department)?' selected="selected"':''?> ><?php echo $value ?></option>;
                    <?php endforeach ?>
                </select>
                <br /><span class="description">The provider's department, e.g. Department of Dermatology</span>
            </td>
        </tr>

    </table>

<?php
}


function provider_title_meta_box_ca() {
    add_meta_box( 'provider_meta_box_ca',
        'Content Association',
        'urge_options_display_child_meta_box_ca', // Use urge_options_display_child_meta_box_ca() from parent plugin
        'providers',
        'normal',
        'high'
    );
}

$options_providers_caf = get_option('post_type_providers_caf');
if ($options_providers_caf){
    add_action( 'add_meta_boxes', 'provider_title_meta_box_ca' );
}


function save_providers_custom_meta( $id, $item ) {

    if( $item->post_type === 'providers' ) {
        if (!empty($_POST['provider_info'])) {

            $slugs = $_POST['provider_info'];

            wp_set_object_terms($id, $slugs, 'provider_info', false);
        } else {
            wp_set_object_terms($id, null, 'provider_info', false);
        }

        if (!empty($_POST['provider_department'])) {

            $slugs = $_POST['provider_department'];

            wp_set_object_terms($id, $slugs, 'provider_department', false);
        } else {
            wp_set_object_terms($id, null, 'provider_department', false);
        }

        // Store data in post meta table if present in post data
        if ( isset( $_POST['attachment'] )  ) {
            update_post_meta( $id, 'attachment',$_POST['attachment'] );
        }

        if ( isset( $_POST['provider_title'] ) ) {
            update_post_meta( $id, 'provider_title',$_POST['provider_title'] );
        }

        if ( isset( $_POST['provider_schedule_link'] ) ) {
            update_post_meta( $id, 'provider_schedule_link',$_POST['provider_schedule_link'] );
        }

    }
}
add_action( 'save_post', 'save_providers_custom_meta',10,2 );



function urge_options_download_images_meta_boxes(){
    add_meta_box( 'downloads_meta_box',
        'Alternate Image',
        'display_urge_options_download_images_meta_box',
        'providers',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes','urge_options_download_images_meta_boxes' );


function display_urge_options_download_images_meta_box($post){
    $attachment = esc_html( get_post_meta( $post->ID, 'attachment', true ) );
    ?>

    <script>
        function showMediaUploader(element){
            var mediaUploader;
            // If the uploader object has already been created, reopen the dialog
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            // Extend the wp.media object
            mediaUploader = wp.media.frames.file_frame = wp.media(
                {
                    title: 'Choose Alternate Image',
                    button: {
                        text: 'Choose Alternate Image'
                    },
                    multiple: false
                });
            mediaUploader.on('select', function() {
                selection = mediaUploader.state().get('selection')
                selection.map( function( attachment ) {
                    attachment = attachment.toJSON()
                    element.val(attachment.url)

                    console.log(attachment.url);

                    jQuery('.additional-image img').attr('src', attachment.url);
                    jQuery('.additional-image img').show();

                });
            });
            // Open the uploader dialog
            mediaUploader.open();
        }

        jQuery(document).ready(function($){
            $('#add_attachment').on('click',function(){
                showMediaUploader($('#attachment'));
            });

            $('#remove_attachment').on('click',function(){
                $('#attachment').val('')
                $('.additional-image img').hide();
            })
        });
    </script>

    <input id="add_attachment" type="button" value="<?php echo $attachment?'Change Additional Image':'Add Additional Image'?>" style="margin:20px 0px;">
    <input id="remove_attachment" type="button" value="Delete" style="margin:20px 0px;">
    <input id="attachment" name="attachment" type="hidden" value="<?php echo $attachment ?>">
    <div class="additional-image">
        <img src="<?php echo $attachment ?>" style="max-width: 700px">
    </div>

<?php }

function provider_text_column($header_text_columns) {
  $header_text_columns['menu_order'] = "Order";
  return $header_text_columns;
}
add_action('manage_providers_posts_columns', 'provider_text_column');

function provider_show_order_column($name){
  global $post;

  switch ($name) {
    case 'menu_order':
      $order = $post->menu_order;
      echo $order;
      break;
   default:
      break;
   }
}
add_action('manage_providers_posts_custom_column','provider_show_order_column');

function provider_order_column_register_sortable($columns){
  $columns['menu_order'] = 'menu_order';
  return $columns;
}
add_filter('manage_providers_sortable_columns','provider_order_column_register_sortable');
