<?php

namespace App\Domain\Service\JourneyService;

class Coordinates
{
    /**
     * @var float
     */
    protected $lat;

    /**
     * @var float
     */
    protected $lon;

    /**
     * @param float $lat
     * @param float $lon
     */
    public function __construct($lat = .0, $lon = .0)
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @return float
     */
    public function getLon()
    {
        return $this->lon;
    }
}