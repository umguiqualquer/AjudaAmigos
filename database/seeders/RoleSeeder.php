<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        if(!Role::where('name', 'Admin')->first()){
            $admin = Role::create([
                'name' => 'Admin',
            ]);

            $admin->givePermissionTo([
                'index-user',
                'show-user',
                'create-user',
                'edit-user',
                'destroy-user',


                'index-role',
                'create-role',
                'edit-role',
                'destroy-role',

                'index-role-permission',
                'update-role-permission',
            ]);
        }



        if(!Role::where('name', 'Professor')->first()){
            $professor = Role::create([
                'name' => 'Professor',
            ]);

            $professor->givePermissionTo([
                'index-user',
                'show-user',
            ]);
        }



                if(!Role::where('name', 'Aluno')->first()){
            $aluno = Role::create([
                'name' => 'Aluno',
            ]);

            $aluno->givePermissionTo([
                
            ]);
        }
    }
}
