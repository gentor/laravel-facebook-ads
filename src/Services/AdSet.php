<?php

namespace Gentor\LaravelFacebookAds\Services;


use Gentor\LaravelFacebookAds\Traits\HasAds;
use Gentor\LaravelFacebookAds\Traits\HasInsights;

class AdSet extends AbstractService
{
    use HasAds, HasInsights;

    public function __construct($adSet)
    {
        if (is_object($adSet)) {
            $this->facebookObject = $adSet;
        } else {
            $this->facebookObject = new \FacebookAds\Object\AdSet($adSet);
        }
    }
}