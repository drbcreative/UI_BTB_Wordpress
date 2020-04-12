<?php
/*
Plugin Name: UI Promotions
Description: Custom content types for themes developed by Urge Interactive
Version: 2.0
Author: Urge Interactive
Author URI: http://urgeinteractive.com
*/

function promotions_load_assets(){
    wp_enqueue_script('jquery-ui-datepicker');

    wp_enqueue_style( 'promotions_jquery-ui-custom',plugins_url('/assets/css/jquery-ui-flat/jquery-ui-1.10.4.custom.min.css?v=.time()',__FILE__));
    wp_enqueue_script( 'promotions_datetimepicker-js',plugins_url('/assets/js/DateTimePicker.js',__FILE__), array('jquery'), time(), false);
    wp_enqueue_style( 'promotions_date-time-picker-styles', plugins_url('/assets/css/DateTimePicker.min.css?v='.time(),__FILE__));
    wp_enqueue_script('promotions_custom-js', plugins_url('/assets/js/metaboxes.js?v='.time(),__FILE__), 'jquery-ui-core', '1.0', true);

}
add_action( 'admin_enqueue_scripts','promotions_load_assets' );

function create_pt_promotions() {
    $options_promotions_names = get_option('post_type_promotions_names');
    register_post_type( 'promotions', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
        array('labels' => array(
            'name' => $options_promotions_names['plural'] ? $options_promotions_names['plural'] : __('Promotions'), /* This is the Title of the Group */
            'singular_name' => $options_promotions_names['singular'] ? $options_promotions_names['singular'] :__('Promotion'), /* This is the individual type */
            'all_items' => $options_promotions_names['singular'] ? 'All '.$options_promotions_names['singular'] :__('All Promotion'), /* the all items menu item */
            'add_new' => $options_promotions_names['singular'] ? 'Add New '.$options_promotions_names['singular'] :__('Add New Promotion'), /* The add new menu item */
            'add_new_item' => $options_promotions_names['singular'] ? 'Add New '.$options_promotions_names['singular'] :__('Add New Promotion'), /* Add New Display Title */
            'edit' => __( 'Edit' ), /* Edit Dialog */
            'edit_item' => $options_promotions_names['singular'] ? 'Edit '.$options_promotions_names['singular'] :__('Edit Promotion'), /* Edit Display Title */
            'new_item' => $options_promotions_names['singular'] ? 'New '.$options_promotions_names['singular'] :__('New Promotion'), /* New Display Title */
            'view_item' => $options_promotions_names['singular'] ? 'View '.$options_promotions_names['singular'] :__('View Promotion'), /* View Display Title */
            'search_items' => $options_promotions_names['plural'] ? 'Search '.$options_promotions_names['plural'] :__('Search Promotions'), /* Search Product Title */
            'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */
            'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
        ),
            'description' => $options_promotions_names['plural'] ? $options_promotions_names['plural'].' for '.get_bloginfo() :__( 'Promotions for '.get_bloginfo() ), /* Product Description */
            'public' => true,
            'menu_icon' => 'dashicons-awards',
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'show_ui' => true,
            'query_var' => true,
            'rewrite'   => array( 'slug' => $options_promotions_names['slug'] ? $options_promotions_names['slug'] :'promotions', 'with_front' => true ), /* you can specify its url slug */
            'has_archive' => true, /* you can rename the slug here */
            'capability_type' => 'post',
            'hierarchical' => false,
            'supports' => array( 'title','post-options','editor','page-attributes', 'author', 'excerpt','thumbnail'),
      'show_in_rest' => true,
        ) /* end of options */
    ); /* end of register post type */
}
add_action( 'init','create_pt_promotions' );

function promotions_meta_boxes(){
    $options_promotions_names = get_option('post_type_promotions_names');
    add_meta_box( 'promotions_meta_box',
        $options_promotions_names['singular']?$options_promotions_names['singular'].' Information':'Promotions Information',
        'display_promotions_meta_box',
        'promotions',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes','promotions_meta_boxes' );

function display_promotions_meta_box(){
    global $post;
    $promotionNotify    = get_post_meta($post->ID, 'promotion_email_to', true);
    $promotionAddress   = get_post_meta($post->ID, 'promotion_address', true);
    $startDate      = get_post_meta($post->ID, 'promotion_start_date', true);
    $startTime      = get_post_meta($post->ID, 'promotion_start_time', true);
    $endDate        = get_post_meta($post->ID, 'promotion_end_date', true);
    $endTime        = get_post_meta($post->ID, 'promotion_end_time', true);

?>
    <div id="date-time-box"></div>
    <table class="form-table">
        <tr>
            <th><label for="promotion_email_to">Notify</label></th>
            <td>
                <input type="text" name="promotion_email_to" id="promotion_email_to" value="<?php echo $promotionNotify ?>" size="30">
            </td>
        </tr>
        <tr>
            <th><label for="promotion_address">Address</label></th>
            <td>
                <input type="text" name="promotion_address" id="promotion_address" value="<?php echo $promotionAddress ?>" size="30">
            </td>
        </tr>
 
        <tr>
            <th><label for="promotion_start_time">Start Time & Date</label></th>
            <td>
                <input type="text" class="time" name="promotion_start_time" id="promotion_start_time" value="<?php echo $startTime ?>" size="30" data-field="datetime">
                <br><span class="description">Start time of the promotion.</span>
            </td>
        </tr>
   
        <tr>
            <th><label for="promotion_end_time">End Time & Date</label></th>
            <td>
                <input type="text" class="time" name="promotion_end_time" id="promotion_end_time" value="<?php echo $endTime ?>" size="30" data-field="datetime">
                <br><span class="description">End time of the promotion.</span>
            </td>
        </tr>
    </table>

 
<?php
}

function promotions_meta_boxes_ca(){
    add_meta_box( 'promotions_meta_box_ca',
        'Content Association',
        'urge_options_display_child_meta_box_ca', // Use urge_options_display_child_meta_box_ca() from parent plugin
        'promotions',
        'normal',
        'high'
    );
}

$options_promotions_caf = get_option('post_type_promotions_caf');
if ($options_promotions_caf){
    add_action( 'add_meta_boxes','promotions_meta_boxes_ca' );
}


function save_promotions_custom_meta( $id, $item ) {
    // Check post type
    if ( $item->post_type == 'promotions' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['promotion_email_to'] )  ) {
            update_post_meta( $id, 'promotion_email_to',$_POST['promotion_email_to'] );
        }
        if ( isset( $_POST['promotion_address'] )  ) {
            update_post_meta( $id, 'promotion_address',$_POST['promotion_address'] );
        }
        if ( isset( $_POST['promotion_start_date'] )  ) {
            update_post_meta( $id, 'promotion_start_date', strtotime($_POST['promotion_start_date']) );
        }
        if ( isset( $_POST['promotion_start_time'] )  ) {
            update_post_meta( $id, 'promotion_start_time', $_POST['promotion_start_time'] );
        }
        if ( isset( $_POST['promotion_end_date'] ) ) {
            update_post_meta( $id, 'promotion_end_date', strtotime($_POST['promotion_end_date']) );
        }
        if ( isset( $_POST['promotion_end_time'] ) ) {
            update_post_meta( $id, 'promotion_end_time', $_POST['promotion_end_time'] );
        }
    }
}
add_action( 'save_post','save_promotions_custom_meta',10,2 );

function promotion_expiration(){
    //MUST SET DATE FORMAT TO F j, Y IN GENERAL SETTINGS | /wp-admin/options-general.php
    //MUST SET TIME FORMAT TO g:i A IN GENERAL SETTINGS | /wp-admin/options-general.php
    if ( ! is_admin() ) {
    $argsT = array(
        'post_type'             => 'promotions',
        'posts_per_page'        => -1,
    );

    $the_queryT = new WP_Query( $argsT );

    $postsT = $the_queryT->get_posts();
    
    if($postsT){
        foreach ($postsT as $postT) {
            // Set timezone
            date_default_timezone_set('America/Los_Angeles');

            // Get Post Time
            $meta = get_post_meta($postT->ID, 'promotion_end_time', true);
            $filtered = str_replace('-','/', $meta);
            $endTimeDate = strtotime($filtered); 

            // Todays Date
            $todaysDate =  mktime(); 
            
            if ($endTimeDate > $todaysDate) {
                wp_update_post( array('ID' => $postT->ID, 'post_status'  => 'publish') );

            } else  {
                wp_update_post( array('ID' => $postT->ID, 'post_status'  => 'private') );

            }
        }
    }
}
}
add_action( 'init','promotion_expiration' );
