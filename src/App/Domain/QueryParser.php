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
        $query = preg_replace("/[^a-zA-Z]+/", "", $query);
        $words = explode(' ', $query);
        $words = array_map('strtolower', $words);

        file_put_contents('test4', $query);

        foreach (static::$services as $serviceName => $service) {
            foreach ($service as $word) {
                $word = strtolower($word);
                if (in_array($word, $words)) {
                    file_put_contents('test5', $word);
                    return $this->app['service.' . $serviceName]->ask($query);
                }
            }
        }

        return self::MESSAGE_NOT_UNDERSTOOD;
    }
}