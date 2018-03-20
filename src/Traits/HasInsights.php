<?php

namespace Gentor\LaravelFacebookAds\Traits;


use FacebookAds\Object\AdsInsights;

/**
 * Trait HasInsights

 * @property \FacebookAds\Object\AdAccount $facebookObject
 * @package Gentor\LaravelFacebookAds\Traits
 */
trait HasInsights
{
    /**
     * @param string[] $fields Fields to request
     * @param array $params Additional request parameters
     * @param bool $pending
     * @return bool|\FacebookAds\Object\AdsInsights
     *
     * @see https://developers.facebook.com/docs/marketing-api/reference/ad-account/insights/
     */
    public function insights($fields = ['all'], array $params = [], $pending = false)
    {
        $this->prepareFields($fields, AdsInsights::class);

        return $this->facebookObject->getInsights($fields, $params, $pending)->current();
    }
}