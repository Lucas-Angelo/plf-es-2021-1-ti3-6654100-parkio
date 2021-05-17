@extends('layouts.standard')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/vehiclelist.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/assets/css/select2.css') }}" type="text/css">
    <script src="{{ url('/assets/js/sorttable.js') }}"></script> <!-- To sort table by headers -->
    <script src="{{ url('assets/js/select2.min.js') }}"></script>
    <script src="{{ url('/assets/js/vehiclelist.js') }}"></script>
@endsection

@section('pagename')
    Lista de Veículos
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
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
                        <button class="btn btn-secondary d-block" disabled><i class="fas fa-filter botoes"></i><b class="d-inline d-md-none">Filtro Avançado</b></button>
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
                                    <th scope="col">Porteiro de Entrada</th>
                                    <th scope="col">Porteiro de Saída</th>
                                    <th scope="col">Hora de Entrada</th>
                                    <th scope="col">Hora de Saída</th>
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
                <form onSubmit="updateVehicle(event,${id})" class="row" id="visitorCategory-form">

                    <div class="mb-3 col-12">
                        <label for="input-plate" class="form-label">Placa<span class="required">*</span></label>
                        <input type="text"  value="${plate}" class="form-control" id="input-plate" autocomplete="false">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="input-time" class="form-label">Modelo</label>
                        <input type="text" value="${model?model:''}" min="0" class="form-control" id="input-model">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="vehiclelist-input-color" class="form-label d-block">Cor</label>
                        <select class="form-select d-block w-100" id="vehiclelist-input-color" >
                            <option value="a">valor1</option>
                            <option value="b">valor2</option>
                            <option value="c">valor3</option>
                            <option value="d">valor4</option>
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
<!--div class="modal fade" id="EditVehicleModal" tabindex="-1" aria-labelledby="EditVehicleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditVehicleModalLabel">Atualização de Veículo</h5>
                <button id="closeCategoryRegisterModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form onSubmit="handleVehicleEditFormSubmit(event)" class="row" id="visitorCategory-form">

                    <div class="mb-3 col-12">
                        <label for="input-plate" class="form-label">Placa<span class="required">*</span></label>
                        <input type="text" class="form-control" id="input-plate" autocomplete="false">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="input-time" class="form-label">Modelo</label>
                        <input type="text" min="0" class="form-control" id="input-model">
                    </div>
                    <div class="mb-3 col-12">
                        <label for="vehiclelist-input-color" class="form-label">Cor</label>
                        <select class="form-select d-block" id="vehiclelist-input-color">
                            <option selected value="">Indefinido</option>
                        </select>
                    </div>
                    

                    <div class="button-div text-center mt-3">
                        <button class="btn btn-secondary" type="submit">Atualizar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div-->
@endsection
