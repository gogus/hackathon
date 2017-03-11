<?php

namespace App\Domain\ApiClient\Response;

interface StringableInterface
{
    /**
     * @return string
     */
    public function __toString();
}