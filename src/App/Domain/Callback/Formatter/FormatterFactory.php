<?php

namespace App\Domain\Callback\Formatter;

use App\Domain\ApiClient\WeatherApiClient\Response\Response;

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
            $formatter = new ListTemplateFormatter();
        } else {
            $formatter = StringFormatter();
        }

        return new $formatter->format($response);
    }
}
