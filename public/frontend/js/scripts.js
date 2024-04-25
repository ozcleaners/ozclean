jQuery('document').ready(function ($) {
    $.noConflict();

    //ANIMATED COUNTER
    $('.single-counter-number-value,.small-counter-with-icon-holder-number-value ,.animated-counter-number-value').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 8000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });


    // BEFORE AFTER ITEM [ONE]
    $("a#before1").on('click', function (e) {
        e.preventDefault();
        var status_id = $(this).attr('href').split('?');
        var sts = status_id[0];

        $('.img-wrap').attr('src', sts);
        $(this).hide();
        $('#after1').show();
        return false;
    });

    $("a#after1").on('click', function (e) {
        e.preventDefault();
        var status_id = $(this).attr('href').split('?');
        var sts = status_id[0];

        $('.img-wrap').attr('src', sts);

        $('a#before1').show();
        $(this).hide();
        return false;
    });

    $("img#imgafterwrap1").on('click', function (e) {
        var status_ids = $(this).attr('src').split('?');
        $('.img-wrap').attr('src', status_ids);
        $('a#after1').hide();
        $('a#before1').show();
    });
    $("img#imgbeforewrap1").on('click', function (e) {
        var status_ids = $(this).attr('src').split('?');
        $('.img-wrap').attr('src', status_ids);
        $('a#after1').show();
        $('a#before1').hide();
    });

    $('a#imgbefore1').click(function () {
        $('a#before1').hide();
        $('a#after1').show();
    });
    $('a#imgafter1').click(function () {
        $('a#after1').hide();
        $('a#before1').show();
    });
    // BEFORE AFTER ITEM [TWO]

    $("a#before2").on('click', function (e) {
        e.preventDefault();
        var status_id = $(this).attr('href').split('?');
        var sts = status_id[0];

        $('.img-wrap').attr('src', sts);
        $(this).hide();
        $('#after2').show();
        return false;
    });

    $("a#after2").on('click', function (e) {
        e.preventDefault();
        var status_id = $(this).attr('href').split('?');
        var sts = status_id[0];

        $('.img-wrap').attr('src', sts);

        $('a#before2').show();
        $(this).hide();
        return false;
    });

    $("img#imgafterwrap2").on('click', function (e) {
        var status_ids = $(this).attr('src').split('?');
        $('.img-wrap').attr('src', status_ids);
        $('a#after2').hide();
        $('a#before2').show();
    });
    $("img#imgbeforewrap2").on('click', function (e) {
        var status_ids = $(this).attr('src').split('?');
        $('.img-wrap').attr('src', status_ids);
        $('a#after2').show();
        $('a#before2').hide();
    });

    $('a#imgbefore2').click(function () {
        $('a#before2').hide();
        $('a#after2').show();
    });
    $('a#imgafter2').click(function () {
        $('a#after2').hide();
        $('a#before2').show();
    });
    // BEFORE AFTER ITEM END


    //RECENT BLOG CAROUSEL
    $(".owl-carousel.postbox").owlCarousel({
        items: 2,
        margin: 30,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            580: {
                items: 2
            }
        }
    });
    $(".owl-carousel.postbox-3col").owlCarousel({
        items: 3,
        margin: 30,
        responsiveClass: true,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            580: {
                items: 2
            },
            991: {
                items: 3
            }
        }
    });

    //TESTIMONIAL CAROUSEL
    $(".testimonial-item-wrap").owlCarousel({
        items: 1,
        margin: 30,
    });
    // //TESTIMONIAL CAROUSEL
    // $(".animated-service-mobile-carousel").owlCarousel({
    //     items: 1,
    //     dots: true,
    //     margin: 30,
    //     autoplay: true,
    //     loop: true,
    // });

    /*if ($(window).width() < 767) {
    $( ".footer-widget-inline-wrapper" ).addClass( 'owl-carousel' );

    $(".footer-widget-inline-wrapper").owlCarousel({
        items: 1,
        dots: true,
        margin: 30,
        autoplay: true,
        loop: true,
    });
    }*/


    //ACCORDION
    $('.panel-collapse').on('shown.bs.collapse', function () {
        $(this).parent().addClass('panel-box-active-border');
    });
    $('.panel-collapse').on('hidden.bs.collapse', function () {
        $(this).parent().removeClass('panel-box-active-border');
    });

    //CLASS WITH SCREEN SIZE


    //SCROLL TO TOP
    $("#btn-back-to-top").hide();
    $(function toTop() {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#btn-back-to-top').fadeIn();
            } else {
                $('#btn-back-to-top').fadeOut();
            }
        });

        $('#btn-back-to-top').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });


    //ISOTOP FILTER
    // external js: isotope.pkgd.js
    // init Isotope
    // Initiating Isotope
    var $container = $('.portfolio-grid');
    var colWidth = function () {
        var w = $container.width(),
            columnNum = 1,
            columnWidth = 0;
        if (w > 1200) {
            columnNum = 3;
        } else if (w > 900) {
            columnNum = 3;
        } else if (w > 550) {
            columnNum = 2;
        } else if (w > 100) {
            columnNum = 2;
        }
        columnWidth = Math.floor(w / columnNum);

        if (w < 550) {
            columnWidth = columnWidth - 8;
        } else {

            columnWidth = columnWidth - 10;
        }
        // Item width
        $container.find('.portfolio-item-loader').each(function () {
            var $item = $(this);
            var multiplier_w = $item.attr('class').match(/item-w(\d)/);
            var width = multiplier_w ? columnWidth * multiplier_w[1] - 4 : columnWidth - 4;
            // Update item width
            $item.css({
                width: width
            });
        });
        return columnWidth;
    };
    var isotope = function () {
        $container.isotope({
            resizable: false,
            itemSelector: '.portfolio-item-loader',
            masonry: {
                columnWidth: colWidth(),
                gutter: 15
            }
        });
    };

        // Activating Isotope Filter Navigation
        $('.portfolio-filter-wrap').on('click', 'span', function () {
            // remove active previous
            $('.portfolio-filter-wrap').find('span').removeClass('is-checked');
            // Add active class
            $(this).addClass('is-checked');
            var selector = $(this).attr('data-filter');
            $container.isotope({
                filter: selector
            });
        });

        // Calling Isotope
        //isotope();
        // $(window).smartresize(isotope);

        // Call after content loading
        //$(window).load(function () {
        //isotope();
        //});


    //


    //Portfliod Slider - Nipun
    let portfolioSlider = '.portfolio-style-2';
    function loadSlickPortfolio(){
        $(portfolioSlider).slick({
                slidesToShow: 5,
                slidesToScroll: 4,
                arrows: true,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 1000,
                centerMode: false,
                rows: 0,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            centerMode: false,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            centerMode: false,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            centerMode: false,
                            slidesToScroll: 1
                        }
                    },
                ]
            });
    }
    loadSlickPortfolio()
    $(".portfolio-filter-wrap").on('click', 'span.filter-item', function(){
        let filter = $(this).data('filter');
        $(portfolioSlider).slick('slickUnfilter');
        // alert(filter);
        if(filter == '*'){
            $(portfolioSlider).slick('slickUnfilter');
        }else {
            $(portfolioSlider).slick('slickFilter', filter);
        }
    })








    //Alert box

        /** Confirm Box */


        var ALERT_TITLE = "Oops!";
    var ALERT_BUTTON_TEXT = "Ok";

    if(document.getElementById) {
        window.alert = function(txt) {
            createCustomAlert(txt);
        }
    }

    function createCustomAlert(txt) {
        d = document;

        if(d.getElementById("modalContainer")) return;

        mObj = d.getElementsByTagName("body")[0].appendChild(d.createElement("div"));
        mObj.id = "modalContainer";
        mObj.style.height = d.documentElement.scrollHeight + "px";

        alertObj = mObj.appendChild(d.createElement("div"));
        alertObj.id = "alertBox";
        if(d.all && !window.opera) alertObj.style.top = document.documentElement.scrollTop + "px";
        alertObj.style.left = (d.documentElement.scrollWidth - alertObj.offsetWidth)/2 + "px";
        alertObj.style.visiblity="visible";

        h1 = alertObj.appendChild(d.createElement("h1"));
        h1.appendChild(d.createTextNode(ALERT_TITLE));

        msg = alertObj.appendChild(d.createElement("p"));
        //msg.appendChild(d.createTextNode(txt));
        msg.innerHTML = txt;

        btn = alertObj.appendChild(d.createElement("a"));
        btn.id = "closeBtn";
        btn.appendChild(d.createTextNode(ALERT_BUTTON_TEXT));
        btn.href = "#";
        btn.focus();
        btn.onclick = function() { removeCustomAlert();return false; }

        alertObj.style.display = "block";

    }

    function removeCustomAlert() {
        document.getElementsByTagName("body")[0].removeChild(document.getElementById("modalContainer"));
    }
    function ful(){
        alert('Alert this pages');
    }

        //

});
