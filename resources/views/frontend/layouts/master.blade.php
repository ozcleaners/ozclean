<!DOCTYPE HTML>
<html>
<head>
    @hasSection('metas')
        @yield('metas')
    @else
        {!! metas() !!}
    @endif
        @php
            $setting = App\Models\GlobalSetting::where('id', 1)->get()->first();
        @endphp
        <meta property="og:image" content="{{$Media::iconSize($setting->favicon) }}" />
    @include('frontend.layouts.css')
    <meta name="viewport" content="width=device-width, initial-scale-scale=1.0">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-295M49JX0R"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-295M49JX0R');
    </script>
</head>
<body class="preload">

<div class="d-none d-lg-block">
    @include('frontend.layouts.header')
</div>
<div class="d-block d-lg-none">
{{--    @include('frontend.layouts.mobile-header')--}}
    @include('frontend.layouts.mobile_header_2')
</div>
@yield('content')
@include('frontend.layouts.footer')
@yield('topcusjs')
@yield('cusjs')
</body>
</html>
