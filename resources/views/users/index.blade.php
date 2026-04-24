@extends('layouts.app')

@section('title', 'Gestión de Usuarios')
@section('page_title', 'Usuarios')

@section('content')
    @include('partials.modules')

    <!-- Intro Banner (Cintillo) -->
    <div class="row" style="margin-bottom: 25px;">
        <div class="col-md-12">
            <div style="background: linear-gradient(135deg, #ffffff 0%, #f1f4f9 100%); padding: 35px 40px; border-radius: 8px; border-left: 6px solid #ff0000; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 800; color: #2c3e50; margin-top: 0; margin-bottom: 8px; font-size: 28px;">
                            <i class="fa fa-user" style="color: #ff0000;"></i> Control de Acceso y Usuarios
                        </h2>
                        <p style="font-family: 'Inter', sans-serif; font-size: 16px; color: #5a6268; margin-bottom: 0;">
                            Gestione las credenciales de acceso, asigne privilegios específicos y supervise los roles del personal administrativo.
                        </p>
                    </div>
                    <div class="actions">
                        <a href="{{ route('users.create') }}" class="btn btn-primary" style="background-color: #ff0000; border-color: #ff0000; font-family: 'Outfit', sans-serif; font-weight: 600; padding: 10px 20px;">
                            <i class="fa fa-plus mr-1"></i> &nbsp; Registrar Nuevo Usuario
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Panel -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel" style="border-radius: 8px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div class="panel-body" style="padding: 25px;">
                    
                    @if(session('success'))
                        <div class="alert alert-success" style="border-radius: 6px; font-family: 'Inter', sans-serif;">
                            <i class="fa fa-check-circle mr-1"></i> {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover mb-none" id="datatable-users" style="border-collapse: separate; border-spacing: 0 10px;">
                            <thead>
                                <tr style="background: #f8f9fa;">
                                    <th style="border:none; padding: 15px; border-radius: 8px 0 0 8px; color: #7f8c8d; font-family: 'Inter', sans-serif; font-size: 12px; text-transform: uppercase; font-weight: 700;">Identidad / Usuario</th>
                                    <th style="border:none; padding: 15px; color: #7f8c8d; font-family: 'Inter', sans-serif; font-size: 12px; text-transform: uppercase; font-weight: 700;">Dirección de Email</th>
                                    <th style="border:none; padding: 15px; color: #7f8c8d; font-family: 'Inter', sans-serif; font-size: 12px; text-transform: uppercase; font-weight: 700;">Privilegios / Módulos</th>
                                    <th style="border:none; padding: 15px; border-radius: 0 8px 8px 0; color: #7f8c8d; font-family: 'Inter', sans-serif; font-size: 12px; text-transform: uppercase; font-weight: 700;" class="text-center">Operaciones</th>
                                </tr>
                            </thead>
                            <tbody style="font-family: 'Inter', sans-serif;">
                                @foreach($users as $user)
                                <tr style="background: #ffffff; box-shadow: 0 2px 5px rgba(0,0,0,0.02);">
                                    <td style="vertical-align: middle; padding: 15px; border: none; border-radius: 8px 0 0 8px;">
                                        <div style="display: flex; align-items: center;">
                                            <div style="width: 40px; height: 40px; background: #eef2f7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; color: #5d6d7e;">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <div>
                                                <div style="font-weight: 700; color: #2c3e50; font-size: 14px;">{{ $user->name }}</div>
                                                <div style="font-size: 11px; color: #abb2b9;">ID: #{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle; padding: 15px; border: none;">
                                        <span style="color: #3498db; font-weight: 500;">{{ $user->email }}</span>
                                    </td>
                                    <td style="vertical-align: middle; padding: 15px; border: none;">
                                        <div style="display: flex; flex-wrap: wrap; gap: 4px;">
                                            @foreach($user->permissions as $permission)
                                                <span style="background: #ebf5fb; color: #2980b9; padding: 3px 10px; border-radius: 40px; font-size: 10px; font-weight: 700; text-transform: uppercase; border: 1px solid #d6eaf8;">
                                                    {{ $permission->name }}
                                                </span>
                                            @endforeach
                                            @if($user->permissions->isEmpty())
                                                <span style="color: #999; font-size: 11px; font-style: italic;">Sin permisos asignados</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle; padding: 15px; border: none; border-radius: 0 8px 8px 0;" class="text-center">
                                        <div style="display: flex; justify-content: center; gap: 8px;">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn" style="background: #fcf3cf; color: #b7950b; border: none; border-radius: 6px; padding: 6px 12px;" title="Editar Parámetros">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Confirma la eliminación definitiva de este usuario?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn" style="background: #fdedec; color: #cb4335; border: none; border-radius: 6px; padding: 6px 12px;" title="Eliminar Registro">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection

@push('css')
    <style>
        body {
            font-family: 'Inter', sans-serif !important;
        }
        h2, h4, h5 {
            font-family: 'Outfit', sans-serif !important;
        }
        .table > tbody > tr > td {
            border-top: none !important;
        }
    </style>
@endpush
