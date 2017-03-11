<?php

namespace App\Domain\ApiClient\WeatherApiClient;

use App\Domain\ApiClient\ApiClient;
use Exception;
use GuzzleHttp\Client;

class WeatherApiClient implements ApiClient
{
    /**
     * @var string
     */
    protected $url;
    /**
     * @var ClientInterface
     */
    protected $guzzleClient;

    /**
     * @param $url
     * @param $timeout
     * @param Client $guzzleClient
     */
    public function __construct($url, Client $guzzleClient)
    {
        $this->url = $url;
        $this->guzzleClient = $guzzleClient;
    }

    public function makeCall($param = null)
    {
        $res     = $this->guzzleClient->get($this->url)->getBody()->getContents();
        $jsonRes = json_decode($res, true);

        if (!$jsonRes) {
            throw new Exception('message:' . var_export($res,true));
        }

       return $jsonRes;
    }
}
