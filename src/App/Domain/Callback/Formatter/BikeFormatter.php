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
            [
                'title' => 'In station ' . $response->getName() .' we have ' . $response->getAvailableBikes() . ' free bikes ',
                'subtitle' => ' ' . $response->getAvailableEbikes() . ' free e-bikes , all docks in station: ' . $response->getDocks() . ' Nearest station is:' . $response->getDistance() .'m from you located on' . '  ' . $response->getAddress(),
                'image_url' => $response->getPhoto(),
                'buttons' => [
                    [
                        'type' => 'web_url',
                        'title' => 'Get more informations',
                        'url' => 'http://www.velo.lu',
                    ]
                ]
            ]
        ];


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
