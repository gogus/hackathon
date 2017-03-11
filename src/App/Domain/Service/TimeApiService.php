<?php

namespace App\Domain\Service;

class TimeApiService implements ServiceInterface
{
    public function ask($query)
    {
        return date('Y-m-d H:i:s');
    }
}