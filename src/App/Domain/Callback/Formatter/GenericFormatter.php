<?php

namespace App\Domain\Callback\Formatter;

use App\Domain\ApiClient\WeatherApiClient\Response\Response;

class GenericFormatter implements FormatterInterface
{
    /**
     * @inheritDoc
     */
    public function format($response)
    {
        $elements = [];

        if ($response instanceof Response)
        {
            $elements = [
                [
                    'title' => 'Weather ' . $response->getCity()->getName() . ' ' . $response->getMain()->getTemperature(),
                    'subtitle' => 'Humidity ' . $response->getMain()->getHumidity() . ', ' . 'Wind speed ' . $response->getWind()->getSpeed(),
                    'image_url' => 'http://icons.iconarchive.com/icons/webalys/kameleon.pics/512/Cloudy-icon.png',
                    'buttons' => [
                        [
                            'type' => 'web_url',
                            'title' => 'Get properties',
                            'url' => 'http://www.accuweather.com/en/lu/luxembourg-findel-international-airport/3734_poi/weather-forecast/3734_poi',
                        ]
                    ]
                ]
            ];
        }

        return [
            'attachment' => [
                'type' => 'template',
                'payload' => [
                    'template_type' => 'generic',
                    'elements' => $elements,
                ]
            ]
        ];
    }
}
