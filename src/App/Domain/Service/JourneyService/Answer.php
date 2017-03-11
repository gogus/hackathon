<?php

namespace App\Domain\Service\JourneyService;

class Answer
{
    /**
     * @var Location
     */
    private $from;

    /**
     * @var Location
     */
    private $to;

    /**
     * @var string[]
     */
    private $trip;

    /**
     * @param Location  $from
     * @param Location  $to
     * @param string[] $trip
     */
    public function __construct(Location $from, Location $to, array $trip)
    {
        $this->from = $from;
        $this->to = $to;
        $this->trip = $trip;
    }

    /**
     * @return Location
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return Location
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return \string[]
     */
    public function getTrip()
    {
        return $this->trip;
    }
}