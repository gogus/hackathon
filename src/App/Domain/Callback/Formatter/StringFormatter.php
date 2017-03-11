<?php

namespace App\Domain\Callback\Formatter;

use App\Domain\ApiClient\CarParkApiClient\Response\Response as CarparkResponse;

class StringFormatter implements FormatterInterface
{
    /**
     * @param mixed $response
     *
     * @return array
     */
    public function format($response)
    {
        if ($response instanceof CarparkResponse)
        {
            $output = '';

            foreach ($response->getParkings() as $parking)
            {
                $output .= $parking->getParkingName() . ' ';
            }

            $response = $output;
        }

        return [
            'text' => $response
        ];
    }
}
