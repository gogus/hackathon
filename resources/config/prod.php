<?php

$app['log.level'] = Monolog\Logger::ERROR;
$app['api.version'] = "v1";
$app['api.endpoint'] = "/api";
$app['fb.access_token'] = 'EAAJ4pzDROJwBANhEhVUnhZCpAE8VaKGwSu9wCsCAQM8Bpew2THlE0klfHraRGmiiY9NXc5ZAjb9gwsHaJZAuZBozUREVXXhew4dCfDLZCoXZBFqY2tXCsp35jXqn5DeDwLPXN1jiOZCkKsmppRY1qE0kZBpohdEUKYRbsvLIXtkBwwZDZD';
$app['fb.fanpage_id'] = '1205834489534388';

$app['memcached'] = 'localhost';

$app['weather.base_uri'] = 'https://api.tfl.lu/v1/Weather';
$app['weather.timeout'] = 2;

$app['bike.base_uri'] = 'https://api.tfl.lu/v1/BikePoint';
$app['bike.timeout'] = 10;

$app['place.base_uri'] = 'https://maps.googleapis.com/maps/api/place/textsearch/json?key=AIzaSyClXr-C6_i6edx5e3eoxQAkZccCM93jun4';
$app['place.timeout'] = 10;

$app['carpark.base_uri'] = 'https://api.tfl.lu/v1/Occupancy/CarPark';

$app['api.client.address_base_uri'] = 'https://nominatim.openstreetmap.org/search/?format=json&addressdetails=1&limit=1&accept-language=en_US&countrycodes=lu&q=';
$app['api.client.journey_uri_pattern'] = 'https://api.tfl.lu/v1/Journey/%f,%f/to/%f,%f';
