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
                <div id="placa" class="col-2 desktop">
                    <label>Placa</label>
                    <label for="inputPlaca"></label>
                    <input type="text" class="form-control" id="inputPlaca" placeholder="Placa">
                </div>    
                <div id="portaria" class="col-2 desktop">
                    <label>Portaria</label>
                    <select class="form-select">
                        <option selected>Selecione</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div id="porteiro" class="col-2 desktop">
                    <label>Porteiro</label>
                    <select class="form-select">
                        <option selected>Selecione</option>
                        <option value="1">João</option>
                        <option value="2">José</option>
                    </select>
                </div>
                <div id="filtro-avancado" class="desktop" class="col-1">
                    <button class="btn btn-secondary"><i id="botoes" class="fas fa-filter"></i></button>
                </div>
                <div id="filtro-avancado" class="mobile" class="col-6">
                    <button class="btn btn-secondary"><i id="botoes" class="fas fa-filter"></i>Filtro Avançado</button>
                </div>
                <div id="buscar" class="col-1 desktop">
                    <button class="btn btn-secondary"><i id="botoes" class="fas fa-search"></i><b class="responsive">Buscar</b></button>
                </div>
            </div>

            <div id="tabela" class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center align-items-center w-100">
                        <table class="table table-dark sortable">
                            <thead>
                                <tr>
                                    <th scope="col">Placa</th>
                                    <th class="desktop" scope="col">Modelo</th>
                                    <th class="desktop" scope="col">Cor</th>
                                    <th class="desktop" scope="col">Portaria</th>
                                    <th class="desktop" scope="col">Porteiro</th>
                                    <th class="desktop" scope="col">Hora de Entrada</th>
                                    <th class="desktop" scope="col">Hora de Saída</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">AAA-1111</th>
                                    <td class="desktop">Ford Ka</td>
                                    <td class="desktop">Vermelho</td>
                                    <td class="desktop">1</td>
                                    <td class="desktop">Porteiro x</td>
                                    <td class="desktop">05:45</td>
                                    <td class="desktop">06:30</td>
                                    <td>
                                        <button lass="btn btn-secondary"><i id="botoes" class="fas fa-edit"></i></button>
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