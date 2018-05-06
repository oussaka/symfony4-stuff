<?php
namespace App\Service;

use Psr\Cache\CacheItemPoolInterface;

class CacheExample
{
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    public function __construct(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return \Psr\Cache\CacheItemInterface
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function get(string $key)
    {
        $cacheKey = md5($key);

        $cachedItem = $this->cache->getItem($cacheKey);

        if (false === $cachedItem->isHit()) {
            $cachedItem->set($cacheKey, 'some value');
            $this->cache->save($cachedItem);
        }

        dump($cachedItem);

        return $cachedItem;
    }
}