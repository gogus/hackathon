<?php

namespace App\Infrastructure\Weather;

class Main
{
    /**
     * Temperature.
     *
     * Unit Default: Kelvin, Metric: Celsius, Imperial: Fahrenheit.
     *
     * @var float
     */
    private $temperature;

    /**
     * Humidity, %.
     *
     * @var int
     */
    private $humidity;

    /**
     * Atmospheric pressure, hPa.
     *
     * @var float
     */
    private $pressure;

    /**
     * @param float $temperature
     * @param int   $humidity
     * @param float $pressure
     */
    public function __construct($temperature, $humidity, $pressure)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function fromArray(array $data)
    {
        return new self($data['temp'], $data['humidity'], $data['pressure']);
    }

    /**
     * @return float
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @return int
     */
    public function getHumidity()
    {
        return $this->humidity;
    }

    /**
     * @return float
     */
    public function getPressure()
    {
        return $this->pressure;
    }
}