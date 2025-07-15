<?php

namespace Intervention\Image\Laravel;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageCache;
use Intervention\Image\Laravel\Facades\ImageCache as ImageCacheFacade;

/**
 * ImageCache Service Provider for Laravel
 * 
 * Copy this to your Laravel app and register in config/app.php:
 * 
 * 'providers' => [
 *     // ...
 *     App\Providers\ImageCacheServiceProvider::class,
 * ]
 * 
 * Or use auto-discovery by putting this in a package.
 */
class ImageCacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php',
            ImageCacheFacade::BINDING
        );

        $this->app->singleton('imagecache', function ($app) {
            // Get the ImageManager from intervention/image-laravel
            $manager = $app->make('image');

            // Return new ImageCache instance
            return new ImageCache($manager,);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config
        // $this->publishes([
        //     __DIR__ . '/../../config/config.php' => config_path('imagecache.php'),
        // ], 'config');
    }
}
