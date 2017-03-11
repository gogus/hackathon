<?php

namespace App\Domain\ApiClient\WeatherApiClient\Response;

class Weather
{
    /**
     * @var string
     */
    private $main;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $iconId;

    /**
     * @param string $main
     * @param string $description
     * @param string $iconId
     */
    public function __construct($main, $description, $iconId)
    {
        $this->main = $main;
        $this->description = $description;
        $this->iconId = $iconId;
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function fromArray(array $data)
    {
        return new self($data['main'], $data['description'], $data['icon']);
    }

    /**
     * @return string
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getIconId()
    {
        return $this->iconId;
    }
}