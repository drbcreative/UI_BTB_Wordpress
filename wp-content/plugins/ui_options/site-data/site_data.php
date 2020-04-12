<?php 
    // UPDATE OPTIONS ON POST
    if (isset($_POST['submit']) && $_POST['option_page'] === 'ui_site_data_option') {
        $new_value = $_POST['site_data_text'];
        $new_value = $_POST['site_phonenumber'];
        update_option('site_data_text', $new_value);
        update_option('site_phonenumber', $new_value);
    }
 ?>