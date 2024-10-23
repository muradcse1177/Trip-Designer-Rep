<!doctype html>
<html lang="en">
@include('frontend.layout.header')
@yield('css')
<body>
@include('frontend.layout.navbar')
@yield('content')
@include('frontend.layout.footer')
@yield('js')
