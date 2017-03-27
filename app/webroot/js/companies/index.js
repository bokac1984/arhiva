var inst = function () {
    var mergovanje = function() {
        
        var $modal = $('#merge-modal');
        var mainId;
        var arr = [];
        
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
            $modal.modal();
        });        
        
        $('.mergeConfirmed').click(function(){
            
           jQuery.ajax({
                url: '/companies/merge',
                method: 'POST',
                data: { ids: arr, main: mainId},
                type: 'json'
            }).done(function (response) {
                //location.reload();
                $modal.modal('hide');
                arr = [];
                mainId = 0;
            }).fail(function () {
                alert('fail');
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