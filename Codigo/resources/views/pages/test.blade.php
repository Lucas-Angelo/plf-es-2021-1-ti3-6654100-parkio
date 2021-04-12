<!-- 
    PS:
    1 - All files must be ended with .blade.php
    2 - You must specify view path on /routes/web.php
    3 - If you need to upload css, js, img or fonts, they are located on /public/assets
    4 - You can write HTML on this page just like you would do on a normal html project, the commands started with an @ are used as helpers.
-->

<!-- This file is based on layout standard, located on /resources/views/layouts/standard.blade.php -->
@extends('layouts.standard')

<!--
    If you need to import extra assets, like js or css, you can put it down here, that it will be include on head tag.
    PS: Please create an individual css file for each page, DO NOT create stylesheets on this page or create any style straight on HTML tag.
-->
@section('extraassets')
    <!-- <script src="{{ url('/assets/ADD_EXCLUSIVE_PAGE_ASSETS_LIKE_THIS') }}"></script> -->
@endsection

<!--
    Everything inside this section will be replaced on yield('content') at /resources/views/layouts/standard.blade.php
-->
@section('content')
<div class="container-fluid">
    <h1>Hello</h1>
</div>
@endsection