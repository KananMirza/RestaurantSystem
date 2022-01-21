<header class="header clearfix element_to_stick">
    <div class="layer"></div><!-- Opacity Mask Menu Mobile -->
    <div class="container-fluid">
        <div id="logo">
            <a href="index.html">
                <img src="{{asset('assets/img/logo.svg')}}" width="140" height="35" alt="" class="logo_normal">
                <img src="{{asset('assets/img/logo_sticky.svg')}}" width="140" height="35" alt="" class="logo_sticky">
            </a>
        </div>
        <ul id="top_menu">
            <li><a href="#0" class="search-overlay-menu-btn"></a></li>
            <li>
                <div class="dropdown dropdown-cart">
                    <a href="shop-cart.html" class="cart_bt"><strong>2</strong></a>
                </div>
                <!-- /dropdown-cart-->
            </li>
        </ul>
        <!-- /top_menu -->
        <a href="#0" class="open_close">
            <i class="icon_menu"></i><span>Menu</span>
        </a>
        <nav class="main-menu">
            <div id="header_menu">
                <a href="#0" class="open_close">
                    <i class="icon_close"></i><span>Menu</span>
                </a>
                <a href="index.html"><img src="{{asset('assets/img/logo.svg')}}" width="140" height="35" alt=""></a>
            </div>
            <ul>
                <li class="submenu">
                    <a href="#0" class="show-submenu">Home</a>
                </li>
                <li class="submenu">
                    <a href="{{route('menuIndex')}}" class="show-submenu">Menu</a>

                </li>
                <li class="submenu">
                    <a href="#0" class="show-submenu">Other Pages</a>
                    <ul>
                        <li><a href="about.html">About</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="gallery.html">Gallery</a></li>
                        <li><a href="gallery-2.html">Gallery Masonry</a></li>
                        <li><a href="modal-advertise.html">Modal Advertise</a></li>
                        <li><a href="modal-newsletter.html">Modal Newsletter</a></li>
                        <li><a href="404.html">404 Error page</a></li>
                        <li><a href="coming-soon.html" target="_blank">Coming Soon</a></li>
                        <li><a href="leave-review.html">Leave a review</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="icon-pack-1.html">Icon Pack 1</a></li>
                        <li><a href="icon-pack-2.html">Icon Pack 2</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#0" class="show-submenu">Shop</a>
                    <ul>
                        <li><a href="shop-1.html">Shop Grid</a></li>
                        <li><a href="shop-2.html">Shop Rows</a></li>
                        <li><a href="shop-single.html">Product Single</a></li>
                        <li><a href="shop-cart.html">Cart Page</a></li>
                        <li><a href="shop-checkout.html">Checkout</a></li>
                    </ul>
                </li>
                <li><a href="#0">Buy this template</a></li>
                <li><a href="{{ route('reservIndex') }}" class="btn_top">Reservations</a></li>
            </ul>
        </nav>
    </div>
    <!-- Search -->
    <div class="search-overlay-menu">
        <span class="search-overlay-close"><span class="closebt"><i class="icon_close"></i></span></span>
        <form role="search" id="searchform" method="get">
            <input value="" name="q" type="search" placeholder="Search..." />
            <button type="submit"><i class="icon_search"></i></button>
        </form>
    </div><!-- End Search -->
</header>
