<?php

namespace App\Domain\ApiClient\WeatherApiClient\Response;

/**
 * Response in Openweathermap API format: https://openweathermap.org/current#current_JSON
 *
 * Some of the data was skipped intentionally.
 */
class Response
{

    protected $parkingName;
    protected $parkingTotalSpaces;
    protected $parkingFreeSpaces;
    protected $parkingAddress;


    public function __construct()
    {

    }

    /**
     * @param array $data
     *
     * @return Response
     */
    public static function fromArray(array $data)
    {

    }
}