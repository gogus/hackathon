<?php

namespace App\Domain\Service;

interface ServiceInterface
{
    /**
     * @param string $query
     *
     * @return mixed
     */
    public function ask($query);
}