<?php

namespace App\Domain\Callback\Formatter;

use App\Domain\ApiClient\Response\StringableInterface;

class StringFormatter implements FormatterInterface
{
    public function format($response)
    {
        if (is_string($response) || $response instanceof StringableInterface)
        {
            return (string)$response;
        }

        throw new \Exception('Cannot format response of type ' . get_class($response));
    }
}