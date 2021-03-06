<?php get_header()?>
<?php get_template_part('template-parts/banner/placeholder') ?>
<?php //get_template_part('widgets/breadcrumbs') ?>
<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb("<div class=\"breadcrumbs\"><div class=\"crumbscontainer\">","</div></div>" ); } ?>
<section class="main-title fade-up-stop">
  <div class="row-r containerish">
    <div class="col-md-12r">
      <h1 class="my-5">404 :(</h1>
    </div>
  </div>
</section>
<div class="interior-bg pagesection fade-up-stop">
  <div class="container">
    <div class="row no-gutters">
      <main class="col-md-12 mx-auto text-center">
        <section class="entry-content">
          <h2>Page Not Found</h2>
          <p class="lead color-dark">We're sorry, but the page you're looking for cannot be found on <?php bloginfo('title') ?>.<br>Please return to our <a href="<?php echo get_option('home'); ?>">homepage</a>.</p>
        </section>
      </main>
    </div>
  </div>
</div>




<style>
strong.oversize{font-size: 6rem; opacity: .2}
</style>
<?php get_footer()?>
