<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'Inicio', 'slug' => 'inicio'],
            ['name' => 'Dashboard', 'slug' => 'dashboard'],
            ['name' => 'Carga de Datos', 'slug' => 'carga-datos'],
            ['name' => 'Control de Calidad', 'slug' => 'control-calidad'],
            ['name' => 'Visualización', 'slug' => 'visualizacion'],
            ['name' => 'Gráficos', 'slug' => 'graficos'],
            ['name' => 'Estaciones Proyecto', 'slug' => 'estaciones-proyecto'],
            ['name' => 'Gestión de Usuarios', 'slug' => 'gestion-usuarios'],
        ];

        foreach ($permissions as $permission) {
            \App\Models\Permission::updateOrCreate(['slug' => $permission['slug']], $permission);
        }

        // Crear usuario admin inicial
        $admin = \App\Models\User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrador',
                'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            ]
        );

        // Asignar todos los permisos al admin
        $allPermissions = \App\Models\Permission::all();
        $admin->permissions()->sync($allPermissions->pluck('id'));
    }
}
