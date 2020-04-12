
jQuery(function($) {

    $(document).ready(function() {

        $(".gallery-archive .ui-gallery .slider-gallery").each(function(){
            var title = $(this).next().children('.gallery-title').text();
            $(this).lightGallery({
                //hide download button and slide counter
                download:false,
                counter:false,
                selector: '.gallery-item'
            });
            //show title in gallery
            $(this).on('onAfterOpen.lg', function() {
                $('.lg').prepend('<h2 class="portfolio-title">' + title + '</h2>')
            })        
        });
      
        $('#gallery-single').each(function(){
            var title = $('.gallery-single-title').text()
            $(this).lightGallery({
                //hide download button and slide counter
                download:false,
                counter:false,
                selector: '.gallery-item a'
            });
            //show title in gallery
            $(this).on('onAfterOpen.lg', function() {
                $('.lg').prepend('<h2 class="portfolio-title">' + title + '</h2>')
            })   
        })
    });

});

