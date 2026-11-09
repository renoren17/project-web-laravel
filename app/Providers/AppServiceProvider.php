<?php

namespace App\Providers;

use App\Models\Genre;
use App\Models\User;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Gate::define('user', fn (User $user): bool => $user->role?->name === 'user');
        Gate::define('admin', fn (User $user): bool => $user->role?->name === 'admin');

        if(Schema::hasTable('genres'))
        {
            view()->share('genres', Genre::all());
            Paginator::useBootstrap();
        }
    }
}
