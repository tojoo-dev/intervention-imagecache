# Intervention Image Cache

Intervention Image Cache extends the [Intervention Image Class](https://github.com/Intervention/image/) package to be capable of image caching functionality.

The library uses the [Illuminate/Cache](https://github.com/illuminate/cache/) package and can be easily integrated into the [Laravel Framework](https://laravel.com/) (Laravel 8+). Based on your Laravel cache configuration you are able to choose between Filesystem, Database, Memcached or Redis for the temporary buffer store.

The principle is simple. Every method call to the Intervention Image class is captured and checked by the caching interface. If this particular sequence of operations already have taken place, the data will be loaded directly from the cache instead of a resource-intensive image operation.

## Installation

You can install this package quickly and easily with Composer.

Require the package via Composer:

    $ composer require tojoo/imagecache

Now you are able to require the `vendor/autoload.php` file to PSR-4 autoload the library.

### Laravel Integration

For Laravel integration, you'll need to install the official Intervention Image Laravel package:

    $ composer require intervention/image-laravel

This package provides the Laravel ServiceProvider and Facade for Intervention Image. After installation, the `Image` facade will be available and you can use the cache functionality as described in the usage section.

**Requirements:**

- PHP ^8.1
- Laravel ^8|^9|^10|^11|^12
- Intervention Image ^3.11

## Usage

The Image Cache is best called by the static method `Image::cache` from the Intervention Image class.

To create cached images just use the static method `Image::cache` and pass the image manipulations via closure. The method will automatically detect if a cached file for your particular operations exists.

```php
// run the operations on the image or read a file
// for the particular operations from cache
$img = Image::cache(function($image) {
   return $image->make('public/foo.jpg')->resize(300, 200)->greyscale();
});
```

Determine a lifetime in minutes for the cache file as an optional second parameter. Pass a boolean true as optional third parameter to return an Intervention Image object instead of a image stream.

```php
// determine a lifetime and return as object instead of string
$img = Image::cache(function($image) {
   return $image->make('public/foo.jpg')->resize(300, 200)->greyscale();
}, 10, true);
```

## Server configuration

If you have Static Resources caching enabled on Nginx please add your cache directory ({route} in config) to static resources handler exclusion:

```
# where "cache" is {route}
location ~* ^\/(?!cache).*\.(?:jpg|jpeg|gif|png|ico|cur|gz|svg|svgz|mp4|ogg|ogv|webm|htc|webp|woff|woff2)$ {
  expires max;
  access_log off;
  add_header Cache-Control "public";
}
```

## License

Intervention Imagecache Class is licensed under the [MIT License](http://opensource.org/licenses/MIT).
