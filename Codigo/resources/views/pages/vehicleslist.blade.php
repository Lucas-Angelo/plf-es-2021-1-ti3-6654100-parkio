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
                <div class="col-2">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>

            <div id="tabela" class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center align-items-center w-100">
                        <table class="table table-dark sortable" style="border: 1px solid white; vertical-align: middle; text-align:center; position: relative;">
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
                                        <button><i id="action" class="fas fa-edit"></i></button>
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