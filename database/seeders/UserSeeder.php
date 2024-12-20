<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=> 'Admin User',
            'email'=> 'admin@gmail.com',
            'password'=> Hash::make('password'),
            'role'=> 'admin',
         ]);
        User::create([
            'name'=> 'Etms dmin',
            'email'=> 'admin@etms.com',
            'password'=> Hash::make('password'),
            'role'=> 'admin',
         ]);
         User::create([
            'name'=> 'Developer User',
            'email'=> 'developer@gmail.com',
            'password'=> Hash::make('password'),
            'role'=> 'admin',
         ]);

         User::create([
            'name'=> 'Brian Orbino',
            'email'=> 'test@etms.com',
            'password'=> Hash::make('password'),
            'role'=> 'requester',
         ]);
         User::create([
            'name'=> 'Angela Tirado',
            'email'=> 'test2@etms.com',
            'password'=> Hash::make('password'),
            'role'=> 'requester',
         ]);

        //  ['admin', 'manager', 'requester']
    }
}
