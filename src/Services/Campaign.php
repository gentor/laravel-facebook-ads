<?php

namespace Gentor\LaravelFacebookAds\Services;


use Gentor\LaravelFacebookAds\Traits\HasAds;
use Gentor\LaravelFacebookAds\Traits\HasAdSets;
use Gentor\LaravelFacebookAds\Traits\HasInsights;

/**
 * Class Campaign
 *
 * @property \FacebookAds\Object\Campaign $facebookObject
 * @package Gentor\LaravelFacebookAds\Services
 */
class Campaign extends AbstractService
{
    use HasAds, HasAdSets, HasInsights;

    /**
     * Campaign constructor.
     * @param $campaign
     */
    public function __construct($campaign)
    {
        if (is_object($campaign)) {
            $this->facebookObject = $campaign;
        } else {
            $this->facebookObject = new \FacebookAds\Object\Campaign($campaign);
        }
    }
}