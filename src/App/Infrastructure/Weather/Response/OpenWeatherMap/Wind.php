<?php

namespace App\Infrastructure\Weather\Response\OpenWeatherMap;

class Wind
{
    /**
     * Wind speed.
     * Unit Default: meter/sec, Metric: meter/sec, Imperial: miles/hour.
     *
     * @var float
     */
    private $speed;

    /**
     * Wind direction, degrees (meteorological)
     *
     * @var float
     */
    private $degrees;

    /**
     * @param float $speed
     * @param float $degrees
     */
    public function __construct($speed, $degrees)
    {
        $this->speed = $speed;
        $this->degrees = $degrees;
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function fromArray(array $data)
    {
        return new self($data['speed'], $data['deg']);
    }

    /**
     * @return float
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @return float
     */
    public function getDegrees()
    {
        return $this->degrees;
    }
}