<?php

namespace Gentor\LaravelFacebookAds\Services;


class AdSet extends AbstractService
{
    public function __construct($adSet)
    {
        if (is_object($adSet)) {
            $this->facebookObject = $adSet;
        } else {
            $this->facebookObject = new \FacebookAds\Object\AdSet($adSet);
        }
    }
}