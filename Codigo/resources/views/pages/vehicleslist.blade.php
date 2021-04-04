@extends('layouts.standard')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/vehiclelist.css') }}" type="text/css">
    <script src="{{ url('/assets/js/sorttable.js') }}"></script> <!-- To sort table by headers -->
    <script src="{{ url('/assets/js/vehiclelist.js') }}"></script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row gx-5">
        <div class="col-12 offset-0 col-md-10 offset-md-1">
            <div id="filtros" class="row g-3">
                <div class="col d-none d-md-inline">
                    <label for="txtPlateFilter">Placa</label>
                    <input type="text" class="form-control" id="txtPlateFilter" placeholder="Placa">
                </div>
                <div class="col d-none d-md-inline">
                    <label>Portaria</label>
                    <select class="form-select">
                        <option selected>Selecione</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div class="col d-none d-md-inline">
                    <label>Porteiro</label>
                    <select class="form-select">
                        <option selected>Selecione</option>
                        <option value="1">João</option>
                        <option value="2">José</option>
                    </select>
                </div>
                <div class="col">
                    <div id="filtro-avancado">
                        <label>&nbsp;</label>
                        <button class="btn btn-secondary d-block"><i class="fas fa-filter botoes"></i><b class="mobile">Filtro Avançado</b></button>
                    </div>
                </div>
                <div class="col d-none d-md-inline">
                    <div class="float-end">
                        <label>&nbsp;</label>
                        <button class="btn btn-secondary desktop d-block">
                            <i class="fas fa-search botoes d-inline"></i>
                            <b class="d-inline">Buscar</b>
                        </button>
                    </div>
                </div>
            </div>
            <div id="tabela" class="row mt-3">
                <div class="col-12">
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
                    <div id="lista-veiculo">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection