<?php

namespace App\Domain\ApiClient;

interface ApiClient
{
    /**
     * @param null $params
     *
     * @return mixed
     */
    public function makeCall($params = null);
}