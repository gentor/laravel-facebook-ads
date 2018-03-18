<?php

namespace Gentor\LaravelFacebookAds;


use Gentor\LaravelFacebookAds\Services\FacebookAds;
use Illuminate\Support\ServiceProvider;

/**
 * Class FacebookAdsServiceProvider
 * @package Gentor\LaravelFacebookAds
 */
class FacebookAdsServiceProvider extends ServiceProvider
{
    /**
     * Boot
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/facebook-ads.php' => config_path('facebook-ads.php'),
        ]);
    }

    /**
     * Register package
     */
    public function register()
    {
        $this->mergeConfig();
        $this->registerServices();
    }

    /**
     * Merge config
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/facebook-ads.php',
            'facebook-ads'
        );
    }

    /**
     * Register services
     */
    protected function registerServices()
    {
        $this->app->bind('facebook-ads', function ($app) {
            return new FacebookAds($app['config']['facebook-ads']);
        });
    }
}