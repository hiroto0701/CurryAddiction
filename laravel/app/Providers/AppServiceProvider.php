<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use App\Auth\AdministratorEloquentUserProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // personal_access_tokens のマイグレーションを無効化
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Auth::provider(
        //     'administrator_eloquent_user_provider',
        //     function ($app, array $config) {
        //         return new AdministratorEloquentUserProvider($app['hash'], $config['model']);
        //     }
        // );
    }
}
