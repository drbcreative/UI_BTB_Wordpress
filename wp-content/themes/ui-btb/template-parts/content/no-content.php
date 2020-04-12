<div class="text-center" style="width: 100%;">
    <?php if ( is_post_type_archive() ) { ?>
      <h2>No <?php post_type_archive_title(); ?> at this time</h2>
      <p class="lead">Please call <a href="tel:254-399-6545" class="">(254) 399-6545</a> to find out more.</p>
      <div class="row">
        <div class="col-md-6 mr-auto ml-auto">

          <?php get_template_part('forms/subscribe') ?>

        </div>
      </div>
    <?php } elseif (is_category()) { ?>
      <h2>No <?php single_cat_title();?> Posts Found</h2>
    <?php } else { ?>
      <h2>No Articles at this time</h2>
    <p class="lead">Please call <a href="tel:254-399-6545" class="">(254) 399-6545</a> to find out more.</p>
      <div class="row">
        <div class="col-md-6 mr-auto ml-auto">

          <?php get_template_part('forms/subscribe') ?>

        </div>
    </div>
    <?php } ?>
</div>
