(function($){
    $.fn.extend({
        select2_sortable: function(){
            var select = $(this);
            $(select).select2({
                tags: true,
                width: '100%',
                // createTag: function(params) {
                //     return undefined;
                // }
            });
            var ul = $(select).next('.select2-container').first('ul.select2-selection__rendered');
            ul.sortable({
                //placeholder : 'ui-state-highlight',
                //forcePlaceholderSize: true,
                items       : 'li:not(.select2-search__field)',
                tolerance   : 'pointer',
                stop: function() {
                    $($(ul).find('.select2-selection__choice').get().reverse()).each(function() {
                        var id = $(this).data('data').id;
                        var option = select.find('option[value="' + id + '"]')[0];
                        $(select).prepend(option);
                    });
                }
            });
        }
    });
}(jQuery));

jQuery(function($) {
    $("#providers_list").select2_sortable();
    $("#events_list").select2_sortable();
    $("#testimonials_list").select2_sortable();
    $("#treatments_list").select2_sortable();
    $("#concerns_list").select2_sortable();
    $('#locations_list').select2_sortable();
    $('#galleries_list').select2_sortable();
    $("#promotions_list").select2_sortable();
    $("#videogallery_list").select2_sortable();


    selectAll('#testimonials_list');
    selectAll('#concerns_list');
    selectAll('#treatments_list');
    selectAll('#providers_list');
    selectAll('#events_list');
    selectAll('#galleries_list');
    selectAll('#locations_list');
    selectAll('#promotions_list');
    selectAll('#videogallery_list');

    //Select and unselect all items in select2
    function selectAll(select2) {
        //Select all
        $(select2).on("select2:selecting", function (event) {

            if (event.params.args.data.id == -1) {
                $(select2 + ' > option').prop("selected", true);
            }

        });

        //unselect all
        $(select2).on("select2:unselect", function (event) {

            if (event.params.data.id == -1) {
                $(select2).val('').trigger("change");
            }
        });
    };

});

