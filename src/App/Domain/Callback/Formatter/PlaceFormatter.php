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
            [
            'title' => 'Following location does not exists'
            ]
        ];

        if ($response->getName()) {
            $elements = [
                [
                    'title' => 'You chosen ' . $response->getName(),
                    'subtitle' => $response->getDesc() . $response->getIsOpened() . $response->getAddress(),
                    'image_url' => $response->getPhoto(),
                    'buttons' => [
                        [
                            'type' => 'web_url',
                            'title' => 'Get more information',
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
