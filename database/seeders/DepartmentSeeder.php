<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'name'=> 'NURSE BUILDING',
         ]);
        Department::create([
            'name'=> 'CSS DEANS',
         ]);

        Department::create([
            'name'=> 'COLLEGE OF COMPUTER STUDY',
        ]);
        Department::create([
            'name'=> 'COLLEGE OF INDUSTRIAL TECHNOLOGY',
        ]);
        Department::create([
            'name'=> 'ENGINEERING STUDENTS ORGANIZATION',
        ]);
    }
}
