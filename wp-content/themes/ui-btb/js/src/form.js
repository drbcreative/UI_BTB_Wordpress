jQuery(document).ready(function ($) {
  $('#schedule').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var form_results = $('#form-results');

    form_results.html(' ');
    form_results.removeClass('alert');
    form_results.removeClass('alert-error');
    form_results.removeClass('alert-success');

    form.find('.ui-btn').prop('disabled', true);


    var errors = [];

    // Validation
    if (form.find('input[name=name]').val() == "") {
      errors.push('The name field is required');
    }
    if (form.find('input[name=email]').val() == "") {
      errors.push('The email field is required');
    }
    // if (!form.find('select[name="preferred_day"]').val()) {
    //   errors.push('The day of the week field is required');
    // }
    // if (!form.find('select[name="preferred_time"]').val()) {
    //   errors.push('The time of day field is required');
    // }

    if (errors.length > 0) {

      var error_html = '<ul>';
      form_results.addClass('alert');
      form_results.addClass('alert-info');


      $.each(errors, function (index, value) {
        error_html += '<li>' + value + '</li>';
      });
      error_html += '</ul>';

      form_results.html(error_html);
      form.find('.ui-btn').prop('disabled', false);
      return false;
    }

    var data = {
      action: 'do_ajax',
      fn: 'schedule',
      data: form.serializeArray()
    };

    jQuery.post(the_theme.url + '/wp-admin/admin-ajax.php', data, function (response) {


      form.find('.ui-btn').prop('disabled', false);
      $('#form-results').html(response);
      if ($(response).text() == 'Your message was sent successfully!') {
        window.location.href = '/thank-you';
      }
    }, 'json');
  });

  $('#contact').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var form_results = $('#form-results');

    form_results.html(' ');
    form_results.removeClass('alert');
    form_results.removeClass('alert-error');
    form_results.removeClass('alert-success');

    form.find('.ui-btn').prop('disabled', true);

    var errors = [];

    // Validation
    if (form.find('input[name=name]').val() == "") { errors.push('The name field is required'); }
    if (form.find('input[name=email]').val() == "") { errors.push('The email field is required'); }

    if (errors.length > 0) {

      var error_html = '<ul>';
      form_results.addClass('alert');
      form_results.addClass('alert-info');

      $.each(errors, function (index, value) {
        error_html += '<li>' + value + '</li>';
      });
      error_html += '</ul>';

      form_results.html(error_html);
      form.find('.ui-btn').prop('disabled', false);
      return false;
    }

    var data = {
      action: 'do_ajax',
      fn: 'contact',
      data: form.serializeArray()
    };

    jQuery.post(the_theme.url + '/wp-admin/admin-ajax.php', data, function (response) {

      console.log(response);
      form.find('.ui-btn').prop('disabled', false);
      $('#form-results').html(response);
      if ($(response).text() == 'Your message was sent successfully!') {
        window.location.href = '/thank-you';
      }
    }, 'json');
  });
});