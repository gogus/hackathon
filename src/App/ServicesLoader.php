<?php

namespace App;

use App\Domain\Callback\FacebookMessengerCallback;
use App\Domain\Callback\Formatter\FormatterFactory;
use App\Domain\Callback\Formatter\StringFormatter;
use App\Domain\QueryParser;
use App\Domain\Service\TimeService;
use GuzzleHttp\Client;
use Silex\Application;
use App\Domain\Service\WeatherApiService;
use App\Domain\ApiClient\WeatherApiClient\WeatherApiClient;

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
                $this->app['weather.timeout'],
                $this->app['api.client']
            );
        };

        $this->app['query.parser.service'] = function () {
            return new QueryParser($this->app);
        };

        $this->app['service.time'] = function () {
            return new TimeService();
        };

        $this->app['service.weather'] = function () {
            return new WeatherApiService($this->app['api.client.weather']);
        };
    }
}
