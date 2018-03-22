<?php

namespace Gentor\LaravelFacebookAds\Services;


use FacebookAds\Object\AdAccountUser;
use Illuminate\Support\Collection;

/**
 * Class AdAccounts
 * @package Gentor\LaravelFacebookAds\Services
 */
class AdAccounts extends AbstractService
{
    /**
     * @var AdAccountUser
     */
    protected $user;

    /**
     * AdAccounts constructor.
     *
     * @param $facebookUserNode
     */
    public function __construct($facebookUserNode)
    {
        $this->user = new AdAccountUser($facebookUserNode);
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
}