var inst = function () {
    var mergovanje = function () {

        var $modal = $('#merge-modal');
        var mainId;
        var arr = [],
                glavniNiz = [];

        $("#merge-btn").click(function (event) {

            event.preventDefault();
            $.each($(".chekboksovi .icheckbox_square-blue.checked"), function () {
                arr.push($(this).find('.koji-id').val());
            });

            if (arr.length === 0) {
                $('.error-delete').fadeIn().delay(2000).fadeOut();
                return;
            }
            $modal.modal();
        });

        var findChecked = function () {
            $.each($(".chekboksovi .icheckbox_square-blue.checked"), function () {
                arr.push($(this).find('.koji-id').val());
            });

            if (arr.length === 0) {
                $('.error-delete').fadeIn().delay(2000).fadeOut();
                return;
            }
            $modal.modal();
        };

        $(".join-companies").click(function (event) {
            event.preventDefault();
            $(this).parent().parent().find('input').iCheck('check');
            findChecked();
        });

        $('.mergeConfirmed').click(function () {
            $('.heading-title').hide();
            $('.sk-folding-cube').show();
            $('.naslov').html('Spajam...');
            var $this = $(this);
            $this.prop('disabled', true);
            jQuery.ajax({
                url: '/companies/automerge',
                method: 'POST',
                data: {ids: arr},
                type: 'json'
            }).done(function (response) {
                // sad vrati kako je bilo
                $('.sk-folding-cube').hide();
                $('.naslov').html('Spajanje');
                if (typeof(response.status) == 'boolean' && response.status == true) {
                    
                } else {
                    $('.modal-body').html();
                    for(var property in response.message) {
                        $('.modal-body').append('ID: ' + property + ': ' + response.message[property]);
                    }
                    return;
                }
                
                arr.forEach(function (element) {
                    $('.koji-id:input[value="' + element + '"]').parent().parent().parent().fadeOut('slow');
                });


                arr = [];
                mainId = 0;
                
                $('.heading-title').show();
                $this.prop('disabled', false);
                $modal.modal('hide');
            }).fail(function () {
                alert('fail');
            });
        });

    };

    var pregled = function () {
        var $checkall = $('.check-all');

        var arr = [];
        var $modal = $('#delete-modal');

        $checkall.change(function () {
            $('.koji-id').prop('checked', $(this).prop("checked"));
        });
        $("#deleteAll").click(function (event) {
            arr = [];
            event.preventDefault();
            $.each($(".chekboksovi .icheckbox_square-blue.checked"), function () {
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

        $('input[name="iCheckMain"]').on('ifChecked', function (event) {
            $('input[name="iCheck"]').iCheck('check');
        });
        $('input[name="iCheckMain"]').on('ifUnchecked', function (event) {
            $('input[name="iCheck"]').iCheck('uncheck');
        });

        $('.deleteAllConfirmed').click(function () {
            jQuery.ajax({
                url: '/institutions/removeAll',
                method: 'POST',
                data: {ids: arr}
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