<?php

namespace Gentor\LaravelFacebookAds\Services;

use Gentor\LaravelFacebookAds\Traits\HasAds;
use Gentor\LaravelFacebookAds\Traits\HasAdSets;
use Gentor\LaravelFacebookAds\Traits\HasInsights;
use Illuminate\Support\Collection;


/**
 * Class AdAccount
 *
 * @property \FacebookAds\Object\AdAccount $facebookObject
 * @package Gentor\LaravelFacebookAds\Services
 */
class AdAccount extends AbstractService
{
    use HasAds, HasAdSets, HasInsights;

    protected $facebookClass = \FacebookAds\Object\AdAccount::class;

    /**
     * AdAccount constructor.
     * @param $node
     */
    public function __construct($node = null)
    {
        $this->prepareAccountId($node);
        parent::__construct($node);
    }

    /**
     * @param string[] $fields Fields to request
     * @param array $params Additional request parameters
     * @param bool $pending
     * @return Collection
     *
     * @see https://developers.facebook.com/docs/marketing-api/reference/ad-account/campaigns/
     */
    public function campaigns($fields = ['all'], array $params = [], $pending = false)
    {
        $this->prepareFields($fields, \FacebookAds\Object\Campaign::class);
        $response = $this->facebookObject->getCampaigns($fields, $params, $pending);

        return $this->response($response, Campaign::class);
    }

    /**
     * @param $accountId
     */
    protected function prepareAccountId(&$accountId)
    {
        if (!is_object($accountId)) {
            $prefix = 'act_';
            if (false === stripos($accountId, $prefix)) {
                $accountId = $prefix . $accountId;
            }
        }
    }
}