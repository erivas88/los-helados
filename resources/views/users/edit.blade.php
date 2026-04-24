@extends('layouts.app')

@section('title', 'Editar Usuario')
@section('page_title', 'Usuarios')

@section('content')
    @include('partials.modules')

    <!-- Intro Banner (Cintillo) -->
    <div class="row" style="margin-bottom: 25px;">
        <div class="col-md-12">
            <div style="background: linear-gradient(135deg, #ffffff 0%, #f1f4f9 100%); padding: 35px 40px; border-radius: 8px; border-left: 6px solid #f39c12; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 800; color: #2c3e50; margin-top: 0; margin-bottom: 8px; font-size: 28px;">
                            <i class="fa fa-edit" style="color: #f39c12;"></i> Modificación de Usuario
                        </h2>
                        <p style="font-family: 'Inter', sans-serif; font-size: 16px; color: #5a6268; margin-bottom: 0;">
                            Actualice los datos de perfil y ajuste los privilegios de acceso para <strong>{{ $user->name }}</strong>.
                        </p>
                    </div>
                    <div class="actions">
                        <a href="{{ route('users.index') }}" class="btn btn-default" style="font-family: 'Outfit', sans-serif; font-weight: 600;">
                            <i class="fa fa-arrow-left mr-1"></i> Volver al Listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <section class="panel" style="border-radius: 8px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div class="panel-body" style="padding: 40px;">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" class="form-horizontal">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Datos Básicos -->
                            <div class="col-md-6" style="border-right: 1px solid #eee; padding-right: 40px;">
                                <h4 style="font-weight: 700; color: #34495e; margin-bottom: 25px; text-transform: uppercase; font-size: 14px; letter-spacing: 1px;">
                                    <i class="fa fa-info-circle text-warning mr-2"></i> Información de Cuenta
                                </h4>

                                <div class="form-group mb-4">
                                    <label style="font-family: 'Inter', sans-serif; font-weight: 700; color: #7f8c8d; font-size: 11px; text-transform: uppercase;" for="name">Nombre Completo</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required style="border-radius: 6px; padding: 10px 15px;">
                                </div>

                                <div class="form-group mb-4">
                                    <label style="font-family: 'Inter', sans-serif; font-weight: 700; color: #7f8c8d; font-size: 11px; text-transform: uppercase;" for="email">Dirección de Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required style="border-radius: 6px; padding: 10px 15px;">
                                </div>

                                <div class="alert alert-info" style="border-radius: 6px; font-size: 12px; font-family: 'Inter', sans-serif; background: #ebf5fb; border: 1px solid #d6eaf8; color: #2e86c1;">
                                    <i class="fa fa-lock mr-1"></i> La contraseña no se puede cambiar desde este módulo por seguridad.
                                </div>
                            </div>

                            <!-- Permisos -->
                            <div class="col-md-6" style="padding-left: 40px;">
                                <h4 style="font-weight: 700; color: #34495e; margin-bottom: 25px; text-transform: uppercase; font-size: 14px; letter-spacing: 1px;">
                                    <i class="fa fa-lock text-success mr-2"></i> Matriz de Permisos
                                </h4>

                                <div class="row">
                                    @php
                                        $icons = [
                                            'inicio' => 'fa fa-home',
                                            'dashboard' => 'fa fa-th-large',
                                            'carga-datos' => 'fa fa-upload',
                                            'control-calidad' => 'fa fa-check',
                                            'visualizacion' => 'fa fa-th',
                                            'graficos' => 'fa fa-signal',
                                            'estaciones-proyecto' => 'fa fa-map-marker',
                                            'gestion-usuarios' => 'fa fa-user'
                                        ];
                                    @endphp
                                    @foreach($permissions as $permission)
                                    <div class="col-md-12 mb-3">
                                        <div class="permission-card" style="background: #fdfdfd; border: 1px solid #edf2f7; border-radius: 10px; padding: 12px 18px; display: flex; align-items: center; justify-content: space-between;">
                                            <div style="display: flex; align-items: center;">
                                                <div style="width: 32px; height: 32px; background: #fcf3cf; border-radius: 6px; display: flex; align-items: center; justify-content: center; margin-right: 12px; color: #f39c12;">
                                                    <i class="{{ $icons[$permission->slug] ?? 'fa fa-cog' }}"></i>
                                                </div>
                                                <span style="font-family: 'Inter', sans-serif; font-weight: 600; color: #2c3e50; font-size: 13px;">{{ $permission->name }}</span>
                                            </div>
                                            <div class="switch">
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                                                    id="perm_{{ $permission->id }}"
                                                    {{ $user->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 40px; border-top: 1px solid #eee; padding-top: 30px;">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-warning" style="background-color: #f39c12; border-color: #f39c12; color: white; font-family: 'Outfit', sans-serif; font-weight: 600; padding: 12px 30px;">
                                    <i class="fa fa-refresh mr-1"></i> Actualizar Información
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('css')
    <style>
        body { font-family: 'Inter', sans-serif !important; }
        h2, h4, h5 { font-family: 'Outfit', sans-serif !important; }

        .permission-card { transition: all 0.2s ease; }
        .permission-card:hover { border-color: #f39c12 !important; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }

        /* SWITCH STYLING */
        .switch { position: relative; display: inline-block; width: 38px; height: 20px; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ccc; transition: .4s; }
        .slider:before { position: absolute; content: ""; height: 14px; width: 14px; left: 3px; bottom: 3px; background-color: white; transition: .4s; }
        input:checked + .slider { background-color: #f39c12; }
        input:checked + .slider:before { transform: translateX(18px); }
        .slider.round { border-radius: 34px; }
        .slider.round:before { border-radius: 50%; }
    </style>
@endpush
