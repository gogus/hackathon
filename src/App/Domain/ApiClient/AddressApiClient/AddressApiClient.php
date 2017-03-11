<?php

namespace App\Domain\ApiClient\AddressApiClient;

use App\Domain\ApiClient\ApiClient;
use Exception;
use GuzzleHttp\Client;

class AddressApiClient implements ApiClient
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @param Client $client
     * @param string $baseUrl
     */
    public function __construct(Client $client, $baseUrl)
    {
        $this->client = $client;
        $this->baseUrl = $baseUrl;
    }

    public function makeCall($params = null)
    {
        $url = $this->baseUrl . urlencode($params);
        $response = $this->client->get($url)->getBody()->getContents();
        $responseArray = json_decode($response, true);

        if (!$responseArray) {
            throw new Exception('Invalid response:' . var_export($response, true));
        }

        return $responseArray;
    }
}