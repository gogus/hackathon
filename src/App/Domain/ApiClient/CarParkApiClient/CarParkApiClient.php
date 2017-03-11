<?php
namespace App\Domain\ApiClient\CarParkApiClient;

/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 3/11/2017
 * Time: 9:06 PM
 */

use App\Domain\ApiClient\ApiClient;
use GuzzleHttp\Client;

class CarParkApiClient implements ApiClient
{
    protected $guzzleClient;
    protected $url;
    /**
     * CarParkApiClient constructor.
     * @par
am $guzzleClient
     */
    public function __construct($url, Client $guzzleClient)
    {
        $this->url = $url;
        $this->guzzleClient = $guzzleClient;
    }

    public function makeCall($param = null)
    {
        $res = $this->guzzleClient->get($this->url)->getBody()->getContents();
        $jsonRes = json_decode($res, true);

        if (!$jsonRes) {
            throw new Exception('message:' . var_export($res, true));
        }

        return $jsonRes;
    }

}