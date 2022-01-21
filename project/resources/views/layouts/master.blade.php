<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<body>
<div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
    @include('layouts.nav')
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
</div>
@include('layouts.scripts')
<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>
</body>
</html>
