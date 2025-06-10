<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{

    public function run(): void
    {
        
        $permissions = [
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
        ];


        foreach($permissions as $permission){
            $existingPermission = Permission::where('name', $permission)->first();

            if(!$existingPermission){
                Permission::create([
                    'name' => $permission,
                    'guard_name' => 'web',
                ]);
            }
        }
    }
}
