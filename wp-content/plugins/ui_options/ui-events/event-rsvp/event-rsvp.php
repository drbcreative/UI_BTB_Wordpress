<?php
/*
Plugin Name: Event RSVP
Description: Send data for submitted form to configured email.
Version: 2.0
Author: Urge Interactive
*/


function rsvp_form_submit() {
    if(isset($_POST['form_data'])){
        parse_str($_POST['form_data'], $data);


        if(empty($data['eventRadio'])){
            echo 'Please chose your Event';
            exit;
        }

        if(empty($data['EventRsvpInputName'])){
            echo 'Please enter your First Name';
            exit;
        }

        if(empty($data['EventRsvpInputLastName'])){
            echo 'Please enter your Last Name';
            exit;
        }

        if(empty($data['EventRsvpInputEmail'])){
            echo 'Please enter your Email';
            exit;
        }

        $eventNotify 	= get_post_meta($data['eventRadio'], 'event_email_to', true);

        //send email
        $to='luis@urgeinteractive.com,';

        if(!empty($eventNotify)){
            $to = $eventNotify.',';
        }

        $to .= $data['EventRsvpInputEmail'];







    $text = 'Name: '.$data['EventRsvpInputName']. ', Email: '.$data['EventRsvpInputEmail'];
    $text .= ', Event: '.$data['eventRadio'];

    $text.= !empty($data['EventRsvpInputGuests'])?', Additional Guests: '.$data['EventRsvpInputGuests']:'';



    $html = '<div style="width: 600px; margin: 0 auto;">';
    $html .= '<div style="text-align: center; padding: 15px; margin-bottom: 1em; background: #fff;">';
    $html .= '<a href="'.get_bloginfo('url').'" title="'.get_bloginfo('title').'"><img style="margin:0 auto;" src="'.get_bloginfo('url').'/wp-content/themes/ui_xx/img/logo@2x.png" width="100%" height="auto" alt="'.get_bloginfo('name').'" title="'.get_bloginfo('name').'" /></a>';
    $html .= '</div>';
    $html .= '<table style="border: 1px solid #2b2b2b; border-collapse: collapse; width: 100%;">';

    $html .= '<tr style="border: 1px solid #2b2b2b;"><td style="width: 30%; padding: 10px; border: 1px solid #2b2b2b;">'.' First Name'.'</td><td style="width: 70%; padding: 10px; border: 1px solid #2b2b2b;">'.$data['EventRsvpInputName'].'</td></tr>';
    $html .= '<tr style="border: 1px solid #2b2b2b;"><td style="width: 30%; padding: 10px; border: 1px solid #2b2b2b;">'.' Last Name'.'</td><td style="width: 70%; padding: 10px; border: 1px solid #2b2b2b;">'.$data['EventRsvpInputLastName'].'</td></tr>';
    $html .= '<tr style="border: 1px solid #2b2b2b;"><td style="width: 30%; padding: 10px; border: 1px solid #2b2b2b;">'.'Email'.'</td><td style="width: 70%; padding: 10px; border: 1px solid #2b2b2b;">'.$data['EventRsvpInputEmail'].'</td></tr>';
    $html .= '<tr style="border: 1px solid #2b2b2b;"><td style="width: 30%; padding: 10px; border: 1px solid #2b2b2b;">'.'Phone'.'</td><td style="width: 70%; padding: 10px; border: 1px solid #2b2b2b;">'.$data['EventRsvpInputPhone'].'</td></tr>';   
    $html .= '<tr style="border: 1px solid #2b2b2b;"><td style="width: 30%; padding: 10px; border: 1px solid #2b2b2b;">'.'New or Existing Patient?'.'</td><td style="width: 70%; padding: 10px; border: 1px solid #2b2b2b;">'.$data['newPatient'].'</td></tr>';  
    $html .= '<tr style="border: 1px solid #2b2b2b;"><td style="width: 30%; padding: 10px; border: 1px solid #2b2b2b;">'.'Additional Guests'.'</td><td style="width: 70%; padding: 10px; border: 1px solid #2b2b2b;">'.$data['EventRsvpInputGuests'].'</td></tr>';
    $html .= '</table>';
    $html .= '</div>';

    $email_message = $html;
    $event = get_the_title( $data['eventRadio'] );

    add_filter( 'wp_mail_content_type', 'set_html_content_type' );

    $subject = 'New RSVP: '.$event;
    $headers = array('Content-Type: text/html; charset=UTF-8');
    // $headers[] = 'Bcc: '.get_bloginfo('name').' <tracking@urgeinteractive.com>' . "\r\n";

    wp_mail($to, $subject, $email_message, $headers );





        echo 'Your message has been sent successfully';
        exit;
    }

    echo 'Failed to send Your message!';
    exit;

}
add_action( 'wp_ajax_rsvp_form_submit', 'rsvp_form_submit' );
add_action( 'wp_ajax_nopriv_rsvp_form_submit', 'rsvp_form_submit' );

//Front Ajax
function event_rsvp_custom_footer_scripts() { ?>
	<script type="text/javascript">
        //add js document load event, couse WP loads jquery later this script
        document.addEventListener("DOMContentLoaded", function(event) {

            jQuery(document).ready(function ($) {
                $('#EventRsvpFormRadio').on('submit', function (e) {
                    var form = $(this);

                    var data = {
                        'action': 'rsvp_form_submit',
                        'form_data': $(this).serialize()
                    };

                    var form_id = $(this).attr('id');

                    form.find('.btn').prepend('<i class="fa fa-spinner fa-spin"></i> ').attr('disabled', 'disabled');
                    form.find('.alert').remove();

                    $.ajax({
                        type: "POST",
                        url: '<?php echo admin_url('admin-ajax.php') ?>',
                        data: data,
                        success: function (response) {
                            if (response == 'Your message has been sent successfully') {
                                //form.find("input[type=text],input[type=email],textarea").val("")
                                //reset form
                                document.getElementById(form_id).reset();

                                form.append('<p class="alert alert-success">' + response + '</p>')
                            } else {
                                form.append('<p class="alert bg-danger">' + response + '</p>')
                            }
                            form.find('.fa-spinner').remove()
                            form.find('.btn').removeAttr('disabled')
                        }
                    });
                    return false;
                })
            });
        });
	</script>
<?php }
add_action( 'wp_footer', 'event_rsvp_custom_footer_scripts' );




