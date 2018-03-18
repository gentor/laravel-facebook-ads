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
     * @return AdAccount
     */
    public function adAccount($accountId)
    {
        return new AdAccount($accountId);
    }

    /**
     * @return AdAccounts
     */
    public function adAccounts()
    {
        return new AdAccounts($this->facebookUserId);
    }
}