<?php 
   $data_option = get_option('site_data_text');
    $site_phonenumber = get_option('site_phonenumber');
    
    ?>

 
    <div class="container" id="site-content-container">
<!--       <section class="additional-forms">
        <div class="add-form"><span class="btn formadd">CLICK HERE TO ADD FORM</span></div>
        <div class="form-additions-added-here"></div>
      </section> -->

  <div class="panel-buttons-cl d-flex flex-row bd-highlight mb-3">
            <div class="panel-heading p-2 bd-highlight">
              <h4 class="panel-title">
                <a data-toggle="collapse" class="btn btn-primary" type="button" data-parent="#accordion" href="#collapse1">
                Edit Location - 1</a>
              </h4>
            </div>
            <div class="panel-heading p-2 bd-highlight">
              <h4 class="panel-title">
                <a data-toggle="collapse" class="btn btn-primary" type="button" data-parent="#accordion" href="#collapse2">
                Edit Location - 2</a>
              </h4>
            </div>
            <div class="panel-heading p-2 bd-highlight">
              <h4 class="panel-title">
                <a data-toggle="collapse" class="btn btn-primary" type="button" data-parent="#accordion" href="#collapse3">
                Edit Location - 3</a>
              </h4>
            </div>
  </div>
      <div class="formcontent">
        <div class="panel-group" id="accordion">
          <div class="panel panel-default">

            <div id="collapse1" class="panel-collapse collapse in">
              <div class="panel-body">
                <?php $formLocation = 0; ?>
                <?php require('html5-site-form.php'); ?>
              </div>
            </div>
          </div>
          <div class="panel panel-default">

            <div id="collapse2" class="panel-collapse collapse">
              <div class="panel-body">
                <?php $formLocation = 1; ?>
                <?php require('html5-site-form.php'); ?>
              </div>
            </div>
          </div>
          <div class="panel panel-default">

            <div id="collapse3" class="panel-collapse collapse">
              <div class="panel-body">
                <?php $formLocation = 2; ?>
                <?php require('html5-site-form.php'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
    jQuery(document).ready( function() {

      var currentFormNum = 0;
      jQuery("span.btn.formadd").click(function(){
        jQuery.get("<?php echo plugin_dir_url( __FILE__ ); ?>/html5-site-form.php", { name: currentFormNum, time: "2pm" }, function(data){

            jQuery(".form-additions-added-here").append(data);

            // jQuery(data).filter('.formpanel').attr("data-e","-sadasd");
            currentFormNum++;
            
            // jQuery(data).filter('.formpanel');
            console.log(data);
            // jQuery('.formdata[data-currenatr="0"]').append("talent");
        });
      });


       jQuery("#textclick").click( function(e) {
          e.preventDefault(); 
          // post_id = jQuery(this).attr("data-post_id");

          jQuery.ajax({
             type: "POST",
             url: "/wp-admin/admin-ajax.php",
             data : {
                action: "call_form",
             },
             success: function(response) {
                console.log(response);
             }
          });
       });
    });
    </script>

