@extends('layouts.standard')

@section('extraassets')
    <script src="{{ url('/assets/js/apexcharts.min.js') }}"></script>
@endsection

@section('pagename')
    Relatórios
@endsection


@section('content')
<div class="container">
    <div class="row g-3 mt-3">
        <div class="col-12 col-md-4 d-md-inline">
            <label for="txtPlateFilter">Data</label>
            <div class="input-group mb-3">
                <input type="date" class="form-control reportDatePicker" id="txtDateBegin" aria-label="A partir">
                <span class="input-group-text bg-transparent">e</span>
                <input type="date" class="form-control reportDatePicker" id="txtDateEnd" aria-label="Até">
            </div>
        </div>
        <div class="col-12 col-md-3 d-md-inline">
            <label>Portaria</label>
            <select id="gate" class="form-select">
                <option value="0" selected>Selecione</option>
            </select>
        </div>
        <div class="col-12 col-md-3 d-md-inline">
            <label>Porteiro</label>
            <select id="user_in" class="form-select">
                <option value="0" selected>Selecione</option>
            </select>
        </div>
        <div class="col-12 col-md-2 d-md-inline">
            <div class="float-end">
                <label>&nbsp;</label>
                <button id="btnFilter" class="btn btn-secondary d-none d-md-block">
                    <i class="fas fa-search botoes d-inline"></i>
                    <b class="d-inline">Buscar</b>
                </button>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 col-md-6">
            <div id="chart"></div>
        </div>
        <div class="col-12 col-md-6">
            <div id="chart2"></div>
        </div>
    </div>
</div>

<script src="{{ url('/assets/js/report.js') }}"></script>
@endsection
