<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 3/11/2017
 * Time: 6:01 PM
 */

namespace App\Domain\Service\ApiClientService;


/**
 * Interface ApiClientService
 * @package App\Domain\Service\ApiClientService
 */
interface ApiClientService
{
    /**
     * @param null $params
     * @return mixed
     */
    public function makeCall($params=null);
}