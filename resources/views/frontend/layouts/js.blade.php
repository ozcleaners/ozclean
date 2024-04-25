<!------------- JQUERY -------------->
<script type="text/javascript" src="{{$publicDir}}/frontend/js/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="{{$publicDir}}/frontend/js/jquery-ui.css">
<script src="{{$publicDir}}/frontend/js/jquery-ui.js"></script>
<!------------- ISOTOP -------------->
<script type="text/javascript" src="{{$publicDir}}/frontend/js/isotope.pkgd.min.js"></script>
<!------------- CAROUSEL -------------->
<script type="text/javascript" src="{{$publicDir}}/frontend/owl-carousel/js/owl.carousel.min.js"></script>
<!------------- BOOTSTRAP -------------->
<script type="text/javascript" src="{{$publicDir}}/frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" ssrc="{{$publicDir}}/frontend/js/bootstrap-extra.js"></script>
<!------------- MENU SCRIPT -------------->
<script type="text/javascript" src="{{$publicDir}}/frontend/js/menu-js/menu.js"></script>
<!------------- MEAN MENU SCRIPT -------------->
<script type="text/javascript" src="{{$publicDir}}/frontend/js/menu-js/meanmenu.js"></script>


<link rel="stylesheet" type="text/css" href="{{$publicDir}}/frontend/slick-slider/slick-theme.css"/>
<link rel="stylesheet" type="text/css" href="{{$publicDir}}/frontend/slick-slider/slick.css"/>
<script type="text/javascript" src="{{$publicDir}}/frontend/slick-slider/slick.min.js"></script>

<!------------- FACEBOOK FACE PILES SCRIPT -------------->
<script src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId=524302114730023&autoLogAppEvents=1"
        nonce="nedgQws1"></script>

<!------------- CUSTOM SCRIPT -------------->
<script type="text/javascript" src="{{$publicDir}}/frontend/js/scripts.js?{{rand(0,999)}}"></script>
{{--<script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>--}}

<!------ Include the above in your HEAD tag ---------->
<link xhref="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script>

    window.addEventListener("load", () => {
        document.body.classList.remove("preload");
    });

    document.addEventListener("DOMContentLoaded", () => {
        const nav = document.getElementById("nav");
        const btnNav = document.querySelector("#btnNav");
        if(btnNav) {
            btnNav.addEventListener("click", () => {
                nav.classList.add("nav--open");
            });
        }
        const navOverlay = document.querySelector(".nav__overlay");
        if (navOverlay){
            navOverlay.addEventListener("click", () => {
                nav.classList.remove("nav--open");
            });
        }
    });

    function ni(link) {
        window.location = link;
    }


    jQuery(document).ready(function($){
        $("#parent-element").on("click", ".dropdown-menu", function (e) {
            $(this).parent().is(".open") && e.stopPropagation();
        });
        $('.targetMenu').on('click', function(e){
            e.preventDefault();
            let getTarget = $(this).data('target');
            $('ul'+getTarget).toggle()
        })
        $('.mobile_header_menu .dropdown-submenu a.sublink').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });

        $('.animated-service-mobile-carousel').owlCarousel({
            responsiveClass:false,
            margin: 0,
            loop: false,
            items: 1,
            stagePadding: 0,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:1,
                    nav:false
                },
                1000:{
                    items:1,
                    nav:false,
                    loop:false
                }
            }
        })
    });


</script>

{{--<!-- Messenger Chat Plugin Code -->--}}
<div id="fb-root"></div>

<!-- Your Chat Plugin code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "105132197563599");
    chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml            : true,
            version          : 'API-VERSION'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));


</script>

