<?php

namespace Gentor\LaravelFacebookAds\Traits;


trait Summary
{
    protected function prepareParams(&$params)
    {
        parent::prepareParams($params);
        $params = array_merge([
            'default_summary' => true
        ], $params);
    }
}