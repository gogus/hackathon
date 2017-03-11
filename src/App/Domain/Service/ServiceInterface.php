<?php

namespace App\Domain\Service;

interface ServiceInterface
{
    /**
     * @param string $query
     *
     * @return AnswerInterface
     */
    public function ask($query);
}