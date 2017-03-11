<?php

namespace App\Services;

/**
 * Class QueryParserService
 *
 * @package App\Services
 */
class QueryParserService extends BaseService
{
    const MESSAGE_NOT_UNDERSTOOD = 'Huh! what do you mean?';

    /**
     * @var array
     */
    private static $services = [
        'weather' => ['weather', 'temperature', 'hot', 'cold'],
        'time' => ['time', 'current']
    ];

    /**
     * QueryParserService constructor.
     * @param $db
     */
    public function __construct($db)
    {
        parent::__construct($db);
    }

    /**
     * @param string $query
     */
    public function queryParse($query)
    {
        $words = explode(' ', $query);
        $words = array_map('strtolower', $words);
        foreach (static::$services as $serviceName => $service) {
            foreach ($service as $word) {
                $word = strtolower($word);
                if (in_array($word, $words)) {
                    $serviceClass = '\App\Services\\' . $serviceName;

                    return new $serviceClass($query);
                }
            }
        }

        return self::MESSAGE_NOT_UNDERSTOOD;
    }
}