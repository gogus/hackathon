<?php

namespace App;

use LogicException;
use Silex\Application;

class RoutesLoader
{
    /**
     * @var Application
     */
    private $app;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->instantiateControllers();
    }

    private function instantiateControllers()
    {
        $this->app['index.controller'] = function () {
            return new Controllers\IndexController();
        };

        $this->app['callback.controller'] = function () {
            return new Controllers\CallbackController(
                $this->app['facebook.messenger.service'],
                $this->app['query.parser.service']
            );
        };
    }

    /**
     * @throws LogicException
     */
    public function bindRoutesToControllers()
    {
        $api = $this->app["controllers_factory"];

        $api->get('/index', "index.controller:indexAction");
        $api->post('/callback/messenger', "callback.controller:facebookMessengerAction");

        $this->app->mount($this->app["api.endpoint"] . '/' . $this->app["api.version"], $api);
    }
}
