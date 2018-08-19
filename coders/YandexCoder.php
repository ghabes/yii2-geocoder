<?php

namespace ghabes\geocoder\coders;

use ghabes\geocoder\abstraction\CoderAbstract;
use ghabes\geocoder\objects\YandexObject;
use Curl\Curl;
use yii\helpers\ArrayHelper;

class YandexCoder extends CoderAbstract
{
    protected function execute($query, array $params = [])
    {
        $curl = new Curl();

        $data = $curl->get('https://geocode-maps.yandex.ru/1.x/', array_merge([
            'geocode' => $query, 'format' => 'json'
        ], $params));

        $limit = (int) ArrayHelper::getValue($params, 'results', 0);
        $objects = [];

        if (!$data) {
            return null;
        }
        
        try {
            $items = ArrayHelper::getValue($data, 'response.GeoObjectCollection.featureMember');

            if ($items) {
                foreach ($items as $item) {
                    $objects[] = new YandexObject(ArrayHelper::toArray($item));
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