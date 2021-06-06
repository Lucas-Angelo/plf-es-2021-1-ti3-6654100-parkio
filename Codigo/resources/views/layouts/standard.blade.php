<!DOCTYPE html>
<html lang="pt-br">
<!-- Places content from /resources/views/includes/head.php -->
@include('includes.head')
<body>
    <!-- Places content from /resources/views/includes/header.php -->
    @include('includes.header')

    <!-- Will be replaced with file content from pages folder /resources/views/pages -->
    <div class="{{($colormode == 'light') ? 'parkio-light': 'parkio-dark'}}">
        @yield('content')
    </div>

    @include('includes.toast')

</body>
</html>