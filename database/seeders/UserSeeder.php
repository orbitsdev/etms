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
        $adminUsers = [
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role' => User::ADMIN,
            ],
            [
                'name' => 'Etms Admin',
                'email' => 'admin@etms.com',
                'password' => Hash::make('password'),
                'role' => User::ADMIN,
            ],
            [
                'name' => 'Developer User',
                'email' => 'developer@gmail.com',
                'password' => Hash::make('password'),
                'role' => User::ADMIN,
            ],
        ];

        // Users with details
        $usersWithDetails = [
            [
                'user' => [
                    'name' => 'Brian Orbino',
                    'email' => 'test@etms.com',
                    'password' => Hash::make('password'),
                    'role' => User::STUDENT,
                ],
                'details' => [
                    'first_name' => 'Brian',
                    'middle_name' => null,
                    'last_name' => 'Orbino',
                    'type' => 'Student',
                    'department' => 'Computer Science',
                    'course' => 'BSCS',
                    'section' => 'A',
                    'year' => '2025',
                ],
            ],
            [
                'user' => [
                    'name' => 'Angela Tirado',
                    'email' => 'test2@etms.com',
                    'password' => Hash::make('password'),
                    'role' => User::FACULTY,
                ],
                'details' => [
                    'first_name' => 'Angela',
                    'middle_name' => null,
                    'last_name' => 'Tirado',
                    'type' => 'Faculty',
                    'department' => 'Mathematics',
                    'course' => null,
                    'section' => null,
                    'year' => null,
                ],
            ],
        ];

        // Create admin users
        foreach ($adminUsers as $admin) {
            User::create($admin);
        }

        // Create users with details
        foreach ($usersWithDetails as $userData) {
            $user = User::create($userData['user']);
            $user->userDetails()->create($userData['details']);
        }
    }
}
