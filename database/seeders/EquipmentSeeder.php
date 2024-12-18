<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('equipment')->insert([
            [
                'name' => 'Projector',
                'serial_number' => Str::random(10),
                'stock' => 10,
                'status' => 'Available',
                'location' => 'Room 101',
                'archived_date' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laptop',
                'serial_number' => Str::random(10),
                'stock' => 5,
                'status' => 'Reserved',
                'location' => 'Room 202',
                'archived_date' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Printer',
                'serial_number' => Str::random(10),
                'stock' => 2,
                'status' => 'Out of Stock',
                'location' => 'Office',
                'archived_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Camera',
                'serial_number' => Str::random(10),
                'stock' => 1,
                'status' => 'Not Available',
                'location' => 'Lab',
                'archived_date' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Whiteboard',
                'serial_number' => Str::random(10),
                'stock' => 8,
                'status' => 'Available',
                'location' => 'Room 303',
                'archived_date' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
