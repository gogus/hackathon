<?php
namespace App\Domain\Service;

use App\Domain\ApiClient\BikeApiClient\Response\Response;
use App\Domain\ApiClient\BikeApiClient\BikeApiClient;
use App\Domain\Service\BikeService\Coordinates;

/**
 * Class ApiService
 * @package App\Domain\Service
 */
class BikeApiService implements ServiceInterface
{
    /**
     * @var BikeApiClient
     */
    protected $bikeApiClient;

    /**
     * ApiService constructor.
     * @param $bikeApiClient
     */
    public function __construct(BikeApiClient $bikeApiClient)
    {
        $this->bikeApiClient = $bikeApiClient;
    }

    /**
     * @param null $query
     * @return Response
     */
    public function ask($query = null)
    {
        if (empty($query)) {
            return '';
        }

        $matches = [];
        $matched = preg_match('/(journey|bike|station|bikestation)\s+(?:from\s+?(?<from>.*)\s+)/', $query, $matches);

        if (empty($matched)) {
            throw new \Exception('Query parsing failed');
        }

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
        $long = 49.5105111;
        $lat = 5.9952203;
        $radius = 1;

        return Response::fromArray($this->bikeApiClient->makeCall("/around/{$long}/{$lat}/{$radius}"));
    }
}
