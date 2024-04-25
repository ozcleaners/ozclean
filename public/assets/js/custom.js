//let $ = jQuery;
jQuery(document).ready(function ($) {
    $.noConflict();

    // menu item
    $('.menu-item').on('mouseover', function () {
        $(this).addClass('active').removeClass('active');
    });
    // $(".navbar-brand").click(function() {
    //     $("#toggleClass").toggle();
    // });
    $(".navbar-brand").click(function (e) {
        $("#toggleClass").toggle();
        e.stopPropagation();
    });
    $(document).click(function (e) {
        if (!$(e.target).is('#toggleClass, #toggleClass *')) {
            $("#toggleClass").hide();
        }
    });

    $("#datepicker").datepicker({
        dateFormat: 'dd-mm-yy',
        theme: 'Bootstrap-4'
    });

    // select 2
    // select 2
    $('.select-box').select2();

    // Trumbowyg
    $('#wysiwyg').trumbowyg();
    $('#wysiwyg1').trumbowyg();

});

//Select 2
function select2Refresh() {
    jQuery('select.select-box').select2({});
}


/* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("mySidenav").style.display = "block";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("mySidenav").style.display = "none";

}

/* Check All Input checknox */
jQuery("#checkAll").click(function () {
    jQuery('input.checkItem:checkbox').not(this).prop('checked', this.checked);
});

window.onload = function () {
    var hidediv = document.getElementById('mySidenav');
    var hidenav = document.getElementById('navbarSupportedContent');
    document.onclick = function (div) {
        if (!div.target.closest('#mySidenav') && hidediv.style.display != "none" && !div.target.closest('.sidebar_open')) {
            hidediv.style.display = "none"
        }
        if (!div.target.closest('#navbarSupportedContent') && hidenav.style.display != "none" && !div.target.closest('.navbar-toggler')) {
            //bootstrap.Collapse.getInstance(hidenav).hide();
        }

    }
}

function pageReloadSpinner() {
    jQuery('body').empty().append(`<div style="width: 100%; text-align: center; margin: 20% auto;"><div class="spinner-border text-success" role="status"><span class="sr-only">Loading...</span></div></div>`);
}

// toggle full screen
