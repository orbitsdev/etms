<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('is-admin', function ($user) {
            return $user->role === User::ADMIN;
        });
        Gate::define('is-not-admin', function ($user) {
            return $user->role != User::ADMIN;
        });
        Gate::define('is-requester', function ($user) {
            return $user->role === User::REQUESTER;
        });
        Gate::define('is-student', function ($user) {
            return $user->role === User::STUDENT;
        });
        Gate::define('is-faculty', function ($user) {
            return $user->role === User::FACULTY;
        });
    }
}
