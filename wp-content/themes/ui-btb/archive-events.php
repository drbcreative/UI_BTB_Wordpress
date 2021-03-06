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
      <main class="col-md-12">
        <div class="row justify-content-center">
          <?php
            $events = array(
              'post_type' => 'events',
              'posts_per_page' => -1,
              'order' => 'DESC',
              // 'orderby' => 'title'
            );
            $loop = new WP_Query( $events  );
            if($loop->have_posts()){
              while ( $loop->have_posts() ):
                $loop->the_post();
                get_template_part( 'template-parts/content/excerpt');
              endwhile;
              wp_reset_postdata();
            }
            else {
              get_template_part( 'template-parts/content/no-content' );
            }
          ?>
        </div>

        <?php $post_count = wp_count_posts('events')->publish;
        if ($post_count > 12 ) : ?>
        <div class="col-md-12 text-center bluebg">
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
        <?php endif; ?>
      </main>
    </div>
  </div>
</div>

<?php get_footer()?>
