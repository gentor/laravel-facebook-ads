<?php

namespace Gentor\LaravelFacebookAds\Traits;


use FacebookAds\Object\AdsInsights;
use Illuminate\Support\Collection;

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
        $this->prepareFields($fields, AdsInsights::class);

        if (empty($params)) {
            $params = [
                'date_preset' => 'this_month'
            ];
        }

        $response = $this->facebookObject->getInsights($fields, $params, $pending);

        return $this->response($response);
    }
}