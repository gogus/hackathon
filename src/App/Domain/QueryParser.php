<?php

namespace App\Domain;

class QueryParser
{
    const MESSAGE_NOT_UNDERSTOOD = 'Huh! what do you mean?';

    /**
     * @var array
     */
    private static $services = [
        'weather' => ['weather', 'temperature', 'hot', 'cold'],
        'timeApi' => ['time', 'current']
    ];

    /**
     * @param string $query
     *
     * @return string
     */
    public function queryParse($query)
    {
        $words = explode(' ', $query);
        $words = array_map('strtolower', $words);
        foreach (static::$services as $serviceName => $service) {
            foreach ($service as $word) {
                $word = strtolower($word);
                if (in_array($word, $words)) {
                    $serviceClass = '\App\Domain\\Service\\' . ucfirst($serviceName). 'Service';

                    return (new $serviceClass())->ask($query);
                }
            }
        }

        return self::MESSAGE_NOT_UNDERSTOOD;
    }
}