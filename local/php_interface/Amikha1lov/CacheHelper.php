<?php

namespace Amikha1lov;

use Bitrix\Main\Application;
use Bitrix\Main\Data\Cache as BitrixCache;

class CacheHelper
{
    protected $cache;
    protected $taggedCache;
    protected string $cachePath;
    protected string $cacheTag;
    protected int $cacheTtl;
    protected string $cacheKey;
    protected string $initCache;

    public function __construct(string $cachePath, int $cacheTtl, string $cacheKey)
    {
        $this->cache = BitrixCache::createInstance();
        $this->taggedCache = Application::getInstance()->getTaggedCache();
        $this->cachePath = $cachePath;
        $this->cacheTtl = $cacheTtl;
        $this->cacheKey = $cacheKey;

        $this->initCache = $this->cache->initCache($this->cacheTtl, $this->cacheKey, $this->cachePath);

    }

    public function setTag(string $cacheTag)
    {
        $this->cacheTag = $cacheTag;

        return $this;
    }

    public function callback(callable $callback)
    {
        if ($this->initCache) {
            $vars = $this->cache->getVars();
           
            return $vars;

        } elseif ($this->cache->startDataCache()) {

            $this->taggedCache->startTagCache($this->cachePath);

            $vars = $callback();

            $this->taggedCache->registerTag($this->cacheTag);


            $cacheInvalid = false;
            if ($cacheInvalid) {
                $this->taggedCache->abortTagCache();
                $this->cache->abortDataCache();
            }

            $this->taggedCache->endTagCache();
            $this->cache->endDataCache($vars);

            return $vars;
        }
    }


}
