var contracts = function () {
    var loadAllElements = function (pk) {
        // DROP ZONE
//        var myDropZone = new Dropzone(".dropzone", {
//            acceptedFiles: "image/*",
//            paramName: "file", // The name that will be used to transfer the file
//            maxFilesize: 5.0, // MB
//            addRemoveLinks: true
//        });
        var myDropZone = $(".dropzone").dropzone({
            acceptedFiles: "application/pdf",
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 5.0, // MB
            addRemoveLinks: true,
            dictDefaultMessage: "Prevucite slike za upload ovdje"
        });
        
        myDropZone.on("success", function (file, response) {
            console.log('uspesh neki');
            //$(file.previewTemplate).append('<input class="server_file_name" type="hidden" value="' + response + '">');
        });
        
        myDropZone.on('addedfile', function(file){
            console.log('dodan fajl');
        });

        myDropZone.on("removedfile", function (file) {
            var photoName = $(file.previewTemplate).children('.server_file_name').attr('value');
            $.post('/news/deleteImage', "photo=" + photoName); // Send the file id along
        });
        
        $("#btn-add-photos").click(function (event) {
            $('#ajax-modal').modal();
        });


        $("#btn-dialog-dismiss").click(function (event) {
            //location.reload();
        });
    };
    return {
        //main function to initiate template pages
        init: function (pk) {
            loadAllElements(pk);
        }
    };
}();