<?php

namespace Gentor\LaravelFacebookAds\Services;


use Gentor\LaravelFacebookAds\Traits\HasAds;
use Gentor\LaravelFacebookAds\Traits\HasInsights;

/**
 * Class AdSet
 *
 * @property int|string $facebookObjectId
 * @package Gentor\LaravelFacebookAds\Services
 */
class AdSet extends AbstractService
{
    use HasAds, HasInsights;

    protected $facebookClass = \FacebookAds\Object\AdSet::class;
}