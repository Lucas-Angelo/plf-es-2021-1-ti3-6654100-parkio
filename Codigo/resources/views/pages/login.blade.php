@extends('layouts.login')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/login.css') }}" type="text/css"><script src="{{ url('/assets/css/login.css') }}"></script>
@endsection

@section('content')
<div class="container-fluid p-0">

    <div id="main_img_mobile" class="d-md-none col-12 p-0">
            <img class="park_mobile" src="/assets/img/park.jpeg" alt="park">
            <img class="parkio_mobile" src="/assets/img/parkiowhite.png" alt="parkio">
            <div class="parkCover"></div>
    </div>

        <div id="line" class="row">

            <div class="col-12 col-md-4 p-0" form="cadastro">
                
                <div id="form">
                    <h1 class="login">Log in</h1>  
                    <div class="row">
                        <div class="col-12">
                            <div id="user" class="inputWithIcon">
                                <input type="text" placeholder="Usuário">
                                <i class="fas fa-user-circle"></i>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <div id="pass" class="inputWithIcon">
                                <input type="text" placeholder="Senha">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <button class="btn btn-secondary" type="submit" form="cadastro" >Entrar</button>
                        </div>
                    </div>

                </div>

            </div>

            <div id="main_img" class="d-none d-md-inline col-0 col-md-8 p-0">
                <img class="park" src="/assets/img/park.jpeg" alt="park">
                <img class="parkio" src="/assets/img/parkiowhite.png" alt="parkio">
                <div class="parkCover"></div>
            </div>

        </div>

</div>

@endsection