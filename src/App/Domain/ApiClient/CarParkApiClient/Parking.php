<?php

namespace App\Domain\ApiClient\CarParkApiClient;

/**
 * Parking area
 */
class Parking
{
    /**
     * @var string Name
     */
    protected $name;

    /**
     * @var int totalSpaces
     */
    protected $totalSpaces;

    /**
     * @var int freeSpaces
     */
    protected $freeSpaces;

    /**
     * @var string address
     */
    protected $address;

    /**
     * @param string $name
     * @param int    $totalSpaces
     * @param int    $freeSpaces
     * @param string $address
     */
    public function __construct($name, $totalSpaces, $freeSpaces, $address)
    {
        $this->name = $name;
        $this->totalSpaces = $totalSpaces;
        $this->freeSpaces = $freeSpaces;
        $this->address = $address;
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function fromArray(array $data)
    {
        return new self(
            $data['properties']['name'],
            $data['properties']['total'],
            $data['properties']['free'],
            $data['properties']['meta']['address']['street']
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getTotalSpaces()
    {
        return $this->getTotalSpaces();
    }

    /**
     * @return int
     */
    public function getFreeSpaces()
    {
        return $this->freeSpaces;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
}