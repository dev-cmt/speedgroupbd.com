<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/css/app.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/css/jquery.fancybox.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/css/textanimation.css">

    <!-- Favicon and Touch Icons  -->
    <link href="{{ asset('public/frontend') }}/images/favico.png" rel="shortcut icon">
    <link href="{{ asset('public/frontend') }}/images/favico.png" rel="apple-touch-icon-precomposed">

    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/css/custom.css">
    
    @yield('styles')
</head>

<body class="body header-fixed counter-scroll">

    <div class="preload preload-container">
        <svg class="pl" width="240" height="240" viewBox="0 0 240 240">
            <circle class="pl__ring pl__ring--a" cx="120" cy="120" r="105" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 660" stroke-dashoffset="-330" stroke-linecap="round"></circle>
            <circle class="pl__ring pl__ring--b" cx="120" cy="120" r="35" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 220" stroke-dashoffset="-110" stroke-linecap="round"></circle>
            <circle class="pl__ring pl__ring--c" cx="85" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
            <circle class="pl__ring pl__ring--d" cx="155" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
        </svg>
    </div>
    <!-- /preload -->

    <div id="wrapper">
        <div id="pagee" class="clearfix">

            <!-- Main Header -->
            @include('frontend.partials.header')

            <main id="main">
                @yield('breadcrumb')

                @yield('content')

            </main>
            <!-- End Main Header -->

            <!-- Footer -->
            @include('frontend.partials.footer')
            <!-- End Footer -->
        </div>
        <!-- /#page -->
    </div>

    <!-- Modal Popup Bid -->
    @include('frontend.partials.themes')


    <!-- Javascript -->
    <script src="{{ asset('public/frontend') }}/js/jquery.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/jquery.nice-select.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/swiper-bundle.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/swiper.js"></script>
    <script src="{{ asset('public/frontend') }}/js/plugin.js"></script>
    <script src="{{ asset('public/frontend') }}/js/count-down.js"></script>
    <script src="{{ asset('public/frontend') }}/js/countto.js"></script>
    <script src="{{ asset('public/frontend') }}/js/jquery.fancybox.js"></script>
    <script src="{{ asset('public/frontend') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/price-ranger.js"></script>
    <script src="{{ asset('public/frontend') }}/js/textanimation.js"></script>
    <script src="{{ asset('public/frontend') }}/js/wow.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/shortcodes.js"></script>
    <script src="{{ asset('public/frontend') }}/js/main.js"></script>

    @yield('scripts')
</body>
</html>
