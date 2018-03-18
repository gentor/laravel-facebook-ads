<?php

namespace Gentor\LaravelFacebookAds\Services;

use FacebookAds\Cursor;
use FacebookAds\Object\AbstractCrudObject;
use FacebookAds\Object\AdsInsights;
use FacebookAds\Object\Fields\AdAccountFields;
use Illuminate\Support\Collection;

/**
 * Class AbstractService
 * @package Gentor\LaravelFacebookAds\Services
 */
abstract class AbstractService
{
    /**
     * @var AbstractCrudObject|\FacebookAds\Object\AdAccount
     */
    public $facebookObject;

    /**
     * @param string $name
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->facebookObject->getData())) {
            return $this->facebookObject->getData()[$name];
        } else {
            throw new \InvalidArgumentException(
                $name . ' is not a field of ' . get_class($this));
        }
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->facebookObject->getData();
    }

    /**
     * @return $this
     */
    public function loadInfo()
    {
        $this->facebookObject = $this->read();

        return $this;
    }

    /**
     * Read object data from the graph
     *
     * @param string[] $fields Fields to request
     * @param array $params Additional request parameters
     * @return \FacebookAds\Object\AdAccount
     */
    public function read(array $fields = ['all'], array $params = [])
    {
        $this->prepareFields($fields);

        return $this->facebookObject->read($fields, $params);
    }

    /**
     * @param string[] $fields Fields to request
     * @param array $params Additional request parameters
     * @param bool $pending
     * @return Collection
     *
     * @see https://developers.facebook.com/docs/marketing-api/reference/ad-account/adsets/
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

    /**
     * Transform a FacebookAds\Cursor object into a Collection.
     *
     * @param Cursor $response
     * @param null $class
     * @return Collection
     */
    public function response(Cursor $response, $class = null)
    {
        $data = new Collection();
        while ($response->current()) {
            if (!$class) {
                $data->push($response->current());
            } else {
                $data->push(new $class($response->current()));
            }
//            $data->push($response->current()->getData());
            $response->next();
        }

        return $data;
    }

    /**
     * @param $fields
     * @param string:null $class
     */
    protected function prepareFields(&$fields, $class = null)
    {
        if (!$class) {
            $class = get_class($this->facebookObject);
        }

        if (isset($fields[0]) && 'all' == $fields[0]) {
            /** @var AbstractCrudObject $class */
            $fields = array_filter($class::getFields(), function ($value) {
                return !in_array($value, [AdAccountFields::SHOW_CHECKOUT_EXPERIENCE]);
            });
        }
    }
}