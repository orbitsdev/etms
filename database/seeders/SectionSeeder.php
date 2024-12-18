<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bsitId = DB::table('courses')->where('name', 'like', '%Information Technology%')->value('id');
        $bscsId = DB::table('courses')->where('name', 'like', '%Computer Science%')->value('id');

        // Check if IDs exist
        if ($bsitId && $bscsId) {
            // Seed sections
            DB::table('sections')->insert([
                // BSIT Sections
                ['name' => 'BSIT 1A', 'course_id' => $bsitId],
                ['name' => 'BSIT 1B', 'course_id' => $bsitId],
                ['name' => 'BSIT 1C', 'course_id' => $bsitId],
                ['name' => 'BSIT 1D', 'course_id' => $bsitId],
                ['name' => 'BSIT 2A', 'course_id' => $bsitId],
                ['name' => 'BSIT 2B', 'course_id' => $bsitId],
                ['name' => 'BSIT 3A', 'course_id' => $bsitId],
                ['name' => 'BSIT 4A', 'course_id' => $bsitId],

                // BSCS Sections
                ['name' => 'BSCS 1A', 'course_id' => $bscsId],
                ['name' => 'BSCS 1B', 'course_id' => $bscsId],
                ['name' => 'BSCS 1C', 'course_id' => $bscsId],
                ['name' => 'BSCS 2A', 'course_id' => $bscsId],
                ['name' => 'BSCS 3A', 'course_id' => $bscsId],
                ['name' => 'BSCS 4A', 'course_id' => $bscsId],
            ]);
        } else {
            $this->command->info("Course IDs not found. Ensure the CourseSeeder has been run correctly.");
        }
    }
}
