<?php

namespace App\Domain\ApiClient\JourneyApiClient;

use App\Domain\ApiClient\ApiClient;
use App\Domain\Service\JourneyService\Query;
use GuzzleHttp\Client;

class JourneyApiClient implements ApiClient
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $uriPattern;

    /**
     * @param Client $client
     * @param string $uriPattern
     */
    public function __construct(Client $client, $uriPattern)
    {
        $this->client = $client;
        $this->uriPattern = $uriPattern;
    }

    public function makeCall($params = null)
    {
        /** @var Query $params */
        $uri = sprintf(
            $this->uriPattern,
            $params->getFrom()->getCoordinates()->getLat(),
            $params->getFrom()->getCoordinates()->getLon(),
            $params->getTo()->getCoordinates()->getLat(),
            $params->getTo()->getCoordinates()->getLon()
        );

        $response = $this->client->get($uri)->getBody()->getContents();
        $jsonResponse = json_decode($response, true);
        if (null === $jsonResponse)
        {
            throw new \Exception('Response contained invalid json');
        }

        return $jsonResponse;
    }
}