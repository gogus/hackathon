<?php

namespace App\Domain\ApiClient\WeatherApiClient;

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
        $res = $this->guzzleClient->get($this->url);
        $jsonRes = json_decode($res,true);
        if(!$jsonRes){
            throw new \Exception('message:'.var_export($res,true));
        }

       return Response::fromArray($jsonRes);
    }
}
