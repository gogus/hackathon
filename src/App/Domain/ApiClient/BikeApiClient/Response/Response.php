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
     * Statuses
     *
     * @var array[]
     */
    private $dockStatus;

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
        $dockStatus
    ) {
        $this->photo = $photo;
        $this->docks = $docks;
        $this->availableBikes = $availableBikes;
        $this->availableEbikes = $availableEbikes;
        $this->dockStatus = $dockStatus;
    }

    /**
     * @param array $data
     *
     * @return Response
     */
    public static function fromArray(array $data)
    {
        return new self(
            $data['photo'],
            $data['docks'],
            $data['availableBikes'],
            $data['availableEbikes'],
            $data['dockStatus']
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
     * @return \array[]
     */
    public function getDockStatus()
    {
        return $this->dockStatus;
    }

    /**
     * @param \array[] $dockStatus
     * @return Response
     */
    public function setDockStatus($dockStatus)
    {
        $this->dockStatus = $dockStatus;
        return $this;
    }

}