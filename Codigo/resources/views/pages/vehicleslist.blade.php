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
                <div id="placa" class="col-3 desktop">
                    <label>Placa</label>
                    <label for="inputPlaca"></label>
                    <input type="text" class="form-control" id="inputPlaca" placeholder="Placa">
                </div>    
                <div id="portaria" class="col-3 desktop">
                    <label>Portaria</label>
                    <select class="form-select">
                        <option selected>Selecione</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div id="porteiro" class="col-3 desktop">
                    <label>Porteiro</label>
                    <select class="form-select">
                        <option selected>Selecione</option>
                        <option value="1">João</option>
                        <option value="2">José</option>
                    </select>
                </div>
                <div id="filtro-avancado" class="col-2">
                    <button class="btn btn-secondary"><i class="fas fa-filter botoes"></i><b class="mobile">Filtro Avançado</b></button>
                </div>
                <div id="buscar" class="col-1 desktop">
                    <button class="btn btn-secondary desktop"><i class="fas fa-search botoes"></i><b>Buscar</b></button>
                </div>
            </div>

            <div id="tabela" class="row">
                <div class="col-12">
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
                                <td> <span style="backgroud-color: red;"></span> Vermelho</td>
                                <td>1</td>
                                <td>Porteiro x</td>
                                <td>05:45</td>
                                <td>06:30</td>
                                <td>
                                    <button lass="btn btn-secondary"><i class="fas fa-edit botoes"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection