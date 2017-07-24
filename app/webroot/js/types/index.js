var types = function () {
    var mergovanje = function() {
        
        var $modal = $('#merge-modal');
        var mainId;
        var arr = [];
        var idArrayWitoutMain = [];
        
        $("#merge-btn").click(function (event) {
            event.preventDefault();
            $.each($(".chekboksovi .icheckbox_square-blue.checked"),function(){
                arr.push($(this).find('.koji-id').val());
            });

            if (arr.length === 0) {
                $('.error-delete').fadeIn().delay(2000).fadeOut();
                return;
            } 
            $.each($(".chekboksovi .iradio_square-blue.checked"),function(){
                mainId = ($(this).find('.main').val());
            });
            
            idArrayWitoutMain = arr;
            var index = idArrayWitoutMain.indexOf(mainId);

            if (index > -1) {
               idArrayWitoutMain.splice(index, 1);
            }
            console.log(arr);
            $modal.modal();
        });        
        
        $('.mergeConfirmed').click(function(){
           var $thisButton = $(this);
           $thisButton.hide();
           jQuery.ajax({
                url: '/agreement_types/merge',
                method: 'POST',
                data: { ids: arr, main: mainId},
                type: 'html'
            }).done(function (response) {
                $modal.modal('hide');
                
                arr = [];
                mainId = 0;
                idArrayWitoutMain.forEach(function(element) {
                    $('.chekboksovi').find('tr#'+element).fadeOut();
                });
                $('input[name="iCheck"]').iCheck('uncheck');
                $('input[class="koji-id"]').iCheck('uncheck');
                $thisButton.show();
            }).fail(function () {
                $modal.modal('hide');
                alert('failed to save agreement types!');
            });
        });        
    };
    
    var pregled = function () {
        var $checkall = $('.check-all');  

        var arr=[];
        var $modal = $('#delete-modal');

        $checkall.change(function () {
            $('.koji-id').prop('checked', $(this).prop("checked"));
        }); 
        $("#deleteAll").click(function (event) {
            arr = [];
            event.preventDefault();
            $.each($(".chekboksovi .icheckbox_square-blue.checked"),function(){
                arr.push($(this).find('input[name="iCheck"]').val());
            });

            if (arr.length === 0) {
                $('.error-delete').fadeIn().delay(2000).fadeOut();
                return;
            }   
            console.log(arr);
            $modal.modal();
        });
        
        $('input[name*="iCheck"]').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue'
        });

        $('input[name="iCheckMain"]').on('ifChecked', function(event){
            $('input[name="iCheck"]').iCheck('check');
        }); 
        $('input[name="iCheckMain"]').on('ifUnchecked', function(event){
            $('input[name="iCheck"]').iCheck('uncheck');
        });        
        
        $('.deleteAllConfirmed').click(function(){
           jQuery.ajax({
                url: '/institutions/removeAll',
                method: 'POST',
                data: { ids: arr}
            }).done(function (response) {
                location.reload();
                $modal.modal('hide');
            }).fail(function () {
                alert('fail');
            });
        });
    };
    return {
        //main function to initiate template pages
        init: function () {
            pregled();
            mergovanje();
        }
    };
}();