<?php

namespace Intervention\Image\Laravel\Facades;

use Closure;
use Illuminate\Support\Facades\Facade;

/**
 * ImageCache Facade for Laravel
 * 
 * Extends the existing Image facade with cache functionality
 * 
 * Usage:
 * $image = ImageCache::cache(function($cache) {
 *     $cache->make('path/to/image.jpg')->resize(300, 200)->blur(5);
 * }, 60, true);
 */
class ImageCache extends Facade
{
    public const BINDING = 'imagecache';

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return self::BINDING;
    }

    /**
     * Cache method for image processing
     *
     * @param Closure $callback
     * @param int|null $lifetime Cache lifetime in minutes
     * @param bool $returnObj Return as Image object or string
     * @return mixed
     * @throws \Exception
     */
    public static function cache(Closure $callback, $lifetime = null, $returnObj = false)
    {
        if (!class_exists('Intervention\\Image\\Laravel\\Facades\\Image')) {
            throw new \Exception(
                "Please install package intervention/image-laravel before using cache functionality with Laravel."
            );
        }

        if (!function_exists('app')) {
            throw new \Exception(
                "Laravel application instance not found. Ensure you are using this within a Laravel context."
            );
        }

        // Get the ImageCache instance from the service container
        $imagecache = \app('imagecache');

        // Run callback
        if (is_callable($callback)) {
            $callback($imagecache);
        }

        return $imagecache->get($lifetime, $returnObj);
    }
}
