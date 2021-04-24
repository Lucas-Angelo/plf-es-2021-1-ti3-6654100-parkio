@extends('layouts.standard')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/userlist.css') }}" type="text/css">
    <script src="{{ url('/assets/js/userlist.js') }}"></script>
    <script src="{{ url('/assets/js/sorttable.js') }}"></script> <!-- To sort table by headers -->
@endsection

@section('pagename')
    Usuários
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-0 m-0">
            <div id="novo">
                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalNovoUsuario"><i class="fas fa-plus"></i>Novo Usuário</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 p-0 m-0">
            <div id="tabela-usuario">
                <table class="table sortable">
                    <colgroup>
                        <col span="1" style="width: 45%;">
                        <col span="1" style="width: 20%;">
                        <col span="1" style="width: 20%;">
                        <col span="1" style="width: 15%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Usuário</th>
                            <th>Tipo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    </tbody>
                </table>
            </div>
            <div id="lista-usuario">
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalNovoUsuario" tabindex="-1" aria-labelledby="modalNovoUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title" id="modalNovoUsuarioLabel">Criar Novo Usuário</h5>
                </div>
                <div class="modal-body justify-content-center">
                    <form onSubmit="handleEntranceFormSubmit(event)" id="cadastro" class="justify-content-center">
                        <div class="mb-3">
                            <label for="input-name" class="form-label">Nome</label>
                            <input for="input-name" type="text" class="form-control" id="input-name">
                        </div>
                        <div class="mb-3">
                            <label for="input-user" class="form-label">Usuário</label>
                            <input for="input-user" type="text" class="form-control" id="input-user">
                        </div>
                        <div class="mb-3">
                            <label for="input-password" class="form-label">Senha</label>
                            <input for="input-password" type="password" class="form-control" id="input-password">
                        </div>
                        <div class="mb-3">
                            <label for="input-type" class="form-label">Tipo</label>
                            <select for="input-type" class="form-select" id="input-type">
                                <option selected></option>
                                <option value="A">Admin</option>
                                <option value="P">Porteiro</option>
                                <option value="R">Ronda</option>
                                <option value="S">Síndico</option>
                            </select>
                        </div>
                        <button id="close-modal" type="button" class="btn btn-secondary d-none" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary w-100 mt-2 mb-3">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection