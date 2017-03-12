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
            'title' => 'Following location does not exists',
            'buttons' => [
                [
                    'type' => 'web_url',
                    'title' => 'Get more informations',
                    'url' => 'http://www.velo.lu',
                ]
            ]];

        $distance = $response->getDistance() ? ' Nearest station is:' . $response->getDistance() . ' m from you location' : '';
        if ($response->getName() && $response->getDocks()) {
            $elements = [
                [
                    'title' => 'In station ' . $response->getName() . ' we have ' . $response->getAvailableBikes() . ' free bikes ',
                    'subtitle' => ' ' . $response->getAvailableEbikes() . ' free e-bikes , all docks in station: ' . $response->getDocks()
                        . $distance
                        . ' Location:' . '  ' . $response->getAddress(),
                    'image_url' => $response->getPhoto() ?: 'http://shootandscrawl.com/wp-content/uploads/2011/08/veloh.jpg',
                    'buttons' => [
                        [
                            'type' => 'web_url',
                            'title' => 'Get more informations',
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
