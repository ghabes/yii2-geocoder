<?php

namespace ghabes\geocoder\coders;

use ghabes\geocoder\abstraction\CoderAbstract;
use ghabes\geocoder\objects\GoogleObject;
use Curl\Curl;
use yii\helpers\ArrayHelper;

class GoogleCoder extends CoderAbstract
{
    protected function execute($query, array $params = [])
    {
        $curl = new Curl();

        $data = $curl->get('http://maps.googleapis.com/maps/api/geocode/json', array_merge([
            'address' => $query
        ], $params));

        $limit = (int) ArrayHelper::getValue($params, 'results', 0);
        $objects = [];

        if (!$data) {
            return null;
        }

        try {
            $items = ArrayHelper::getValue($data, 'results');

            if ($items) {
                foreach ($items as $item) {
                    $objects[] = new GoogleObject(ArrayHelper::toArray($item));
                }
            }

            if ($limit === 1 && count($objects)) {
                return $objects[0];
            }

        } catch (\Exception $e) {
            return null;
        }

        return $objects;
    }

}