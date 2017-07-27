var settings = function () {
    var cache = function() {
        
        var $modal = $('#cache-modal');

        $(".btn-clear").click(function (event) {
            event.preventDefault();
            $modal.modal();
        });        
        
        $('.mergeConfirmed').click(function(){
           var $thisButton = $(this);
           $thisButton.hide();
           jQuery.ajax({
                url: '/settings/clear',
                method: 'POST',
                type: 'html'
            }).done(function (response) {
                $modal.modal('hide');
            }).fail(function () {
                $modal.modal('hide');
                alert('failed to save agreement types!');
            });
        });        
    };
    
    return {
        //main function to initiate template pages
        init: function () {
            cache();
        }
    };
}();