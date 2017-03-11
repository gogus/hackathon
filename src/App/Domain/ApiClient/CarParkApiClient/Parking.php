<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 3/11/2017
 * Time: 9:54 PM
 */

namespace App\Domain\ApiClient\WeatherApiClient\Response;


/**
 * Class Parking
 * @package App\Domain\ApiClient\WeatherApiClient\Response
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
        return $this->parkingName;
    }

    /**
     * @return mixed
     */
    public function getParkingTotalSpaces()
    {
        return $this->parkingTotalSpaces;
    }

    /**
     * @return mixed
     */
    public function getParkingFreeSpaces()
    {
        return $this->parkingFreeSpaces;
    }

    /**
     * @return mixed
     */
    public function getParkingAddress()
    {
        return $this->parkingAddress;
    }

}