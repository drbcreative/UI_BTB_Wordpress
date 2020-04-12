<?php
/*
Plugin Name: UI Video Gallery
Description: Custom content types for themes developed by Urge Interactive
Version: 2.0
Author: Urge Interactive
Author URI: http://urgeinteractive.com
*/

function create_pt_videogallery() {
    $options_videogallery_names = get_option('post_type_videogallery_names');
	register_post_type( 'videogallery', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
        array('labels' => array(
            'name' => $options_videogallery_names['plural'] ? $options_videogallery_names['plural'] : __('video-galleries'), /* This is the Title of the Group */
            'singular_name' => $options_videogallery_names['singular'] ? $options_videogallery_names['singular'] :__('Video Gallery'), /* This is the individual type */
            'all_items' => $options_videogallery_names['singular'] ? 'All '.$options_videogallery_names['singular'] :__('All Video Gallery'), /* the all items menu item */
            'add_new' => $options_videogallery_names['singular'] ? 'Add New '.$options_videogallery_names['singular'] :__('Add New Video Gallery'), /* The add new menu item */
            'add_new_item' => $options_videogallery_names['singular'] ? 'Add New '.$options_videogallery_names['singular'] :__('Add New Video Gallery'), /* Add New Display Title */
            'edit' => __( 'Edit' ), /* Edit Dialog */
            'edit_item' => $options_videogallery_names['singular'] ? 'Edit '.$options_videogallery_names['singular'] :__('Edit Video Gallery'), /* Edit Display Title */
            'new_item' => $options_videogallery_names['singular'] ? 'New '.$options_videogallery_names['singular'] :__('New Video Gallery'), /* New Display Title */
            'view_item' => $options_videogallery_names['singular'] ? 'View '.$options_videogallery_names['singular'] :__('View Video Gallery'), /* View Display Title */
            'search_items' => $options_videogallery_names['plural'] ? 'Search '.$options_videogallery_names['plural'] :__('Search video-galleries'), /* Search Product Title */
            'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */
            'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
        ),
			'description' =>  $options_videogallery_names['plural'] ? $options_videogallery_names['plural'].' for '.get_bloginfo() :__( 'video-galleries for '.get_bloginfo() ), /* Product Description */
			'public' => true,
			'menu_icon' => 'dashicons-plus-alt',
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'rewrite'	=> array( 'slug' => $options_videogallery_names['slug'] ? $options_videogallery_names['slug'] :'video-galleries', 'with_front' => true ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title','post-options','editor','page-attributes', 'author', 'excerpt','thumbnail'),
            'show_in_rest' => true,
	 	) /* end of options */
	); /* end of register post type */
}
add_action( 'init','create_pt_videogallery' );

function create_videogallery_cat_tax() {
    $options_videogallery_names = get_option('post_type_videogallery_names');
	$labels = array(
        'name'              => _x( $options_videogallery_names['singular'] ? $options_videogallery_names['singular'].' Category' :'Video Gallery Category', 'taxonomy general name' ),
        'singular_name'     => _x( $options_videogallery_names['singular'] ? $options_videogallery_names['singular'].' Category' :'Video Gallery Category', 'taxonomy singular name' ),
        'search_items'      => __( $options_videogallery_names['singular'] ? 'Search '.$options_videogallery_names['singular'].' Сategories' :'Search Video Gallery Сategories' ),
        'all_items'         => __( $options_videogallery_names['singular'] ? 'All '.$options_videogallery_names['singular'].' Сategories' :'All Video Gallery Сategories' ),
        'parent_item'       => __( $options_videogallery_names['singular'] ? 'Parent '.$options_videogallery_names['singular'].' Сategory' :'Parent Video Gallery Сategory' ),
        'parent_item_colon' => __( $options_videogallery_names['singular'] ? 'All '.$options_videogallery_names['singular'].' Сategory' :'Parent Video Gallery Сategory:' ),
        'edit_item'         => __( $options_videogallery_names['singular'] ? 'Edit '.$options_videogallery_names['singular'].' Сategory' :'Edit Video Gallery Сategory' ),
        'update_item'       => __( $options_videogallery_names['singular'] ? 'Update '.$options_videogallery_names['singular'].' Сategory' :'Update Video Gallery Сategory' ),
        'add_new_item'      => __( $options_videogallery_names['singular'] ? 'Add New '.$options_videogallery_names['singular'].' Сategory' :'Add New Video Gallery Сategory' ),
        'new_item_name'     => __( $options_videogallery_names['singular'] ? 'New '.$options_videogallery_names['singular'].' Сategory Name' :'New Video Gallery Сategory Name' ),
        'menu_name'         => __( $options_videogallery_names['singular'] ? $options_videogallery_names['singular'].' Сategory' :'Video Gallery Category' ),
    );

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
        'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'videogallery-category' ),
	);

	register_taxonomy( 'videogallery_category', array( 'videogallery' ), $args );
}
add_action( 'init', 'create_videogallery_cat_tax' );

function videogallery_meta_box_ca() {
    add_meta_box( 'videogallery_meta_box_ca',
        'Content Association',
        'urge_options_display_child_meta_box_ca', // Use urge_options_display_child_meta_box_ca() from parent plugin
        'videogallery',
        'normal',
        'high'
    );
}

$options_videogallery_names_caf = get_option('post_type_videogallery_caf');
if ($options_videogallery_names_caf){
    add_action( 'add_meta_boxes', 'videogallery_meta_box_ca' );
}








// CUSTOM FIELDS

if ( !class_exists('myCustomFields') ) {
 
    class myCustomFields {
        /**
        * @var  string  $prefix  The prefix for storing custom fields in the postmeta table
        */
        var $prefix = '_mcf_';
        /**
        * @var  array  $postTypes  An array of public custom post types, plus the standard "post" and "page" - add the custom types you want to include here
        */
        var $postTypes = array( "videogallery" );
        /**
        * @var  array  $customFields  Defines the custom fields available
        */
        var $customFields = array(
            array(
                "name"          => "video-description",
                "title"         => "Video Description",
                "description"   => "",
                "type"          => "textarea",
                "scope"         =>   array( "videogallery" ),
                "capability"    => "edit_pages"
            ),
            array(
                "name"          => "video-title",
                "title"         => "Video Title",
                "description"   => "",
                "type"          =>   "text",
                "scope"         =>   array( "videogallery" ),
                "capability"    => "edit_posts"
            ),
            array(
                "name"          => "checkbox",
                "title"         => "Checkbox",
                "description"   => "",
                "type"          => "checkbox",
                "scope"         =>   array( "videogallery" ),
                "capability"    => "manage_options"
            ),
            array(
                "name"          => "mediafile",
                "title"         => "File",
                "description"   => "",
                "type"          => "file",
                'allow' => array( 'url', 'attachment' ),
                "scope"         =>   array( "videogallery" ),
                "capability"    => "manage_options"
            )
        );
        /**
        * PHP 4 Compatible Constructor
        */
        function myCustomFields() { $this->__construct(); }
        /**
        * PHP 5 Constructor
        */
        function __construct() {
            // add_action( 'admin_menu', array( &$this, 'createCustomFields' ) );
            add_action( 'save_post', array( &$this, 'saveCustomFields' ), 1, 2 );
            // Comment this line out if you want to keep default custom fields meta box
            add_action( 'do_meta_boxes', array( &$this, 'removeDefaultCustomFields' ), 10, 3 );
        }
        /**
        * Remove the default Custom Fields meta box
        */
        function removeDefaultCustomFields( $type, $context, $post ) {
            foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
                foreach ( $this->postTypes as $postType ) {
                    remove_meta_box( 'postcustom', $postType, $context );
                }
            }
        }
        /**
        * Create the new Custom Fields meta box
        */
        function createCustomFields() {
            if ( function_exists( 'add_meta_box' ) ) {
                foreach ( $this->postTypes as $postType ) {
                    add_meta_box( 'my-custom-fields', 'Video Fields', array( &$this, 'displayCustomFields' ), $postType, 'normal', 'high' );
                }
            }
        }
        /**
        * Display the new Custom Fields meta box
        */
        function displayCustomFields() {
            global $post;
            ?>
            <div class="form-wrap">
                <?php
                wp_nonce_field( 'my-custom-fields', 'my-custom-fields_wpnonce', false, true );
                foreach ( $this->customFields as $customField ) {
                    // Check scope
                    $scope = $customField[ 'scope' ];
                    $output = false;
                    foreach ( $scope as $scopeItem ) {
                        switch ( $scopeItem ) {
                            default: {
                                if ( $post->post_type == $scopeItem )
                                    $output = true;
                                break;
                            }
                        }
                        if ( $output ) break;
                    }
                    // Check capability
                    if ( !current_user_can( $customField['capability'], $post->ID ) )
                        $output = false;
                    // Output if allowed
                    if ( $output ) { ?>
                        <div class="form-field form-required">
                            <?php
                            switch ( $customField[ 'type' ] ) {
                                case "checkbox": {
                                    // Checkbox
                                    echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
                                    echo '<input type="checkbox" name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '" value="yes"';
                                    if ( get_post_meta( $post->ID, $this->prefix . $customField['name'], true ) == "yes" )
                                        echo ' checked="checked"';
                                    echo '" style="width: auto;" />';
                                    break;
                                }
                                case "textarea":
                                case "wysiwyg": {
                                    // Text area
                                    echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
                                    echo '<textarea name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" columns="30" rows="3">' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '</textarea>';
                                    // WYSIWYG
                                    if ( $customField[ 'type' ] == "wysiwyg" ) { ?>
                                        <script type="text/javascript">
                                            jQuery( document ).ready( function() {
                                                jQuery( "<?php echo $this->prefix . $customField[ 'name' ]; ?>" ).addClass( "mceEditor" );
                                                if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
                                                    tinyMCE.execCommand( "mceAddControl", false, "<?php echo $this->prefix . $customField[ 'name' ]; ?>" );
                                                }
                                            });
                                        </script>
                                    <?php }
                                    break;
                                }
                                case "file": {
                                  // Media File
                                    ?>
                                    <div class='image-preview-wrapper'>
                                            <img id='image-preview' src='<?php echo wp_get_attachment_url( get_post_meta( $post->ID, $this->prefix . 'media_selector_attachment_id', true ) ); ?>' width='100' height='100' style='max-height: 100px; width: 100px;'>
                                        </div>
                                        <input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
                                        <input type='hidden' name='image_attachment_id' id='image_attachment_id' value='<?php echo get_post_meta( $post->ID, $this->prefix . 'media_selector_attachment_id', true ); ?>'>
                                    </div>



                                <?php $my_saved_attachment_post_id = get_option( $this->prefix . 'media_selector_attachment_id', 0 ); ?>

                                <script type='text/javascript'>
                                        jQuery( document ).ready( function( $ ) {
                                            // Uploading files
                                            var file_frame;
                                            var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
                                            var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
                                            jQuery('#upload_image_button').on('click', function( event ){
                                                event.preventDefault();
                                                // If the media frame already exists, reopen it.
                                                if ( file_frame ) {
                                                    // Set the post ID to what we want
                                                    file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
                                                    // Open frame
                                                    file_frame.open();
                                                    return;
                                                } else {
                                                    // Set the wp.media post id so the uploader grabs the ID we want when initialised
                                                    wp.media.model.settings.post.id = set_to_post_id;
                                                }
                                                // Create the media frame.
                                                file_frame = wp.media.frames.file_frame = wp.media({
                                                    title: 'Select a image to upload',
                                                    button: {
                                                        text: 'Use this image',
                                                    },
                                                    multiple: false // Set to true to allow multiple files to be selected
                                                });
                                                // When an image is selected, run a callback.
                                                file_frame.on( 'select', function() {
                                                    // We set multiple to false so only get one image from the uploader
                                                    attachment = file_frame.state().get('selection').first().toJSON();
                                                    // Do something with attachment.id and/or attachment.url here
                                                    $( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
                                                    $( '#image_attachment_id' ).val( attachment.id );
                                                    // Restore the main post ID
                                                    wp.media.model.settings.post.id = wp_media_post_id;
                                                });
                                                    // Finally, open the modal
                                                    file_frame.open();
                                            });
                                            // Restore the main ID when the add media button is pressed
                                            jQuery( 'a.add_media' ).on( 'click', function() {
                                                wp.media.model.settings.post.id = wp_media_post_id;
                                            });
                                        });
                                    </script>

                                    <?php
                                    break;
                                }


                                default: {
                                    // Plain text field
                                    echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
                                    echo '<input type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" />';
                                    break;
                                }
                            }






                            ?>
                            <?php if ( $customField[ 'description' ] ) echo '<p>' . $customField[ 'description' ] . '</p>'; ?>
                    <?php
                    }
                } ?>
            </div>
            <?php
        }
        /**
        * Save the new Custom Fields values
        */
        function saveCustomFields( $post_id, $post ) {
            if ( !isset( $_POST[ 'my-custom-fields_wpnonce' ] ) || !wp_verify_nonce( $_POST[ 'my-custom-fields_wpnonce' ], 'my-custom-fields' ) )
                return;
            if ( !current_user_can( 'edit_post', $post_id ) )
                return;
            if ( ! in_array( $post->post_type, $this->postTypes ) )
                return;

            foreach ( $this->customFields as $customField ) {
                if ( current_user_can( $customField['capability'], $post_id ) ) {
                    if ( isset( $_POST[ $this->prefix . $customField['name'] ] ) && trim( $_POST[ $this->prefix . $customField['name'] ] ) ) {
                        $value = $_POST[ $this->prefix . $customField['name'] ];
                        // Auto-paragraphs for any WYSIWYG
                        if ( $customField['type'] == "wysiwyg" ) $value = wpautop( $value );
                        update_post_meta( $post_id, $this->prefix . $customField[ 'name' ], $value );
 
                        
                    } else {
                        delete_post_meta( $post_id, $this->prefix . $customField[ 'name' ] );
                    }
                        // Save attachment ID
                        if (  isset( $_POST['image_attachment_id'] ) ) :
                            update_post_meta( $post_id, $this->prefix . 'media_selector_attachment_id' , absint( $_POST['image_attachment_id'] ) );
                        endif;
                }
            }


        }
 
    } // End Class
 
} // End if class exists statement
 
// Instantiate the class
if ( class_exists('myCustomFields') ) {
    $myCustomFields_var = new myCustomFields();
}