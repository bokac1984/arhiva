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
        /**
         * kad se klikne na folder sakrij search
         */
        $("a.folders").click(function () {
            var nameFolder = $(this).attr('title');
            var brCrymb = '<span class="arrow">→</span> <span class="folderName">' + nameFolder + '</span>';
            filemanager.find('.search').hide();
            fileList.find('li.folders').hide();
            $('.sk-folding-cube').show();
            
            jQuery.ajax({
                url: '/institutions/getContractsForInstitution',
                method: 'POST',
                data: {id: $(this).attr('id')},
                dataType: 'HTML'
            }).done(function (response) {
            var element_to_scroll_to = $('#dokumenti')[0];
            element_to_scroll_to.scrollIntoView();                
                $('.sk-folding-cube').hide();
                fileList.removeClass('animated');
                 // sakrij foldere
                fileList.addClass('slideRight'); // dodaj klasu za animaciju
                breadcrumbs.append(brCrymb); // prikazi breadcrumb
                fileList.append(response);
                fileList.animate({'display': 'inline-block'}); //animiraj fajlove
                backButton.show(); // omoguci back button
            }).fail(function () {
                fileList.find('li.folders').show();
                $('.sk-folding-cube').hide();
                console.log('fail');
            });

        });

        backButton.click(function () {
            fileList.removeClass('animated slideRight');
            fileList.find('li.files').remove();
            fileList.find('li.folders').show();
            
            // ponovo prikazi ako se vrati na foldere
            filemanager.find('.search').show();
            
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