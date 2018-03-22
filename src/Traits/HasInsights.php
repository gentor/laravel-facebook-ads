<?php

namespace Gentor\LaravelFacebookAds\Traits;


use Gentor\LaravelFacebookAds\Services\AdsInsights;
use Illuminate\Support\Collection;

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
     * @return Collection
     *
     * @see https://developers.facebook.com/docs/marketing-api/reference/ad-account/insights/
     */
    public function insights($fields = ['all'], array $params = [], $pending = false)
    {
        $this->prepareFields($fields, \FacebookAds\Object\AdsInsights::class);

        if ($key = array_first(array_keys($fields, 'insights'))) {
            unset($fields[$key]);
        }
        $response = $this->facebookObject->getInsights($fields, $params, $pending);

        return $this->response($response, AdsInsights::class);
    }

    /**
     * @param $fields
     * @param string :null $class
     */
    protected function prepareFields(&$fields, $class = null)
    {
        parent::prepareFields($fields, $class);
        $insightsFields = \FacebookAds\Object\AdsInsights::getFields();
        $insightsFields = implode(',', $insightsFields);
        $fields[] = "insights{{$insightsFields}}";
    }
}