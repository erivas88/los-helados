<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Permission;

class UserPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $permissions = Permission::all();
        foreach ($users as $user) {
            $user->permissions()->sync($permissions->pluck('id'));
        }
    }
}
