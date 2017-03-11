<?php

namespace App;

use App\Domain\Callback\FacebookMessengerCallback;
use App\Domain\QueryParser;
use App\Domain\Service\ApiClient\WeatherApiClient\WeatherApiClient;
use GuzzleHttp\Client;
use Silex\Application;

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

        $this->app['api.client.wather'] = function () {
            return new WeatherApiClient(
                $this->app['weather.base_uri'],
                $this->app['weather.timeout'],
                new Client()
            );
        };

        $this->app['query.parser.service'] = function () {
            return new QueryParser();
        };
    }
}
