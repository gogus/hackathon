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
                    'title' =>'',
                    'subtitle' => '',
                    'image_url' => $response->getPhoto(),
                    'buttons' =>[]
                ]
            ];

        return [
            'attachment' => [
                'type' => 'template',
                'payload' => [
                    'template_type' => 'generic',
                    'elements' => $elements,
                ]
            ],
            'text' => $response->getMessage()
        ];
    }
}
