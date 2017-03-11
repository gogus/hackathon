<?php

namespace App\Services;

/**
 * Class BaseService
 *
 * @package App\Services
 */
class BaseService
{
    protected $db;

    /**
     * BaseService constructor.
     *
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }
}
