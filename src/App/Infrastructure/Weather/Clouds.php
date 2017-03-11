<?php

namespace App\Infrastructure\Weather;

class Clouds
{
    /**
     * Cloudiness, %.
     *
     * @var int
     */
    private $cloudiness;

    /**
     * @param int $cloudiness
     */
    public function __construct($cloudiness)
    {
        $this->cloudiness = $cloudiness;
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function fromArray(array $data)
    {
        return new self($data['all']);
    }

    /**
     * @return int
     */
    public function getCloudiness()
    {
        return $this->cloudiness;
    }
}