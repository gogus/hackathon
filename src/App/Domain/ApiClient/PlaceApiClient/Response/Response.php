<?php

namespace App\Domain\ApiClient\PlaceApiClient\Response;

/**
 * PlaceService API
 */
class Response
{
    /**
     * @var string
     */
    private $photo;

    /**
     * @var string
     */
    private $desc;

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $link;

    /**
     * Response constructor.
     * @param $photo
     * @param $docs
     * @param $link
     */
    public function __construct(
        $photo,
        $desc,
        $link,
        $name
    ) {
        $this->photo = $photo;
        $this->desc = $desc;
        $this->link = $link;
        $this->name = $name;
    }

    /**
     * @param array $data
     *
     * @return Response
     */
    public static function fromArray(array $data)
    {
        return new self(
            $data['photo'],
            '',
            $data['link'],
            $data['name']
        );
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

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param string $desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}