<?php

namespace App\Domain\Service;

use App\Domain\ApiClient\BikeApiClient\Response\Response;
use App\Domain\ApiClient\BikeApiClient\BikeApiClient;

/**
 * Class ApiService
 * @package App\Domain\Service
 */
class BikeApiService implements ServiceInterface
{
    /**
     * @var BikeApiClient
     */
    protected $bikeApiClient;

    /**
     * @param BikeApiClient $bikeApiClient
     */
    public function __construct(BikeApiClient $bikeApiClient)
    {
        $this->bikeApiClient = $bikeApiClient;
    }

    public function ask($query = null, $token = '')
    {

        $data = $this->bikeApiClient->makeCall('/');
        $dataEntity = Response::fromArray($data);

        return $dataEntity;
    }
}
