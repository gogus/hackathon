<?php

namespace App;

use App\Domain\ApiClient\AddressApiClient\AddressApiClient;
use App\Domain\ApiClient\JourneyApiClient\JourneyApiClient;
use App\Domain\Callback\FacebookMessengerCallback;
use App\Domain\Callback\Formatter\FormatterFactory;
use App\Domain\QueryParser;
use App\Domain\Service\JourneyService\JourneyService;
use App\Domain\Service\TimeService;
use App\Services\PreviousQueryService;
use GuzzleHttp\Client;
use Silex\Application;
use App\Domain\Service\WeatherApiService;
use App\Domain\ApiClient\WeatherApiClient\WeatherApiClient;
use App\Domain\ApiClient\CarParkApiClient\CarParkApiClient;
use App\Domain\Service\CarParkService;
use App\Domain\Service\BikeService;

class ServicesLoader
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @return void
     */
    public function bindServicesIntoContainer()
    {
        $this->app['api.client'] = function () {
            return new Client();
        };

        $this->app['previous_query.service'] = function () {
            return new PreviousQueryService(
                $this->app['cache']
            );
        };

        $this->app['facebook.messenger.service'] = function () {
            return new FacebookMessengerCallback(
                $this->app['api.client'],
                $this->app['fb.access_token'],
                $this->app['fb.fanpage_id']
            );
        };

        $this->app['facebook.formatter'] = function () {
            return new FormatterFactory();
        };

        $this->app['api.client.weather'] = function () {
            return new WeatherApiClient(
                $this->app['weather.base_uri'],
                $this->app['api.client']
            );
        };

        $this->app['api.client.carpark'] = function () {
            return new CarParkApiClient(
                $this->app['carpark.base_uri'],
                $this->app['api.client']
            );
        };

        $this->app['api.client.bike'] = function () {
            return new WeatherApiClient(
                $this->app['bike.base_uri'],
                $this->app['bike.timeout'],
                $this->app['api.client']
            );
        };

        $this->app['api.client.address'] = function () {
            return new AddressApiClient(
                $this->app['api.client'],
                $this->app['api.client.address_base_uri']
            );
        };

        $this->app['api.client.journey'] = function () {
            return new JourneyApiClient(
                $this->app['api.client'],
                $this->app['api.client.journey_uri_pattern']
            );
        };

        $this->app['query.parser.service'] = function () {
            return new QueryParser($this->app);
        };

        $this->app['service.time'] = function () {
            return new TimeService();
        };

        //Domain Services
        $this->app['service.weather'] = function () {
            return new WeatherApiService($this->app['api.client.weather']);
        };

        $this->app['service.carpark'] = function () {
            return new CarParkService($this->app['api.client.carpark']);
        };

        $this->app['service.bike'] = function () {
            return new BikeService($this->app['api.client.bike']);
        };

        $this->app['service.journey'] = function () {
            return new JourneyService(
                $this->app['api.client.address'],
                $this->app['api.client.journey'],
                $this->app['monolog']
            );
        };
    }
}
