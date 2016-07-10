var inst = function () {
    var showContracts = function (pk) {
        var filemanager = $('.filemanager'),
            fileList = filemanager.find('.data'),
            breadcrumbs = $('.breadcrumbs'),
            backButton = $('.back-btn');
    
        $("a.folders").click(function(){
            var nameFolder = $(this).attr('title');
            var brCrymb = '<span class="arrow">→</span> <span class="folderName">' + nameFolder + '</span>';
            fileList.removeClass('animated');
            jQuery.ajax({
                url: '/institutions/getContractsForInstitution',
                method: 'POST',
                data: { id: $(this).attr('id') },
                dataType: 'HTML'
            }).done(function (response) {
                fileList.find('li.folders').hide();
                breadcrumbs.append(brCrymb);
                fileList.addClass('animated');
                
                fileList.append(response);
                
                fileList.animate({'display':'inline-block'});
                
                backButton.show();
                
            }).fail(function () {
                alert('fail');
                // Whoops; show an error.
            });            

        });
        
        backButton.click(function(){
            fileList.removeClass('animated');
                fileList.find('li.files').remove();
                fileList.find('li.folders').show();
                fileList.addClass('animated');
                fileList.animate({'display':'inline-block'}); 
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