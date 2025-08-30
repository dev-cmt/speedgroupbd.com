<!-- Main Header -->
<header class="main-header flex">
    <!-- Header Lower -->
    <div id="header">
        <div class="header-top">
            <div class="header-top-wrap flex-two">
                <div class="header-top-right">
                    <ul class=" flex-three">
                        <li class="flex-three">
                            <i class="icon-day"></i>
                            <span id="currentDate">Thursday, Mar 26, 2021</span>
                            <script>
                                document.getElementById("currentDate").innerText = new Date().toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' });
                            </script>
                        </li>
                        <li class="flex-three">
                            <i class="icon-mail"></i>
                            <a href="mailto:info@speedgroupbd.com">info@speedgroupbd.com</a>
                        </li>
                        <li class="flex-three">
                            <i class="icon-phone"></i>
                            <a href="https://wa.me/8801713019144" target="_blank">+880 1713 019 144</a>
                        </li>
                    </ul>
                </div>
                <div class="header-top-left flex-two">
                    <a href="{{route('page.booking-now')}}" class="booking">
                        <i class="icon-19"></i>
                        <span>Booking Now</span>
                    </a>
                    <div class="follow-social flex-two">
                        <span>Follow Us :</span>
                        <ul class="flex-two">
                            <li><a href="#"><i class="icon-icon-2"></i></a></li>
                            <li><a href="#"><i class="icon-icon"></i></a></li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
        <div class="header-lower">
            <div class="tf-container full">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner-container flex justify-space align-center">
                            <!-- Logo Box -->
                            <div class="mobile-nav-toggler mobie-mt mobile-button">
                                <i class="icon-Vector3"></i>
                            </div>
                            <div class="logo-box">
                                <div class="logo">
                                    <a href="{{url('/')}}">
                                        <img src="{{ asset('public') }}/images/logo.png" alt="Logo">
                                    </a>
                                </div>
                            </div>
                            <div class="nav-outer flex align-center">
                                <!-- Main Menu -->
                                <nav class="main-menu show navbar-expand-md">
                                    <div class="navbar-collapse collapse clearfix"
                                        id="navbarSupportedContent">
                                        <ul class="navigation clearfix">
                                            <li><a href="{{url('/')}}">Home</a></li>
                                            <li><a href="{{route('page.about-us')}}">About</a></li>
                                            <li class="dropdown2">
                                                <a href="#">Package</a>
                                                @php
                                                    $continents = \App\Models\Continent::with('countries')->where('status', true)->get();
                                                @endphp
                                                <ul>
                                                    @foreach($continents as $continent)
                                                        <li class="dropdown2">
                                                            <a href="#">{{ $continent->name }}</a>
                                                            @if($continent->countries->count() > 0)
                                                                <ul>
                                                                    @foreach($continent->countries as $country)
                                                                        <li>
                                                                            <a href="{{ route('page.package', $country->slug) }}">
                                                                                {{ $country->name }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach

                                                    <li>
                                                        <a href="{{ route('page.package-details-multicity') }}">Multi-City</a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li><a href="{{route('page.package')}}">Bangladesh</a></li>
                                            <li><a href="{{route('page.package')}}">Umrah</a></li>
                                            <li><a href="{{route('page.package')}}">Hajj</a></li>
                                            <li><a href="{{route('page.contact-us')}}">Contact</a></li>
                                            <li><a href="#">Webmail</a></li>
                                        </ul>
                                    </div>
                                </nav>
                                <!-- Main Menu End-->
                            </div>
                            <div class="header-account flex align-center">
                                <div class="register">
                                    <ul class="flex align-center">
                                        <li>
                                            @if (Route::has('login'))
                                                @auth
                                                    <a href="{{ url('/dashboard') }}" class="flex-three">
                                                        <img src="{{ asset('public/frontend/images/page/avata.jpg') }}" alt="User Avatar" class="rounded-circle" width="30" height="30">
                                                    </a>
                                                @else
                                                    <a href="{{ route('login') }}">
                                                        <i class="icon-user-1-1"></i>
                                                        <span>Sign in</span>
                                                    </a>

                                                    @if (Route::has('register'))
                                                        {{-- <a href="{{ route('register') }}">Register</a> --}}
                                                    @endif
                                                @endauth
                                            @endif
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="{{ asset('public/frontend') }}/images/page/fl1.png" alt="" class="fly-ab">
        </div>
    </div>

    <!-- End Header Lower -->
    <a href="#" class="header-sidebar flex-three" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
        <i class="icon-Bars"></i>
    </a>

    <!-- Mobile Menu  -->
    <div class="close-btn"><span class="icon flaticon-cancel-1"></span></div>
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <nav class="menu-box">
            <div class="nav-logo">
                <a href="index.html">
                    <img src="{{ asset('public') }}/images/logo.png" alt="Logo">
                </a>
            </div>
            <div class="bottom-canvas">
                <div class="menu-outer"></div>
            </div>
        </nav>
    </div>
    <!-- End Mobile Menu -->

</header>
<!-- End Main Header -->
