@extends('layouts.standard')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/gate.css') }}" type="text/css">
@endsection

@section('content')
<div class="container-fluid" id="gate">
    <ul class="nav nav-tabs" id="gateTab" role="tablist">
        <li class="nav-item col-6 col-md-3" role="presentation">
            <button class="nav-link col-12 active" id="entrance-tab" data-bs-toggle="tab" data-bs-target="#entrance" type="button" role="tab" aria-controls="entrance" aria-selected="true">Entrada</button>
        </li>
        <li class="nav-item col-6 col-md-3" role="presentation">
            <button class="nav-link col-12" id="exit-tab" data-bs-toggle="tab" data-bs-target="#exit" type="button" role="tab" aria-controls="exit" aria-selected="false">Saída</button>
        </li>
    </ul>
    <div id="entrance-exit-container">
        <div class="tab-content" id="gateTabContent">
            <div class="tab-pane fade show active" id="entrance" role="tabpanel" aria-labelledby="entrance-tab">
                <form action="" class="row" id="entrance-form">
                    <div class="mb-3 col-12 col-md-4 col-lg-2">
                        <label for="input-plate" class="form-label">Placa <span class="required">*</span></label>
                        <input type="text" class="form-control" id="input-plate" required>
                    </div>
                    <div class="mb-3 col-12 col-md-8 col-lg-6">
                        <label for="input-name" class="form-label">Nome do condutor <span class="required">*</span></label>
                        <input type="text" class="form-control" id="input-name" required>
                    </div>
                    <div class="mb-3 col-12 col-md-3 col-lg-2">
                        <label for="input-block" class="form-label">Bloco <span class="required">*</span></label>
                        <input type="text" class="form-control" id="input-block" required>
                    </div>
                    <div class="mb-3 col-12 col-md-3 col-lg-2">
                        <label for="input-ap" class="form-label">Apartamento <span class="required">*</span></label>
                        <input type="text" class="form-control" id="input-ap" required>
                    </div>
                    <div class="mb-3 col-12 col-md-3 col-lg-2">
                        <label for="input-tipo" class="form-label">Tipo</label>
                        <select id="input-tipo" class="form-select" aria-label="Default select example">
                            <option selected></option>
                            <option value="0">Visitante</option>
                            <option value="1">Prestador de Serviço</option>
                        </select>
                    </div>
                    <div class="mb-3 col-12 col-md-3 col-lg-2">
                        <label for="input-time" class="form-label">Tempo</label>
                        <input type="time" class="form-control" id="input-time">
                    </div>
                    <div class="mb-3 col-12 col-md-6 col-lg-4">
                        <label for="input-cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="input-cpf">
                    </div>
                    <div class="mb-3 col-12 col-md-4 col-lg-3">
                        <label for="input-model" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="input-model">
                    </div>
                    <div class="mb-3 col-12 col-md-2 col-lg-1">
                        <label for="input-color" class="form-label">Cor</label>
                        <input type="color" class="form-control" id="input-color">
                    </div>
                    <div class="button-div text-center mt-5">
                        <button class="btn" type="button">Cadastrar</button>
                    </div>
                    
                </form>
            </div>
            <div class="tab-pane fade" id="exit" role="tabpanel" aria-labelledby="exit-tab">Saída</div>
        </div>
    </div>
    
</div>
@endsection