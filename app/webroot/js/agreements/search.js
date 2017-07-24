var searchFun = function () {
    var search = function () {
        $('.contract_date').editable({
            format: 'yyyy-mm-dd',
            viewformat: 'dd.mm.yyyy',
            datepicker: {
                weekStart: 1
            }
        });
        
        //remote source (simple)
        $('.agreement-type').editable({   
            source: types,
            showbuttons: false
        });         
    };


    return {
        //main function to initiate template pages
        init: function () {
            search();
        }
    };
}();