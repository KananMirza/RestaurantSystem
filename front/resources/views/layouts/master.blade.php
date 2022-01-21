<!DOCTYPE html>
<html lang="en">

@include('layouts.head')



<body>
<div id="preloader">
    <div data-loader="circle-side"></div>
</div><!-- /Page Preload -->

@include('layouts.header')
<main>@yield('content')</main>
<!-- /header -->



@include('layouts.footer')

@include('layouts.script')
</body>
