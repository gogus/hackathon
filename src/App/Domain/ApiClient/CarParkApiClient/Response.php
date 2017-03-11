<?php

namespace App\Domain\ApiClient\CarParkApiClient\Response;
use App\Domain\ApiClient\WeatherApiClient\Response\Parking;

/**
 * Some of the data was skipped intentionally.
 */
/**
 * Class Response
 * @package App\Domain\ApiClient\CarParkApiClient\Response
 */
class Response
{

    /**
     * @var array
     */
    protected static $parkings = [];


    /**
     * @param array $data
     *
     * @return Response
     */
    public static function fromArray(array $data)
    {
        foreach ($data as $row)
        {
            static::$parkings = Parking::fromArray($row);
        }
    }
}