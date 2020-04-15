<?php get_header()?>
<?php get_template_part('data/schema/treatment-schema') ?>

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


<div class="interior-bg pagesection fade-up-stop">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <section class="entry-content">
          <?php
          $treatment     = $client->treatment(get_the_ID());
          $conditions    = $treatment->conditions();
          $locations     = $treatment->locations();
          $providers     = $treatment->providers();
          $videogallery  = $treatment->videogallery();

            if (have_posts()) {
              while (have_posts()) {
                the_post();
                get_template_part( 'template-parts/content/content' );
              }
            } else {
              get_template_part( 'template-parts/content/no-content' );
            }
          ?>
        </section>
      </div>
    </div>
  </div>
</div>
<div class="block-relation">
  <div class="container">
    <div class="row">
      <?php if ( !empty( $providers ) ) : ?>
      <div class="col-sm-12">
        <hr>
        <h4>Providers specializing in <?php echo $treatment->name ?></h4>
        <ul>
          <?php foreach ( $providers as $provider ) : ?>
          <li>
            <a href="<?php echo $provider->permalink; ?>" class="ui-btn-main"><?php echo $provider->name ?></a>
          </li>
          <?php endforeach ?>
        </ul>
      </div>
      <?php endif ?>

      <?php if ( !empty( $conditions ) ) : ?>
      <div class="col-sm-12">
        <hr>
        <h4>Concerns treated by <?php echo $treatment->name ?>*</h4>
        <ul class="related-treatments">
          <?php foreach ( $conditions as $condition ) : ?>
          <li>
            <a href="<?php echo $condition->permalink; ?>" class="ui-btn-main"><?php echo $condition->name ?></a>
          </li>
          <?php endforeach ?>
        </ul>
      </div>
      <?php endif ?>

      <?php if ( !empty( $locations ) ) : ?>
      <div class="col-sm-12">
        <hr>
        <h4><?php echo $treatment->name ?> is available at these Locations</h4>
        <ul>
          <?php foreach ( $locations as $location ) : ?>
          <li>
            <a href="<?php echo $location->permalink; ?>" class="ui-btn-main"><?php echo $location->name ?></a>
          </li>
          <?php endforeach ?>
        </ul>
      </div>
      <?php endif ?>

      <?php if ( !empty( $videogallery ) ) : ?>
      <div class="col-sm-12">
        <hr>
        <h4> Related Informational Videos</h4>
        <ul class="related-treatments">
          <?php foreach ( $videogallery as $videogallery ) : ?>
            <?php
              $post_thumbnail_id = get_post_thumbnail_id($videogallery->post_id);
              $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
              if(!$post_thumbnail_url){
                $post_thumbnail_url = IMG . "/placeholder5.jpg";
              }
              ?>
          <li>
            <div class="galler-tmb">
              <a href="<?php echo $videogallery->permalink; ?>" style="background-image: url(<?php echo($post_thumbnail_url); ?>);" class="btn-gallerylink">
                <span class="linktitle">
                  <?php echo $videogallery->name ?>
                </span>
              </a>
            </div>
          </li>
          <?php endforeach ?>
        </ul>
      </div>
      <?php endif ?>

      <?php if(is_single(array(17, 18, 19, 20)) ): ?>

        <div class="col-sm-12">
          <hr />
          <sup>* Individual results may vary; not a guarantee.</sup>
          <?php get_template_part( 'widgets/share' ); ?>
          <?php get_template_part( 'widgets/edit' ); ?>
        </div>

      <?php endif; ?>


    </div>
  </div>
</div>

<?php get_footer()?>
