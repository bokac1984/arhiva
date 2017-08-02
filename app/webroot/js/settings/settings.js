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
    
    var add = function() {
        
        var $modal = $('#sections-modal');

        $(".btn-new-section").click(function (event) {
            event.preventDefault();
            $modal.modal();
        });        
        
        $('.save-confirmed').click(function(){
           var $thisButton = $(this);
           $thisButton.hide();
           jQuery.ajax({
                url: '/setting_sections/add',
                method: 'POST',
                type: 'json',
                data: $('#SettingSectionAddForm').serialize()
            }).done(function (response) {
                
                $('#SettingSettingSectionId').append($('<option>', {
                    value: response.id,
                    text: response.name
                })).val(response.id);
                
                
                $thisButton.show();
                $modal.modal('hide');
            }).fail(function (failsponse) {
                $thisButton.show();
                //$modal.modal('hide');
                alert('Desila se greska, pokusajte ponovo.');
            });
        });        
    };    
    
    return {
        //main function to initiate template pages
        init: function () {
            cache();
            add();
        }
    };
}();