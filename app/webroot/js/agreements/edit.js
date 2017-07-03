var editFun = function () {
    var edit = function () {
        $('#datetimepicker').datetimepicker();
    };
    
    return {
        //main function to initiate template pages
        init: function () {
            edit();
        }
    };
}();