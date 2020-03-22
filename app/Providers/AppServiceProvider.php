<?php

namespace App\Providers;

use App\Observers\OfferObserver;
use App\Observers\UserObserver;
use App\Offer;
use App\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
use NumberFormatter;
use Swift_Plugins_ThrottlerPlugin;

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
        /**
         * Observers
         */
        Offer::observe(OfferObserver::class);
        User::observe(UserObserver::class);

        $throttleRate = config('mail.throttle_to_messages_per_sec');
        if ($throttleRate) {
            $throttlerPlugin = new Swift_Plugins_ThrottlerPlugin($throttleRate, \Swift_Plugins_ThrottlerPlugin::MESSAGES_PER_SECOND);
            Mail::getSwiftMailer()->registerPlugin($throttlerPlugin);
        }

        /**
         * Includes
         */
        Blade::include('includes.inputs.cta-button', 'ctabutton');
        Blade::include('includes.inputs.hidden','hidden');

        /**
         * Directives
         */


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
