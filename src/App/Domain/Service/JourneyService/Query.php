<?php

namespace App\Domain\Service\JourneyService;

class Query
{
    /**
     * @var Location
     */
    protected $from;

    /**
     * @var Location
     */
    protected $to;

    /**
     * @param Location $from
     * @param Location $to
     */
    public function __construct(Location $from, Location $to)
    {
        $this->from = $from;
        $this->to = $to;
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
}