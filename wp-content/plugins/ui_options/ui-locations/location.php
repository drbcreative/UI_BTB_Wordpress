<?php
/*
Plugin Name: UI Locations
Description: Custom content types for themes developed by Urge Interactive
Version: 2.0
Author: Urge Interactive
Author URI: http://urgeinteractive.com
*/


function location_load_assets(){
	wp_enqueue_style( 'location_metabox-styles', plugins_url('/assets/css/metaboxes.css?v='.time(),__FILE__));
	wp_enqueue_script('location_custom-js', plugins_url('/assets/js/metaboxes.js?v='.time(),__FILE__), 'jquery-ui-core', '1.0', true);
}
add_action( 'admin_enqueue_scripts','location_load_assets' );



function location_load_assets_front(){
    wp_enqueue_style( 'location_metabox-styles', plugins_url('/assets/css/metaboxes.css?v='.time(),__FILE__));
}
add_action( 'wp_enqueue_scripts', 'location_load_assets_front' );


function create_pt_location() {
    $options_locations_names = get_option('post_type_locations_names');
	register_post_type( 'location', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
        array('labels' => array(
            'name' => $options_locations_names['plural'] ? $options_locations_names['plural'] : __('Locations'), /* This is the Title of the Group */
            'singular_name' => $options_locations_names['singular'] ? $options_locations_names['singular'] :__('Location'), /* This is the individual type */
            'all_items' => $options_locations_names['singular'] ? 'All '.$options_locations_names['singular'] :__('All Locations'), /* the all items menu item */
            'add_new' => $options_locations_names['singular'] ? 'Add New '.$options_locations_names['singular'] :__('Add New Location'), /* The add new menu item */
            'add_new_item' => $options_locations_names['singular'] ? 'Add New '.$options_locations_names['singular'] :__('Add New Location'), /* Add New Display Title */
            'edit' => __( 'Edit' ), /* Edit Dialog */
            'edit_item' => $options_locations_names['singular'] ? 'Edit '.$options_locations_names['singular'] :__('Edit Location'), /* Edit Display Title */
            'new_item' => $options_locations_names['singular'] ? 'New '.$options_locations_names['singular'] :__('New Location'), /* New Display Title */
            'view_item' => $options_locations_names['singular'] ? 'View '.$options_locations_names['singular'] :__('View Location'), /* View Display Title */
            'search_items' => $options_locations_names['plural'] ? 'Search '.$options_locations_names['plural'] :__('Search Locations'), /* Search Product Title */
            'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */
            'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
			),
			'description' => $options_locations_names['plural'] ? $options_locations_names['plural'].' for '.get_bloginfo() :__( 'Location for '.get_bloginfo() ), /* Product Description */
			'public' => true,
			'menu_icon' => 'dashicons-location-alt',
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'rewrite'	=> array( 'slug' => $options_locations_names['slug'] ? $options_locations_names['slug'] :'locations', 'with_front' => true ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title','post-options','editor','page-attributes', 'author', 'excerpt','thumbnail'),
      'show_in_rest' => true,
	 	) /* end of options */
	); /* end of register post type */
}
add_action( 'init','create_pt_location' );

function create_location_county_tax() {
    $options_locations_names = get_option('post_type_location_names');
    $labels = array(
        'name'              => _x( $options_locations_names['singular'] ? $options_locations_names['singular'].' Category' :'Location County', 'taxonomy general name' ),
        'singular_name'     => _x( $options_locations_names['singular'] ? $options_locations_names['singular'].' Category' :'Location County', 'taxonomy singular name' ),
        'search_items'      => __( $options_locations_names['singular'] ? 'Search '.$options_locations_names['singular'].' Сategories' :'Search Location Countys' ),
        'all_items'         => __( $options_locations_names['singular'] ? 'All '.$options_locations_names['singular'].' Сategories' :'All Location Countys' ),
        'parent_item'       => __( $options_locations_names['singular'] ? 'Parent '.$options_locations_names['singular'].' Сategory' :'Parent Location County' ),
        'parent_item_colon' => __( $options_locations_names['singular'] ? 'All '.$options_locations_names['singular'].' Сategory' :'Parent Location County:' ),
        'edit_item'         => __( $options_locations_names['singular'] ? 'Edit '.$options_locations_names['singular'].' Сategory' :'Edit Location County' ),
        'update_item'       => __( $options_locations_names['singular'] ? 'Update '.$options_locations_names['singular'].' Сategory' :'Update Location County' ),
        'add_new_item'      => __( $options_locations_names['singular'] ? 'Add New '.$options_locations_names['singular'].' Сategory' :'Add New Location County' ),
        'new_item_name'     => __( $options_locations_names['singular'] ? 'New '.$options_locations_names['singular'].' Сategory Name' :'New Location County Name' ),
        'menu_name'         => __( $options_locations_names['singular'] ? $options_locations_names['singular'].' Сategory' :'Location County' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
				'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'county' ),
//        'show_in_quick_edit'         => false,
        'meta_box_cb'                => false,
    );

    register_taxonomy( 'location_county', array( 'location' ), $args );
}
add_action( 'init', 'create_location_county_tax' );

function location_meta_boxes(){
    $options_locations_names = get_option('post_type_locations_names');
	add_meta_box( 'location_meta_boxes',
        $options_locations_names['singular']?$options_locations_names['singular'].' settings':'Location settings',
        'display_location_meta_box',
        'location',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes','location_meta_boxes' );

function display_location_meta_box(){
	global $post;
    $locationPhone = get_post_meta($post->ID, 'location_phone', true);
    $locationFax = get_post_meta($post->ID, 'location_fax', true);
    $address = get_post_meta($post->ID, 'address', true);
		$location_county = wp_get_post_terms($post->ID, 'location_county', array("fields" => "ids"));
		$counties = get_terms([
        'taxonomy' => 'location_county',
        'hide_empty' => false,
        'fields' => "id=>name"
    ]);
?>

	<table class="form-table">
        <tr>
            <th><label for="location_phone">Phone</label></th>
            <td>
                <input type="tel" name="location_phone" id="location_phone"  pattern="^\d{3}-\d{3}-\d{4}$" placeholder="format: ___-___-____"
                    value="<?php echo $locationPhone ?>" size="18">
            </td>
        </tr>
        <tr>
            <th><label for="location_fax">Fax</label></th>
            <td>
                <input type="text" name="location_fax" id="location_fax" pattern="^\d{3}-\d{3}-\d{4}$" placeholder="format: ___-___-____"
                    value="<?php echo $locationFax ?>" size="18">
            </td>
        </tr>
				<tr>
            <td>
	            <label for="">County</label>
                <select name="location_county[]" id="location_county_list" multiple="multiple">
                    <option value="">Select One</option>
                    <?php foreach($counties as $key => $value ): ?>
                        <option value="<?php echo $value ?>", <?php echo $location_county&&in_array($key,$location_county)?' selected="selected"':''?> ><?php echo $value ?></option>;
                    <?php endforeach ?>
                </select>
                <br /><span class="description">The location's county</span>
            </td>
        </tr>

	</table>
<?php
    gApi($address);
}


function location_meta_box_ca() {
    add_meta_box( 'location_meta_box_ca',
        'Content Association',
        'urge_options_display_child_meta_box_ca', // Use urge_options_display_child_meta_box_ca() from parent plugin
        'location',
        'normal',
        'high'
    );
}

$options_locations_caf = get_option('post_type_locations_caf');
if ($options_locations_caf){
    add_action( 'add_meta_boxes','location_meta_box_ca' );
}


function save_location_custom_meta( $id, $item ) {
    // Check post type
    if ( $item->post_type == 'location') {

        if ( isset( $_POST['location_phone'] ) ) {
            update_post_meta( $id, 'location_phone',$_POST['location_phone'] );
        }

        if ( isset( $_POST['location_fax'] ) ) {
            update_post_meta( $id, 'location_fax',$_POST['location_fax'] );
        }

				if (!empty($_POST['location_county'])) {

            $slugs = $_POST['location_county'];

            wp_set_object_terms($id, $slugs, 'location_county', false);
        } else {
            wp_set_object_terms($id, null, 'location_county', false);
        }

        if ( !empty( $_POST['lat'] ) && !empty( $_POST['lng'] )) {
            update_post_meta( $id, 'lat',$_POST['lat'] );
            update_post_meta( $id, 'lng',$_POST['lng'] );
        }

        if ( isset( $_POST['address'] ) ) {
            update_post_meta( $id, 'address',$_POST['address'] );
        }
	}
}
add_action( 'save_post','save_location_custom_meta',10,2 );


$gApiKey = 'AIzaSyC2ryQy-Whx7hROpFCYBtytoCY4db_bloM';
function gApi($address){
    global $post, $gApiKey;
    $gApiUrl = 'https://maps.googleapis.com/maps/api/js?key='.$gApiKey.'&libraries=places&signed_in=true&callback=initMap';

    $lat = get_post_meta($post->ID, 'lat', true);
    $lng = get_post_meta($post->ID, 'lng', true);

    ?>
    <div id="google_map">
        <hr>
        <p>Shortcode: [g_api id=<?php echo$post->ID;?> zoom=16]</p>
        <p>Shortcode: [g_api_all zoom=3]</p>
        <div id="floating-panel">
            <input id="address" type="text" name="address" value="<?php echo $address?$address:'Los Angeles, CA' ?>">
            <input id="submit" type="button" value="Geocode">
        </div>

        <div id="map"></div>

        <div id="geometry">
            <span>Lat:</span>
            <input id="lat" name="lat" type="textbox" readonly="readonly" value="<?php echo $lat;?>">
            <span>Lng:</span>
            <input id="lng" name="lng" type="textbox" readonly="readonly" value="<?php echo $lng;?>">
        </div>
    </div>

    <script>
        function initMap() {
            var lat = Number(document.getElementById('lat').value);
            var lng = Number(document.getElementById('lng').value);

            if (lat == 0 ){
                lat= 34.0522342;
            }
            if (lng == 0){
                lng= -118.2436849;
            }

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: {lat: lat, lng: lng}
            });
            var geocoder = new google.maps.Geocoder();


            var latlng = {lat: lat, lng: lng};
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });
                        //document.getElementById('address').value=results[0].formatted_address;
                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });


            document.getElementById('submit').addEventListener('click', function() {
                geocodeAddress(geocoder, map);
            });
        }

        function geocodeAddress(geocoder, resultsMap) {
            var address = document.getElementById('address').value;
            geocoder.geocode({'address': address}, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    resultsMap.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: resultsMap,
                        position: results[0].geometry.location
                    });
                    document.getElementById('lng').value = results[0].geometry.location.lng();
                    document.getElementById('lat').value = results[0].geometry.location.lat();
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }
    </script>
    <script src=<?php echo$gApiUrl?>
            async defer> </script>
    <?php
}

function gApiShortcode( $atts ){
    global $gApiKey;

    if(empty($atts['id'])){
        return false;
    }

    $post_id = (int) $atts['id'];
    $zoom = (!empty($atts['zoom'])) ? (int) $atts['zoom'] : 16;
    $gApiUrl = 'https://maps.googleapis.com/maps/api/js?key='.$gApiKey.'&libraries=places&signed_in=true&callback=initMap';


    $lat = get_post_meta($post_id, 'lat', true);
    $lng = get_post_meta($post_id, 'lng', true);

    ob_start();
    ?>

    <?php if(!empty($lat) && !empty($lng)): ?>

        <div id="google_map">
            <div id="map"></div>
            <input id="lat" name="lat" type="hidden"  value="<?php echo $lat;?>">
            <input id="lng" name="lng" type="hidden" value="<?php echo $lng;?>">
        </div>

        <script>
            function initMap() {
                var lat = Number(document.getElementById('lat').value);
                var lng = Number(document.getElementById('lng').value);

                if (lat == 0){
                    lat= 34.0522342;
                }
                if (lng == 0){
                    lng= -118.2436849;
                }

                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: <?php echo$zoom?>,
                    center: {lat: lat, lng: lng},
                    styles: [
    {
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#455660"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "color": "#EFEFEF"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 1
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "color": "#7EB2E1"
            },
            {
                "visibility": "on"
            }
        ]
    }
]
                });
                var geocoder = new google.maps.Geocoder();

                var latlng = {lat: lat, lng: lng};
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            var marker = new google.maps.Marker({
                                position: latlng,
                                map: map
                            });

                        } else {
                            window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });
            }
        </script>
        <script src=<?php echo$gApiUrl?>
                async defer> </script>

    <?php endif;?>

    <?php return ob_get_clean(); ?>
    <?php
}
add_shortcode( 'g_api', 'gApiShortcode' );

function gApiShortcodeAll($atts) {
    global $gApiKey;

    $zoom = (!empty($atts['zoom'])) ? (int) $atts['zoom'] : 3;

    $gApiUrl = 'https://maps.googleapis.com/maps/api/js?key='.$gApiKey.'&libraries=places&callback=initMap';

    $args = array(
        'post_type'  => 'location',
        'posts_per_page' => -1,
        'fields'=>'ids'
    );
    $locations = get_posts( $args );
    $locations_latlng = array();

    foreach ($locations as $id){
        $lat = get_post_meta($id, 'lat', true);
        $lng = get_post_meta($id, 'lng', true);
        $phone = get_post_meta($id, 'location_phone', true);
        $fax = get_post_meta($id, 'location_fax', true);
        $title = get_the_title($id);
        $address = get_post_meta($id, 'address', true);
        $img = get_the_post_thumbnail_url( $id, $size = 'post-thumbnail' );


        if ($lat && $lng) {
            $latlng['lat'] = $lat;
            $latlng['lng'] = $lng;
            $latlng['phone'] = $phone;
            $latlng['fax'] = $fax;
            $latlng['title'] = $title;
            $latlng['address'] = $address;
            $latlng['img'] = $img;

            $locations_latlng[] = $latlng;
        }
    }

    ob_start();
    ?>
        <div id="google_map_locations">
            <div id="map_all"></div>
        </div>

        <script>

                var locations = <?php echo json_encode($locations_latlng); ?>;

                function initMap() {

                    var map = new google.maps.Map(document.getElementById('map_all'), {
                        zoom: <?php echo$zoom?>,
                        center: {lat: 36.397965, lng: -120.365126},
                        styles: [
												    {
												        "featureType": "administrative",
												        "elementType": "labels.text.fill",
												        "stylers": [
												            {
												                "color": "#455660"
												            }
												        ]
												    },
												    {
												        "featureType": "landscape",
												        "elementType": "all",
												        "stylers": [
												            {
												                "color": "#EFEFEF"
												            }
												        ]
												    },
												    {
												        "featureType": "poi",
												        "elementType": "all",
												        "stylers": [
												            {
												                "visibility": "off"
												            }
												        ]
												    },
												    {
												        "featureType": "road",
												        "elementType": "all",
												        "stylers": [
												            {
												                "saturation": -100
												            },
												            {
												                "lightness": 45
												            }
												        ]
												    },
												    {
												        "featureType": "road.highway",
												        "elementType": "all",
												        "stylers": [
												            {
												                "visibility": "simplified"
												            }
												        ]
												    },
												    {
												        "featureType": "road.arterial",
												        "elementType": "labels.icon",
												        "stylers": [
												            {
												                "visibility": "off"
												            }
												        ]
												    },
												    {
												        "featureType": "transit",
												        "elementType": "all",
												        "stylers": [
												            {
												                "visibility": "off"
												            }
												        ]
												    },
												    {
												        "featureType": "water",
												        "elementType": "all",
												        "stylers": [
												            {
												                "color": "#7EB2E1"
												            },
												            {
												                "visibility": "on"
												            }
												        ]
												    }
												]
                    });


                    for (var key in locations) {
                        addMarker(locations[key], map);
                    }
                }

                function addMarker(latlng, map) {
                    latlng["lat"] = Number(latlng["lat"]);
                    latlng["lng"] = Number(latlng["lng"]);

                    var geocoder = new google.maps.Geocoder();

                        var mytext = '';



                    geocoder.geocode({'location': latlng}, function (results, status) {
                        if (status === 'OK') {
                            if (results[0]) {
                                mytext = mytext + latlng["title"] + '<br>' + latlng["address"];
                            } else {
//                            window.alert('No results found');
                            }
                        } else {
                            console.log('Geocoder failed due to: ' + status);
                        }
                        marker();
                    });

                    function marker() {
                        if(latlng["phone"]){
                            mytext = mytext + '<br>Phone: ' + latlng["phone"]
                        }

                        if(latlng["fax"]){
                            mytext = mytext + '<br>Fax: ' + latlng["fax"];
                        }


                        var infowindow = new google.maps.InfoWindow({
                            content: mytext
                        });

                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            title: latlng["title"],
                            infowindow: infowindow
                        });

                        marker.addListener('click', function () {
                            infowindow.open(map, marker);
                        });
                    }

                }

        </script>
        <script src=<?php echo$gApiUrl?>
                async defer> </script>



    <?php return ob_get_clean(); ?>
    <?php
}
add_shortcode( 'g_api_all', 'gApiShortcodeAll' );
