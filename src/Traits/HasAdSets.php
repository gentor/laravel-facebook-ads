<?php

namespace Gentor\LaravelFacebookAds\Traits;


use Gentor\LaravelFacebookAds\Services\AdSet;
use Illuminate\Support\Collection;

/**
 * Trait HasAdSets
 * @package Gentor\LaravelFacebookAds\Traits
 */
trait HasAdSets
{
    /**
     * @param string[] $fields Fields to request
     * @param array $params Additional request parameters
     * @param bool $pending
     * @return Collection
     *
     * @see https://developers.facebook.com/docs/marketing-api/reference/ad-account/adsets/
     */
    public function adSets($fields = ['all'], array $params = [], $pending = false)
    {
        $this->prepareFields($fields, \FacebookAds\Object\AdSet::class);
        $this->prepareParams($params);
        $response = $this->facebookObject()->getAdSets($fields, $params, $pending);

        return $this->response($response, AdSet::class);
    }

}