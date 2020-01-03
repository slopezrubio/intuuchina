<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Renombra la carpeta pública con el nombre 'intuuchina'
        /*$this->app->bind('path.public', function() {
            return base_path('public');
        });*/
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        Validator::extend('email_simple', function($attribute, $value, $parameters, $validator) {
            return filter_var($value, FILTER_VALIDATE_EMAIL);
        });
        View::composer('*', function($view) {
            $view_name = explode('.', $view->getName());
            $view_name = $view_name[count($view_name) - 1];
            view()->share('view_name', $view_name);
        });
    }
}
