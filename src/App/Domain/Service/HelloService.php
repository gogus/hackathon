<?php

namespace App\Domain\Service;

use App\Domain\Service\Hello\Response;

/**
 * Class ApiService
 * @package App\Domain\Service
 */
class HelloService implements ServiceInterface
{
    /**
     * @param null $query
     * @param string $token
     * @return Response|string
     */
    public function ask($query = null, $token = '')
    {
        $message = "Hello, how can I help you?";

        return $message;
    }
}
