@extends('layouts.app')

@section('title', 'Inicio - Plataforma de Seguimiento Ambiental')
@section('page_title', 'Inicio')

@section('content')
    <!-- Welcome Section -->
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-12">
            <div
                style="background: linear-gradient(135deg, #ffffff 0%, #f1f4f9 100%); padding: 40px; border-radius: 8px; border-left: 6px solid #0088cc; box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin-bottom: 30px;">
                <h2
                    style="font-family: 'Outfit', sans-serif; font-weight: 800; color: #2c3e50; margin-top: 0; margin-bottom: 12px; font-size: 32px;">
                    ¡Bienvenido, {{ auth()->user()->name ?? 'Usuario' }}!
                </h2>
                <p style="font-family: 'Inter', sans-serif; font-size: 17px; color: #5a6268; margin-bottom: 0;">
                    Plataforma de Seguimiento Ambiental.
                </p>
            </div>
        </div>
    </div>

    <!-- Module Navigation Cards -->
    <div class="row" style="margin-bottom: 40px; display: flex; flex-wrap: wrap;">
        <!-- Dashboard -->
        <div class="col-md-4 mb-4" style="margin-bottom: 25px; display: flex; flex-direction: column;">
            <a href="{{ url('/dashboard') }}" style="text-decoration: none; flex: 1;">
                <section class="panel panel-featured-bottom panel-featured-dark text-center hover-card"
                    style="border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: all 0.3s ease; height: 100%;">
                    <div class="panel-body" style="padding: 40px 20px;">
                        <div class="icon bg-dark"
                            style="width: 80px; height: 80px; border-radius: 50%; line-height: 80px; font-size: 35px; margin: 0 auto 20px auto; color: white; display: inline-block;">
                            <i class="fa fa-home"></i>
                        </div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #333; margin-top: 10px;">
                            Dashboard Resumen</h4>
                        <p class="text-muted" style="font-size: 14px; font-family: 'Inter', sans-serif;">Consulte métricas
                            generales, porcentajes de avance y el resumen ejecutivo de la plataforma.</p>
                    </div>
                </section>
            </a>
        </div>

        <!-- Carga de datos -->
        <div class="col-md-4 mb-4" style="margin-bottom: 25px; display: flex; flex-direction: column;">
            <a href="{{ url('/carga-datos') }}" style="text-decoration: none; flex: 1;">
                <section class="panel panel-featured-bottom panel-featured-primary text-center hover-card"
                    style="border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: all 0.3s ease; height: 100%;">
                    <div class="panel-body" style="padding: 40px 20px;">
                        <div class="icon bg-primary"
                            style="width: 80px; height: 80px; border-radius: 50%; line-height: 80px; font-size: 35px; margin: 0 auto 20px auto; color: white; display: inline-block;">
                            <i class="fa fa-upload"></i>
                        </div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #333; margin-top: 10px;">
                            Carga de Datos</h4>
                        <p class="text-muted" style="font-size: 14px; font-family: 'Inter', sans-serif;">Importe archivos
                            Excel y registre nuevas validaciones en el sistema central.</p>
                    </div>
                </section>
            </a>
        </div>

        <!-- Control de Calidad -->
        <div class="col-md-4 mb-4" style="margin-bottom: 25px; display: flex; flex-direction: column;">
            <a href="{{ url('/control-calidad') }}" style="text-decoration: none; flex: 1;">
                <section class="panel panel-featured-bottom panel-featured-warning text-center hover-card"
                    style="border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: all 0.3s ease; height: 100%;">
                    <div class="panel-body" style="padding: 40px 20px;">
                        <div class="icon bg-warning"
                            style="width: 80px; height: 80px; border-radius: 50%; line-height: 80px; font-size: 35px; margin: 0 auto 20px auto; color: white; display: inline-block;">
                            <i class="fa fa-check-square"></i>
                        </div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #333; margin-top: 10px;">
                            Control de Calidad</h4>
                        <p class="text-muted" style="font-size: 14px; font-family: 'Inter', sans-serif;">Revise, audite,
                            modifique datos atípicos y aplique sellos de aprobación.</p>
                    </div>
                </section>
            </a>
        </div>

        <!-- Visualización -->
        <div class="col-md-4 mb-4" style="margin-bottom: 25px; display: flex; flex-direction: column;">
            <a href="{{ url('/visualizacion') }}" style="text-decoration: none; flex: 1;">
                <section class="panel panel-featured-bottom panel-featured-success text-center hover-card"
                    style="border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: all 0.3s ease; height: 100%;">
                    <div class="panel-body" style="padding: 40px 20px;">
                        <div class="icon bg-success"
                            style="width: 80px; height: 80px; border-radius: 50%; line-height: 80px; font-size: 35px; margin: 0 auto 20px auto; color: white; display: inline-block;">
                            <i class="fa fa-eye"></i>
                        </div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #333; margin-top: 10px;">
                            Visualización</h4>
                        <p class="text-muted" style="font-size: 14px; font-family: 'Inter', sans-serif;">Consulte tableros
                            dinámicos de la información analítica ya consolidada y aprobada.</p>
                    </div>
                </section>
            </a>
        </div>

        <!-- Gráficos -->
        <div class="col-md-4 mb-4" style="margin-bottom: 25px; display: flex; flex-direction: column;">
            <a href="{{ url('/graficos') }}" style="text-decoration: none; flex: 1;">
                <section class="panel panel-featured-bottom panel-featured-info text-center hover-card"
                    style="border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: all 0.3s ease; height: 100%;">
                    <div class="panel-body" style="padding: 40px 20px;">
                        <div class="icon bg-info"
                            style="width: 80px; height: 80px; border-radius: 50%; line-height: 80px; font-size: 35px; margin: 0 auto 20px auto; color: white; display: inline-block;">
                            <i class="fa fa-signal"></i>
                        </div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #333; margin-top: 10px;">
                            Gráficos</h4>
                        <p class="text-muted" style="font-size: 14px; font-family: 'Inter', sans-serif;">Genere vistas en
                            profundidad y analíticas de dispersión avanzadas en gráficas duales.</p>
                    </div>
                </section>
            </a>
        </div>

        <!-- Estaciones Proyecto -->
        <div class="col-md-4 mb-4" style="margin-bottom: 25px; display: flex; flex-direction: column;">
            <a href="{{ url('/estaciones-proyecto') }}" style="text-decoration: none; flex: 1;">
                <section class="panel panel-featured-bottom panel-featured-tertiary text-center hover-card"
                    style="border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: all 0.3s ease; height: 100%;">
                    <div class="panel-body" style="padding: 40px 20px;">
                        <div class="icon bg-tertiary"
                            style="width: 80px; height: 80px; border-radius: 50%; line-height: 80px; font-size: 35px; margin: 0 auto 20px auto; color: white; display: inline-block;">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #333; margin-top: 10px;">
                            Estaciones Proyecto</h4>
                        <p class="text-muted" style="font-size: 14px; font-family: 'Inter', sans-serif;">Explore el sistema
                            de información geográfica, mapas interactivos e históricos multimodales.</p>
                    </div>
                </section>
            </a>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .hover-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
            border-color: #0088cc;
        }

        .hover-card {
            text-decoration: none !important;
        }
    </style>
@endpush