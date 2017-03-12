<?php

namespace App\Domain\ApiClient\BikeApiClient\Response;

/**
 * BikeService API
 */
class Response
{
    /**
     * @var string
     */
    private $photo;

    /**
     * @var string
     */
    private $docks;

    /**
     * @var string
     */
    private $availableBikes;

    /**
     * @var string
     */
    private $availableEbikes;

    /**
     * Distance
     *
     * @var string
     */
    private $distance;

    /**
     * Address
     *
     * @var string
     */
    private $address;

    /**
     * Response constructor.
     * @param string $photo
     * @param string $docks
     * @param string $availableBikes
     * @param string $availableEbikes
     * @param array $dockStatus
     */
    public function __construct(
        $photo,
        $docks,
        $availableBikes,
        $availableEbikes,
        $availableDocks,
        $distance,
        $address,
        $name
    ) {
        $this->photo = $photo;
        $this->docks = $docks;
        $this->availableBikes = $availableBikes;
        $this->availableEbikes = $availableEbikes;
        $this->availableDocks = $availableDocks;
        $this->distance = $distance;
        $this->address = $address;
        $this->name = $name;
    }

    /**
     * @param array $data
     *
     * @return Response
     */
    public static function fromArray(array $data)
    {
        $bike = $data['features'][0]['properties'];
        return new self(
            $bike['photo'],
            $bike['docks'],
            $bike['available_bikes'],
            $bike['available_ebikes'],
            $bike['available_docks'],
            $bike['distance'],
            $bike['address'],
            $bike['name']
        );
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     * @return Response
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocks()
    {
        return $this->docks;
    }

    /**
     * @param string $docks
     * @return Response
     */
    public function setDocks($docks)
    {
        $this->docks = $docks;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvailableBikes()
    {
        return $this->availableBikes;
    }

    /**
     * @param string $availableBikes
     * @return Response
     */
    public function setAvailableBikes($availableBikes)
    {
        $this->availableBikes = $availableBikes;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvailableEbikes()
    {
        return $this->availableEbikes;
    }

    /**
     * @param string $availableEbikes
     * @return Response
     */
    public function setAvailableEbikes($availableEbikes)
    {
        $this->availableEbikes = $availableEbikes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     * @return Response
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAvailableDocks()
    {
        return $this->availableDocks;
    }

    /**
     * @param mixed $availableDocks
     * @return Response
     */
    public function setAvailableDocks($availableDocks)
    {
        $this->availableDocks = $availableDocks;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDistance()
    {
        return (int)$this->distance;
    }

    /**
     * @param mixed $distance
     * @return Response
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}