<?php

namespace Gentor\LaravelFacebookAds\Services;


class Campaign extends AbstractService
{
    public function __construct($campaign)
    {
        if (is_object($campaign)) {
            $this->facebookObject = $campaign;
        } else {
            $this->facebookObject = new \FacebookAds\Object\Campaign($campaign);
        }
    }
}