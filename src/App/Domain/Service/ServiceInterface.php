<?php

namespace App\Domain\Service;

interface ServiceInterface
{
    /**
     * @param string $query Full query string
     * @param string $token Keyword which produced the match
     *
     * @return mixed
     */
    public function ask($query = null, $token = '');
}