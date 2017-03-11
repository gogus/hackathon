<?php

namespace App\Domain\Callback\Formatter;

use App\Domain\ApiClient\WeatherApiClient\Response\Response;
use App\Domain\ApiClient\CarParkApiClient\Response as CarparkResponse;
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

        if ($response instanceof CarparkResponse)
        {
            $output = '';
            foreach ($response->getParkings() as $parking)
            {
                $output .= $parking->getParkingName() . ' ';
            }
            $response = $output;
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
