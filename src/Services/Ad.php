<?php

namespace Gentor\LaravelFacebookAds\Services;


use Gentor\LaravelFacebookAds\Traits\HasInsights;

class Ad extends AbstractService
{
    use HasInsights;

    public function __construct($ad)
    {
        if (is_object($ad)) {
            $this->facebookObject = $ad;
        } else {
            $this->facebookObject = new \FacebookAds\Object\Ad($ad);
        }
    }
}