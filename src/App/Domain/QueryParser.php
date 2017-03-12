<?php

namespace App\Domain;

use Silex\Application;

class QueryParser
{
    const MESSAGE_NOT_UNDERSTOOD = 'Huh! What do you mean?';

    /**
     * @var array
     */
    private static $services = [
        'weather' => ['weather', 'temperature', 'hot', 'cold'],
        'time'    => ['time', 'current'],
        'carpark' => ['parking', 'park', 'car'],
        'bike'    => ['bike', 'station', 'bicycle', 'bik', 'bikepoint', 'bikestation'],
        'journey' => ['journey', 'go', 'get', 'bus', 'way', 'route', 'train'],
    ];

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param string $query
     *
     * @return string
     */
    public function queryParse($query)
    {
        $query = preg_replace('/[^a-zA-Z \[\]\.0-9]+/', "", $query);
        $words = explode(' ', $query);
        $words = array_map('strtolower', $words);

        foreach (static::$services as $serviceName => $service) {
            foreach ($service as $word) {
                $word = strtolower($word);
                if (in_array($word, $words)) {
                    return $this->app['service.' . $serviceName]->ask($query, $word);
                }
            }
        }

        return self::MESSAGE_NOT_UNDERSTOOD;
    }
}