var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

let photo_counter = 0;
Dropzone.autoDiscover = false;


var myDropzone = new Dropzone(".dropzone", {
    maxFilesize: 8, // 8 mb
    previewsContainer: '#dropzonePreview',
    //previewTemplate: document.querySelector('#preview-template').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Remove',
    dictFileTooBig: 'Image is bigger than 8MB',
    acceptedFiles: ".jpeg,.jpg,.png,.pdf",
});


myDropzone.on("sending", function (file, xhr, formData) {
    formData.append("_token", CSRF_TOKEN);
});
myDropzone.on("success", function (file, response) {
    //alert(response);
    console.log(response.code);
    if (response.code == 200) {
        photo_counter++;
        //jQuery("#photoCounter").text("(" + photo_counter + ")");
        jQuery('#reload_me').load(location.href + " " + '#reload_me > *');
    }

    if (response.success == 0) { // Error
        alert(response.error);
    }
});


jQuery(document).ready(function ($) {
    /** Media MAnager Search */
    $('.media_manager_search').on('keyup', 'input[name="q"]', function () {
        //alert($(this).val());
        let search_key = $(this).val();
        let csrf_token = $("meta[name=csrf-token]")
        //jQuery('#reload_me').load(location.href + " " + '#reload_me > *');

        $.ajax({
            type: 'GET',
            url: baseurl + '/admin/common/media/search/' + search_key,
            success: function (output) {
                //toastr.success(output.message);
                //console.log(output.html);
                $("div#reload_me").html(output.html);
            }
        });
    });
})
