<?php
  global $query_string;
  $query_args = explode("&", $query_string);
  $search_query = array();
  foreach($query_args as $key => $string) {
    $query_split = explode("=", $string);
    $search_query[$query_split[0]] = urldecode($query_split[1]);
  }

  $search = new WP_Query($search_query);
?>
<?php get_header()?>

<?php get_template_part('template-parts/banner/placeholder') ?>
<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb("<div class=\"breadcrumbs\"><div class=\"crumbscontainer\">","</div></div>" ); } ?>

<section class="main-title">
  <div class="row-r containerish">
    <div class="col-md-12r">
  <h1>Search Results for "<?php echo esc_html( get_search_query( false ) ); ?>"</h1>
</div>
</div>
</section>

<div class="interior-bg pagesection fade-up-stop">
  <div class="container">
    <div class="row">
        <!-- <section class="entry-content"> -->
          <?php
            if (have_posts()) {
              while (have_posts()) {
                the_post();

                get_template_part( 'template-parts/content/excerpt');

              }
            } else {
              get_template_part( 'template-parts/content/no-results' );
            }
          ?>
        <!-- </section> -->
    </div>
    <div class="row">
      <!-- Start Col -->
      <div class="col-md-12 text-center">
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
      <!-- End Col -->
      <div class="col-sm-12">
        <hr />
        <!-- <p>* Individual results may vary; not a guarantee.</p> -->
        <?php get_template_part( 'widgets/share' ); ?>
        <?php get_template_part( 'widgets/edit' ); ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer()?>
