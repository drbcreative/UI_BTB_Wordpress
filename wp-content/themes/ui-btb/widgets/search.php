<div id="search-overlay">
	<div class="container-fluid">
		<div class="row justify-content-end close-sec">
			<a id="close-search" style="background:none;border:none;outline:0;"><svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="window-close" class="svg-inline--fa fa-window-close fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M464 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm0 394c0 3.3-2.7 6-6 6H54c-3.3 0-6-2.7-6-6V86c0-3.3 2.7-6 6-6h404c3.3 0 6 2.7 6 6v340zM356.5 194.6L295.1 256l61.4 61.4c4.6 4.6 4.6 12.1 0 16.8l-22.3 22.3c-4.6 4.6-12.1 4.6-16.8 0L256 295.1l-61.4 61.4c-4.6 4.6-12.1 4.6-16.8 0l-22.3-22.3c-4.6-4.6-4.6-12.1 0-16.8l61.4-61.4-61.4-61.4c-4.6-4.6-4.6-12.1 0-16.8l22.3-22.3c4.6-4.6 12.1-4.6 16.8 0l61.4 61.4 61.4-61.4c4.6-4.6 12.1-4.6 16.8 0l22.3 22.3c4.7 4.6 4.7 12.1 0 16.8z"></path></svg></a>
		</div>
		<div class="row">
			<div class="col-md-12 mx-auto">
				<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
          <h2 class="text-center white">Search</h2>
					<div class="input-group">
				      <input type="text" class="form-control" placeholder="Search" value="<?php the_search_query(); ?>" name="s" id="s">
				      <span class="input-group-btn">
				        <button id="searchsubmit" class="btn btn-white outline white" type="submit"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="svg-inline--fa fa-search fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path></svg></button>
				      </span>
				    </div>
				</form>
        <em class="white">We're happy to answer any questions you may have, feel free to call us at<br><a href="tel:561-845-6500" class="searchcall">(561) 845-6500</a></em>
			</div>
		</div>
</div>
<script>
	jQuery(document).ready(function($) {
		$('#open-search').click(function() {
			$('#search-overlay').fadeIn();
		});
		$('#close-search').click(function() {
			$('#search-overlay').fadeOut();
		});
	});
</script>
</div>
