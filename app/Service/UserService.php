<?php

namespace App\Service;

use App\Interface\UserInterface;
use App\Model\Users;
use App\Repository\UserRepository;
use Psr\SimpleCache\CacheInterface;

class UserService implements UserInterface
{
    protected $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function getInfoById(int $id)
    {
        return UserRepository::findById($id);    
    }

    public function getUserFromCache(int $userId)
    {
        $cacheKey = "user_{$userId}";
        
        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        return null;
    }

    public function storeUserInCache(int $userId, int $ttl = 3600)
    {
        $cacheKey = "user_{$userId}";
        return $this->cache->set($cacheKey, $this->getInfoById($userId)->toArray(), $ttl);
    }

    public function removeUserFromCache(int $userId)
    {
        $cacheKey = "user_{$userId}";
        return $this->cache->delete($cacheKey);
    }

    


}