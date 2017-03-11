<?php

namespace App\Test\Unit\Domain\ApiClient\WeatherApiClient\Response;

use App\Domain\ApiClient\WeatherApiClient\Response\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testFromArray()
    {
        $response = Response::fromArray([
            'coord'      => [
                'lat' => 49.627688,
                'lon' => 6.223234,
            ],
            'weather'    => [
                'id'          => null,
                'main'        => null,
                'description' => "Nuageux",
                'icon'        => null,
            ],
            'main'       => [
                'temp'     => 14,
                'pressure' => 1018,
                'humidity' => 35,
                'temp_min' => null,
                'temp_max' => null,
            ],
            'visibility' => 10000,
            'wind'       => [
                'speed' => 7,
                'deg'   => 90,
            ],
            'clouds'     => [
                'all' => 80,
            ],
            'name'       => "Strassen",
        ]);

        $this->assertInstanceOf(Response::class, $response);
    }
}
