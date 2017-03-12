<?php

namespace App\Domain\Service;

use App\Domain\ApiClient\CarParkApiClient\Parking;
use App\Domain\ApiClient\CarParkApiClient\Response;
use App\Domain\ApiClient\ApiClient;

class CarParkService implements ServiceInterface
{
    protected $apiCarParkClient;

    /**
     * ApiService constructor.
     *
     * @param ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->apiCarParkClient = $apiClient;
    }

    public function ask($query = null, $token = '')
    {
        $data = $this->apiCarParkClient->makeCall();

        $allParkings = Response::fromArray($data['features']);

        return $this->findParkingByQuery($allParkings, $query, $token);
    }

    /**
     * @param Response $parkings
     * @param string   $query
     *
     * @param          $token
     *
     * @return Parking|string
     */
    private function findParkingByQuery(Response $parkings, $query = '', $token)
    {
        if (empty($query))
        {
            return $this->findClosestParking($parkings);
        }

        $query = strtolower($query);

        $parking = $this->findRecursive($parkings->getParkings(), $query, $token);
        if ($parking !== false)
        {
            return $parking;
        }

        return 'Parking spot not found';
    }

    /**
     * @param Response $parkings
     *
     * @return Parking
     */
    private function findClosestParking(Response $parkings)
    {
        $allParkings = $parkings->getParkings();
        $closest = array_shift($allParkings);

        return $closest;
    }

    /**
     * @param Parking[] $parkings
     * @param string    $query
     *
     * @return bool|Parking
     */
    private function findRecursive($parkings, $query, $token)
    {
        $pos = strpos($query, $token);
        $head = trim(substr($query, 0, $pos));
        $tail = trim(substr($query, $pos + strlen($token)));

        $parking = false;
        if (!empty($head)) {
            $parking = $this->recur($parkings, explode(' ', $head));
        }

        if (!empty($tail) && $parking === false) {
            $parking = $this->recur($parkings, explode(' ', $tail));
        }

        return $parking;
    }

    /**
     * Sorry, brain damage
     *
     * @param Parking[] $parkings
     * @param array     $words
     *
     * @return bool|Parking
     */
    private function recur(array $parkings, array $words)
    {
        if (empty($parkings) || empty($words))
        {
            return false;
        }

        $name = implode(' ', $words);
        if (array_key_exists($name, $parkings))
        {
            return $parkings[$name];
        }

        $headWords = $words;
        array_pop($headWords);
        $headSearch = $this->recur($parkings, $headWords);
        if ($headSearch) {
            return $headSearch;
        }

        $tailWords = $words;
        array_shift($tailWords);
        $tailSearch = $this->recur($parkings, $tailWords);
        if ($tailSearch) {
            return $tailSearch;
        }

        return false;
    }
}
