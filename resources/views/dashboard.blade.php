<x-app-layout>
    <div class="row mt-4">
        <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-danger">
                <div class="card-body p-4">
                    <a href="#">
                        <div class="media">
                            <span class="mr-3">
                                <i class="las la-users-cog"></i>
                            </span>
                            <div class="media-body text-white text-right">
                                <p class="mb-1">AD HOC Committee</p>
                                <h3 class="text-white">{{$add_hoc}}</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-primary">
                <div class="card-body  p-4">
                    <a href="#">
                        <div class="media">
                            <span class="mr-3">
                                <i class="las la-users-cog"></i>
                            </span>
                            <div class="media-body text-white text-right">
                                <p class="mb-1">Founder Members</p>
                                <h3 class="text-white">{{$executive}}</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-success">
                <div class="card-body p-4">
                    <a href="{{route('page.member-all')}}">
                        <div class="media">
                            <span class="mr-3">
                                <i class="la la-users"></i>
                            </span>
                            <div class="media-body text-white text-right">
                                <p class="mb-1">Total Member</p>
                                <h3 class="text-white">{{count($user)}}</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-secondary">
                <div class="card-body p-4">
                    <a href="#">
                        <div class="media">
                            <span class="mr-3">
                                <i class="la la-user"></i>
                            </span>
                            <div class="media-body text-white text-right">
                                <p class="mb-1">New Enrolled</p>
                                <h3 class="text-white">{{$enroll}}</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!---->
        <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-warning">
                <div class="card-body  p-4">
                    <a href="{{ route('dashboard-gallery.all')}}">
                    <div class="media">
                        <span class="mr-3">
                            <i class="lar la-image"></i>
                        </span>
                        <div class="media-body text-white">
                            <p class="mb-1">Gallery</p>
                            <h3 class="text-white">{{$gallery}}</h3>
                            <div class="progress mb-2 bg-secondary">
                                <div class="progress-bar progress-animated bg-light" style="width: 20%"></div>
                            </div>
                            <small>20% Increase in 30 Days</small>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-xxl-4 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-info">
                <div class="card-body p-4">
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
