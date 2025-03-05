<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\UserDetails;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'role' => ['required', 'in:Student,Faculty'],
            'department' => ['required', 'string', 'max:255'],
            // 'course_id' => ['nullable', 'exists:courses,id'],
            // 'section_id' => ['nullable', 'exists:sections,id'],
            // 'position' => ['nullable', 'string', 'max:255'],
        ])->validate();

        $user = User::create([
            'name' => "{$input['first_name']} {$input['last_name']}",
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => $input['role'],
        ]);

        // Store additional details
        UserDetails::create([
            'user_id' => $user->id,
            'first_name' => $input['first_name'],
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'department' => $input['department'],
            'course' => $input['role'] === 'Student' ? $input['course_id'] : null,
            'section' => $input['role'] === 'Student' ? $input['section_id'] : null,
            'position' => $input['role'] === 'Faculty' ? $input['position'] : null,
        ]);

        return $user;

    }
}
