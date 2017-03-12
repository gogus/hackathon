<?php

namespace App\Services;

use Moust\Silex\Cache\CacheInterface;

/**
 * Class PreviousQueryService
 *
 * @package App\Services
 */
class PreviousQueryService
{
    /**
     * @var CacheInterface
     */
    protected $cache;

    /**
     * PreviousQueryService constructor.
     *
     * @param CacheInterface $cache
     */
    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param int    $senderId
     * @param string $query
     */
    public function save($senderId, $query)
    {
        if ($this->cache->exists($senderId)) {
            $this->cache->delete($senderId);
        }

        $this->cache->store($senderId, $query);
    }

    /**
     * @param int $senderId
     *
     * @return string
     */
    public function get($senderId)
    {
        return $this->cache->fetch($senderId);
    }
}
