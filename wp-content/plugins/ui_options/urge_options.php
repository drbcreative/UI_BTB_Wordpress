<?php
/*
Plugin Name: Ui Options
Description: Custom Extension Suite by Urge Interactive
Version: 4.0.4
Author: Urge Interactivesss
Author URI: http://urgeinteractive.com
*/

function ui_load_plugins()
{

    global $caf;
    $caf = array('concerns', 'events', 'gallery', 'locations', 'promotions', 'providers', 'testimonials', 'treatments', 'videogallery');

    $options_concerns = get_option('post_type_concerns');
    if ($options_concerns) {
        require_once(plugin_dir_path(__FILE__) . '/ui-concerns/concerns.php');
    }

    $options_events = get_option('post_type_events');
    if ($options_events) {
        require_once(plugin_dir_path(__FILE__) . '/ui-events/events.php');
    }
    $options_gallery = get_option('post_type_gallery');
    if ($options_gallery) {
        require_once(plugin_dir_path(__FILE__) . '/ui-gallery/ui-gallery.php');
    }

    $options_locations = get_option('post_type_locations');
    if ($options_locations) {
        require_once(plugin_dir_path(__FILE__) . '/ui-locations/location.php');
    }

    $options_promotions = get_option('post_type_promotions');
    if ($options_promotions) {
        require_once(plugin_dir_path(__FILE__) . '/ui-promotions/promotions.php');
    }

    $options_providers = get_option('post_type_providers');
    if ($options_providers) {
        require_once(plugin_dir_path(__FILE__) . '/ui-providers/ui-providers.php');
    }

    $options_testimonials = get_option('post_type_testimonials');
    if ($options_testimonials) {
        require_once(plugin_dir_path(__FILE__) . '/ui-testimonials/ui-testimonials.php');
    }

    $options_treatments = get_option('post_type_treatments');
    if ($options_treatments) {
        require_once(plugin_dir_path(__FILE__) . '/ui-treatments/ui-treatments.php');
    }

    $options_accordions = get_option('ui_accordions');
    if ($options_accordions) {
        require_once(plugin_dir_path(__FILE__) . '/ui-accordions/ui-accordions.php');
    }

    $options_videogallery = get_option('post_type_videogallery');
    if ($options_videogallery) {
        require_once(plugin_dir_path(__FILE__) . '/ui-video-gallery/ui-videogallery.php');
    }

    // $options_requests = get_option('post_type_requests');
    // if ($options_requests) {
    //     include_once(plugin_dir_path(__FILE__) . '/ui-requests/ui-requests.php');
    // }

    // $options_downloads = get_option('post_type_downloads');
    // if ($options_downloads) {
    //     include_once(plugin_dir_path(__FILE__) . '/ui-downloads/ui-downloads.php');
    // }
    //
    //
    // $options_maintenance_mode = get_option('maintenance_mode');
    // if ($options_maintenance_mode) {
    //     include_once(plugin_dir_path(__FILE__) . '/ui-maintenance/ui-maintenance.php');
    // }


    // $schedule_providers = get_option('schedule_providers');
    // $schedule_locations = get_option('schedule_locations');
    // $schedule_treatments = get_option('schedule_treatments');

    // $options_schedule = ( $schedule_providers || $schedule_locations || $schedule_treatments );
    //
    // if ($options_schedule) {
    //     include_once(plugin_dir_path(__FILE__) . '/ui-schedule/ui-schedule.php');
    // }

}

add_action('plugins_loaded', 'ui_load_plugins');


function urge_options_load_assets()
{

    wp_enqueue_style('jquery_select2', plugins_url('/assets/css/select2.css', __FILE__));
    wp_enqueue_script('jquery_select2', plugins_url('/assets/js/select2.min.js', __FILE__), array('jquery'), time(), true);

    wp_enqueue_style('urge_options_metabox-styles', plugins_url('/assets/css/metaboxes.css', __FILE__));
    wp_enqueue_script('urge_options_custom-js', plugins_url('/assets/js/metaboxes.js', __FILE__), 'jquery-ui-core', '1.0', true);

    //wp_enqueue_style( 'bootstrap', plugins_url('/assets/css/bootstrap.min.css', __FILE__));
    wp_enqueue_style( 'bootstrap-wrapper', plugins_url('/assets/css/bootstrap-wrapper.css', __FILE__));
    wp_enqueue_style( 'ui-admin-style', plugins_url('/assets/css/admin.css', __FILE__));

    wp_enqueue_script( 'bootstrap', plugins_url('/assets/js/bootstrap.js', __FILE__), 'jquery-ui-core', '1.0', true);

    wp_enqueue_script('jquery-ui', plugins_url('/assets/js/jquery-ui.min.js', __FILE__), array('jquery'), time(), false);
}

add_action('admin_enqueue_scripts', 'urge_options_load_assets');


/* Add Menus
-----------------------------------------------------------------*/
function ui_options_menu()
{
    add_menu_page(
        'UI Options',
        'UI Options',
        'manage_options',
        'urge_options',
        'ui_options_index',
        'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzNi41NiAzNi4xNCI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiNmZmY7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZT51aTwvdGl0bGU+PGcgaWQ9IkxheWVyXzIiIGRhdGEtbmFtZT0iTGF5ZXIgMiI+PGcgaWQ9Ik91dGxpbmVzIj48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik0wLDExLjYySDcuMTNWMjMuMTJhMTMuNjcsMTMuNjcsMCwwLDAsLjU0LDQuNjcsNC4xOSw0LjE5LDAsMCwwLDEuNzUsMiw1LjY1LDUuNjUsMCwwLDAsMywuNzIsNS44Nyw1Ljg3LDAsMCwwLDMtLjcxLDQuMzIsNC4zMiwwLDAsMCwxLjgzLTIuMSwxMy43NywxMy43NywwLDAsMCwuNDQtNC40MVYxMS42Mmg3LjA1VjIxLjc0cTAsNi4yNi0xLjE2LDguNTZhOS44Nyw5Ljg3LDAsMCwxLTQuMTgsNC4zMSwxNC42LDE0LjYsMCwwLDEtNywxLjUsMTQuMTIsMTQuMTIsMCwwLDEtNy40OC0xLjc2LDkuNDUsOS40NSwwLDAsMS00LTQuOVEwLDI3LjMsMCwyMS41N1oiLz48cmVjdCBjbGFzcz0iY2xzLTEiIHg9IjI4LjM1IiB5PSIxMS42MiIgd2lkdGg9IjcuMDUiIGhlaWdodD0iMjQuNTIiLz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik0zMi4xMyw5LjFhNC4yNCw0LjI0LDAsMCwwLDMuMTMtMS4zMiw0LjM5LDQuMzksMCwwLDAsMS4zMS0zLjIsNC40NCw0LjQ0LDAsMCwwLTEuMzItMy4yNCw0LjQzLDQuNDMsMCwwLDAtNi4zMiwwLDQuMzEsNC4zMSwwLDAsMC0xLjMxLDMuMTYsNC41MSw0LjUxLDAsMCwwLDEuMzIsMy4yOEE0LjMsNC4zLDAsMCwwLDMyLjEzLDkuMVoiLz48L2c+PC9nPjwvc3ZnPg==');
}

add_action('admin_menu', 'ui_options_menu');


/* Display Page
-----------------------------------------------------------------*/
function ui_options_index()
{
    ?>
    <div class="bootstrap-wrapper">

        <div class="wrap container">
            <h2>UI Options 4.0</h2>
            <p>This is a proprietary extension suite for Websites developed by Urge Interactive, LLC.</p>
            <br>
            <?php settings_errors(); ?>

            <?php
            $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'doc_options';
            ?>

            <ul class="nav nav-tabs">

                <li class="nav-item">
                  <a href="?page=urge_options&tab=doc_options"
                     class="nav-link <?php echo $active_tab === 'doc_options' ? 'active' : ''; ?>">Dashboard</a>
                </li>
                <li class="nav-item">
                  <a href="?page=urge_options&tab=main_options"
                     class="nav-link <?php echo $active_tab === 'main_options' ? 'active' : ''; ?>">Content</a>
                </li>
                <li class="nav-item">
                  <a href="?page=urge_options&tab=shortcodes_options"
                     class="nav-link <?php echo $active_tab === 'shortcodes_options' ? 'active' : ''; ?>">Shortcodes</a>
                </li>
            </ul>
            <form method="post" class="bg-white px-3 pb-0 border border-top-0 rounded-bottom shadow-lg pt-2" action="options.php">

                <?php
                if ($active_tab === 'main_options') {
                    settings_fields('ui_main_option');
                    do_settings_sections('ui_main_option');

                    submit_button();
                } else if ($active_tab === 'doc_options') {
                    settings_fields('ui_doc_option');
                    do_settings_sections('ui_doc_option');

                } else if ($active_tab === 'shortcodes_options') {
                    settings_fields('ui_shortcodes_option');
                    do_settings_sections('ui_shortcodes_option');

                    submit_button();
                } else if ($active_tab === 'maintenance_options') {
                    settings_fields('ui_maintenance_option');
                    do_settings_sections('ui_maintenance_option');

                    submit_button();
                } else if ($active_tab === 'downloads_options') {
                    settings_fields('ui_downloads_option');
                    do_settings_sections('ui_downloads_option');

                    submit_button();
                }
                ?>
                <!--            --><?php //submit_button();
                ?>
            </form>
        </div>
    </div>
    <?php
}


function ui_options()
{

    //clear checkbox if not checked
    if (isset($_POST['submit']) && $_POST['option_page'] === 'ui_main_option') {

        update_option('posts_caf', 0);

        update_option('post_type_concerns', 0);
        update_option('post_type_concerns_caf', 0);

        update_option('post_type_events', 0);
        update_option('post_type_events_caf', 0);
        update_option('post_type_event_rsvp', 0);

        update_option('post_type_gallery', 0);
        update_option('post_type_gallery_caf', 0);

        update_option('post_type_locations', 0);
        update_option('post_type_locations_caf', 0);

        update_option('post_type_promotions', 0);
        update_option('post_type_promotions_caf', 0);

        update_option('post_type_providers', 0);
        update_option('post_type_providers_caf', 0);
        update_option('post_type_providers_alternative_img', 0);

        update_option('post_type_testimonials', 0);
        update_option('post_type_testimonials_caf', 0);

        update_option('post_type_treatments', 0);
        update_option('post_type_treatments_caf', 0);

        update_option('post_type_videogallery', 0);
        update_option('post_type_videogallery_caf', 0);

        // update_option('post_type_requests', 0);

        // update_option('schedule_providers', 0);
        // update_option('schedule_locations', 0);
        // update_option('schedule_treatments', 0);
    }

    //clear Maintenance tab
    if (isset($_POST['submit']) && $_POST['option_page'] === 'ui_maintenance_option') {
        update_option('maintenance_mode', 0);
    }

    // clear Downloads tab
    if (isset($_POST['submit']) && $_POST['option_page'] === 'ui_downloads_option') {
        update_option('post_type_downloads', 0);
    }


    if (isset($_POST['submit'], $_POST['posts_caf'])) {
        update_option('posts_caf', $_POST['posts_caf']);
    }

    if (isset($_POST['submit'], $_POST['post_type_concerns'])) {
        update_option('post_type_concerns', $_POST['post_type_concerns']);
        update_option('post_type_concerns_names', $_POST['post_type_concerns_names']);

    }

    if (isset($_POST['submit'], $_POST['post_type_concerns_caf'])) {
        update_option('post_type_concerns_caf', $_POST['post_type_concerns_caf']);
    }

    if (isset($_POST['submit'], $_POST['post_type_events'])) {
        update_option('post_type_events', $_POST['post_type_events']);
        update_option('post_type_events_names', $_POST['post_type_events_names']);
    }
    if (isset($_POST['submit'], $_POST['post_type_events_caf'])) {
        update_option('post_type_events_caf', $_POST['post_type_events_caf']);
    }
    if (isset($_POST['submit'], $_POST['post_type_event_rsvp'])) {
        update_option('post_type_event_rsvp', $_POST['post_type_event_rsvp']);
    }

    if (isset($_POST['submit'], $_POST['post_type_gallery'])) {
        update_option('post_type_gallery', $_POST['post_type_gallery']);
        update_option('post_type_gallery_names', $_POST['post_type_gallery_names']);
    }
    if (isset($_POST['submit'], $_POST['post_type_gallery_caf'])) {
        update_option('post_type_gallery_caf', $_POST['post_type_gallery_caf']);
    }

    if (isset($_POST['submit'], $_POST['post_type_locations'])) {
        update_option('post_type_locations', $_POST['post_type_locations']);
        update_option('post_type_locations_names', $_POST['post_type_locations_names']);
    }
    if (isset($_POST['submit'], $_POST['post_type_locations_caf'])) {
        update_option('post_type_locations_caf', $_POST['post_type_locations_caf']);
    }

    if (isset($_POST['submit'], $_POST['post_type_promotions'])) {
        update_option('post_type_promotions', $_POST['post_type_promotions']);
        update_option('post_type_promotions_names', $_POST['post_type_promotions_names']);
    }
    if (isset($_POST['submit'], $_POST['post_type_promotions_caf'])) {
        update_option('post_type_promotions_caf', $_POST['post_type_promotions_caf']);
    }

    if (isset($_POST['submit'], $_POST['post_type_providers'])) {
        update_option('post_type_providers', $_POST['post_type_providers']);
        update_option('post_type_providers_names', $_POST['post_type_providers_names']);
        update_option('post_type_providers_alternative_img', $_POST['post_type_providers_alternative_img']);
    }
    if (isset($_POST['submit'], $_POST['post_type_providers_caf'])) {
        update_option('post_type_providers_caf', $_POST['post_type_providers_caf']);
    }

    if (isset($_POST['submit'], $_POST['post_type_testimonials'])) {
        update_option('post_type_testimonials', $_POST['post_type_testimonials']);
        update_option('post_type_testimonials_names', $_POST['post_type_testimonials_names']);
    }
    if (isset($_POST['submit'], $_POST['post_type_testimonials_caf'])) {
        update_option('post_type_testimonials_caf', $_POST['post_type_testimonials_caf']);
    }

    if (isset($_POST['submit'], $_POST['post_type_treatments'])) {
        update_option('post_type_treatments', $_POST['post_type_treatments']);
        update_option('post_type_treatments_names', $_POST['post_type_treatments_names']);
    }

    if (isset($_POST['submit'], $_POST['post_type_treatments_caf'])) {
        update_option('post_type_treatments_caf', $_POST['post_type_treatments_caf']);
    }

    if (isset($_POST['submit'], $_POST['post_type_videogallery'])) {
        update_option('post_type_videogallery', $_POST['post_type_videogallery']);
        update_option('post_type_videogallery_names', $_POST['post_type_videogallery_names']);
        
    }
    if (isset($_POST['submit'], $_POST['post_type_videogallery_caf'])) {
        update_option('post_type_videogallery_caf', $_POST['post_type_videogallery_caf']);
    }

    // if (isset($_POST['submit'], $_POST['post_type_requests'])) {
    //     update_option('post_type_requests', $_POST['post_type_requests']);
    //     update_option('post_type_requests_names', $_POST['post_type_requests_names']);
    // }

    // if (isset($_POST['submit'], $_POST['post_type_downloads'])) {
    //     update_option('post_type_downloads', $_POST['post_type_downloads']);
    //     update_option('post_type_downloads_names', $_POST['post_type_downloads_names']);
    // }
    //
    //
    // if (isset($_POST['submit'], $_POST['maintenance_mode'])) {
    //     update_option('maintenance_mode', $_POST['maintenance_mode']);
    // }

    //Schedule
    // if (isset($_POST['submit'], $_POST['schedule_providers'])) {
    //     update_option('schedule_providers', $_POST['schedule_providers']);
    // }
    // if (isset($_POST['submit'], $_POST['schedule_locations'])) {
    //     update_option('schedule_locations', $_POST['schedule_locations']);
    // }
    // if (isset($_POST['submit'], $_POST['schedule_treatments'])) {
    //     update_option('schedule_treatments', $_POST['schedule_treatments']);
    // }


//  Shortcodes tab, clear all and then update if isset
    if (isset($_POST['submit']) && $_POST['option_page'] === 'ui_shortcodes_option') {
        update_option('ui_accordions', 0);
        update_option('ui_schedule_cta', 0);
        update_option('ui_modal_iframe', 0);
        update_option('ui_downloads_shortcode', 0);
    }

    if (isset($_POST['submit'], $_POST['accordions_shortcodes'])) {
        update_option('ui_accordions', $_POST['accordions_shortcodes']);
    }

    if (isset($_POST['submit'], $_POST['schedule_cta_shortcodes'])) {
        update_option('ui_schedule_cta', $_POST['schedule_cta_shortcodes']);
    }

    if (isset($_POST['submit'], $_POST['modal_iframe_shortcode'])) {
        update_option('ui_modal_iframe', $_POST['modal_iframe_shortcode']);
    }

    // if (isset($_POST['submit'], $_POST['ui_downloads_shortcode'])) {
    //     update_option('ui_downloads_shortcode', $_POST['ui_downloads_shortcode']);
    // }


    /* Front Page Options Section */
    add_settings_section(
        'urge_main_option',             // $id  -      Slug-name to identify the section. Used in the 'id' attribute of tags.
        'Content Control Panel',        // $title  -   Formatted title of the section. Shown as the heading for the section.
        'ui_main_option_header_callback',    // $callback - Function that echos out any content at the top of the section (between heading and fields).
        'ui_main_option'       // $page    -  The slug-name of the settings page on which to show the section. Built-in pages include
    );

//    add_settings_field(
//        'post_type_1',                        // $id       Slug-name to identify the field. Used in the 'id' attribute of tags.
//        'Post type 1',                        // $title    Formatted title of the field. Shown as the label for the field
//        'ui_main_option_callback', // $callback Function that fills the field with the desired form inputs. The function should echo its output.
//        'ui_main_option',      // $page     The slug-name of the settings page on which to show the section(general, reading, writing, ...).
//        'urge_main_option'              // $section  Optional. The slug-name of the section of the settings page in which to show the box. Default 'default'.
//    );

    /* Header Options Section */
    add_settings_section(
        'urge_doc_option',
        'Dashboard',
        'ui_doc_header_callback',
        'ui_doc_option'
    );

    /* Shortcodes Options Section */
    add_settings_section(
        'urge_shortcodes_option',
        'Shortcode Control Panel',
        'ui_shortcodes_header_callback',
        'ui_shortcodes_option'
    );

    /* Maintenance Options Section */
    add_settings_section(
        'urge_maintenance_option',
        'Maintenance Control Panel',
        'ui_maintenance_header_callback',
        'ui_maintenance_option'
    );

    /* Downloads Options Section */
    add_settings_section(
        'urge_downloads_option',
        'Downloads Control Panel',
        'ui_downloads_header_callback',
        'ui_downloads_option'
    );


    register_setting('ui_main_option', 'ui_main_option');
    register_setting('ui_doc_option', 'ui_doc_option');
    register_setting('ui_shortcodes_option', 'ui_shortcodes_option');
    register_setting('ui_maintenance_option', 'ui_maintenance_option');
    //register_setting('ui_downloads_option', 'ui_downloads_option');
}

add_action('admin_init', 'ui_options');


/* Call Backs
-----------------------------------------------------------------*/
function ui_main_option_header_callback()
{
    ui_main_option_callback_plugins();
}


function ui_doc_header_callback()
{
    urgeOptionsDisplayFeatureStatus();
    require_once plugin_dir_path(__FILE__) . '/documentation.html';
}


function ui_main_option_callback_plugins()
{
    global $caf;

    $options_posts_caf = get_option('posts_caf');

    $options_concerns = get_option('post_type_concerns');
    $options_concerns_caf = get_option('post_type_concerns_caf');
    $options_concerns_names = get_option('post_type_concerns_names');

    $options_events = get_option('post_type_events');
    $options_events_caf = get_option('post_type_events_caf');
    $options_event_rsvp = get_option('post_type_event_rsvp');
    $options_events_names = get_option('post_type_events_names');

    $options_gallery = get_option('post_type_gallery');
    $options_gallery_caf = get_option('post_type_gallery_caf');
    $options_gallery_names = get_option('post_type_gallery_names');

    $options_locations = get_option('post_type_locations');
    $options_locations_caf = get_option('post_type_locations_caf');
    $options_locations_names = get_option('post_type_locations_names');

    $options_promotions = get_option('post_type_promotions');
    $options_promotions_caf = get_option('post_type_promotions_caf');
    $options_promotions_names = get_option('post_type_promotions_names');

    $options_providers = get_option('post_type_providers');
    $options_providers_caf = get_option('post_type_providers_caf');
    $options_providers_names = get_option('post_type_providers_names');
    $options_providers_alternative_img = get_option('post_type_providers_alternative_img');

    $options_testimonials = get_option('post_type_testimonials');
    $options_testimonials_caf = get_option('post_type_testimonials_caf');
    $options_testimonials_names = get_option('post_type_testimonials_names');

    $options_treatments         = get_option('post_type_treatments');
    $options_treatments_caf     = get_option('post_type_treatments_caf');
    $options_treatments_names   = get_option('post_type_treatments_names');

    $options_videogallery       = get_option('post_type_videogallery');
    $options_videogallery_caf   = get_option('post_type_videogallery_caf');
    $options_videogallery_names = get_option('post_type_videogallery_names');

    ?>
    <div class="alert alert-info" role="alert">
      <strong>You will need to "Reset Permalinks" when activating any of the post types below.</strong>
    </div>

<div class="card-columns">

    <div class="card">
        <div class="card-header" id="headingOne">
            <h4 class="card-title">
                    Concerns Post Type
            </h4>
        </div>
        <div id="collapseOne" class="" role="tabpanel" aria-labelledby="headingOne">
            <div class="card-body">
                <div class="pt_input">
                    <input type="checkbox" title="Enable concerns Post Type" id="post_type_concerns"
                           name="post_type_concerns" <?php echo $options_concerns ? 'checked' : '' ?> > Enable Concerns Post Type <br>
                </div>

                <!--    Post type names block-->
                <div class="pt_input">
                    <label for="post_type_concerns_names[singular]" style="display: inline-block; width: 150px;">Singular
                        Name: </label>
                    <input id="post_type_concerns_names[singular]" name="post_type_concerns_names[singular]" type="text"
                           value="<?php echo $options_concerns_names['singular']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_concerns_names[plural]" style="display: inline-block; width: 150px;">Plural Name: </label>
                    <input id="post_type_concerns_names[plural]" name="post_type_concerns_names[plural]" type="text"
                           value="<?php echo $options_concerns_names['plural']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_concerns_names[slug]" style="display: inline-block; width: 150px;">Slug: </label>
                    <input id="post_type_concerns_names[slug]" name="post_type_concerns_names[slug]" type="text"
                           value="<?php echo $options_concerns_names['slug']; ?>">
                </div>

                <div><em>If Singular Name, Plural Name or Slug is empty - will use default names.</em></div>
                <!--End block-->

                <?php foreach ($caf as $value) : ?>
                    <?php if ($value === 'concerns') {
                        continue;
                    } ?>

                    <input type="checkbox"
                           title="<?php ucfirst($value); ?> association"
                           name="post_type_concerns_caf[<?php echo $value; ?>]" <?php echo isset($options_concerns_caf[$value]) ? 'checked' : '' ?> > <?php echo ucfirst($value); ?> association
                    <br>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" role="tab" id="heading2">
            <h4 class="card-title">
                    Events Post Type

            </h4>
        </div>
        <div id="collapse2" class="" role="tabpanel" aria-labelledby="heading2">
            <div class="card-body">
                <div class="pt_input">
                    <input type="checkbox" id="post_type_events" title=""
                           name="post_type_events" <?php echo $options_events ? 'checked' : '' ?> > Enable Events Post Type <br>
                </div>
                <!--    Post type names block-->
                <div class="pt_input">
                    <label for="post_type_events_names[singular]" style="display: inline-block; width: 150px;">Singular
                        Name: </label>
                    <input id="post_type_events_names[singular]" name="post_type_events_names[singular]" type="text"
                           value="<?php echo $options_events_names['singular']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_events_names[plural]" style="display: inline-block; width: 150px;">Plural Name: </label>
                    <input id="post_type_events_names[plural]" name="post_type_events_names[plural]" type="text"
                           value="<?php echo $options_events_names['plural']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_events_names[slug]" style="display: inline-block; width: 150px;">Slug: </label>
                    <input id="post_type_events_names[slug]" name="post_type_events_names[slug]" type="text"
                           value="<?php echo $options_events_names['slug']; ?>">
                </div>

                <div><em>If Singular Name, Plural Name or Slug is empty - will use default names.</em></div>
                <!--End blcok-->
                <?php foreach ($caf as $value) : ?>
                    <?php if ($value === 'events') {
                        continue;
                    } ?>

                    <input type="checkbox"
                           title=""
                           name="post_type_events_caf[<?php echo $value; ?>]" <?php echo isset($options_events_caf[$value]) ? 'checked' : '' ?> > <?php echo ucfirst($value); ?> association
                    <br>
                <?php endforeach; ?>

                <div class="pt_header" style="font-weight: bold"> Event RSVP:</div>
                <input title="" type="checkbox" id="post_type_event_rsvp"
                       name="post_type_event_rsvp" <?php echo $options_event_rsvp ? 'checked' : '' ?> > Enable RSVP functionality <br>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" role="tab" id="heading3">
            <h4 class="card-title">
                    Gallery Post Type
            </h4>
        </div>
        <div id="collapse3" class="" role="tabpanel" aria-labelledby="heading3">
            <div class="card-body">
                <div class="pt_input">
                    <input type="checkbox" id="post_type_gallery" title=""
                           name="post_type_gallery" <?php echo $options_gallery ? 'checked' : '' ?> > Enable Gallery Post Type <br>
                </div>
                <!--    Post type names block-->
                <div class="pt_input">
                    <label for="post_type_gallery_names[singular]" style="display: inline-block; width: 150px;">Singular
                        Name: </label>
                    <input id="post_type_gallery_names[singular]" name="post_type_gallery_names[singular]" type="text"
                           value="<?php echo $options_gallery_names['singular']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_gallery_names[plural]" style="display: inline-block; width: 150px;">Plural Name: </label>
                    <input id="post_type_gallery_names[plural]" name="post_type_gallery_names[plural]" type="text"
                           value="<?php echo $options_gallery_names['plural']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_gallery_names[slug]" style="display: inline-block; width: 150px;">Slug: </label>
                    <input id="post_type_gallery_names[slug]" name="post_type_gallery_names[slug]" type="text"
                           value="<?php echo $options_gallery_names['slug']; ?>">
                </div>

                <div><em>If Singular Name, Plural Name or Slug is empty - will use default names.</em></div>
                <!--End block-->
                <?php foreach ($caf as $value) : ?>
                    <?php if ($value === 'gallery') {
                        continue;
                    } ?>

                    <input type="checkbox"
                           title=""
                           name="post_type_gallery_caf[<?php echo $value; ?>]" <?php echo isset($options_gallery_caf[$value]) ? 'checked' : '' ?> > <?php echo ucfirst($value); ?> association
                    <br>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" role="tab" id="heading4">
            <h4 class="card-title">
                    Locations Post Type
            </h4>
        </div>
        <div id="collapse4" class="" role="tabpanel" aria-labelledby="heading4">
            <div class="card-body">
                <div class="pt_input">
                    <input type="checkbox" title="" id="post_type_locations"
                           name="post_type_locations" <?php echo $options_locations ? 'checked' : '' ?> > Enable Locations Post Type <br>
                </div>
                <!--    Post type names block-->
                <div class="pt_input">
                    <label for="post_type_locations_names[singular]" style="display: inline-block; width: 150px;">Singular
                        Name: </label>
                    <input id="post_type_locations_names[singular]" name="post_type_locations_names[singular]" type="text"
                           value="<?php echo $options_locations_names['singular']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_locations_names[plural]" style="display: inline-block; width: 150px;">Plural
                        Name: </label>
                    <input id="post_type_locations_names[plural]" name="post_type_locations_names[plural]" type="text"
                           value="<?php echo $options_locations_names['plural']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_locations_names[slug]" style="display: inline-block; width: 150px;">Slug: </label>
                    <input id="post_type_locations_names[slug]" name="post_type_locations_names[slug]" type="text"
                           value="<?php echo $options_locations_names['slug']; ?>">
                </div>

                <div><em>If Singular Name, Plural Name or Slug is empty - will use default names.</em></div>
                <!--End blcok-->

                <?php foreach ($caf as $value) : ?>
                    <?php if ($value === 'locations') {
                        continue;
                    } ?>

                    <input type="checkbox"
                           title=""
                           name="post_type_locations_caf[<?php echo $value; ?>]" <?php echo isset($options_locations_caf[$value]) ? 'checked' : '' ?> > <?php echo ucfirst($value); ?> association
                    <br>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" role="tab" id="heading5">
            <h4 class="card-title">
                    Promotions Post Type
            </h4>
        </div>
        <div id="collapse5" class="" role="tabpanel" aria-labelledby="heading5">
            <div class="card-body">
                <div class="pt_input">
                    <input type="checkbox" id="post_type_promotions"
                           title=""
                           name="post_type_promotions" <?php echo $options_promotions ? 'checked' : '' ?> > Enable Promotions Post Type <br>
                </div>
                <!--    Post type names block-->
                <div class="pt_input">
                    <label for="post_type_promotions_names[singular]" style="display: inline-block; width: 150px;">Singular
                        Name: </label>
                    <input id="post_type_promotions_names[singular]" name="post_type_promotions_names[singular]" type="text"
                           value="<?php echo $options_promotions_names['singular']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_promotions_names[plural]" style="display: inline-block; width: 150px;">Plural
                        Name: </label>
                    <input id="post_type_promotions_names[plural]" name="post_type_promotions_names[plural]" type="text"
                           value="<?php echo $options_promotions_names['plural']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_promotions_names[slug]" style="display: inline-block; width: 150px;">Slug: </label>
                    <input id="post_type_promotions_names[slug]" name="post_type_promotions_names[slug]" type="text"
                           value="<?php echo $options_promotions_names['slug']; ?>">
                </div>

                <div><em>If Singular Name, Plural Name or Slug is empty - will use default names.</em></div>
                <!--End blcok-->
                <?php foreach ($caf as $value) : ?>
                    <?php if ($value === 'promotions') {
                        continue;
                    } ?>

                    <input type="checkbox"
                           title=""
                           name="post_type_promotions_caf[<?php echo $value; ?>]" <?php echo isset($options_promotions_caf[$value]) ? 'checked' : '' ?> > <?php echo ucfirst($value); ?> association
                    <br>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" role="tab" id="heading6">
            <h4 class="card-title">
                    Providers Post Type
            </h4>
        </div>
        <div id="collapse6" class="" role="tabpanel" aria-labelledby="heading6">
            <div class="card-body">
                <div class="pt_input">
                    <input type="checkbox" id="post_type_providers"
                           title=""
                           name="post_type_providers" <?php echo $options_providers ? 'checked' : '' ?> > Enable Providers Post Type <br>
                </div>

                <!--    Post type names block-->
                <div class="pt_input">
                    <label for="post_type_providers_names[singular]" style="display: inline-block; width: 150px;">Singular
                        Name: </label>
                    <input id="post_type_providers_names[singular]" name="post_type_providers_names[singular]" type="text"
                           value="<?php echo $options_providers_names['singular']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_providers_names[plural]" style="display: inline-block; width: 150px;">Plural
                        Name: </label>
                    <input id="post_type_providers_names[plural]" name="post_type_providers_names[plural]" type="text"
                           value="<?php echo $options_providers_names['plural']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_providers_names[slug]" style="display: inline-block; width: 150px;">Slug: </label>
                    <input id="post_type_providers_names[slug]" name="post_type_providers_names[slug]" type="text"
                           value="<?php echo $options_providers_names['slug']; ?>">
                </div>

                <div><em>If Singular Name, Plural Name or Slug is empty - will use default names.</em></div>
                <!--End blcok-->

<!--                Alternate Image-->
                <div class="pt_input" style="padding: 10px 0">
                    <label for="post_type_providers_alternative_img" style="display: inline-block; width: 150px;">Alternate Image: </label>
                    <input type="checkbox"
                           title=""
                           name="post_type_providers_alternative_img" <?php echo ($options_providers_alternative_img) ? 'checked' : '' ?> >
                </div>
<!--                End -->

                <?php foreach ($caf as $value) : ?>
                    <?php if ($value === 'providers') {
                        continue;
                    } ?>

                    <input type="checkbox"
                           title=""
                           name="post_type_providers_caf[<?php echo $value; ?>]" <?php echo isset($options_providers_caf[$value]) ? 'checked' : '' ?> > <?php echo ucfirst($value); ?> association
                    <br>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" role="tab" id="heading7">
            <h4 class="card-title">
                    Testimonials Post Type
            </h4>
        </div>
        <div id="collapse7" class="" role="tabpanel" aria-labelledby="heading7">
            <div class="card-body">
                <div class="pt_input">
                    <input type="checkbox" id="post_type_testimonials"
                           title=""
                           name="post_type_testimonials" <?php echo $options_testimonials ? 'checked' : '' ?> > Enable Testimonials Post Type <br>
                </div>
                <!--    Post type names block-->
                <div class="pt_input">
                    <label for="post_type_testimonials_names[singular]" style="display: inline-block; width: 150px;">Singular
                        Name: </label>
                    <input id="post_type_testimonials_names[singular]" name="post_type_testimonials_names[singular]" type="text"
                           value="<?php echo $options_testimonials_names['singular']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_testimonials_names[plural]" style="display: inline-block; width: 150px;">Plural
                        Name: </label>
                    <input id="post_type_testimonials_names[plural]" name="post_type_testimonials_names[plural]" type="text"
                           value="<?php echo $options_testimonials_names['plural']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_testimonials_names[slug]" style="display: inline-block; width: 150px;">Slug: </label>
                    <input id="post_type_testimonials_names[slug]" name="post_type_testimonials_names[slug]" type="text"
                           value="<?php echo $options_testimonials_names['slug']; ?>">
                </div>

                <div><em>If Singular Name, Plural Name or Slug is empty - will use default names.</em></div>
                <!--End blcok-->
                <?php foreach ($caf as $value) : ?>
                    <?php if ($value === 'testimonials') {
                        continue;
                    } ?>

                    <input type="checkbox"
                           title=""
                           name="post_type_testimonials_caf[<?php echo $value; ?>]" <?php echo isset($options_testimonials_caf[$value]) ? 'checked' : '' ?> > <?php echo ucfirst($value); ?> association
                    <br>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" role="tab" id="heading8">
            <h4 class="card-title">
                    Treatments Post Type
            </h4>
        </div>
        <div id="collapse8" class="" role="tabpanel" aria-labelledby="heading8">
            <div class="card-body">
                <div class="pt_input">
                    <input type="checkbox" id="post_type_treatments"
                           title=""
                           name="post_type_treatments" <?php echo $options_treatments ? 'checked' : '' ?> > Enable Treatments Post Type <br>
                </div>
                <!--    Post type names block-->
                <div class="pt_input">
                    <label for="post_type_treatments_names[singular]" style="display: inline-block; width: 150px;">Singular
                        Name: </label>
                    <input id="post_type_treatments_names[singular]" name="post_type_treatments_names[singular]" type="text"
                           value="<?php echo $options_treatments_names['singular']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_treatments_names[plural]" style="display: inline-block; width: 150px;">Plural
                        Name: </label>
                    <input id="post_type_treatments_names[plural]" name="post_type_treatments_names[plural]" type="text"
                           value="<?php echo $options_treatments_names['plural']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_treatments_names[slug]" style="display: inline-block; width: 150px;">Slug: </label>
                    <input id="post_type_treatments_names[slug]" name="post_type_treatments_names[slug]" type="text"
                           value="<?php echo $options_treatments_names['slug']; ?>">
                </div>

                <div><em>If Singular Name, Plural Name or Slug is empty - will use default names.</em></div>
                <!--End blcok-->

                <?php foreach ($caf as $value) : ?>
                    <?php if ($value === 'treatments') {
                        continue;
                    } ?>

                    <input type="checkbox"
                           title=""
                           name="post_type_treatments_caf[<?php echo $value; ?>]" <?php echo isset($options_treatments_caf[$value]) ? 'checked' : '' ?> > <?php echo ucfirst($value); ?> association
                    <br>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" role="tab" id="heading8">
            <h4 class="card-title">
                    Video Gallery Post Type
            </h4>
        </div>
        <div id="collapse8" class="" role="tabpanel" aria-labelledby="heading8">
            <div class="card-body">
                <div class="pt_input">
                    <input type="checkbox" id="post_type_videogallery"
                           title=""
                           name="post_type_videogallery" <?php echo $options_videogallery ? 'checked' : '' ?> > Enable Video Gallery Post Type <br>
                </div>
                <!--    Post type names block-->
                <div class="pt_input">
                    <label for="post_type_videogallery_names[singular]" style="display: inline-block; width: 150px;">Singular
                        Name: </label>
                    <input id="post_type_videogallery_names[singular]" name="post_type_videogallery_names[singular]" type="text"
                           value="<?php echo $options_videogallery_names['singular']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_videogallery_names[plural]" style="display: inline-block; width: 150px;">Plural
                        Name: </label>
                    <input id="post_type_videogallery_names[plural]" name="post_type_videogallery_names[plural]" type="text"
                           value="<?php echo $options_videogallery_names['plural']; ?>">
                </div>

                <div class="pt_input">
                    <label for="post_type_videogallery_names[slug]" style="display: inline-block; width: 150px;">Slug: </label>
                    <input id="post_type_videogallery_names[slug]" name="post_type_videogallery_names[slug]" type="text"
                           value="<?php echo $options_videogallery_names['slug']; ?>">
                </div>

                <div><em>If Singular Name, Plural Name or Slug is empty - will use default names.</em></div>
                <!--End blcok-->

                <?php foreach ($caf as $value) : ?>
                    <?php if ($value === 'videogallery') {
                        continue;
                    } ?>

                    <input type="checkbox"
                           title=""
                           name="post_type_videogallery_caf[<?php echo $value; ?>]" <?php echo isset($options_videogallery_caf[$value]) ? 'checked' : '' ?> > <?php echo ucfirst($value); ?> association
                    <br>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" role="tab" id="headingZero">
            <h4 class="card-title">
                    Posts
            </h4>
        </div>
        <div id="collapseZero" class="" role="tabpanel" aria-labelledby="headingZero">
            <div class="card-body">
                <div class="pt_input">
                    <input type="checkbox" title="Enable Content Assocation" id="posts_caf" name="posts_caf" <?php echo $options_posts_caf ? 'checked' : '' ?> > Enable Content Association Fields <br>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
}


function ui_shortcodes_header_callback()
{

    $options_accordions = get_option('ui_accordions');
    $options_schedule_cta = get_option('ui_schedule_cta');
    $options_modal_iframe = get_option('ui_modal_iframe');

    ?>
    <div class="alert alert-warning">
      <strong>Must be used with the <code>shortcode</code> block in Gutenberg. With the [opening block] preceding the content and the [/closing block] after the content.</strong>
    </div>
    <strong>Accordion shortcodes:</strong>
    <input type="checkbox" id="accordions_shortcodes"
           title=""
           name="accordions_shortcodes" <?php echo $options_accordions ? 'checked' : '' ?> > Enable Accordion shortcodes <br>

    <p><strong>Accordion example:</strong></p>

    <pre class="bg-dark text-light p-2">
    [collapse open=&quot;yes&quot; title=&quot;Title Text1&quot; class=&quot;some_name&quot;]
    Content block(s)
    [/collapse]</pre>

    <strong>Schedule CTA Button</strong>
    <input type="checkbox" id="schedule_cta_shortcodes"
           title=""
           name="schedule_cta_shortcodes" <?php echo $options_schedule_cta ? 'checked' : '' ?> > Enable Schedule CTA shortcode
    <br>

    <strong>Schedule CTA example:</strong>
    <p>[schedule-cta text="" class="" target=""] will output the following code</p>
    <pre class="bg-dark text-light p-2">
      &lt;div&gt;
          &lt;a href=&quot;&lt;?php echo (!empty($atts['target'])) ? $atts['target'] : '#' ?&gt;&quot;
             class=&quot;btn &lt;?php echo (!empty($atts['class'])) ? $atts['class'] : '' ?&gt;&quot;&gt;
              &lt;?php echo (!empty($atts['text'])) ? $atts['text'] : '' ?&gt;
          &lt;/a&gt;
      &lt;/div&gt;</pre>

    <strong>Modal</strong>
    <input type="checkbox" id="modal_iframe_shortcode"
           title=""
           name="modal_iframe_shortcode" <?php echo $options_modal_iframe ? 'checked' : '' ?> > Enable Modal shortcode <br>


    <strong>Modal example:</strong>
    <p>[modal button-text="click" button-class="class1" modal-title="modal title"] usually going to be an iframe
        [/modal]</p>
    <hr>

    <?php
}


function ui_maintenance_header_callback()
{
    $options_maintenance_mode = get_option('maintenance_mode');
    ?>

    <div class="pt_header" style="font-weight: bold">Maintenance mode:</div>
    <input type="checkbox" id="maintenance_mode"
           title=""
           name="maintenance_mode" <?php echo $options_maintenance_mode ? 'checked' : '' ?> > Enable Maintenance mode <br>
    <div><em>To override current default view you have to create maintenance.php file in theme root folder with new page
            view.</em></div>
    <br>
    <hr>

    <?php
}


function ui_downloads_header_callback(){
    $options_downloads = get_option('post_type_downloads');
    $options_downloads_names = get_option('post_type_downloads_names');
    ?>

    <div class="pt_header" style="font-weight: bold"> Downloads Post Type:</div>

    <div class="card-body">
        <input type="checkbox" id="post_type_downloads"
               title=""
               name="post_type_downloads" <?php echo $options_downloads ? 'checked' : '' ?> > Enable Downloads Post Type <br>
        <!--    Post type names block-->
        <div class="pt_input">
            <label for="post_type_downloads_names[singular]" style="display: inline-block; width: 150px;">Singular
                Name: </label>
            <input id="post_type_downloads_names[singular]" name="post_type_downloads_names[singular]" type="text"
                   value="<?php echo $options_downloads_names['singular']; ?>">
        </div>

        <div class="pt_input">
            <label for="post_type_downloads_names[plural]" style="display: inline-block; width: 150px;">Plural
                Name: </label>
            <input id="post_type_downloads_names[plural]" name="post_type_downloads_names[plural]" type="text"
                   value="<?php echo $options_downloads_names['plural']; ?>">
        </div>

        <div class="pt_input">
            <label for="post_type_downloads_names[slug]" style="display: inline-block; width: 150px;">Slug: </label>
            <input id="post_type_downloads_names[slug]" name="post_type_downloads_names[slug]" type="text"
                   value="<?php echo $options_downloads_names['slug']; ?>">
        </div>

        <div><em>If Singular Name, Plural Name or Slug is empty - will use default names.</em></div>
        <!--End blcok-->
        <hr>
    </div>

    <?php

}


function urge_options_schedule_cta_shortcode($atts)
{

    $options_schedule_cta = get_option('ui_schedule_cta');

    ob_start();

    if (empty($atts) || !$options_schedule_cta) {
        return ob_get_clean();
    }

    ?>

    <div>
        <a href="<?php echo (!empty($atts['target'])) ? $atts['target'] : '#' ?>"
           class="btn <?php echo (!empty($atts['class'])) ? $atts['class'] : '' ?>">
            <?php echo (!empty($atts['text'])) ? $atts['text'] : '' ?>
        </a>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('schedule-cta', 'urge_options_schedule_cta_shortcode');


//[modal button-text=”click” button-class=”slass1″ modal-title=”modal title”] usually going to be an <iframe> [/modal]
function ui_modal_frame_shortcode($atts, $content)
{
    $options_modal_iframe = get_option('ui_modal_iframe');
    ob_start();

    if (empty($content) || !$options_modal_iframe) {
        return ob_get_clean();
    }
    ?>
    <!-- Button trigger modal -->
    <button type="button" class="btn <?php echo (!empty($atts['button-class'])) ? $atts['button-class'] : 'Modal' ?>"
            data-toggle="modal" data-target="#urgeOptionsModal">
        <?php echo (!empty($atts['button-text'])) ? $atts['button-text'] : 'Modal' ?>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="urgeOptionsModal" tabindex="-1" role="dialog" aria-labelledby="urgeOptionsModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <?php if (!empty($atts['modal-title'])) { ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo $atts['modal-title'] ?></h4>
                    </div>
                <?php } ?>
                <div class="modal-body">
                    <div class="video-container"><?php echo $content; ?></div>
                </div>
            </div>
        </div>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('modal', 'ui_modal_frame_shortcode');


//Display method for child plugins
function urge_options_display_child_meta_box_ca()
{
    global $post, $post_type, $caf;

    if ($post_type === 'ui_gallery') {
        $meta_name = 'gallery';
        $options_caf = get_option('post_type_' . $meta_name . '_caf');

    } elseif ($post_type === 'location') {
        $meta_name = $post_type;
        $options_caf = get_option('post_type_' . $meta_name . 's_caf');

    } elseif ($post_type === 'post') {
        $meta_name = 'the_post';
        $options_caf = array_flip($caf);

    } else {
        $meta_name = substr($post_type, 0, -1);
        $options_caf = get_option('post_type_' . $post_type . '_caf');
    }


    $$meta_name['Providers'] = get_post_meta($post->ID, $meta_name . '_providers', true);
    $providers = get_posts(array(
        'post_type' => 'providers',
        'posts_per_page' => -1
    ));

    $$meta_name['Events'] = get_post_meta($post->ID, $meta_name . '_events', true);
    $events = get_posts(array(
        'post_type' => 'events',
        'posts_per_page' => -1
    ));

    $$meta_name['Treatments'] = get_post_meta($post->ID, $meta_name . '_treatments', true);
    $treatments = get_posts(array(
        'post_type' => 'treatments',
        'posts_per_page' => -1
    ));

    $$meta_name['Concerns'] = get_post_meta($post->ID, $meta_name . '_concerns', true);
    $concerns = get_posts(array(
        'post_type' => 'concerns',
        'posts_per_page' => -1
    ));

    $$meta_name['Locations'] = get_post_meta($post->ID, $meta_name . '_locations', true);
    $locations = get_posts(array(
        'post_type' => 'location',
        'posts_per_page' => -1
    ));

    $$meta_name['Galleries'] = get_post_meta($post->ID, $meta_name . '_galleries', true);
    $galleries = get_posts(array(
        'post_type' => 'ui_gallery',
        'posts_per_page' => -1
    ));

    $$meta_name['Testimonials'] = get_post_meta($post->ID, $meta_name . '_testimonials', true);
    $testimonials = get_posts(array(
        'post_type' => 'testimonials',
        'posts_per_page' => -1
    ));

    $$meta_name['Specialties'] = get_post_meta($post->ID, $meta_name . '_specialties', true);
    $specialties = get_posts(array(
        'post_type' => 'specialties',
        'posts_per_page' => -1
    ));

    $$meta_name['Promotions'] = get_post_meta($post->ID, $meta_name . '_promotions', true);
    $promotions = get_posts(array(
        'post_type' => 'promotions',
        'posts_per_page' => -1
    ));

    $$meta_name['Video Galleries'] = get_post_meta($post->ID, $meta_name . '_videogallery', true);
    $videogalleries = get_posts(array(
        'post_type' => 'videogallery',
        'posts_per_page' => -1
    ));

    // $$meta_name['Promotions'] = get_post_meta($post->ID, $meta_name . '_promotions', true);
    // $promotions = get_posts(array(
    //     'post_type' => 'promotions',
    //     'posts_per_page' => -1
    // ));

    ?>

    <table class="form-table">
        <?php if (post_type_exists('providers') && isset($options_caf['providers'])): ?>
            <?php $obj = get_post_type_object('providers'); ?>
            <tr>
                <th><label for="providers_list"><?php echo $obj->labels->name; ?></label></th>
                <td>
                    <section>
                        <select name="<?php echo $meta_name; ?>_providers[]" id="providers_list" multiple="multiple">
                            <option value="-1">Select All</option>
                            <?php if(is_array($$meta_name['Providers'])){ ?>
                                <?php foreach ($$meta_name['Providers'] as $exist): ?>
                                    <?php foreach ($providers as $key => $child): ?>
                                        <?php if ($child->ID == $exist): ?>
                                            <option value="<?php echo $child->ID ?>"
                                                    selected="selected"><?php echo $child->post_title ?></option>
                                            <?php unset($providers[$key]); ?>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endforeach ?>
                            <?php } ?>

                            <?php foreach ($providers as $child): ?>
                                <option value="<?php echo $child->ID ?>"><?php echo $child->post_title ?></option>
                            <?php endforeach ?>
                        </select>
                    </section>
                    <br/><span class="description">The specific <?php echo $obj->labels->name; ?>
                        for this particular <?php echo $meta_name; ?>.</span>
                </td>
            </tr>
        <?php endif ?>
    </table>

    <table class="form-table">
        <?php if (post_type_exists('events') && isset($options_caf['events'])): ?>
            <?php $obj = get_post_type_object('events'); ?>
            <tr>
                <th><label for="events_list"><?php echo $obj->labels->name; ?></label></th>
                <td>
                    <select name="<?php echo $meta_name; ?>_events[]" id="events_list" multiple="multiple">
                        <option value="-1">Select All</option>
                        <?php if (is_array($$meta_name['Events'])) { ?>
                            <?php foreach ($$meta_name['Events'] as $exist): ?>
                                <?php foreach ($events as $key => $child): ?>
                                    <?php if ($child->ID == $exist): ?>
                                        <option value="<?php echo $child->ID ?>"
                                                selected="selected"><?php echo $child->post_title ?></option>
                                        <?php unset($events[$key]); ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endforeach ?>
                        <?php } ?>

                        <?php foreach ($events as $child): ?>
                            <option value="<?php echo $child->ID ?>"><?php echo $child->post_title ?></option>
                        <?php endforeach ?>
                    </select>
                    <br/><span class="description">The specific <?php echo $obj->labels->name; ?>
                        for this particular <?php echo $meta_name; ?>.</span>
                </td>
            </tr>
        <?php endif ?>
    </table>

    <table class="form-table">
        <?php if (post_type_exists('treatments') && isset($options_caf['treatments'])): ?>
            <?php $obj = get_post_type_object('treatments'); ?>
            <tr>
                <th><label for="treatments_list"><?php echo $obj->labels->name; ?></label></th>
                <td>
                    <select name="<?php echo $meta_name; ?>_treatments[]" id="treatments_list" multiple="multiple">
                        <option value="-1">Select All</option>
                        <?php if (is_array($$meta_name['Treatments'])) { ?>
                            <?php foreach ($$meta_name['Treatments'] as $exist): ?>
                                <?php foreach ($treatments as $key => $child): ?>
                                    <?php if ($child->ID == $exist): ?>
                                        <option value="<?php echo $child->ID ?>"
                                                selected="selected"><?php echo $child->post_title ?></option>
                                        <?php unset($treatments[$key]); ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endforeach ?>
                        <?php } ?>
                        <?php foreach ($treatments as $child): ?>
                            <option value="<?php echo $child->ID ?>"><?php echo $child->post_title ?></option>
                        <?php endforeach ?>
                    </select>
                    <br/><span class="description">The specific <?php echo $obj->labels->name; ?>
                        for this particular <?php echo $meta_name; ?>.</span>
                </td>
            </tr>
        <?php endif ?>
    </table>

    <table class="form-table">
        <?php if (post_type_exists('concerns') && isset($options_caf['concerns'])): ?>
            <?php $obj = get_post_type_object('concerns'); ?>
            <tr>
                <th><label for="concerns_list"><?php echo $obj->labels->name; ?></label></th>
                <td>
                    <select name="<?php echo $meta_name; ?>_concerns[]" id="concerns_list" multiple="multiple">
                        <option value="-1">Select All</option>
                        <?php if (is_array($$meta_name['Concerns'])) { ?>
                            <?php foreach ($$meta_name['Concerns'] as $exist): ?>
                                <?php foreach ($concerns as $key => $child): ?>
                                    <?php if ($child->ID == $exist): ?>
                                        <option value="<?php echo $child->ID ?>"
                                                selected="selected"><?php echo $child->post_title ?></option>
                                        <?php unset($concerns[$key]); ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endforeach ?>
                        <?php } ?>

                        <?php foreach ($concerns as $child): ?>
                            <option value="<?php echo $child->ID ?>"><?php echo $child->post_title ?></option>
                        <?php endforeach ?>
                    </select>
                    <br/><span class="description">The specific <?php echo $obj->labels->name; ?>
                        for this particular <?php echo $meta_name; ?>.</span>
                </td>
            </tr>
        <?php endif ?>
    </table>

    <table class="form-table">
        <?php if (post_type_exists('location') && isset($options_caf['locations'])): ?>
            <?php $obj = get_post_type_object('location'); ?>
            <tr>
                <th><label for="locations_list"><?php echo $obj->labels->name; ?></label></th>
                <td>
                    <select name="<?php echo $meta_name; ?>_locations[]" id="locations_list" multiple="multiple">
                        <option value="-1">Select All</option>
                        <?php if(is_array($$meta_name['Locations'])) { ?>
                            <?php foreach ($$meta_name['Locations'] as $exist): ?>
                                <?php foreach ($locations as $key => $child): ?>
                                    <?php if ($child->ID == $exist): ?>
                                        <option value="<?php echo $child->ID ?>"
                                                selected="selected"><?php echo $child->post_title ?></option>
                                        <?php unset($locations[$key]); ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endforeach ?>
                        <?php } ?>

                        <?php foreach ($locations as $child): ?>
                            <option value="<?php echo $child->ID ?>"><?php echo $child->post_title ?></option>
                        <?php endforeach ?>
                    </select>
                    <br/><span class="description">The specific <?php echo $obj->labels->name; ?>
                        for this particular <?php echo $meta_name; ?>.</span>
                </td>
            </tr>
        <?php endif ?>
    </table>

    <table class="form-table">
        <?php if (post_type_exists('ui_gallery') && isset($options_caf['gallery'])): ?>
            <?php $obj = get_post_type_object('ui_gallery'); ?>
            <tr>
                <th><label for="galleries_list"><?php echo $obj->labels->name; ?></label></th>
                <td>
                    <select name="<?php echo $meta_name; ?>_galleries[]" id="galleries_list" multiple="multiple">
                        <option value="-1">Select All</option>
                        <?php if(is_array($$meta_name['Galleries'])) { ?>
                            <?php foreach ($$meta_name['Galleries'] as $exist): ?>
                                <?php foreach ($galleries as $key => $child): ?>
                                    <?php if ($child->ID == $exist): ?>
                                        <option value="<?php echo $child->ID ?>"
                                                selected="selected"><?php echo $child->post_title ?></option>
                                        <?php unset($galleries[$key]); ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endforeach ?>
                        <?php } ?>

                        <?php foreach ($galleries as $child): ?>
                            <option value="<?php echo $child->ID ?>"><?php echo $child->post_title ?></option>;
                        <?php endforeach ?>
                    </select>
                    <br/><span class="description">The specific <?php echo $obj->labels->name; ?> that are used to treat this particular <?php echo $meta_name; ?>
                        .</span>
                </td>
            </tr>
        <?php endif ?>
    </table>

    <table class="form-table">
        <?php if (post_type_exists('testimonials') && isset($options_caf['testimonials'])): ?>
            <?php $obj = get_post_type_object('testimonials'); ?>
            <tr>
                <th><label for="testimonials_list"><?php echo $obj->labels->name; ?></label></th>
                <td>
                    <select name="<?php echo $meta_name; ?>_testimonials[]" id="testimonials_list" multiple="multiple">
                        <option value="-1">Select All</option>
                        <?php if(is_array($$meta_name['Testimonials'] )) { ?>
                            <?php foreach ($$meta_name['Testimonials'] as $exist): ?>
                                <?php foreach ($testimonials as $key => $child): ?>
                                    <?php if ($child->ID == $exist): ?>
                                        <option value="<?php echo $child->ID ?>"
                                                selected="selected"><?php echo $child->post_title ?></option>
                                        <?php unset($testimonials[$key]); ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endforeach ?>
                        <?php } ?>

                        <?php foreach ($testimonials as $child): ?>
                            <option value="<?php echo $child->ID ?>"><?php echo $child->post_title ?></option>;
                        <?php endforeach ?>
                    </select>
                    <br/><span class="description">The specific <?php echo $obj->labels->name; ?> that are used to treat this particular <?php echo $meta_name; ?>
                        .</span>
                </td>
            </tr>
        <?php endif ?>
    </table>

    <table class="form-table">
        <?php if (post_type_exists('specialties') && isset($options_caf['specialties'])): ?>
            <?php $obj = get_post_type_object('specialties'); ?>
            <tr>
                <th><label for="specialties_list"><?php echo $obj->labels->name; ?></label></th>
                <td>
                    <select name="<?php echo $meta_name; ?>_specialties[]" id="specialties_list" multiple="multiple">
                        <option value="-1">Select All</option>
                        <?php if(is_array($$meta_name['Specialties'])) { ?>
                            <?php foreach ($$meta_name['Specialties'] as $exist): ?>
                                <?php foreach ($specialties as $key => $child): ?>
                                    <?php if ($child->ID == $exist): ?>
                                        <option value="<?php echo $child->ID ?>"
                                                selected="selected"><?php echo $child->post_title ?></option>
                                        <?php unset($specialties[$key]); ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endforeach ?>
                        <?php } ?>

                        <?php foreach ($specialties as $child): ?>
                            <option value="<?php echo $child->ID ?>"><?php echo $child->post_title ?></option>;
                        <?php endforeach ?>
                    </select>
                    <br/><span class="description">The <?php echo $obj->labels->name; ?> that this <?php echo $meta_name; ?> member covers.</span>
                </td>
            </tr>
        <?php endif ?>
    </table>

    <table class="form-table">
        <?php if (post_type_exists('promotions') && isset($options_caf['promotions'])): ?>
            <?php $obj = get_post_type_object('promotions'); ?>
            <tr>
                <th><label for="promotions_list"><?php echo $obj->labels->name; ?></label></th>
                <td>
                    <section>
                        <select name="<?php echo $meta_name; ?>_promotions[]" id="promotions_list" multiple="multiple">
                            <option value="-1">Select All</option>
                            <?php if(is_array($$meta_name['Promotions'])) { ?>
                                <?php foreach ($$meta_name['Promotions'] as $exist): ?>
                                    <?php foreach ($promotions as $key => $child): ?>
                                        <?php if ($child->ID == $exist): ?>
                                            <option value="<?php echo $child->ID ?>"
                                                    selected="selected"><?php echo $child->post_title ?></option>
                                            <?php unset($promotions[$key]); ?>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endforeach ?>
                            <?php } ?>
                            <?php foreach ($promotions as $child): ?>
                                <option value="<?php echo $child->ID ?>"><?php echo $child->post_title ?></option>
                            <?php endforeach ?>
                        </select>
                    </section>
                    <br/><span class="description">The specific <?php echo $obj->labels->name; ?>
                        for this particular <?php echo $meta_name; ?>.</span>
                </td>
            </tr>
        <?php endif ?>
    </table>

    <table class="form-table">
        <?php if (post_type_exists('videogallery') && isset($options_caf['videogallery'])): ?>
            <?php $obj = get_post_type_object('videogallery'); ?>
            <tr>
                <th><label for="videogallery_list"><?php echo $obj->labels->name; ?></label></th>
                <td>
                    <section>
                        <select name="<?php echo $meta_name; ?>_videogallery[]" id="videogallery_list" multiple="multiple">
                            <option value="-1">Select All</option>
                            <?php if(is_array($$meta_name['Video Galleries'])) { ?>
                                <?php foreach ($$meta_name['Video Galleries'] as $exist): ?>
                                    <?php foreach ($videogalleries as $key => $child): ?>
                                        <?php if ($child->ID == $exist): ?>
                                            <option value="<?php echo $child->ID ?>"
                                                    selected="selected"><?php echo $child->post_title ?></option>
                                            <?php unset($videogalleries[$key]); ?>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endforeach ?>
                            <?php } ?>
                            <?php foreach ($videogalleries as $child): ?>
                                <option value="<?php echo $child->ID ?>"><?php echo $child->post_title ?></option>
                            <?php endforeach ?>
                        </select>
                    </section>
                    <br/><span class="description">The specific <?php echo $obj->labels->name; ?>
                        for this particular <?php echo $meta_name; ?>.</span>
                </td>
            </tr>
        <?php endif ?>
    </table>

    <?php
}

/**
 * @param $id integer The id of the post being saved
 * @param $post \WP_Post The WordPress post object of the post being saved
 */
function urge_options_save_child_custom_meta($id, $post)
{
    global $post_type;

    if ($post_type === 'ui_gallery') {
        $meta_name = 'gallery';
        $meta_name_string = 'galleries';
    } elseif ($post_type === 'location') {
        $meta_name = $post_type;
        $meta_name_string = $meta_name . 's';
    } elseif ($post_type === 'post') {
        $meta_name = 'the_post';
        $meta_name_string = 'the_posts';
    } else {
        $meta_name = substr($post_type, 0, -1);
        $meta_name_string = $meta_name . 's';
    }

    if ($post->post_type === $post_type) {
        if (post_type_exists('providers')) {
            if (!empty($_POST[$meta_name . '_providers'])) {
                $post_ids_meta_value = prepareMetaData('providers', $_POST[$meta_name . '_providers']);
                update_post_meta($id, $meta_name . '_providers', $post_ids_meta_value);
                urgeOptionsUpdateLinkedResources($post_ids_meta_value, $id, 'provider_' . $meta_name_string);
            } else {
                delete_post_meta($id, $meta_name . '_providers');
            }
        }

        if (post_type_exists('events')) {
            if (!empty($_POST[$meta_name . '_events'])) {
                $post_ids_meta_value = prepareMetaData('events', $_POST[$meta_name . '_events']);
                update_post_meta($id, $meta_name . '_events', $post_ids_meta_value);
                urgeOptionsUpdateLinkedResources($post_ids_meta_value, $id, 'event_' . $meta_name_string);
            } else {
                delete_post_meta($id, $meta_name . '_events');
            }
        }

        if (post_type_exists('treatments')) {
            if (!empty($_POST[$meta_name . '_treatments'])) {
                $post_ids_meta_value = prepareMetaData('treatments', $_POST[$meta_name . '_treatments']);
                update_post_meta($id, $meta_name . '_treatments', $post_ids_meta_value);
                urgeOptionsUpdateLinkedResources($post_ids_meta_value, $id, 'treatment_' . $meta_name_string);
            } else {
                delete_post_meta($id, $meta_name . '_treatments');
            }
        }

        if (post_type_exists('concerns')) {
            if (!empty($_POST[$meta_name . '_concerns'])) {
                $post_ids_meta_value = prepareMetaData('concerns', $_POST[$meta_name . '_concerns']);
                update_post_meta($id, $meta_name . '_concerns', $post_ids_meta_value);
                urgeOptionsUpdateLinkedResources($post_ids_meta_value, $id, 'concern_' . $meta_name_string);
            } else {
                delete_post_meta($id, $meta_name . '_concerns');
            }
        }

        if (post_type_exists('location')) {
            if (!empty($_POST[$meta_name . '_locations'])) {
                $post_ids_meta_value = prepareMetaData('location', $_POST[$meta_name . '_locations']);
                update_post_meta($id, $meta_name . '_locations', $post_ids_meta_value);
                urgeOptionsUpdateLinkedResources($post_ids_meta_value, $id, 'location_' . $meta_name_string);
            } else {
                delete_post_meta($id, $meta_name . '_locations');
            }
        }

        if (post_type_exists('ui_gallery')) {
            if (!empty($_POST[$meta_name . '_galleries'])) {
                $post_ids_meta_value = prepareMetaData('ui_gallery', $_POST[$meta_name . '_galleries']);
                update_post_meta($id, $meta_name . '_galleries', $post_ids_meta_value);
                urgeOptionsUpdateLinkedResources($post_ids_meta_value, $id, 'gallery_' . $meta_name_string);
            } else {
                delete_post_meta($id, $meta_name . '_galleries');
            }
        }

        if (post_type_exists('testimonials')) {
            if (!empty($_POST[$meta_name . '_testimonials'])) {
                $post_ids_meta_value = prepareMetaData('testimonials', $_POST[$meta_name . '_testimonials']);
                update_post_meta($id, $meta_name . '_testimonials', $post_ids_meta_value);
                urgeOptionsUpdateLinkedResources($post_ids_meta_value, $id, 'testimonial_' . $meta_name_string);
            } else {
                delete_post_meta($id, $meta_name . '_testimonials');
            }
        }

        if (post_type_exists('specialties')) {
            if (!empty($_POST[$meta_name . '_specialties'])) {
                $post_ids_meta_value = prepareMetaData('specialties', $_POST[$meta_name . '_specialties']);
                update_post_meta($id, $meta_name . '_specialties', $post_ids_meta_value);
                urgeOptionsUpdateLinkedResources($post_ids_meta_value, $id, '_specialty_' . $meta_name_string);
            } else {
                delete_post_meta($id, $meta_name . '_specialties');
            }
        }

        if (post_type_exists('promotions')) {
            if (!empty($_POST[$meta_name . '_promotions'])) {
                $post_ids_meta_value = prepareMetaData('promotions', $_POST[$meta_name . '_promotions']);
                update_post_meta($id, $meta_name . '_promotions', $post_ids_meta_value);
                urgeOptionsUpdateLinkedResources($post_ids_meta_value, $id, 'promotion_' . $meta_name_string);
            } else {
                delete_post_meta($id, $meta_name . '_promotions');
            }
        }

        if (post_type_exists('videogallery')) {
            if (!empty($_POST[$meta_name . '_videogallery'])) {
                $post_ids_meta_value = prepareMetaData('videogallery', $_POST[$meta_name . '_videogallery']);
                update_post_meta($id, $meta_name . '_videogallery', $post_ids_meta_value);
                urgeOptionsUpdateLinkedResources($post_ids_meta_value, $id, 'videogallery_' . $meta_name_string);
            } else {
                delete_post_meta($id, $meta_name . '_videogallery');
            }
        }
    }
}
add_action('save_post', 'urge_options_save_child_custom_meta', 10, 2);

/**
 * If there are no $post_ids with Post Type $post_type - create a new post, add it to the collection,
 * and return array of post ids
 *
 * @param $post_type string The Post Type being updated
 * @param $post_ids array An array of post ids
 * @return array
 */
function prepareMetaData($post_type, $post_ids) // &$post_ids
{
    // Get the ids of all of the post_ids with the given Post Type
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => -1,
        'fields' => 'ids'
    );

    // An array of post ids
    $existing_posts = get_posts($args);

    $result = [];
    foreach ($post_ids as $key => $post_id) {
        // Skip over empty and -1 values
        if (!$post_id || (is_numeric($post_id) && (int) $post_id <= 0)) {
            continue;
        }

        if (!in_array($post_id, $existing_posts)) {
            $post_id = createNewPost($post_id, $post_type);
        }
        $result[] = $post_id;
    }
    return $result;
}

/**
 * @param $title
 * @param $post_type
 *
 * @return int|\WP_Error
 */
function createNewPost($title, $post_type)
{
    $id = wp_insert_post(array(
        'post_title' => $title,
        'post_type' => $post_type,
        'post_content' => $title,
        'post_status' => 'publish'
    ));

    return $id;
}

/**
 * @param $linkedIds array An array of post ids
 * @param $currentId integer The current post
 * @param $meta_key string The meta key being updated, for example 'provider_treatments' or 'treatment_providers'
 */
function urgeOptionsUpdateLinkedResources($linkedIds, $currentId, $meta_key)
{
    foreach ($linkedIds as $post_id) {
        if (!is_numeric($post_id) && !empty($post_id)) {
            // $post_id = createNewConcern($post_id,$currentId);
            return;
        }
        $meta = get_post_meta($post_id, $meta_key, true);
    if (empty($meta) || !in_array($currentId, $meta)) {
        if (!is_array($meta)) {
        $meta = [$currentId];
        }else{
            $meta[] = $currentId;
        }
        update_post_meta($post_id, $meta_key, array_values($meta));
    }
    }
}

function urgeOptionsDisplayFeatureStatus(){

    $options_maintenance_mode = get_option('maintenance_mode');

    $options_concerns = get_option('post_type_concerns');
    $options_events = get_option('post_type_events');
    $options_gallery = get_option('post_type_gallery');
    $options_locations = get_option('post_type_locations');
    $options_promotions = get_option('post_type_promotions');
    $options_providers = get_option('post_type_providers');
    $options_testimonials = get_option('post_type_testimonials');
    $options_treatments = get_option('post_type_treatments');
    $options_requests = get_option('post_type_requests');

    $options_videogallery = get_option('post_type_videogallery');

    $options_downloads = get_option('post_type_downloads');

    $options_accordions = get_option('ui_accordions');
    $options_schedule_cta = get_option('ui_schedule_cta');
    $options_modal_iframe = get_option('ui_modal_iframe');
    $options_downloads_shortcode = get_option('ui_downloads_shortcode');

    $featureStatus1 = [
        'Concerns' => $options_concerns,
        'Events' => $options_events,
        'Gallery' => $options_gallery,
        'Locations' => $options_locations,
        'Promotions' => $options_promotions,
        'Providers' => $options_providers,
        'Testimonials' => $options_testimonials,
        'Treatments' => $options_treatments,
        'Requests' => $options_requests,
        'Video Gallery' => $options_videogallery,
        //'Downloads' => $options_downloads,
    ];

    $featureStatus2 = [
        'Accordions' => $options_accordions,
        'Schedule CTA' => $options_schedule_cta,
        'Modal iframe' => $options_modal_iframe,
        //'Downloads shortcode' => $options_downloads_shortcode,
    ];

?>
    <div class="alert alert-warning">
      <strong>Attention: This area is for use by Urge Interactive employees and authorized parties.</strong>
    </div>
    <div class="card-columns">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Plugin Notes</h4>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Ensure the Date setting is <code>F j, Y</code>.</li>
          <li class="list-group-item">Ensure the Time setting is <code>g:i A </code>.</li>
          <li class="list-group-item">Ensure the Timezone setting matches the client's.</li>
          <li class="list-group-item">Ensure the Permalink Settings is set to <code>Post name</code></li>
          <li class="list-group-item">When activating Post Types, remember to "Reset Premalinks".</li>
          <li class="list-group-item">For display control on a per post type level, a <br> <code>single-post_type_slug.php</code> can be added to the customized <code>ui_theme</code>.</li>
        </ul>
      </div>
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Post Types</h4>
          </div>
          <ul class="list-group list-group-flush">
            <?php foreach ($featureStatus1 as $key => $value) :?>
                <li class="list-group-item <?php echo $value ? 'list-group-item-success' : 'list-group-item-light' ?>">
                    <div class="status-title"> <?php echo $key; ?> </div>
                    <div class="status-value"><?php echo $value ? 'Enabled' : 'Disabled' ?></div>
                    <div class="<?php echo $value ? 'green' : 'grey' ?>"></div>
                </li>
            <?php endforeach;?>
          </ul>
        </div>

        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Shortcodes</h4>
          </div>
          <ul class="list-group list-group-flush">
            <?php foreach ($featureStatus2 as $key => $value) :?>
                <li class="list-group-item <?php echo $value ? 'list-group-item-success' : 'list-group-item-light' ?>">
                    <div class="status-title"> <?php echo $key; ?> </div>
                    <div class="status-value"><?php echo $value ? 'Enabled' : 'Disabled' ?></div>
                    <div class="<?php echo $value ? 'green' : 'grey' ?>"></div>
                </li>
            <?php endforeach;?>
          </ul>
        </div>

    </div>

<?php

}

function urge_options_add_post_meta_box_ca() {
    add_meta_box( 'provider_meta_box_ca',
        'Content Association',
        'urge_options_display_child_meta_box_ca', // Use urge_options_display_child_meta_box_ca() from parent plugin
        'post',
        'normal',
        'high'
    );
}

$options_posts_caf = get_option('posts_caf');
if ($options_posts_caf){
    add_action( 'add_meta_boxes', 'urge_options_add_post_meta_box_ca' );
}
