@extends('layouts.standard')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/gate.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/assets/css/select2.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/assets/css/sweetalert2dark.min.css') }}" type="text/css">
    <script src="{{ url('assets/js/gate.js') }}"></script>
    <script src="{{ url('assets/js/select2.min.js') }}"></script>
    <script src="{{ url('assets/js/sweetalert2.min.js') }}"></script>
@endsection

@section('pagename')
    Portaria
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
            <!-- Vehicle Input  -->
            <div class="tab-pane fade show active" id="entrance" role="tabpanel" aria-labelledby="entrance-tab">
                <form onSubmit="handleEntranceFormSubmit(event)" class="row" id="entrance-form">
                    <div class="mb-3 col-12 col-md-4 col-lg-2">
                        <label for="input-plate" class="form-label">Placa <span class="required">*</span></label>
                        <input minlength="7" maxlength="8" type="text" class="form-control" id="input-plate" required onblur="handlePlateChange(event)">
                    </div>
                    <div class="mb-3 col-12 col-md-8 col-lg-6">
                        <label for="input-name" class="form-label">Nome do condutor <span class="required">*</span></label>
                        <input type="text" class="form-control" id="input-name" minlength="1" maxlength="255" required>
                    </div>
                    <div class="mb-3 col-12 col-md-6 col-lg-4">
                        <label for="txtDestination" class="form-label d-block">Destino <span class="required">*</span></label>
                        <select id="selDestination" class="select2 form-select d-block" required></select>
                    </div>
                    <div class="mb-3 col-12 col-md-3 col-lg-2">
                        <label for="input-type" class="form-label">Tipo</label>
                        <select onChange="handleSelectChange(event)" id="input-type" class="form-select">
                            <option value="0"></option>
                        </select>
                    </div>
                    <div class="mb-3 col-12 col-md-3 col-lg-2">
                        <label for="input-time" class="form-label">Tempo (minutos)</label>
                        <input type="number" min="1" max="65535" class="form-control" id="input-time">
                    </div>
                    <div class="mb-3 col-12 col-md-6 col-lg-4">
                        <label for="input-cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="input-cpf" minlength="14" maxlength="14" autocomplete="off">
                    </div>
                    <div class="mb-3 col-12 col-md-4 col-lg-2">
                        <label for="input-model" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="input-model" minlength="1" maxlength="80">
                    </div>
                    <div class="mb-3 col-12 col-md-2 col-lg-2">
                        <label for="input-color" class="form-label">Cor</label>
                        <select class="gate-inputcolor form-select d-block" id="input-color">
                            <option selected value="">Indefinido</option>
                        </select>
                    </div>
                    <div class="button-div text-center mt-5">
                        <button class="btn btn-primary" type="submit">Cadastrar</button>
                    </div>

                </form>
            </div>
            <!--  Vehicle Output -->
            <div class="tab-pane fade" id="exit" role="tabpanel" aria-labelledby="exit-tab">
                <form onSubmit="handleExitFormSubmit(event)" class="row" id="exit-form">
                    <div class="mb-3 col-12 col-md-4 col-lg-2">
                        <label for="input-plate-exit" class="form-label">Placa <span class="required">*</span></label>
                        <input type="text" class="form-control" id="input-plate-exit" required>
                    </div>
                    <div class="button-div text-center mt-5">
                        <button id="button-att" class="btn btn-primary" type="submit">Registrar Saída</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Inside Vehicles Table -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                <i class="fas fa-chevron-down fa-5x"></i>
            </div>
            <div id="tabela" class="row">
                <div class="col-12">
                    <table id="tabela-veiculo" class="table sortable table-bordered {{ ($colormode == 'light')? '': 'table-dark'}}">
                        <thead>
                            <tr>
                                <th class="col">Placa</th>
                                <th class="col">Modelo</th>
                                <th class="col">Cor</th>
                                <th class="col">Hora de Entrada</th>
                                <th scope="col">Tempo</th>
                                <th scope="col">Status</th>
                                <th class="col-2">Ações</th>
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

    <!-- Modal Exit -->
    <div class="modal fade" id="modalSaidaVeiculo" tabindex="-1" aria-labelledby="modalSaidaVeiculoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header justify-content-left border-0">
                    <h5 class="modal-title" id="modalSaidaVeiculoLabel"><i class="fas fa-exclamation-triangle"></i>&nbsp;Confirmar saída do veículo <span class="span-plate-out"></span>?</h5>
                </div>
                <div class="modal-body justify-content-center">
                    <form onSubmit="handleExitModal(event)" id="exit-modal" class="justify-content-center">
                        <div id="modal-score" class="mb-5 d-flex">
                            <label for="input-name" class="form-label">Comportamento do visitante:&nbsp;</label>
                            <div class="form-check form-check-inline">
                                <label id="label-good" class="form-check-label" for="good-score">
                                    <input class="form-check-input d-none" type="radio" checked name="scores" id="good-score" value="G">
                                    <i class="far fa-thumbs-up goodcheckmark"></i>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label id="label-bad" class="form-check-label" for="bad-score">
                                    <input class="form-check-input d-none" type="radio" name="scores" id="bad-score" value="B">
                                    <i class="far fa-thumbs-down badcheckmark"></i>
                                </label>
                            </div>
                        </div>
                        <div id="modal-buttons" class="mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <button id="reportar" type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#reportModal">Reportar</button>

                                </div>
                                <div class="col-4">
                                    <button id="close-modal" type="button" class="btn btn-secondary w-100 " data-bs-dismiss="modal">Não&nbsp;<small>(cancelar)</small></button>
                                </div>
                                <div class="col-4">
                                    <button id="atualizar" type="submit" class="btn btn-secondary w-100">Sim&nbsp;<small>(Enter)</small></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Report -->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Reportar veículo <span class="span-plate-report"></span> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form onSubmit="dynamicTimeExtenderModal(event)" class="row align-items-center justify-content-center" id="report-form" novalidate>

                        <div class="mb-3 col-12 col-lg-12 d-none">
                            <label for="vehicleId" class="form-label">Id vehicle</label>
                            <input type="text" class="form-control" value="" id="vehicleId" required autocomplete="false">
                        </div>

                         <div class="mb-3 col-12 col-lg-12">
                            <label for="report-description" class="form-label">Motivo<span class="required">*</span></label>
                            <textarea cols="10" rows="4" type="text" class="form-control" id="report-description" minlength="1" maxlength="2000" required> </textarea>
                        </div>


                        <div id="modal-buttons" class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <button id="close-modal" type="button" class="btn btn-secondary w-100 " data-bs-dismiss="modal">Cancelar</button>
                                </div>
                                <div class="col-6">
                                    <button id="reportar" type="submit" class="btn btn-danger w-100" >Reportar</button>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal TimeExtender -->
    <div class="modal fade" id="modalTimeExtender" tabindex="-1" aria-labelledby="modalTimeExtenderLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header justify-content-left border-0">
                    <h5 class="modal-title" id="modalTimeExtenderLabel">Adiar permanência do veículo <span class="span-plate-delay"></span></h5>
                </div>
                <div class="modal-body justify-content-center">
                    <form onSubmit="handleTimeExtenderModal(event)" id="exit-modal" class="justify-content-center">
                        <div class="mb-5">
                            <div class="form-group mb-2 d-none">
                                <label for="inputDelayVehicleId">VehicleId</label>
                                <input class="form-control" id="inputDelayVehicleId" aria-describedby="inputDelayVehicleId">
                            </div>
                            <div class="form-group mb-2">
                                <label for="inputDelayTime">Tempo <span class="required">*</span></label>
                                <input type="number" class="form-control" id="inputDelayTime" aria-describedby="inputDelayTime" placeholder="Informe o tempo em minutos" min="1" max="65535" required>
                            </div>
                            <div class="form-group">
                                <label for="inputDelayDescription">Motivo <span class="required">*</span></label>
                                <textarea class="form-control" id="inputDelayDescription" aria-describedby="inputDelayDescription" placeholder="Informe o motivo para extender o tempo de permanência desse veículo" minlength="1" maxlength="2000" required></textarea>
                            </div>
                        </div>
                        <div id="modal-buttons" class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <button id="close-modal" type="button" class="btn btn-secondary w-100 " data-bs-dismiss="modal">Cancelar</button>
                                </div>
                                <div class="col-6">
                                    <button id="reportar" type="submit" class="btn btn-primary w-100" >Adiar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


</div>
@endsection
