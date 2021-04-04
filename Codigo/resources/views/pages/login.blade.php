@extends('layouts.login')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/login.css') }}" type="text/css"><script src="{{ url('/assets/css/login.css') }}"></script>
@endsection

@section('content')
<div id="main" class="container-fluid">

    <div id="row" class="row">

            <div id="form" class="col-12 col-md-0" form="cadastro">

                    <h1 class="login">Log in</h1>
                    
                <div id="user" class="inputWithIcon">
                    <input type="text" placeholder="Usuário">
                    <i class="fas fa-user-circle"></i>
                </div>

                <div id="pass" class="inputWithIcon">
                    <input type="text" placeholder="Senha">
                    <i class="fas fa-lock"></i>
                </div>

                <button class="btn1" type="submit" form="cadastro" >Entrar</button>

            </div>


            <div class="main_img" class="d-none d-md-inline col-0 col-md-8">
                <img class="park" src="/assets/img/park.jpeg" alt="park" height=100%>
                <img class="parkio" src="/assets/img/parkiowhite.png" alt="parkio">
            </div>



    </div>
</div>
@endsection