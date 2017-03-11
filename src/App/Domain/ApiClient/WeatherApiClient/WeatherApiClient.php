<?php

namespace App\Domain\Service\ApiClient\WeatherApiClient;

use App\Domain\ApiClient\ApiClient;
use App\Domain\ApiClient\WeatherApiClient\Response\Response;
use GuzzleHttp\ClientInterface;

class WeatherApiClient implements ApiClient
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
     * @param ClientInterface $guzzleClient
     */
    public function __construct($url, $timeout, ClientInterface $guzzleClient)
    {
        $this->url = $url;
        $this->timeout = $timeout;
        $this->guzzleClient = $guzzleClient;
    }

    public function makeCall($param = null)
    {
       return Response::fromArray(json_decode($this->guzzleClient($this->url,$this->timeout)));
    }

}