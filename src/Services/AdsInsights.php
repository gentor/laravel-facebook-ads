<?php

namespace Gentor\LaravelFacebookAds\Services;


/**
 * Class AdsInsights
 * @package Gentor\LaravelFacebookAds\Services
 */
class AdsInsights extends AbstractService
{
    protected $facebookClass = \FacebookAds\Object\AdsInsights::class;

    /**
     * AdsInsights constructor.
     * @param $insights
     */
    public function __construct($insights = null)
    {
        if ($insights instanceof $this->facebookClass) {
            $this->populateData($insights);
        }
    }
}