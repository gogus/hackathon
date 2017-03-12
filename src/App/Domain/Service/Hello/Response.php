<?php

namespace App\Domain\Service\Hello;

/**
 * PlaceService API
 */
class Response
{
    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $photo;

    /**
     * Response constructor.
     * @param $photo
     */
    public function __construct($message)
    {
        $this->message = $message;
        $this->photo = $message;
    }

    /**
     * @param array $data
     *
     * @return Response
     */
    public static function fromString($data)
    {
        return new self($data);
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Response
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     * @return Response
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

}