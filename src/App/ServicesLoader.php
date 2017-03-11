<?php

namespace App;

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
            return new Services\FacebookMessengerService(
                $this->app['db'],
                $this->app['fb.access_token'],
                $this->app['fb.fanpage_id']
            );
        };

        $this->app['query.parser.service'] = function() {
            return new Services\QueryParserService(
                $this->app['db']
            );
        };
    }
}
