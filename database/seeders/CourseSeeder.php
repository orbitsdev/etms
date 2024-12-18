<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('courses')->insert([
            [
                'name' => 'Bachelor of Science in Information Technology (BSIT)',

            ],
            [
                'name' => 'Bachelor of Science in Computer Science (BSCS)',

            ],
            [
                'name' => 'Bachelor of Science in Information Systems (BSIS)',

            ],
            [
                'name' => 'Bachelor of Science in Software Engineering (BSSE)',

            ],
            [
                'name' => 'Bachelor of Science in Cyber Security (BSCS)',

            ],

        ]);
    }
}
