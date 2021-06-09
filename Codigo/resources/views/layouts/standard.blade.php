<!DOCTYPE html>
<html lang="pt-br">
<!-- Places content from /resources/views/includes/head.php -->
@include('includes.head')
<body class="{{($colormode == 'light') ? 'parkio-light': 'parkio-dark'}}">
    <!-- Places content from /resources/views/includes/header.php -->
    @include('includes.header')

    <!-- Will be replaced with file content from pages folder /resources/views/pages -->
    <div>
        @yield('content')
    </div>

    @include('includes.toast')

</body>
</html>