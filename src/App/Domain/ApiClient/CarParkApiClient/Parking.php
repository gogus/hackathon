<?php

namespace App\Domain\ApiClient\CarParkApiClient;

/**
 * Class Parking
 * @package App\Domain\ApiClient\CarParkApiClient\Response
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
     * @param $data
     */
    public function __construct(array $data)
    {
        $this->name         = $data['properties']['name'];
        $this->totalSpaces  = $data['properties']['total'];
        $this->freeSpaces   = $data['properties']['free'];
        $this->address      = $data['properties']['meta']['address']['street'];
    }


    /**
     * @param array $data
     * @return Parking
     */
    public static function fromArray(array $data)
    {
        return new self($data);
    }

    /**
     * @return mixed
     */
    public function getParkingName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getParkingTotalSpaces()
    {
        return $this->getParkingTotalSpaces();
    }

    /**
     * @return mixed
     */
    public function getParkingFreeSpaces()
    {
        return $this->freeSpaces;
    }

    /**
     * @return mixed
     */
    public function getParkingAddress()
    {
        return $this->address;
    }
}