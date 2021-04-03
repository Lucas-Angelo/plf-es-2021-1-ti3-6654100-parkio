@extends('layouts.login')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/login.css') }}" type="text/css"><script src="{{ url('/assets/css/login.css') }}"></script>
@endsection

@section('content')
<!--
<div id="container_fluid" class="container-fluid">
    <div id="main_img">
        <img style="float:right;" src="/assets/img/park.jpeg" alt="park">
    </div>
<form>
    <div id="all_form">
        <div id="input_form" class="form-group">
            <input type="user" id="input" placeholder="Usuário">
            <img src="/assets/img/user.jpeg" alt="user" id="input_img">
            <input type="password" id="input" placeholder="Senha">
            <img src="/assets/img/password.jpeg" alt="password" id="input_img">
        </div>
</form>
        <div id="access" class="col-2 desktop">
            <button class="btn btn-secondary desktop"></i><b>Entrar</b></button>
        </div>
</div>
-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-4">
            Login <br> Senha
        </div>
        <div class="d-none d-md-inline col-0 col-md-8">
            Imagem
        </div>
    </div>
</div>
@endsection