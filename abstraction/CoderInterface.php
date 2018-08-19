<?php

namespace ghabes\geocoder\abstraction;

use ghabes\geocoder\Point;

/**
 * Interface PointInterface
 * @package common\components\geo
 */
interface CoderInterface
{
    /**
     * @param $address
     * @param array $options
     * @return mixed
     */
    public static function findByAddress($address, array $options = []);

    /**
     * @param $address
     * @param array $options
     * @return mixed
     */
    public static function findOneByAddress($address, array $options = []);

    /**
     * @param Point $point
     * @param array $options
     * @return mixed
     */
    public static function findByPoint(Point $point, array $options = []);

    /**
     * @param Point $point
     * @param array $options
     * @return mixed
     */
    public static function findByOnePoint(Point $point, array $options = []);
}
