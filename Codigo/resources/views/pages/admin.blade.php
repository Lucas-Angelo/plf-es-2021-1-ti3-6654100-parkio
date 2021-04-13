@extends('layouts.standard')

@section('extraassets')
    <link rel="stylesheet" href="{{ url('/assets/css/visitorCategory.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/assets/css/admin.css') }}" type="text/css">
@endsection

@section('content')
<script src="{{ url('/assets/js/visitorCategory.js') }}"></script>
<div class="container-fluid" id="admin">

</div>
    <div class="container-fluid">

        
        <button class="mobile-menu-button d-flex d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMenu" aria-expanded="false" aria-controls="collapseMenu">
            <i class="fas fa-align-justify"></i>Menu
        </button>
        <div class="collapse d-md-none" id="collapseMenu">
            <ul class="nav nav-tabs flex-column" id="adminMenuTab" role="tablist">
                <li class="admin-nav-item" role="presentation">
                    <button class="active" id="gates-tab" data-bs-toggle="tab" data-bs-target="#gates" type="button" role="tab" aria-controls="gates" aria-selected="true">Portarias</button>
                </li>
                <li class="admin-nav-item" role="presentation">
                    <button id="category-tab" data-bs-toggle="tab" data-bs-target="#category" type="button" role="tab" aria-controls="category" aria-selected="false">Categoria de Visitante</button>
                </li>
                <li class="admin-nav-item" role="presentation">
                    <button id="reported-tab" data-bs-toggle="tab" data-bs-target="#reported" type="button" role="tab" aria-controls="reported" aria-selected="false">Veículos Reportados</button>
                </li>
            </ul>
        </div>

        <div class="row">
            <aside class="menu col-3 d-none d-md-block">
                <ul class="nav nav-tabs flex-column" id="adminMenuTab" role="tablist">
                    <li class="admin-nav-title">
                        <i class="fas fa-align-justify"></i>Menu
                    </li>
                    <li class="admin-nav-item" role="presentation">
                        <button class="active" id="gates-tab" data-bs-toggle="tab" data-bs-target="#gates" type="button" role="tab" aria-controls="gates" aria-selected="true">Portarias</button>
                    </li>
                    <li class="admin-nav-item" role="presentation">
                        <button id="category-tab" data-bs-toggle="tab" data-bs-target="#category" type="button" role="tab" aria-controls="category" aria-selected="false">Categoria de Visitante</button>
                    </li>
                    <li class="admin-nav-item" role="presentation">
                        <button id="reported-tab" data-bs-toggle="tab" data-bs-target="#reported" type="button" role="tab" aria-controls="reported" aria-selected="false">Veículos Reportados</button>
                    </li>
                </ul>
            </aside>

            <main class="col-12 col-md-9 tab-content">
                <div class="tab-pane fade show active" id="gates" role="tabpanel" aria-labelledby="gates-tab">Portarias</div>
                <div id="category" class="tab-pane fade" role="tabpanel" aria-labelledby="category-tab">

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
                <div class="tab-pane fade" id="reported" role="tabpanel" aria-labelledby="reported-tab">Veículos Reportados</div>



            </main>
        </div>
        

        
        
    </div>
@endsection