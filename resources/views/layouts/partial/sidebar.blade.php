    <!--**********************************
                Sidebar start
    ***********************************-->
    <div class="deznav scrollbar">
        <div class="main-profile">
            <div class="image-bx">
                <img src="{{asset('public')}}/images/profile/{{ Auth::user()->profile_photo_path }}" alt="">
                <a href="javascript:void(0);"><i class="fa fa-cog" aria-hidden="true"></i></a>
            </div>
            <h5 class="name">{{Auth::user()->name}}</h5>
            <p class="email"><a href="mailto:<nowiki> {{Auth::user()->email}}" class="__cf_email__">[{{Auth::user()->email}}]</a></p>
        </div>
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a href="{{ route('dashboard') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-144-layout"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            @canany('Member', 'Student Member', 'Candidate Member', 'Professional Member', 'Associate Member', 'Trade Member', 'Corporate Member')
            <li>
                <a href="{{ route('dashboard-gallery.all')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-picture"></i><span class="nav-text">Gallery</span>
                </a>
            </li>
            @endcanany

            <li>
                <a href="{{ route('dashboard-gallery.all')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-picture"></i><span class="nav-text">Continent</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard-gallery.all')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-picture"></i><span class="nav-text">Gallery</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard-gallery.all')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-picture"></i><span class="nav-text">Gallery</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard-gallery.all')}}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-picture"></i><span class="nav-text">Notice & News</span>
                </a>
            </li>

            @canany('Post menu access')
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-pad"></i>
                    <span class="nav-text">Web Post</span>
                </a>
                <ul aria-expanded="false">
                    @canany('Blog access','Blog create','Blog edit','Blog delete')
                        <li><a href="{{ Route('blog.index')}}">Notice & News</a></li>
                    @endcanany
                    @canany('Gallery access','Gallery create','Gallery edit','Gallery delete')
                        <li><a href="{{ Route('gallery.index')}}">Photo Gallery</a></li>
                    @endcanany
                </ul>
            </li>
            @endcanany

            @canany('Setting menu access')
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-settings-2"></i>
                    <span class="nav-text">Setting</span>
                </a>
                <ul aria-expanded="false">
                    @canany('Contact access','Contact reply', 'Contact delete')
                    <li><a href="{{route('contact-us.index')}}">Contact Us</a></li>
                    @endcanany

                    @canany('Role access','Role create','Role edit','Role delete')
                        <li><a href="{{ route('roles.index') }}">Manage Role</a></li>
                    @endcanany

                    @canany('User access','User create','User edit','User delete')
                    <li><a href="{{ Route('users.index')}}">Manage User</a></li>
                    @endcanany

                </ul>
            </li>
            @endcanany

        </ul>
        <div class="copyright py-4 my-4">
            <p><strong></strong><!-- © 2023 All Rights Reserved--></p>
            <p class="fs-12">Made with <span class="heart"></span> by <a href="#"><br><img src="{{asset('public')}}/made-logo.png" alt="" height="50"></a></p>
        </div>
    </div>

    <!--**********************************
                Sidebar end
    ***********************************-->
