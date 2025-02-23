<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\Event::class => \App\Policies\EventPolicy::class, // Contoh kebijakan
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define a Gate for admin-only actions
        Gate::define('manage-events', function ($user) {
            return $user->role === 'admin';
        });

        // Define a Gate for coaches to view events
        Gate::define('view-events', function ($user) {
            return in_array($user->role, ['admin', 'coach']);
        });
    }
}
