<?php

namespace App\Domain\ApiClient\PlaceApiClient;

use App\Domain\ApiClient\ApiClient;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class PlaceApiClient implements ApiClient
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var
     */
    protected $timeout;

    /**
     * @var ClientInterface
     */
    protected $guzzleClient;

    /**
     * @param $url
     * @param $timeout
     * @param Client $guzzleClient
     */
    public function __construct($url, $timeout, Client $guzzleClient)
    {
        $this->url = $url;
        $this->timeout = $timeout;
        $this->guzzleClient = $guzzleClient;
    }

    public function makeCall($param = null)
    {
        $res     = $this->guzzleClient->get($this->url.$param)->getBody()->getContents();
        $jsonRes = json_decode($res, true);

        if (!$jsonRes) {
            throw new Exception('message:' . var_export($res,true));
        }
        $response['photo']    = 'https://maps.googleapis.com/maps/api/place/photo?maxwidth=1000&photoreference='.$jsonRes['results'][0]['photos'][0]['photo_reference'].'&key=AIzaSyClXr-C6_i6edx5e3eoxQAkZccCM93jun4';
        $response['name']     = $jsonRes['results'][0]['name'];
        $response['link']     = 'https://www.google.lu/maps/search/'. $response['name'];
        $response['address'] = isset($jsonRes['results'][0]['formatted_address'])?$jsonRes['results'][0]['formatted_address']:'false';
        $response['isOpened'] = isset($jsonRes['results'][0]['opening_hours']['open_now'])?$jsonRes['results'][0]['opening_hours']['open_now']:'false';

        return $response;
    }
}
