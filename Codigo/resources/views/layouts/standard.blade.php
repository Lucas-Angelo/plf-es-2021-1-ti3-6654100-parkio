<!DOCTYPE html>
<html lang="pt-br">
<!-- Places content from /resources/views/includes/head.php -->
@include('includes.head')
<body>
    <!-- Places content from /resources/views/includes/header.php -->
    @include('includes.header')
    <!-- Will be replaced with file content from pages folder /resources/views/pages -->
    @yield('content')
</body>
</html>