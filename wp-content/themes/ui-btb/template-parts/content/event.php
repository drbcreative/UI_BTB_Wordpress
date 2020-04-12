<?php
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
  $image = $image[0];
  $event = array(
      'post_type' => 'events',
      'posts_per_page' => 1,
      'order' => 'DESC'
  );
  $loop = new WP_Query( $event  );
  if($loop->have_posts()):
    while ( $loop->have_posts() ) : $loop->the_post();
    $eventNotify    = get_post_meta($post->ID, 'event_email_to', true);
    $eventAddress   = get_post_meta($post->ID, 'event_address', true);
    $startDate      = get_post_meta($post->ID, 'event_start_date', true);
    $startTime      = get_post_meta($post->ID, 'event_start_time', true);
    $endDate        = get_post_meta($post->ID, 'event_end_date', true);
    $endTime        = get_post_meta($post->ID, 'event_end_time', true);
    $display_map    = get_post_meta($post->ID, 'event_display_map', true);
?>

<a href="<?php the_permalink() ?>">
  <div class="event d-none d-xl-flex">
    <div class="col-left">
      <p class="event-month color-light-accent"><span class="mnt"><?= $startTime ? date("M"):'';?></span></p>
      <p class="event-day color-light-accent"><span class="day"><?= $startTime ? date("j"):'';?></span></p>
    </div>
    <div class="col-right">
      <p class="small-copy color-white">RSVP TO OUR</p>
      <p class="small-copy color-white"><strong><?php echo get_the_title(); ?></strong> EVENT!</p>
    </div>
  </div>
</a>

<?php endwhile; ?>
<?php wp_reset_postdata(); endif; ?>
