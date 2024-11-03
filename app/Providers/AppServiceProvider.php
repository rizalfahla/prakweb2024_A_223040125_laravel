<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
        Model::preventLazyLoading();

        // Pendaftaran komponen 
        Blade::component('dashboard.components.navbar-dashboard', 'navbar-dashboard');
        
        Blade::component('dashboard.components.layout-dashboard', 'layout-dashboard'); 

        Blade::component('dashboard.components.sidebar', 'sidebar'); 

    }
}
