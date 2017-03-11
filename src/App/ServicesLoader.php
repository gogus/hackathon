<?php

namespace App;

use App\Domain\Callback\FacebookMessengerCallback;
use App\Domain\QueryParser;
use App\Domain\Service\ApiClient\WeatherApiClient\WeatherApiClient;
use App\Domain\Service\TimeService;
use GuzzleHttp\Client;
use Silex\Application;
use App\Domain\Service\WeatherApiService;

/**
 * Class ServicesLoader
 *
 * @package App
 */
class ServicesLoader
{
    /** @var Application */
    protected $app;

    /**
     * ServicesLoader constructor.
     *
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
        $this->app['facebook.messenger.service'] = function () {
            return new FacebookMessengerCallback(
                new Client(),
                $this->app['fb.access_token'],
                $this->app['fb.fanpage_id']
            );
        };

        $this->app['api.client.weather'] = function () {
            return new WeatherApiClient(
                $this->app['weather.base_uri'],
                $this->app['weather.timeout'],
                new Client()
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
