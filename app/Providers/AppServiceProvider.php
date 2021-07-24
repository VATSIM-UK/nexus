<?php

namespace App\Providers;

use App\Auth\VATSIMUKProvider;
use App\Services\UKCP;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register our custom VATSIM UK Core SSO Socialite Provider
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'vatsimuk',
            function ($app) use ($socialite) {
                $config = $app['config']['services.vatsim_uk_core'];
                $config['redirect'] = route('auth.login.callback');

                return $socialite->buildProvider(VATSIMUKProvider::class, $config);
            }
        );

        $this->app->singleton(UKCP::class, fn ($app) => new UKCP());
    }
}
