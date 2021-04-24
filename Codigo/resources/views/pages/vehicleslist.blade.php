@extends('layouts.standard')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/vehiclelist.css') }}" type="text/css">
    <script src="{{ url('/assets/js/sorttable.js') }}"></script> <!-- To sort table by headers -->
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
                                    <th scope="col">Porteiro</th>
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
        </div>
    </div>
</div>
@endsection