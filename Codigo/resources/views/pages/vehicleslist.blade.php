@extends('layouts.standard')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/vehiclelist.css') }}" type="text/css">
    <script src="{{ url('/assets/js/sorttable.js') }}"></script> <!-- To sort table by headers -->
@endsection

@section('content')
<div class="container-fluid">
    <div id="main" class="row">
        <div class="col-12">

            <div id="filtros">
                <div id="filtro-placa" class="col-2">
                    <label>Placa</label>
                    <label for="inputPlaca"></label>
                    <input type="text" class="form-control" id="inputPlaca" placeholder="Placa">
                </div>    
                <div id="filtro-portaria" class="col-2">
                    <label>Portaria</label>
                    <select class="form-select">
                        <option selected>Selecione</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div id="filtro-porteiro" class="col-2">
                    <label>Porteiro</label>
                    <select class="form-select">
                        <option selected>Selecione</option>
                        <option value="1">João</option>
                        <option value="2">José</option>
                    </select>
                </div>
                <div id="filtro-avancado" class="col-2">
                    <button class="btn btn-secondary mb-2"><i id="action" class="fas fa-filter"></i></button>
                </div>
                <div id="filtro-buscar" class="col-1">
                    <button class="btn btn-secondary mb-2"><i id="action" class="fas fa-search"></i>Buscar</button>
                </div>
            </div>

            <div id="tabela" class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center align-items-center w-100">
                        <table class="table table-dark sortable">
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
                            <tbody>
                                <tr>
                                    <td scope="row">AAA-1111</th>
                                    <td>Ford Ka</td>
                                    <td>Vermelho</td>
                                    <td>1</td>
                                    <td>Porteiro x</td>
                                    <td>05:45</td>
                                    <td>06:30</td>
                                    <td>
                                        <button lass="btn btn-secondary"><i id="action" class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection