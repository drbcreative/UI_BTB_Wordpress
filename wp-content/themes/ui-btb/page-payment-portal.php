<?php 
// Template Name: Contact Us
get_header()?>
<?php get_template_part('template-parts/banner/full-width') ?>
<?php 
// get_template_part('widgets/breadcrumbs');  ?>
<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb("<div class=\"breadcrumbs\"><div class=\"crumbscontainer\">","</div></div>" ); } ?>
<section class="main-title fade-up-stop">
  <div class="row-r containerish">
    <div class="col-md-12r">
      <h1><?php the_title(); ?></h1>
      <p><?php echo get_the_excerpt(); ?></p>
    </div>
  </div>
</section>
<div class="interior-bg pagesection fade-up-stop">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <section class="entry-content">
          <form method="post" action="https://www.payjunction.com/trinity/quickshop/add_to_cart_snap.action"><input type="hidden" name="store" value="MARLOWEONLINE"/><input type="hidden" name="need_to_ship" value="no"/><input type="hidden" name="need_to_tax" value="no"/><input type="hidden" name="identifier" value="Online Payment"/><input type="hidden" name="description" value="Payment for services"/><input type="hidden" name="quantity" value="1"/> <label>Patient Name</label> 
          <input type="text" name="notes"/><br/> <label>Payment Amount</label> 
          <input type="text" name="price"/><br/><input type="submit" name="submit" value="Make Payment"/></form> 
        </section>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <hr />
        <?php get_template_part( 'widgets/share' ); ?>
        <?php get_template_part( 'widgets/edit' ); ?>
      </div>
    </div>
  </div>
</div>




<?php get_footer()?>
