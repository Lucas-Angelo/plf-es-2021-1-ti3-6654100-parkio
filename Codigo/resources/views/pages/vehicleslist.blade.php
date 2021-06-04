@extends('layouts.standard')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/vehiclelist.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/assets/css/select2.css') }}" type="text/css">
    <script src="{{ url('/assets/js/sorttable.js') }}"></script> <!-- To sort table by headers -->
    <script src="{{ url('/assets/js/vehiclelist.js') }}"></script>
    <script src="{{ url('assets/js/select2.min.js') }}"></script>
@endsection

@section('pagename')
    Lista de Veículos
@endsection

@section('content')
<div class="container-fluid">

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div id="sideTitle" class="d-flex justify-content-center">
            <i class="fas fa-filter"></i><label>&nbsp;</label><b>Filtro Avançado</b>
        </div>
        <form>
            <div class="mb-3">
                <label for="advancedInputPlate" class="form-label">Placa</label>
                <input class="form-control" id="advancedInputPlate" maxlength="8">
            </div>
            <div class="mb-3">
                <label for="advancedInputModel" class="form-label">Modelo</label>
                <input class="form-control" id="advancedInputModel" maxlength="80">
            </div>
            <div class="mb-3">
                <label for="input-color" class="form-label d-block">Cor</label>
                <select class="gate-inputcolor form-select" id="input-color">
                    <option selected value="0">Indefinido</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="advancedInputName" class="form-label">Nome do Condutor</label>
                <input class="form-control" id="advancedInputName" maxlength="255">
            </div>
            <div class="mb-3">
                <label for="advancedInputNameUserIn" class="form-label">Porteiro</label>
                <select id="advancedInputNameUserIn" class="form-select">
                    <option value="0" selected>Selecione</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="advancedInputGate" class="form-label">Portaria</label>
                <select id="advancedInputGate" class="form-select">
                    <option value="0" selected>Selecione</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="advancedInputDateIn" class="form-label">Entraram no dia</label>
                <input type="date" class="form-control" id="advancedInputDateIn">
            </div>
            <div class="mb-4">
                <label for="advancedInputDateOut" class="form-label">Sairam no dia</label>
                <input type="date" class="form-control" id="advancedInputDateOut">
            </div>
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4 py-2" id="advancedBtnFilter">
                    <b class="d-inline">Filtrar</b>
                </button>
            </div>
        </form>
    </div>

    <div id="main" class="row">
        <div class="col-12 offset-0 col-md-10 offset-md-1">
            <div class="row g-3">
                <div class="col d-none d-md-inline">
                    <label for="txtPlateFilter">Placa</label>
                    <input type="text" class="form-control" id="txtPlateFilter" placeholder="Placa" maxlength="8">
                </div>
                <div class="col d-none d-md-inline">
                    <label>Portaria</label>
                    <select id="gate" class="form-select">
                        <option value="0" selected>Selecione</option>
                    </select>
                </div>
                <div class="col d-none d-md-inline">
                    <label>Porteiro</label>
                    <select id="user_in" class="form-select">
                        <option value="0" selected>Selecione</option>
                    </select>
                </div>
                <div class="col">
                    <div id="filtro-avancado">
                        <label>&nbsp;</label>
                        <button class="btn btn-secondary d-block" onclick="openNav()"><i class="fas fa-filter botoes"></i><b class="d-inline d-md-none">Filtro Avançado</b></button>
                    </div>
                </div>
                <div class="col d-none d-md-inline">
                    <div class="float-end">
                        <label>&nbsp;</label>
                        <button id="btnFilter" class="btn btn-secondary d-none d-md-block">
                            <i class="fas fa-search botoes d-inline"></i>
                            <b class="d-inline">Buscar</b>
                        </button>
                    </div>
                </div>
            </div>
            <div id="tabela" class="row mt-3">
                <div class="col-12">
                    <div class="d-none d-md-inline">
                        <table id="tabela-veiculo" class="table table-dark sortable">
                            <thead>
                                <tr>
                                    <th scope="col">Placa</th>
                                    <th scope="col">Modelo</th>
                                    <th scope="col">Cor</th>
                                    <th scope="col">Portaria</th>
                                    <th scope="col">Porteiro Entrada</th>
                                    <th scope="col">Porteiro Saída</th>
                                    <th scope="col">Tempo</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                            </tbody>
                        </table>
                    </div>
                    <div id="lista-veiculo" class="d-inline d-md-none">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul class="vehiclelist-pagination pagination float-end">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modais-->
<div id="modalEdit"></div>
<div class="modal fade" id="EditVehicleModal" tabindex="-1" aria-labelledby="EditVehicleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditVehicleModalLabel">Atualizar Dados do Veículo ${plate}</h5>
                <button id="closeEditVehicleModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" id="visitorCategory-form">

                    <div class="mb-3 col-12">
                        <label for="input-plate" class="form-label">Placa<span class="required">*</span></label>
                        <input minlength="7" maxlength="8" type="text" class="form-control" id="input-plate" autocomplete="false" required>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="input-time" class="form-label">Modelo</label>
                        <input type="text" min="0" class="form-control" id="input-model" minlength="1" maxlength="80" required>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="vehiclelist-input-color" class="form-label d-block">Cor</label>
                        <select class="form-select" id="vehiclelist-input-color">
                            <option value="">Indefinido</option>
                        </select>
                    </div>


                    <div class="button-div text-center mt-3">
                        <button class="btn btn-secondary" type="submit">Atualizar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

