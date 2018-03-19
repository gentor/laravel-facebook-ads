<?php

namespace Gentor\LaravelFacebookAds\Traits;


use Gentor\LaravelFacebookAds\Services\AdSet;
use Illuminate\Support\Collection;

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

        if (empty($params)) {
            $params = [
                'date_preset' => 'this_month'
            ];
        }

        $response = $this->facebookObject->getAdSets($fields, $params, $pending);

        return $this->response($response, AdSet::class);
    }

}