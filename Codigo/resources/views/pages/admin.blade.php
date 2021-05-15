@extends('layouts.standard')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/visitorCategory.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/assets/css/admin.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/assets/css/entrace.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/assets/css/complain.css') }}" type="text/css">

@endsection

@section('pagename')
    Configurações
@endsection

@section('content')
<script src="{{ url('/assets/js/visitorCategory.js') }}"></script>
<script src="{{ url('/assets/js/entrace.js') }}"></script>
<script src="{{ url('/assets/js/complain.js') }}"></script>

<div class="container-fluid" id="admin">

</div>
    <div class="container-fluid">

        <button class="mobile-menu-button d-flex d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMenu" aria-expanded="false" aria-controls="collapseMenu">
            <i class="fas fa-align-justify"></i>Menu
        </button>
        <div class="collapse d-md-none" id="collapseMenu">
            <ul class="nav nav-tabs flex-column" id="adminMenuTab" role="tablist">
                <li class="admin-nav-item" role="presentation">
                    <button class="active" id="gates-tab" data-bs-toggle="tab" data-bs-target="#gates" type="button" role="tab" aria-controls="gates" aria-selected="true">Portarias</button>
                </li>
                <li class="admin-nav-item" role="presentation">
                    <button id="category-tab" data-bs-toggle="tab" data-bs-target="#category" type="button" role="tab" aria-controls="category" aria-selected="false">Categoria de Visitante</button>
                </li>
                <li class="admin-nav-item" role="presentation">
                    <button id="reported-tab" data-bs-toggle="tab" data-bs-target="#reported" type="button" role="tab" aria-controls="reported" aria-selected="false">Veículos Reportados</button>
                </li>
            </ul>
        </div>

        <div class="row">
            <aside class="menu col-3 d-none d-md-block">
                <ul class="nav nav-tabs flex-column" id="adminMenuTab" role="tablist">
                    <li class="admin-nav-title">
                        <i class="fas fa-align-justify"></i>Menu
                    </li>
                    <li class="admin-nav-item" role="presentation">
                        <button class="active" id="gates-tab" data-bs-toggle="tab" data-bs-target="#gates" type="button" role="tab" aria-controls="gates" aria-selected="true">Portarias</button>
                    </li>
                    <li class="admin-nav-item" role="presentation">
                        <button id="category-tab" data-bs-toggle="tab" data-bs-target="#category" type="button" role="tab" aria-controls="category" aria-selected="false">Categoria de Visitante</button>
                    </li>
                    <li class="admin-nav-item" role="presentation">
                        <button id="reported-tab" data-bs-toggle="tab" data-bs-target="#reported" type="button" role="tab" aria-controls="reported" aria-selected="false">Veículos Reportados</button>
                    </li>
                </ul>
            </aside>

            <main class="col-12 col-md-9 tab-content">
                <div class="tab-pane fade show active" id="gates" role="tabpanel" aria-labelledby="gates-tab">
                    <div class="row">
                        <div class="col-12 p-0 ms-0" id="newGateDivButton">
                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#CreateGateModal"><i class="fas fa-plus"></i> Nova Portaria</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-11 p-0 m-0">
                            <div id="tabela-gate" class="d-none d-md-block">
                                <table class="table sortable">
                                    <colgroup>
                                        <col span="1" style="width: 40%;">
                                        <col span="1" style="width: 40%;">
                                        <col span="1" style="width: 20%;">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>Identificação</th>
                                            <th>Criado em</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="gate-table-body">
                                    </tbody>
                                </table>
                            </div>
                            <div id="lista-gate" class="d-md-none mt-3">
                            </div>
                        </div>
                    </div>

                </div>

                <div id="category" class="tab-pane fade" role="tabpanel" aria-labelledby="category-tab">

                    <div class="row">
                        <div class="col-12 p-0 mt-md-0">
                            <div id="createGate">
                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#CreateCategoryModal"><i class="fas fa-plus"></i> Nova Categoria</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-11 p-0 m-0">
                            <div class="d-none d-md-block">
                                <table class="table sortable">
                                    <colgroup>
                                        <col span="1" style="width: 40%;">
                                        <col span="1" style="width: 40%;">
                                        <col span="1" style="width: 20%;">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Tempo Recomendado</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="category-table-body">
                                    </tbody>
                                </table>
                            </div>
                            <div id="lista-category" class="d-md-none mt-3">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade" id="reported" role="tabpanel" aria-labelledby="reported-tab">
                    <div class="row">
                        <div class="col-11 p-0 m-0">
                            <div class="d-none d-md-block">
                                <table class="table sortable">
                                    <colgroup>
                                        <col span="1" style="width: 20%;">
                                        <col span="1" style="width: 70%;">
                                        <col span="1" style="width: 10%;">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>Placa</th>
                                            <th>Motivo</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="complain-table-body">
                                    </tbody>
                                </table>
                            </div>
                            <div id="lista-complain" class="d-md-none mt-3">
                            </div>
                        </div>
                    </div>
                </div>



            </main>
        </div>


        <!--Modais-->
        <div class="modal fade" id="CreateCategoryModal" tabindex="-1" aria-labelledby="CreateCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="CreateCategoryModalLabel">Cadastro de Categoria de Visitantes</h5>
                        <button id="closeCategoryRegisterModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form onSubmit="handleVisitorCategoryFormSubmit(event)" class="row" id="visitorCategory-form">
                            <input type="number" class="d-none" value="" id="categoryId">
                            <div class="mb-3 col-12">
                                <label for="input-description" class="form-label">Descrição<span class="required">*</span></label>
                                <input type="text" class="form-control" id="input-description" required autocomplete="false">
                            </div>
                            <div class="mb-3 col-12">
                                <label for="input-time" class="form-label">Tempo padrão (minutos)<span class="required">*</span></label>
                                <input type="number" min="0" class="form-control" id="input-time" required>
                            </div>

                            <div class="button-div text-center mt-3">
                                <button class="btn" type="submit">Cadastrar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="CreateGateModal" tabindex="-1" aria-labelledby="CreateGateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="CreateGateModalLabel">Cadastro de Portaria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form onSubmit="handleGateFormSubmit(event)" class="row align-items-center justify-content-center" id="gate-form" novalidate>

                            <div class="mb-3 col-12 col-lg-12 d-none">
                                <label for="gateId" class="form-label">Id</label>
                                <input type="text" class="form-control" value="" id="gateId" required autocomplete="false">
                            </div>

                        <div class="mb-3 col-12 col-lg-12">
                                <label for="gate-description" class="form-label">Descrição<span class="required">*</span></label>
                                <input type="text" class="form-control" id="gate-description" required autocomplete="false">
                            </div>

                            <div class="button-div text-center mt-3">
                            <button class="btn" type="submit">Cadastrar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>
            var ModalVisitors = new bootstrap.Modal(document.getElementById('CreateCategoryModal'));
        </script>

    </div>
@endsection
