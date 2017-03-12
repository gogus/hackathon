<?php

namespace App\Domain\Callback\Formatter;

use App\Domain\ApiClient\WeatherApiClient\Response\Response;
use App\Domain\ApiClient\BikeApiClient\Response\Response as BikeResponse;
use App\Domain\ApiClient\PlaceApiClient\Response\Response as PlaceResponse;

/**
 * Class FormatterFactory
 *
 * @package App\Domain\Callback\Formatter
 */
class FormatterFactory
{
    /**
     * @param $response
     *
     * @return array
     */
    public function format($response)
    {
        if ($response instanceof Response) {
            $formatter = new GenericFormatter();
        } elseif ($response instanceof BikeResponse) {
            $formatter = new BikeFormatter();
        } elseif ($response instanceof PlaceResponse) {
            $formatter = new PlaceFormatter();
        } else {
            $formatter = new StringFormatter();
        }

        return $formatter->format($response);
    }
}
