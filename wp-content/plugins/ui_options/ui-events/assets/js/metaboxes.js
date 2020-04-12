jQuery(document).ready(function($){	
		// $(".datepicker").datepicker();

		$("#date-time-box").DateTimePicker({
			'dateTimeFormat': "MM-dd-yyyy hh:mm AA",
			'dateFormat': "MM-dd-yyyy",
			'timeFormat': "hh:mm AA"
		});


	//Select all/none
    $('#rsvp-table #rsvp_id_all').click(function (){

    	$('#rsvp-table input:checkbox').not(this).prop('checked', this.checked);

	});


    //Send ajax to delete selected post meta id
    $('#rsvp-table-submit').on('click', function(e) {
    	var multi_option = $("#rsvp-table #multi-option").val();
        if(multi_option == '0'){
            $("#rsvp-table .field_required_msg").show();
            $( "#rsvp-table .field_required_msg").fadeOut(5000);

		}

        var searchIDs = $("#rsvp-table .rsvp_checkbox:checkbox:checked").map(function(){
        	var id = $(this).val();
            $("#rsvp-table #rsvp_id"+id).remove();

            return id;
        }).get();


    	var data = {
            'action': 'rsvp_delete',
            'rsvp_id': searchIDs
        };

        if(multi_option == 'delete'){
            jQuery.post(ajaxurl, data, function(response) {
                console.log(response);
            });
        }

    });
});