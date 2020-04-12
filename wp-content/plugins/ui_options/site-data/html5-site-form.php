      <div class="panel panel-primary formpanel  p-md-3" data-currenatr="<?php echo $_GET['name'] ?>">
        <div class="form-group">
        <div class="panel-body">
          <div class="panel-heading">
            <h2 class="panel-title mb-3">Site Content <?php echo $formLocation; ?></h2>
          </div>
          <div class="texfp">

            <div class="row">
              <div class="col-md-6">
                  <div class="site-p">
                  <label for="textInput">Phone Number</label>
                  <input type="text" name="site_phonenumber" id="textInput-<?php echo $_GET['name'] ?>" placeholder=" ">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="site-p">
                  <label for="textInput">Fax Number</label>
                  <input type="text" name="site_phonenumber" id="textInput-<?php echo $_GET['name'] ?>" placeholder=" ">
                  </div>
              </div>
            </div>

          </div>

          <div class="panel-heading">
            <h2 class="panel-title mb-3 mt-4" id="textclick-<?php echo $_GET['name'] ?>">Add your Address</h2>
          </div>
          <div id="address-<?php echo $_GET['name'] ?>">
            <div class="row">
              <div class="col-md-6">
                <label class="control-label">Street address</label>
                <input class="form-control" id="street_number-<?php echo $_GET['name'] ?>">
              </div>
              <div class="col-md-6">
                <label class="control-label">Route</label>
                <input class="form-control" id="route-<?php echo $_GET['name'] ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="control-label">City</label>
                <input class="form-control field" id="locality-<?php echo $_GET['name'] ?>">
              </div>
              <div class="col-md-6"> 
                <label class="control-label">State</label>
                <input class="form-control" id="administrative_area_level_1-<?php echo $_GET['name'] ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="control-label">Zip code</label>
                <input class="form-control" id="postal_code-<?php echo $_GET['name'] ?>">
              </div>
              <div class="col-md-6">
                <label class="control-label">Country</label>
                <input class="form-control" id="country-<?php echo $_GET['name'] ?>">
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
