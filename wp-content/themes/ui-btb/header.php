<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <title>
    <?php wp_title(); ?>
</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="author" content="<?php wp_title(); ?>">
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <link rel="shortcut icon" type="image/ico" href="<?php echo IMG ?>/favicon.ico">
  <!-- WPHEAD -->
  <?php wp_head(); ?>
  <!-- WPHEAD -->


<?php $client = new Urge\Urge(); ?>
<?php //get_template_part( 'data/analytics' ) ?>
<?php //get_template_part( 'data/schema/schema' ) ?>
<?php //get_template_part( 'data/tag-manager' ) ?>
<?php //get_template_part( 'data/fb-pixel' ) ?>

</head>

<body <?php body_class(); ?> id="top" itemscope itemtype="http://schema.org/WebPage">


<!-- HEADER -->
<header id="header-container">
  <section class="top-bar">
    <div class="containerish-fluid">
      <a href="<?php bloginfo('url')?>/events" class="topbar-link">EVENTS</a>
      <a href="<?php bloginfo('url')?>/promotions" class="topbar-link">PROMOTIONS</a>
      <a href="<?php bloginfo('url')?>/contact/" class="topbar-link">CONTACT</a>
      <a href="tel:765-683-3180" class="topbar-link">(765) 683-3180</a>
      <div class="social-links">
        <a href="#" class="social-link"><svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" class="svg-inline--fa fa-instagram fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path fill="currentColor"
              d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
            </path>
          </svg></a>
        <a href="#" class="social-link"><svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" class="svg-inline--fa fa-facebook-f fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
            <path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
          </svg></a>
      </div>
    </div>
  </section>
  <section class="nav-container">
    <div class="logonav">
      <a href="<?php bloginfo('url') ?>" class="nav-logo">
        <img src="<?php echo IMG ?>/hero-logo@2x.png" alt="" class="logomain">
      </a>
    </div>
    <nav class="navdiv">
      <span class="closebutton">
        <div class="bars">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </div>
      </span>
      <div class="navbaritems">
        <ul class="items">
          <li class="menu-item">
            <a href="<?php bloginfo('url')?>/about/" class="menu-link">
              <span class="menutext">
                ABOUT
              </span>
            </a>
          </li>

          <li class="nenu-item nav-divider">
            <img src="<?php echo IMG ?>/nav-dot.png" alt="" class="nav-dot">
          </li>

          <li class="menu-item hasdropdown">
            <a href="" class="menu-link">
              <span class="menutext">
                PRIMARY CARE
              </span>
            </a>
            <div class="dropmenu">
              <ul class="dropmenuitems">
                <?php $treatments = array(
                'post_type' => 'treatments',
                'posts_per_page' => -1,
                'order' => 'ASC',
                'orderby' => 'title',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'treatments_category',
                    'field' => 'slug',
                    'terms' => 'primary-care',
                    'operator' => 'IN'
                  )
                )
                );
                $loop = new WP_Query( $treatments  );
                if($loop->have_posts()): ?>
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <li class="menu-item"><a href="<?php the_permalink() ?>" class="menulink"><?php the_title() ?></a></li>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); endif; ?>
              </ul>
            </div>
          </li>

          <li class="nenu-item nav-divider">
            <img src="<?php echo IMG ?>/nav-dot.png" alt="" class="nav-dot">
          </li>

          <li class="menu-item hasdropdown">
            <a href="" class="menu-link">
              <span class="menutext">
                AESTHETICS
              </span>
            </a>
            <div class="dropmenu">
              <ul class="dropmenuitems">
                <?php $treatments = array(
                'post_type' => 'treatments',
                'posts_per_page' => -1,
                'order' => 'ASC',
                'orderby' => 'title',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'treatments_category',
                    'field' => 'slug',
                    'terms' => 'aesthetics',
                    'operator' => 'IN'
                  )
                )
                );
                $loop = new WP_Query( $treatments  );
                if($loop->have_posts()): ?>
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <li class="menu-item"><a href="<?php the_permalink() ?>" class="menulink"><?php the_title() ?></a></li>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); endif; ?>
              </ul>
            </div>
          </li>

          <li class="nenu-item nav-divider">
            <img src="<?php echo IMG ?>/nav-dot.png" alt="" class="nav-dot">
          </li>

          <li class="menu-item hasdropdown">
            <a href="" class="menu-link">
              <span class="menutext">
                CONDITIONS
              </span>
            </a>
            <div class="dropmenu">
              <ul class="dropmenuitems">
                <?php $concerns = array(
                'post_type' => 'concerns',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
                );
                $loop = new WP_Query( $concerns  );
                if($loop->have_posts()): ?>
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <li class="menu-item"><a href="<?php the_permalink() ?>" class="menulink"><?php the_title() ?></a></li>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); endif; ?>
              </ul>
            </div>
          </li>

          <li class="nenu-item nav-divider">
            <img src="<?php echo IMG ?>/nav-dot.png" alt="" class="nav-dot">
          </li>

          <li class="menu-item">
            <a href="<?php bloginfo('url')?>/patient-info/" class="menu-link">
              <span class="menutext">
                PATIENT INFO
              </span>
            </a>
          </li>

          <li class="nenu-item nav-divider">
            <img src="<?php echo IMG ?>/nav-dot.png" alt="" class="nav-dot">
          </li>

          <li class="menu-item">
            <a href="<?php bloginfo('url')?>/request-appointment/" class="menu-link">
              <span class="menutext">
                REQUEST APPOINTMENT
              </span>
            </a>
          </li>

        </ul>
      </div>

    </nav>

  </section>
</header>
<!-- HEADER -->
