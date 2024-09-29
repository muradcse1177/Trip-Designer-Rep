<!doctype html>
<html lang="en">
@include('frontend.layout.header')
@yield('css')
<body>
<div class="loading" id="loading" style="display: none; text-align: center;">
    <img src="{{url('public/images/loading.gif')}}" width="200" height="20" style="margin-top: 15px;">
    <h5> We are processing<br> your request</h5>
    <p> Please wait...</p>
</div>
@include('frontend.layout.navbar')
@yield('content')
@include('frontend.layout.footer')
@yield('js')
