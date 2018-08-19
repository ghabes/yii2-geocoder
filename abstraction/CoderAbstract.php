<?php

namespace deka6pb\geocoder\abstraction;

use deka6pb\geocoder\Point;

abstract class CoderAbstract extends \yii\base\BaseObject implements CoderInterface
{
    /**
     * Maximum number of attempts to get data
     */
    const MAX_ATTEMPT = 5;

    public $options = ['format' => 'json'];

    public static function findByAddress($address, array $options = [])
    {
        if (false === is_string($address)) {
            throw new \InvalidArgumentException('Address must be a string');
        }

        return (new static)->getData($address, $options);
    }

    public static function findOneByAddress($address, array $options = [])
    {
        return static::findByAddress($address, array_merge(['results' => 1], $options));
    }

    public static function findByPoint(Point $point, array $options = [])
    {

        return (new static)->getData($point->toString(), $options);
    }

    public static function findByOnePoint(Point $point, array $options = [])
    {
        return static::findByPoint($point, array_merge(['results' => 1], $options));
    }

    private function getData($query, array $options)
    {
        $objects = null;

        for ($i = 0; $i < self::MAX_ATTEMPT; $i++) {
            $objects = $this->execute($query, $options);

            if (!is_null($objects)) {
                break;
            }
        }

        return $objects;
    }

    abstract protected function execute($query, array $options = []);
}