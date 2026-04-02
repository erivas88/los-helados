@extends('layouts.app')

@section('title', 'Control de Calidad - Porto Admin')
@section('page_title', 'Control de Calidad')

@section('content')
    @include('partials.modules')
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Módulo de Control de Calidad</h2>
                </header>
                <div class="panel-body">
                    <p>Contenido específico para el control de calidad.</p>
                </div>
            </section>
        </div>
    </div>

@endsection
