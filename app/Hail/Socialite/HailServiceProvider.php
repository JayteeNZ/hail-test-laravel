<?php

namespace App\Hail\Socialite;

use App\Hail\Socialite\HailProvider;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory as SocialiteFactory;

/**
 * For the purpose of this assessment, I have included the ServiceProvider
 * here rather than in App/Providers, to keep the code all grouped
 * and able to be turned into a composer package etc.
 */

class HailServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * 
     * @return null
     */
    public function boot()
    {
        $socialite = $this->app->make(SocialiteFactory::class);

        $socialite->extend('hail', function ($app) use ($socialite) {
            $config = $app['config']['services.hail'];
            return $socialite->buildProvider(
                HailProvider::class,
                $config
            );
        });
    }
}