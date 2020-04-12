jQuery(document).ready(function($){	
		// $(".datepicker").datepicker();

		$("#date-time-box").DateTimePicker({
			'dateTimeFormat': "MM-dd-yyyy hh:mm AA",
			'dateFormat': "MM-dd-yyyy",
			'timeFormat': "hh:mm AA"
		});
		
});