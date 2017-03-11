<?php

namespace App\Services;
use App\Domain\Service\AnswerInterface;
use App\Domain\Service\QueryInterface;

/**
 * Class QueryParserService
 *
 * @package App\Services
 */
class TimeApiService implements \App\Domain\Service\ServiceInterface
{

    /**
     * @param QueryInterface $query
     *
     * @return AnswerInterface
     */
    public function ask( $query)
    {
        // TODO: Implement ask() method.
        return date('Y-m-d H:i:s');
    }
}