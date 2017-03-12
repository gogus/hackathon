<?php

namespace App\Domain\Service;

class TimeService implements ServiceInterface
{
    public function ask($query = null, $token = '')
    {
        return date('Y-m-d H:i:s');
    }
}