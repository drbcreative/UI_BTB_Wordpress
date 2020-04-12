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

<!-- HEADER -->
