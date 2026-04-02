@extends('layouts.app')

@section('title', 'Visualización - Porto Admin')
@section('page_title', 'Visualización')

@section('content')
    @include('partials.modules')

    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Módulo de Visualización</h2>
                </header>
                <div class="panel-body">
                    <p>Contenido específico para la visualización de datos.</p>
                </div>
            </section>
        </div>
    </div>
@endsection
