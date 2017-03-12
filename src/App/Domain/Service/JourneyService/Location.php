<?php

namespace App\Domain\Service\JourneyService;

use Exception;

class Location
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Coordinates
     */
    protected $coordinates;

    /**
     * @param string      $name
     * @param Coordinates $coordinates
     */
    public function __construct($name, Coordinates $coordinates)
    {
        $this->name = $name;
        $this->coordinates = $coordinates;
    }

    /**
     * @param array $data
     *
     * @return Location
     * @throws Exception
     */
    public static function fromArray(array $data)
    {
        if (empty($data)) {
            throw new Exception('Address not found');
        }

        $data = $data[0];

        if (!isset($data['address'])) {
            throw new Exception('Response did not contain address ' . var_export($data, true));
        }

        $address = $data['address'];
        if (isset($address['road'])) {
            $name = $address['road'];
        } elseif (isset($address['city_district'])) {
            $name = $address['city_district'];
        } elseif (isset($address['suburb'])) {
            $name = $address['suburb'];
        } elseif (isset($address['city'])) {
            $name = $address['city'];
        } elseif (isset($address['country'])) {
            $name = $address['country'];
        } else {
            throw new Exception('Address did not contain either road, district, city or country name');
        }

        if (!isset($data['lat']) || !isset($data['lon'])) {
            throw new Exception('Address does not contain lat and lon');
        }

        return new self($name, new Coordinates($data['lat'], $data['lon']));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Coordinates
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }
}