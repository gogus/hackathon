<?php

namespace App\Domain\ApiClient\CarParkApiClient;

/**
 * Parking service response.
 * Some of the data was skipped intentionally.
 *
 * @package App\Domain\ApiClient\CarParkApiClient\Response
 */
class Response
{
    /**
     * @var Parking[]
     */
    protected $parkings;

    /**
     * @param Parking[] $parkings
     */
    public function __construct(array $parkings = [])
    {
        $this->parkings = $parkings;
    }

    /**
     * @param array $parkings
     *
     * @return Response
     */
    public static function fromArray(array $parkings)
    {
        $response = new self();

        foreach ($parkings as $parking)
        {
            $parkingArea = Parking::fromArray($parking);
            $response->parkings[$parkingArea->getName()] = $parkingArea;
        }

        return $response;
    }

    /**
     * @return Parking[]
     */
    public function getParkings()
    {
        return $this->parkings;
    }
}
