<?php

namespace App\Domain\Callback\Formatter;


class PlaceFormatter implements FormatterInterface
{
    /**
     * @inheritDoc
     */
    public function format($response)
    {
        $elements = [
            'title' => 'Following location does not exists'
            ];

        if ($response->getName() && $response->getDocks()) {
            $elements = [
                [
                    'title' => 'You chosen ' . $response->getName(),
                    'subtitle' => ' ' ,
                    'image_url' => $response->getPhoto(),
                    'buttons' => [
                        [
                            'type' => 'web_url',
                            'title' => 'Get more informations',
                            'url' => $response->getLink(),
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
