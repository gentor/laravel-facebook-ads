<?php

namespace Gentor\LaravelFacebookAds\Traits;


use Gentor\LaravelFacebookAds\Services\Ad;
use Illuminate\Support\Collection;

/**
 * Trait HasAds
 * @property \FacebookAds\Object\AdAccount $facebookObject
 * @package Gentor\LaravelFacebookAds\Traits
 */
trait HasAds
{
    /**
     * @param string[] $fields Fields to request
     * @param array $params Additional request parameters
     * @param bool $pending
     * @return Collection
     *
     * @see https://developers.facebook.com/docs/marketing-api/reference/ad-account/ads/
     */
    public function ads($fields = ['all'], array $params = [], $pending = false)
    {
        $this->prepareFields($fields, \FacebookAds\Object\Ad::class);
        $response = $this->facebookObject->getAds($fields, $params, $pending);

        return $this->response($response, Ad::class);
    }


}