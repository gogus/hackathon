<?php

namespace App\Domain\ApiClient\CarParkApiClient;

use App\Domain\ApiClient\ApiClient;
use GuzzleHttp\Client;

class CarParkApiClient implements ApiClient
{
    protected $guzzleClient;
    protected $url;

    /**
     * CarParkApiClient constructor.
     *
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
        file_put_contents('test33', var_export($jsonRes, true));

        if (!$jsonRes) {
            throw new Exception('message:' . var_export($res, true));
        }

        return $jsonRes;
    }
}
