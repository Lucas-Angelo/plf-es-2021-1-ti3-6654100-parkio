@extends('layouts.standard')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/menu.css') }}" type="text/css">
@endsection

@section('content')
<div class="container-fluid p-4">
    <div class="row gate d-none">
        <div class="col-12">
            Portarias
        </div>
        <div class="col-12 py-3 px-5 rounded menu-container">
            <div class="row gate-items">
                
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            Menu
        </div>
        <div class="col-12 py-3 px-5 rounded menu-container">
            <div class="row">
                <a href="/vehiclelist" class="col-12 col-sm-6 col-lg-2 menu-container-item rounded text-decoration-none d-none" id="btnList">
                    <div class="px-3 py-2">
                        <i class="far fa-list-alt menu-icon d-block text-center"></i>
                        <p class="w-100 d-block text-center">Lista De Veículos</p>
                    </div>
                </a>
                <a href="/userlist" class="col-12 col-sm-6 col-lg-2 menu-container-item rounded text-decoration-none d-none" id="btnUsers">
                    <div class="px-3 py-2">
                        <i class="far fa-user-circle menu-icon d-block text-center"></i>
                        <p class="w-100 d-block text-center">Usuários</p>
                    </div>
                </a>
                <a href="/admin" class="col-12 col-sm-6 col-lg-2 menu-container-item rounded text-decoration-none d-none" id="btnConfig">
                    <div class="px-3 py-2">
                        <i class="fas fa-cogs menu-icon d-block text-center"></i>
                        <p class="w-100 d-block text-center">Configurações</p>
                    </div>
                </a>
                <div class="col-12 col-sm-6 col-lg-2 menu-container-item rounded text-decoration-none" id="btnLogout">
                    <div class="px-3 py-2">
                        <i class="fas fa-sign-out-alt menu-icon d-block text-center"></i>
                        <p class="w-100 d-block text-center">Sair</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ url('/assets/js/menu.js') }}"></script>
@endsection
