<?php

namespace Gentor\LaravelFacebookAds\Services;

use FacebookAds\Object\AdAccountUser;
use Gentor\LaravelFacebookAds\Traits\HasAds;
use Gentor\LaravelFacebookAds\Traits\HasAdSets;
use Gentor\LaravelFacebookAds\Traits\HasInsights;
use Gentor\LaravelFacebookAds\Traits\Summary;
use Illuminate\Support\Collection;


/**
 * Class AdAccount
 *
 * @property int|string $facebookObjectId
 * @package Gentor\LaravelFacebookAds\Services
 */
class AdAccount extends AbstractService
{
    use HasAds, HasAdSets, HasInsights;

    /**
     * @var string
     */
    protected $facebookClass = \FacebookAds\Object\AdAccount::class;

    /**
     * @var AdAccountUser
     */
    protected $user;

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
     * List all user's ads accounts.
     *
     * @param string[] $fields Fields to request
     * @param array $params Additional request parameters
     * @return Collection
     *
     * @see https://developers.facebook.com/docs/marketing-api/reference/ad-account
     */
    public function all(array $fields = ['all'], array $params = [])
    {
        $this->prepareFields($fields, \FacebookAds\Object\AdAccount::class);
        $this->prepareParams($params);
        $response = $this->user->getAdAccounts($fields, $params);

        return $this->response($response, AdAccount::class);
    }

    /**
     * @param $facebookUserId
     */
    public function setUser($facebookUserId)
    {
        $this->user = new AdAccountUser($facebookUserId);
    }

    /**
     * @param string[] $fields Fields to request
     * @param array $params Additional request parameters
     * @param bool $pending
     * @return Collection|AdAccount[]
     *
     * @see https://developers.facebook.com/docs/marketing-api/reference/ad-account/campaigns/
     */
    public function campaigns($fields = ['all'], array $params = [], $pending = false)
    {
        $this->prepareFields($fields, \FacebookAds\Object\Campaign::class);
        $this->prepareParams($params);
//        $params = array_merge(['default_summary' => true], $params);
        $response = $this->facebookObject()->getCampaigns($fields, $params, $pending);

        return $this->response($response, Campaign::class);
    }

    /**
     * @param $accountId
     */
    protected function prepareAccountId(&$accountId)
    {
        if (!is_null($accountId) && !is_object($accountId)) {
            $prefix = 'act_';
            if (false === stripos($accountId, $prefix)) {
                $accountId = $prefix . $accountId;
            }
        }
    }
}