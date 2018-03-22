<?php

namespace Gentor\LaravelFacebookAds\Services;

use FacebookAds\Cursor;
use FacebookAds\Object\AbstractCrudObject;
use FacebookAds\Object\AbstractObject;
use FacebookAds\Object\Fields\AdAccountFields;
use FacebookAds\Object\Fields\AdSetFields;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Class AbstractService
 * @package Gentor\LaravelFacebookAds\Services
 */
abstract class AbstractService
{
    /**
     * @var AbstractCrudObject
     */
    protected $facebookObject;

    protected $facebookClass;

    protected $params = [
        'limit' => 50,
    ];

    /**
     * AdAccount constructor.
     * @param $node
     */
    public function __construct($node = null)
    {
        if ($node instanceof $this->facebookClass) {
            $this->populateData($node);
            $node = $node->id;
        }

        $this->facebookObject = new $this->facebookClass($node);
    }

    /**
     * @param string $key
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function __get($key)
    {
        $data = $this->getData();
        if (Arr::exists($data, $key)) {
            return $data[$key];
        }

        return null;
    }

    /**
     * Get an item from the data using "dot" notation.
     *
     * @param $item
     * @return mixed
     */
    public function get($item)
    {
        return Arr::get(Arr::dot($this->toArray()), $item);
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
//        $this->facebookObject = $this->read();
        $this->populateData($this->read());

        return $this;
    }

    /**
     * Read object data from the graph
     *
     * @param string[] $fields Fields to request
     * @param array $params Additional request parameters
     * @return \FacebookAds\Object\AbstractCrudObject
     */
    public function read(array $fields = ['all'], array $params = [])
    {
        $this->prepareFields($fields);
        $this->prepareParams($params);

        return $this->facebookObject->read($fields, $params);
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

            $response->next();
        }

        return $data;
    }

    /**
     * @return mixed
     */
    public function toArray()
    {
        $data = clone $this;
        unset($data->facebookObject);
        $array = json_decode(json_encode($data), true);
        unset($data);

        return $array;
    }

    /**
     * @param $fields
     * @param string :null $class
     */
    protected function prepareFields(&$fields, $class = null)
    {
        if (!$class) {
            $class = $this->facebookClass;
        }

        if (isset($fields[0]) && 'all' == $fields[0]) {
            /** @var AbstractCrudObject $class */
            $fields = array_filter($class::getFields(), function ($value) {
                return !in_array($value, [
                    AdAccountFields::SHOW_CHECKOUT_EXPERIENCE,
                    AdSetFields::DAILY_IMPS,
                ]);
            });
        }
    }

    protected function prepareParams(&$params)
    {
        $params = array_merge($this->params, $params);
    }

    /**
     * @param $array
     * @return array
     */
    protected function flattenData($array)
    {
        return array_map(function ($value) {
            if (!is_array($value)) {
                return $value;
            }

            $data = [];
            foreach ($value AS $item) {
                if (is_array($item) && !is_array(Arr::first($item))) {
                    $data[Arr::first($item)] = Arr::last($item);
                } else {
                    $data = $value;
                }
            }

            return $data;
        }, $array);
    }

    /**
     * @param AbstractObject $object
     */
    protected function populateData(AbstractObject $object)
    {
        $data = $this->flattenData($object->getData());
        foreach ($data as $key => $item) {
            if ('insights' == $key && $insights = $item['data'][0] ?? false) {
                $this->{$key} = json_decode(json_encode($this->flattenData($insights)));
            } else {
                $this->{$key} = json_decode(json_encode($item));
            }
        }
    }
}