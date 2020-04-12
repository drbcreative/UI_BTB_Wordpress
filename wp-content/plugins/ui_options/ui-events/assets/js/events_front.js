jQuery(document).ready(function($){

	// $('#openEventRsvpForm').click(function(){
     //    $("#EventRsvpForm" ).slideToggle( "slow", function() {
     //        // Animation complete.
     //    });
	// });
    $('#EventRsvpForm').on('submit', function(e) {
        e.preventDefault();

        var $form = $(this);

        $.post($form.attr('action'), $form.serialize(), function(data) {
            if(typeof data.success != 'undefined'){
                $(".event-rsvp-notify-form .success-message").show();
                $( ".event-rsvp-notify-form .success-message").fadeOut(5000);

                document.getElementById("EventRsvpForm").reset();
                console.log(data);

            } else {
                $(".event-rsvp-notify-form .error-message").show();
                $(".event-rsvp-notify-form .error-message").fadeOut(5000);
                console.log(data);
            }
        }, 'json');
    });
});