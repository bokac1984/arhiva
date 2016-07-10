var inst = function () {
    var showContracts = function (pk) {
        var filemanager = $('.filemanager'),
                fileList = filemanager.find('.data'),
                breadcrumbs = $('.breadcrumbs'),
                backButton = $('.back-btn');

        $('#searchable_input').fastLiveFilter('.data');
        filemanager.find('.search').click(function () {

            var search = $(this);

            search.find('span').hide();
            search.find('input[type=search]').show().focus();

        }).on('keyup', function (e) {

            // Clicking 'ESC' button triggers focusout and cancels the search

            var search = $(this);

            if (e.keyCode === 27) {
                search.trigger('focusout');
            }

        }).focusout(function (e) {

            // Cancel the search

            var search = $(this);

            if (!search.val().trim().length) {
                //search.hide();
                search.find('input').val('').hide();
            }
        });
        ;

        $("a.folders").click(function () {
            var nameFolder = $(this).attr('title');
            var brCrymb = '<span class="arrow">→</span> <span class="folderName">' + nameFolder + '</span>';

            jQuery.ajax({
                url: '/institutions/getContractsForInstitution',
                method: 'POST',
                data: {id: $(this).attr('id')},
                dataType: 'HTML'
            }).done(function (response) {
                fileList.removeClass('animated');

                fileList.find('li.folders').hide();
                fileList.addClass('slideRight');
                breadcrumbs.append(brCrymb);
                //fileList.addClass('animated');

                fileList.append(response);

                fileList.animate({'display': 'inline-block'});

                backButton.show();

            }).fail(function () {
                alert('fail');
                // Whoops; show an error.
            });

        });

        backButton.click(function () {
            fileList.removeClass('animated slideRight');
            fileList.find('li.files').remove();
            fileList.find('li.folders').show();
            //fileList.addClass('animated');
            fileList.animate({'display': 'inline-block'});
            $('.folderName').not('.back-btn').remove();
            $('.arrow').remove();
        });
    };
    return {
        //main function to initiate template pages
        init: function (pk) {
            showContracts(pk);
        }
    };
}();