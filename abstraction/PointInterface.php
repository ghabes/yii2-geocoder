<?php

namespace ghabes\geocoder\abstraction;

use ghabes\geocoder\Point;

/**
 * Interface PointInterface
 * @package ghabes\yii2-geocoder
 */
interface PointInterface
{

    /**
     * Returns Point object
     *
     * @return Point
     */
    public function getPoint();

    /**
     * @param Point $point
     *
     * @return void
     */
    public function setPoint(Point $point);

}
