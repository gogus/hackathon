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
                'title' => 'In following station we have ' . $response->getAvailableBikes() . ' free bikes ',
                'subtitle' => ' ' . $response->getAvailableEbikes() . ' free e-bikes , ' . '  ' . $response->getPhoto() . ' ' . $response->getDocks(),
                'image_url' => 'http://shootandscrawl.com/wp-content/uploads/2011/08/veloh.jpg',
                'buttons' => [
                    [
                        'type' => 'web_url',
                        'title' => 'Get properties',
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
