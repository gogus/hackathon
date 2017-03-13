<?php

namespace App\Domain\Service;

use App\Domain\ApiClient\PlaceApiClient\Response\Response;
use App\Domain\ApiClient\PlaceApiClient\PlaceApiClient;

/**
 * Class ApiService
 * @package App\Domain\Service
 */
class PlaceService implements ServiceInterface
{
    /**
     * @var array
     */
    private static $wordsNotUsed = ['me', 'to','place', 'places', 'monument', 'attraction', 'attractions'];

    /**
     * @var PlaceApiClient
     */
    protected $placeApiClient;

    /**
     * PlaceService constructor.
     * @param PlaceApiClient $placeApiClient
     */
    public function __construct(PlaceApiClient $placeApiClient)
    {
        $this->placeApiClient = $placeApiClient;
    }

    /**
     * @param null $query
     * @param string $token
     * @return Response|string
     */
    public function ask($query = null, $token = '')
    {
        $query = strtolower($query);
        $query = preg_replace('/[^a-zA-Z \[\]\.0-9]+/', "", $query);
        $query = str_replace(self::$wordsNotUsed, "", $query);
        $query = str_replace(' ', "%20", $query);


        if ($query) {
            $from = $this->getBikeStationByName($query);
        } else {
            $from = $this->getPlaceByCurrentLocation();
        }

        return $from;
    }

    /**
     * @param string $keyword
     *
     * @return Response
     */
    private function getBikeStationByName($keyword)
    {
        if(false === strpos($keyword, 'luxembourg')){
            $keyword .= '%20in%20Luxembourg';
        }
        return Response::fromArray($this->placeApiClient->makeCall("&query=".$keyword));
    }

    /**
     * @return Response
     */
    private function getPlaceByCurrentLocation()
    {
        $keyword = 'Forum%20Campus%20Geesseknappchen';

        return Response::fromArray($this->placeApiClient->makeCall("&query=".$keyword));
    }
}
