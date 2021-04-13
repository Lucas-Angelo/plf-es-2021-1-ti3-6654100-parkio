@extends('layouts.standard')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/gate.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/assets/css/select2.css') }}" type="text/css">
    <script src="{{ url('assets/js/gate.js') }}"></script>
    <script src="{{ url('assets/js/select2.min.js') }}"></script>
    <script src="{{ url('assets/js/vanilla-masker.min.js') }}"></script>
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
                <form onSubmit="handleEntranceFormSubmit(event)" class="row" id="entrance-form">
                    <div class="mb-3 col-12 col-md-4 col-lg-2">
                        <label for="input-plate" class="form-label">Placa <span class="required">*</span></label>
                        <input minlength="7" maxlength="8" type="text" class="form-control" id="input-plate" required>
                    </div>
                    <div class="mb-3 col-12 col-md-8 col-lg-6">
                        <label for="input-name" class="form-label">Nome do condutor <span class="required">*</span></label>
                        <input type="text" class="form-control" id="input-name" required>
                    </div>
                    <div class="mb-3 col-12 col-md-6 col-lg-4">
                        <label for="txtDestination" class="form-label d-block">Destino <span class="required">*</span></label>
                        <select id="selDestination" class="select2 form-select d-block" required></select>
                    </div>
                    <div class="mb-3 col-12 col-md-3 col-lg-2">
                        <label for="input-type" class="form-label">Tipo</label>
                        <select id="input-type" class="form-select">
                            <option value="1">Visitante</option>
                            <option value="2">Prestador de Serviço</option>
                        </select>
                    </div>
                    <div class="mb-3 col-12 col-md-3 col-lg-2">
                        <label for="input-time" class="form-label">Tempo (minutos)</label>
                        <input type="number" min="0" class="form-control" id="input-time">
                    </div>
                    <div class="mb-3 col-12 col-md-6 col-lg-4">
                        <label for="input-cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="input-cpf" minlength="7" maxlength="8">
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
                        <button class="btn" type="submit">Cadastrar</button>
                    </div>
                    
                </form>
            </div>
            <div class="tab-pane fade" id="exit" role="tabpanel" aria-labelledby="exit-tab">
                <form onSubmit="handleExitFormSubmit(event)" class="row" id="exit-form">
                    <div class="mb-3 col-12 col-md-4 col-lg-2">
                        <label for="input-plate-exit" class="form-label">Placa <span class="required">*</span></label>
                        <input type="text" class="form-control" id="input-plate-exit" oninvalid="this.setCustomValidity('É necessário informar a placa.')" required>
                    </div>
                    <div class="button-div text-center mt-5">
                        <button id="button-att" class="btn" type="button" data-bs-toggle="modal" data-bs-target="#modalNovoUsuario">Atualizar</button>
                    </div>
                    <div class="modal fade" id="modalNovoUsuario" tabindex="-1" aria-labelledby="modalNovoUsuarioLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content">
                                <div class="modal-header justify-content-left">
                                    <h5 class="modal-title" id="modalNovoUsuarioLabel"><i class="fas fa-exclamation-triangle"></i>&nbsp;Confirmar saída do veículo <span id="span-plate"></span>?</h5>
                                </div>
                                <div class="modal-body justify-content-center">
                                    <form onSubmit="handleEntranceFormSubmit(event)" id="exit-modal" class="justify-content-center">
                                        <div id="modal-score" class="mb-5 d-flex">
                                            <label for="input-name" class="form-label">Comportamento do visitante:&nbsp;</label>
                                            <form id="form-score" name="form-score">
                                                <div class="form-check form-check-inline">
                                                    <input onclick="handleScoreForm(event)" class="form-check-input" type="radio" name="scores" id="good-score" value="G">
                                                    <label id="label-good" class="form-check-label" for="good-score"><i class="far fa-thumbs-up"></i></label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input onclick="handleScoreForm(event)" class="form-check-input" type="radio" name="scores" id="bad-score" value="B">
                                                    <label id="label-bad" class="form-check-label" for="bad-score"><i class="far fa-thumbs-down"></i></label>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="modal-buttons" class="mb-3 d-flex justify-content-center">
                                            <button id="reportar" type="button" class="btn btn-primary align-items-center">Reportar</button>
                                            <button id="close-modal" type="button" class="btn btn-secondary align-items-center " data-bs-dismiss="modal">Não&nbsp;<label>(cancelar)</label></button>
                                            <button id="atualizar" type="submit" class="btn btn-primary align-items-center">Sim&nbsp;<label>(Enter)</label></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <button type="button" class="btn btn-secondary d-none" id="liveToastBtn"></button>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5;">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">ParkIO</strong>
                <small>Agora</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        <div class="toast-body">
            <span id="toast-msg"></span>
        </div>
    </div>
</div>

</div>
@endsection