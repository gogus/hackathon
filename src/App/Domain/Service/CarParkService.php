<?php

namespace App\Domain\Service;

use App\Domain\ApiClient\CarParkApiClient\Parking;
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

        $parkings = [];
        foreach ($data['features'] as $p) {
            $park = $p['properties'];
            $parkings[strtolower($park['name'])] = $park;
        }
        unset($data);

        $parking = $this->findParkingByQuery($parkings, $query, $token);

        return $parking;
    }

    /**
     * @param array  $parkings
     * @param string $query
     * @param string $token
     *
     * @return array|string
     */
    private function findParkingByQuery(array $parkings, $query = '', $token)
    {
        if (empty($query)) {
            return $this->findClosestParking($parkings);
        }

        $query = strtolower($query);

        $parking = $this->findRecursive($parkings, $query, $token);
        if ($parking !== false) {
            return Parking::fromArray($parking);
        }

        return 'Parking spot not found';
    }

    /**
     * @param array $parkings
     *
     * @return array
     */
    private function findClosestParking(array $parkings)
    {
        $closest = array_shift($parkings);

        return $closest;
    }

    /**
     * @param array  $parkings
     * @param string $query
     * @param string $token
     *
     * @return array|false
     */
    private function findRecursive(array $parkings, $query, $token)
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
     * @param array $parkings
     * @param array $words
     *
     * @return array|false
     */
    private function recur(array $parkings, array $words)
    {
        if (empty($parkings) || empty($words)) {
            return false;
        }

        $name = implode(' ', $words);
        if (array_key_exists($name, $parkings)) {
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
