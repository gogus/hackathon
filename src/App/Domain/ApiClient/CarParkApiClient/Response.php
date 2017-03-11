<?php

namespace App\Domain\ApiClient\CarParkApiClient;

/**
 * Some of the data was skipped intentionally.
 */

use App\Domain\ApiClient\WeatherApiClient\Parking;

/**
 * Class Response
 * @package App\Domain\ApiClient\CarParkApiClient\Response
 */
class Response
{
    /**
     * @var Parking[]
     */
    protected $parkings = [];

    /**
     * @param array $data
     *
     * @return Response
     */
    public static function fromArray(array $data)
    {
        $response = new self();

        foreach ($data as $row)
        {
            $response->parkings[] = new Parking($row);
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
