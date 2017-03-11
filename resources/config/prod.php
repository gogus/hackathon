<?php

$app['log.level'] = Monolog\Logger::ERROR;
$app['api.version'] = "v1";
$app['api.endpoint'] = "/api";
$app['fb.access_token'] = 'EAAJ4pzDROJwBANhEhVUnhZCpAE8VaKGwSu9wCsCAQM8Bpew2THlE0klfHraRGmiiY9NXc5ZAjb9gwsHaJZAuZBozUREVXXhew4dCfDLZCoXZBFqY2tXCsp35jXqn5DeDwLPXN1jiOZCkKsmppRY1qE0kZBpohdEUKYRbsvLIXtkBwwZDZD';
$app['fb.fanpage_id'] = '1205834489534388';

/**
 * SQLite database file
 */
$app['db.options'] = array(
    'driver' => 'pdo_sqlite',
    'path' => realpath(ROOT_PATH . '/app.db'),
);

$app['weather.base_uri'] = 'https://api.tfl.lu/v1/Weather';
$app['weather.timeout'] = 2;

$app['bike.base_uri'] = 'https://api.tfl.lu/v1/BikePoint';
$app['bike.timeout'] = 10;
$app['carpark.base_uri'] = 'https://api.tfl.lu/v1/Occupancy/CarPark';

$app['api.client.address_base_uri'] = 'https://nominatim.openstreetmap.org/search/?format=json&addressdetails=1&limit=1&accept-language=en_US&countrycodes=lu&q=';
$app['api.client.journey_uri_pattern'] = 'https://api.tfl.lu/v1/Journey/%f,%f/to/%f,%f';

/**
 * MySQL
 */
//$app['db.options'] = array(
//  "driver" => "pdo_mysql",
//  "user" => "root",
//  "password" => "root",
//  "dbname" => "prod_db",
//  "host" => "prod_host",
//);
