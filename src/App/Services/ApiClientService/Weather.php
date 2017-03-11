<?php

/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 3/11/2017
 * Time: 5:00 PM
 */

namespace App\Domain\Service\ApiClientService;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

/**
 * Class Weather
 * @package App\Domain\Service\ApiClientService
 */
class Weather
{
    /**
     * @var
     */
    protected $url;
    /**
     * @var
     */
    protected $timeout;
    /**
     * @var ClientInterface
     */
    protected $guzzleCleint;

    /**
     * @param $url
     * @param $timeout
     * @param ClientInterface $guzzleCleint
     */
    public function __construct($url, $timeout, ClientInterface $guzzleCleint)
    {
        $this->url = $url;
        $this->timeout = $timeout;
        $this->guzzleCleint = $guzzleCleint;

    }


    /**
     * @return mixed
     */
    public function makeCall()
    {
       return $this->guzzleCleint($this->url,$this->timeout);
    }
}