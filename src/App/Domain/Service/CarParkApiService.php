<?php

namespace App\Domain\Service;

use App\Domain\ApiClient\CarParkApiClient\Response;
use App\Domain\ApiClient\ApiClient;

class CarParkApiService implements ServiceInterface
{
    protected $apiCarparkClient;

    /**
     * ApiService constructor.
     *
     * @param ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->apiCarparkClient = $apiClient;
    }

    /**
     * @param null $query
     * @return Weather
     */
    public function ask($query = null)
    {
        $data = $this->apiCarparkClient->makeCall();
        file_put_contents('test334', var_export($data['features'], true));

        $dataEntity = Response::fromArray($data['features']);

        return $dataEntity;
    }
}
