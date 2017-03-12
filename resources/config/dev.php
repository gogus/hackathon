<?php

require __DIR__ . '/prod.php';

$app['debug'] = true;
$app['log.level'] = Monolog\Logger::DEBUG;
$app['memcached'] = 'memcache';

$app['weather.base_uri'] = 'https://api.tfl.lu/v1/Weather';
$app['carpark.base_uri'] = 'https://api.tfl.lu/v1/Occupancy/CarPark';