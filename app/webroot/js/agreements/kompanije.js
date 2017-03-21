var inst = function () {
    var filemanager = $('.filemanager'),
        fileList = filemanager.find('.data'),
        breadcrumbs = $('.breadcrumbs'),
        backButton = $('.back-btn');
    var showContracts = function () {
        $('.searchable_input').fastLiveFilter('.data');
        $('.tab-pane.active').find('.search').click(function () {
            $('.tab-pane.active .searchable_input').fastLiveFilter('.tab-pane.active .data');
            console.log('bokac');
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
        
        $('.nav li').click(function(){
            var kojiTab = $(this).find('a').attr('href');
            var tabovi = $(kojiTab + '.tab-pane '+ kojiTab);
            if (parseInt(tabovi.find('li.folders').length) === 0) {
                $('.sk-folding-cube').show();
                var letter = $(this).find('a').html();
                jQuery.ajax({
                    url: '/agreements/agreement',
                    method: 'POST',
                    data: {letter: letter, company: true},
                    dataType: 'HTML'
                }).done(function (response) {
                    $('.sk-folding-cube').hide();
                    tabovi.find('.filemanager .data').html(response);
                }).fail(function () {
                    $('.sk-folding-cube').hide();
                }); 
            }
           
        });    
        
    };

    return {
        //main function to initiate template pages
        init: function () {
            showContracts();
        }
    };
}();