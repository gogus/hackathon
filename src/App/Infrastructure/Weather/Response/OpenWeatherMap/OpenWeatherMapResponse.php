<?php

namespace App\Infrastructure\Weather\Response\OpenWeatherMap;

/**
 * Response in Openweathermap API format: https://openweathermap.org/current#current_JSON
 *
 * Some of the data was skipped intentionally.
 */
class OpenWeatherMapResponse
{
    /**
     * @var City
     */
    private $city;

    /**
     * @var Weather
     */
    private $weather;

    /**
     * @var Main
     */
    private $main;

    /**
     * @var Wind
     */
    private $wind;

    /**
     * @var Clouds
     */
    private $clouds;

    /**
     * Visibility, m
     *
     * @var int
     */
    private $visibility;

    /**
     * @param City    $city
     * @param Weather $weather
     * @param Main    $main
     * @param Wind    $wind
     * @param Clouds  $clouds
     * @param int     $visibility
     */
    public function __construct(
        City $city,
        Weather $weather,
        Main $main,
        Wind $wind,
        Clouds $clouds,
        $visibility
    )
    {
        $this->city = $city;
        $this->weather = $weather;
        $this->main = $main;
        $this->wind = $wind;
        $this->clouds = $clouds;
        $this->visibility = $visibility;
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function fromArray(array $data)
    {
        return new self(
            new City($data['name']),
            Weather::fromArray($data['weather']),
            Main::fromArray($data['main']),
            Wind::fromArray($data['wind']),
            Clouds::fromArray($data['clouds']),
            $data['visibility']
        );
    }

    /**
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return Weather
     */
    public function getWeather()
    {
        return $this->weather;
    }

    /**
     * @return Main
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * @return Wind
     */
    public function getWind()
    {
        return $this->wind;
    }

    /**
     * @return Clouds
     */
    public function getClouds()
    {
        return $this->clouds;
    }

    /**
     * @return int
     */
    public function getVisibility()
    {
        return $this->visibility;
    }
}