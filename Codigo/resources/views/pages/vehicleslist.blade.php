@extends('layouts.standard')

@section('extraassets')
    <script src="{{ url('/assets/css/vehiclelist.css') }}"></script>
    <script src="{{ url('/assets/js/sorttable.js') }}"></script> <!-- To sort table by headers -->
@endsection

@section('content')
<div class="container-fluid">
    <div id="main" class="row">
        <div class="col-12">

            <div class="row mt-4 mb-2" style="padding-left: 5%; padding-right: 5%;">
                <div class="col-2">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>

            <div class="row" style="padding-left: 5%; padding-right: 5%;">
                <div class="col-12">
                    <div class="d-flex justify-content-center align-items-center w-100">
                        <table class="table table-dark sortable" style="border: 1px solid white; vertical-align: middle; text-align:center; position: relative;">
                            <thead style="background-color: #252531;">
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
                                    <th style="padding: 20px;" scope="row">AAA-1111</th>
                                    <td style="padding: 20px;">Ford Ka</td>
                                    <td style="padding: 20px;">Vermelho</td>
                                    <td style="padding: 20px;">1</td>
                                    <td style="padding: 20px;">Porteiro x</td>
                                    <td style="padding: 20px;">  05:45</td>
                                    <td style="padding: 20px;">06:30</td>
                                    <td style="padding: 20px;">
                                        <button style="background-color: #5C5C68; border-radius: 8px; padding: 5px;"><i class="fas fa-edit" style="color: #B4B4B4; padding: 10px;"></i></button>
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