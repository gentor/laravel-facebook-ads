<?php

namespace Gentor\LaravelFacebookAds\Services;


use Gentor\LaravelFacebookAds\Traits\HasAds;
use Gentor\LaravelFacebookAds\Traits\HasAdSets;
use Gentor\LaravelFacebookAds\Traits\HasInsights;
use Gentor\LaravelFacebookAds\Traits\Summary;

/**
 * Class Campaign
 *
 * @property \FacebookAds\Object\Campaign $facebookObject
 * @package Gentor\LaravelFacebookAds\Services
 */
class Campaign extends AbstractService
{
    use HasAds, HasAdSets, HasInsights;

    protected $facebookClass = \FacebookAds\Object\Campaign::class;
}