<?php

namespace App\Domain\Callback\Formatter;


class BikeFormatter implements FormatterInterface
{
    /**
     * @inheritDoc
     */
    public function format($response)
    {
        $elements = [
            'title' => 'Sorry, cannot find specified location',
            'buttons' => [
                [
                    'type' => 'web_url',
                    'title' => 'Get more information',
                    'url' => 'http://www.velo.lu',
                ]
            ]];

        $distance = $response->getDistance() ? ' Nearest station is in ' . $response->getDistance() . ' m from you' : '';
        if ($response->getName() && $response->getDocks()) {
            $elements = [
                [
                    'title' => 'There are ' . $response->getAvailableBikes() . ' bikes at ' . $response->getName() . ' station',
                    'subtitle' => ' ' . $response->getAvailableEbikes() . ' free e-bikes , all docks in station: ' . $response->getDocks()
                        . $distance
                        . ' Location:' . '  ' . $response->getAddress(),
                    'image_url' => $response->getPhoto() ?: 'http://shootandscrawl.com/wp-content/uploads/2011/08/veloh.jpg',
                    'buttons' => [
                        [
                            'type' => 'web_url',
                            'title' => 'Get more information',
                            'url' => 'http://www.velo.lu',
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
