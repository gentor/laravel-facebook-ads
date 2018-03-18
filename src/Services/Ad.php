<?php

namespace Gentor\LaravelFacebookAds\Services;


class Ad extends AbstractService
{
    public function __construct($ad)
    {
        if (is_object($ad)) {
            $this->facebookObject = $ad;
        } else {
            $this->facebookObject = new \FacebookAds\Object\Ad($ad);
        }
    }
}