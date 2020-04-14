<!-- Schedule A Consultation -->

<form action="#" id="schedule" class="mt-4">
  <input type="text" name="name" placeholder="" value="Your Name">
  <input type="text" name="email" placeholder="" value="Email">
  <input type="text" name="phone" placeholder="" value="Phone">
  <select name="preferred_time" placeholder="">
      <option value="" disabled selected>Preferred Time</option>
      <option value="Early Morning">Early Morning</option>
      <option value="Late Morning">Late Morning</option>
      <option value="Early Afternoon">Early Afternoon</option>
      <option value="Late Afternoon">Late Afternoon</option>
  </select>
  <select name="preferred_day" placeholder="Preferred Date">
      <option value="" disabled selected>Preferred Day</option>
      <option value="Monday">Monday</option>
      <option value="Tuesday">Tuesday</option>
      <option value="Wednesday">Wednesday</option>
      <option value="Thursday">Thursday</option>
      <option value="Friday">Friday</option>
      <option value="Saturday">Saturday</option>
  </select>
  <select name="treatment" placeholder="">
      <option value="" disabled selected>Treatment</option>

      <?php $treatments = array(
      'post_type' => 'treatments',
      'posts_per_page' => -1,
      'order' => 'ASC',
      'orderby' => 'title',
      );
      $loop = new WP_Query( $treatments  );
      if($loop->have_posts()): ?>
      <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
      <option value="<?php the_title() ?>"><?php the_title() ?></option>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); endif; ?>
  </select>
  <button type="submit" class="ui-btn-main mt-4">SUBMIT REQUEST</button>
          <div id="form-results"></div>
</form>
