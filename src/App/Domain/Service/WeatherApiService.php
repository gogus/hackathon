<?php

namespace App\Domain\Service;

use App\Domain\ApiClient\WeatherApiClient\Response\Response;
use App\Domain\ApiClient\WeatherApiClient\WeatherApiClient;
use App\Domain\ApiClient\ApiClient;

/**
 * Class ApiService
 * @package App\Domain\Service
 */
class WeatherApiService implements ServiceInterface
{
    /**
     * @var WeatherApiClient
     */
    protected $apiWeatherClient;

    /**
     * @param ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->apiWeatherClient = $apiClient;
    }

    public function ask($query = null, $token = '')
    {
        $data = $this->apiWeatherClient->makeCall();
        $dataEntity = Response::fromArray($data);

        return $dataEntity;
    }
}
