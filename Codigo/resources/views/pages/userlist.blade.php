@extends('layouts.standard')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/userlist.css') }}" type="text/css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-0 m-0">
            <div id="novo">
                <button class="btn btn-secondary"><i class="fas fa-plus"></i>Novo Usuário</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 p-0 m-0">
            <div id="tabela-usuario">
                <table class="table">
                    <colgroup>
                        <col span="1" style="width: 45%;">
                        <col span="1" style="width: 20%;">
                        <col span="1" style="width: 20%;">
                        <col span="1" style="width: 15%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Tipo</th>
                            <th>Última vez visto</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lucas Ângelo</th>
                            <td>Porteiro</td>
                            <td>31/03/2021 09:00</td>
                            <td class="acoes">
                                <button class="btn btn-secondary"><i class="fas fa-lock"></i></button>
                                <button class="btn btn-secondary"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="lista-usuario">
                <div class="componente">
                    <button class="btn btn-secondary"><i class="fas fa-trash-alt"></i></button>
                    <button class="btn btn-secondary"><i class="fas fa-lock"></i></button>
                    <div class="usuario">
                        <h6>Usuário:</h6>
                        <p>Lucas Ângelo</p>
                    </div>
                    <div class="tipo">
                        <h6>Tipo:</h6>
                        <p>Porteiro</p>
                    </div>
                    <div class="ultima">
                        <h6>Última vez visto:</h6>
                        <p>31/03/2021 09:00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection