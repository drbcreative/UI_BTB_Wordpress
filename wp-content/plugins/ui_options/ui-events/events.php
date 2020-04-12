<?php
/*
Plugin Name: UI Events
Description: Custom content types for themes developed by Urge Interactive
Version: 2.1
Author: Urge Interactive
Author URI: http://urgeinteractive.com
*/
session_start();

$options_requests = get_option('post_type_event_rsvp');
if ($options_requests) {
    include_once(plugin_dir_path(__FILE__) . '/event-rsvp/event-rsvp.php');
}

function events_load_assets(){
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style( 'events_metabox-styles', plugins_url('/assets/css/metaboxes.css?v='.time(),__FILE__));
    wp_enqueue_style( 'events_jquery-ui-custom',plugins_url('/assets/css/jquery-ui-flat/jquery-ui-1.10.4.custom.min.css?v=.time()',__FILE__));
    wp_enqueue_script( 'events_datetimepicker-js',plugins_url('/assets/js/DateTimePicker.js',__FILE__), array('jquery'), time(), false);
    wp_enqueue_style( 'events_date-time-picker-styles', plugins_url('/assets/css/DateTimePicker.min.css?v='.time(),__FILE__));
    wp_enqueue_script('events_custom-js', plugins_url('/assets/js/metaboxes.js?v='.time(),__FILE__), 'jquery-ui-core', '1.0', true);
}
add_action( 'admin_enqueue_scripts','events_load_assets' );


function events_load_assets_front(){






    if ( is_page( array( 'rsvp' ) ) ) {
      wp_enqueue_script('events_custom-js_front', plugins_url('/assets/js/events_front.js?v='.time(),__FILE__), array('jquery'), time(), true);
      wp_enqueue_style( 'events_custom-styles-front', plugins_url('/assets/css/events-front.css?v='.time(),__FILE__));
    }

}
add_action( 'wp_enqueue_scripts','events_load_assets_front' );

function create_pt_events() {
    $options_events_names = get_option('post_type_events_names');
    register_post_type( 'events', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
        array('labels' => array(
            'name' => $options_events_names['plural'] ? $options_events_names['plural'] : __('Events'), /* This is the Title of the Group */
            'singular_name' => $options_events_names['singular'] ? $options_events_names['singular'] :__('Event'), /* This is the individual type */
            'all_items' => $options_events_names['singular'] ? 'All '.$options_events_names['singular'] :__('All Event'), /* the all items menu item */
            'add_new' => $options_events_names['singular'] ? 'Add New '.$options_events_names['singular'] :__('Add New Event'), /* The add new menu item */
            'add_new_item' => $options_events_names['singular'] ? 'Add New '.$options_events_names['singular'] :__('Add New Event'), /* Add New Display Title */
            'edit' => __( 'Edit' ), /* Edit Dialog */
            'edit_item' => $options_events_names['singular'] ? 'Edit '.$options_events_names['singular'] :__('Edit Event'), /* Edit Display Title */
            'new_item' => $options_events_names['singular'] ? 'New '.$options_events_names['singular'] :__('New Event'), /* New Display Title */
            'view_item' => $options_events_names['singular'] ? 'View '.$options_events_names['singular'] :__('View Event'), /* View Display Title */
            'search_items' => $options_events_names['plural'] ? 'Search '.$options_events_names['plural'] :__('Search Events'), /* Search Product Title */
            'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */
            'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
            ),
            'description' => $options_events_names['plural'] ? $options_events_names['plural'].' for '.get_bloginfo() :__( 'Events for '.get_bloginfo() ), /* Product Description */
            'public' => true,
            'menu_icon' => 'dashicons-calendar',
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'show_ui' => true,
            'query_var' => true,
            'rewrite'   => array( 'slug' => $options_events_names['slug'] ? $options_events_names['slug'] :'events', 'with_front' => true ), /* you can specify its url slug */
            'has_archive' => true, /* you can rename the slug here */
            'capability_type' => 'post',
            'hierarchical' => false,
      'supports' => array( 'title','post-options','editor','page-attributes', 'author', 'excerpt','thumbnail'),
      'show_in_rest' => true,
        ) /* end of options */
    ); /* end of register post type */
}
add_action( 'init','create_pt_events' );

function events_meta_boxes(){
    $options_events_names = get_option('post_type_events_names');
    add_meta_box( 'events_meta_box',
        $options_events_names['singular']?$options_events_names['singular'].' Information':'Events Information',
        'display_events_meta_box',
        'events',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes','events_meta_boxes' );


function display_events_meta_box(){
    global $post;
    $eventNotify    = get_post_meta($post->ID, 'event_email_to', true);
    $eventAddress   = get_post_meta($post->ID, 'event_address', true);
    $startDate      = get_post_meta($post->ID, 'event_start_date', true);
    $startTime      = get_post_meta($post->ID, 'event_start_time', true);
    $endDate        = get_post_meta($post->ID, 'event_end_date', true);
    $endTime        = get_post_meta($post->ID, 'event_end_time', true);
    $display_map    = get_post_meta($post->ID, 'event_display_map', true);

?>
    <div id="date-time-box"></div>
    <table class="form-table">
        <tr>
            <th><label for="event_email_to">Notify</label></th>
            <td>
                <input type="text" name="event_email_to" id="event_email_to" value="<?php echo $eventNotify ?>" size="30">
            </td>
        </tr>
        <tr>
            <th><label for="event_address">Address</label></th>
            <td>
                <input type="text" name="event_address" id="event_address" value="<?php echo $eventAddress ?>" size="30">
            </td>
        </tr>
  
        <tr>
            <th><label for="event_start_time">Start Time</label></th>
            <td>
                <input type="text" class="time" name="event_start_time" id="event_start_time" value="<?php echo $startTime; ?>" size="30" data-field="datetime">
                <br><span class="description">Start time of the event.</span>
            </td>
        </tr>

        <tr>
            <th><label for="event_end_time">End Time</label></th>
            <td>
                <input type="text" class="time" name="event_end_time" id="event_end_time" value="<?php echo $endTime; ?>" size="30" data-field="datetime">
                <br><span class="description">End time of the event.</span>
            </td>
        </tr>
        <tr>
            <th><label>Display map for:</label></th>
            <td>
                <input type="radio" name="event_display_map" value="location" <?php echo($display_map=='location')?'checked':''?> ><span>Location</span>
                <input type="radio" name="event_display_map" value="address" <?php echo($display_map=='address')?'checked':''?> ><span>Address</span>
            </td>
        </tr>

    </table>
<?php
}

function events_meta_boxes_ca(){
    add_meta_box( 'events_meta_box_ca',
        'Content Association',
        'urge_options_display_child_meta_box_ca', // Use urge_options_display_child_meta_box_ca() from parent plugin
        'events',
        'normal',
        'high'
    );
}
$options_events_caf = get_option('post_type_events_caf');

if ($options_events_caf){
    add_action( 'add_meta_boxes','events_meta_boxes_ca' );
}


function save_events_custom_meta( $id, $item ) {
    // Check post type
    if ( $item->post_type == 'events' ) {

        // Store data in post meta table if present in post data
        if ( isset( $_POST['event_email_to'] )  ) {
            update_post_meta( $id, 'event_email_to',$_POST['event_email_to'] );
        }
        if ( isset( $_POST['event_address'] )  ) {
            update_post_meta( $id, 'event_address',$_POST['event_address'] );
        }
  
        if ( isset( $_POST['event_start_time'] )  ) {
            update_post_meta( $id, 'event_start_time', $_POST['event_start_time'] );
        }


        if ( isset( $_POST['event_end_time'] ) ) {

            update_post_meta( $id, 'event_end_time',$_POST['event_end_time'] );   
        }

        if ( isset( $_POST['event_display_map'] ) ) {
            update_post_meta( $id, 'event_display_map', $_POST['event_display_map'] );
        }
    }
}
add_action( 'save_post','save_events_custom_meta',10,2 );

function event_expiration(){
    //MUST SET DATE FORMAT TO F j, Y IN GENERAL SETTINGS | /wp-admin/options-general.php
    //MUST SET TIME FORMAT TO g:i A IN GENERAL SETTINGS | /wp-admin/options-general.php
    if ( ! is_admin() ) {
    $argsT = array(
        'post_type'             => 'events',
        'posts_per_page'        => -1,
    );

    $the_queryT = new WP_Query( $argsT );

    $postsT = $the_queryT->get_posts();
    
    if($postsT){
        foreach ($postsT as $postT) {
            // Set timezone
            date_default_timezone_set('America/Los_Angeles');

            // Get Post Time
            $meta = get_post_meta($postT->ID, 'event_end_time', true);
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

add_action( 'init','event_expiration' );

function eventRsvpNotify($atts){

    ob_start();
?>
    <div class="event-rsvp-notify-form">
        <form class="rsvp"  name="EventRsvpForm" id="EventRsvpForm" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post">
                    <h3>RSVP for this event today!</h3>
            <div class="row"><div class="form-group col-sm-4">
                <label for="EventRsvpInputName">Name</label>
                <input type="text" class="form-control" id="EventRsvpInputName" name="EventRsvpInputName" placeholder="You name" required>
            </div>
                <div class="form-group col-sm-4">
                <label for="EventRsvpInputPhone">Phone</label>
                    <input type="text" class="form-control" id="EventRsvpInputPhone" name="EventRsvpInputPhone" placeholder="000-000-0000" required>
            </div>
                <div class="form-group col-sm-4">
                <label for="EventRsvpInputEmail">Email</label>
                <input type="email" class="form-control" id="EventRsvpInputEmail" name="EventRsvpInputEmail" placeholder="your.email@example.com">
            </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-gold hvr-grow-shadow">Confirm invitation</button>
                </div>

            <input type="hidden"  name="eventPostId" value="<?php echo$atts['id']?>">
            <input type="hidden" name="action" id="action" value="event_rsvp_form" >
                <?php wp_nonce_field('event_rsvp_form'); ?></div>
        </form>

        <div class="success-message" style="display: none;color: green">
            Your request sent successfuly!
        </div>
        <div class="error-message" style="display: none;color: red;">
            Please check your information.
        </div>
    </div>

<?php
    return ob_get_clean();
}
add_shortcode( 'event_rsvp_notify', 'eventRsvpNotify' );

function eventRsvpSave()
{
    $result=[];
//    delete_post_meta($_POST['eventPostId'], 'rsvp');

    if (empty($_POST) || !wp_verify_nonce($_POST['_wpnonce'], 'event_rsvp_form')) {
        die();
    } else {

        if(!empty($_POST['eventPostId']) && !empty($_POST['EventRsvpInputPhone'])){

            $eventNotify    = get_post_meta($_POST['eventPostId'], 'event_email_to', true);

            //send email
            //$to = $eventNotify;
            $to = 'luis@urgeinteractive.com';
            $subject = 'RSVP new submit';
            $body = 'Confirm invitation from site: '.'name: ' . $_POST['EventRsvpInputName'].
                ' phone: ' . $_POST['EventRsvpInputPhone'].
                ' email: ' . $_POST['EventRsvpInputEmail'];
            $headers = array('Content-Type: text/html; charset=UTF-8');

            wp_mail( $to, $subject, $body, $headers );

            $result['success'] = 'ok';
        }

        exit(json_encode($result));
    }
}
add_action('wp_ajax_nopriv_event_rsvp_form', 'eventRsvpSave');
add_action( 'wp_ajax_event_rsvp_form', 'eventRsvpSave' );


function get_complete_meta( $post_id, $meta_key ) {
    global $wpdb;
    $mid = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s", $post_id, $meta_key) );
    if( $mid != '' )
        return $mid;

    return false;
}


//form handle is realized in ui_requests plugin
function eventRsvpRadio($atts){

    $options_requests = get_option('post_type_event_rsvp');

    //if RSVP functionality disabled, not show form
    if(!$options_requests){
        return false;
    }


    $args = array(
        'post_type'             => 'events',
        'post_status'           => 'publish',
  
    );

    if(!empty($atts['id'])){
        $args['p'] = (int) $atts['id'];
    }

    $the_query = new WP_Query( $args );
    $events = $the_query->get_posts();


    ob_start();
    ?>
    <div id="rsvp-page-form">
        <?php if (!empty($events)) { ?>
        <form class="rsvp"  name="EventRsvpFormRadio" id="EventRsvpFormRadio"  method="post">
            <div class="rsvp_header" style="<?php echo (!empty($atts['id'])) ? 'display:none' :''; ?>">Select your event below:</div>


            <?php foreach ($events as $event) :?>
                <div class="radio" style="<?php echo (!empty($atts['id'])) ? 'display:none' :''; ?>">
                    <label>
                        <input type="radio" name="eventRadio" id="eventRadio" value="<?php echo$event->ID?>" <?php echo (!empty($atts['id'])) ? 'checked' :''; ?> >
                        <?php echo$event->post_title?>
                    </label>
                </div>
            <?php endforeach;?>

            <legend>Enter Your Details</legend>

                <div class="form-group">
                    <label for="EventRsvpInputName">First Name*</label>
                    <input type="text" class="form-control" id="EventRsvpInputName" name="EventRsvpInputName" placeholder="First Name" >
                </div>


                <div class="form-group">
                    <label for="EventRsvpInputLastName">Last Name*</label>
                    <input type="text" class="form-control" id="EventRsvpInputLastName" name="EventRsvpInputLastName" placeholder="Last Name" >
                </div>

            <div class="rsvp_new_patient">New or Existing Patient?</div>

            <div class="form-group">
                <label>
                    <input type="radio" name="newPatient" id="newPatient" value="new" >
                    <span> New patient </span>
                </label>
            </div>

            <div class="form-group">
                <label>
                    <input type="radio" name="newPatient" id="newPatient" value="existing" >
                    <span> Existing patient </span>
                </label>
            </div>

<!--
                <div class="form-group">
                    <label for="EventRsvpInputPatientProvider">If Existing Patient, Your Provider?</label>
                    <input type="text" class="form-control" id="EventRsvpInputPatientProvider" name="EventRsvpInputPatientProvider" >
                </div>

-->
                <div class="form-group">
                    <label for="EventRsvpInputEmail">Email Address*</label>
                    <input type="email" class="form-control" id="EventRsvpInputEmail" name="EventRsvpInputEmail" placeholder="Enter email" >
                </div>


                <div class="form-group">
                    <label for="EventRsvpInputPhone">Phone Number</label>
                    <input type="text" class="form-control" id="EventRsvpInputPhone" name="EventRsvpInputPhone" placeholder="(XXX)XXX-XXXX">
                </div>


                <div class="form-group">
                    <label for="EventRsvpInputGuests">Number of Additional Guests</label>
                    <input type="number" class="form-control" id="EventRsvpInputGuests" name="EventRsvpInputGuests" value="0">
                </div>

            <div class="form-group">
                <button type="submit" class="ui-btn ui-submit">SUBMIT</button>
            </div>

            <input type="hidden" name="type" value="rsvp" />
            <input type="hidden" name="status" value="new" />

            <?php wp_nonce_field('event_rsvp_radio_form'); ?>
        </form>
        <?php } else { ?>
            <p class="lead text-center">There are no upcoming events at this time. Please call <a href="tel:773-784-7000">(773) 784-7000</a> to find out more.</p>
        <?php } ?>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode( 'rsvp-form', 'eventRsvpRadio' );
