<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div>
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button type="button" class="btn btn-dual" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <!-- END Toggle Sidebar -->

            <!-- Open Search Section -->
{{--            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->--}}
{{--            <button type="button" class="btn btn-dual" data-toggle="layout" data-action="header_search_on">--}}
{{--                <i class="fa fa-fw fa-search"></i> <span class="ml-1 d-none d-sm-inline-block">Search</span>--}}
{{--            </button>--}}
{{--            <!-- END Open Search Section -->--}}
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div>
            <!-- User Dropdown -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-user d-sm-none"></i>
                    <span class="d-none d-sm-inline-block">{{ Auth::user()->name }}</span>
                    <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                    <div class="bg-primary rounded-top font-w600 text-white text-center p-3">
                        {{ \App\Http\Controllers\General\General::getRoleName() }}
                    </div>
                    <div class="p-2">
                        <a class="dropdown-item" href="{{ route('myProfile') }}">
                            <i class="far fa-fw fa-user mr-1"></i> Profil
                        </a>
                        <div role="separator" class="dropdown-divider"></div>

                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i>Çıxış Et</a>
                    </div>
                </div>
            </div>
            <!-- END User Dropdown -->

            <!-- Notifications Dropdown -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn btn-dual" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-shopping-basket"></i>
                    <span class="badge badge-secondary badge-pill card-count">0</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="bg-primary rounded-top font-w600 text-white text-center p-3">
                        Səbət
                    </div>
                    <ul class="nav-items my-2">
                        <li style="text-align: center">
                            Səbət Boşdur !
                        </li>
                    </ul>
                    <div class="p-2 border-top">
                        <a class="btn btn-light btn-block text-center" href="javascript:void(0)" onclick="viewAll()">
                            <i class="fa fa-fw fa-eye mr-1"></i> View All
                        </a>
                    </div>
                </div>
            </div>
            <!-- END Notifications Dropdown -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

{{--    <!-- Header Search -->--}}
{{--    <div id="page-header-search" class="overlay-header bg-header-dark">--}}
{{--        <div class="bg-white-10">--}}
{{--            <div class="content-header">--}}
{{--                <form class="w-100" action="#" method="POST">--}}
{{--                    <div class="input-group">--}}
{{--                        <div class="input-group-prepend">--}}
{{--                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->--}}
{{--                            <button type="button" class="btn btn-alt-primary" data-toggle="layout" data-action="header_search_off">--}}
{{--                                <i class="fa fa-fw fa-times-circle"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <input type="text" class="form-control border-0" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- END Header Search -->--}}

    <!-- Header Loader -->
    <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-header-dark">
        <div class="bg-white-10">
            <div class="content-header">
                <div class="w-100 text-center">
                    <i class="fa fa-fw fa-sun fa-spin text-white"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>
