<?php

namespace App\Domain\Callback\Formatter;

use App\Domain\ApiClient\WeatherApiClient\Response\Response;

class StringFormatter implements FormatterInterface
{
    public function format($response)
    {
        if ($response instanceof Response)
        {
            return sprintf(
                "The temperature in %s is %d°C, the wind is %d m/s, humidity is %d%%, pressure is %d hPa",
                $response->getCity()->getName(),
                $response->getMain()->getTemperature(),
                $response->getWind()->getSpeed(),
                $response->getMain()->getHumidity(),
                $response->getMain()->getPressure()
            );
        }

        return (string)$response;
    }
}