<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Feedback;
use App\Models\UserDetails;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positiveFeedback = [
            "Maayo guid ang serbisyo!",
            "Salamat sa madasig nga pagproseso.",
            "Nami guid ang inyo pag-asikaso.",
            "Nalipay kami sa outcome.",
            "Nami guid ang sistema niyo!",
            "Pasalamat guid sa inyo bulig.",
            "Wala guid sang problema, salamat!",
            "Madinalag-on ang tanan!",
            "Madasig kag maayo nga serbisyo.",
            "Nalipay guid kami sa inyo serbisyo.",
        ];

        // Fetch all non-admin users
        $nonAdminUsers = User::where('role', '!=', User::ADMIN)->get();

        foreach ($nonAdminUsers as $user) {
            // Assign random feedback and high ratings
            Feedback::create([
                'user_id' => $user->id,
                'message' => $positiveFeedback[array_rand($positiveFeedback)], // Random feedback
                'rating' => rand(4, 5), // Random high rating (4 or 5)
            ]);
        }
    }
}
