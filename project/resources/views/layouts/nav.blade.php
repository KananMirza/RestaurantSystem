<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="bg-header-dark">
        <div class="content-header bg-white-10">
            <!-- Logo -->
            <a class="font-w600 text-white tracking-wide" href="{{ route('index') }}">
                            <span class="smini-visible">
                                R<span class="opacity-75">S</span>
                            </span>
                <span class="smini-hidden">
                                Restaurant<span class="opacity-75">System</span>
                            </span>
            </a>
            <!-- END Logo -->

            <!-- Options -->
            <div>
                <!-- Toggle Sidebar Style -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
                <a class="js-class-toggle text-white-75" data-target="#sidebar-style-toggler"
                   data-class="fa-toggle-off fa-toggle-on"
                   onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');"
                   href="javascript:void(0)">
                    <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                </a>
                <!-- END Toggle Sidebar Style -->

                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close"
                   href="javascript:void(0)">
                    <i class="fa fa-times-circle"></i>
                </a>
                <!-- END Close Sidebar -->
            </div>
            <!-- END Options -->
        </div>
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link active" href="{{ route('index') }}">
                        <i class="nav-main-link-icon fa fa-location-arrow"></i>
                        <span class="nav-main-link-name">Əsas Səhifə</span>

                    </a>
                </li>
                <li class="nav-main-heading">Menu</li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                       aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-user-lock"></i>
                        <span class="nav-main-link-name">Admin</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('getUsersList') }}">
                                <span class="nav-main-link-name"><i class="fas fa-users mr-2"></i>İstifadəçilər</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                       aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-cogs"></i>
                        <span class="nav-main-link-name">Nizamlamalar</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">

                            <a class="nav-main-link" href="{{ route('aboutIndex') }}">
                                <span class="nav-main-link-name"> <i class="fas fa-info-circle mr-2"></i>Haqqında</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('generalIndex') }}">
                                <span class="nav-main-link-name"><i class="fas fa-cog mr-2"></i>Ümumi</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('socialIndex') }}">
                                <span class="nav-main-link-name"><i class="fas fa-share-alt mr-2"></i>Sosial Şəbəkələr</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('contactIndex') }}">
                                <span class="nav-main-link-name"><i class="fas fa-phone-alt mr-2"></i>Əlaqə</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('sliderIndex') }}">
                                <span class="nav-main-link-name"><i class="far fa-image mr-2"></i>Slider</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                       aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-cookie-bite"></i>
                        <span class="nav-main-link-name">Yeməklər</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('getList') }}">
                                <span class="nav-main-link-name">Kateqoriyalar</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('viewList') }}">
                                <span class="nav-main-link-name">Yeməklər</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                       aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-users"></i>
                        <span class="nav-main-link-name">Müştərilər</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="#">
                                <span class="nav-main-link-name">Siyahı</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                       aria-expanded="false" href="#">
                        <i class="nav-main-link-icon fa fa-cart-arrow-down"></i>
                        <span class="nav-main-link-name">Sifarişlər</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{ route('orderAddView') }}">
                                <span class="nav-main-link-name">Sifariş Al</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('getWaitingOrder')}}">
                                <span class="nav-main-link-name">Gözləmədə <span style="font-weight: bold">({{ \App\Models\Order::where('status','5')->count() }})</span></span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('getAcceptingOrder')}}">
                                <span class="nav-main-link-name">Qəbul edilən <span style="font-weight: bold">({{ \App\Models\Order::where('status','4')->count() }})</span></span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('getPreparingOrder')}}">
                                <span class="nav-main-link-name">Hazırlanan <span style="font-weight: bold">({{ \App\Models\Order::where('status','3')->count() }})</span></span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('getOnWayOrder')}}">
                                <span class="nav-main-link-name">Yolda olan <span style="font-weight: bold">({{ \App\Models\Order::where('status','2')->count() }})</span></span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('getCompletedOrder')}}">
                                <span class="nav-main-link-name">Tamamlanan <span style="font-weight: bold">({{ \App\Models\Order::where('status','1')->count() }})</span></span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('getCancelOrder')}}">
                                <span class="nav-main-link-name">Ləğv Edilən <span style="font-weight: bold">({{ \App\Models\Order::where('status','0')->count() }})</span></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-main-link" href="{{ route('reservationIndex') }}">
                        <i class="nav-main-link-icon fas fa-clipboard"></i>
                        <span class="nav-main-link-name">Rezervasiyalar</span>
                    </a>

                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
