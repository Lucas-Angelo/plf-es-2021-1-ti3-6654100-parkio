@extends('layouts.standard')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/gate.css') }}" type="text/css">
@endsection

@section('content')

<script>
    const handleEntranceFormSubmit = (event) =>{
        event.preventDefault();
        
        const plate = document.querySelector('#input-plate').value
        const driverName = document.querySelector('#input-name').value
        const block = document.querySelector('#input-block').value
        const destinationId = document.querySelector('#input-ap').value
        let categoryId = document.querySelector('#input-type').value
        if (categoryId.length === 0)
            categoryId = 1;
        let time = document.querySelector('#input-time').value
        if (time.length===0){
            const hora = new Date().getHours()
            const minutos = new Date().getMinutes()
            time = hora*60 + minutos
        }
        else{
            const [ hora, minutos ] = time.split(':').map(value=>+value)
            time = + hora*60 + minutos
        }
        const model = document.querySelector('#input-model').value
        const cpf = document.querySelector('#input-cpf').value
        const color = document.querySelector('#input-color').value
        const gateId = 1;

        const data = {
            plate,
            driverName,
            destinationId: + destinationId,
            categoryId,
            time,
            model,
            cpf,
            color,
            gateId
        }
        console.log(data)
        fetch('/api/vehicles/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then((res)=>{
            if (res.status !== 200){
            }
            else{
                document.getElementById('entrance-form').reset();
            }
        })
        .catch((err)=>{
            console.log(err)
        })
    }
</script>
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
                        <input type="text" class="form-control" id="input-plate" required>
                    </div>
                    <div class="mb-3 col-12 col-md-8 col-lg-6">
                        <label for="input-name" class="form-label">Nome do condutor <span class="required">*</span></label>
                        <input type="text" class="form-control" id="input-name" required>
                    </div>
                    <div class="mb-3 col-12 col-md-3 col-lg-2">
                        <label for="input-block" class="form-label">Bloco <span class="required">*</span></label>
                        <select type="text" class="form-select" id="input-block" required>
                            <option selected value="1">Bloco 01</option>
                        </select>
                    </div>
                    <div class="mb-3 col-12 col-md-3 col-lg-2">
                        <label for="input-ap" class="form-label">Apartamento <span class="required">*</span></label>
                        <select type="text" class="form-select" id="input-ap" required>
                            <option value="1">Ap 01</option>
                        </select>
                    </div>
                    <div class="mb-3 col-12 col-md-3 col-lg-2">
                        <label for="input-type" class="form-label">Tipo</label>
                        <select id="input-type" class="form-select">
                            <option selected></option>
                            <option value="1">Visitante</option>
                            <option value="2">Prestador de Serviço</option>
                        </select>
                    </div>
                    <div class="mb-3 col-12 col-md-3 col-lg-2">
                        <label for="input-time" class="form-label">Tempo</label>
                        <input type="number" min="0" class="form-control" id="input-time" required>
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
                        <button class="btn" type="submit">Cadastrar</button>
                    </div>
                    
                </form>
            </div>
            <div class="tab-pane fade" id="exit" role="tabpanel" aria-labelledby="exit-tab">Saída</div>
        </div>
    </div>
    
</div>
@endsection