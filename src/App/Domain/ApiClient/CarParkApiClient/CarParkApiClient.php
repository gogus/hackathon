<?php

namespace App\Domain\ApiClient\CarParkApiClient;

use App\Domain\ApiClient\ApiClient;
use Exception;
use GuzzleHttp\Client;

class CarParkApiClient implements ApiClient
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var Client
     */
    protected $guzzleClient;

    /**
     * @param string $url
     * @param Client $guzzleClient
     */
    public function __construct($url, Client $guzzleClient)
    {
        $this->url = $url;
        $this->guzzleClient = $guzzleClient;
    }

    public function makeCall($param = null)
    {
        $res = $this->guzzleClient->get($this->url)->getBody()->getContents();

        $jsonRes = json_decode($res, true);

        if (!$jsonRes) {
            throw new Exception('Invalid response data:' . var_export($res, true));
        }

        return $jsonRes;
    }
}
