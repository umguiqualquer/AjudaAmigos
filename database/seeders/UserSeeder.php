<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'email01@gmail.com')->first()) {
            $admin = User::create([
                'name' => 'email01',
                'email' => 'email01@gmail.com',
                'password' => Hash::make('123456', ['rounds' => 12]),
                'image' => null,
            ]);

            $admin->assignRole('Admin');
        }



        if (!User::where('email', 'hamilton@gmail.com')->first()) {
            $admin = User::create([
                'name' => 'Hamilton',
                'email' => 'hamilton@gmail.com',
                'password' => Hash::make('123456', ['rounds' => 12]),
                'image' => null,
            ]);

            $admin->assignRole('Professor');
        }
        


        if (!User::where('email', 'arthur@gmail.com')->first()) {
            $admin = User::create([
                'name' => 'Arthur',
                'email' => 'arthur@gmail.com',
                'password' => Hash::make('123456', ['rounds' => 12]),
                'image' => null,
            ]);

            $admin->assignRole('Aluno');
        }
    }
}
