var photo_counter = 0;
Dropzone.options.realDropzone = {

    uploadMultiple: false,
    parallelUploads: 100,
    maxFilesize: 8,
    previewsContainer: '#dropzonePreview',
    // previewTemplate: document.querySelector('#preview-template').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Remove',
    dictFileTooBig: 'Image is bigger than 8MB',

    // The setting up of the dropzone
    init: function () {
        this.on("removedfile", function (file) {
            jQuery.ajax({
                type: 'POST',
                url: 'upload/delete',
                data: {id: file.name, _token: jQuery('#csrf-token').val()},
                dataType: 'html',
                success: function (data) {
                    var rep = JSON.parse(data);
                    if (rep.code == 200) {
                        photo_counter--;
                        jQuery("#photoCounter").text("(" + photo_counter + ")");
                        //divLoadFn('#reload_me');
                        $("#reload_me").load(location.href + " #reload_me");
                    }
                }
            });
        });
    },
    error: function (file, response) {
        if (jQuery.type(response) === "string")
            var message = response; //dropzone sends it's own error messages in string
        else
            var message = response.message;
        file.previewElement.classList.add("dz-error");
        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
        }
        return _results;
    },
    success: function (file, done) {
        jQuery(window).load(function () {
            photo_counter++;

            jQuery('#reload_me').load(location.href + " " + '#reload_me > *');

            //jQuery("#photoCounter").text("(" + photo_counter + ")");
            // jQuery("#photoCounter").text("(" + photo_counter + ")");
            // jQuery('#reload_me').load(location.href + " " + '#reload_me');
            // jQuery('#media_manager_reload_me').load(window.location.assign(href) + " #media_manager_reload_me");
        });
    }
}
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
