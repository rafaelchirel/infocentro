<?php

namespace Infocentro\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory as Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));

        //Regla validacion - patron Cedula Venezuela V-20527745 V-20527745-1 E-20527745 V-20527745-1
        $this->app->validator->extendImplicit('cedula', function ($attribute, $value, $parameters) {
            $patron = "/^(V|E){1}(-){1}([0-9]){7,8}(-[1-9]\d?)?$/";
            return preg_match($patron, $value);
        }, 'Cedula invalida. Ingrese el Formato Requerido.');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
