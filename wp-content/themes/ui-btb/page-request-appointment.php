
<?php
// Template Name: Request an Appointment
get_header()?>
<?php get_template_part('template-parts/banner/full-width') ?>
<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb("<div class=\"breadcrumbs\"><div class=\"crumbscontainer\">","</div></div>" ); } ?>
<section class="main-title fade-up-stop">
  <div class="row-r containerish">
    <div class="col-md-12r">
      <h1><?php the_title(); ?></h1>
      <p><?php echo get_the_excerpt(); ?></p>
    </div>
  </div>
</section>
<div class="interior-bg pagesection page-form fade-up-stop">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <section class="entry-content">
          <div class="txtcn">
            <?php the_content(); ?>
          </div>
          <?php get_template_part( 'forms/schedule' ); ?>
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
