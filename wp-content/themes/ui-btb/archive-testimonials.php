<?php get_header()?>
<?php get_template_part('template-parts/banner/placeholder') ?>
<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb("<div class=\"breadcrumbs\"><div class=\"crumbscontainer\">","</div></div>" ); } ?>
<section class="main-title fade-up-stop">
  <div class="row-r containerish">
    <div class="col-md-12r">
  <?php if ( is_post_type_archive() ) { ?>
    <h1>
      <?php post_type_archive_title(); ?>
    </h1>
  <?php } else { ?>
    <h1>
      <?php single_cat_title();?>
    </h1>
  <?php } ?>
</div>
</div>
</section>
 
<div class="interior-bg pagesection fade-up-stop">
 <div class="container">
    <div class="row">
          <?php
            if (have_posts()) {
              while (have_posts()) {
                the_post();

                get_template_part( 'template-parts/content/excerpt-testimonial');

              }
            } else {
              get_template_part( 'template-parts/content/no-content' );
            }
          ?>
    </div>

    <div class="row single">
      <div class="col-sm-12 text-center">
        <nav class="pagination">
          <?php
          global $wp_query;
          $big = 999999999;
          echo paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages
          ) );
          ?>
        </nav>
      </div>
    </div>
  </div>
</div>

<?php get_footer()?>
