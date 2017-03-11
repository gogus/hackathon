<?php

namespace App\Services;
use App\Domain\Service\AnswerInterface;
use App\Domain\Service\QueryInterface;

/**
 * Class QueryParserService
 *
 * @package App\Services
 */
class QueryParserService extends BaseService implements \App\Domain\Service\ServiceInterface
{

    /**
     * @param QueryInterface $query
     *
     * @return AnswerInterface
     */
    public function ask( $query)
    {
        // TODO: Implement ask() method.
        return file_get_contents('http://www.timeapi.org/utc/now?format=%25a%20%25b%20%25d%20%25I:%25M:%25S%20%25Y');
    }
}