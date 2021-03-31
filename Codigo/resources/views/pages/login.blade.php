@extends('layouts.standard')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/login.css') }}" type="text/css"><script src="{{ url('/assets/css/login.css') }}"></script>
@endsection

@section('content')
<div id="container_fluid" class="container-fluid">
    <div id="main">
        <img style="float:right;" src="/assets/img/park.jpeg" alt="park">
    </div>
<form>
    <div id="all_form" style="width:75%; background-color:white;">
        <div id="input_form" class="form-group">
            <input type="user" id="input" placeholder="Usuário">
            <img src="/assets/img/user.jpeg" alt="user" id="input_img">
        </div>
            <input type="password" id="input" placeholder="Senha">
            <img src="/assets/img/password.jpeg" alt="password" id="input_img">
        <div id="access" class="col-4 desktop">
            <button class="btn btn-secondary desktop"></i><b>Entrar</b></button>
        </div>
    </div>
</form>
</div>
@endsection