<?php
namespace App\Domain\Service;

use App\Domain\ApiClient\CarParkApiClient\Response\Response;
use App\Domain\ApiClient\ApiClient;

class CarParkApiService implements ServiceInterface
{

    protected $apiCarparkClient;

    /**
     * ApiService constructor.
     * @param $apiWeatherClient
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
        $dataEntity = Response::fromArray($data);

        return $dataEntity;
    }
}
