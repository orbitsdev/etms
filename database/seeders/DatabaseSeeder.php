<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CourseSeeder;
use Database\Seeders\SectionSeeder;
use Database\Seeders\EquipmentSeeder;
use Database\Seeders\DepartmentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            EquipmentSeeder::class,
            DepartmentSeeder::class,
            CourseSeeder::class,
            SectionSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
