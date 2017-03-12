<?php

namespace App\Domain\ApiClient\BikeApiClient;

use App\Domain\ApiClient\ApiClient;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class BikeApiClient implements ApiClient
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

        return $jsonRes;
    }
}
