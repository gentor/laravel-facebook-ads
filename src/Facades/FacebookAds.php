<?php

namespace Gentor\LaravelFacebookAds\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class FacebookAds
 * @package Gentor\LaravelFacebookAds\Facades
 */
class FacebookAds extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'facebook-ads';
    }
}