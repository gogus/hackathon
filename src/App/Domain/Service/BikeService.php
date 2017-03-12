<?php

namespace App\Domain\Service;

use App\Domain\ApiClient\BikeApiClient\Response\Response;
use App\Domain\ApiClient\BikeApiClient\BikeApiClient;

/**
 * Class ApiService
 * @package App\Domain\Service
 */
class BikeService implements ServiceInterface
{
    /**
     * @var BikeApiClient
     */
    protected $bikeApiClient;

    /**
     * @param BikeApiClient $bikeApiClient
     */
    public function __construct(BikeApiClient $bikeApiClient)
    {
        $this->bikeApiClient = $bikeApiClient;
    }

    public function ask($query = null, $token = '')
    {
        if (empty($query)) {
            return '';
        }

        $matches = [];
        preg_match('/(?:from\s+?(?<from>.*)\s+)/', $query, $matches);

        if (isset($matches['from'])) {
            $from = $this->getBikeStationByName($matches['from']);
        } else {
            $from = $this->getBikeStationByCurrentLocation();
        }

        return $from;
    }

    /**
     * @param string $name
     *
     * @return Response
     */
    private function getBikeStationByName($name)
    {
        return Response::fromArray($this->bikeApiClient->makeCall('/Search/' . $name));
    }

    /**
     * @return Response
     */
    private function getBikeStationByCurrentLocation()
    {
        $long = '5.9952203';
        $lat = '49.5105111';
        $radius = 500;

        return Response::fromArray($this->bikeApiClient->makeCall("/around/{$long}/{$lat}/{$radius}"));
    }
}
