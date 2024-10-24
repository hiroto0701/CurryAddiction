<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        \App\Domains\ServiceUser\Controller\Policy\ActionPolicy::register();
        \App\Domains\Post\Controller\Policy\ActionPolicy::register();
        \App\Domains\Dashboard\Analytics\Controller\Policy\ActionPolicy::register();
        \App\Domains\Dashboard\Trash\Controller\Policy\ActionPolicy::register();
        \App\Domains\Genre\Controller\Policy\ActionPolicy::register();
        \App\Domains\Notification\Controller\Policy\ActionPolicy::register();
        \App\Domains\Prefecture\Controller\Policy\ActionPolicy::register();
    }
}
