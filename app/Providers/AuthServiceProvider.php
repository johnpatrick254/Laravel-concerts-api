<?php

namespace App\Providers;
namespace App\Models;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        Gate::define('update-event', function (User $user, Event $event) {
            return $user->id === $event->user_id;
        });
    }
}
