<?php

namespace App\Domain\Callback\Formatter;

use App\Domain\ApiClient\CarParkApiClient\Parking;
use App\Domain\ApiClient\WeatherApiClient\Response\Response;
use App\Domain\Service\JourneyService\Answer;

class StringFormatter implements FormatterInterface
{
    public function format($response)
    {
        if ($response instanceof Response)
        {
            $response = sprintf(
                "The temperature in %s is %d°C, the wind is %d m/s, humidity is %d%%, pressure is %d hPa",
                $response->getCity()->getName(),
                $response->getMain()->getTemperature(),
                $response->getWind()->getSpeed(),
                $response->getMain()->getHumidity(),
                $response->getMain()->getPressure()
            );
        }

        if ($response instanceof Parking)
        {
            if ($response->getFreeSpaces() > 0)
            {
                $response = sprintf(
                    'Parking spot at %s has %d free spaces out of %d',
                    $response->getName(),
                    $response->getFreeSpaces(),
                    $response->getTotalSpaces()
                );
            }
            else
            {
                $response = sprintf('Parking spot at %s is full', $response->getName());
            }
        }

        if ($response instanceof Answer)
        {
            $response = sprintf(
                "Route from %s to %s\n%s",
                $response->getFrom()->getName(),
                $response->getTo()->getName(),
                implode("\n", $response->getTrip())
            );
        }

        return [
            'text' => (string)$response
        ];
    }
}
