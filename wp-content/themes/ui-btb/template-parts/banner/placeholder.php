<?php

          $image = IMG . '/placeholder.jpg'; 

?>
<section class="interior-fold fold-landing <?php if ( has_post_thumbnail( $post->ID )  ) {echo "postthumb-contains";} ?>">
  <div class="interior-fold fold-background fade-nun"></div>
  <div class="interior-fold fold-content-main">
	<div class=" banner-bg fade-nun" >
		<img src="<?php echo $image ?>" alt="<?php if (is_post_type_archive()){ post_type_archive_title(); } else { the_title(); } ?>" class="bannerim">
	</div>
</section>



