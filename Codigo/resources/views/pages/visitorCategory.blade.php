@extends('layouts.standard')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/visitorCategory.css') }}" type="text/css">
@endsection

@section('content')
<script src="{{ url('/assets/js/visitorCategory.js') }}"></script>
<div class="container-fluid" id="visitorCategory">
    
    <div id="visitorCategory-container">

        <h3 class="text-center mb-3">
            Cadastro de Categoria de Visitante
        </h3>

        <form onSubmit="handleVisitorCategoryFormSubmit(event)" class="row" id="visitorCategory-form">

            <div class="mb-3 col-12 col-md-6">
                <label for="input-description" class="form-label">Descrição<span class="required">*</span></label>
                <input type="text" class="form-control" id="input-description" required>
            </div>
            <div class="mb-3 col-12 col-md-6">
                <label for="input-time" class="form-label">Tempo padrão (minutos)<span class="required">*</span></label>
                <input type="number" min="0" class="form-control" id="input-time" required>
            </div>

            <div class="button-div text-center mt-3">
                <button class="btn" type="submit">Cadastrar</button>
            </div>
        
        </form>
                
    </div>
    
</div>
@endsection