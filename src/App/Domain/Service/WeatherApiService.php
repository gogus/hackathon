<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 3/11/2017
 * Time: 7:35 PM
 */

namespace App\Domain\Service;


use App\Domain\ApiClient\WeatherApiClient\Response\Weather;
use App\Domain\ApiClient\WeatherApiClient\WeatherApiClient;

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
     * ApiService constructor.
     * @param $apiWeatherClient
     */
    public function __construct(WeatherApiClient $apiWeatherClient)
    {
        $this->apiWeatherClient = $apiWeatherClient;
    }


    /**
     * @param null $query
     * @return Weather
     */
    public function ask($query = null)
    {
        $data = $this->apiWeatherClient->makeCall();
        $dataEntity = Weather::fromArray($data);
        return $dataEntity->getDescription();
    }
}