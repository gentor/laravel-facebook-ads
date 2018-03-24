<?php

namespace Gentor\LaravelFacebookAds\Services;

use FacebookAds\Api;


/**
 * Class FacebookAds
 * @package Gentor\LaravelFacebookAds\Services
 */
class FacebookAds
{
    /**
     * @var string|int
     */
    protected $facebookUserId;

    /**
     * FacebookAds constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        Api::init($config['app_id'], $config['app_secret'], $config['user_token']);
        $this->facebookUserId = $config['user_id'];
    }

    /**
     * @param $accountId
     * @return \Gentor\LaravelFacebookAds\Services\AdAccount
     */
    public function adAccount($accountId)
    {
        return new AdAccount($accountId);
    }

    /**
     * @param array $fields
     * @param array $params
     * @return \Illuminate\Support\Collection
     */
    public function adAccounts(array $fields = ['all'], array $params = [])
    {
        $adAccounts = new AdAccount();
        $adAccounts->setUser($this->facebookUserId);

        return $adAccounts->all($fields, $params);
    }
}