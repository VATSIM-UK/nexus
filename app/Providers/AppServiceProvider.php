<?php

namespace App\Providers;

use InvalidArgumentException;
use App\Auth\VATSIMUKProvider;
use Illuminate\Support\Facades\Http;
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

        Http::macro('ukcp', function ($endpoint, $method = 'get', $body = []) {
            $apiToken = config('services.vatsim_uk_controller_api.token');
            $bodyRequiredMethods = ['post', 'patch'];
            $requestedMethodRequiresBody = in_array(strtolower($method), $bodyRequiredMethods);

            if ($requestedMethodRequiresBody && $body === []) {
                throw new InvalidArgumentException(sprintf("Body required when making request using %s", implode(separator: ', ', array: $bodyRequiredMethods)));
            }

            $baseHttpObject = Http::withToken($apiToken);

            $url = config('services.vatsim_uk_controller_api.base_url') . $endpoint;

            return $requestedMethodRequiresBody 
                ? $baseHttpObject->$method($url, $body)->json() 
                : $baseHttpObject->$method($url)->json();
        }); 
    }
}
