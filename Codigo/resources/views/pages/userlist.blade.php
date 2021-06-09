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
    <div class="row mt-3">
        <div class="col-12 p-0 m-0">
            <button id="btn-NovoUsuario" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalNovoUsuario"><i class="fas fa-plus"></i>&nbsp;Novo Usuário</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 p-0 m-0">
            <div id="tabela-usuario">
                <table class="table sortable {{ ($colormode == 'light')? '': 'table-dark'}}">
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
                            <label for="input-name" class="form-label">Nome <span class="required">*</span></label>
                            <input for="input-name" type="text" class="form-control" id="input-name" minlength="1" maxlength="255" required>
                        </div>
                        <div class="mb-3">
                            <label for="input-user" class="form-label">Usuário <span class="required">*</span></label>
                            <input for="input-user" type="text" class="form-control" id="input-user" minlength="1" maxlength="40" required>
                        </div>
                        <div class="mb-3">
                            <label for="input-password" class="form-label">Senha <span class="required">*</span></label>
                            <input for="input-password" type="password" class="form-control" id="input-password" minlength="1" maxlength="32" required>
                        </div>
                        <div class="mb-3">
                            <label for="input-type" class="form-label">Tipo <span class="required">*</span></label>
                            <select for="input-type" class="form-select" id="input-type" required>
                                <option selected></option>
                                <option value="A">Admin</option>
                                <option value="P">Porteiro</option>
                                <option value="R">Ronda</option>
                                <option value="S">Síndico</option>
                            </select>
                        </div>
                        <button id="close-modal" type="button" class="btn btn-secondary d-none" data-bs-dismiss="modal">Close</button>
                        <button id="btn-cadastrar" type="submit" class="btn btn-primary w-100 mt-2 mb-3">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="trocarSenha" tabindex="-1" aria-labelledby="trocarSenhaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title" id="trocarSenhaLabel">Trocar senha do usuário: </h5>
                </div>
                <div class="modal-body justify-content-center">
                    <form onSubmit="handleChangePassFormSubmit(event)" id="trocaSenha" class="justify-content-center">
                        <input id="idUserPass" class="d-none">
                        <div class="mb-3">
                            <label for="novaSenha" class="form-label">Senha <span class="required">*</span></label>
                            <input for="novaSenha" type="password" class="form-control" id="novaSenha" required>
                        </div>
                        <button id="close-modal-np" type="button" class="btn btn-secondary d-none" data-bs-dismiss="modal">Close</button>
                        <button id="btn-trocaSenha" type="submit" class="btn btn-secondary w-100 mt-2 mb-3">Trocar senha</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

