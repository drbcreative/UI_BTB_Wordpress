<?php
/*
Plugin Name: UI Gallery
Description: Custom content types for themes developed by Urge Interactive
Version: 2.0
Author: Urge Interactive
Author URI: http://urgeinteractive.com
*/

function ui_gallery_load_assets(){
    global $post;

    $args = [];
    if( is_object($post) ){
        $args = [
            'post' => $post->ID,
        ];
    }

    wp_enqueue_media( $args );

	wp_enqueue_style( 'ui-gallery-styles', plugins_url('/assets/css/ui-gallery-admin.css?v='.time(),__FILE__));
	wp_enqueue_script('sortable', plugins_url('/assets/js/sortable.min.js?v='.time(),__FILE__), '', '1.0', false);
}
add_action( 'admin_enqueue_scripts','ui_gallery_load_assets' );

function ui_gallery_front_assets(){
    global $post;
     
    $content = get_post($post->ID);
    //write the begining of the shortcode
    $shortcode = '[ui_gallery';
    
    $check = strpos($content->post_content,$shortcode);


    if($check === false) {
    } else {
        ?>
        
                    <script
              src="https://code.jquery.com/jquery-3.4.1.min.js"
              integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
              crossorigin="anonymous"></script>
              <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
              <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
              <script>
              $(document).ready(function () {
                  $('#gallery-single').slick({
                dots: false,
                nextArrow: '<span class="arrow next"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512.008 512.008" style="enable-background:new 0 0 512.008 512.008;" xml:space="preserve"><g><g><path d="M381.048,248.633L146.381,3.299c-3.021-3.146-7.646-4.167-11.688-2.521c-4.042,1.615-6.688,5.542-6.688,9.896v42.667    c0,2.729,1.042,5.354,2.917,7.333l185.063,195.333L130.923,451.341c-1.875,1.979-2.917,4.604-2.917,7.333v42.667    c0,4.354,2.646,8.281,6.688,9.896c1.292,0.521,2.646,0.771,3.979,0.771c2.854,0,5.646-1.146,7.708-3.292l234.667-245.333    C384.986,259.258,384.986,252.758,381.048,248.633z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></span>',
                      prevArrow: '<span class="arrow prev"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512.008 512.008" style="enable-background:new 0 0 512.008 512.008;" xml:space="preserve"><g><g><path d="M384.001,53.333V10.667c0-4.354-2.646-8.281-6.688-9.896C376.022,0.25,374.668,0,373.335,0    c-2.854,0-5.646,1.146-7.708,3.292L130.96,248.625c-3.937,4.125-3.937,10.625,0,14.75l234.667,245.333    c3.021,3.146,7.646,4.167,11.688,2.521c4.042-1.615,6.688-5.542,6.688-9.896v-42.667c0-2.729-1.042-5.354-2.917-7.333L196.022,256    L381.085,60.667C382.96,58.688,384.001,56.063,384.001,53.333z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></span>',
                      
              //   infinite: false,
                speed: 300,
                slidesToShow: 3,
                responsive: [
                  {
                    breakpoint: 1024,
                    settings: {
                      slidesToShow: 3,
                      infinite: true,
                      
                    }
                  },
                  {
                    breakpoint: 600,
                    settings: {
                      slidesToShow: 2,
                    }
                  },
                  {
                    breakpoint: 480,
                    settings: {
                      slidesToShow: 1,
                    }
                  }
                  // You can unslick at a given breakpoint now by adding:
                  // settings: "unslick"
                  // instead of a settings object
                ]
              });
              });
              </script>
        <?
        wp_enqueue_style( 'ui-gallery-styles', plugins_url('/assets/css/ui-gallery.css?v='.time(),__FILE__));

        wp_enqueue_style( 'lightbox', plugins_url('/assets/css/lightgallery.min.css?v='.time(),__FILE__));
        wp_enqueue_script('lightbox', plugins_url('/assets/js/lightgallery.min.js?v='.time(),__FILE__), 'array("jquery")', '', true);
        wp_enqueue_script('lightbox-thumbnail', plugins_url('/assets/js/lg-thumbnail.min.js?v='.time(),__FILE__), 'array("jquery")', '', true);
    
        wp_enqueue_script('ui-gallery-script', plugins_url('/assets/js/ui-gallery.js?v='.time(),__FILE__), 'array("jquery")', '', true);

    } 
    
    if(is_singular( 'ui_gallery' )){
      ?>
        
                    <script
              src="https://code.jquery.com/jquery-3.4.1.min.js"
              integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
              crossorigin="anonymous"></script>
              <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
              <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
              <script>
              $(document).ready(function () {
                  $('#gallery-single').slick({
                dots: false,
                nextArrow: '<span class="arrow next"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512.008 512.008" style="enable-background:new 0 0 512.008 512.008;" xml:space="preserve"><g><g><path d="M381.048,248.633L146.381,3.299c-3.021-3.146-7.646-4.167-11.688-2.521c-4.042,1.615-6.688,5.542-6.688,9.896v42.667    c0,2.729,1.042,5.354,2.917,7.333l185.063,195.333L130.923,451.341c-1.875,1.979-2.917,4.604-2.917,7.333v42.667    c0,4.354,2.646,8.281,6.688,9.896c1.292,0.521,2.646,0.771,3.979,0.771c2.854,0,5.646-1.146,7.708-3.292l234.667-245.333    C384.986,259.258,384.986,252.758,381.048,248.633z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></span>',
                      prevArrow: '<span class="arrow prev"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512.008 512.008" style="enable-background:new 0 0 512.008 512.008;" xml:space="preserve"><g><g><path d="M384.001,53.333V10.667c0-4.354-2.646-8.281-6.688-9.896C376.022,0.25,374.668,0,373.335,0    c-2.854,0-5.646,1.146-7.708,3.292L130.96,248.625c-3.937,4.125-3.937,10.625,0,14.75l234.667,245.333    c3.021,3.146,7.646,4.167,11.688,2.521c4.042-1.615,6.688-5.542,6.688-9.896v-42.667c0-2.729-1.042-5.354-2.917-7.333L196.022,256    L381.085,60.667C382.96,58.688,384.001,56.063,384.001,53.333z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></span>',
                      
              //   infinite: false,
                speed: 300,
                slidesToShow: 3,
                responsive: [
                  {
                    breakpoint: 1024,
                    settings: {
                      slidesToShow: 3,
                      infinite: true,
                    }
                  },
                  {
                    breakpoint: 600,
                    settings: {
                      slidesToShow: 2,
                    }
                  },
                  {
                    breakpoint: 480,
                    settings: {
                      slidesToShow: 1,
                    }
                  }
                  // You can unslick at a given breakpoint now by adding:
                  // settings: "unslick"
                  // instead of a settings object
                ]
              });
              });
              </script>
              <?
              wp_enqueue_style( 'ui-gallery-styles', plugins_url('/assets/css/ui-gallery.css?v='.time(),__FILE__));

              wp_enqueue_style( 'lightbox', plugins_url('/assets/css/lightgallery.min.css?v='.time(),__FILE__));
              wp_enqueue_script('lightbox', plugins_url('/assets/js/lightgallery.min.js?v='.time(),__FILE__), 'array("jquery")', '', true);
              wp_enqueue_script('lightbox-thumbnail', plugins_url('/assets/js/lg-thumbnail.min.js?v='.time(),__FILE__), 'array("jquery")', '', true);

              wp_enqueue_script('ui-gallery-script', plugins_url('/assets/js/ui-gallery.js?v='.time(),__FILE__), 'array("jquery")', '', true);
    }


}
add_action( 'wp_enqueue_scripts','ui_gallery_front_assets' );

function create_pt_ui_gallery() {
    $options_gallery_names = get_option('post_type_gallery_names');
	register_post_type( 'ui_gallery', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
        array('labels' => array(
            'name' => $options_gallery_names['plural'] ? $options_gallery_names['plural'] : __('Gallery'), /* This is the Title of the Group */
            'singular_name' => $options_gallery_names['singular'] ? $options_gallery_names['singular'] :__('Gallery'), /* This is the individual type */
            'all_items' => $options_gallery_names['singular'] ? 'All '.$options_gallery_names['singular'] :__('All Gallery'), /* the all items menu item */
            'add_new' => $options_gallery_names['singular'] ? 'Add New '.$options_gallery_names['singular'] :__('Add New Gallery'), /* The add new menu item */
            'add_new_item' => $options_gallery_names['singular'] ? 'Add New '.$options_gallery_names['singular'] :__('Add New Gallery'), /* Add New Display Title */
            'edit' => __( 'Edit' ), /* Edit Dialog */
            'edit_item' => $options_gallery_names['singular'] ? 'Edit '.$options_gallery_names['singular'] :__('Edit Gallery'), /* Edit Display Title */
            'new_item' => $options_gallery_names['singular'] ? 'New '.$options_gallery_names['singular'] :__('New Gallery'), /* New Display Title */
            'view_item' => $options_gallery_names['singular'] ? 'View '.$options_gallery_names['singular'] :__('View Gallery'), /* View Display Title */
            'search_items' => $options_gallery_names['plural'] ? 'Search '.$options_gallery_names['plural'] :__('Search Gallery'), /* Search Product Title */
            'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */
            'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
			),
			'description' => $options_gallery_names['plural'] ? $options_gallery_names['plural'].' for '.get_bloginfo() :__( 'ui_gallery for '.get_bloginfo() ), /* Product Description */
			'public' => true,
			'menu_icon' => 'dashicons-exerpt-view',
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'rewrite'	=> array( 'slug' => $options_gallery_names['slug'] ? $options_gallery_names['slug'] :'gallery', 'with_front' => true ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
      'supports' => array( 'title','post-options','editor','page-attributes', 'author', 'excerpt','thumbnail'),
      'show_in_rest' => true,
			//'taxonomies' => array( 'post_tag' ),

	 	) /* end of options */
	); /* end of register post type */
}

add_action( 'init','create_pt_ui_gallery' );

add_theme_support( 'post-thumbnails' );

function create_gallery_tax() {
	$args = array(
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
    'show_in_rest'      => true,
		//'rewrite'           => array( 'slug' => 'projects_category' ),
	);
	register_taxonomy( 'gallery_category', array( 'ui_gallery' ), $args );
}
add_action( 'init', 'create_gallery_tax' );

function ui_gallery_meta_boxes(){
    $options_gallery_names = get_option('post_type_gallery_names');
	add_meta_box( 'ui_gallery_meta_box',
        $options_gallery_names['singular']?$options_gallery_names['singular'].' content':'Gallery content',
        'display_ui_gallery_meta_box',
        'ui_gallery',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes','ui_gallery_meta_boxes' );


function display_ui_gallery_meta_box($post){
	$project_image_urls = esc_html( get_post_meta( $post->ID, 'project_image_urls', true ) );
    $project_image_id 	= esc_html( get_post_meta( $post->ID, 'project_image_id', true ) );
    $project_image_title= esc_html( get_post_meta( $post->ID, 'project_image_title', true ) );
    $project_image_desc = esc_html( get_post_meta( $post->ID, 'project_image_desc', true ) );

    $project_image_urls = json_decode(htmlspecialchars_decode($project_image_urls));
    $project_image_id 	= json_decode(htmlspecialchars_decode($project_image_id));
    $project_image_title= json_decode(htmlspecialchars_decode($project_image_title));
    $project_image_desc = json_decode(htmlspecialchars_decode($project_image_desc));


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
		        title: 'Choose Image',
		        button: {
		        text: 'Choose Image'
		      },
		      multiple: true
		    });
		    mediaUploader.on('select', function() {
		      selection = mediaUploader.state().get('selection')
		      selection.map( function( attachment ) {
		      	attachment = attachment.toJSON()
                block_html = jQuery.parseHTML( '<?php include( plugin_dir_path( __FILE__ ).'/image-block.php') ?>' )

                  if ((attachment.mime == 'image/jpeg') || (attachment.mime == 'image/png') || (attachment.mime == 'image/gif') ){

                      jQuery(block_html).find('.wrong-format').hide();
                          jQuery(block_html).find('.project_images_list_item').append('<img class="project_image" src="'+attachment.url+'">');
                      jQuery(block_html).find('.project_image_url').attr('value',attachment.url)
                      jQuery(block_html).find('.project_image_id').attr('value',attachment.id)
                      element.prepend(block_html)
                  }

		       });
		    });
		    // Open the uploader dialog
		    mediaUploader.open();
		};

       jQuery(document).ready(function($){
            $('#add_Project_image').on('click',function(){
                showMediaUploader($('#project_images_list'));
            });

            $('body').on('click','.remove_Project_image_ico',function(){
                $(this).parent().parent().remove();
            })

           // List with handle
           Sortable.create(project_images_list, {
               handle: '.project_images_list_item',
               animation: 150
           });

        });
    </script>

    <span>Shortcode [ui_gallery id="<?php echo $post->ID ?>"]</span>
    <input id="add_Project_image" type="button" value="Add image" style="margin:20px 10px; display:block">

    <div id="project_images_list" class="list-group">
	    <?php
	    if(count($project_image_urls)):?>

		        <?php foreach ($project_image_urls as $key => $Project_image_url): ?>
		            <?php if(!empty($Project_image_url) && isset($project_image_id[$key])): ?>
		            	<?php include( plugin_dir_path( __FILE__ ).'/image-block.php') ?>
		        	<?php endif ?>
		        <?php endforeach ?>
	        </div>
	    <?php endif ?>
	</div>
<?php }

function display_mime_type ($image_id){

    $type = get_post_mime_type($image_id);
    $url = wp_get_attachment_url( $image_id );

    $str = <<<EOT
<video class="item-video" playsinline autoplay muted loop>
        <source src="$url" type="video/webm">
        <source src="$url" type="video/mp4">
</video>
EOT;

    switch ($type) {
        case 'image/jpeg':
        case 'image/png':
        case 'image/gif':
            return '<img class="project_image" src="'.wp_get_attachment_image_src( $image_id, 'full' )[0].'" >'; break;
        case 'video/mpeg':
        case 'video/mp4':
        case 'video/quicktime':
            return $str; break;

        default:
            return '<div class="wrong-format"> Wrong format</div>'; break;
    }
}

function get_image_url($image_id){

    $type = get_post_mime_type($image_id);
    $url = wp_get_attachment_url( $image_id );

    switch ($type) {
        case 'image/jpeg':
        case 'image/png':
        case 'image/gif':
            return wp_get_attachment_image_src( $image_id, 'full' )[0]; break;
        default:
            return '<div class="wrong-format"> Wrong format</div>'; break;
    }
}

function gallery_meta_box_ca() {
    add_meta_box( 'gallery_meta_box_ca',
        'Content Association',
        'urge_options_display_child_meta_box_ca', // Use urge_options_display_child_meta_box_ca() from parent plugin
        'ui_gallery',
        'normal',
        'high'
    );
}

$options_gallery_caf = get_option('post_type_gallery_caf');
if ($options_gallery_caf){
    add_action( 'add_meta_boxes', 'gallery_meta_box_ca' );
}


function save_ui_gallery_custom_meta( $id, $item ) {
	if( $item->post_type == 'ui_gallery' ){
        delete_post_meta($id,'project_image_urls');
        delete_post_meta($id,'project_image_id');
        delete_post_meta($id,'project_image_title');
        delete_post_meta($id,'project_image_desc');
        if ( isset( $_POST['project_image_urls'] ) && !empty($_POST['project_image_urls']) ) {
            update_post_meta( $id, 'project_image_urls', json_encode($_POST['project_image_urls']) );
            update_post_meta( $id, 'project_image_id', json_encode($_POST['project_image_id']) );
            update_post_meta( $id, 'project_image_title', json_encode($_POST['project_image_title']) );
            update_post_meta( $id, 'project_image_desc', json_encode($_POST['project_image_desc']) );
        }
	}
}
add_action( 'save_post','save_ui_gallery_custom_meta',10,2 );


function ui_gallery_shortcode( $atts ){
	ob_start();
	if(isset($atts['id']) && !empty($atts['id'])){
		$images_ids 	= get_post_meta($atts['id'], 'project_image_id', true);
		$images_titles 	= get_post_meta($atts['id'], 'project_image_title', true);
		$images_descs 	= get_post_meta($atts['id'], 'project_image_desc', true);

        $images_ids 	= json_decode($images_ids);
		$images_titles 	= json_decode($images_titles);
		$images_descs 	= json_decode($images_descs);

        $project_image_urls = esc_html( get_post_meta( $atts['id'], 'project_image_urls', true ) );
        $project_image_urls = json_decode(htmlspecialchars_decode($project_image_urls));
	} ?>
	<?php if(count($images_ids)): ?>
		<div class="row gallery flex" id="gallery-single">
			<?php foreach ($images_ids as $key=>$image_id): ?>
        <div class="gallery-item">
          <a href="<?= get_image_url($image_id);?>" data-lightbox="<?= $image_id;?>" data-title="<?php echo isset($images_titles[$key])?$images_titles[$key]:'' ?>" class="gallery-single overlay"  data-sub-html=".caption">
            <?php echo display_mime_type($image_id)?>
            <!-- <h3>Click to Open Gallery Slideshow</h3> -->
            <div class="caption" style="display:none;"><p class="disclaimer">*Individual results may vary and are not guaranteed.</p></div>
          </a>
          <!-- <p class="disclaimer">*Individual results may vary and are not guaranteed</p> -->
				</div>
			<?php endforeach ?>
		</div>
 	<?php endif ?>
 	<?php return ob_get_clean(); ?>
<?php }
add_shortcode( 'ui_gallery', 'ui_gallery_shortcode' );
