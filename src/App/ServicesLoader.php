<?php

namespace App;

use App\Services\Callback\FacebookMessengerCallback;
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
        $this->app['facebook.messenger.service'] = function() {
            return new FacebookMessengerCallback(
                new Client(),
                $this->app['fb.access_token'],
                $this->app['fb.fanpage_id']
            );
        };
    }
}
