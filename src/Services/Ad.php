<?php

namespace Gentor\LaravelFacebookAds\Services;


use Gentor\LaravelFacebookAds\Traits\HasInsights;

/**
 * Class Ad
 * @package Gentor\LaravelFacebookAds\Services
 */
class Ad extends AbstractService
{
    use HasInsights;

    protected $facebookClass = \FacebookAds\Object\Ad::class;
}