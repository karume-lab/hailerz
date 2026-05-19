<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

/**
 * Trait Cacheable
 *
 * Provides an automatic cache invalidation layer for Eloquent models.
 * It uses the model's updated_at timestamp to generate unique cache keys,
 * ensuring that whenever a model is updated, the cache is effectively "invalidated"
 * by pointing to a new key.
 */
trait Cacheable
{
    /**
     * Generate a versioned cache key for this model instance.
     *
     * @param  string  $suffix  A descriptive name for the cached data (e.g., 'og_image', 'full_profile')
     */
    public function getCacheKey(string $suffix): string
    {
        $className = strtolower(class_basename($this));
        $timestamp = $this->updated_at ? $this->updated_at->timestamp : time();

        return "{$className}:{$this->id}:{$timestamp}:{$suffix}";
    }

    /**
     * Remember a value in the cache, automatically keyed by the model's identity and timestamp.
     *
     * @param  int|\DateTimeInterface  $ttl  Seconds or DateTime
     * @return mixed
     */
    public function cacheRemember(string $suffix, $ttl, \Closure $callback)
    {
        return Cache::remember($this->getCacheKey($suffix), $ttl, $callback);
    }

    /**
     * Forcefully "invalidate" the cache by updating the model's timestamp.
     * This is useful if you want to trigger a cache bust without changing any data.
     */
    public function bustCache(): void
    {
        $this->touch();
    }
}
