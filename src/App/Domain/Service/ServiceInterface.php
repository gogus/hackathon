<?php

namespace App\Domain\Service;

interface ServiceInterface
{
    /**
     * @param QueryInterface $query
     *
     * @return AnswerInterface
     */
    public function ask(QueryInterface $query);
}