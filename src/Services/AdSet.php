<?php

namespace Gentor\LaravelFacebookAds\Services;


use Gentor\LaravelFacebookAds\Traits\HasAds;
use Gentor\LaravelFacebookAds\Traits\HasInsights;

/**
 * Class AdSet
 *
 * @property \FacebookAds\Object\AdSet $facebookObject
 * @package Gentor\LaravelFacebookAds\Services
 */
class AdSet extends AbstractService
{
    use HasAds, HasInsights;

    /**
     * AdSet constructor.
     * @param $adSet
     */
    public function __construct($adSet)
    {
        if (is_object($adSet)) {
            $this->facebookObject = $adSet;
        } else {
            $this->facebookObject = new \FacebookAds\Object\AdSet($adSet);
        }
    }
}