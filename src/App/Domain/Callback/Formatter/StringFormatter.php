<?php

namespace App\Domain\Callback\Formatter;

use App\Domain\ApiClient\CarParkApiClient\Parking;
use App\Domain\ApiClient\WeatherApiClient\Response\Response;
use App\Domain\Service\JourneyService\Answer;

class StringFormatter implements FormatterInterface
{
    public function format($response)
    {
        if ($response instanceof Response) {
            $response = sprintf(
                "The temperature in %s is %d°C, the wind is %d m/s, humidity is %d%%, pressure is %d hPa",
                'Luxembourg',
                $response->getMain()->getTemperature(),
                $response->getWind()->getSpeed(),
                $response->getMain()->getHumidity(),
                $response->getMain()->getPressure()
            );
        }

        if ($response instanceof Parking) {
            $freeSpaces = $response->getFreeSpaces();
            if (null !== $freeSpaces && $freeSpaces > 0) {
                $response = sprintf(
                    'Yes, there are %s spaces available at %s',
                    $freeSpaces,
                    $response->getName()
                );
            } else {
                $response = sprintf('Parking spot at %s is full', $response->getName());
            }
        }

        if ($response instanceof Answer) {
            $response = sprintf(
                "Route from %s to %s\n%s",
                $response->getFrom()->getName(),
                $response->getTo()->getName(),
                implode("\n", $response->getTrip())
            );
        }

        return [
            'text' => (string)$response,
        ];
    }
}
