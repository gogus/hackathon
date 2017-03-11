<?php

namespace App\Domain\Callback\Formatter;

interface FormatterInterface
{
    /**
     * @param mixed $response
     *
     * @return mixed
     */
    public function format($response);
}